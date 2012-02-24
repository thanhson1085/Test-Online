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
	<div class="i-logo"><a href="<?php echo get_bloginfo('url');?>?post_type=trial_question"><img src="<?php echo get_bloginfo("template_url");?>/images/logo5.png"></a></div>
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
<ul class="btn-test-list">
<?php
global $post;
$args = array( 'numberposts' => 1, 'post_type'=> 'session', 'post_status' => 'publish' );
$myposts = get_posts( $args );
foreach( $myposts as $post ) :	setup_postdata($post); ?>
	<li><a href="<?php the_permalink(); ?>"><span>Làm bài thi</span></a></li>
	<?php 
	if (get_user_role()){
		?>
		<li><a href="?hidden_term=hidden-<?php echo $post->ID; ?>" target="_blank"><span>Kết quả thi</span></a></li>
		<?php
	}

	?>

<?php endforeach; ?>
</ul>
<!--p><a href="?hidden_term=<?php echo '#';?>">Sample Question</a></p-->
<h2 class="i-right-h2">Ôn tập</h2>
<form method="POST" action="index.php?post_type=trial_question">
<div class="i-term-container">
<h3 class="i-right-h3">Chọn lớp</h3>
<?php
$args = array( 'taxonomy' => 'class' );

$terms = get_terms('class', $args);

$count = count($terms);
$checked = (!get_query_var('class'))? 'checked="checked"': '';
if ($count > 0) {

    foreach ($terms as $term) {
		if (strtoupper(urlencode(get_query_var('class'))) != strtoupper($term->slug)){
			echo '<p><input type="radio" name="class" '.$checked.' value="'.$term->slug.'"/><label>' . $term->name . '</label></p>';
    	}
		else{
			echo '<p><input type="radio" name="class" checked="checked" value="'.$term->slug.'"/><label>' . $term->name . '</label></p>';
			$class_name = $term->name;
		}
		$checked='';
    }

}
?>
</div>

<div class="i-term-container">
<h3 class="i-right-h3">Chọn học kỳ</h3>
<?php
$args = array( 'taxonomy' => 'classterm' );

$terms = get_terms('classterm', $args);

$count = count($terms); 
$checked = (!get_query_var('classterm'))? 'checked="checked"': '';
if ($count > 0) {

    foreach ($terms as $term) {
		if (strtoupper(urlencode(get_query_var('classterm'))) != strtoupper($term->slug)){
			echo '<p><input type="radio" name="classterm" '.$checked.' value="'.$term->slug.'"/><label>' . $term->name . '</label></p>';
    	}
		else{
			echo '<p><input type="radio" name="classterm" checked="checked" value="'.$term->slug.'"/><label>' . $term->name . '</label></p>';
			$term_name = $term->name;
		}
		$checked='';	
    }

}

?>
</div>	
<div class="i-term-container">
<h3 class="i-right-h3">Chọn môn</h3>
<?php
$args = array( 'taxonomy' => 'subject' );

$terms = get_terms('subject', $args);

