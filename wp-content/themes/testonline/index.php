<?php
/**
 * Wed Feb 08, 2012 21:04:55 added by Thanh Son 
 * Email: thanhson1085@gmail.com 
 */

get_header();
?>
		<?php	
			$menu_items = wp_get_nav_menu_items(45); /*  Wed Feb 01, 2012 15:57:00 added by Thanh Son: Take care with number */ 

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
		?>
<div class="right-sidebar">
<p><a href="?hidden_term=<?php echo '#';?>">Test Now!</a></p>
<p><a href="?hidden_term=<?php echo '#';?>">Sample Question</a></p>
</div>
<div class="body-content">
</div>
<?php

get_footer();
