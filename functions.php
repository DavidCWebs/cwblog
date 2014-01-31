<?php
/**
 *  Cwblog functions and definitions
 *
 * @package  Cwblog
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 750; /* pixels */

if ( ! function_exists( 'cwblog_setup' ) ) :
/**
 * Set up theme defaults and register support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function cwblog_setup() {
    global $cap, $content_width;

    // This theme styles the visual editor with editor-style.css to match the theme style.
    add_editor_style();

    if ( function_exists( 'add_theme_support' ) ) {

		/**
		 * Add default posts and comments RSS feed links to head
		*/
		add_theme_support( 'automatic-feed-links' );
		
		/**
		 * Enable support for Post Thumbnails on posts and pages
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		*/
		add_theme_support( 'post-thumbnails' );
		
		/**
		 * Enable support for Post Formats
		*/
		add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
		
		/**
		 * Setup the WordPress core custom background feature.
		*/
		add_theme_support( 'custom-background', apply_filters( 'cwblog_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );
	
    }

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on  Cwblog, use a find and replace
	 * to change 'cwblog' to the name of your theme in all the template files
	*/
	load_theme_textdomain( 'cwblog', get_template_directory() . '/languages' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	*/ 
    register_nav_menus( array(
        'primary'  => __( 'Header bottom menu', 'cwblog' ),
    ) );

}
endif; // cwblog_setup
add_action( 'after_setup_theme', 'cwblog_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function cwblog_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'cwblog' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'cwblog_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function cwblog_scripts() {

    // load bootstrap css
    wp_enqueue_style( ' Cwblog-bootstrap', get_template_directory_uri() . '/includes/resources/bootstrap/css/bootstrap.css' );

    // load  Cwblog styles
    wp_enqueue_style( ' Cwblog-style', get_stylesheet_uri() );

    // load bootstrap js
    wp_enqueue_script(' Cwblog-bootstrapjs', get_template_directory_uri().'/includes/resources/bootstrap/js/bootstrap.js', array('jquery') );

    // load bootstrap wp js
    wp_enqueue_script( ' Cwblog-bootstrapwp', get_template_directory_uri() . '/includes/js/bootstrap-wp.js', array('jquery') );

    wp_enqueue_script( ' Cwblog-skip-link-focus-fix', get_template_directory_uri() . '/includes/js/skip-link-focus-fix.js', array(), '20130115', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    if ( is_singular() && wp_attachment_is_image() ) {
        wp_enqueue_script( ' Cwblog-keyboard-image-navigation', get_template_directory_uri() . '/includes/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
    }

}
add_action( 'wp_enqueue_scripts', 'cwblog_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/includes/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/includes/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/includes/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/includes/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/includes/jetpack.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/includes/bootstrap-wp-navwalker.php';

/*====================================================================*/

/**FORCE MEDIUM IMAGE CROP**/

function add_force_crop() {


		if(false === get_option("medium_crop")) {
			add_option("medium_crop", "1");
		} else {
			update_option("medium_crop", "1");
		}
	}
	
add_action ('add_attachment','add_force_crop');

/*====================================================================*/

/* Custom Excerpt */
 
// Remove default hellip 
function carawebs_remove_hellip( $more ) {
	    return '';
	}
	
add_filter('excerpt_more', 'carawebs_remove_hellip');

// Control length
function carawebs_excerpt_length($length) {
	return 29;
}
add_filter('excerpt_length', 'carawebs_excerpt_length');
 
 
// Build a new excerpt with a nice Read More link

function carawebs_custom_excerpt() {
	
	$str = get_the_excerpt();
	
 	$trimmed = rtrim ( $str, ".,:;!?" );
 	
	
	echo $trimmed; ?>&hellip;<br><a href="<?php echo get_permalink();?>">Read More&nbsp;&raquo;</a><?php
 
}

/*====================================================================*/

add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );

/*====================================================================*/

/* Custom Post Type: Course */

add_action( 'init', 'register_cpt_course' );
 
function register_cpt_course() {
 
    $labels = array( 
        'name' => _x( 'Courses', 'course' ),
        'singular_name' => _x( 'Course', 'course' ),
        'add_new' => _x( 'Add New Course', 'course' ),
        'add_new_item' => _x( 'Add New Course', 'course' ),
        'edit_item' => _x( 'Edit Course', 'course' ),
        'new_item' => _x( 'New Course', 'course' ),
        'view_item' => _x( 'View Course', 'course' ),
        'search_items' => _x( 'Search Courses', 'course' ),
        'not_found' => _x( 'No courses found', 'course' ),
        'not_found_in_trash' => _x( 'No courses found in Trash', 'course' ),
        'parent_item_colon' => _x( 'Parent Course:', 'course' ),
        'menu_name' => _x( 'Courses', 'course' ),
    );
 
    $args = array( 
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'Custom Post Type for Courses',
        'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
        'taxonomies' => array( 'category', 'post_tag' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        
        
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );
 
    register_post_type( 'course', $args );
}

/* Simple Social Sharing Links */

function carawebs_simple_social(){
	
	$the_url = urlencode(get_permalink());
	$the_title = get_the_title();
	$the_image_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
	$desc = get_the_excerpt();
	
  ?>

  	<p>Share this:<br>
  	<a target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink());?>">Facebook</a>&nbsp;&#124;
  	<a target="_blank" href="https://plus.google.com/share?url={<?php echo urlencode(get_permalink());?>}" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">Google+</a>&nbsp;&#124;
  	<a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink());?>">LinkedIn</a>&nbsp;&#124;
  	<a target="_blank" href="http://pinterest.com/pin/create/button/?media=<?php echo $the_image_url; ?>&url=<?php echo $the_url; ?>&is_video=false&description=<?php echo get_the_title(); ?>">Pin It</a>&nbsp;&#124;
  	<a target="_blank" href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink());?>&amp;text=<?php echo get_the_title(); ?>">Twitter</a>&nbsp;&#124;
  	<a target="_blank" href="http://www.tumblr.com/share?v=3&u=<?php echo urlencode(get_permalink());?>&t=<?php echo get_the_title(); ?>">Tumblr</a>
  	</p>
	
	<?php
}


?>
