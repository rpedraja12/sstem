<?php
/*
 * Settings page for Related plugin.
 */



/*
 * Adds an option page to Settings
 */
function related_options() {
	add_options_page(__('Related Posts', 'related'), __('Related Posts', 'related'), 'manage_options', 'related.php', 'related_options_page');
}
add_action( 'admin_menu', 'related_options', 11 );


function related_options_page() {
	// Handle the POST
	$active_tab = 'related_show'; /* default tab */
	if ( isset( $_POST['form'] ) ) {
		if ( function_exists('current_user_can') && !current_user_can('manage_options') ) {
			die(__('Cheatin&#8217; uh?','related' ));
		}

		if ( $_POST['form'] == 'related_show' ) {

			/* Check Nonce */
			$verified = false;
			if ( isset($_POST['related_show_nonce']) ) {
				$verified = wp_verify_nonce( $_POST['related_show_nonce'], 'related_show_nonce' );
			}
			if ( $verified == false ) {
				// Nonce is invalid.
				echo '<div id="message" class="error fade notice is-dismissible"><p>' . __('The Nonce did not validate. Please try again.', 'related') . '</p></div>';
			} else {
				$showkeys = array();
				foreach ($_POST as $key => $value) {
					if ( $key == 'form' ) {
						continue;
					}
					$showkeys[] = str_replace('show_', '', sanitize_text_field($key));
				}
				$showkeys = json_encode($showkeys);
				update_option( 'related_show', $showkeys );
				echo '<div id="message" class="updated fade notice is-dismissible"><p>'. __('Settings updated successfully.', 'related').'</p></div>';
			}

		} else if ( $_POST['form'] == 'related_list' ) {

			/* Check Nonce */
			$verified = false;
			if ( isset($_POST['related_list_nonce']) ) {
				$verified = wp_verify_nonce( $_POST['related_list_nonce'], 'related_list_nonce' );
			}
			if ( $verified == false ) {
				// Nonce is invalid.
				echo '<div id="message" class="error fade notice is-dismissible"><p>' . __('The Nonce did not validate. Please try again.', 'related') . '</p></div>';
			} else {
				$listkeys = array();
				foreach ($_POST as $key => $value) {
					if ( $key == 'form' ) {
						continue;
					}
					$listkeys[] = str_replace('list_', '', sanitize_text_field($key));
				}
				$listkeys = json_encode($listkeys);
				update_option( 'related_list', $listkeys );
				echo '<div id="message" class="updated fade notice is-dismissible"><p>'. __('Settings updated successfully.', 'related').'</p></div>';
			}
			$active_tab = 'related_list';

		} else if ( $_POST['form'] == 'related_content' ) {

			/* Check Nonce */
			$verified = false;
			if ( isset($_POST['related_content_nonce']) ) {
				$verified = wp_verify_nonce( $_POST['related_content_nonce'], 'related_content_nonce' );
			}
			if ( $verified == false ) {
				// Nonce is invalid.
				echo '<div id="message" class="error fade notice is-dismissible"><p>' . __('The Nonce did not validate. Please try again.', 'related') . '</p></div>';
			} else {
				if ( isset( $_POST['related_content'] ) ) {
					if ($_POST['related_content'] == 'on') {
						update_option('related_content', 1);
					} else {
						update_option('related_content', 0);
					}
				} else {
					update_option('related_content', 0);
				}
				if ( isset( $_POST['related_content_all'] ) ) {
					if ($_POST['related_content_all'] == 'on') {
						update_option('related_content_all', 1);
					} else {
						update_option('related_content_all', 0);
					}
				} else {
					update_option('related_content_all', 0);
				}
				if ( isset( $_POST['related_content_rss'] ) ) {
					if ($_POST['related_content_rss'] == 'on') {
						update_option('related_content_rss', 1);
					} else {
						update_option('related_content_rss', 0);
					}
				} else {
					update_option('related_content_rss', 0);
				}
				if ( isset( $_POST['related_content_title'] ) && $_POST['related_content_title'] != '' ) {
					update_option( 'related_content_title', sanitize_text_field($_POST['related_content_title']) );
				} else {
					delete_option( 'related_content_title' );
				}
				if ( isset( $_POST['related_content_extended'] ) ) {
					if ($_POST['related_content_extended'] == 'on') {
						update_option('related_content_extended', 1);
					} else {
						update_option('related_content_extended', 0);
					}
				} else {
					update_option('related_content_extended', 0);
				}

				echo '<div id="message" class="updated fade notice is-dismissible"><p>'. __('Settings updated successfully.', 'related').'</p></div>';
			}
			$active_tab = 'related_content';

		} else if ( $_POST['form'] == 'related_double' ) {

			/* Check Nonce */
			$verified = false;
			if ( isset($_POST['related_double_nonce']) ) {
				$verified = wp_verify_nonce( $_POST['related_double_nonce'], 'related_double_nonce' );
			}
			if ( $verified == false ) {
				// Nonce is invalid.
				echo '<div id="message" class="error fade notice is-dismissible"><p>' . __('The Nonce did not validate. Please try again.', 'related') . '</p></div>';
			} else {
				if ( isset( $_POST['related_double_plugin'] ) ) {
					if ($_POST['related_double_plugin'] == 'on') {
						update_option('related_double_plugin', 1);
					} else {
						update_option('related_double_plugin', 0);
					}
				} else {
					update_option('related_double_plugin', 0);
				}

				echo '<div id="message" class="updated fade notice is-dismissible"><p>'. __('Settings updated successfully.', 'related').'</p></div>';
			}
			$active_tab = 'related_double';
		}
	} ?>

	<div class="wrap">

	<h1><?php _e('Related Posts', 'related'); ?></h1>

	<h2 class="nav-tab-wrapper related-nav-tab-wrapper">
		<a href="#" class="nav-tab <?php if ($active_tab == 'related_show') { echo "nav-tab-active";} ?>" rel="related_post_types"><?php _e('Post types', 'related'); ?></a>
		<a href="#" class="nav-tab <?php if ($active_tab == 'related_list') { echo "nav-tab-active";} ?>" rel="related_form"><?php _e('Form', 'related'); ?></a>
		<a href="#" class="nav-tab <?php if ($active_tab == 'related_content') { echo "nav-tab-active";} ?>" rel="related_content"><?php _e('Content', 'related'); ?></a>
		<a href="#" class="nav-tab <?php if ($active_tab == 'related_double') { echo "nav-tab-active";} ?>" rel="related_double"><?php _e('Double Up', 'related'); ?></a>
		<a href="#" class="nav-tab" rel="related_about"><?php _e('About', 'related'); ?></a>
	</h2>

	<div class="related_options related_post_types <?php if ($active_tab == 'related_show') { echo "active";} ?>">
		<div class="poststuff metabox-holder">
			<div class="related-widget">
				<h3 class="widget-top hndle"><?php _e('Post Types to show the Related Posts form on.', 'related'); ?></h3>
				<?php
				$related_show = get_option('related_show');
				$related_show = json_decode( $related_show );
				$any = '';
				if ( empty( $related_show ) ) {
					$related_show = array();
					$related_show[] = 'any';
					$any = 'checked="checked"';
				} else {
					foreach ( $related_show as $key ) {
						if ( $key == 'any' ) {
							$any = 'checked="checked"';
						}
					}
				}
				?>

				<div class="misc-pub-section">
					<p><?php _e('If Any is selected, it will show on any Post Type. If none are selected, Any will still apply.', 'related'); ?></p>
					<form name="related_options_page_show" action="" method="POST">
						<?php
						/* Nonce */
						$nonce = wp_create_nonce( 'related_show_nonce' );
						echo '<input type="hidden" id="related_show_nonce" name="related_show_nonce" value="' . $nonce . '" />'; ?>
						<ul>
							<li><label for="show_any">
								<input name="show_any" type="checkbox" id="show_any" <?php echo $any; ?>  />
								<?php esc_html_e( 'any', 'related' ); ?>
							</label></li>
							<?php
							$post_types = get_post_types( '', 'names' );
							$checked = '';
							foreach ( $post_types as $post_type ) {
								if ( $post_type == "revision" || $post_type == "nav_menu_item" ) {
									continue;
								}

								foreach ( $related_show as $key ) {
									if ( $key == $post_type ) {
										$checked = 'checked="checked"';
									}
								}
								?>
								<li><label for="show_<?php echo $post_type; ?>">
									<input name="show_<?php echo $post_type; ?>" type="checkbox" id="show_<?php echo $post_type; ?>" <?php echo $checked; ?>  />
									<?php echo $post_type; ?>
								</label></li>
								<?php
								$checked = ''; // reset
							} ?>
							<li><input type="hidden" class="form" value="related_show" name="form" />
								<input type="submit" class="button button-primary" value="<?php esc_attr_e( 'Submit','related' ); ?>"/></li>
						</ul>
					</form>
				</div> <!-- .misc-pub-section -->
			</div> <!-- .related-widget -->
		</div> <!-- metabox-holder -->
	</div> <!-- .related_post_types -->


	<div class="related_options related_form <?php if ($active_tab == 'related_list') { echo "active";} ?>">
		<div class="poststuff metabox-holder">
			<div class="related-widget">
				<h3 class="widget-top hndle"><?php _e('Post Types to list on the Related Posts forms.', 'related'); ?></h3>
				<?php
				$any = ''; // reset
				$related_list = get_option('related_list');
				$related_list = json_decode( $related_list );
				if ( empty( $related_list ) ) {
					$related_list = array();
					$related_list[] = 'any';
					$any = 'checked';
				} else {
					foreach ( $related_list as $key ) {
						if ( $key == 'any' ) {
							$any = 'checked="checked"';
						}
					}
				} ?>

				<div class="misc-pub-section">
				<p><?php _e('If Any is selected, it will list any Post Type. If none are selected, it will still list any Post Type.', 'related'); ?></p>
				<form name="related_options_page_listed" action="" method="POST">
					<?php
					/* Nonce */
					$nonce = wp_create_nonce( 'related_list_nonce' );
					echo '<input type="hidden" id="related_list_nonce" name="related_list_nonce" value="' . $nonce . '" />'; ?>
					<ul>
						<li><label for="list_any">
							<input name="list_any" type="checkbox" id="list_any" <?php echo $any; ?>  />
							<?php esc_html_e( 'any', 'related' ); ?>
						</label></li>
						<?php
						$post_types = get_post_types( '', 'names' );
						foreach ( $post_types as $post_type ) {
							if ( $post_type == "revision" || $post_type == "nav_menu_item" ) {
								continue;
							}

							foreach ( $related_list as $key ) {
								if ( $key == $post_type ) {
									$checked = 'checked="checked"';
								}
							}
							?>
							<li><label for="list_<?php echo $post_type; ?>">
								<input name="list_<?php echo $post_type; ?>" type="checkbox" id="list_<?php echo $post_type; ?>" <?php echo $checked; ?>  />
								<?php echo $post_type; ?>
							</label></li>
							<?php
							$checked = ''; // reset
						} ?>
						<li><input type="hidden" class="form" value="related_list" name="form" />
							<input type="submit" class="button button-primary" value="<?php esc_attr_e( 'Submit', 'related' ); ?>"/></li>
						</ul>
					</form>
				</div>
			</div>
		</div>
	</div> <!-- .related_post_types -->


	<div class="related_options related_content <?php if ($active_tab == 'related_content') { echo "active";} ?>">
		<div class="poststuff metabox-holder">
			<div class="related-widget">
				<h3 class="widget-top hndle"><?php _e('Add the Related Posts to the content.', 'related'); ?></h3>
				<div class="misc-pub-section">
					<form name="related_options_page_content" action="" method="POST">
						<?php
						/* Nonce */
						$nonce = wp_create_nonce( 'related_content_nonce' );
						echo '<input type="hidden" id="related_content_nonce" name="related_content_nonce" value="' . $nonce . '" />'; ?>
						<ul>
							<li>
								<h4><?php _e('If you select to add the Related Posts below the content, it will be added to every display of the content.', 'related'); ?></h4>
								<label for="related_content">
									<input name="related_content" type="checkbox" id="related_content" <?php checked(1, get_option('related_content', 0) ); ?> />
									<?php _e('Add to content on single view.', 'related'); ?>
								</label>
							</li>
							<li>
								<label for="related_content_all">
									<input name="related_content_all" type="checkbox" id="related_content_all" <?php checked(1, get_option('related_content_all', 0) ); ?> />
									<?php _e('Add to content on all views.', 'related'); ?>
								</label>
							</li>
							<li>
								<label for="related_content_rss">
									<input name="related_content_rss" type="checkbox" id="related_content_rss" <?php checked(1, get_option('related_content_rss', 0) ); ?> />
									<?php _e('Add to content on RSS Feed.', 'related'); ?>
								</label>
							</li>
							<li>
								<h4><?php _e('Title of related list.', 'related'); ?></h4>
								<?php $related_content_title = get_option('related_content_title'); ?>
								<label for="related_content_title"><?php _e('Title to show above the related posts: ', 'related'); ?><br />
									<input name="related_content_title" type="text" id="related_content_title" value="<?php echo esc_attr(stripslashes(get_option('related_content_title', __('Related Posts', 'related')))); ?>" />
								</label>
							</li>
							<li>
								<h4><?php _e('Extended view.', 'related'); ?></h4>
								<label for="related_content_extended">
									<input name="related_content_extended" type="checkbox" id="related_content_extended" <?php checked(1, get_option('related_content_extended', 0) ); ?> />
									<?php _e('Show extended content in list, like featured image.', 'related'); ?>
								</label>
							</li>
							<li>
								<input type="hidden" class="form" value="related_content" name="form" />
								<input type="submit" class="button button-primary" value="<?php esc_attr_e( 'Submit', 'related' ); ?>"/>
							</li>
						</ul>
					</form>
				</div>
			</div>
		</div>
	</div> <!-- .related_content -->


	<div class="related_options related_double <?php if ($active_tab == 'related_double') { echo "active";} ?>">
		<div class="poststuff metabox-holder">
			<div class="related-widget">
				<h3 class="widget-top hndle"><?php _e('Double Up plugin for a second list.', 'related'); ?></h3>
				<?php
				$related_double = get_option('related_double_plugin');
				$checked = '';
				if ( $related_double ) {
					$checked = 'checked';
				}
				?>

				<div class="misc-pub-section">
					<form name="related_options_page_double" action="" method="POST">
						<?php
						/* Nonce */
						$nonce = wp_create_nonce( 'related_double_nonce' );
						echo '<input type="hidden" id="related_double_nonce" name="related_double_nonce" value="' . $nonce . '" />'; ?>

						<p>
							<label for="related_double_plugin">
								<input name="related_double_plugin" type="checkbox" id="related_double_plugin" <?php echo $checked; ?>  />
								<?php _e('Activate Double Up plugin for a second list.', 'related'); ?>
							</label>
						</p>

						<input type="hidden" class="form" value="related_double" name="form" />
						<input type="submit" class="button button-primary" value="<?php esc_attr_e( 'Submit','related' ); ?>"/></li>
					</form>
				</div> <!-- .misc-pub-section -->
			</div> <!-- .related-widget -->
		</div> <!-- metabox-holder -->
	</div> <!-- .related_post_types -->


	<div class="related_options related_about">
		<div class="poststuff metabox-holder">
			<div class="related-widget">
				<h3 class="widget-top hndle"><?php _e('About this plugin.', 'related'); ?></h3>
				<p><?php
					$link = 'http://zenoweb.nl';
					$name = 'ZenoWeb';
					echo sprintf( __( 'This plugin is being maintained by Marcel Pol from <a href="%s" target="_blank">%s</a>.', 'related' ), $link, $name ); ?>
				</p>

				<h3 class="widget-top hndle"><?php _e('Review this plugin.', 'related'); ?></h3>
				<p><?php
					$link = 'https://wordpress.org/support/view/plugin-reviews/related?rate=5#postform';
					echo sprintf( __( 'If this plugin has any value to you, then please leave a review at <a href="%s" target="_blank">the plugin page at wordpress.org</a>.', 'related' ), $link ); ?>
				</p>

				<h3 class="widget-top hndle"><?php _e('Donate to the maintainer.', 'related'); ?></h3>
				<p><?php
					$link = '<a href="https://www.paypal.com" target="_blank">';
					$link_end = '</a>';
					$email = 'marcel@timelord.nl';
					echo sprintf( esc_html__( 'If you want to donate to the maintainer of the plugin, you can donate through %sPayPal%s to %s.', 'related' ), $link, $link_end, $email ); ?>
				</p>
			</div>
		</div>
	</div> <!-- .related_about -->


	</div> <!-- .wrap -->
	<?php
}

