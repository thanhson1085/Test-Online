<?php
/**
 * Wed Feb 08, 2012 21:50:31 added by Thanh Son 
 * Email: thanhson1085@gmail.com 
 */

get_header();
?>
<div class="<?php echo $post->post_type; ?>">

<?php
$term_name = $post->post_title;

if ($_GET['a'] == 'result'){
	//print_r($_POST);
	$yourname = $_POST['yourname'];
	$yourclass = $_POST['yourclass'];
	
	if (!$yourname || !$yourclass) die('enter your name and your class'); 
	$score = 0;
	$total_score = 0;
	$selected_ids = array();
    foreach ($_POST as $choice_value => $value){
        if (substr($choice_value,0,10) == 'ans_check_'){
            $selected_ids[$value] = substr($choice_value,15);
		}
	}
	$answers_checked = array();
	$questions_checked = array();
	$i=0;
	foreach ($_POST as $choice_value => $value){
		if (substr($choice_value,0,10) == 'ans_check_'){
			//$selected_ids[] = array('question_id' => substr($answer_value,15), 'meta_id' => array($value));
			$post_id = substr($choice_value,15);
			//$answers_checked[] = $value;
			
			if (!in_array($post_id,$questions_checked)){
				$questions_checked[] = $post_id;
			}
			else{
				continue;
			}
			$answers_checked = array();
			$answers = get_post_metadata($post_id,array('True'));
			$b = true; 	
			$answers_checked= array_keys($selected_ids, $post_id);
			foreach ($answers as $answer){
	
				foreach ($answers_checked as $key => $answer_checked ){
					//echo $key.'</br>';
					$b=false;
					if ($answer->meta_id == $answer_checked){ 
						unset($answers_checked[$key]);
						$b = true;
					}
				}
				
				
				if (!array_key_exists($answer->meta_id, $selected_ids)){	
					$b = false;
				}
				if(!$b) break;
			}
			if ($b){
				$levels = wp_get_post_terms($post_id,'level',array('fields' => 'names'));
				$level = ( $levels )?$levels[0]: 1;
				$score += $level;
			}
		}
		if (substr($choice_value,0,9) == 'ans_text_'){
			
			if( $post_id == substr($choice_value,14)){
				$i++;
				
				$answers = get_post_metadata($post_id,array('Text'),false);
						if (trim(strtolower($answers[$i]->meta_value)) == trim(strtolower($value)) ){
							$levels = wp_get_post_terms($post_id,'level',array('fields' => 'names'));
							$level = ( $levels )?$levels[0]: 1;
							$score += $level/sizeof($answers);
						}					
				
			}
			else{
				$i=0;
				$post_id = substr($choice_value,14);
				$answers = get_post_metadata($post_id,array('Text'),false);
				//foreach ($answers as $answer){
						if (trim(strtolower($answers[$i]->meta_value)) == trim(strtolower($value)) ){
							$levels = wp_get_post_terms($post_id,'level',array('fields' => 'names'));
							$level = ( $levels )?$levels[0]: 1;
							$score += $level/sizeof($answers);
						}			
				//}
			}
		}
	}
	//print_r($answers_checked);

			$marks = wp_get_post_terms($post->ID,'mark',array('fields' => 'names'));
			$mark = ($marks)?(float)$marks[0]: 10;
			$user_login = $post->ID;

	$args = array(
	'post_status' => 'publish',
	'taxonomy_name' => 'hidden_term',
	'taxonomy_term' => $term_name,
	'post_type' => 'question',
	);
	$custom_posts = get_posts_by_taxonomy($args);
	if ($custom_posts):
		foreach ($custom_posts as $post){
			setup_postdata($post);
			$answers = array();
			$answers_true = array();
			$levels = wp_get_post_terms($post->ID,'level',array('fields' => 'names'));
			$level = ( $levels )?(float)$levels[0]: 1;
			$total_score += $level;
			//echo $levels[0];
		}
	endif;
	$user_score = round(($score/$total_score)*$mark);	
	if ($user_score > round(((2/3)*$mark))){
		$status_img = "smile.png";
	}
	else{
		if ($user_score >= round(((1/2)*$mark))){
			$status_img = "sad.png";
		}
		else{
			$status_img = "cry.png";
		}
	}
	echo '<p class="e-result"><span>'.$user_score.' Điểm<a href="'.get_bloginfo('url').'?post_type=trial_question"><img src="'.get_bloginfo("template_url").'/images/'.$status_img.'" /></a></span></p>';
	$user_id = username_exists( $user_login );
	if ( !$user_id ) {
		$user_id = wp_insert_user(array('user_login' => $user_login, 'user_pass' => '123'));
	}
	add_user_meta($user_id,'result', str_replace(';','',$yourname).';'.str_replace(';','',$yourclass).';'.$user_score );
	return;
	
}
/*
$args=array(
  'name' => $term_name,
  'post_type' => 'session',
  'post_status' => 'publish',
  'posts_per_page' => 1,
  'caller_get_posts'=> 1
);
$my_query = null;
$my_query = new WP_Query($args);
*/
//if( $my_query->have_posts() ) {
//  	while ($my_query->have_posts()) : 
//	$my_query->the_post(); 
	if(post_password_required( $post ) && $_POST['yourpassword'] != $post->post_password){
		?>
		<form method="POST" action="?session=<?php echo $_GET['session'];?>">
		<p class="password-container"><label>Nhập mật khẩu</label><span><input type="password" name="yourpassword" /></span>
		<input type="submit" value="Thi"/>
		</form>
		<?php
		return;
	}
	else{
	?>
		<form id="i-submit-form" method="POST" action="?session=<?php echo $_GET['session'];?>&a=result">
		<input type="hidden" name="yourpassword" value="<?php echo  $_POST['yourpassword'];?>"/>
	<?php
	}
	$subjects = wp_get_post_terms($post->ID,'subject',array('fields' => 'names'));
	$marks = wp_get_post_terms($post->ID,'mark',array('fields' => 'names'));
	$classes = wp_get_post_terms($post->ID,'class',array('fields' => 'names'));
	$times = wp_get_post_terms($post->ID,'time',array('fields' => 'names'));
	$terms = wp_get_post_terms($post->ID,'classterm',array('fields' => 'names'));
	?>
	<div class="e-content-header">
	<p><label>Môn thi:</label><span><?php  echo $subjects[0];?></span>
	<label class="label-2">Lớp:</label><span><?php echo $classes[0]; ?></span></p>

	<p><label>Học kỳ:</label><span><?php echo $terms[0]; ?></span>
	<label class="label-2">Thời gian làm bài:</label><span id="max-time"><?php echo $times[0];?></span></p>
	<p><label>Điểm tối đa:</label><span><?php echo $marks[0];?></span> </p>
 	<?php
