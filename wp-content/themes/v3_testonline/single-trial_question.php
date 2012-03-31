<?php
/**
 * Mon Feb 13, 2012 11:34:46 added by Thanh Son 
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
<div class="tq-content">

        <p class="q-title"><?php echo $post->post_title; ?></p>
        <p><?php the_content();//echo $post->post_content; ?></p>
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
?>
</div>
 <div class="footer"> <div class="footer-info">Developed by KVS Company.</div>
 </div>
<?php
get_footer();
