<?php
/**
 * SacretConsent
 *
 * The site's one cookie banner, ported from the islandiamagica theme. It asks
 * once for consent to analytics (Google Analytics, class-sacret-analytics.php),
 * which does not load until the visitor says yes.
 *
 *  - The decision lives in the first-party `uni_consent` cookie for a year, as
 *    "1.granted" or "1.denied". The leading number is the version: bump VERSION
 *    when the purposes change and everyone is asked again. Only the browser reads
 *    it, so a cached page never carries one visitor's decision to another.
 *  - window.SacretConsent is defined in wp_head at priority 1, before the GA tag
 *    at priority 2, which asks it before loading gtag.js.
 *  - Reject sits beside accept at the same size and weight. Any element with
 *    data-consent-open (the "Vafrakökur" button in the footer), or any link to
 *    #vafrakokur, reopens the banner. Withdrawing reloads the page so nothing
 *    already running keeps measuring.
 *  - Text follows the Polylang language (is / en), Icelandic by default.
 */

defined( 'ABSPATH' ) || exit;

final class SacretConsent {

  const COOKIE  = 'uni_consent';
  const VERSION = '1';
  const ANCHOR  = 'vafrakokur';

  private const STRINGS = [
    'is' => [
      'title'  => 'Vafrakökur fyrir vefmælingar',
      'text'   => 'Með þínu leyfi notar uni.is vafrakökur frá Google Analytics til að sjá hvernig vefurinn er notaður. Engar auglýsingakökur. Þú getur breytt vali þínu hvenær sem er undir „Vafrakökur“ neðst á síðunni.',
      'reject' => 'Hafna',
      'accept' => 'Samþykkja',
      'open'   => 'Vafrakökur',
    ],
    'en' => [
      'title'  => 'Analytics cookies',
      'text'   => 'With your permission, uni.is uses Google Analytics cookies to see how the site is used. No advertising cookies. You can change your choice at any time under “Cookies” at the foot of every page.',
      'reject' => 'Reject',
      'accept' => 'Accept',
      'open'   => 'Cookies',
    ],
  ];

  public static function init(): void {
    add_action( 'wp_head', [ self::class, 'render_script' ], 1 );
    add_action( 'wp_footer', [ self::class, 'render_banner' ], 5 );
  }

  /**
   * One banner string in the current Polylang language.
   */
  public static function text( string $key ): string {
    $lang = function_exists( 'pll_current_language' ) ? (string) pll_current_language() : '';
    $set  = self::STRINGS[ $lang ] ?? self::STRINGS['is'];

    return $set[ $key ] ?? '';
  }

  /**
   * The footer button that reopens the banner.
   */
  public static function open_button(): string {
    $label = esc_html( self::text( 'open' ) );

    return <<<HTML
<button type="button" class="consent-open" data-consent-open>{$label}</button>
HTML;
  }

  public static function render_script(): void {
    $config = wp_json_encode( [
      'cookie'  => self::COOKIE,
      'version' => self::VERSION,
      'anchor'  => '#' . self::ANCHOR,
    ] );

    $script = <<<'JS'
(function () {
  var c = __CONFIG__;
  var listeners = [];
  var opener = null;

  function read() {
    var pairs = document.cookie.split(';');
    for (var i = 0; i < pairs.length; i++) {
      var pair = pairs[i].trim();
      if (pair.indexOf(c.cookie + '=') !== 0) {
        continue;
      }
      var value = pair.slice(c.cookie.length + 1);
      if (value === c.version + '.granted') {
        return true;
      }
      if (value === c.version + '.denied') {
        return false;
      }
    }
    return null;
  }

  var state = read();

  function banner() {
    return document.getElementById('consent-banner');
  }

  function open(from) {
    var b = banner();
    if (!b) {
      return;
    }
    opener = from || null;
    b.hidden = false;
    if (opener) {
      b.querySelector('button').focus();
    }
  }

  function set(granted) {
    var was = state;
    state = !!granted;
    document.cookie = c.cookie + '=' + c.version + '.' + (state ? 'granted' : 'denied') +
      '; max-age=31536000; path=/; SameSite=Lax' + ('https:' === location.protocol ? '; Secure' : '');

    var b = banner();
    if (b) {
      b.hidden = true;
    }
    if (opener) {
      opener.focus();
      opener = null;
    }

    listeners.slice().forEach(function (fn) { fn(state); });

    // Withdrawn: reload so nothing already running on this page keeps measuring.
    if (was === true && !state) {
      location.reload();
    }
  }

  window.SacretConsent = {
    decided: function () { return state !== null; },
    isGranted: function () { return state === true; },
    onChange: function (fn) {
      listeners.push(fn);
      return function () {
        var i = listeners.indexOf(fn);
        if (i !== -1) {
          listeners.splice(i, 1);
        }
      };
    },
    set: set,
    open: open
  };

  document.addEventListener('click', function (e) {
    var el = e.target.closest('[data-consent], [data-consent-open], a[href$="' + c.anchor + '"]');
    if (!el) {
      return;
    }
    e.preventDefault();
    if (el.hasAttribute('data-consent')) {
      set(el.getAttribute('data-consent') === 'granted');
    } else {
      open(el);
    }
  });

  document.addEventListener('DOMContentLoaded', function () {
    if (state === null || location.hash === c.anchor) {
      open();
    }
  });
})();
JS;

    echo "<script>\n" . str_replace( '__CONFIG__', $config, $script ) . "</script>\n";
  }

