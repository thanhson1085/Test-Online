<?php
/**
 * Tue Feb 21, 2012 11:03:49 added by Thanh Son 
 * Email: thanhson1085@gmail.com 
 */
 

 
 function get_ajax_user_info(){
	global $post;
	$user_ID = $_POST['user_id'];
	$user_info = get_userdata($user_ID);
	$html .= '<h1>'.$user_info->first_name.'</h1>';
	//$html .= get_avatar( $user_ID, $size = '190', $default = '<path_to_url>' );
	$html .= '<ul class="general-info">';
	$html .= '<li>Học lớp: 3A3</li>';
	$html .= '<li>Ngày sinh: 18/10/2004</li>';
	$html .= '<li>Email: '.$user_info->user_email.'</li>';
	$html .= '</ul>';
	$html .= '<h2>Kết quả học tập</h2>';
	$html .= '<ul class="tbl-result">';
	
	$html .= '<li> <span>Lớp 1</span>';
	$html .= '<ul>';
	$html .= '<li><span>Học kỳ 1</span>';
	$html .= '<ul><li>Toán</li><li>A</li></ul>';
	$html .= '<ul><li>Tiếng Việt</li><li>B</li></ul>';
	$html .= '</li>';
	$html .= '<li><span>Học kỳ 2</span>';
	$html .= '<ul><li>Toán</li><li>A</li></ul>';
	$html .= '<ul><li>Tiếng Việt</li><li>B</li></ul>';
	$html .= '</li>';
	$html .= '</ul>';
	$html .= '</li>';
	
	$html .= '<li> <span>Lớp 2</span>';
	$html .= '<ul>';
	$html .= '<li><span>Học kỳ 1</span>';
	$html .= '<ul><li>Toán</li><li>A</li></ul>';
	$html .= '<ul><li>Tiếng Việt</li><li>B</li></ul>';
	$html .= '</li>';
	$html .= '<li><span>Học kỳ 2</span>';
	$html .= '<ul><li>Toán</li><li>A</li></ul>';
	$html .= '<ul><li>Tiếng Việt</li><li>B</li></ul>';
	$html .= '</li>';
	$html .= '</ul>';
	$html .= '</li>';

	$html .= '<li> <span>Lớp 3</span>';
	$html .= '<ul>';
	$html .= '<li><span>Học kỳ 1</span>';
	$html .= '<ul><li>Toán</li><li>A</li></ul>';
	$html .= '<ul><li>Tiếng Việt</li><li>B</li></ul>';
	$html .= '</li>';
	$html .= '<li><span>Học kỳ 2</span>';
	$html .= '<ul><li>Toán</li><li>A</li></ul>';
	$html .= '<ul><li>Tiếng Việt</li><li>B</li></ul>';
	$html .= '<ul><li>Tiếng Anh</li><li>B</li></ul>';
	$html .= '</li>';
	$html .= '</ul>';
	$html .= '</li>';

	$html .= '<li> <span>Lớp 4</span>';
	$html .= '<ul>';
	$html .= '<li><span>Học kỳ 1</span>';
	$html .= '<ul><li>Toán</li><li>A</li></ul>';
	$html .= '<ul><li>Tiếng Việt</li><li>B</li></ul>';
	$html .= '<ul><li>Khoa Học</li><li>B</li></ul>';
	$html .= '</li>';
	$html .= '<li><span>Học kỳ 2</span>';
	$html .= '<ul><li>Toán</li><li>A</li></ul>';
	$html .= '<ul><li>Tiếng Việt</li><li>B</li></ul>';
	$html .= '<ul><li>Tiếng Anh</li><li>B</li></ul>';
	$html .= '</li>';
	$html .= '</ul>';
	$html .= '</li>';

	$html .= '<li> <span>Lớp 5</span>';
	$html .= '<ul>';
	$html .= '<li><span>Học kỳ 1</span>';
	$html .= '<ul><li>Toán</li><li>A</li></ul>';
	$html .= '<ul><li>Tiếng Việt</li><li>B</li></ul>';
	$html .= '<ul><li>Khoa Học</li><li>B</li></ul>';
	$html .= '</li>';
	$html .= '<li><span>Học kỳ 2</span>';
	$html .= '<ul><li>Toán</li><li>A</li></ul>';
	$html .= '<ul><li>Tiếng Việt</li><li>B</li></ul>';
	$html .= '<ul><li>Tiếng Anh</li><li>B</li></ul>';
	$html .= '</li>';
	$html .= '</ul>';
	$html .= '</li>';

	
	$html .= '</ul>';
	echo $html;
	die();	
}
add_action( 'wp_ajax_nopriv_get_ajax_user_info', 'get_ajax_user_info' );
add_action( 'wp_ajax_get_ajax_user_info', 'get_ajax_user_info' );