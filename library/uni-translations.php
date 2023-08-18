<?php

if(function_exists('pll_register_string')) {

  pll_register_string('component', 'More', 'Avista');
  pll_register_string('component', 'Meira', 'Avista');
  // pll_register_string('cart', 'Total', 'Uni woo');
  // pll_register_string('cart', 'Subtotal', 'Uni woo');
  // pll_register_string('cart', 'Cart totals', 'Uni woo');
  // pll_register_string('cart', 'Shipping', 'Uni woo');
  // pll_register_string('cart', 'Remove this item', 'Uni woo');
  // pll_register_string('cart', 'Product', 'Uni woo');
  // pll_register_string('cart', 'Price', 'Uni woo');
  // pll_register_string('cart', 'Quantity', 'Uni woo');
  // pll_register_string('cart', 'Subtotal', 'Uni woo');
  // pll_register_string('cart', 'Update cart', 'Uni woo');
  // pll_register_string('cart', 'Proceed to checkout', 'Uni woo');
  // pll_register_string('cart', 'Billing &amp; Shipping', 'Uni woo');
  // pll_register_string('cart', 'Billing details', 'Uni woo');
  // pll_register_string('cart', 'Your order', 'Uni woo');
  // pll_register_string('cart', 'Additional information', 'Uni woo');

  $fields_and_labels = [
    'First name' ,
    'Last name',
    'Company name' ,
    'Country / Region',
    'Street address',
    'Postcode / ZIP',
    'Town / City',
    'Province',
    'Phone',
    'Email address' ,
    'Order notes',
    'House number and street name',
    'Apartment, suite, unit etc. (optional)',
    'Notes about your order, e.g. special notes for delivery.',
  ];

  // foreach ($fields_and_labels as $value) {
  //   pll_register_string('form', $value, 'Uni woo checkout');
  // }


  // add_filter( 'woocommerce_checkout_fields' , 'override_billing_checkout_fields', 20, 1 );
  function override_billing_checkout_fields( $fields ) {
    foreach ($fields['billing'] as $key => $forms) {
      if(array_key_exists('placeholder', $fields['billing'][$key])) {
        $fields['billing'][$key]['placeholder'] = pll__($forms['placeholder']);
      }
    }
    foreach ($fields['shipping'] as $key => $forms) {
      if(array_key_exists('placeholder', $fields['shipping'][$key])) {
        $fields['shipping'][$key]['placeholder'] = pll__($forms['placeholder']);
      }
    }
    return $fields;
  }

  // add_filter( 'woocommerce_default_address_fields' , 'translate_wc_address_fields' );
  function translate_wc_address_fields( $fields ) {
    foreach ($fields as $key => $forms) {
      $fields[$key]['label'] = pll__($forms['label']);
      if(array_key_exists('placeholder', $fields[$key])) {
        $fields[$key]['placeholder'] = pll__($forms['placeholder']);
      }
    }
    return $fields;
  }
}