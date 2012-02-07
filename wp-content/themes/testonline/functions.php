<?php
/**
* Mon Feb 06, 2012 09:11:19 added by Thanh Son 
* Email: thanhson1085@gmail.com 
*/
if ( ! isset( $content_width ) )
$content_width = 584;

add_action( 'init', 'session_init' );
function session_init() {
  $labels = array(
    'name' => _x('Sessions', 'post type general name'),
    'singular_name' => _x('Session', 'post type singular name'),
    'add_new' => _x('Add New', 'session'),
    'add_new_item' => __('Add New Session'),
    'edit_item' => __('Edit Session'),
    'new_item' => __('New Session'),
    'all_items' => __('All Sessions'),
    'view_item' => __('View Session'),
    'search_items' => __('Search Sessions'),
    'not_found' =>  __('No sessions found'),
    'not_found_in_trash' => __('No sessions found in Trash'), 
    'parent_item_colon' => '',
    'menu_name' => 'Sessions'

  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => true,
    'menu_position' => null,
    'supports' => array( 'title', 'editor','custom-fields')
  ); 
  register_post_type('session',$args);
}

//add filter to ensure the text Question, or question, is displayed when user updates a question 
add_filter( 'post_updated_messages', 'session_updated_messages' );
function session_updated_messages( $messages ) {
  global $post, $post_ID;

  $messages['session'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Question updated. <a href="%s">View session</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Session updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Session restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Session published. <a href="%s">View session</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Question saved.'),
    8 => sprintf( __('Session submitted. <a target="_blank" href="%s">Preview session</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Session scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview session</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Session draft updated. <a target="_blank" href="%s">Preview session</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}

add_action( 'init', 'trial_question_init' );
function trial_question_init() {
  $labels = array(
    'name' => _x('Trial Questions', 'post type general name'),
    'singular_name' => _x('Trial Question', 'post type singular name'),
    'add_new' => _x('Add New', 'question'),
    'add_new_item' => __('Add New Question'),
    'edit_item' => __('Edit Question'),
    'new_item' => __('New Question'),
    'all_items' => __('All Questions'),
    'view_item' => __('View Question'),
    'search_items' => __('Search Questions'),
    'not_found' =>  __('No questions found'),
    'not_found_in_trash' => __('No questions found in Trash'), 
    'parent_item_colon' => '',
    'menu_name' => 'Exams'

  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => true,
    'menu_position' => null,
    'supports' => array( 'title', 'editor','custom-fields')
  ); 
  register_post_type('trial_question',$args);
}

//add filter to ensure the text Question, or question, is displayed when user updates a question 
add_filter( 'post_updated_messages', 'trial_question_updated_messages' );
function trial_question_updated_messages( $messages ) {
  global $post, $post_ID;

  $messages['trial_question'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Question updated. <a href="%s">View question</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Question updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Question restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Question published. <a href="%s">View question</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Question saved.'),
    8 => sprintf( __('Question submitted. <a target="_blank" href="%s">Preview question</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Question scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview question</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Question draft updated. <a target="_blank" href="%s">Preview question</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}
add_action( 'init', 'question_init' );
function question_init() {
  $labels = array(
    'name' => _x('Questions', 'post type general name'),
    'singular_name' => _x('Question', 'post type singular name'),
    'add_new' => _x('Add New', 'question'),
    'add_new_item' => __('Add New Question'),
    'edit_item' => __('Edit Question'),
    'new_item' => __('New Question'),
    'all_items' => __('All Questions'),
    'view_item' => __('View Question'),
    'search_items' => __('Search Questions'),
    'not_found' =>  __('No questions found'),
    'not_found_in_trash' => __('No questions found in Trash'), 
    'parent_item_colon' => '',
    'menu_name' => 'Demos'

  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => true,
    'menu_position' => null,
    'supports' => array( 'title', 'editor','custom-fields')
  ); 
  register_post_type('question',$args);
}

//add filter to ensure the text Question, or question, is displayed when user updates a question 
add_filter( 'post_updated_messages', 'question_updated_messages' );
function question_updated_messages( $messages ) {
  global $post, $post_ID;

  $messages['question'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Question updated. <a href="%s">View question</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Question updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Question restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Question published. <a href="%s">View question</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Question saved.'),
    8 => sprintf( __('Question submitted. <a target="_blank" href="%s">Preview question</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Question scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview question</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Question draft updated. <a target="_blank" href="%s">Preview question</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}

//display contextual help for Questions
add_action( 'contextual_help', 'question_add_help_text', 10, 3 );

function question_add_help_text( $contextual_help, $screen_id, $screen ) { 
  //$contextual_help .= var_dump( $screen ); // use this to help determine $screen->id
  if ( 'question' == $screen->id ) {
    $contextual_help =
      '<p>' . __('Things to remember when adding or editing a question:') . '</p>' .
      '<ul>' .
      '<li>' . __('Specify the correct genre such as Mystery, or Historic.') . '</li>' .
      '<li>' . __('Specify the correct subject of the question.  Remember that the Author module refers to you, the author of this question review.') . '</li>' .
      '</ul>' .
      '<p>' . __('If you want to schedule the question review to be published in the future:') . '</p>' .
      '<ul>' .
      '<li>' . __('Under the Publish module, click on the Edit link next to Publish.') . '</li>' .
      '<li>' . __('Change the date to the date to actual publish this article, then click on Ok.') . '</li>' .
      '</ul>' .
      '<p><strong>' . __('For more information:') . '</strong></p>' .
      '<p>' . __('<a href="http://codex.wordpress.org/Posts_Edit_SubPanel" target="_blank">Edit Posts Documentation</a>') . '</p>' .
      '<p>' . __('<a href="http://wordpress.org/support/" target="_blank">Support Forums</a>') . '</p>' ;
  } elseif ( 'edit-question' == $screen->id ) {
    $contextual_help = 
      '<p>' . __('This is the help screen displaying the table of questions blah blah blah.') . '</p>' ;
  }
  return $contextual_help;
}


add_action( 'init', 'create_question_taxonomies', 0 );

//create two taxonomies, genres and subjects for the post type "question"
function create_question_taxonomies() 
{

  $labels = array(
    'name' => _x( 'Classes', 'taxonomy general name' ),
    'singular_name' => _x( 'Class', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Classes' ),
    'popular_items' => __( 'Popular Classes' ),
    'all_items' => __( 'All Classes' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Class' ), 
    'update_item' => __( 'Update Class' ),
    'add_new_item' => __( 'Add New Class' ),
    'new_item_name' => __( 'New Class Name' ),
    'separate_items_with_commas' => __( 'Separate classes with commas' ),
    'add_or_remove_items' => __( 'Add or remove classes' ),
    'choose_from_most_used' => __( 'Choose from the most used classes' ),
    'menu_name' => __( 'Classs' ),
  ); 

  register_taxonomy('class',array('question','trial_question'),array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'class' ),
  ));
  /*register_taxonomy('class','trial_question',array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'class' ),
  ));
*/
  $labels = array(
    'name' => _x( 'Terms', 'taxonomy general name' ),
    'singular_name' => _x( 'Term', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Terms' ),
    'popular_items' => __( 'Popular Terms' ),
    'all_items' => __( 'All Terms' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Term' ), 
    'update_item' => __( 'Update Term' ),
    'add_new_item' => __( 'Add New Term' ),
    'new_item_name' => __( 'New Term Name' ),
    'separate_items_with_commas' => __( 'Separate terms with commas' ),
    'add_or_remove_items' => __( 'Add or remove terms' ),
    'choose_from_most_used' => __( 'Choose from the most used terms' ),
    'menu_name' => __( 'Terms' ),
  ); 

  register_taxonomy('term','question',array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'term' ),
  ));

  $labels = array(
    'name' => _x( 'Subjects', 'taxonomy general name' ),
    'singular_name' => _x( 'Subject', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Subjects' ),
    'popular_items' => __( 'Popular Subjects' ),
    'all_items' => __( 'All Subjects' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Subject' ), 
    'update_item' => __( 'Update Subject' ),
    'add_new_item' => __( 'Add New Subject' ),
    'new_item_name' => __( 'New Subject Name' ),
    'separate_items_with_commas' => __( 'Separate subjects with commas' ),
    'add_or_remove_items' => __( 'Add or remove subjects' ),
    'choose_from_most_used' => __( 'Choose from the most used subjects' ),
    'menu_name' => __( 'Subjects' ),
  ); 

  register_taxonomy('subject',array('question','trial_question'),array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'subject' ),
  ));
  register_taxonomy('hidden_term',array('question','session'),array(
    'hierarchical' => true,
    'show_ui' => false,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'hidden_term' ),
  ));

add_action('restrict_manage_posts','my_restrict_manage_posts');

function my_restrict_manage_posts() {
	global $typenow;

	if ($typenow=='question'){
		 $args = array(
			 'show_option_all' => "Show All Subjects",
			 'taxonomy'        => 'subject',
			 'name'               => 'subject'

		 );
		wp_dropdown_categories($args);
	}
}
add_action( 'request', 'my_request' );
function my_request($request) {
	if (is_admin() && $GLOBALS['PHP_SELF'] == '/wp-admin/edit.php' && isset($request['post_type']) && $request['post_type']=='question') {
		$request['term'] = get_term($request['subject'],'subject')->name;
	}
	return $request;
}

/*
  register_taxonomy('subject','trial_question',array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'subject' ),
  ));
*/
}
/*
add_action('add_meta_boxes','mysite_add_meta_boxes',10,2);
function mysite_add_meta_boxes($post_type, $post) {
  ob_start();
}
add_action('dbx_post_sidebar','mysite_dbx_post_sidebar');
function mysite_dbx_post_sidebar() {
  $html = ob_get_clean();
  $html = str_replace('"checkbox"','"radio"',$html);
  echo $html;
}
*/
/*add_action( 'init', 'mfields_remove_div' );
if( !function_exists( 'mfields_remove_div' ) ) {
    function mfields_remove_div() {
        print '
            <style type="text/css">
                #minor-publishing{
                    display:none;
                }
            </style>';
    }
}*/
function add_session_category_automatically($post_ID) {
    global $wpdb;
	$term = wp_insert_term(
	  $post_ID, // the term 
	  'hidden_term', // the taxonomy
	  array(
		'slug' => 'hidden-'.$post_ID,
		'parent'=> '0',
	  )
	);
    //if(!has_term('','subject',$post_ID)){
        //$hidden_term = get_term_by( 'slug', 'session', 'subject' );
        $term_slug = array('hidden-'.$post_ID);
        wp_set_object_terms($post_ID, $term_slug, 'hidden_term');
    //}
}
add_action('publish_session', 'add_session_category_automatically');

add_action( 'after_setup_theme', 'twentyeleven_setup' );
if ( ! function_exists( 'twentyeleven_setup' ) ):
/**
* Sets up theme defaults and registers support for various WordPress features.
*
* Note that this function is hooked into the after_setup_theme hook, which runs
* before the init hook. The init hook is too late for some features, such as indicating
* support post thumbnails.
*
* To override twentyeleven_setup() in a child theme, add your own twentyeleven_setup to your child theme's
* functions.php file.
*
* @uses load_theme_textdomain() For translation/localization support.
* @uses add_editor_style() To style the visual editor.
* @uses add_theme_support() To add support for post thumbnails, automatic feed links, and Post Formats.
* @uses register_nav_menus() To add support for navigation menus.
* @uses add_custom_background() To add support for a custom background.
* @uses add_custom_image_header() To add support for a custom header.
* @uses register_default_headers() To register the default custom header images provided with the theme.
* @uses set_post_thumbnail_size() To set a custom post thumbnail size.
*
* @since Twenty Eleven 1.0
*/
function twentyeleven_setup() {

/* Make Twenty Eleven available for translation.
 * Translations can be added to the /languages/ directory.
 * If you're building a theme based on Twenty Eleven, use a find and replace
 * to change 'twentyeleven' to the name of your theme in all the template files.
 */
load_theme_textdomain( 'twentyeleven', get_template_directory() . '/languages' );

$locale = get_locale();
$locale_file = get_template_directory() . "/languages/$locale.php";
if ( is_readable( $locale_file ) )
	require_once( $locale_file );

// This theme styles the visual editor with editor-style.css to match the theme style.
add_editor_style();

// Load up our theme options page and related code.
require( get_template_directory() . '/inc/theme-options.php' );

// Grab Twenty Eleven's Ephemera widget.
require( get_template_directory() . '/inc/widgets.php' );

// Add default posts and comments RSS feed links to <head>.
add_theme_support( 'automatic-feed-links' );

// This theme uses wp_nav_menu() in one location.
register_nav_menu( 'primary', __( 'Primary Menu', 'twentyeleven' ) );

// Add support for a variety of post formats
add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );

// Add support for custom backgrounds
add_custom_background();

// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
add_theme_support( 'post-thumbnails' );

// The next four constants set how Twenty Eleven supports custom headers.

// The default header text color
define( 'HEADER_TEXTCOLOR', '000' );

// By leaving empty, we allow for random image rotation.
define( 'HEADER_IMAGE', '' );

// The height and width of your custom header.
// Add a filter to twentyeleven_header_image_width and twentyeleven_header_image_height to change these values.
define( 'HEADER_IMAGE_WIDTH', apply_filters( 'twentyeleven_header_image_width', 1000 ) );
define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'twentyeleven_header_image_height', 288 ) );

// We'll be using post thumbnails for custom header images on posts and pages.
// We want them to be the size of the header image that we just defined
// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

// Add Twenty Eleven's custom image sizes
add_image_size( 'large-feature', HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true ); // Used for large feature (header) images
add_image_size( 'small-feature', 500, 300 ); // Used for featured posts if a large-feature doesn't exist

// Turn on random header image rotation by default.
add_theme_support( 'custom-header', array( 'random-default' => true ) );

// Add a way for the custom header to be styled in the admin panel that controls
// custom headers. See twentyeleven_admin_header_style(), below.
add_custom_image_header( 'twentyeleven_header_style', 'twentyeleven_admin_header_style', 'twentyeleven_admin_header_image' );

// ... and thus ends the changeable header business.

// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
register_default_headers( array(
	'wheel' => array(
		'url' => '%s/images/headers/wheel.jpg',
		'thumbnail_url' => '%s/images/headers/wheel-thumbnail.jpg',
		/* translators: header image description */
		'description' => __( 'Wheel', 'twentyeleven' )
	),
	'shore' => array(
		'url' => '%s/images/headers/shore.jpg',
		'thumbnail_url' => '%s/images/headers/shore-thumbnail.jpg',
		/* translators: header image description */
		'description' => __( 'Shore', 'twentyeleven' )
	),
	'trolley' => array(
		'url' => '%s/images/headers/trolley.jpg',
		'thumbnail_url' => '%s/images/headers/trolley-thumbnail.jpg',
		/* translators: header image description */
		'description' => __( 'Trolley', 'twentyeleven' )
	),
	'pine-cone' => array(
		'url' => '%s/images/headers/pine-cone.jpg',
		'thumbnail_url' => '%s/images/headers/pine-cone-thumbnail.jpg',
		/* translators: header image description */
		'description' => __( 'Pine Cone', 'twentyeleven' )
	),
	'chessboard' => array(
		'url' => '%s/images/headers/chessboard.jpg',
		'thumbnail_url' => '%s/images/headers/chessboard-thumbnail.jpg',
		/* translators: header image description */
		'description' => __( 'Chessboard', 'twentyeleven' )
	),
	'lanterns' => array(
		'url' => '%s/images/headers/lanterns.jpg',
		'thumbnail_url' => '%s/images/headers/lanterns-thumbnail.jpg',
		/* translators: header image description */
		'description' => __( 'Lanterns', 'twentyeleven' )
	),
	'willow' => array(
		'url' => '%s/images/headers/willow.jpg',
		'thumbnail_url' => '%s/images/headers/willow-thumbnail.jpg',
		/* translators: header image description */
		'description' => __( 'Willow', 'twentyeleven' )
	),
	'hanoi' => array(
		'url' => '%s/images/headers/hanoi.jpg',
		'thumbnail_url' => '%s/images/headers/hanoi-thumbnail.jpg',
		/* translators: header image description */
		'description' => __( 'Hanoi Plant', 'twentyeleven' )
	)
) );
}
endif; // twentyeleven_setup

if ( ! function_exists( 'twentyeleven_header_style' ) ) :
/**
* Styles the header image and text displayed on the blog
*
* @since Twenty Eleven 1.0
*/
function twentyeleven_header_style() {

// If no custom options for text are set, let's bail
// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
if ( HEADER_TEXTCOLOR == get_header_textcolor() )
	return;
// If we get this far, we have custom styles. Let's do this.
?>
<style type="text/css">
<?php
	// Has the text been hidden?
	if ( 'blank' == get_header_textcolor() ) :
?>
	#site-title,
	#site-description {
		position: absolute !important;
		clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
		clip: rect(1px, 1px, 1px, 1px);
	}
<?php
	// If the user has set a custom color for the text use that
	else :
?>
	#site-title a,
	#site-description {
		color: #<?php echo get_header_textcolor(); ?> !important;
	}
<?php endif; ?>
</style>
<?php
}
endif; // twentyeleven_header_style

if ( ! function_exists( 'twentyeleven_admin_header_style' ) ) :
/**
* Styles the header image displayed on the Appearance > Header admin panel.
*
* Referenced via add_custom_image_header() in twentyeleven_setup().
*
* @since Twenty Eleven 1.0
*/
function twentyeleven_admin_header_style() {
?>
<style type="text/css">
.appearance_page_custom-header #headimg {
	border: none;
}
#headimg h1,
#desc {
	font-family: "Helvetica Neue", Arial, Helvetica, "Nimbus Sans L", sans-serif;
}
#headimg h1 {
	margin: 0;
}
#headimg h1 a {
	font-size: 32px;
	line-height: 36px;
	text-decoration: none;
}
#desc {
	font-size: 14px;
	line-height: 23px;
	padding: 0 0 3em;
}
<?php
	// If the user has set a custom color for the text use that
	if ( get_header_textcolor() != HEADER_TEXTCOLOR ) :
?>
	#site-title a,
	#site-description {
		color: #<?php echo get_header_textcolor(); ?>;
	}
<?php endif; ?>
#headimg img {
	max-width: 1000px;
	height: auto;
	width: 100%;
}
</style>
<?php
}
endif; // twentyeleven_admin_header_style

