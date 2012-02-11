<?php
/**
 * Wed Feb 08, 2012 21:50:31 added by Thanh Son 
 * Email: thanhson1085@gmail.com 
 */
/*
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
*/
$term_name  = ($_GET['session'])?$_GET['session']:'';
if ($_GET['a'] == 'result'){

	$score = 0;
	$total_score = 0;
	$selected_ids = array();
    foreach ($_POST as $choice_value => $value){
        if (substr($choice_value,0,10) == 'ans_check_'){
            $selected_ids[$value] = substr($choice_value,15);
		}
	}
	$answer_trues = array();
	foreach ($_POST as $choice_value => $value){
		if (substr($choice_value,0,10) == 'ans_check_'){
			//$selected_ids[] = array('question_id' => substr($answer_value,15), 'meta_id' => array($value));
			$post_id = substr($choice_value,15);

			if (!in_array($post_id,$answers_checked)){
				$answers_checked[] = $post_id;
			}
			else{
				continue;
			}
			$answers = get_post_metadata($post_id,array('True'));
			$b = true; 	
			foreach ($answers as $answer){
				if (!array_key_exists($answer->meta_id, $selected_ids)){	
					$b = false;
				}
			}
			if ($b){
				$levels = wp_get_post_terms($post_id,'level',array('fields' => 'names'));
				$score += $levels[0];
			}
		}
		if (substr($choice_value,0,9) == 'ans_text_'){	
			$post_id = substr($choice_value,9);
            $answers = get_post_metadata($post_id,array('Text'));
            foreach ($answers as $answer){
                if (strtolower($answer->meta_value) == strtolower($value) ){
            		$levels = wp_get_post_terms($post_id,'level',array('fields' => 'names'));
                    $score += $levels[0];
                }
            }
		}
	}
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
			$marks = wp_get_post_terms($post->ID,'mark',array('fields' => 'names'));
			$mark = (float)$marks[0];
		endwhile;
	}
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
			$total_score += (float)$levels[0];
		}
	endif;
			echo round(($score/$total_score)*$mark);	
	return;
	
}
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
		<form method="POST" action="?session=<?php echo $term_name;?>">
		<p><label>Enter Your Password:</label><span><input type="password" name="yourpassword" /></span>
		<input type="submit" value="Finish"/>
		</form>
		<?php
		return;
	}
	else{
	?>
		<form method="POST" action="?session=<?php echo $term_name;?>&a=result">
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
		}
		$i = 1000;
		foreach ($answers as $answer){
			if ($input_type == 'checkbox') ++$i;
			if ($answer->meta_key != 'Text'){
				?>
				<p><input type="<?php echo $input_type;?>" name="ans_check_<?php echo $i;?>_<?php echo $post->ID;?>" value="<?php echo $answer->meta_id;?>"/><label><?php echo $answer->meta_value;?></label></p>
				<?php
			}
			else{
				if ($input_type == 'text'){
					?>
					<p><input type="text" name="ans_text_<?php echo $post->ID;?>"/></p>
					<?php
				}
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
