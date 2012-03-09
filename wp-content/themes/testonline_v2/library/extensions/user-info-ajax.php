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
	$html .= get_avatar( $user_ID, $size = '190', $default = '<path_to_url>' );
	$html .= '<ul>';
	$html .= '<li>Học lớp: 3A3</li>';
	$html .= '<li>Ngày sinh: 18/10/2004</li>';
	$html .= '<li>Email: lorem@ipsum.com</li>';
	$html .= '<li>Email phụ huynh: lorem@ipsum.com</li>';
	$html .= '</ul>';
	$html .= '<h2>Học bạ</h2>';
	$html .= '<ul>';
	$html .= '<li>Học lớp: 3A3</li>';
	$html .= '<li>Ngày sinh: 18/10/2004</li>';
	$html .= '<li>Email: lorem@ipsum.com</li>';
	$html .= '<li>Email phụ huynh: lorem@ipsum.com</li>';
	$html .= '</ul>';
	echo $html;
	die();	
}
add_action( 'wp_ajax_nopriv_get_ajax_user_info', 'get_ajax_user_info' );
add_action( 'wp_ajax_get_ajax_user_info', 'get_ajax_user_info' );