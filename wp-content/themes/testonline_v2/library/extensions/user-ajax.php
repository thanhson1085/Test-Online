<?php
/**
 * Tue Feb 21, 2012 11:03:49 added by Thanh Son 
 * Email: thanhson1085@gmail.com 
 */
function get_ajax_user(){
	
	if (!empty($_POST['class'])) if ($_POST['class'] == 'all') $_POST['class'] = null;
	
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

	$html .= '<ul id="user-items">';
	$args = array(
		'tax_query' => $tax_query,
		'posts_per_page' => '1',
		'paged' => '1',
		'order' => 'ASC',
	);


	$wp_user_query = new WP_User_Query($args);
	// Get the results
	$authors = $wp_user_query->get_results();
    foreach ($authors as $author)
    {
        // get all the user's data
        $author_info = get_userdata($author->ID);
        $html .= '<li>'.get_avatar( $author->ID, $size = '60', $default = '<path_to_url>' ).
					' <a class="user-info-detail" id ="'.$author->ID.'" href="'.get_bloginfo('url').'?page_id='.$author->ID.'">'.$author_info->first_name.	
					' '.$author_info->last_name.'<br /><span>'.$author->user_email.'</span></a><li>';
    }
	//echo $html;
	
	if (!$authors){
		$html .= '<li>Không có user nào trong danh mục tìm kiếm</li>';
	}
	
	$html .= '</ul>';
	$html .= '<div class="user-info-container"><div id="user-info"></div></div>';
	/*$total_pages = $wp_user_query->max_num_pages;

	if ($total_pages > 1){
		$current_page = max(1, 1);
		$html .= '<div class="paging" id="question-paging">'.paginate_links(array(
			'show_all'     => true,
			'type'         => 'plain',
			'add_args'     => true,
			'prev_text'    => __('&laquo; Trang trước'),
			'next_text'    => __('Trang sau &raquo;'),
			'current' => $current_page,
			'total' => $total_pages,
		)).'</div>';
	}*/
	echo ($html);
	die();
}
    // creating Ajax call for WordPress

    add_action( 'wp_ajax_nopriv_get_ajax_user', 'get_ajax_user' );
    add_action( 'wp_ajax_get_ajax_user', 'get_ajax_user' );