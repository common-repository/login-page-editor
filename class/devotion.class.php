<?php 
if(!class_exists('DevotionLPE')) {
	class DevotionLPE {
		
		public $devoptions;
		public $apiurl;

		function set_devotion_options($devoptions) {
			$this->devoptions = $devoptions;
		}
		
		public function devotionCleanText($text) {
			$text = str_replace('\\', '', $text);
			return $text;
		}
		
		public function slugify($text, string $divider = '-') {
		  $text = preg_replace('~[^\pL\d]+~u', $divider, $text);
		  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		  $text = preg_replace('~[^-\w]+~', '', $text);
		  $text = trim($text, $divider);
		  $text = preg_replace('~-+~', $divider, $text);
		  $text = strtolower($text);
		  if (empty($text)) { return 'n-a'; }
		  return $text;
		}
		
		public function checkPreviewOpt($opt) {
			$devoptions = $this->devoptions;
			if($devoptions) {
				if($devoptions[$opt]) { 
					return true;
				}
			}
		}
		
		public function escapeControl() {
			$allowed = 
				array(
					'div' => array(
						'class' => array(),
						'style' => array(),
						'id' => array(),
						'data-suffix' => array(),
						'data-target' => array(),
						'data-min' => array(),
						'data-max' => array(),
						'data-default' => array(),
						'data-type' => array(),
						'data-live' => array()
					),
					'span' => array(
						'class' => array(),
						'title' => array()
					),
					'label' => array(
						'class' => array(),
						'for' => array()
					),
					'i' => array(
						'class' => array()
					),
					'button' => array(
						'data-action' => array(), 
						'class' => array(), 
						'data-type' => array()
					),
					'h6' => array(),
					'strong' => array(),
					'textarea' => array(
						'class' => array(),
						'rows' => array(),
						'name' => array(),
						'value' => array()
					),
					'input' => array(
						'class' => array(),
						'name' => array(),
						'value' => array(),
						'checked' => array(),
						'placeholder' => array(),
						'data-default-color' => array(),
						'type' => array()
					),
					'select' => array(
						'class' => array(),
						'name' => array(),
						'data-live' => array()
					),
					'option' => array(
						'value' => array(), 
						'selected' => array(), 
					)
				);
			return $allowed;
		}
		
		public function previewOpts($opt, $css='', $suffix='', $type='') {
			$devoptions = $this->devoptions;
			if($devoptions) {
				if($devoptions[$opt]) { 
					$val = $devoptions[$opt];
					if($type=="std") { $val = (intval($val)/100)*45; }
					if($type=="logo") { $val = (intval($val)/100)*52; }
					if($type=="bgimg") { $val = 'url('.$val.')'; }
					if($type=="opacity") { $val = floatval($val)/100.0; }
					if($css) {
						return esc_html($css.': '.$val.$suffix.'; '); 
					} else {
						return esc_html($val.$suffix);
					}
				}
			}
		}
		
		public function outputLoginOpts($opt, $css='', $type='', $suffix='') {
			$devoptions = $this->devoptions;
			if($devoptions) {
				if($devoptions[$opt]) { 
					if($css) {
						if($type=="bgimg") {
							echo esc_html($css).': url('.esc_url($devoptions[$opt]).esc_html($suffix).');';
						} else {
							echo esc_html($css).': '.esc_html($devoptions[$opt].$suffix).';';
						}
					} else {
						if($opt=="logo") {
							echo esc_url($devoptions[$opt]);
						} else {
							echo esc_html($devoptions[$opt].$suffix);
						}
					}
				}
			}
		}

		public function devotionTabLink($name, $icon, $target, $active=false) {
			$setactive = '';
			$seticon = '';
			$name = __( $name, 'login-page-editor' );
			if($active) { $setactive = ' class="active"'; }
			if($icon) { $seticon = '<i class="'.$icon.'"></i>'; }
			$allowed = array(
				'li' => array('class' => array()),
				'a' => array('href' => array()),
				'i' => array('class' => array())
			);
			$output = '<li'.$setactive.'><a href="'.$target.'">'.$seticon.$name.'</a></li>';
			echo wp_kses($output, $allowed);
		}
				
		public function devotionTextField($args) {
			$devoptions = $this->devoptions;
			$id = $args["name"];
			$default = '';
			$required = '';
			$stripClass = '';
			$ucClass = '';
			if($args["default"]) { $default = $args["default"]; }
			if($devoptions) {
				if($devoptions[$id]) { $default = $devoptions[$id]; }
			}
			$label = __( $args["label"], 'login-page-editor' );
			$tooltip = __( $args["tooltip"], 'login-page-editor' );
			$placeholder = __( $args["placeholder"], 'login-page-editor' );
			if($args["required"]) { $required = ' req'; }
			if($args["strip"]) { $stripClass = ' devotion-stripfield'; }
			if($args["uppercase"]) { $stripClass = ' devotion-ucfield'; }
			$parent = $args["parent"];
			$visible = $args["visible"];
			$visibility = '';
			if(isset($visible)&&$visible==false) { $visibility = 'display: none;'; }
			if($parent) {
				if($visible==true) {
					if($parent=='on') { $visibility = 'display: none;'; }
				} else {
					if($parent=='on') { $visibility = 'display: flex;'; }
				}
			}
			$live = $args["live"];
			$liveClass = '';
			$liveType = '';
			if($live) {
				$liveClass = ' dv-live';
				$liveType = $live;
			}
			return '
			<div class="dv-option dv-textfield" style="'.$visibility.'" id="dv-toggle-'.$id.'" data-live="'.$liveType.'">
				<h6>'.$label.'</h6>
				<span class="dvsc-control">
					<label for="'.$id.'">'.$label.'</label>
					<div class="dv-select">
						<input name="'.$id.'" class="'.$stripClass.$required.'" type="text" placeholder="'.$placeholder.'" value="'.$default.'">
						<span class="dv-info" title="'.$tooltip.'"><i class="fas fa-info-circle"></i></span>
					</div>
				</span>
			</div>';
		}
		
		public function devotionTextAreaField($args) {
			$devoptions = $this->devoptions;
			$id = $args["name"];
			$default = '';
			if($devoptions) {
				if($devoptions[$id]) { $default = $devoptions[$id]; }
			}
			$label = __( $args["label"], 'login-page-editor' );
			$tooltip = __( $args["tooltip"], 'login-page-editor' );
			$placeholder = __( $args["placeholder"], 'login-page-editor' );
			$required = '';
			if($args["required"]) { $required = ' req'; }
			if($args["rows"]) { $rows = $args["rows"]; } else { $rows = '4'; }
			if($args["strip"]) {
				$stripClass = 'devotion-stripfield';
			} else {
				$stripClass = '';
			}
			$live = $args["live"];
			$liveClass = '';
			$liveType = '';
			if($live) {
				$liveClass = ' dv-live';
				$liveType = $live;
			}
			return '
			<div class="dv-option dv-textareafield" id="dv-toggle-'.$id.'" data-live="'.$liveType.'">
				<div class="dv-textarea-label">
					<h6>'.$label.'</h6>
					<span class="dvsc-control">
						<label for="'.$id.'">'.$label.'</label>
						<div class="dv-select">
							<span class="dv-info" title="'.$tooltip.'"><i class="fas fa-info-circle"></i></span>
						</div>
					</span>
				</div>
				<div class="dv-textarea">
					<textarea rows="'.$rows.'" name="'.$id.'" class="'.$stripClass.$required.'" type="text" placeholder="'.$placeholder.'">'.$default.'</textarea>
				</div>
			</div>';
		}
		
		public function devotionSwitch($args) {
			$devoptions = $this->devoptions;
			$id = $args["name"];
			$status = $args["status"];
			$checked = '';
			if($status=="on") {
				if(!is_array($devoptions)) {
					$checked = ' checked';
				} else {
					if(!array_key_exists($id, $devoptions)) { $checked = ' checked'; }
				}
				if($devoptions) {
					if($devoptions[$id]=='on') { $checked = ' checked'; }
				}
			} else {
				$checked = '';
				if($devoptions) {
					if($devoptions[$id]=='on') { $checked = ' checked'; }
				}
			}
			$label = __( $args["label"], 'login-page-editor' );
			$tooltip = __( $args["tooltip"], 'login-page-editor' );
			$live = $args["live"];
			$liveClass = '';
			$liveType = '';
			if($live) {
				$liveClass = ' dv-live';
				$liveType = $live;
			}
			return '
			<div class="dv-option'.$liveClass.'" id="dv-toggle-'.$id.'" data-live="'.$liveType.'">
				<h6>'.$label.'</h6>
				<span class="dvsc-control">
					<label class="toggle-control">
						<input name="'.$id.'" type="checkbox"'.$checked.'>
						<span class="control"></span>
					</label>
					<span class="dv-info" title="'.$tooltip.'"><i class="fas fa-info-circle"></i></span>
				</span>
			</div>';
		}
		
		public function devotionSlider($args) {
			$devoptions = $this->devoptions;
			$id = $args["name"];
			if($devoptions) {
				if($devoptions[$id]) { 
					$default = $devoptions[$id];
				} else {
					$default = $args["default"];
				}
			} else {
				$default = $args["default"];
			}
			$visible = $args["visible"];
			$label = __( $args["label"], 'login-page-editor' );
			$tooltip = __( $args["tooltip"], 'login-page-editor' );
			$suffix = $args["suffix"];
			$target = $args["target"];
			$min = $args["min"];
			$max = $args["max"];
			$visibility = '';
			if($visible==false) { $visibility = 'display: none;'; }
			$parent = $args["parent"];
			$parentval = $args["parentValue"];
			if($parent&&$devoptions) {
				$parent = $devoptions[$parent];
				if($parent==$parentval) {
					$visibility = '';
				}
			}
			
			return '
			<div class="dv-option dv-slider" style="'.$visibility.'" id="dv-toggle-'.$id.'">
				<h6>'.$label.'</h6>
				<span class="dvsc-control">
					<div class="devotion-range-slider" 
						data-suffix="'.$suffix.'" 
						data-target="'.$target.'" 
						data-min="'.$min.'" 
						data-max="'.$max.'" 
						data-default="'.$default.'">
					</div>
					<input name="'.$id.'" type="hidden" value="'.$default.'">
					<span class="devotion-slider-results">'.$default.$suffix.'</span>
					<span class="dv-info" title="'.$tooltip.'"><i class="fas fa-info-circle"></i></span>
				</span>
			</div>';
		}
		
		public function devotionImageUpload($args) {
			$devoptions = $this->devoptions;
			$label = __( $args["label"], 'login-page-editor' );
			$tooltip = __( $args["tooltip"], 'login-page-editor' );
			$id = $args["name"];
			$type = $args["type"];
			$preview = $args["preview"];
			$ulabel = __( $args["upload_label"], 'login-page-editor' );
			$clabel = __( $args["clear_label"], 'login-page-editor' );
			if($devoptions) {
				$default = $devoptions[$id];
			}
			$noclear = 'display: none;';
			if($default!="") {
				$noclear = '';
			}
			$setpreview = '';
			if($preview==true) {
				$setpreview = '<span class="preview-icon" style="background-image: url('.$default.');"></span>';
			}
			return '
			<div class="dv-option dv-image" data-type="'.$type.'" id="dv-toggle-'.$id.'">
				<h6>'.$label.'</h6>
				<div class="devotion-login-image-upload dvsc-control">
					<input name="'.$id.'" type="hidden" value="'.$default.'">
					'.$setpreview.'
					<button class="devotion-upload-image devotion-approve" data-type="'.$type.'">
					<i class="fa-regular fa-image"></i> '.$ulabel.'</button> 
					<button class="devotion-clear-image devotion-warn" data-type="'.$type.'" style="'.$noclear.'">
					<i class="fa-regular fa-circle-xmark"></i> '.$clabel.'</button>
					<span class="dv-info" title="'.$tooltip.'"><i class="fas fa-info-circle"></i></span>
				</div>
			</div>
			';
		}
		
		public function devotionAction($args) {
			$devoptions = $this->devoptions;
			$id = $args["name"];
			$label = __( $args["label"], 'login-page-editor' );
			$tooltip = __( $args["tooltip"], 'login-page-editor' );
			$button = __( $args["button"], 'login-page-editor' );
			if(!$button) { $button = __('GO', 'login-page-editor' ); }
			return '
			<div class="dv-option dv-action" id="dv-toggle-'.$id.'">
				<h6>'.$label.'</h6>
				<span class="dvsc-control">
					<button data-action="'.$id.'">'.$button.'</button>
					<span class="dv-info" title="'.$tooltip.'"><i class="fas fa-info-circle"></i></span>
				</span>
			</div>';
		}
		
		public function devotionSelector($args) {
			$devoptions = $this->devoptions;
			$required = '';
			$id = $args["name"];
			$visible = $args["visible"];
			$parent = $args["parent"];
			$label = __( $args["label"], 'login-page-editor' );
			$tooltip = __( $args["tooltip"], 'login-page-editor' );
			$options = $args["options"];
			$live = $args["live"];
			if($args["required"]) { $required = 'req'; }
			$live = $args["live"];
			$liveClass = '';
			$liveType = '';
			if($live) {
				$liveClass = ' dv-live';
				$liveType = $live;
			}
			$visibility = '';
			if($visible==false) { $visibility = 'display: none;'; }
			if($parent) {
				if($visible==true) {
					if($parent=='on') { $visibility = 'display: none;'; }
				} else {
					if($parent=='on') { $visibility = 'display: flex;'; }
				}
			}
			$output = '
			<div class="dv-option dv-selector'.$liveClass.'" style="'.$visibility.'" id="dv-toggle-'.$id.'">
				<h6>'.$label.'</h6>
				<span class="dvsc-control">
					<label for="'.$id.'">'.$label.'</label>
					<div class="dv-select">
						<select name="'.$id.'" class="'.$required.'" data-live="'.$liveType.'">';
						foreach($options as $key => $value) { 
							if($devoptions) {
								if($devoptions[$id]==$key) { $checked = ' selected'; } else { $checked = ''; }
							} else {
								$checked = '';
							}
							$output .= '<option value="'.$key.'"'.$checked.'>'.$value.'</option>';
						}
						$output .= '
						</select>
					</div>
					<span class="dv-info" title="'.$tooltip.'"><i class="fas fa-info-circle"></i></span>
				</span>
			</div>';
			return $output;
		}
		
		public function devotionColor($args) {
			$devoptions = $this->devoptions;
			$label = __( $args["label"], 'login-page-editor' );
			$tooltip = __( $args["tooltip"], 'login-page-editor' );
			$id = $args["name"];
			$default = $args["default"];
			$type = $args["type"];
			if($devoptions) {
				if($devoptions[$id]) {
					$default = $devoptions[$id];
				}
			}
			return '
			<div class="dv-option dv-color" id="dv-toggle-'.$id.'" data-type="'.$type.'">
				<h6>'.$label.'</h6>
				<span class="dvsc-control">
					<input type="text" value="'.$default.'" class="devotion-color-picker-field" data-default-color="'.$default.'" />
					<span class="dv-info" title="'.$tooltip.'"><i class="fas fa-info-circle"></i></span>
					<input name="'.$id.'" type="hidden" value="'.$default.'">
				</span>
			</div>';
		}
	
	}
}