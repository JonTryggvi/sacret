<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?php wp_title(''); ?></title>
		<meta name="HandheldFriendly" content="True">
		<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
		<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/library/images/favicon/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/library/images/favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/library/images/favicon/favicon-16x16.png">
		<link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/library/images/favicon/site.webmanifest">
		<link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/library/images/favicon/favicon.ico">
		<meta name="apple-mobile-web-app-title" content="Uni">
		<meta name="application-name" content="Uni">
		<meta name="msapplication-TileColor" content="#603cba">
		<meta name="msapplication-config" content="/library/images/favicon/browserconfig.xml">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		<?php $get_color =  get_field('set_theme_color_palete', 'option');
			$bc_colors = [
				'black' => '#010125',
				'gold' => '#010125',
				'lilac' => '#fefbfb',
				'default' => '#fefbfb'
			];
			$set_bc_color_key = in_array($get_color, $bc_colors) ? $get_color : 'default';
			$theme_color = $get_color .'_theme';
		?>
		<meta name="theme-color" content="<?php echo $bc_colors[$set_bc_color_key] ?>">
		<?php wp_head();  // end of wordpress head ?>
	</head>
	<body <?php body_class(['bc--white', $theme_color]); ?> itemscope itemtype="http://schema.org/WebPage">
		<div id="container">
		<?php uni_partial('parts/header/header', ['theme_color' => $get_color]); ?>
