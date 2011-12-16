<?php
  /*
  Plugin Name: Ajax Pagination (Twitter Style)  
  Description: The "Ajax Pagination" plugin is used to enhance the pagination experience of Wordpress just like Twiiter's pagination style & functionality 
  Author: Nuwansh
  Version: 1.0
  Author URI: http://www.bezago.com
  */

	if(!function_exists('get_option'))
	  require_once('../../../wp-config.php');
	//include the user out put of plugin

  //adding a new menu item
  function twitpaginate_admin_actions() {
    add_options_page("Ajax Pagination Option", "Ajax Pagination", 10, "ajax-pagination-display", "ajaxpaginate_admin");
  }
		
  function twitpaginate_admin(){
    if (!current_user_can('manage_options'))  {
      wp_die( __('You do not have sufficient permissions to access this page.') );
  }

  echo '<div class="wrap">';
  echo '<p>Here is where the form would go if I actually had options.</p>';
  echo '</div>';
  
	}
  
  
	/*******************************************************************************************************
	 * Following functions are use to front end interface
	 */

	/** This genarate_ajax_pagination function is used to genarate the pagination button
	 *  @param Array WordPress $wp_query variable
	 *  @param String Localize the Button name
	 *  @param String Button style
	 *  @return String HTML  pagination Button 
	 */
	
	function genarate_ajax_pagination($readMore='Read More', $buttonStyle = '' ){		
		global $wp_query;
		 
		if(is_array($wp_query->query)){
			$serialized = serialized($wp_query->query,true);
		}else{
			$serialized = $wp_query->query;
		}
		$maxpages = $wp_query->max_num_pages;

		//if no 2 pages just return nothing
		if($maxpages < 2 )
			return; 
		//get the ajax loading animation gif
		$src_path = WP_PLUGIN_URL . '/ajax-pagination/img/ajax-loader.gif';
		
		$linkHTML ='<div id="ajax-post-container"></div>
																<div class="more_post">
																		<a class="large awesome '.$buttonStyle.'" id="ajax_pagination" href="#" ><span class="_ajax_link_text">'.$readMore.'</span></a> <span class="_ajaxpaging_loading" style="display: none;"><img src="'.$src_path.'" alt="Loading.." /></span>
																</div>';
		$linkHTML .= '
			<script type="text/javascript">		  
						var wpquery = "'. $serialized .'";
						var maxpages = '. $maxpages .';
						
						  $(document).ready(function(){
              	var data = {
                  action: "my_action",
                  whatever: 1234
                };

                // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
                jQuery.post(ajaxurl, data, function(response) {
                  console.log("Got this from the server: " + response);
                });

                  /*									
                   $("#ajax_pagination").ajaxpaging({
                      query: wpquery,
                      maxpage: maxpages
									 });
                 */
                    });
			</script>
		';
		echo $linkHTML;
	}
	
	//serialized string creating
	function serialized($serialized = array(),$token){
		$serializeString = '';
		$sizeofArray = count($serialized);

		$temp = 0;		
		foreach($serialized as $key => $value){
				$temp++;
				if(is_array($value)){					
					$value = serialized($value,false);
				}
				//change the combain string
				if($token){
					$serializeString .=	$key . "=" . $value . (($temp < $sizeofArray)? "&": "");
				}else{
					$serializeString .=	$value . (($temp < $sizeofArray)? ",": "");
				}
		}
		return $serializeString;
	}

	//define the js files
	function ajaxpaging_js(){
		wp_enqueue_script('wp_jq_script', 'http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js'); 
		wp_register_script('twitnavi', WP_PLUGIN_URL . '/ajax-pagination/js/jquery.ajaxpaging.js.php');
		wp_enqueue_script('twitnavi');
	}
	
	//load the css file
	function ajaxpaging_css(){
		  wp_register_style('twitCSS', WP_PLUGIN_URL . '/ajax-pagination/css/ajaxpaging.css');
    wp_enqueue_style('twitCSS');
	}
		//the configueration is not available at this version. will hope to add some configuration next versios
  //add_action('admin_menu', 'twitpaginate_admin_actions');

		//load the jQuery script files
		add_action('wp_print_scripts', 'ajaxpaging_js');
		//load the CSS files
		add_action('wp_print_styles','ajaxpaging_css');
		
		//print the next button link to the site
		//add_action('wp_footer', 'genarate_ajax_pagination');
    //
    //
    //
    //
    //
    //
    //
    //
    //
    //
    // Testing
    add_action('wp_ajax_my_action', 'my_action_callback');

    function my_action_callback() {
      global $wpdb; // this is how you get access to the database

      $whatever = intval( $_POST['whatever'] );

      $whatever += 10;

            echo $whatever;

      die(); // this is required to return a proper result
    }
?>