if ( ! function_exists( 'twentyeleven_admin_header_image' ) ) :
/**
* Custom header image markup displayed on the Appearance > Header admin panel.
*
* Referenced via add_custom_image_header() in twentyeleven_setup().
*
* @since Twenty Eleven 1.0
*/
function twentyeleven_admin_header_image() { ?>
<div id="headimg">
	<?php
	if ( 'blank' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) || '' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) )
		$style = ' style="display:none;"';
	else
		$style = ' style="color:#' . get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) . ';"';
	?>
	<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
	<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
	<?php $header_image = get_header_image();
	if ( ! empty( $header_image ) ) : ?>
		<img src="<?php echo esc_url( $header_image ); ?>" alt="" />
	<?php endif; ?>
</div>
<?php }
endif; // twentyeleven_admin_header_image

/**
* Sets the post excerpt length to 40 words.
*
* To override this length in a child theme, remove the filter and add your own
* function tied to the excerpt_length filter hook.
*/
function twentyeleven_excerpt_length( $length ) {
return 40;
}
add_filter( 'excerpt_length', 'twentyeleven_excerpt_length' );

/**
* Returns a "Continue Reading" link for excerpts
*/
function twentyeleven_continue_reading_link() {
return ' <a href="'. esc_url( get_permalink() ) . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) . '</a>';
}

