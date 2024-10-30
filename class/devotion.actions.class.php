<?php 
if(!class_exists('DevotionActionsLPE')) {
	class DevotionActionsLPE {
		
		public function __construct() {
			$this->init();
		}

		public function init() {
			// login page
			add_action('login_enqueue_scripts', array($this, 'loginPageOutput'));
		}
		
		/***********************************
		LOGIN EDITOR ACTIONS
		***********************************/

		public function loginPageOutput() { 
			$dv = new DevotionLPE();
			$getoptions = get_option('devotion_logineditor');
			$devoptions = $getoptions;
			if(is_array($devoptions)) {
				$dv->set_devotion_options($devoptions); ?>
				<style type="text/css">
					body.login div#login h1 a {
						<?php if($devoptions['logo']) { ?>
						background-image: url(<?php $dv->outputLoginOpts('logo'); ?>);
						<?php } ?>
						background-size: contain;
						background-position: center top;
						background-repeat: no-repeat;
						<?php if($devoptions['logo-size']) { ?>
						height: <?php $dv->outputLoginOpts('logo-size'); ?>px;
						<?php } ?>
						<?php if($devoptions['logo-spacing']) { ?>
							margin: 0 auto <?php $dv->outputLoginOpts('logo-spacing'); ?>px auto;	
						<?php } else { ?>
							margin: 0 auto 12px;
						<?php } ?>
						padding: 0;
						width: 100%;
						text-indent: -9999px;
						outline: 0;
						overflow: hidden;
						display: block;
					}
					body.login a, body.login input[type=submit] {
						-o-transition: .3s;
						-ms-transition: .3s;
						-moz-transition: .3s;
						-webkit-transition: .3s;
						transition: .3s; 
					}
					body.login div#login {
						<?php if($devoptions['centralize']) { ?>
						padding: 0px;
						min-height: 100vh;
						display: flex;
						justify-content: center;
						flex-direction: column;
						<?php } ?>
					}
					body.login {
						<?php 
						$dv->outputLoginOpts('bgcolor', 'background-color');
						$dv->outputLoginOpts('background-image', 'background-image', 'bgimg'); 
						$dv->outputLoginOpts('background-repeat', 'background-repeat'); 
						if($devoptions['background-size']=='custom') {
							$dv->outputLoginOpts('background-manual-size', 'background-size', '', '%'); 
						} else {
							$dv->outputLoginOpts('background-size', 'background-size'); 
						}
						$dv->outputLoginOpts('background-position', 'background-position'); 
						if($devoptions['overlay-color']) {
							$olopacity = '0';
							if($devoptions['overlay-opacity']) { 
								$olopacity = floatval($devoptions['overlay-opacity'])/100.0;
							} 
							list($r, $g, $b) = sscanf($devoptions['overlay-color'], "#%02x%02x%02x"); 
							$boxshadow = 'box-shadow: inset 0 0 0 2038px rgba('.$r.','.$g.','.$b.','.$olopacity.');';
							echo esc_html($boxshadow);
						} ?>
					}
					.login form {
						background: none repeat scroll 0 0 #f7f6f6;
						box-shadow: 0 0px 3px rgba(0, 0, 0, 0.13);
					}
					body.login #loginform {
						<?php
						$dv->outputLoginOpts('formbgcolor', 'background-color');
						$dv->outputLoginOpts('formbordercolor', 'border-color');
						$dv->outputLoginOpts('formradius', 'border-radius', '', 'px');
						?>
					}
					body.login #loginform label {
						<?php
						$dv->outputLoginOpts('formlabelcolor', 'color');
						?>
					}
					body.login #loginform input[type=text], 
					body.login #loginform input[type=password] {
						<?php
						$dv->outputLoginOpts('formfieldbgcolor', 'background-color');
						$dv->outputLoginOpts('formfieldcolor', 'color');
						$dv->outputLoginOpts('formfieldbordercolor', 'border-color');
						$dv->outputLoginOpts('formfieldradius', 'border-radius', '', 'px');
						?>
					}
					body.login #loginform input[type=submit] {
						<?php
						$dv->outputLoginOpts('buttonbgcolor', 'background-color');
						$dv->outputLoginOpts('buttontextcolor', 'color');
						$dv->outputLoginOpts('buttonbordercolor', 'border-color');
						$dv->outputLoginOpts('buttonradius', 'border-radius', '', 'px');
						?>
					}
					body.login #loginform input[type=submit]:hover {
						<?php
						$dv->outputLoginOpts('buttonhoverbgcolor', 'background-color');
						$dv->outputLoginOpts('buttonhovertextcolor', 'color');
						$dv->outputLoginOpts('buttonhoverbordercolor', 'border-color');
						?>
					}
					<?php if($devoptions['linkcolor']) { ?>
					#nav a, #backtoblog a { color: <?php $dv->outputLoginOpts('linkcolor'); ?> !important; }
					<?php } ?>
					<?php if($devoptions['linkhovercolor']) { ?>
					#nav a:hover, #backtoblog a:hover { color: <?php $dv->outputLoginOpts('linkhovercolor'); ?> !important; }
					<?php } ?>
				</style>
		<?php }
		}

	}
}