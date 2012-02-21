=== Codecogs Latex Equation Editor ===
Contributors: SamChouAlredyExists
Donate link: http://verymath.com/
Tags: latex, TinyMCE
Requires at least: 3.1
Tested up to: 3.1.2
Stable tag: 1.0.3

Adds codecogs WYSIWYG LaTex equation popup editor to wordrpess TinyMCE editor.

== Description ==

A Tiny MCE plugin which makes writing latex equation easy and WYSIWYG（what you see is what you get）. It converts latex code into image which shows real beautiful latex equations on your post.

It adds an "fx" botton on the wordpress TinyMCE editor, on clicks it the codecogs latex equation editor pops up, where you can edit latex, then click the copy button to copy the equation image back in TinyMCE textarea. 

You can also use this editor to only input latex code and let plugins like quicklatex, mathjax or Latex for WordPess to convert it to equation image, you'd better change line 90 in editor_plugin.js 
tinyMCE.activeEditor.execCommand('mceInsertContent', false, '<img src="'+name+'" alt="'+latex+'" align="absmiddle" />');
to
tinyMCE.activeEditor.execCommand('mceInsertContent', false, '\\['+latex+'\\]');
inorder to only copy LaTex code to TinyMCE textarea when click the copy button.

I just followed the tutorial written by Greg Winiarski(http://ditio.net/2010/08/15/adding-custom-buttons-to-wordpress-tinymce/) and make codecogs Tiny MCE plugin(http://www.codecogs.com/latex/integration/tinymce/install.php) into a wordpress plugin. Thanks the great guys. If you can make the plugin better to use please tell me in http://www.verymath.com/2011/05/10/codecogs-latex-equation-editor/

== Installation ==

1. Upload to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. find the "fx" button on you wordpress TinyMCE editor

You can also use this editor to only input latex code and let plugins like quicklatex, mathjax or Latex for WordPess to convert it to equation image, you'd better change line 90 in editor_plugin.js 
tinyMCE.activeEditor.execCommand('mceInsertContent', false, '<img src="'+name+'" alt="'+latex+'" align="absmiddle" />');
to
tinyMCE.activeEditor.execCommand('mceInsertContent', false, '\\['+latex+'\\]');
inorder to only copy LaTex code to TinyMCE textarea when click the copy button.

== Frequently Asked Questions ==

= A question that someone might have =

An answer to that question.

== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the directory of the stable readme.txt, so in this case, `/tags/4.3/screenshot-1.png` (or jpg, jpeg, gif)
2. This is the second screen shot

== Changelog ==

= 1.0.3 =
* fix the tinymce button
  add a way to only copy LaTex code to work with plugins like QuickLatex, see Installation.

= 1.0.2 =
* fix a conflict with another tinymce button.

= 1.0.1 =
* fix the directory error.

= 1.0.0 =
* first version.

== Upgrade Notice ==

= 1.0 =
Upgrade notices describe the reason a user should upgrade.  No more than 300 characters.

= 0.5 =
This version fixes a security related bug.  Upgrade immediately.

== Arbitrary section ==

You may provide arbitrary sections, in the same format as the ones above.  This may be of use for extremely complicated
plugins where more information needs to be conveyed that doesn't fit into the categories of "description" or
"installation."  Arbitrary sections will be shown below the built-in sections outlined above.

== A brief Markdown Example ==

Ordered list:

1. Some feature
1. Another feature
1. Something else about the plugin

Unordered list:

* something
* something else
* third thing

Here's a link to [WordPress](http://wordpress.org/ "Your favorite software") and one to [Markdown's Syntax Documentation][markdown syntax].
Titles are optional, naturally.

[markdown syntax]: http://daringfireball.net/projects/markdown/syntax
            "Markdown is what the parser uses to process much of the readme file"

Markdown uses email style notation for blockquotes and I've been told:
> Asterisks for *emphasis*. Double it up  for **strong**.

`<?php code(); // goes in backticks ?>`