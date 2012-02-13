<?php
/**
 * Mon Feb 13, 2012 10:15:36 added by Thanh Son 
 * Email: thanhson1085@gmail.com 
 */
get_header();
?>

<table class="tbl-mark">
<thead>
<th>STT</th>
<th>Ho va Ten</th>
<th>Diem</th>
</thead>
<tbody>
<?php
$term_name = $_GET['hidden_term'];
$args = array(
'post_status' => 'publish',
'taxonomy_name' => 'hidden_term',
'taxonomy_term' => $term_name,
'post_type' => 'session',
);
$custom_posts = get_posts_by_taxonomy($args);
if ($custom_posts):
    foreach ($custom_posts as $post){
        setup_postdata($post);
		$user = get_userdatabylogin($post->ID);
		$user_results = get_user_meta($user->ID, 'result');
		foreach ($user_results as $key => $user_result){
			$result = explode(';',$user_result);
			?>
			<tr>
			<td><?php echo $key; ?></td>
			<td><?php echo $result[0]; ?></td>
			<td><?php echo $result[2]; ?></td>
			</tr>
		<?php
		}
	}
endif;
			
	?>
		</tbody></table>
<?php
get_footer();