/**
* Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and twentyeleven_continue_reading_link().
*
* To override this in a child theme, remove the filter and add your own
* function tied to the excerpt_more filter hook.
*/
function twentyeleven_auto_excerpt_more( $more ) {
return ' &hellip;' . twentyeleven_continue_reading_link();
}
add_filter( 'excerpt_more', 'twentyeleven_auto_excerpt_more' );

/**
* Adds a pretty "Continue Reading" link to custom post excerpts.
*
* To override this link in a child theme, remove the filter and add your own
* function tied to the get_the_excerpt filter hook.
*/
function twentyeleven_custom_excerpt_more( $output ) {
if ( has_excerpt() && ! is_attachment() ) {
	$output .= twentyeleven_continue_reading_link();
}
return $output;
}
add_filter( 'get_the_excerpt', 'twentyeleven_custom_excerpt_more' );

/**
* Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
*/
function twentyeleven_page_menu_args( $args ) {
$args['show_home'] = true;
return $args;
}
add_filter( 'wp_page_menu_args', 'twentyeleven_page_menu_args' );

/**
* Register our sidebars and widgetized areas. Also register the default Epherma widget.
*
* @since Twenty Eleven 1.0
*/
function twentyeleven_widgets_init() {

register_widget( 'Twenty_Eleven_Ephemera_Widget' );

register_sidebar( array(
	'name' => __( 'Main Sidebar', 'twentyeleven' ),
	'id' => 'sidebar-1',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => "</aside>",
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
) );

register_sidebar( array(
	'name' => __( 'Showcase Sidebar', 'twentyeleven' ),
	'id' => 'sidebar-2',
	'description' => __( 'The sidebar for the optional Showcase Template', 'twentyeleven' ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => "</aside>",
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
) );

register_sidebar( array(
	'name' => __( 'Footer Area One', 'twentyeleven' ),
	'id' => 'sidebar-3',
	'description' => __( 'An optional widget area for your site footer', 'twentyeleven' ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => "</aside>",
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
) );

register_sidebar( array(
	'name' => __( 'Footer Area Two', 'twentyeleven' ),
	'id' => 'sidebar-4',
	'description' => __( 'An optional widget area for your site footer', 'twentyeleven' ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => "</aside>",
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
) );

register_sidebar( array(
	'name' => __( 'Footer Area Three', 'twentyeleven' ),
	'id' => 'sidebar-5',
	'description' => __( 'An optional widget area for your site footer', 'twentyeleven' ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => "</aside>",
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
) );
}
add_action( 'widgets_init', 'twentyeleven_widgets_init' );

if ( ! function_exists( 'twentyeleven_content_nav' ) ) :
/**
* Display navigation to next/previous pages when applicable
*/
function twentyeleven_content_nav( $nav_id ) {
global $wp_query;

if ( $wp_query->max_num_pages > 1 ) : ?>
	<nav id="<?php echo $nav_id; ?>">
		<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentyeleven' ); ?></h3>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentyeleven' ) ); ?></div>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) ); ?></div>
	</nav><!-- #nav-above -->
<?php endif;
}
endif; // twentyeleven_content_nav

