<?php
/**
 * Wed Feb 08, 2012 21:04:55 added by Thanh Son 
 * Email: thanhson1085@gmail.com 
 */

get_header();
if ($_GET['post_type'] != 'trial_question'){
	?>
	<div class="d-page-container">
		<div class="d-page">	
			<div class="d-logo"></div>
				<?php
				global $post;
				$args = array( 'numberposts' => 1, 'post_type'=> 'session', 'post_status' => 'publish' );
				$myposts = get_posts( $args );
				foreach( $myposts as $post ) :	setup_postdata($post); ?>
					<div class="d-btn-test"> <img src="<?php echo get_bloginfo('template_url');?>/images/micky.gif" /><a href="<?php the_permalink(); ?>"/>Bài Thi</a></div>
				<?php endforeach; ?>	
		
			<div class="d-btn-demo"> <img src="<?php echo get_bloginfo('template_url');?>/images/micky.gif" /><a href="?post_type=trial_question"/>Phần Mềm<a></div>

			<div class="img3"><img src="<?php echo get_bloginfo('template_url');?>/images/img7.jpg" /></div>
			
			<div class="img2"><img src="<?php echo get_bloginfo('template_url');?>/images/img8.jpg" /></div>
			<div class="img1"><img src="<?php echo get_bloginfo('template_url');?>/images/img1.jpg" /></div>
			
		
			<div class="d-flower3"><img src="<?php echo get_bloginfo('template_url');?>/images/flower3.png" /></div>
		</div>
	</div>
	<?php
	get_footer();
	return;
}

?>
<div class="i-header">
	<div class="i-logo"><a href="<?php echo get_bloginfo('url');?>"><img src="<?php echo get_bloginfo("template_url");?>/images/logo5.png"></a></div>
	<div class="img4"><img src="<?php echo get_bloginfo('template_url');?>/images/img8.jpg" /></div>
	<div class="img5"><img src="<?php echo get_bloginfo('template_url');?>/images/img12.jpg" /></div>
	<div id="topbar">
		<?php if ( is_user_logged_in() ) { ?>
					
			<i>Xin chào <?php echo wp_get_current_user()->user_login; ?></i> | <a href="<?php echo get_admin_url(); ?>">Quản trị</a>
				| <a href="<?php echo wp_logout_url(); ?>">Đăng xuất</a>
					
			<?php } 
			else{
					?>
						<a href="<?php echo wp_login_url(); ?>">Đăng nhập</a> 
					<?php
					}
					?>
	</div>
</div>
	<div class="i-content">
<div class="i-right-sidebar">
	<?php get_sidebar();?>
</div>
<div class="i-body-content">
<span> <?php //echo get_query_var['class'].'-'.get_query_var['classterm'].'-'.get_query_var['subject']; ?></span>
<div class="tq-content-container">

