=== Ajax Pagination (Twitter Style) ===
Contributors: nuwansh
Tags: AJAX, jquery, pagination, twitter
Requires at least: 3.0.0
Tested up to: 3.3.1
Stable Tag: 1.2

This plugin convert WordPress defautl pagination behavior to the Twitter sytle using Ajax functionality. 

== Description ==

The "Ajax Pagination (Twitter style) plugin is used to convert WrodPress pagination system to completely Ajax functionality and it presents Twitter's pagination style. You can use this plugin to where the pagination is available in your template. 

== Installation ==

Follow the steps below to install the plugin.

1. Download the plugin zip file.
2. Unzip.
3. Upload the `ajax-pagination/` folder to your `/wp-content/plugins/` directory.
4. Activate the plugin through the Plugins menu in WordPress.
5. Place `<?php if(function_exists('genarate_ajax_pagination')) genarate_ajax_pagination('Read More', 'blue');  ?>` (localize the strings (second parameter) be replacing the parameters according to your current locale) in your template, for instance in `index.php`, `author.php` , `category.php` etc...



== Frequently Asked Questions ==

= How can I get Ajax pagination button =

Keep it remember to place the `genarate_ajax_pagination()` function after  the `get_template_part( 'loop', '' )` function in your template.

= How can I change Button styles =

Thrid parameter is used to change button sytles. This Button is available following colors

<ul>
<li> black (defualt: no need to set third parameter) </li>
<li> blue </li>
<li> red </li>
<li> magenta </li>
<li> orange </li>
<li> yellow </il>
</ul>

See more: http://www.zurb.com/blog_uploads/0000/0617/buttons-03.html

= Have you got any questions? =

Oh! that's good, Please email to me nuwan28 at gmail.com


== Screenshots ==

1. Pagination Button

== Changelog ==

= 1.0.0 =
* Initial Release

= 1.0.2 = 
* fixed the error in button load and change the function parameters `genarate_ajax_pagination()`

= 1.1 = 
* optimized to query ajax functionality with fancy button 

