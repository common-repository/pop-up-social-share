<?php
/*
Plugin Name:Pop Up Social Share
Plugin URI: http://oceanwebthemes.com/pop-up-social-share
Description:Pop Up Social Share is Simple Light Social Plugin With Pop Up
Version: 1.3
Author: oceanwebthemes
Author URI: http://oceanwebtech.com
Text Domain: popup-social-share
*/


function popup_social_share_buttons_menu(){
  add_submenu_page("options-general.php", "PopUp Social Share", "PopUp Share", "manage_options", "popup-social-share", "popup_social_share_page");
}

add_action("admin_menu", "popup_social_share_buttons_menu");

function popup_social_share_page(){
                ?>
      <div class="wrap">
         <h1>Social share Buttons Plugin By <a href="http://oceanwebtech.com" target="_blank">Ocean Web</a></h1>
         
         <form method="post" action="options.php">
            <?php
               settings_fields("popup_social_share_config_section");
 
               do_settings_sections("popup-social-share");
                
               submit_button(); 
            ?>
         </form>
         <div class="wrap">
        <h3>Follow us to get latest update. DM me on Twitter for quick reply.</h3>
        <a href="https://twitter.com/oceanwebtech" class="twitter-follow-button" data-show-count="false">Follow @oceanwebtech</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

         <div id="fb-root"></div>
                <script>(function(d, s, id) {
                 var js, fjs = d.getElementsByTagName(s)[0];
                  if (d.getElementById(id)) return;
                  js = d.createElement(s); js.id = id;
                  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
                 fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
            
        <div class="fb-like" data-href="https://www.facebook.com/oceanwebtech" data-width="50px" data-layout="standard" data-action="like" data-show-faces="false" data-share="false"></div>
        </div>
      </div>
   <?php
}




function popup_social_share_buttons_settings(){
    add_settings_section("popup_social_share_config_section", "", null, "popup-social-share");
 
    add_settings_field("popup-social-share-facebook", "Enable Here", "popup_social_share_checkbox", "popup-social-share", "popup_social_share_config_section");
    add_settings_field("popup-social-share-twitter-name", "Twitter Options","popup_social_share_popup_options", "popup-social-share", "popup_social_share_config_section");
 
    register_setting("popup_social_share_config_section", "popup-social-share-facebook");
    register_setting("popup_social_share_config_section", "popup-social-share-twitter");
    register_setting("popup_social_share_config_section", "popup-social-share-twitter-name");
    register_setting("popup_social_share_config_section", "popup-social-share-googleplus");
    register_setting("popup_social_share_config_section", "popup-social-share-pinterest");

    register_setting("popup_social_share_config_section", "popup-social-share-popup-rel-nofollow");
    register_setting("popup_social_share_config_section", "popup-social-share-popup-custom-label");
    register_setting("popup_social_share_config_section", "popup-social-share-email");
}

function popup_social_share_checkbox(){  
   ?>
    <div class="postbox" style="width: 65%; padding: 30px;">
        <input type="checkbox" name="popup-social-share-facebook" value="1" <?php checked(1, get_option('popup-social-share-facebook'), true); ?> /> Facebook
        <br><br><input type="checkbox" name="popup-social-share-twitter" value="1" <?php checked(1, get_option('popup-social-share-twitter'), true); ?> /> Twitter
        <br><br><input type="checkbox" name="popup-social-share-googleplus" value="1" <?php checked(1, get_option('popup-social-share-googleplus'), true); ?> /> Google+
        <br><br><input type="checkbox" name="popup-social-share-pinterest" value="1" <?php checked(1, get_option('popup-social-share-pinterest'), true); ?> /> Pinterest
        <br><br><input type="checkbox" name="popup-social-share-email" value="1" <?php checked(1, get_option('popup-social-share-email'), true); ?> /> Email
    </div>
   <?php
          }

function popup_social_share_popup_options(){  
   ?>
   <div class="postbox" style="width: 65%; padding: 30px;">
        <input type="checkbox" name="popup-social-share-popup-rel-nofollow" value="1" <?php checked(1, get_option('popup-social-share-popup-rel-nofollow'), true); ?> /> add rel="nofollow" to all links
        <br><br><input type="text" name="popup-social-share-twitter-name" value="<?php echo esc_attr(get_option('popup-social-share-twitter-name')); ?>" /> Twitter Username (without @)
        <br><br><input type="text" name="popup-social-share-popup-custom-label" value="<?php echo esc_attr(get_option('popup-social-share-popup-custom-label')); ?>" /> Custom Header
   </div>
   <?php
}
 
add_action("admin_init", "popup_social_share_buttons_settings");

function add_ocean_popup_social_share_icons($content) {
    
        //Url of the current Page
        $PopUpURL = get_permalink();
 
        // Title of the current page 
        $PopUpTitle = str_replace( ' ', '%20', get_the_title());
        
        if ( has_post_thumbnail() ) {
        $PopUpThumbnail  = wp_get_attachment_url( get_post_thumbnail_id() );
           }
        // Construct share URL without using any script
        $twitterUserName = get_option("popup-social-share-twitter-name");
        $twitterURL = 'https://twitter.com/intent/tweet?text='.$PopUpTitle.'&amp;url='.$PopUpURL.'&amp;via='.$twitterUserName;

        $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$PopUpURL;
        $googleURL = 'https://plus.google.com/share?url='.$PopUpURL;
        $bufferURL = 'https://bufferapp.com/add?url='.$PopUpURL.'&amp;text='.$PopUpTitle;
        
         if ( has_post_thumbnail() ) {
        $pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$PopUpURL.'&amp;media='.$PopUpThumbnail.'&amp;description='.$PopUpTitle; }
        $emailURL = 'mailto:?subject=' . $PopUpTitle . '&amp;body=Check out this site: '. $PopUpURL .'" title="Share by Email';
 
        if(get_option("popup-social-share-popup-rel-nofollow") == 1){
            $rel_nofollow = 'rel="nofollow"';
        }else{
            $rel_nofollow = '';
        }
 
        // Add share button at the end of page/page content
        $content .= '<div style="clear:both"></div><div class="popup-social">';
        $content .= '<!-- Social share Buttons Plugin without with Default WordPress Jquery- START-->';
        $content .= '<h5>'.get_option("popup-social-share-popup-custom-label").'</h5>';
        
        if(get_option("popup-social-share-facebook") == 1){
            $content .= '<a class="popup-facebook popup-link" href="'.$facebookURL.'" target="_top" '. $rel_nofollow .'>Facebook</a>';
        }
        if(get_option("popup-social-share-twitter") == 1){
            $content .= '<a class=" popup-twitter popup-link"  href="'. $twitterURL .'" target="_blank" '. $rel_nofollow .'>Twitter</a>';
        }
        if(get_option("popup-social-share-googleplus") == 1){
            $content .= '<a class=" popup-googleplus popup-link" href="'.$googleURL.'" target="_blank" '. $rel_nofollow .'>Google+</a>';
        }
         if ( has_post_thumbnail() ) {
        if(get_option("popup-social-share-pinterest") == 1){
            $content .= '<a class="popup-pinterest popup-link" href="'.$pinterestURL.'" target="_blank" '. $rel_nofollow .'>Pin It</a>';
        } }
        if(get_option("popup-social-share-email") == 1){
            $content .= '<a class="popup-email popup-link" href="'.$emailURL.'" target="_blank" '. $rel_nofollow .'>Email</a>'; 
        }
        $content .= '<!-- Social share Buttons Plugin - END-->';

        $content .= '</div><div style="clear:both">';

        return $content;
}

add_filter( 'the_content', 'add_ocean_popup_social_share_icons');





function popup_social_share_style() 
{
    wp_register_style("popup-social-share-style", plugin_dir_url(__FILE__) . "css/style.css");
    wp_register_script("popup-social-share-script", plugin_dir_url(__FILE__) . "js/scripts.js", array('jquery'), '1.0.0', true );
    wp_enqueue_style("popup-social-share-style");
    wp_enqueue_script( "popup-social-share-script");
    
}

add_action("wp_enqueue_scripts", "popup_social_share_style");