<?php
/*if ( !get_query_var('class')){
	echo '<div class="i-welcome"></div>';
}*/
$args = array(
	'tax_query' => array(
		'relation' => 'AND',
		array(
			'taxonomy' => 'class',
			'field' => 'slug',
			'terms' => array( get_query_var('class') /*$_POST['class']*/ )
		),
		array(
			'taxonomy' => 'classterm',
			'field' => 'slug',
			'terms' => array( get_query_var('classterm')/*$_POST['term']*/ )
		),
		array(
			'taxonomy' => 'subject',
			'field' => 'slug',
			'terms' => array( get_query_var('subject')/*$_POST['subject']*/ )
		)
	),
	'posts_per_page' => '-1',
	'post_type' => 'trial_question',
	'post_status' => 'publish',
	'order' => 'ASC',
);
$query = new WP_Query( $args );
if ($query->post-count){
?>
<div id="i-test-info">
<ul>
<li><span>
<?php echo 'Lớp: '.$class_name;?>
</span></li>
<li><span>
<?php echo 'Học kỳ: '.$term_name;?>
</span></li>
<li><span>
<?php echo 'Môn: '.$subject_name;?>
</span></li>
<li><span>
<?php echo 'Làm đúng: <span id="true-answers">0</span>/'.$query->post_count;?>
</span></li>
<li><span>
<?php echo 'Đang làm câu thứ: <span id="no-answers">1</span>';?>
</span></li>
</ul>
</div>
<div id="i-question-list"></div>
<div id="i-message"></div>

<?php
}
else{
	if ($_GET['post_type'] == 'trial_question' && get_query_var('class') && get_query_var('classterm') && get_query_var('subject')){
		?>
		<div id="i-message" style="display: block;">Không có bài tập trong mục bạn đang tìm kiếm</div>
		<?php
	}
	
		?>	
		<div class="i-intro-container">
			<div class="i-intro">
			<?php $my_post = get_post(1);
			
			?>
				<h1><?php echo $my_post->title; ?></h1>
				
			</div>
		</div>
		<?php
	
}
$j=0;
while ( $query->have_posts() ) : $query->the_post(); ?>


		<?php 

		$answers = array();
		$answers_true = array();
		$j++;
		?>
		<div class="q-content-container notyet" id="q-item-<?php echo $j;?>">
		<p class="q-title"><?php echo $post->post_title; ?></p>
		<div class="q-desc"><?php the_content();//echo $post->post_content; ?></div>
		<?php
		$answers = get_post_metadata($post->ID,array('False','True'));

		$answers_true = get_post_metadata($post->ID,array('True'));
		$answers = array_merge($answers,get_post_metadata($post->ID,array('Text'),false));
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
		<?php
					?>
			<div class="q-answer-container">
			<?php
		foreach ($answers as $answer){

			if ($input_type == 'checkbox') ++$i;
			if ($answer->meta_key != 'Text'){
				?>
				<p class="<?php echo $answer->meta_key;?>"><input type="<?php echo $input_type;?>" name="ans_check_<?php echo $i;?>_<?php echo $post->ID;?>" value="<?php echo $answer->meta_id;?>"/><label><?php echo $answer->meta_value;?></label></p>
				<?php
			}
			else{
				if ($input_type == 'text'){
					?>
					<p class="<?php echo $answer->meta_value;?>"><input type="text" name="ans_text_<?php echo rand(1000,9999);?>_<?php echo $post->ID;?>"/></p>
					<?php
				}
			}

		}
					?>
				
			<?php
		?>
		</div>
		<p class="next-page-container">
		<?php
			if (is_user_logged_in()):
			?>
			<span class="btn-edit"><a target="_blank" href="<?php echo get_bloginfo('url');?>/wp-admin/post.php?post=<?php echo $post->ID;?>&action=edit">Edit</a></span>
			<?php
			endif;
			?>
		<span class="btn-bypass">Bỏ qua</span><span class="btn-next">Tiếp theo</span></p>
	
		
	</div>
			<?php
	
					endwhile;
					
					?>
			<div id="i-passed-list"></div>		
		</div>
		
<div class="wg-container"><!-- start widget -->
<?php
	$args = array('taxonomy'=>'class');
	$classes = get_terms('class',$args);
	$args = array('taxonomy'=>'classterm');
	$classterms = get_terms('classterm',$args);
	$args = array('taxonomy'=>'subject');
	$subjects = get_terms('subject',$args);
	?>
	<div id="wg-classes-list">
	<ul>
	<?php
	foreach ($classes as $class){
		echo '<li>Lop '.$class->name;
		?>
		<div class="wg-classterms-list">
		<ul>
		<?php
		foreach ($classterms as $classterm){
			echo '<li>Hoc ky '.$classterm->name;
			?>
				<div class="wg-subject-list">
				<ul>
				<?php
				foreach ($subjects as $subject){
					echo '<li><a href="?post_type=trial_question&class='.$class->slug.'&classterm='.$classterm->slug.'&subject='.$subject->slug.'">'.$subject->name;
					echo '</a></li>';
				}
				?>
				</ul>
				</div>

			<?php

			echo '</li>'; 
		}
		?>
		</ul>
		</div>

		<?php
		echo '</li>';	
	}
	?>
	</ul>
	</div>
<?php
?>
</div><!-- end widget -->
</div>
	
</div>

<?php

get_footer();
