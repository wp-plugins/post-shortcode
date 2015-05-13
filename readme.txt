=== Plugin Name ===
Contributors: (sachin8600)
Donate link: 
Tags: post, custom-post, product, woocommerce,shortcode
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin is used for display box model post or product in short code.

== Description ==

This plugin is used for display box model post or product in short code.

For backwards compatibility, if this section is missing, the full length of the short description will be used, and
Markdown parsed.

A few notes about the sections above:

*   "Contributors" 
*   "Tags" post, custom-post, product, woocommerce,shortcode
*   "Requires at least" 3.4
*   "Tested up to" 4.1


== Installation ==

This section describes how to install the plugin and get it working.


1. Upload `post-shortcodes` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Place `<?php do_shortcode('[box-style-posts]'); ?>` in your templates

== Frequently Asked Questions ==

= How to use shortcode =

You can use shortcode in 2 way 

1. In that case .php file use <?php do_shortcode('[box-style-posts]'); ?>

2. In that case you use short code in backend in post editor or text widget use below code

[box-style-posts]

**********   Parameter of shortcode [box-style-posts]  *********

= posttype =
posttype=post //default posttype
check https://codex.wordpress.org/Class_Reference/WP_Query in that page find post_type

= orderby =
orderby=menu_order //default orderby
check https://codex.wordpress.org/Class_Reference/WP_Query in that page find orderby

= order =
order=ASC //default order
check https://codex.wordpress.org/Class_Reference/WP_Query in that page find order

= ids =
ids= //default ids is empty
check https://codex.wordpress.org/Class_Reference/WP_Query in that page find post__in
ids=1,2,3

= totalposts =
totalposts= -1//default totalposts
check https://codex.wordpress.org/Class_Reference/WP_Query in that page find posts_per_page
totalposts=1,2,3

= effects =
effects=animation //default effects
other effect is spin and frame
effects=spin
effects=frame

= color =
color=#fff //default color of border

= hcolor =
hcolor=#000 //default hover color of border

== width ==
width=8 //default stroke-width


= image =
image=medium //default image size
check https://codex.wordpress.org/Function_Reference/wp_get_attachment_image_src in that page find $size


== Screenshots ==

1. This screen backend shortcode to screenshot-1.png
2. This screen frontend post list to screenshot-2.png
3. This screen frontend product list to screenshot-3.png

== Changelog ==

= 1.0 =
* A change since the previous version.
* Another change.

= 0.5 =
* List versions from most recent at top to oldest at bottom.

== Upgrade Notice ==

= 1.0 =
Upgrade notices describe the reason a user should upgrade.  No more than 300 characters.

= 0.5 =
This version fixes a security related bug.  Upgrade immediately.