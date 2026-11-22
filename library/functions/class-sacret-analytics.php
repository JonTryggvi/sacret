<?php
/**
 * SacretAnalytics
 *
 * The GA4 tag for uni.is (property "uni.is" in the Jón Tryggvi GA account),
 * ported from the islandiamagica theme. On top of the stock gtag snippet:
 *
 *  - Only the production hostname (home_url()'s host) measures. The check runs
 *    in the browser against location.hostname, so uni.test, the Flywheel
 *    staging URL and the tempurl host never send a hit, and a page cached on one
 *    host cannot carry its decision to another.
 *  - Internal visits carry traffic_type=internal, the parameter GA4's "Internal
 *    Traffic" data filter matches on. A browser becomes internal by opening any
 *    page with ?ga_internal=1 (a one-year cookie; ?ga_internal=0 clears it), or by
 *    loading wp-admin while logged in. That sets the same cookie from PHP, so the
 *    front end never has to know who is logged in, and the browser stays internal
 *    after logout.
 *  - gtag.js loads only once the visitor accepts analytics in the consent banner
 *    (class-sacret-consent.php). Until then no request goes to Google, and any
 *    _ga cookies already in the browser are deleted.
 *  - The measurement ID defaults to DEFAULT_ID. Define SACRET_GA_ID in
 *    wp-config.php to point at another property, or as '' to switch the tag off.
 *
 * ?ga_debug=1 routes this browser's hits to DebugView for 24 hours.
 */

defined( 'ABSPATH' ) || exit;

final class SacretAnalytics {

  const DEFAULT_ID      = 'G-S08MV4JBJS';
  const INTERNAL_COOKIE = 'ga_internal';

  public static function init(): void {
    add_action( 'wp_head', [ self::class, 'render' ], 2 );
    add_action( 'wp_login', [ self::class, 'mark_internal' ] );
    add_action( 'admin_init', [ self::class, 'mark_internal_if_logged_in' ] );
  }

  /**
   * The GA4 measurement ID, or '' when this install should not measure.
   */
  public static function measurement_id(): string {
    $id = defined( 'SACRET_GA_ID' ) ? (string) SACRET_GA_ID : self::DEFAULT_ID;
    $id = strtoupper( trim( $id ) );

    return preg_match( '/^G-[A-Z0-9]+$/', $id ) ? $id : '';
  }

  public static function render(): void {
    $id = self::measurement_id();
    if ( '' === $id ) {
      return;
    }

    $config = wp_json_encode( [
      'id'       => $id,
      'host'     => (string) wp_parse_url( home_url(), PHP_URL_HOST ),
      'internal' => self::INTERNAL_COOKIE,
    ] );

    echo <<<HTML
<!-- Google tag (gtag.js) -->
<script>
(function () {
  var c = {$config};

  // Production hostname only — see class-sacret-analytics.php.
  if (location.hostname !== c.host) {
    return;
  }

  function setFlag(name, maxAge) {
    document.cookie = name + (maxAge ? '=1; max-age=' + maxAge : '=; max-age=0') +
      '; path=/; SameSite=Lax' + ('https:' === location.protocol ? '; Secure' : '');
  }

  function hasFlag(name) {
    return new RegExp('(^|;\\\\s*)' + name + '=1(;|$)').test(document.cookie);
  }

  // ?ga_internal=1 marks this browser as internal for a year; ?ga_internal=0 clears it.
  // ?ga_debug=1 routes this browser's hits to DebugView for 24h; ?ga_debug=0 clears it.
  var q = location.search;
  if (/[?&]ga_internal=0(&|$)/.test(q)) {
    setFlag(c.internal, 0);
  } else if (/[?&]ga_internal=1(&|$)/.test(q)) {
    setFlag(c.internal, 31536000);
  }
  if (/[?&]ga_debug=0(&|$)/.test(q)) {
    setFlag('ga_debug', 0);
  } else if (/[?&]ga_debug=1(&|$)/.test(q)) {
    setFlag('ga_debug', 86400);
  }

  // Nothing below runs without consent — see class-sacret-consent.php.
  var consent = window.SacretConsent;
  if (!consent) {
    return;
  }

  var loaded = false;

  function load() {
    if (loaded) {
      return;
    }
    loaded = true;

    window.dataLayer = window.dataLayer || [];
    window.gtag = window.gtag || function () { window.dataLayer.push(arguments); };

    // Analytics only: the site runs no ads, so Google gets no advertising signals.
    gtag('consent', 'default', {
      analytics_storage: 'granted',
      ad_storage: 'denied',
      ad_user_data: 'denied',
      ad_personalization: 'denied'
    });
    gtag('js', new Date());

    var params = {};
    if (hasFlag(c.internal)) {
      params.traffic_type = 'internal';
    }
    if (hasFlag('ga_debug')) {
      params.debug_mode = true;
    }
    gtag('config', c.id, params);

    var s = document.createElement('script');
    s.async = true;
    s.src = 'https://www.googletagmanager.com/gtag/js?id=' + encodeURIComponent(c.id);
    document.head.appendChild(s);
  }

  // Deletes _ga and _ga_<id> on every domain gtag may have set them on.
  function forget() {
    if (loaded) {
      gtag('consent', 'update', { analytics_storage: 'denied' });
    }
    var labels = location.hostname.split('.');
    document.cookie.split(';').forEach(function (pair) {
      var name = pair.split('=')[0].trim();
      if (!/^_ga(_|$)/.test(name)) {
        return;
      }
      document.cookie = name + '=; max-age=0; path=/';
      for (var i = 0; i < labels.length - 1; i++) {
        document.cookie = name + '=; max-age=0; path=/; domain=.' + labels.slice(i).join('.');
      }
    });
  }

  if (consent.isGranted()) {
    load();
  } else {
    forget();
  }

  consent.onChange(function (granted) {
    if (granted) {
      load();
    } else {
      forget();
    }
  });
})();
</script>

HTML;
  }

  /**
   * Mark this browser as internal. Runs on wp_login, where the session is not yet
   * readable through is_user_logged_in() — the action firing is the proof.
   */
  public static function mark_internal(): void {
    if ( headers_sent() || '1' === ( $_COOKIE[ self::INTERNAL_COOKIE ] ?? '' ) ) {
      return;
    }

    setcookie( self::INTERNAL_COOKIE, '1', [
      'expires'  => time() + YEAR_IN_SECONDS,
      'path'     => COOKIEPATH ?: '/',
      'domain'   => COOKIE_DOMAIN ?: '',
      'secure'   => is_ssl(),
      'httponly' => false, // the front-end tag has to read it
      'samesite' => 'Lax',
    ] );
  }

  /**
   * Covers sessions that were already open when this shipped. admin_init also
   * fires for logged-out admin-ajax and admin-post requests, hence the check.
   */
  public static function mark_internal_if_logged_in(): void {
    if ( is_user_logged_in() ) {
      self::mark_internal();
    }
  }
}

SacretAnalytics::init();
