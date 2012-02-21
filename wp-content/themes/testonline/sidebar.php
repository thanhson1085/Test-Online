<?php
/**
 * Mon Feb 20, 2012 21:07:29 added by Thanh Son 
 * Email: thanhson1085@gmail.com 
 */
?>
<ul class="btn-test-list">
<?php
global $post;
$args = array( 'numberposts' => 1, 'post_type'=> 'session', 'post_status' => 'publish' );
$myposts = get_posts( $args );
foreach( $myposts as $post ) :  setup_postdata($post); ?>
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
<h3 class="i-right-h3">Chọn học kỳ</h3>
<?php
$args = array( 'taxonomy' => 'classterm' );

$terms = get_terms('classterm', $args);

$count = count($terms);
$checked = (!get_query_var('classterm'))? 'checked="checked"': '';
if ($count > 0) {

    foreach ($terms as $term) {
        if (get_query_var('classterm') != $term->slug){
            echo '<p><input type="radio" name="classterm" '.$checked.' value="'.$term->slug.'"/><label>' . $term->name . '</label></p>';
        }
        else{
            echo '<p><input type="radio" name="classterm" checked="checked" value="'.$term->slug.'"/><label>' . $term->name . '</label></p>';
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
<p class="i-right-btn"><input type="submit" value="Ôn tập"/></p>
</form>

