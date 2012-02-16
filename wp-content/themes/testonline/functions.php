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
    'supports' => array( 'title')
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
    'menu_name' => 'Quizzs'

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


add_action( 'init', 'trial_question_init' );
function trial_question_init() {
  $labels = array(
    'name' => _x('Demo Exams', 'post type general name'),
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
    'menu_name' => 'Demo Exams'

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

  register_taxonomy('class',array('question','trial_question','session'),array(
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

  register_taxonomy('term',array('trial_question','question','session'),array(
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

  register_taxonomy('subject',array('question','trial_question','session'),array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'subject' ),
  ));
  
  $labels = array(
    'name' => _x( 'Time', 'taxonomy general name' ),
    'singular_name' => _x( 'Time', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Times' ),
    'popular_items' => __( 'Popular Times' ),
    'all_items' => __( 'All Times' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Time' ), 
    'update_item' => __( 'Update Time' ),
    'add_new_item' => __( 'Add New Time' ),
    'new_item_name' => __( 'New Time Name' ),
    'separate_items_with_commas' => __( 'Separate times with commas' ),
    'add_or_remove_items' => __( 'Add or remove times' ),
    'choose_from_most_used' => __( 'Choose from the most used times' ),
    'menu_name' => __( 'Times' ),
  ); 

  register_taxonomy('time',array('session'),array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'subject' ),
  ));
  $labels = array(
    'name' => _x( 'Level', 'taxonomy general name' ),
    'singular_name' => _x( 'Level', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Levels' ),
    'popular_items' => __( 'Popular Levels' ),
    'all_items' => __( 'All Levels' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Level' ), 
    'update_item' => __( 'Update Level' ),
    'add_new_item' => __( 'Add New Level' ),
    'new_item_name' => __( 'New Level Name' ),
    'separate_items_with_commas' => __( 'Separate levels with commas' ),
    'add_or_remove_items' => __( 'Add or remove levels' ),
    'choose_from_most_used' => __( 'Choose from the most used levels' ),
    'menu_name' => __( 'Levels' ),
  ); 

  register_taxonomy('level',array('question'),array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'subject' ),
  ));
  $labels = array(
    'name' => _x( 'Mark', 'taxonomy general name' ),
    'singular_name' => _x( 'Mark', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Marks' ),
    'popular_items' => __( 'Popular Marks' ),
    'all_items' => __( 'All Marks' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Mark' ), 
    'update_item' => __( 'Update Mark' ),
    'add_new_item' => __( 'Add New Mark' ),
    'new_item_name' => __( 'New Mark Name' ),
    'separate_items_with_commas' => __( 'Separate marks with commas' ),
    'add_or_remove_items' => __( 'Add or remove makrs' ),
    'choose_from_most_used' => __( 'Choose from the most used marks' ),
    'menu_name' => __( 'Marks' ),
  ); 

  register_taxonomy('mark',array('session'),array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'subject' ),
  ));
  $labels = array(
    'name' => _x( 'Sessions', 'taxonomy general name' ),
    'singular_name' => _x( 'Session', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Sessions' ),
    'popular_items' => __( 'Popular Sessions' ),
    'all_items' => __( 'All Sessions' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Session' ), 
    'update_item' => __( 'Update Session' ),
    'add_new_item' => __( 'Add New Session' ),
    'new_item_name' => __( 'New Session Name' ),
    'separate_items_with_commas' => __( 'Separate marks with commas' ),
    'add_or_remove_items' => __( 'Add or remove Sessions' ),
    'choose_from_most_used' => __( 'Choose from the most used sessions' ),
    'menu_name' => __( 'Sessions' ),
  ); 
  register_taxonomy('hidden_term',array('question'),array(
    'hierarchical' => true,
	'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'hidden_term' ),
  ));
  $labels = array(
    'name' => _x( 'Types', 'taxonomy general name' ),
    'singular_name' => _x( 'Type', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Types' ),
    'popular_items' => __( 'Popular Types' ),
    'all_items' => __( 'All Types' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Type' ), 
    'update_item' => __( 'Update Type' ),
    'add_new_item' => __( 'Add New Type' ),
    'new_item_name' => __( 'New Type Name' ),
    'separate_items_with_commas' => __( 'Separate marks with commas' ),
    'add_or_remove_items' => __( 'Add or remove Types' ),
    'choose_from_most_used' => __( 'Choose from the most used types' ),
    'menu_name' => __( 'Types' ),
  ); 
  register_taxonomy('type',array('trial_question','question'),array(
    'hierarchical' => true,
	'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'type' ),
  ));

/*add_action('restrict_manage_posts','my_restrict_manage_posts');
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
*/
/*add_action( 'request', 'my_request' );
function my_request($request) {
	if (is_admin() && $GLOBALS['PHP_SELF'] == '/wp-admin/edit.php' && isset($request['post_type']) && $request['post_type']=='question') {
		$request['term'] = get_term($request['subject'],'subject')->name;
	}
	return $request;
}
*/
add_action( 'restrict_manage_posts', 'my_restrict_manage_posts' );
function my_restrict_manage_posts() {
	global $typenow;
	$taxonomies = array('term','class','subject');//$typenow.'_type';
	if( $typenow == "question" || $typenow == "trial_question" || $typenow == "session" ){
		foreach ($taxonomies as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
			echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
			echo "<option value=''>Show All $tax_name</option>";
			foreach ($terms as $term) { echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>'; }
			echo "</select>";
		}
	}
}
// disable default dashboard widgets
function disable_default_dashboard_widgets() {

	remove_meta_box('dashboard_right_now', 'dashboard', 'core');
	remove_meta_box('dashboard_right_now', 'dashboard', 'core');
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
	remove_meta_box('dashboard_plugins', 'dashboard', 'core');

	remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
	remove_meta_box('dashboard_primary', 'dashboard', 'core');
	remove_meta_box('dashboard_secondary', 'dashboard', 'core');
}
add_action('admin_menu', 'disable_default_dashboard_widgets');

add_action( 'load-index.php', 'hide_welcome_panel' );

function hide_welcome_panel() {
    $user_id = get_current_user_id();

    if ( 1 == get_user_meta( $user_id, 'show_welcome_panel', true ) )
        update_user_meta( $user_id, 'show_welcome_panel', 0 );
}

// Hide admin 'Screen Options' tab
function remove_screen_options_tab()
{
    return false;
}
add_filter('screen_options_show_screen', 'remove_screen_options_tab');


// Session Page

/* Define the custom box */

/*add_action( 'add_meta_boxes', 'myplugin_add_custom_box' );

add_action( 'save_post', 'myplugin_save_postdata' );

function myplugin_add_custom_box() {
    add_meta_box( 
        'myplugin_sectionid',
        __( 'Session Info', 'session_info' ),
        'myplugin_inner_custom_box',
        'session' 
    );
}

function myplugin_inner_custom_box( $post ) {

  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'myplugin_noncename' );
  $meta_values = get_post_meta($post->ID, '_myplugin_new_field', true);

  // The actual fields for data entry
  echo '<label for="range_time_field">';
       _e("Time of Session", 'session_info' );
  echo '</label> ';
  echo '<input type="text" id="range_time_field" name="range_time_field" value="'.$meta_values.'" size="25" />';
}
*/

/* When the post is saved, saves our custom data */
/*function myplugin_save_postdata( $post_id ) {
   global $typenow;
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;

  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times

  if ( !wp_verify_nonce( $_POST['myplugin_noncename'], plugin_basename( __FILE__ ) ) )
      return;

  // OK, we're authenticated: we need to find and save the data

  $mydata = $_POST['range_time_field'];
  
  if ($typenow == 'session') update_post_meta($post_id,'_range_time_field',$mydata);
  // Do something with $mydata 
  // probably using add_post_meta(), update_post_meta(), or 
  // a custom table (see Further Reading section below)
}
*/
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
	$term = term_exists('hidden-'.$post_ID,'hidden_term');
	if (!$term){
		$term = wp_insert_term(
		get_the_title($post_ID), // the term 
		'hidden_term', // the taxonomy
		array(
		'slug' => 'hidden-'.$post_ID,
		'parent'=> '0',
		)
		);
	
		$term_slug = array('hidden-'.$post_ID);
		wp_set_object_terms($post_ID, $term_slug, 'hidden_term');
	}
	else{
		wp_update_term($term['term_id'],'hidden_term', array ('name' => get_the_title($post_ID)));
	}
}
add_action('publish_session', 'add_session_category_automatically');

function delete_session_category_automatically($post_ID){
    global $wpdb;
    $term = get_term_by('slug','hidden-'.$post_ID,'hidden_term');
    wp_delete_term($term->term_id,'hidden_term');
}

add_action('before_delete_post', 'delete_session_category_automatically');
//function remove_those_menu_items(){
    //remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=hidden_term&post_type=session' );
//}

//add_filter( 'admin_menu', 'remove_those_menu_items' );
add_filter( 'show_admin_bar', '__return_false' );
function remove_menus () {
global $menu;
    $restricted = array(__('Quizzs'),__('Sessions'),__('Demo'),__('Dashboard'), __('Posts'), __('Media'), __('Links'), __('Pages'), __('Appearance'), __('Tools'), __('Users'), __('Settings'), __('Comments'), __('Plugins'));
    end ($menu);
    while (prev($menu)){
        $value = explode(' ',$menu[key($menu)][0]);
        if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
    }
}
add_action('admin_menu', 'remove_menus');


function get_posts_by_taxonomy($args) {
global $wpdb;
if ( is_array($args) )
    $options = &$args;
else
    parse_str($args, $options);
    $defaults = array(
    'post_type' => null,
    'post_status' => 'publish',
    'taxonomy_name' => null,
    'taxonomy_term' => null,
    'orderby' => 'post_date',
    'order' => 'DESC',
    'numberposts' => '10'
);
$options = array_merge($defaults, $options);
extract($options);
//Format the post_type list so that it works in the query
$post_type = "('".str_replace(",","', '",$options['post_type'])."')";
//Get the term IDs from the Term Names
$terms = split('[,]', $options['taxonomy_term']);
$term_ids = $options['taxonomy_term'];
foreach($terms as $term){
    $t_data = term_exists($term, $taxonomy_name);
    $term_ids = str_replace($term,"'".$t_data['term_id']."'",$term_ids);
}
$term_ids = "(".$term_ids.")";
//
//Build the query
$query = "SELECT $wpdb->posts.* FROM $wpdb->posts
INNER JOIN $wpdb->term_relationships ON ($wpdb->posts.ID = $wpdb->term_relationships.object_id)
INNER JOIN $wpdb->term_taxonomy ON ($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id) WHERE 1=1 ";
if($options['taxonomy_name'] != null){
    $query .="AND $wpdb->term_taxonomy.taxonomy = '".$options['taxonomy_name']."' ";
    if($options['taxonomy_term'] != null){
        $query .="AND $wpdb->term_taxonomy.term_id IN $term_ids ";
    }
}
if($options['post_type'] != null){$query .="AND $wpdb->posts.post_type IN $post_type ";}
$query .="AND $wpdb->posts.post_status = '".$options['post_status']."' ";
$query .="GROUP BY $wpdb->posts.ID ";
//$query .="ORDER BY $wpdb->posts.".$options['orderby']." ".$options['order'];
$query .="ORDER BY RAND()";

$my_posts = $wpdb->get_results($query);
return($my_posts);
}
function get_post_metadata($post_id, $meta_keys, $rand = true){
    global $wpdb;
    //$meta_key = "('".str_replace(",","','",$meta_key)."')";
    //echo $meta_key;
	$order = ($rand)? 'RAND()': 'meta_id ASC';
    $meta_key_str = "('".join("','",$meta_keys)."')";

    $results = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->postmeta 
        WHERE post_id = %d AND meta_key IN ".$meta_key_str."ORDER BY ".$order, $post_id));
    return $results;
}
function custom_login_logo() {
	echo '<style type="text/css">
	h1 a { background-image: url('.get_bloginfo('template_directory').'/images/logo.png) !important; }
	</style>';
}
add_action('login_head', 'custom_login_logo');

function get_user_role() {
    global $current_user;

    $user_roles = $current_user->roles;
    $user_role = array_shift($user_roles);

    return $user_role;
}

function add_admin_bar_link() {
	global $wp_admin_bar;
	if ( !is_super_admin() || !is_admin_bar_showing() )
		return;
		
	$wp_admin_bar->add_menu( array(
		'id' => 'site_link',
		'title' => __( 'Trang chủ'),
		'href' => __(get_bloginfo('url')),
		) );
	$wp_admin_bar->add_menu( array(
		'id' => 'session_link',
		'title' => __( 'Đề thi'),
		'href' => __('edit.php?post_type=session'),
		) );
			$wp_admin_bar->add_menu( array(
		'id' => 'question_link',
		'title' => __( 'Câu hỏi thi'),
		'href' => __('edit.php?post_type=question'),
		) );
	$wp_admin_bar->add_menu( array(
		'id' => 'trial_question_link',
		'title' => __( 'Câu hỏi ôn tập'),
		'href' => __('edit.php?post_type=trial_question'),
		) );
	$wp_admin_bar->add_menu( array(
		'id' => 'new_session_link',
		'parent' => 'session_link',
		'title' => __( 'Tạo mới'),
		'href' => __('post-new.php?post_type=session'),
		) );
	$wp_admin_bar->add_menu( array(
		'id' => 'new_question_link',
		'parent' => 'question_link',
		'title' => __( 'Tạo mới'),
		'href' => __('post-new.php?post_type=question'),
		) );
	$wp_admin_bar->add_menu( array(
		'id' => 'new_trial_question_link',
		'parent' => 'trial_question_link',
		'title' => __( 'Tạo mới'),
		'href' => __('post-new.php?post_type=trial_question'),
		) );
	$wp_admin_bar->add_menu( array(
		'id' => 'list_session_link',
		'parent' => 'session_link',
		'title' => __( 'Danh sách'),
		'href' => __('edit.php?post_type=session'),
		) );
	$wp_admin_bar->add_menu( array(
		'id' => 'list_question_link',
		'parent' => 'question_link',
		'title' => __( 'Danh sách'),
		'href' => __('edit.php?post_type=question'),
		) );
	$wp_admin_bar->add_menu( array(
		'id' => 'list_trial_question_link',
		'parent' => 'trial_question_link',
		'title' => __( 'Danh sách'),
		'href' => __('edit.php?post_type=trial_question'),
		) );

}
add_action('admin_bar_menu', 'add_admin_bar_link',25);
function remove_admin_bar_links() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('updates');
	$wp_admin_bar->remove_menu('site-name');
	$wp_admin_bar->remove_menu('comments');
	$wp_admin_bar->remove_menu('new-content');
}
add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );
