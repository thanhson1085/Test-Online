<?php
/*
Plugin Name: codecogs latex equation editor
Plugin URI: http://www.verymath.com/codecogs-latex-equation-editor
Description: Adds codecogs latex equation popup editor to wordrpess TinyMCE editor.
Author: SamChouAlredyExists
Version: 1.0.2
Author URI: http://www.verymath.com/author/sam
*/

function latex_equation_init() {
	add_filter('mce_external_plugins', "equation_register");
	add_filter('mce_buttons', 'equation_add_button', 0);
}

function equation_add_button($buttons)
{
    array_push($buttons, "separator", "equation");
    return $buttons;
}

function equation_register($plugin_array)
{
    $url = trim(get_bloginfo('url'), "/")."/wp-content/plugins/codecogs-latex-equation-editor/editor_plugin.js";

    $plugin_array['equation'] = $url;
    return $plugin_array;
}

add_action('init', 'latex_equation_init');
