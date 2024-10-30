<?php 
// get default login preview
$bgcol = $dv->previewOpts('bgcolor', 'background-color');
$bgimg = $dv->previewOpts('background-image', 'background-image', '', 'bgimg');
$bgrep = $dv->previewOpts('background-repeat', 'background-repeat');
$bgsiz = $dv->previewOpts('background-size', 'background-size');
if($devoptions) {
	if($devoptions['background-size']=='custom') { $bgsiz = $dv->previewOpts('background-manual-size', 'background-size', '%'); }
}
$bgpos = $dv->previewOpts('background-position', 'background-position');
$logoimg = $dv->previewOpts('logo');
$defaultlogo = plugins_url('assets/img/w-logo-blue.png', dirname(__DIR__) );
if(!$logoimg) { $logoimg = $defaultlogo; }
$logosize = $dv->previewOpts('logo-size', 'height', 'px', 'logo');
$logospacing = $dv->previewOpts('logo-spacing', 'margin-bottom', 'px', 'logo');
$linkcol = $dv->previewOpts('linkcolor', 'color');
$linkcolraw = $dv->previewOpts('linkcolor');
$linkhov = $dv->previewOpts('linkhovercolor');
$olcol = $dv->previewOpts('overlay-color', 'background-color');
$olopacity = $dv->previewOpts('overlay-opacity', 'opacity', '', 'opacity');


// FORM STYLES
$formradius = $dv->previewOpts('formradius', 'border-radius', 'px', 'std');
$formbgcolor = $dv->previewOpts('formbgcolor', 'background-color');
$formbordercolor = $dv->previewOpts('formbordercolor', 'border-color');
$formlabelcolor = $dv->previewOpts('formlabelcolor', 'color');
$formstyles = $formradius.$formbgcolor.$formbordercolor;

// FIELD STYLES
$formfieldradius = $dv->previewOpts('formfieldradius', 'border-radius', 'px', 'std');
$fieldborder = $dv->previewOpts('fieldborder', 'border-width', 'px', 'std');
$formfieldbgcolor = $dv->previewOpts('formfieldbgcolor', 'background-color');
$formfieldcolor = $dv->previewOpts('formfieldcolor', 'color');
$formfieldbordercolor = $dv->previewOpts('formfieldbordercolor', 'border-color');
$fieldstyles = $formfieldradius.$fieldborder.$formfieldbgcolor.$formfieldcolor.$formfieldbordercolor;
$fieldlabelstyles = $formlabelcolor;

// BUTTON STYLES
$buttonradius = $dv->previewOpts('buttonradius', 'border-radius', 'px', 'std');
$buttonbgcolor = $dv->previewOpts('buttonbgcolor', 'background-color');
$buttontextcolor = $dv->previewOpts('buttontextcolor', 'color');
$buttonstyles = $buttonradius.$buttonbgcolor.$buttontextcolor;
?>


<div id="devotion-login-preview" class="dv-max" style="<?php echo esc_html($bgcol.$bgimg.$bgrep.$bgsiz.$bgpos); ?>">
	<div id="devotion-login-preview-overlay" style="<?php echo esc_html($olcol.$olopacity); ?>"></div>
	<div id="dv-preview-status">
		<span class="dv-pulse"></span> <?php echo __( 'Live Preview', 'login-page-editor' ); ?>
	</div>
	<div id="dv-preview-logo">
		<img id="dv-preview-logo-img" data-default="<?php echo esc_url($defaultlogo); ?>" 
		style="<?php echo esc_html($logosize.$logospacing); ?>"  
		src="<?php echo esc_url($logoimg); ?>" alt="">
	</div>
	<div id="dv-preview-login-componants">
		<div class="dv-preview-login-form-shell" style="<?php echo esc_html($formstyles); ?>">
			<div class="dv-preview-login-form-inner" style="<?php echo esc_html($formpadding); ?>">
				<div>
					<label for="username" class="dv-preview-mainlabel" 
					style="<?php echo esc_html($fieldlabelstyles); ?>">
					<?php echo __( 'Username or Email Address', 'login-page-editor' ); ?></label>
					<input name="username" type="text" style="<?php echo esc_html($fieldstyles); ?>" value="myusername">
				</div>
				<div>
					<label for="password" class="dv-preview-mainlabel" 
					style="<?php echo esc_html($fieldlabelstyles); ?>">
					<?php echo __( 'Password', 'login-page-editor' ); ?></label>
					<input name="password" type="password" style="<?php echo esc_html($fieldstyles); ?>" value="password">
				</div>
				<div class="dv-preview-login-remember">
					<label class="dv-preview-sublabel" 
					style="<?php echo esc_html($formlabelcolor); ?>"><input type="checkbox" name="checkbox" value="value"><?php echo __( 'Remember Me', 'login-page-editor' ); ?></label>
				</div>
				<div class="dv-preview-login-button">
					<button style="<?php echo esc_html($buttonstyles); ?>"><?php echo __( 'Log In', 'login-page-editor' ); ?></button>
				</div>
			</div>
		</div>
	</div>
	<div id="dv-preview-links">
		<p><a href="#" data-std="<?php echo esc_html($linkcolraw); ?>" data-hover="<?php echo esc_html($linkhov); ?>" 
		style="<?php echo esc_html($linkcol); ?>"><?php echo __( 'Lost your password?', 'login-page-editor' ); ?></a></p>
		<p><a href="#" data-std="<?php echo esc_html($linkcolraw); ?>" data-hover="<?php echo esc_html($linkhov); ?>" 
		style="<?php echo esc_html($linkcol); ?>">← <?php echo __( 'Go to', 'login-page-editor' ); ?> 
		<?php echo esc_html(get_bloginfo('name'));?></a></p>
	</div>
</div>