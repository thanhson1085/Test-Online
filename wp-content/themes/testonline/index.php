<?php
/**
 * Wed Feb 08, 2012 21:04:55 added by Thanh Son 
 * Email: thanhson1085@gmail.com 
 */


$terms = get_terms(array('taxonomy' => 'subject'));
print_r($terms);
foreach($terms as $term){ print_r($term);}