//	endwhile;
//}
//wp_reset_query();  // Restore global post data stomped by the_post().
?>
<p><label>Họ và tên:</label><input type="text" name="yourname" /></p>
<p><label class="label-2">Lớp:</label><input type="text" name="yourclass" /></p>
</div>
<div class="q-img"><a href="<?php echo get_bloginfo('url');?>?post_type=trial_question"><img src="<?php echo get_bloginfo('template_url');?>/images/art.jpg"/></a></div>
<p class="btn-summit-container"><input class="btn-summit" type="submit" value="Nộp bài"/>
<?php if (current_user_can('edit_post')):?>
<span><a target="_blank" href="<?php echo get_bloginfo('url');?>/wp-admin/post.php?post=<?php echo $post->ID;?>&action=edit">
Sửa nội dung đề thi</a>
</span>
<?php endif;?><span id="clock"></span></p>
<div class="q-message">
	
</div>
<div class="q-page">
	<div class="q-page-content">
		<?php 
		while ( have_posts() ) : the_post();

		the_content();
		endwhile;
		?>
	</div>
<?php
$args = array(
'post_status' => 'publish',
'taxonomy_name' => 'hidden_term',
'taxonomy_term' => $term_name,
'post_type' => 'question',
);
$j=0;
$answers = array();
$answers_true = array();
$custom_posts = get_posts_by_taxonomy($args);
if ($custom_posts):
	foreach ($custom_posts as $post){
		setup_postdata($post);
		$answers = array();
		$answers_true = array();
		$j++;
		$levels = wp_get_post_terms($post->ID,'level',array('fields' => 'names'));
		$level = (current_user_can('edit_post') && $levels)? ' ('.$levels[0].' điểm'.')': '';
		?>
		<div class="q-content-container">
		<p class="q-title">Câu <?php echo $j.$level.': '.$post->post_title; ?>
		<?php if (current_user_can('edit_post')):?>
		<span class="q-edit-buton"><a target="_blank" href="<?php echo get_bloginfo('url');?>/wp-admin/post.php?post=<?php echo $post->ID;?>&action=edit">
		Sửa nội dung câu hỏi</a></span>
		<?php endif;?>
		</p>
		<div class="q-desc"><?php the_content();//echo $post->post_content; ?></div>
		<?php
		$answers = get_post_metadata($post->ID,array('False','True'),false);

		$answers_true = get_post_metadata($post->ID,array('True'));
		$answers = array_merge($answers,get_post_metadata($post->ID,array('Text'), false));
		$types = wp_get_post_terms($post->ID,'type',array('fields' => 'names'));
			
		switch ($types[0]) {
			case 'Multiple':
				$input_type = 'checkbox';
				break;
			case 'Single':
				$input_type = 'radio';
				break;
			case 'Text':
				$input_type = 'text';
				break;
			default:
				$input_type = 'checkbox';
		}
		$i = 1000;
		?>
		<div class="q-answer-container">
		<?php
		foreach ($answers as $answer){
			?>
			
			<?php
			if ($input_type == 'checkbox') ++$i;
			if ($answer->meta_key != 'Text'){
				?>
				<p><input type="<?php echo $input_type;?>" name="ans_check_<?php echo $i;?>_<?php echo $post->ID;?>" value="<?php echo $answer->meta_id;?>"/>
				<label><?php echo $answer->meta_value;?><?php echo (current_user_can('edit_post'))? '('.$answer->meta_key.')': '';?></label></p>
				<?php
			}
			else{
				if ($input_type == 'text'){
					$i++;

						?>
						<p><input type="text" name="ans_text_<?php echo rand(1000,9999);?>_<?php echo $post->ID;?>"/>
						<?php echo (current_user_can('edit_post'))? '('.$answer->meta_value.')': '';?></p>
						<?php
					
				}
			}
			?>
				
			<?php
		}
		?>
			</div>
		</div>
		<?php
	}
else : endif;

//print_r($answers);
//end of get posts by Taxonomy terms
?>
</div>
<div class="q-message">
	
</div>
<p class="btn-summit-container"><input class="btn-summit" type="submit" value="Nộp bài"/></p>
</form>
<?php get_footer(); ?>
