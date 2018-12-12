<?php

// Visual Composer Blocks Load

if(!defined('ABSPATH')) die('-1');

// Class started
class stockVCExtendAddonClass{
	function __construct() {
		//We safely integrate with VC with this hook
		add_action('init', array($this, 'stockIntegrateWithVC') );
	}

	public function stockIntegrateWithVC() {
		//Check if Visual Composer is not installed
		if(!defined('WPB_VC_VERSION')){
			add_action('admin_notices', array($this, 'stockShowVcVersionNotice') );
			return;
		}

		// VC slides addons 
		include STOCK_ACC_PATH . '/vc-addons/vs-slide.php';

	}

	//Show Visual Composer Version
	public function stockShowVcVersionNotice(){
		$theme_data = wp_get_theme(); 
		echo '
			<div class="alert alert-warning">
				<p>'.sprintf(__('<strong>%s</strong>recommends </strong><a href="'.site_url().'/wp-admin/themes.php?page=tgmpa-install-plugins" target="_blank">Visual Composer</a></strong>plugin to be installed and activated on your site.','stock-humayunbd'), $theme_data->get('Name')).'</p>
			</div>';
	}

}

// Finally intialize code
new stockVCExtendAddonClass();