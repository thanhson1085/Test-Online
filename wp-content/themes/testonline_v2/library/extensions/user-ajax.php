<?php
/**
 * Tue Feb 21, 2012 11:03:49 added by Thanh Son 
 * Email: thanhson1085@gmail.com 
 */
function get_ajax_session(){
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
		//$html .= '</a><a class="resultlink" target="_blank" href="?hidden_term=hidden-'.$post->ID.'">(Xem k?t qu?)</a></li>';
	//}

	endwhile;
	
	if (!$query->post-count){
		$html .= '<li>Không có user nào trong danh mục tìm kiếm</li>';
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

    add_action( 'wp_ajax_nopriv_get_ajax_user', 'get_ajax_user' );
    add_action( 'wp_ajax_get_ajax_user', 'get_ajax_user' );