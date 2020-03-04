<!doctype html>
<?php $colorTheme = get_option('bachelor_main_options')['display_theme']; ?>
<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="b-o-p no-js theme-<?php echo $colorTheme; ?>"><!--<![endif]-->

	<head>
		<?php if (get_option('bachelor_main_options')['google_analytics_ID']) { ?>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo get_option("bachelor_main_options")["google_analytics_ID"]; ?>"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', '<?php echo get_option("bachelor_main_options")["google_analytics_ID"]; ?>');
		</script>
		<?php } ?>

		<meta charset="utf-8">

		<?php // force Internet Explorer to use the latest rendering engine available ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title><?php wp_title('&ndash;'); ?></title>

		<?php // mobile meta (hooray!) ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>

		<?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-touch-icon-season-2.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<?php // or, set /favicon.ico for IE10 win ?>
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon-season-2.png">
        <meta name="theme-color" content="#121212">

		
		<meta property="og:title" content="<?php wp_title(' | '); ?>" />
		<?php /* if (is_front_page()) { ?>
		<meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/library/images/pme-og.jpg" />
		<?php } */ ?>
		<?php if (is_singular('people') && has_post_thumbnail(get_the_ID())) { ?>
		<meta property="og:image" content="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'og'); ?>" />
		<?php } else if (is_singular() && has_post_thumbnail(get_the_ID())) { ?>
		<meta property="og:image" content="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'og'); ?>" />
		<?php } else if (is_singular('episodes')) {
			$youtubeURL = get_post_meta(get_the_ID(),'_bachelor_episode_youtube_url',true); ?>
		<meta property="og:image" content="<?php echo $youtubeURL; ?>" />
		<?php } else { ?>
		<meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/library/images/pme-og-season-2.jpg" />
		<?php } ?>
		
		<?php if (is_front_page()) { ?>
		<meta name="description" content="<?php echo get_option('bachelor_main_options')['description']; ?>">
		<meta property="og:description" content="<?php echo get_option('bachelor_main_options')['description']; ?>" />
		<?php } else { ?>
		<meta name="description" content="<?php echo getExcerptOrDefaultDesc(get_the_ID()); ?>">
		<meta property="og:description" content="<?php echo getExcerptOrDefaultDesc(get_the_ID()); ?>" />
		<?php } ?>

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php // wordpress head functions ?>
		<?php wp_head(); ?>
		<?php // end of wordpress head ?>

		<?php // drop Google Analytics Here ?>
		<?php // end analytics ?>
		

	</head>
	<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
		<div id="container">
			<header class="header" role="banner" itemscope itemtype="http://schema.org/WPHeader">
				<div id="inner-header" class="wrap cf">
					<?php // to use a image just replace the bloginfo('name') with your img src and remove the surrounding <p> ?>
					<p id="logo" class="h1" itemscope itemtype="http://schema.org/Organization"><a href="<?php echo home_url(); ?>" rel="nofollow"><?php bloginfo('name'); ?></a></p>
					<a class="trigger-nav TRIGGER_NAV" href="#">
						<span class="ic">
							<span class="bar-1"></span>
							<span class="bar-2"></span>
							<span class="bar-3"></span>
						</span>
					</a>
					<?php // if you'd like to use the site description you can un-comment it below ?>
					<?php // bloginfo('description'); ?>
					<div class="main-nav-container MAIN_NAV">
						<nav class="main-menu" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
							<?php wp_nav_menu(array(
									 'container' => false,                           // remove nav container
									 'container_class' => 'menu cf',                 // class of container (should you choose to use it)
									 'menu' => __( 'The Main Menu', 'bonestheme' ),  // nav name
									 'menu_class' => 'nav top-nav cf',               // adding custom nav class
									 'theme_location' => 'main-nav',                 // where it's located in the theme
									 'before' => '',                                 // before the menu
									   'after' => '',                                  // after the menu
									   'link_before' => '',                            // before each link
									   'link_after' => '',                             // after each link
									   'depth' => 0,                                   // limit the depth of the nav
									 'fallback_cb' => ''                             // fallback function (if there is one)
							)); ?>
						</nav>
					</div>
				</div>
			</header>