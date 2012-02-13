<?php
/**
 * Mon Feb 13, 2012 11:34:46 added by Thanh Son 
 * Email: thanhson1085@gmail.com 
 */
?>
        <p><?php echo $post->post_title; ?></p>
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