$count = count($terms); 
//echo esc_html(get_query_var('subject'));
$checked = (!get_query_var('subject'))? 'checked="checked"': '';
if ($count > 0) {

    foreach ($terms as $term) {
		//echo  urlencode(get_query_var('subject')).'<>'.strtoupper($term->slug);
		if (strtoupper(urlencode(get_query_var('subject'))) != strtoupper($term->slug)){
			echo '<p><input type="radio" name="subject" '.$checked.' value="'.$term->slug.'"/><label>' . $term->name . '</label></p>';
    	}
		else{
			echo '<p><input type="radio" name="subject" checked="checked" value="'.$term->slug.'"/><label>' . $term->name . '</label></p>';
			$subject_name = $term->name;
		}
		$checked='';	
    }
}
?>
</div>
<p class="i-right-btn"><input type="submit" value="Ôn tập"/></p>	
</form>
</div>
<div class="i-body-content">

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
			'terms' => array( get_query_var('class') )
		),
		array(
			'taxonomy' => 'classterm',
			'field' => 'slug',
			'terms' => array( get_query_var('classterm') )
		),
		array(
			'taxonomy' => 'subject',
			'field' => 'slug',
			'terms' => array(get_query_var('subject'))
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
	if (get_user_role() != 'administrator'):
		?>	
		
		<div class="i-intro-container">
			<div class="i-intro">
			<?php 
				$my_post_id = 1;
				$my_post = get_post($my_post_id);
			?>
			<h1><?php echo $my_post->post_title; ?></h1>
				<?php echo $my_post->post_content;?>
			</div>
		</div>
		<?php
		
	endif;
	
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
			if (get_user_role() == 'administrator'):
			?>
			<span class="btn-edit"><a target="_blank" href="<?php echo get_bloginfo('url');?>/wp-admin/post.php?post=<?php echo $post->ID;?>&action=edit">Sửa nội dung</a></span>
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
		echo '<li>Lớp '.$class->name;
		?>
		<div class="wg-classterms-list">
		<ul>
		<?php
		foreach ($classterms as $classterm){
			echo '<li>Học kỳ '.$classterm->name;
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

<?php if (is_user_logged_in()):?>
<div class="wg-container"><!-- start widget -->
<div class="wg-menu">
	<ul>
		<li>
			<div><span>Chọn Lớp:</span><span class="checked-item">Tất cả</span></div>
			<ul>
				<li id="class_all">
					Tất cả
				</li>
				<?php 
					$args = array('taxonomy'=>'class');
					$classes = get_terms('class',$args);
					foreach ($classes as $class){
						echo '<li id="class_'.$class->slug.'">';
						echo 'Lớp '.$class->name;
						echo '</li>';
					}
				?>			

			</ul>
			
		</li>
	</ul>
	<ul>
		<li>
			<div><span>Chọn học kỳ:</span><span class="checked-item">Tất cả</span></div>
			<ul>
				<li id="classterm_all">
					Tất cả
				</li>
				<?php 
					$args = array('taxonomy'=>'classterm');
					$classterms = get_terms('classterm',$args);
					foreach ($classterms as $classterm){
						echo '<li id="classterm_'.$classterm->slug.'">';
						echo 'Học kỳ '.$classterm->name;
						echo '</li>';
					}
				?>			

			</ul>
			
		</li>
	</ul>
	<ul>
		<li>
			<div><span>Chọn môn:</span><span class="checked-item">Tất cả</span></div>
			<ul>
				<li id="subject_all">
					Tất cả
				</li>
				<?php 
					$args = array('taxonomy'=>'subject');
					$subjects = get_terms('subject',$args);
					foreach ($subjects as $subject){
						echo '<li id="subject_'.$subject->slug.'">';
						echo 'Môn '.$subject->name;
						echo '</li>';
					}
				?>			

			</ul>
			
		</li>
	</ul>
</div>
<div id="loadingDiv"><img src="<?php echo get_bloginfo('template_url');?>/images/loader.gif"/></div>
<div id="session-items"></div>
</div><!-- end widget -->	
<?php
$html = '<script type="text/javascript">';
$html .= 'var classterm_slug = "all";';
$html .= 'var class_slug = "all";';
$html .= 'var subject_slug = "all";';
$html .= 'jQuery(document).ready(function() {';
$html .= 'jQuery.post("' . get_bloginfo('url') . '/wp-admin/admin-ajax.php",{action: "MyAjaxFunction", modo: "ajaxget" },';
$html .= 'function(data){ jQuery("#session-items").html(data); }';
$html .= ');';
$html .= 'jQuery(".wg-menu ul li ul li").live("click", function() {';
$html .= 'var get_id = jQuery(this).attr("id");';
$html .= 'var arr_id = get_id.split("_");';
$html .= 'if (arr_id[0] == "classterm")';
$html .= 'classterm_slug = arr_id[1];';
$html .= 'if (arr_id[0] == "class")';
$html .= 'class_slug = arr_id[1];';
$html .= 'if (arr_id[0] == "subject")';
$html .= 'subject_slug = arr_id[1];';
$html .= 'var checked_item = jQuery(this).parent().parent().find("span.checked-item");checked_item.html(jQuery(this).html());';
$html .= 'jQuery.post("' . get_bloginfo('url') . '/wp-admin/admin-ajax.php",{ action: "MyAjaxFunction", subject: subject_slug, classterm: classterm_slug, class: class_slug, modo: "ajaxget" },';
$html .= 'function(data){ jQuery("#session-items").html(data); }';
$html .= ');});});';
$html .= '</script>';
echo $html;
endif;
?>

</div>

</div>
<?php 
get_footer();