/**
* Return the URL for the first link found in the post content.
*
* @since Twenty Eleven 1.0
* @return string|bool URL or false when no link is present.
*/
function twentyeleven_url_grabber() {
if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )
	return false;

return esc_url_raw( $matches[1] );
}

/**
* Count the number of footer sidebars to enable dynamic classes for the footer
*/
function twentyeleven_footer_sidebar_class() {
$count = 0;

if ( is_active_sidebar( 'sidebar-3' ) )
	$count++;

if ( is_active_sidebar( 'sidebar-4' ) )
	$count++;

if ( is_active_sidebar( 'sidebar-5' ) )
	$count++;

$class = '';

switch ( $count ) {
	case '1':
		$class = 'one';
		break;
	case '2':
		$class = 'two';
		break;
	case '3':
		$class = 'three';
		break;
}

if ( $class )
	echo 'class="' . $class . '"';
}

if ( ! function_exists( 'twentyeleven_comment' ) ) :
/**
* Template for comments and pingbacks.
*
* To override this walker in a child theme without modifying the comments template
* simply create your own twentyeleven_comment(), and that function will be used instead.
*
* Used as a callback by wp_list_comments() for displaying the comments.
*
* @since Twenty Eleven 1.0
*/
function twentyeleven_comment( $comment, $args, $depth ) {
$GLOBALS['comment'] = $comment;
switch ( $comment->comment_type ) :
	case 'pingback' :
	case 'trackback' :
?>
<li class="post pingback">
	<p><?php _e( 'Pingback:', 'twentyeleven' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?></p>
<?php
		break;
	default :
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	<article id="comment-<?php comment_ID(); ?>" class="comment">
		<footer class="comment-meta">
			<div class="comment-author vcard">
				<?php
					$avatar_size = 68;
					if ( '0' != $comment->comment_parent )
						$avatar_size = 39;

					echo get_avatar( $comment, $avatar_size );

					/* translators: 1: comment author, 2: date and time */
					printf( __( '%1$s on %2$s <span class="says">said:</span>', 'twentyeleven' ),
						sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
						sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
							esc_url( get_comment_link( $comment->comment_ID ) ),
							get_comment_time( 'c' ),
							/* translators: 1: date, 2: time */
							sprintf( __( '%1$s at %2$s', 'twentyeleven' ), get_comment_date(), get_comment_time() )
						)
					);
				?>

				<?php edit_comment_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
			</div><!-- .comment-author .vcard -->

			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentyeleven' ); ?></em>
				<br />
			<?php endif; ?>

		</footer>

		<div class="comment-content"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'twentyeleven' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</article><!-- #comment-## -->

<?php
		break;
endswitch;
}
endif; // ends check for twentyeleven_comment()

