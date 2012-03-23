<?php
/**
 * Tue Feb 21, 2012 11:03:49 added by Thanh Son 
 * Email: thanhson1085@gmail.com 
 */
function get_ajax_user(){
	
	if (!empty($_POST['class'])) if ($_POST['class'] == 'all') $_POST['class'] = null;
	
	$term = get_term_by('slug',$_POST['class'],'class');
	
	$html .= '<ul id="user-items">';


	// Get the results
	$authors = get_objects_in_term($term->term_id,'class');
    foreach ($authors as $author)
    {
        // get all the user's data
        $author_info = get_userdata($author);
        $html .= '<li>'.get_avatar( $author, $size = '60', $default = '<path_to_url>' ).
					' <a class="user-info-detail" id ="'.$author.'" href="'.get_bloginfo('url').'?page_id='.$author.'">'.$author_info->first_name.	
					' '.$author_info->last_name.'<br /><span>'.$author_info->user_email.'</span></a><li>';
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
