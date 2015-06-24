=== Plugin Name ===
Contributors: sachin8600
Donate link: 
Tags: post, custom-post, post-widget, post-shortcode, custom-taxonomy, category
Requires at least: 3.4.1
Tested up to: 4.2.2
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin is used for display posts in widget as well as shortcode.


== Description ==

This plugin is used for display posts in widget as well as shortcode.

Display post shortcode

Display post widget

Customize display output without editing plugin

Display post as well as custome post type

Display post with perticuler taxonomy, term, category, tag

Display post with selection of display like: title, image, category, tag

*   "Contributors" sachin8600

*   "Tags" post, custom-post, widget, shortcode, category-post

*   "Requires at least" 3.4.1

*   "Tested up to" 4.2.2



== Installation ==

This section describes how to install the plugin and get it working.


1. Upload `post-shortcode` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Place `<?php do_shortcode('[pcs]'); ?>` in your templates

== Frequently Asked Questions ==

= How to use shortcode =

You can use shortcode in 2 way 

1. In .php file use : <?php do_shortcode('[pcs]'); ?> code or use : [pcs] use in backend editor. 
   In backend menu : 'Post Shorcode' here is generator of shortcode as well as customization

2. Use ps widget in widget area to get output of shortcode


**********   Parameter of shortcode [pcs]  *********

= posttype =
posttype=post //default posttype
check https://codex.wordpress.org/Class_Reference/WP_Query in that page find post_type

= orderby =
orderby=ID //default orderby
check https://codex.wordpress.org/Class_Reference/WP_Query in that page find orderby

= order =
order=ASC //default order
check https://codex.wordpress.org/Class_Reference/WP_Query in that page find order


= postcount =
postcount= 3//default postcount
check https://codex.wordpress.org/Class_Reference/WP_Query in that page find posts_per_page


= template =
template=ws //default effects
other effect is iws, gws and igws

= showfield =
showfield=title,thumbnail,excerpt //default showfield
other are: date,author,cc,content,readme,category,tag

= expertlength =
expertlength=100 //default expert length

== readmoretitle ==
readmoretitle=8 //Read more readmoretitle


= customfield =
customfield= //default customfield is empty


== Screenshots ==

1. This screen backend widget to screenshot-1.png
2. This screen frontend output to screenshot-2.png
3. This screen backend shortcode generator and customization to screenshot-3.png

== Changelog ==

= 2.0.1 =
Solving bug about category and excerpt.

= 2.0.0 =
* A change of whole plugin .
* Another change.

= 1.0 =
* A change since the previous version.
* Change add weidget and shortcode of post type and category.


== Upgrade Notice ==
= 2.0.1 =
Solving bug about category and excerpt.
= 2.0.0 =
This change of whole plugin its like new plugin with same name.