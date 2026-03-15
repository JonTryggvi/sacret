<?php
  add_filter('gettext', function ($translated, $text, $domain) {
    if (in_array($domain, ['your-theme-textdomain','woocommerce'])) {
      if ($text === 'Great things are on the horizon') {
        return __('Síðan er í vinnslu', 'Sacret');
      }
      if ($text === 'Something big is brewing! Our store is in the works and will be launching soon!') {
        return __('Hér kemur fljótlega netverslun', 'Sacret');
      }
    }
    return $translated;
}, 10, 3);