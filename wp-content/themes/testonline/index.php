<?php
/**
 * Wed Feb 08, 2012 21:04:55 added by Thanh Son 
 * Email: thanhson1085@gmail.com 
 */

get_header();
?>
<div class="i-header">
	<div class="i-logo"><a href="#"><img src="<?php echo get_bloginfo("template_url");?>/images/to-logo.png"></a></div>
</div>
		<?php	
	/*	$menu_items = wp_get_nav_menu_items(45); 

			$category_name = $_GET['category_name'];
			$current_menu = '';
			
			$result ='';
			$result .= '<div class="s-menu-container"><div class="s-menu"><ul class="menu-left">';
			foreach ($menu_items as $menu_item){
				//$pos = strpos($menu_item->url, $category_name);
				$pos = ($category_name)?preg_match('/'.$category_name.'$/i', $menu_item->url):false;
			    $current_menu = ($pos)? 's-current-menu': 's-menu-item';	
				if(empty($menu_item->menu_item_parent)) $result .= '<li class="'.$current_menu.'"> <a id="s-menu-'.$menu_item->ID.'" href="'.$menu_item->url.'">'.$menu_item->title.'</a></li>';
			}
			$result .='</ul></div></div>';
			echo $result;
			?>

			<?php
			$level = 0;
			$result='';
			foreach ($menu_items as $menu_item){
                //$pos = strpos($menu_item->url, $category_name);
				$pos = ($category_name)?preg_match('/'.$category_name.'$/i', $menu_item->url):false;
                $current_menu = ($pos)? 's-current-menu': 's-menu-item';
				if(empty($menu_item->menu_item_parent)){
					$menu_parent = $menu_item->ID;
					$result .= ($level == 2 || $level == 1)? '</ul></div></div>':'';
					$level = 0;
					$column = 0;
				}
				else{
                    //$dynamic_url = wp_get_nav_menu_item_url($menu_item);
                    if ($menu_item->menu_item_parent == $menu_parent) {
						$result .= ($level == 0 )? '<div class="megamenu" id="s-submenu-'.$menu_parent.'">': '';
						$result .= ($level == 2 || $level == 1)? '</ul></div>':'';
						if ($column == 3 || $level == 1){
							$result .= '<br style="clear: left" />';
							$column = 0;
						}
                        //$result .= '<div class="column"><script type="text/javascript">jkmegamenu.definemenu("#s-menu-'.$menu_parent.'", "#s-submenu-'.$menu_parent.'", "mouseover");</script><h3><a href="'.get_home_url().$dynamic_url.'">'.$menu_item->title.'</a></h3><ul>';
						$result .= '<div class="column"><script type="text/javascript">jkmegamenu.definemenu("#s-menu-'.$menu_parent.'", "#s-submenu-'.$menu_parent.'", "mouseover");</script><h3 class="'.$current_menu.'"><a href="'.$menu_item->url.'">'.$menu_item->title.'</a></h3><ul>';
						$level = 1;
						$column += 1;	
					}
					else{
                        $result .= '<li class="'.$current_menu.'"><a href="'.$menu_item->url.'">'.$menu_item->title.'</a></li>';
                        //$result .= '<li><a href="'.get_home_url().$dynamic_url.'">'.$menu_item->title.'</a></li>';
                        $level = 2;
					}
				}
			}
			$result .= ($level == 2 || $level == 1)? '</ul></div></div>':'';

			echo $result;
	*/
		?>

<div class="i-content">
<div class="i-right-sidebar">
<ul class="btn-test-list">
<?php
global $post;
$args = array( 'numberposts' => 5, 'post_type'=> 'session', 'post_status' => 'publish' );
$myposts = get_posts( $args );
foreach( $myposts as $post ) :	setup_postdata($post); ?>
	<li><a href="<?php the_permalink(); ?>"><span>Làm bài thi</span></a></li>
	<?php 
	if (get_user_role()){
		?>
		<li><a href="?hidden_term=hidden-<?php echo $post->ID; ?>" target="_blank"><span>Kết quả thi<span></a></li>
		<?php
	}

	?>

<?php endforeach; ?>
</ul>
<!--p><a href="?hidden_term=<?php echo '#';?>">Sample Question</a></p-->
<h2 class="i-right-h2">Ôn tập</h2>
<form method="POST" action="index.php">
<div class="i-term-container">
<h3 class="i-right-h3">Chọn lớp</h3>
<?php
$args = array( 'taxonomy' => 'class' );

$terms = get_terms('class', $args);

$count = count($terms);
$checked = (!get_query_var('class'))? 'checked="checked"': '';
if ($count > 0) {

    foreach ($terms as $term) {
		if (get_query_var('class') != $term->slug){
			echo '<p><input type="radio" name="class" '.$checked.' value="'.$term->slug.'"/><label>' . $term->name . '</label></p>';
    	}
		else{
			echo '<p><input type="radio" name="class" checked="checked" value="'.$term->slug.'"/><label>' . $term->name . '</label></p>';
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
$checked = (!get_query_var('subject'))? 'checked="checked"': '';
if ($count > 0) {

    foreach ($terms as $term) {
		if (get_query_var('subject') != $term->slug){
			echo '<p><input type="radio" name="subject" '.$checked.' value="'.$term->slug.'"/><label>' . $term->name . '</label></p>';
    	}
		else{
			echo '<p><input type="radio" name="subject" checked="checked" value="'.$term->slug.'"/><label>' . $term->name . '</label></p>';
		}
		$checked='';	
    }

}

?>
</div>
<div class="i-term-container">
<h3 class="i-right-h3">Chọn học kỳ</h3>
<?php
$args = array( 'taxonomy' => 'term' );

$terms = get_terms('term', $args);

$count = count($terms); 
$checked = (!get_query_var('term'))? 'checked="checked"': '';
if ($count > 0) {

    foreach ($terms as $term) {
		if ($_POST['term'] != $term->slug){
			echo '<p><input type="radio" name="term" '.$checked.' value="'.$term->slug.'"/><label>' . $term->name . '</label></p>';
    	}
		else{
			echo '<p><input type="radio" name="term" checked="checked" value="'.$term->slug.'"/><label>' . $term->name . '</label></p>';
		}
		$checked='';	
    }

}

?>
</div>
<p class="i-right-btn"><input type="submit" value="Thi thử"/></p>	
</form>
</div>
<div class="i-body-content">
<div class="tq-content-container">

<?php
if ( !get_query_var('class')){
	echo '<div class="i-welcome"></div>';
}
while ( have_posts() ) : the_post(); ?><?php 
	if ($post->post_type == 'trial_question'):
		$answers = array();
		$answers_true = array();
		$j++;
		?>
		<div class="q-content-container">
		<p class="q-title">Câu <?php echo $j.': '.$post->post_title; ?></p>
		<div class="q-desc"><?php the_content();//echo $post->post_content; ?></div>
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
			default:
				$input_type = 'checkbox';
		}
		$i = 1000;
		?>
		<?php
		foreach ($answers as $answer){
			?>
			<div class="q-answer-container">
			<?php
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
			?>
				</div>
			<?php
		}
		?>
		</div>
	
			<?php
			endif;
					endwhile;
					?>
		</div>
</div>
</div>
<?php

get_footer();
