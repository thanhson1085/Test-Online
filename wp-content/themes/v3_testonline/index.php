<?php
/**
 * Wed Feb 08, 2012 21:04:55 added by Thanh Son 
 * Email: thanhson1085@gmail.com 
 */

get_header();

	
	
?>
<div class="i-header">
	<div class="i-logo"><a href="<?php echo get_bloginfo('url');?>?post_type=trial_question"><img src="<?php echo get_bloginfo("template_url");?>/images/kvslogo.png"></a></div>
	<div class="img4"><img src="<?php echo get_bloginfo('template_url');?>/images/img8.jpg" /></div>
	<div class="img5"><img src="<?php echo get_bloginfo('template_url');?>/images/img12.jpg" /></div>
	<div id="topbar">
		<?php if ( is_user_logged_in() ) { ?>
					
			<i>Xin chào <?php echo wp_get_current_user()->user_login; ?></i> 
				<?php if (current_user_can('edit_post')): ?>| <a href="<?php echo get_admin_url(); ?>">Quản trị</a><?php endif;?>
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

<div class="i-body-content">

<div class="tq-content-container">
<?php
global $post;
$args = array( 'numberposts' => 1, 'post_type'=> 'session', 'post_status' => 'publish' );
$myposts = get_posts( $args );
foreach( $myposts as $post ) :	setup_postdata($post); 
$classes = wp_get_post_terms($post->ID,'class',array('fields' => 'names'));
$classterms = wp_get_post_terms($post->ID,'classterm',array('fields' => 'names'));
$subjects = wp_get_post_terms($post->ID,'subject',array('fields' => 'names'));
$marks = wp_get_post_terms($post->ID,'mark',array('fields' => 'names'));
$times = wp_get_post_terms($post->ID,'time',array('fields' => 'names'));
if (is_user_logged_in()):
?>
<div id="hot-action">
<div id="exam-info">
	<h3>Thông tin môn thi</h3>
	<ul>
		<li><span>
		<?php echo 'Lớp: '.$classes[0];?>
		</span></li>
		<li><span>
		<?php echo 'Học kỳ: '.$classterms[0];?>
		</span></li>
		<li><span>
		<?php echo 'Môn: '.$subjects[0];?>
		</span></li>
		<li><span>
		<?php echo 'Điểm tối đa:'.$marks[0];?>
		</span></li>
		<li><span>
		<?php echo 'Thời gian làm bài:'.$times[0].' Phút';?>
		</span></li>
</ul>
</div>
<div id="hot-button"><a href="<?php the_permalink();?>"><span>Làm bài thi</span></a>
<?php if (current_user_can('edit_post')):?><a target="_blank" href="<?php echo get_bloginfo('url');?>/?hidden_term=hidden-<?php echo $post->ID;?>"><span>Xem kết quả</span></a><?php endif;?>
</div></div>
<?php endif;?>
<?php endforeach;?>
<?php

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
$term_name = get_term_by('slug', get_query_var('classterm'), 'classterm');
$class_name = get_term_by('slug', get_query_var('class'), 'class');
$subject_name = get_term_by('slug', get_query_var('subject'), 'subject');
$query = new WP_Query( $args );
$hasTest = $query->post-count;
if ($query->post-count){
?>
<div class="wg-container trial-question">
<div class="wg-header">NỘI DUNG ĐỀ ÔN TẬP</div>
<div id="i-test-info">
<ul>
<li><span>
<?php echo 'Lớp: '.$class_name->name;?>
</span></li>
<li><span>
<?php echo 'Học kỳ: '.$term_name->name;?>
</span></li>
<li><span>
<?php echo 'Môn: '.$subject_name->name;?>
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
			if (current_user_can('edit_post')):
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
<?php if($hasTest):?>
</div>
<?php endif;?>

<div class="wg-container"><!-- start widget -->
<div class="wg-header">ĐỀ ÔN TẬP</div>
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
<?php
	if (!current_user_can('edit_post') && !$query->post-count):
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
	
?>

<?php if (current_user_can('edit_post')):?>
<div class="wg-container"><!-- start widget -->
<div class="wg-header">QUẢN LÝ ĐỀ THI & CÂU HỎI THI</div>
<div class="right-box">
	<ul>
		<li id="session-items"></li>
		<li id="question-items"></li>
	</ul>
</div>
<div class="wg-menu">
	<ul>
		<li>
			<div><span>Chọn Lớp:</span><span class="checked-item">Tất cả</span></div>
			<ul>
				<li id="class_all" class="get-ajax-post" >
					Tất cả
				</li>
				<?php 
					$args = array('taxonomy'=>'class');
					$classes = get_terms('class',$args);
					foreach ($classes as $class){
						echo '<li id="class_'.$class->slug.'" class="get-ajax-post" >';
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
				<li id="classterm_all" class="get-ajax-post" >
					Tất cả
				</li>
				<?php 
					$args = array('taxonomy'=>'classterm');
					$classterms = get_terms('classterm',$args);
					foreach ($classterms as $classterm){
						echo '<li id="classterm_'.$classterm->slug.'" class="get-ajax-post" >';
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
				<li id="subject_all" class="get-ajax-post" >
					Tất cả
				</li>
				<?php 
					$args = array('taxonomy'=>'subject');
					$subjects = get_terms('subject',$args);
					foreach ($subjects as $subject){
						echo '<li id="subject_'.$subject->slug.'" class="get-ajax-post" >';
						echo $subject->name;
						echo '</li>';
					}
				?>			

			</ul>
			
		</li>
	</ul>
</div>


</div><!-- end widget -->	

<?php
endif;
?>

</div>
<div class="i-right-sidebar"> <!-- right sidebar -->
	<div class="announcement box"> 
	
	<h1 class="area-header">THÔNG BÁO</h1> 
	<ul> 
	<?php
		$args = array(
			'posts_per_page' => '10',
			'paged' => 1,
			'post_type' => 'announcement',
			'post_status' => 'publish',
			'order' => 'DESC',
		);
		$query = new WP_Query( $args );
		while ( $query->have_posts() ) : $query->the_post();
	
		
 
			echo '<li> ';
			echo (!current_user_can('edit_post'))?'<a href="#">':'<a href="'.admin_url().'post.php?post='.$post->ID.'&action=edit">';
			the_title();
			echo '</a> ('.date_i18n( __( 'd/m/Y g:i A' ), strtotime( $post->post_date ) ).')';// (06/08/2011 02:45 pm)';
			//the_time();
			echo '<p>';
			the_content();
			echo '</p> ';

			echo '</li> ';
		


		endwhile;?>	
	
		</ul> 
		<h1 class="area-header">BẠN BÈ</h1>
		<ul id="friend-list-menu">
		<?php 
			$args = array('taxonomy'=>'class', 'hide_empty' => 0);
			$classes = get_terms('class',$args);
			$html = '';
			foreach ($classes as $class){

				if(!empty($class->parent)){
					
					$html .= '<li><a href="#" id="user-class_'.$class->slug.'">Lớp '.$class->name.
								'</a></li>';
				}

			}
				
			echo $html;
			?>
		</ul>
		<h1 class="area-header">LIÊN KẾT</h1>
		<ul>
		<?php get_links('-1', '<li>', '</li>', '<br />', FALSE, 'id', TRUE,FALSE, -1, TRUE, TRUE); ?>
		</ul>

	
	</div> 
</div> <!-- end sidebar -->
</div>
<div id="loadingDiv"><img src="<?php echo get_bloginfo('template_url');?>/images/loader.gif"/></div>
	

<div id="mybox" class="light-box"></div>
<div id="fade" class="black_overlay"></div>

 <div class="footer"> <div class="footer-info">Developed by KVS Company.</div></div>

<?php 
get_footer();
