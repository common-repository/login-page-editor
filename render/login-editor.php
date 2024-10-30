<?php // output DEVotion Login Page Editor
function loginpageeditor_login_editor_page() { 
	$dv = new DevotionLPE();
	global $devoptions;
	$getoptions = get_option('devotion_logineditor');
	$devoptions = $getoptions;
	$dv->set_devotion_options($devoptions); ?>
	
	<span id="devotion-swal-success" 
	data-heading="<?php echo __( 'Success!', 'login-page-editor' ); ?>" 
	data-message="<?php echo __( 'Your login page has been updated', 'login-page-editor' ); ?>">
	</span>
	<span id="devotion-swal-clear" 
	data-heading="<?php echo __( 'Success!', 'login-page-editor' ); ?>" 
	data-message="<?php echo __( 'Your login page has been reset', 'login-page-editor' ); ?>">
	</span>
	<div class="devotion-section dv-main-section devotion-logineditor">
		<?php include(__DIR__ . "/../includes/header.php"); ?>
		<div class="devotion-intro">
			<div class="dv-max">
				<h1><?php echo __( 'Login Page Editor', 'login-page-editor' ); ?></h1>
				<p><?php echo __( 'Changing the WordPress login screen has never been easier. Our awesome editor shows you what your login page will look like before you save it. If you are not happy with your design then you can reset the style back to the default with one click. If you like this plugin, and you fancy giving me a pat on the back, then please:.', 'login-page-editor' ); ?></p>
				<a href='https://ko-fi.com/I2I2NFPB9' target='_blank'><img height='36' style='border:0px;height:36px;' src='https://storage.ko-fi.com/cdn/kofi3.png?v=3' border='0' alt='Buy Me a Coffee at ko-fi.com' /></a>
			</div>
		</div>
		
		<?php include("partial/admin-notices.php"); ?>
		
		<div class="devotion-content">
			<?php include('partial/login-preview.php'); ?>
			
			<form id="logineditor-form" method="post" autocomplete="off">
				<div class="devotion-tabs dv-max">
					<ul class="dv-tablist">
						<?php $dv->devotionTabLink("Background", "fas fa-image", "#dvtab-1", true); ?>
						<?php $dv->devotionTabLink("Logo", "far fa-atom", "#dvtab-2"); ?>
						<?php $dv->devotionTabLink("Overlay", "fas fa-layer-plus", "#dvtab-3"); ?>
						<?php $dv->devotionTabLink("Form", "fas fa-table-list", "#dvtab-4"); ?>
						<?php $dv->devotionTabLink("Button", "fas fa-rotate", "#dvtab-5"); ?>
						<?php $dv->devotionTabLink("Links", "fas fa-link", "#dvtab-6"); ?>
					</ul>
					<div id="dvtab-1" class="devotion-tab dvtab-lrg tab-active dv-shad">
						<div class="dv-tab-inner">
							<?php 
							$args = array(
								"name" => "bgcolor", 
								"label" => "Background Color", 
								"default" => "",
								"type" => "bg",
								"tooltip" => "This will set the overall background color of the login page."
							); echo wp_kses($dv->devotionColor($args), $dv->escapeControl()); 
		
							$args = array(
								"name" => "background-image", 
								"label" => "Background Image", 
								"type" => "bg", 
								"upload_label" => "Select Image", 
								"clear_label" => "Clear", 
								"tooltip" => "This will set a background image for the whole login page. 
								You can use the position, size and repeat controls below to set how the image displays."
							); echo wp_kses($dv->devotionImageUpload($args), $dv->escapeControl()); 
							
							// BACKGROUND REPEAT
							$options = array(
								"" => __( 'Please Select...', 'login-page-editor' ), 
								"no-repeat" => __( 'No-Repeat', 'login-page-editor' ), 
								"repeat" => __( 'Repeat', 'login-page-editor' ), 
								"repeat-x" => __( 'Repeat X', 'login-page-editor' ), 
								"repeat-y" => __( 'Repeat Y', 'login-page-editor' ),
							);
							$args = array(
								"name" => "background-repeat", 
								"label" => "Background Repeat", 
								"options" => $options,
								"visible" => true,
								"live" => "background-repeat", 
								"tooltip" => "This controls how the background image repeats on the login page."
							); echo wp_kses($dv->devotionSelector($args), $dv->escapeControl()); 
							
							// BACKGROUND SIZE
							$options = array(
								"" => __( 'Please Select...', 'login-page-editor' ), 
								"auto" => __( 'Auto', 'login-page-editor' ), 
								"cover" => __( 'Cover', 'login-page-editor' ), 
								"contain" => __( 'Contain', 'login-page-editor' ),
								"custom" => __( 'Custom Size', 'login-page-editor' ),
							);
							$args = array(
								"name" => "background-size", 
								"label" => "Background Size", 
								"options" => $options,
								"visible" => true,
								"live" => "background-size", 
								"tooltip" => "This controls how the background image is sized on the login page. 
								If you want the background image to be full-screen then you can set this to 'cover'."
							); echo wp_kses($dv->devotionSelector($args), $dv->escapeControl()); 
							
							$args = array(
								"name" => "background-manual-size", 
								"label" => "Background Size", 
								"suffix" => "%",
								"target" => "bg",
								"parent" => "background-size", 
								"parentValue" => "custom", 
								"min" => "0",
								"max" => "100",
								"visible" => false,
								"default" => "100",
								"tooltip" => "You can manually set the size (width) of your background image in percent (%) - 
								the height is auto generated to maintain background image proportion."
							); echo wp_kses($dv->devotionSlider($args), $dv->escapeControl()); 
							
							
							// BACKGROUND POSITION
							$options = array(
								"" => __( 'Please Select...', 'login-page-editor' ), 
								"left top" => __( 'Left Top', 'login-page-editor' ), 
								"left center" => __( 'Left Center', 'login-page-editor' ), 
								"left bottom" => __( 'Left Bottom', 'login-page-editor' ), 
								"right top" => __( 'Right Top', 'login-page-editor' ),
								"right center" => __( 'Right Center', 'login-page-editor' ),
								"right bottom" => __( 'Right Bottom', 'login-page-editor' ),
								"center top" => __( 'Center Top', 'login-page-editor' ),
								"center center" => __( 'Center Center', 'login-page-editor' ),
								"center bottom" => __( 'Center Bottom', 'login-page-editor' ),
							);
							$args = array(
								"name" => "background-position", 
								"label" => "Background Position", 
								"options" => $options,
								"visible" => true,
								"live" => "background-position", 
								"tooltip" => "This controls how the background image is positioned on the login page."
							); echo wp_kses($dv->devotionSelector($args), $dv->escapeControl()); 
							
							$args = array(
								"name" => "centralize", 
								"label" => "Vertically Center", 
								"tooltip" => "It has always bothered us that the login page content isn't vertically centered on the page - So.... we fixed it! Enable this to vertically center the login page content."
							); echo wp_kses($dv->devotionSwitch($args), $dv->escapeControl()); 
							?>
						</div>
					</div>
					<div id="dvtab-2" class="devotion-tab dvtab-lrg dv-shad">
						<div class="dv-tab-inner">
							<?php
							$args = array(
								"name" => "logo", 
								"label" => "Upload Logo", 
								"type" => "logo", 
								"upload_label" => "Select Image", 
								"clear_label" => "Clear", 
								"tooltip" => "This will set a logo image above the login form."
							); echo wp_kses($dv->devotionImageUpload($args), $dv->escapeControl()); 
							
							$args = array(
								"name" => "logo-size", 
								"label" => "Logo Height", 
								"suffix" => "px",
								"target" => "logo",
								"min" => "1",
								"max" => "500",
								"default" => "90",
								"visible" => true,
								"tooltip" => "Use the slider to change the image height (px) - 
								the width is auto calculated to maintain proportions."
							); echo wp_kses($dv->devotionSlider($args), $dv->escapeControl()); 
							
							$args = array(
								"name" => "logo-spacing", 
								"label" => "Logo Spacing", 
								"suffix" => "px",
								"target" => "logo-spacing",
								"min" => "0",
								"max" => "250",
								"default" => "0",
								"visible" => true,
								"tooltip" => "Use the slider to change the logo spacing (px) - 
								the spacing is the distance between the logo and the login form."
							); echo wp_kses($dv->devotionSlider($args), $dv->escapeControl()); 
							?>
						</div>	
					</div>
					<div id="dvtab-3" class="devotion-tab dvtab-lrg dv-shad">
						<div class="dv-tab-inner">
							<?php
							$args = array(
								"name" => "overlay-color", 
								"label" => "Overlay Color", 
								"default" => "",
								"type" => "ol",
								"tooltip" => "Set the color of the overlay that sits above the page background but below the page content. This is ideal if you have a background image that is very light and you need to make the login page content readable."
							); echo wp_kses($dv->devotionColor($args), $dv->escapeControl()); 
							
							$args = array(
								"name" => "overlay-opacity", 
								"label" => "Overlay Opacity", 
								"suffix" => "%",
								"target" => "opacity",
								"min" => "1",
								"max" => "100",
								"default" => "100",
								"visible" => true,
								"tooltip" => "Use the slider to set the opacity of the overlay color."
							); echo wp_kses($dv->devotionSlider($args), $dv->escapeControl()); 
							?>
						</div>	
					</div>
					<div id="dvtab-4" class="devotion-tab dvtab-lrg dv-shad">
						<div class="dv-tab-inner">
							<?php 
							$args = array(
								"name" => "formradius", 
								"label" => "Form Border Radius", 
								"suffix" => "px",
								"target" => "formradius",
								"min" => "0",
								"max" => "100",
								"default" => "0",
								"visible" => true,
								"tooltip" => "Use the slider to set the border radius of the form."
							); echo wp_kses($dv->devotionSlider($args), $dv->escapeControl());
							
							$args = array(
								"name" => "formbgcolor", 
								"label" => "Form Background Color", 
								"default" => "",
								"type" => "formbg",
								"tooltip" => "This will set the overall background color of the login form."
							); echo wp_kses($dv->devotionColor($args), $dv->escapeControl()); 
							
							$args = array(
								"name" => "formbordercolor", 
								"label" => "Form Border Color", 
								"default" => "",
								"type" => "formbordercolor",
								"tooltip" => "This will set the color of the login form border."
							); echo wp_kses($dv->devotionColor($args), $dv->escapeControl()); 
							
							$args = array(
								"name" => "formlabelcolor", 
								"label" => "Form Label Color", 
								"default" => "",
								"type" => "formlabel",
								"tooltip" => "This will set the color of the login form labels."
							); echo wp_kses($dv->devotionColor($args), $dv->escapeControl()); 
							
							$args = array(
								"name" => "formfieldradius", 
								"label" => "Field Border Radius", 
								"suffix" => "px",
								"target" => "fieldradius",
								"min" => "0",
								"max" => "50",
								"default" => "6",
								"visible" => true,
								"tooltip" => "Use the slider to set the border radius of the form fields."
							); echo wp_kses($dv->devotionSlider($args), $dv->escapeControl());
							
							$args = array(
								"name" => "formfieldbgcolor", 
								"label" => "Field Background Color", 
								"default" => "",
								"type" => "formfieldbg",
								"tooltip" => "This will set the background color of the login form fields."
							); echo wp_kses($dv->devotionColor($args), $dv->escapeControl()); 
							
							$args = array(
								"name" => "formfieldcolor", 
								"label" => "Field Text Color", 
								"default" => "",
								"type" => "formfieldtext",
								"tooltip" => "This will set the text color of the login form fields."
							); echo wp_kses($dv->devotionColor($args), $dv->escapeControl());
							
							$args = array(
								"name" => "formfieldbordercolor", 
								"label" => "Field Border Color", 
								"default" => "",
								"type" => "formfieldborder",
								"tooltip" => "This will set the border color of the login form fields."
							); echo wp_kses($dv->devotionColor($args), $dv->escapeControl()); 
							?>
						</div>		
					</div>
					<div id="dvtab-5" class="devotion-tab dvtab-lrg dv-shad">
						<div class="dv-tab-inner">
							<?php 
							$args = array(
								"name" => "buttonradius", 
								"label" => "Button Border Radius", 
								"suffix" => "px",
								"target" => "buttonradius",
								"min" => "0",
								"max" => "100",
								"default" => "6",
								"visible" => true,
								"tooltip" => "Use the slider to set the border radius of the button."
							); echo wp_kses($dv->devotionSlider($args), $dv->escapeControl());

							$args = array(
								"name" => "buttonbgcolor", 
								"label" => "Button Background Color", 
								"default" => "",
								"type" => "buttonbgcolor",
								"tooltip" => "This will set the background color of the button."
							); echo wp_kses($dv->devotionColor($args), $dv->escapeControl()); 
							
							$args = array(
								"name" => "buttontextcolor", 
								"label" => "Button Text Color", 
								"default" => "",
								"type" => "buttontextcolor",
								"tooltip" => "This will set the text color of the button."
							); echo wp_kses($dv->devotionColor($args), $dv->escapeControl()); 
							
							$args = array(
								"name" => "buttonbordercolor", 
								"label" => "Button Border Color", 
								"default" => "",
								"type" => "buttonbordercolor",
								"tooltip" => "This will set the border color of the button."
							); echo wp_kses($dv->devotionColor($args), $dv->escapeControl()); 
														
							$args = array(
								"name" => "buttonhoverbgcolor", 
								"label" => "Button Hover Background Color", 
								"default" => "",
								"type" => "buttonhoverbgcolor",
								"tooltip" => "This will set the background color of the button on hover."
							); echo wp_kses($dv->devotionColor($args), $dv->escapeControl());
							
							$args = array(
								"name" => "buttonhovertextcolor", 
								"label" => "Button Hover Text Color", 
								"default" => "",
								"type" => "buttonhovertextcolor",
								"tooltip" => "This will set the text color of the button on hover."
							); echo wp_kses($dv->devotionColor($args), $dv->escapeControl());
							
							$args = array(
								"name" => "buttonhoverbordercolor", 
								"label" => "Button Hover Border Color", 
								"default" => "",
								"type" => "buttonhoverbordercolor",
								"tooltip" => "This will set the border color of the button on hover."
							); echo wp_kses($dv->devotionColor($args), $dv->escapeControl());
							?>
						</div>		
					</div>
					<div id="dvtab-6" class="devotion-tab dvtab-lrg dv-shad">
						<div class="dv-tab-inner">
							<?php 
							$args = array(
								"name" => "linkcolor", 
								"label" => "Links Color", 
								"default" => "",
								"type" => "color",
								"tooltip" => "Change the color of the links that appear below the login form (Lost your password etc)."
							); echo wp_kses($dv->devotionColor($args), $dv->escapeControl()); 
							
							$args = array(
								"name" => "linkhovercolor", 
								"label" => "Links Hover Color", 
								"default" => "",
								"type" => "hcolor",
								"tooltip" => "Change the hover color of the links that appear below the login form (Lost your password etc)."
							); echo wp_kses($dv->devotionColor($args), $dv->escapeControl()); 
							
							?>
						</div>		
					</div>
				</div>
				<div class="devotion-tab-actions dv-max">
					<button class="dv-form-reset" id="dv-clear-logineditor" type="clear">
					<i class="fa-regular fa-rotate"></i> <?php echo __( 'Reset', 'login-page-editor' ); ?></button>
					<button class="dv-form-submit" id="dv-update-logineditor" type="submit">
					<i class="fa-solid fa-floppy-disk"></i> <?php echo __( 'Save Changes', 'login-page-editor' ); ?></button>
				</div>
			</form>
		</div>
		<?php include("partial/admin-notices-bottom.php"); ?>
		<?php include(__DIR__ . "/../includes/footer.php"); ?>
	</div>
<?php } ?>