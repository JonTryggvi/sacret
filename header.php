<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">

		<?php // force Internet Explorer to use the latest rendering engine available ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title><?php wp_title(''); ?></title>
		
		<meta name="HandheldFriendly" content="True">
		<!-- <meta name="MobileOptimized" content="320"> -->
		<meta name="viewport" content="width=device-width, initial-scale=1"/>

		<?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
		<link rel="apple-touch-icon" sizes="180x180" href="/images/favicon/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">
		<link rel="manifest" href="/images/favicon/site.webmanifest">
		<link rel="mask-icon" href="/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
		<link rel="shortcut icon" href="/images/favicon/favicon.ico">
		<meta name="apple-mobile-web-app-title" content="Uni">
		<meta name="application-name" content="Uni">
		<meta name="msapplication-TileColor" content="#603cba">
		<meta name="msapplication-config" content="/images/favicon/browserconfig.xml">
		<meta name="theme-color" content="#ffffff">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/r29/html5.min.js"></script><![endif]-->
	
		<?php // wordpress head functions ?>
		<?php wp_head(); ?>
		<?php // end of wordpress head ?>

	</head>
	<?php 
	$get_color =  get_field('set_theme_color_palete', 'option');
	$theme_color = $get_color .'_theme'; ?>

	<body <?php body_class(['bc--white', $theme_color]); ?> itemscope itemtype="http://schema.org/WebPage">

		<div id="container">

		<?php uni_partial('parts/header/header', ['theme_color' => $get_color]); ?>
