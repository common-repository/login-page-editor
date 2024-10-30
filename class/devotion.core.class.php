<?php 
if(!class_exists('DevotionCoreLPE')) {
	class DevotionCoreLPE {
		
		public function __construct() {
			$this->init();
		}

		public function init() {
			add_action('wp_ajax_loginform_clear', array($this, 'devotion_loginform_clear'));
			add_action('wp_ajax_loginform_process', array($this, 'devotion_loginform_process'));
			add_filter( 'plugin_action_links_login-page-editor/login-page-editor.php', array($this, 'settings_link') );
			add_filter( 'safe_style_css', function( $styles ) {
				$styles[] = 'display';
				return $styles;
			} );
			$this->devotionFetchTrees();
		}
	
		public function devotionFetchTrees() {
			if(!get_transient('devotion_trees')||get_transient('devotion_trees')=="") {
				$arrContextOptions = array(
					"ssl" => array(
						"verify_peer" => false,
						"verify_peer_name" => false,
					),
				);
				$response = wp_remote_get('https://www.devotion-plugin.com/api-v2/checkImpact.php');
				$body = wp_remote_retrieve_body( $response );
				$treeInfo = explode('|', $body);
				set_transient('devotion_trees', esc_html($treeInfo[0]), 43200);
				set_transient('devotion_carbon', esc_html($treeInfo[1]), 43200);
			}
		}
		
		public function settings_link( $links ) {
			$url = esc_url( add_query_arg(
				'page',
				'login-page-editor',
				get_admin_url() . 'options-general.php'
			) );
			$settings_link = "<a href='$url'>" . __( 'Settings' ) . '</a>';
			array_push(
				$links,
				$settings_link
			);
			return $links;
		}
		
		public function devotion_loginform_process() {
			$scarray = array();
			// get the post data from the ajax field
			$postData = $_POST['formdata'];
			parse_str($postData, $vars);
			$imgchecks = array('background-image', 'logo');
			foreach ($vars as $key => $val) {
				// sanitize the post data
				if(in_array($key, $imgchecks)) {
					// sanitize URL fields
					$scarray[sanitize_key($key)] = sanitize_url($val);
				} else {
					// sanitize text fields
					$scarray[sanitize_key($key)] = sanitize_text_field($val);
				}
			}
			$addarray = $scarray;
			update_option( 'devotion_logineditor', $addarray );
			exit();
		}
		
		// CLEAR LOGIN FORM DATA
		public function devotion_loginform_clear() {
			update_option( 'devotion_logineditor', '');
			exit();
		}

	}
}