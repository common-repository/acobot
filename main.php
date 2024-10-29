<?php
/*
Plugin Name: Acobot Live Chat Robot
Plugin URI: http://www.acobot.com/wordpress?s=wordpress_plugin_list
Description: Enhance your WordPress with a live chat robot in 3 minutes. Boost online sales like never before. It's simple, easy and fast. To get started, 1) Click <strong>Activate</strong> link to the left. 2) <a href="http://acobot.com/user/register?s=wordpress_plugin_list" target="_blank"/><strong>Sign up</strong></a> for a free instllation key. 3) Go to the Acobot <a href='options-general.php?page=acobot'><strong>Configruation</strong></a> page in your WordPress and provide the key. To teach your robot, log on to <a href="http://acobot.com/user?s=wordpress_plugin_list">acobot.com</a>.
Version: 2.0
Author: Acobot
Author URI: http://www.acobot.com/wordpress?s=wordpress_plugin_list
License: GPL2
*/
?>
<?php 
// add the admin settings
add_action('admin_init', 'acobot_admin_init');
add_action('wp_footer', 'acobot_footer');
// add the admin options page
add_action('admin_menu', 'acobot_admin_add_page');

function acobot_admin_init(){

    if (isset($_GET['reset_settings'])) {
        update_option('acobot_token', '');
        update_option('acobot_code_script', '');
        wp_redirect(admin_url().'options-general.php?page=acobot&reset_success=1');
    }
    if (isset($_GET['reset_success'])) {
        echo '    <div id="message" class="updated fade">
                    <p>'.__('Reset success', 'acobot').'</p>
                </div>';
    }
    if (isset($_GET['update_success'])) {
        echo '    <div id="message" class="updated fade">
                    <p>'.__('Updated successfully. Chat is installed', 'acobot').'</p>
                </div>';

    }
    if (isset($_GET['update_account']) && count($_POST)) 
    {
        if($_POST['acobot_token']!="")
        {
                update_option('acobot_token', $_POST['acobot_token']);
                update_option('acobot_code_script', $_POST['acobot_code_script']);
                wp_redirect(admin_url().'options-general.php?page=acobot&connect_success=1');        
        }
    }
    register_setting( 'acobot_token', 'acobot_token');
    register_setting( 'acobot_code_script', 'acobot_code_script');
}

function acobot_admin_add_page() {
    add_options_page('Acobot Live Chat', 'Acobot Live Chat', 'manage_options', 'acobot', 'acobot_options_page');
}

function acobot_footer() {
    if ($token = get_option('acobot_token')) {
    	echo '<script type="text/javascript">var _aco = _aco || [];</script><script src="http://js.acobot.com/'. $token .'.js" async="true"></script>';
    	if ($script = get_option('acobot_code_script')) {
    	    echo $script;
    	}
    }
}
// display the admin options page
function acobot_options_page() {
    $options_token = get_option('acobot_token');
    $options_code_script = get_option('acobot_code_script');
?>                                                                                                                                           
<div class="wrap">
    <h2><?php _e('Acobot FREE Live Chat Robot'); ?></h2>
    <br />
    <div id="poststuff" class="jd-settings">
        <div>

            <div class="postbox">
                <h3><b><?php _e('Get Installation Key', 'acobot'); ?></b></h3>
                <div class="inside">
					<p style='font-size:14px;'>
					1. <a style="font-size:14px;" href="http://www.acobot.com/wordpress?s=wordpress_plugin_configuration" class="nyroModal" target="_blank"><b>Sign up</b></a> at acobot.com.<br/>
					2. Choose <b>Install</b> from the main menu.<br/>
					3. Copy your installation key and paste it below.
					</p>                    
                    <form method="post" action="options.php">
                    <?php settings_fields('acobot_token'); ?>
                    <p><input type="text" name="acobot_token" size=40 value="<?php echo trim($options_token); ?>" /></p>
                    <p><input type="submit" name="submit" value="<?php _e("Activate My FREE Robot", 'acobot'); ?>" class="button-primary" /></p>					
                    </form>
					<p style='font-size:12px;'>Clean cache if the chat box doesn't show after activation.</p>
                </div>
            </div>
			
			
			<div class="postbox">
                <h3><b><?php _e('Help Aco and Help Yourself', 'acobot'); ?></b></h3>
                <div class="inside">
		    <p style='font-size:14px;'>Please, support this FREE service by giving Aco a few clicks.</p>
			<table border="0" cellspacing="30">
				<tr>
					<td><a style="font-size:14px;" href="http://wordpress.org/extend/plugins/acobot/" target="blank"><img src="http://acobot.com/sites/default/files/icons/rating.png" alt="" /><br/><b>Rate Aco</b></a></td>
					<td><a style="font-size:14px;" href="https://twitter.com/bot_aco" target="blank"><img src="http://acobot.com/sites/default/files/icons/twitter.png" alt=""/><br/><b>Follow Aco</b></a></td>
					<td><a style="font-size:14px;" href="http://www.facebook.com/acobot" target="blank"><img src="http://acobot.com/sites/default/files/icons/facebook1.png" alt=""/><br/><b>Like Aco</b></a></td>		
					<td><a style="font-size:14px;" href="https://digg.com" target="blank"><img src="http://acobot.com/sites/default/files/icons/dig.png" alt=""/><br/><b>Digg Aco</b></a></td>
				<tr/>
			</table>
				<p style='font-size:14px;'>Also, tell your friends about Aco!</p>
                </div>
            </div>
            
                    
        </div>
    </div>
</div>
<?php } ?>