if ( ! function_exists( 'twentyeleven_posted_on' ) ) :
/**
* Prints HTML with meta information for the current post-date/time and author.
* Create your own twentyeleven_posted_on to override in a child theme
*
* @since Twenty Eleven 1.0
*/
function twentyeleven_posted_on() {
printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="questionmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'twentyeleven' ),
	esc_url( get_permalink() ),
	esc_attr( get_the_time() ),
	esc_attr( get_the_date( 'c' ) ),
	esc_html( get_the_date() ),
	esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
	esc_attr( sprintf( __( 'View all posts by %s', 'twentyeleven' ), get_the_author() ) ),
	get_the_author()
);
}
endif;

/**
* Adds two classes to the array of body classes.
* The first is if the site has only had one author with published posts.
* The second is if a singular post being displayed
*
* @since Twenty Eleven 1.0
*/
function twentyeleven_body_classes( $classes ) {

if ( function_exists( 'is_multi_author' ) && ! is_multi_author() )
	$classes[] = 'single-author';

if ( is_singular() && ! is_home() && ! is_page_template( 'showcase.php' ) && ! is_page_template( 'sidebar-page.php' ) )
		$classes[] = 'singular';

	return $classes;
}
add_filter( 'body_class', 'twentyeleven_body_classes' );

