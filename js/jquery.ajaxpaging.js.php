/*  
	Copyright 2010  Nuwan Sameera  (email : nuwan28@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

*/

/** this query simple plugin used to Ajax functionality for query next posts in Wordpress database */

<?php
  if (!function_exists('add_action')){
    require_once("../../../../wp-config.php");
  }
?>

(function($) {
	/**
	 * This plugin is used to Ajax Pagenavigation functionlity 
		*/	
		$.fn.ajaxpaging = function(options){
			//build main options before element iteration
			var opts = $.extend({}, $.fn.ajaxpaging.defaults, options);
			
			  //iterate and reformat each matched element
			return this.each(function() {
				var $this = $(this);
				
				//get the variables of query
				var queryString = opts.query;
				var maxpages = opts.maxpage;
				var tempPageCount = 1;
				
					$this.bind('click', function(){	
							tempPageCount ++;
							
							//Ajax request for query next post item from the database
							      $.ajax({
												type: "POST",
												url: "<?php echo WP_PLUGIN_URL; ?>/ajax-pagination/ajax-query.php",
												data: queryString + "&paged=" + tempPageCount,
												dataType: "html",
												beforeSend: loadingImage,
												success: function(msg){
													//append the new content 
													$("#ajax-post-container").append("<hr class='ajaxpaging-separator' />"+msg);
													
													/** hide next link for fetch more post if you are in the last page */
													if(maxpages == tempPageCount)
														$('#ajax_pagination').hide();
												},
												complete: hideloading
											});
							return false; 
					});
					
			 });
		};

		/** loadingImage function is used to show loading image until Ajax request complete */
		function loadingImage(){
			//first hide the text of the read more link and show the loading icon
			 $("._ajaxpaging_loading").show();
		}
		 
    /** hide the loading image */
    function hideloading(){
			//then just hide the loading icon and show the link text
     $("._ajaxpaging_loading").hide();
    }
		
		// plugin defaults
		$.fn.ajaxpaging.defaults = {
				query: '',
				maxpage: 0
		};
})(jQuery);
