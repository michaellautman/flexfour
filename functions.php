<?php

//Set Up The Theme
function flexfour_setup(){

load_theme_textdomain( 'twentytwelve', get_template_directory() . '/lang' );
add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-background', array(
		'default-color' => 'e6e6e6',
	) );
	add_theme_support( 'custom-header' );
	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop
		add_theme_support( 'menus' );            // wp menus
}

add_action( 'after_setup_theme', 'flexfour_setup' );
//Set Up the Custom Header
require( get_template_directory() . '/inc/custom-header.php' );
//Load the Options Panel
require ( get_template_directory(). '/options.php' );
add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('#flexfour_logo_select').click(function() {
  		jQuery('#section-flexfour_logo').fadeToggle(400);
	});
	
	if (jQuery('#flexfour_logo_select:checked').val() !== undefined) {
		jQuery('#section-flexfour_logo').show();
	}
	
});
</script>
 
<?php
}

if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
	require_once dirname( __FILE__ ) . '/inc/options-framework.php';
}



//Set Up The Page Title
function flexfour_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'flexfour' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'flexfour_wp_title', 10, 2 );
//remove sticky class from featured post
function flexfour_remove_sticky_class($classes) {
$classes = array_diff($classes, array("sticky"));
return $classes;
}
add_filter('post_class','flexfour_remove_sticky_class');

//set the content width
if ( ! isset( $content_width ) )
	$content_width = 1140;

//Add The CSS 
function flexfour_add_css(){
	
	wp_enqueue_style('flex-css', get_stylesheet_uri() );
	

wp_enqueue_style('foundations-css', get_template_directory_uri() . '/css/foundation.min.css');

	wp_enqueue_style('normailze-css',get_template_directory_uri () . '/css/normalize.min.css');
}
add_action ('wp_enqueue_scripts','flexfour_add_css');

//Add The Javascript

function flexfour_add_js (){
wp_register_script('foundation-modernizr', get_template_directory_uri() .'/js/vendor/custom.modernizr.js', array(),  false);
wp_enqueue_script('foundation-modernizr');
wp_register_script('foundation-js', get_template_directory_uri() .'/js/foundation.min.js', __FILE__, array(),  true);
wp_enqueue_script('foundation-js');
wp_register_script('foundation-zepto', get_template_directory_uri() .'/js/vendor/zepto.js', __FILE__, array(), true);
wp_enqueue_script('foundation-zepto');

}
add_action ('wp_enqueue_scripts', 'flexfour_add_js');

// remove wp version param from any enqueued scripts
function flexfour_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' . get_bloginfo( 'version' ) ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'flexfour_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'flexfour_remove_wp_ver_css_js', 9999 );
//Create the Menu
function flexfour_register_menus(){
register_nav_menu(
	'topbar', __('Top Menu Bar','flexfour'));
}
add_action ('init','flexfour_register_menus');

//Setup The Menus to Work With Foundation
//Add the "right" class to the menu 
function flexfour_topbar_menu() {
	// display the wp3 menu if available
 wp_nav_menu( 
	array( 
	'menu' => 'topbar', /* menu name */
		'menu_class' => 'right',
		'theme_location' => 'topbar', /* where in the theme it's assigned */
		'container' => 'false', /* container tag */
		'fallback_cb' => 'wp_page_menu', /* menu fallback */
		'depth' => '2',
		
 	)
 );
}
//Add the "dropdown" class to submenu
function flexfour_submenu_add_dropdown($text){
        $replace = array(
                //List of menu item classes that should be changed to "active"
            
				'sub-menu' =>'dropdown',
        );
        $text = str_replace(array_keys($replace), $replace, $text);
                return $text;
        }
add_filter ('wp_nav_menu','flexfour_submenu_add_dropdown');

//Add "has-dropdown" class to parent menu items
add_filter('wp_nav_menu_objects', function ($items) {
    $hasSub = function ($menu_item_id, &$items) {
        foreach ($items as $item) {
            if ($item->menu_item_parent && $item->menu_item_parent==$menu_item_id) {
                return true;
            }
        }
        return false;
    };

    foreach ($items as &$item) {
        if ($hasSub($item->ID, &$items)) {
            $item->classes[] = 'has-dropdown';
			// all elements of field "classes" of a menu item get join together and render to class attribute of 
			// element in HTML
        }
    }
    return $items;    
});

function flexfour_wp_nav_menu($var) {
        return is_array($var) ? array_intersect($var, array(
                //List of allowed menu classes
                'current_page_item',
                'current_page_parent',
                'current_page_ancestor',
                'first',
                'last',
                'vertical',
                'horizontal',
				'has-dropdown',
				'dropdown',
				'active',
				'menu-item'
				
                )
        ) : '';
}
add_filter('nav_menu_css_class', 'flexfour_wp_nav_menu');
add_filter('nav_menu_item_id', 'flexfour_wp_nav_menu');
add_filter('page_css_class', 'flexfour_wp_nav_menu');

//Create The Sidebars
register_sidebar(array(
		'name'=> 'Right Sidebar',
		'id' => 'right-sidebar',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'name'=> 'Footer Area 1',
		'id' => 'footer-1',
		'before_widget' => '<div id="%1$s" class=" %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
		register_sidebar(array(
		'name'=> 'Footer Area 2',
		'id' => 'footer-2',
		'before_widget' => '<div id="%1$s" class=" %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
		register_sidebar(array(
		'name'=> 'Footer Area 3',
		'id' => 'footer-3',
		'before_widget' => '<div id="%1$s" class=" %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));

//Comments

if ( ! function_exists( 'flexfour_content_nav' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since Twenty Twelve 1.0
 */
function flexfour_content_nav( $html_id ) {
	global $wp_query;

	$html_id = esc_attr( $html_id );

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'flexfour' ); ?></h3>
			<div class="nav-previous alignleft"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'flexfour' ) ); ?></div>
			<div class="nav-next alignright"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'flexfour' ) ); ?></div>
		</nav><!-- #<?php echo $html_id; ?> .navigation -->
	<?php endif;
}
endif;


if ( ! function_exists( 'flexfour_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
*/
function flexfour_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'flexfour' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'flexfour' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					
					printf( '<cite class="fn">%1$s %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author', 'flexfour' ) . '</span>' : ''
					);
					printf( '<a href="%1$s"><time datetime="%2$s" itemprop="commentTime">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'twentytwelve' ), get_comment_date(), get_comment_time() )
					);
				?>
			</header><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'flexfour' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment" itemprop="commentText">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'flexfour' ), '<p class="edit-link">', '</p>' ); ?>
			</section><!-- .comment-content -->

			<div class="reply" itemprop="replyToUrl">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'flexfour' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
	
	}
endif;