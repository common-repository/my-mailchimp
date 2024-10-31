<?php
/*
Plugin Name: My MailChimp Widget
Plugin URI: http://weengle.com/my-mailchimp.html
Description: Display MailChimp Subscription Widget In Your Sidebar.
Author: Debasis Pradhan
Version: 1.0
Author URI: http://debasispradhan.com/
*/

/* Release Date: 15/04/2014; Tuesday */


// Register style sheet.
add_action( 'wp_enqueue_scripts', 'register_plugin_styles' );

/**
 * Register style sheet.
 */
function register_plugin_styles() {
	wp_register_style( 'my-mailchimp', plugins_url( 'my-mailchimp/css/style.css' ) );
	wp_enqueue_style( 'my-mailchimp' );
}

/*-----------------------------------------------------------------------------------*/
//	Register Widgets
/*-----------------------------------------------------------------------------------*/
		add_action( 'widgets_init', 'register_theme_widgets' );
		
		function register_theme_widgets() {
		register_widget( 'Newsletter_Subscription_Widget' );
		}
		
		
class Newsletter_Subscription_Widget extends WP_Widget {
  
  	function Newsletter_Subscription_Widget() {	
  		$widget_ops = array( 'classname' => 'Newsletter_Subscription_Widget', 'description' => __("Custom Newsletter Subscription Widget", 'framework') );
  		$this->WP_Widget( 'Newsletter_Subscription_Widget', 'Weengle : MailChimp Newsletter Widget', $widget_ops);
  	}
  	
  	function form($instance) {
  			
  		$instance = wp_parse_args( (array) $instance, array( 
		                                                'title' => 'Newsletter',
														'form_text' => 'Sign up Our Newsletter to Get Latest Updates', 
														'form_action' => '#', 
														'email_field_name' => 'email', 
														));
        
		$title= esc_attr($instance['title']);
        $form_text = esc_attr($instance['form_text']);
		$form_action = esc_attr($instance['form_action']);
		$email_field_name = esc_attr($instance['email_field_name']);
  
  		        ?>
                <p>
			            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title:', 'framework'); ?></label>
			            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		        </p>
                
  				<p>
  		                <label for="<?php echo $this->get_field_id('form_text'); ?>"><?php _e( 'Sub Title:', 'framework') ?></label>
  		                <input class="widefat" id="<?php echo $this->get_field_id('form_text'); ?>" name="<?php echo $this->get_field_name('form_text'); ?>" type="text" value="<?php echo $form_text; ?>" />
  		        </p>
  		        
                <p>
  		                <label for="<?php echo $this->get_field_id('form_action'); ?>"><?php _e( 'Form Action URL:', 'framework') ?></label>
  		                <input class="widefat" id="<?php echo $this->get_field_id('form_action'); ?>" name="<?php echo $this->get_field_name('form_action'); ?>" type="text" value="<?php echo $form_action; ?>" />
  		        </p>
                
                <p>
  		                <label for="<?php echo $this->get_field_id('email_field_name'); ?>"><?php _e( 'Email Field Name:', 'framework') ?></label>
  		                <input class="widefat" id="<?php echo $this->get_field_id('email_field_name'); ?>" name="<?php echo $this->get_field_name('email_field_name'); ?>" type="text" value="<?php echo $email_field_name; ?>" />
  		        </p>  
                <?php echo '<p><a href="http://weengle.com/" target="_blank"><img src="http://weengle.com/wp-content/uploads/2013/01/logo-300x94.png" alt="Weengle Technologies" title="Weengle Technologies Pvt. Ltd." style="width: 276px;"></a></p>'; ?>		  		  					  		
  		        <?php
      }
  
  	function update($new_instance, $old_instance) 
  	{
		$instance = $old_instance;  		
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['form_text'] = strip_tags($new_instance['form_text']);
		$instance['form_action'] = strip_tags($new_instance['form_action']);
		$instance['email_field_name'] = strip_tags($new_instance['email_field_name']);

		
		return $instance;  
	}
  
  	function widget($args, $instance) {
  	
  		extract($args);
        
		$title = apply_filters('widget_title', $instance['title']);		
			if ( empty($title) ) 
					$title = false;
		
        $form_text = $instance['form_text'];
		$form_action = $instance['form_action'];
		$email_field_name = $instance['email_field_name'];

		
  		echo $before_widget;		
		
		if($title):
			echo $before_title;
				echo $title;
			echo $after_title;	
		endif;
		
  		    ?>  
                 
            <div class="newsletter">                 
                  <form action="<?php echo $form_action; ?>" id="newsletter" method="post" target="_blank">                      <p><?php echo $form_text;?></p>
                      <p>
                         <?php /*?><label class="display-ie8" for="we_email"><?php _e("Email Address", 'framework'); ?></label><?php */?>
                         <input type="text" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="<?php _e("Email Address", 'framework'); ?>" title="<?php _e("* Please enter valid Email Address", 'framework'); ?>">
                          <input type="submit" id="we_submit" value="<?php _e("Subscribe", 'framework'); ?>" class="readmore">
                      </p>
                      <div class="error-container"></div>
                  </form>
                              </div>               
            <?php	
				  
        echo $after_widget;		  
  	}
	  
}
?>