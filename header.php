<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>	 
<?php wp_head(); ?>
</head>
	
<body <?php body_class();?> itemscope itemtype="http://schema.org/WebPage">
<header id="masthead" class="site-header" role="banner" itemscope itemtype="http://schema.org/WPHeader">	
<div id="top-bar" class="full-width">
	<hgroup>
	<div class="row">
<nav class="top-bar" itemscope itemtype="http://schema.org/SiteNavigationElement">
	<ul class="title-area">
		<li class="name"><a href="<?php echo site_url(); ?>"><h1 ><?php bloginfo('title'); ?></h1></a></li>
		<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
	</ul>
	<section class="top-bar-section">
		<?php flexfour_topbar_menu(array('theme_location' => 'topbar'));?></section>
</nav>
		</div></hgroup>	
		</div>
		
		<div class="row" id="title-row">
	<div class="large-12 small-12 columns">
	<hgroup>	
	<?php if (of_get_option('flexfour_logo_select', 'no entry')): ?>
	<div class="logo">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> ">
     <img src="<?php echo ( of_get_option( 'flexfour_logo', 'no entry' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
               </a>
                        </div>
                        <?php else : ?>
						<div class="logo-text">
	<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
</div>
<?php endif; ?>
	<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
		<?php endif; ?></hgroup>
</div>
			</div>
</header>		