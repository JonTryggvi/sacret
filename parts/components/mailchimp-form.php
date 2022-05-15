<form class="mailchimp--form mailchimp--form--location-<?php echo $location ?>">
  <p>Skrá mig á póstlista</p>
  <input id="mailchimp_<?php echo $id_index; ?>" type="email" name="email" class="txtInp txtInp--w100 mc-email"  autocomplete="autocomplete_off_hack_xfr4!k">
  <label for="mailchimp_<?php echo $id_index; ?>" class="txtInpLabel mc-label mc-label--email "><?php pll_e('Skrá veffang'); ?></label>
  
  <input id="mailchimp_fname_<?php echo $id_index; ?>" type="text" name="fname" class="txtInp txtInp--w100 mc-name hide"autocomplete="autocomplete_off_hack_xfr4!t" >
  <label for="mailchimp_fname_<?php echo $id_index; ?>" class="txtInpLabel mc-label mc-label--fname hide"><?php pll_e('Skrá nafn. Ekki nauðsynlegt en æskilegt'); ?></label>

  <input id="mailchimp-lname_<?php echo $id_index; ?>" type="text" name="lname" class="txtInp txtInp--w100 mc-name hide" autocomplete="autocomplete_off_hack_xfr4!m">
  <label for="mailchimp_lname_<?php echo $id_index; ?>" class="txtInpLabel mc-label mc-label--lname hide"><?php pll_e('Skrá eftirnafn Ekki nauðsynlegt en æskilegt'); ?></label>
  
  <button type="button" class="btn btn--dark-blue btm--mc-submit btn--small btn--nomargin"><?php pll_e('Skrá mig'); ?></button>
</form>
