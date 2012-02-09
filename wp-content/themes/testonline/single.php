<?php
/**
 * Wed Feb 08, 2012 21:50:31 added by Thanh Son 
 * Email: thanhson1085@gmail.com 
 */
function get_weight($answer_id,&$answers){
	if(empty($answer_id)) return 0;
	foreach ($answers as $answer){
		if($answer_id == $answer['id']) return $answer['weight'];
	}
}
function calculate_score(&$selected_ids, &$answer_set){
	if (empty($selected_ids)) return 0;
	foreach ($selected_ids as $choice_id){
		$score += get_weight($choice_id, $answer_set);
	}
	return $score;
}
foreach ($_POST as $answer_value => $value){
	if (substr($answer_value,0,10) == 'ans_check_'){
		//$selected_ids = array_push($selected_ids, array('question_id' => $value, 'meta_id' => $value));
	}
}
print_r($_POST);
?>
<form method="POST" action="#">
<?php
$term_name  = ($_GET['session'])?$_GET['session']:'';
$args=array(
  'name' => $term_name,
  'post_type' => 'session',
  'post_status' => 'publish',
  'posts_per_page' => 1,
  'caller_get_posts'=> 1
);
$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
  	while ($my_query->have_posts()) : 
	$my_query->the_post(); 
	if(post_password_required( $post ) && $_POST['yourpassword'] != $post->post_password){
		?>
		<p><label>Enter Your Password:</label><span><input type="password" name="yourpassword" /></span>
		<input type="submit" value="Finish"/>
		</form>
		<?php
		return;
	}
	else{
	?>
		<input type="hidden" name="yourpassword" value="<?php echo  $_POST['yourpassword'];?>"/>
	<?php
	}
	$subjects = wp_get_post_terms($post->ID,'subject',array('fields' => 'names'));
	$marks = wp_get_post_terms($post->ID,'mark',array('fields' => 'names'));
	$classes = wp_get_post_terms($post->ID,'class',array('fields' => 'names'));
	$times = wp_get_post_terms($post->ID,'time',array('fields' => 'names'));
	$terms = wp_get_post_terms($post->ID,'term',array('fields' => 'names'));
	?>

	<p><label>Subject:</label><span><?php  echo $subjects[0];?></span>
	<label>Class:</label><span><?php echo $classes[0]; ?></span></p>

	<p><label>Term:</label><span><?php echo $terms[0]; ?></span>
	<label>Time:</label><span><?php echo $times[0];?></span></p>
	<p><label>Maximum Mark:</label><span><?php echo $marks[0];?></span> </p>

 	<?php
	endwhile;
}
wp_reset_query();  // Restore global post data stomped by the_post().
?>
<p><label>Your Name:</label><input type="text" name="yourname" />
<label>Your Class:</label><input type="text" name="yourclass" /></p>
<?php
$args = array(
'post_status' => 'publish',
'taxonomy_name' => 'hidden_term',
'taxonomy_term' => $term_name,
'post_type' => 'question',
);
$answers = array();
$answers_true = array();
$custom_posts = get_posts_by_taxonomy($args);
if ($custom_posts):
	foreach ($custom_posts as $post){
		setup_postdata($post);
		$answers = array();
		$answers_true = array();

		?>
		<p><?php echo $post->post_title; ?></p>
		<p><?php echo $post->post_content; ?></p>
		<?php
		$answers = get_post_metadata($post->ID,array('False','True'));

		$answers_true = get_post_metadata($post->ID,array('True'));
		$answers = array_merge($answers,get_post_metadata($post->ID,array('Text')));
		$types = wp_get_post_terms($post->ID,'type',array('fields' => 'names'));
		$input_type = ($types[0]=='Multiple')?'checkbox':'radio'; 
		$i = 0;
		foreach ($answers as $answer){
			if ($input_type == 'checkbox') ++$i;
			if ($answer->meta_key != 'Text'){
				?>
				<p><input type="<?php echo $input_type;?>" name="ans_check_<?php echo $i;?>_<?php echo $post->ID;?>" value="<?php echo $answer->meta_id;?>"/><label><?php echo $answer->meta_value;?></label></p>
				<?php
			}
			else{
				?>
				<p><input type="<?php echo $input_type;?>" name="ans_check_<?php echo $post->ID;?>" value="<?php echo $answer->meta_id;?>"/><label><input type="text" name="ans_text_<?php echo $post->ID;?>"/></label></p>
				<?php
			}
		}
	}
else : endif;

//print_r($answers);
//end of get posts by Taxonomy terms
?>
<p><input type="submit" value="Finish"/></p>
</form>
<?php //get_footer(); ?>
