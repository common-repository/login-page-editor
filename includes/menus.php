<?php 
// register main DEVotion menus
$allowmenu = true;
if($allowmenu) {
	function register_loginpageeditor_menu_page(){
		add_submenu_page( 
			'options-general.php', 
			__( 'Login Page Editor', 'login-page-editor' ),
			__( 'Login Page Editor', 'login-page-editor' ),
			'manage_options',
			'login-page-editor',
			'loginpageeditor_login_editor_page',
			100
		);
	}
	add_action( 'admin_menu', 'register_loginpageeditor_menu_page' );
}
