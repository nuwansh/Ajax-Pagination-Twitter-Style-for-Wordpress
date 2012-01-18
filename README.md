# Ajax Pagination (twitter Style)

This plugin convert WordPress default pagination behavior into the Twitter style using Ajax functionality.

###Description 

The "Ajax Pagination (Twitter style) plugin is used to convert WrodPress pagination system to completely Ajax functionality and it presents Twitter's pagination style. You can use this plugin to where the pagination is available in your template.

###Installation
**Follow the steps below to install the plugin.**

* Download the plugin zip file.
* Unzip.
* Upload the `ajax-pagination/` folder to your `/wp-content/plugins/` directory.
* Activate the plugin through the Plugins menu in WordPress.
* Place  (localize the strings (second parameter) be replacing the parameters according to your current locale) in your template, for instance in `index.php`, `author.php` , `category.php` etc...

````php
<?php if(function_exists('genarate_ajax_pagination')) genarate_ajax_pagination('Read More', 'blue');  ?>
````
