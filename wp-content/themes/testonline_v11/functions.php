<?php
/**
* Mon Feb 06, 2012 09:11:19 added by Thanh Son 
* Email: thanhson1085@gmail.com 
*/
	
if ( ! isset( $content_width ) )
$content_width = 584;

add_action( 'init', 'announcement_init' );
function announcement_init() {
  $labels = array(
    'name' => _x('Thông báo', 'post type general name'),
    'singular_name' => _x('Thông báo', 'post type singular name'),
    'add_new' => _x('Thêm mới', 'announcement'),
    'add_new_item' => __('Thêm mới thông báo'),
    'edit_item' => __('Sửa thông báo'),
    'new_item' => __('Thông báo mới'),
    'all_items' => __('Tất cả thông báo'),
    'view_item' => __('Xem thông báo'),
    'search_items' => __('Tìm kiếm thông báo'),
    'not_found' =>  __('Không tìm thấy thông báo nào'),
    'not_found_in_trash' => __('Không thấy thông báo nào trong thùng rác'), 
    'parent_item_colon' => '',
    'menu_name' => 'Thông báo'

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
    'supports' => array( 'title','editor')
  ); 
  register_post_type('announcement',$args);
	
}

//add filter to ensure the text Question, or question, is displayed when user updates a question 
add_filter( 'post_updated_messages', 'announcement_updated_messages' );
function announcement_updated_messages( $messages ) {
  global $post, $post_ID;

  $messages['announcement'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Question updated. <a href="%s">View announcement</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Announcement updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Announcement restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Announcement published. <a href="%s">View announcement</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Announcement saved.'),
    8 => sprintf( __('Announcement submitted. <a target="_blank" href="%s">Preview announcement</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Announcement scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview announcement</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Announcement draft updated. <a target="_blank" href="%s">Preview announcement</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}


add_action( 'init', 'session_init' );
function session_init() {
  $labels = array(
    'name' => _x('Đề thi', 'post type general name'),
    'singular_name' => _x('Đề thi', 'post type singular name'),
    'add_new' => _x('Add New', 'session'),
    'add_new_item' => __('Add New Đề thi'),
    'edit_item' => __('Edit Đề thi'),
    'new_item' => __('New Đề thi'),
    'all_items' => __('All Đề thi'),
    'view_item' => __('View Đề thi'),
    'search_items' => __('Search Đề thi'),
    'not_found' =>  __('No Đề thi found'),
    'not_found_in_trash' => __('No Đề thi found in Trash'), 
    'parent_item_colon' => '',
    'menu_name' => 'Đề thi'

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
    'supports' => array( 'title','editor')
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
    7 => __('Session saved.'),
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
    'name' => _x('Câu hỏi thi', 'post type general name'),
    'singular_name' => _x('Câu hỏi', 'post type singular name'),
    'add_new' => _x('Thêm mới', 'question'),
    'add_new_item' => __('Thêm mới Câu hỏi'),
    'edit_item' => __('Sửa Câu hỏi'),
    'new_item' => __('Câu hỏi mới'),
    'all_items' => __('Tất cả Câu hỏi'),
    'view_item' => __('View Câu hỏi'),
    'search_items' => __('Tìm Câu hỏi'),
    'not_found' =>  __('No Câu hỏi found'),
    'not_found_in_trash' => __('No Câu hỏi found in Trash'), 
    'parent_item_colon' => '',
    'menu_name' => 'Câu hỏi thi'

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
    'name' => _x('Câu hỏi ôn tập', 'post type general name'),
    'singular_name' => _x('Câu hỏi ôn tập', 'post type singular name'),
    'add_new' => _x('Add New', 'question'),
    'add_new_item' => __('Add New Question'),
    'edit_item' => __('Edit Question'),
    'new_item' => __('New Question'),
    'all_items' => __('All Questions'),
    'view_item' => __('View Question'),
    'search_items' => __('Tìm Câu hỏi'),
    'not_found' =>  __('No questions found'),
    'not_found_in_trash' => __('No questions found in Trash'), 
    'parent_item_colon' => '',
    'menu_name' => 'Câu hỏi ôn tập'

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
    'name' => _x( 'Lớp', 'taxonomy general name' ),
    'singular_name' => _x( 'Lớp', 'taxonomy singular name' ),
    'search_items' =>  __( 'Tìm kiếm Lớp' ),
    'popular_items' => __( 'Popular Lớp' ),
    'all_items' => __( 'Tất cả các lớp' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Sửa Lớp' ), 
    'update_item' => __( 'Cập nhật Lớp' ),
    'add_new_item' => __( 'Thêm mới Lớp' ),
    'new_item_name' => __( 'Tên Lớp mới' ),
    'separate_items_with_commas' => __( 'Separate classes with commas' ),
    'add_or_remove_items' => __( 'Thêm hoặc xóa lớp' ),
    'choose_from_most_used' => __( 'Chọn từ lớp thường được sử dụng' ),
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
    'name' => _x( 'Học kỳ', 'taxonomy general name' ),
    'singular_name' => _x( 'Học kỳ', 'taxonomy singular name' ),
    'search_items' =>  __( 'Tìm Học kỳ' ),
    'popular_items' => __( 'Popular Học kỳ' ),
    'all_items' => __( 'Tất cả Học kỳ' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Học kỳ' ), 
    'update_item' => __( 'Update Học kỳ' ),
    'add_new_item' => __( 'Add New Học kỳ' ),
    'new_item_name' => __( 'New Học kỳ Name' ),
    'separate_items_with_commas' => __( 'Separate terms with commas' ),
    'add_or_remove_items' => __( 'Add or remove terms' ),
    'choose_from_most_used' => __( 'Choose from the most used terms' ),
    'menu_name' => __( 'Học kỳ' ),
  ); 

  register_taxonomy('classterm',array('trial_question','question','session'),array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'classterm' ),
  ));

  $labels = array(
    'name' => _x( 'Môn', 'taxonomy general name' ),
    'singular_name' => _x( 'Môn', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Môn' ),
    'popular_items' => __( 'Popular Môn' ),
    'all_items' => __( 'All Môn' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Môn' ), 
    'update_item' => __( 'Update Môn' ),
    'add_new_item' => __( 'Add New Môn' ),
    'new_item_name' => __( 'New Môn Name' ),
    'separate_items_with_commas' => __( 'Separate subjects with commas' ),
    'add_or_remove_items' => __( 'Add or remove subjects' ),
    'choose_from_most_used' => __( 'Choose from the most used subjects' ),
    'menu_name' => __( 'Môn' ),
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
    'name' => _x( 'Thời gian làm bài', 'taxonomy general name' ),
    'singular_name' => _x( 'Thời gian làm bài', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Thời gian làm bài' ),
    'popular_items' => __( 'Popular Thời gian làm bài' ),
    'all_items' => __( 'All Thời gian làm bài' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Thời gian làm bài' ), 
    'update_item' => __( 'Update Thời gian làm bài' ),
    'add_new_item' => __( 'Add New Thời gian làm bài' ),
    'new_item_name' => __( 'New Thời gian làm bài Name' ),
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
    'name' => _x( 'Độ khó', 'taxonomy general name' ),
    'singular_name' => _x( 'Độ khó', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Độ khó' ),
    'popular_items' => __( 'Popular Độ khó' ),
    'all_items' => __( 'All Độ khó' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Độ khó' ), 
    'update_item' => __( 'Update Độ khó' ),
    'add_new_item' => __( 'Add New Độ khó' ),
    'new_item_name' => __( 'New Độ khó Name' ),
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
    'name' => _x( 'Điểm', 'taxonomy general name' ),
    'singular_name' => _x( 'Điểm', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Điểm' ),
    'popular_items' => __( 'Popular Điểm' ),
    'all_items' => __( 'All Điểm' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Điểm' ), 
    'update_item' => __( 'Update Điểm' ),
    'add_new_item' => __( 'Add New Điểm' ),
    'new_item_name' => __( 'New Điểm Name' ),
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
    'name' => _x( 'Đề thi', 'taxonomy general name' ),
    'singular_name' => _x( 'Đề thi', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Đề thi' ),
    'popular_items' => __( 'Popular Đề thi' ),
    'all_items' => __( 'All Đề thi' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Đề thi' ), 
    'update_item' => __( 'Update Đề thi' ),
    'add_new_item' => __( 'Add New Đề thi' ),
    'new_item_name' => __( 'New Đề thi Name' ),
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
    'name' => _x( 'Dạng câu hỏi', 'taxonomy general name' ),
    'singular_name' => _x( 'Dạng câu hỏi', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Dạng câu hỏi' ),
    'popular_items' => __( 'Popular Dạng câu hỏi' ),
    'all_items' => __( 'All Dạng câu hỏi' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Dạng câu hỏi' ), 
    'update_item' => __( 'Update Dạng câu hỏi' ),
    'add_new_item' => __( 'Add New Dạng câu hỏi' ),
    'new_item_name' => __( 'New Dạng câu hỏi Name' ),
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
	$taxonomies = array('classterm','class','subject');//$typenow.'_type';
	if( $typenow == "question" || $typenow == "trial_question" || $typenow == "session" ){
		foreach ($taxonomies as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
			echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
			echo "<option value=''>Tìm theo $tax_name</option>";
			foreach ($terms as $term) { echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .'</option>'; }
			echo "</select>";
		}
	}
	$taxonomies = array('hidden_term');
	if( $typenow == "question"){
		foreach ($taxonomies as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
			echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
			echo "<option value=''>Tìm theo $tax_name</option>";
			foreach ($terms as $term) { echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' </option>'; }
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


function get_posts_by_taxonomy($args, $rand = false) {
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
    'order' => 'ASC',
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
if (!$rand){
	$query .="ORDER BY $wpdb->posts.".$options['orderby']." ".$options['order'];
}
else{
	$query .="ORDER BY RAND()";
}

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
		'href' => __(get_bloginfo('url').'?post_type=trial_question'),
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

if ( function_exists('register_sidebar') )
    register_sidebar();
	
add_filter('title_save_pre', 'check_title'); //if no post title set it to notitle
function check_title($post_title) {
	if ($_POST['post_type'] == 'session'){
	  $post_title = str_replace(' - ', ' ' , $post_title ); //set this to what you want the post name/url to be ?
	}
	return $post_title;
}
function MyAjaxFunction(){
	global $post;
	
	if (!empty($_POST['class'])) if ($_POST['class'] == 'all') $_POST['class'] = null;
	
	if (!empty($_POST['subject'])) if ($_POST['subject'] == 'all') $_POST['subject'] = null;
	if (!empty($_POST['classterm'])) if ($_POST['classterm'] == 'all') $_POST['classterm'] = null;
	//require_once('../../../../../wp-blog-header.php');
	$tax_query = array();
	$tax_query['relation'] = 'AND';
	if ($_POST['class']){
		array_push($tax_query,array(
				'taxonomy' => 'class',
				'field' => 'slug',
				'terms' => array($_POST['class']),
				)
			);
	}
	if ($_POST['classterm']){
		array_push($tax_query,array(
				'taxonomy' => 'classterm',
				'field' => 'slug',
				'terms' => array($_POST['classterm']),
				)
			);
	}
	if ($_POST['subject']){
		array_push($tax_query,array(
				'taxonomy' => 'subject',
				'field' => 'slug',
				'terms' => array($_POST['subject']),
				)
			);
	}


	
	$html .='<h3>Danh mục đề thi</h3><ul>';
	$args = array(
		'tax_query' => $tax_query,
		'posts_per_page' => '10',
		'paged' => $_POST['paged'],
		'post_type' => 'session',
		'post_status' => 'pending,publish',
		'order' => 'ASC',
	);
	$query = new WP_Query( $args );
	while ( $query->have_posts() ) : $query->the_post();

	
	//foreach ($hidden_terms as $hidden_term){
		$html .= '<li><a href="?session='.$post->post_name.'">'.$post->post_title;
		$html .= '</a><br /><a class="resultlink" target="_blank" href="?hidden_term=hidden-'.$post->ID.'">(Xem kết quả)</a>';
		$html .= '<a class="get-ajax-post" href="#" id="hiddenterm_hidden-'.$post->ID.'">(Xem câu hỏi)</a></li>';
	//}

	endwhile;
	
	if (!$query->post-count){
		$html .= '<li>Không có đề thi nào trong danh mục tìm kiếm</li>';
	}
	
	
	$html .= '</ul>';
	$total_pages = $query->max_num_pages;

	if ($total_pages > 1){
		$current_page = max(1, $_POST['paged']);
		$html .= '<div class="paging" id="session-paging">'.paginate_links(array(
			'show_all'     => true,
			'type'         => 'plain',
			'add_args'     => true,
			'prev_text'    => __('&laquo; Trang trước'),
			'next_text'    => __('Trang sau &raquo;'),
			'current' => $current_page,
			'total' => $total_pages,
		)).'</div>';
	}

	echo ($html);
	die();
	}
function get_ajax_question(){
	global $post;
	
	if (!empty($_POST['class'])) if ($_POST['class'] == 'all') $_POST['class'] = null;
	
	if (!empty($_POST['subject'])) if ($_POST['subject'] == 'all') $_POST['subject'] = null;
	if (!empty($_POST['classterm'])) if ($_POST['classterm'] == 'all') $_POST['classterm'] = null;
	if (!empty($_POST['hidden_term'])) if ($_POST['hidden_term'] == 'all') $_POST['hidden_term'] = null;
	//require_once('../../../../../wp-blog-header.php');
	$tax_query = array();
	$tax_query['relation'] = 'AND';
	if ($_POST['class']){
		array_push($tax_query,array(
				'taxonomy' => 'class',
				'field' => 'slug',
				'terms' => array($_POST['class']),
				)
			);
	}
	if ($_POST['classterm']){
		array_push($tax_query,array(
				'taxonomy' => 'classterm',
				'field' => 'slug',
				'terms' => array($_POST['classterm']),
				)
			);
	}
	if ($_POST['subject']){
		array_push($tax_query,array(
				'taxonomy' => 'subject',
				'field' => 'slug',
				'terms' => array($_POST['subject']),
				)
			);
	}
	if ($_POST['hidden_term']){
		array_push($tax_query,array(
				'taxonomy' => 'hidden_term',
				'field' => 'slug',
				'terms' => array($_POST['hidden_term']),
				)
			);
	}
	$html .= '<h3>Danh mục câu hỏi thi</h3><ul>';
	$args = array(
		'tax_query' => $tax_query,
		'posts_per_page' => '10',
		'paged' => $_POST['paged'],
		'post_type' => 'question',
		'post_status' => 'publish',
		'order' => 'ASC',
	);
	$query = new WP_Query( $args );
	while ( $query->have_posts() ) : $query->the_post();

	
	//foreach ($hidden_terms as $hidden_term){
		$html .= '<li><a href="?question='.$post->post_name.'">'.$post->post_title;
		//$html .= '</a><a class="resultlink" target="_blank" href="?hidden_term=hidden-'.$post->ID.'">(Xem kết quả)</a></li>';
	//}

	endwhile;
	
	if (!$query->post-count){
		$html .= '<li>Không có câu hỏi nào trong danh mục tìm kiếm</li>';
	}
	
	
	$html .= '</ul>';
	$total_pages = $query->max_num_pages;

	if ($total_pages > 1){
		$current_page = max(1, $_POST['paged']);
		$html .= '<div class="paging" id="question-paging">'.paginate_links(array(
			'show_all'     => true,
			'type'         => 'plain',
			'add_args'     => true,
			'prev_text'    => __('&laquo; Trang trước'),
			'next_text'    => __('Trang sau &raquo;'),
			'current' => $current_page,
			'total' => $total_pages,
		)).'</div>';
	}
	echo ($html);
	die();
}
    // creating Ajax call for WordPress
    add_action( 'wp_ajax_nopriv_MyAjaxFunction', 'MyAjaxFunction' );
	add_action( 'wp_ajax_MyAjaxFunction', 'MyAjaxFunction' );
    add_action( 'wp_ajax_nopriv_get_ajax_question', 'get_ajax_question' );
    add_action( 'wp_ajax_get_ajax_question', 'get_ajax_question' );

?>
