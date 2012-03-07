<?php
/**
 * Mon Feb 13, 2012 10:15:36 added by Thanh Son 
 * Email: thanhson1085@gmail.com 
 */
get_header();
//global $post,$wpdb;


$term_name = $_GET['hidden_term'];

$user_results = array();
$tmparr = explode('-',$term_name);
$my_id = $tmparr[1];
$post = get_post($my_id); 
//if ($custom_posts):
 //   foreach ($custom_posts as $post){
 //       setup_postdata($post);
		$user = get_userdatabylogin($post->ID);
		$user_results = get_user_meta($user->ID, 'result',false);

		
		$subjects = wp_get_post_terms($post->ID,'subject',array('fields' => 'names'));
		$marks = wp_get_post_terms($post->ID,'mark',array('fields' => 'names'));
		$classes = wp_get_post_terms($post->ID,'class',array('fields' => 'names'));
		$times = wp_get_post_terms($post->ID,'time',array('fields' => 'names'));
		$terms = wp_get_post_terms($post->ID,'classterm',array('fields' => 'names'));
		$user_result = $user_results[0];
		$class = explode(';',$user_result);

		?>
		<div class="p-content-header">
		<p class="p-title"><span>Kết quả thi</span></p>
		<p><label>Môn thi:</label><span><?php  echo $subjects[0];?></span>
		<label class="label-2">Lớp:</label><span><?php echo $class[1]; ?></span></p>

		<p><label>Học kỳ:</label><span><?php echo $terms[0]; ?></span>
		<label class="label-2">Thời gian làm bài:</label><span><?php echo $times[0];?></span></p>
		<p><label>Điểm tối đa:</label><span><?php echo $marks[0];?></span> </p>
		</div>
		<?php
		if (empty($user_results)){
			return;
		}
		?>
		<table class="tbl-mark">
		<thead>
		<th width="5%">STT</th>
		<th width="50%">Họ và tên</th>
		<th width="15%">Điểm</th>
		<th width="30%">Ghi chú</th>
		</thead>
		<tbody>
		<?php
			foreach ($user_results as $key => $user_result){
				$result = explode(';',$user_result);
				?>
				<tr>
				<td class="aligncenter"><?php echo $key; ?></td>
				<td class="alignleft"><?php echo $result[0]; ?></td>
				<td class="aligncenter"><?php echo $result[2]; ?></td>
				<td class="aligncenter"></td>
				</tr>
			<?php
			}
//	}
//endif;
			
	?>
		</tbody></table>
    </div><!-- #main -->

</div><!-- #page -->

<?php
