<?php
/**
 * Tue Feb 21, 2012 11:03:49 added by Thanh Son 
 * Email: thanhson1085@gmail.com 
 */
function get_ajax_user(){
	global $post;
	
	if (!empty($_POST['class'])) if ($_POST['class'] == 'all') $_POST['class'] = null;
	
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

	$html .= '<h3>Danh mục User</h3><ul>';
	$args = array(
		'tax_query' => $tax_query,
		'posts_per_page' => '1',
		'paged' => '1',//$_POST['paged'],
		'order' => 'ASC',
	);

	
/*	$args = array(
		'tax_query' => $tax_query,
	);*/
	$wp_user_query = new WP_User_Query($args);
	// Get the results
	$authors = $wp_user_query->get_results();
    foreach ($authors as $author)
    {
        // get all the user's data
        $author_info = get_userdata($author->ID);
        $html .= '<li><a>'.$author_info->first_name.' '.$author_info->last_name.'</a><li>';
    }
	//echo $html;
	
	if (!$authors){
		$html .= '<li>Không có user nào trong danh mục tìm kiếm</li>';
	}
	
	$html .= '</ul>';
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