  /**
   * The banner's own CSS, printed with it so it never depends on the theme
   * stylesheet having loaded. Reject and accept share one style on purpose:
   * rejecting must be as easy and as visible as accepting.
   */
  private static function styles(): string {
    return <<<'CSS'
.consent-banner{position:fixed;right:0;bottom:0;left:0;z-index:10000;padding:1rem 1.25rem;background:#1c1917;color:rgba(255,255,255,.85);box-shadow:0 -4px 24px rgba(0,0,0,.2)}
.consent-banner[hidden]{display:none}
.consent-banner__inner{display:flex;flex-wrap:wrap;align-items:center;gap:1rem 2.5rem;max-width:1200px;margin:0 auto}
.consent-banner__body{flex:1 1 28rem}
.consent-banner__title{margin:0 0 .25rem;font-weight:600;color:#fff}
.consent-banner__text{margin:0;font-size:.85rem;line-height:1.6}
.consent-banner__actions{display:flex;flex:0 0 auto;gap:.5rem}
.consent-banner__btn{min-width:7.5rem;padding:.6rem 1.25rem;border:1px solid #fff;border-radius:6px;background:#fff;font:inherit;font-size:.9rem;font-weight:500;color:#1c1917;cursor:pointer;transition:background 180ms ease,color 180ms ease}
.consent-banner__btn:hover{background:transparent;color:#fff}
.consent-banner__btn:focus-visible{outline:2px solid #fff;outline-offset:2px}
.consent-open{padding:0;border:0;background:none;font:inherit;color:inherit;text-decoration:underline;text-underline-offset:2px;cursor:pointer}
@media (max-width:600px){.consent-banner__actions{width:100%}.consent-banner__btn{flex:1}}
CSS;
  }

  /**
   * Printed hidden on every page, so a cached page carries it whatever the
   * visitor decided. The script above shows it.
   */
  public static function render_banner(): void {
    $title  = esc_html( self::text( 'title' ) );
    $text   = esc_html( self::text( 'text' ) );
    $reject = esc_html( self::text( 'reject' ) );
    $accept = esc_html( self::text( 'accept' ) );
    $css    = self::styles();

    echo <<<HTML
<style id="sacret-consent-css">{$css}</style>
<div id="consent-banner" class="consent-banner" role="dialog" aria-modal="false" aria-labelledby="consent-banner-title" hidden>
  <div class="consent-banner__inner">
    <div class="consent-banner__body">
      <p class="consent-banner__title" id="consent-banner-title">{$title}</p>
      <p class="consent-banner__text">{$text}</p>
    </div>
    <div class="consent-banner__actions">
      <button type="button" class="consent-banner__btn" data-consent="denied">{$reject}</button>
      <button type="button" class="consent-banner__btn" data-consent="granted">{$accept}</button>
    </div>
  </div>
</div>

HTML;
  }
}

SacretConsent::init();
