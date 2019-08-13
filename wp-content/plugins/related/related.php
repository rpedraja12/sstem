<?php
/*
Plugin Name: Related
Plugin URI: http://products.zenoweb.nl/free-wordpress-plugins/related/
Description: A simple 'related posts' plugin that lets you select related posts manually.
Version: 3.0.0
Author: Marcel Pol
Author URI: http://zenoweb.nl
Text Domain: related
Domain Path: /lang/


Copyright 2010 - 2012  Matthias Siegel  (email: matthias.siegel@gmail.com)
Copyright 2013 - 2017  Marcel Pol       (email: marcel@timelord.nl)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/*
 * Todo:
 *
 * - Add shortcode, so it can be used in the middle of a post as well.
 * - Consider adding a filter with option for the_excerpt as well.
 * - Add vice-versa linking through an option:
 *   https://wordpress.org/support/topic/automatic-vice-versa-linking/
 *
 */

if ( ! class_exists('Related')) :
	class Related {

		/*
		 * __construct
		 * Constructor
		 */
		public function __construct() {

			// Set some helpful constants
			$this->defineConstants();

			// Register hook to save the related posts when saving the post
			add_action('save_post', array(&$this, 'save'));

			// Start the plugin
			add_action('admin_menu', array(&$this, 'start'));

			// Load the scripts
			add_action('admin_enqueue_scripts', array(&$this, 'adminScripts'));

			// Load the CSS
			add_action('admin_enqueue_scripts', array(&$this, 'adminCSS'));
			add_action('wp_enqueue_scripts', array(&$this, 'frontendCSS'));

			// Add the related posts to the content, if set in options
			add_filter( 'the_content', array($this, 'related_content_filter') );

			// Add the related posts to the RSS Feed, if set in options
			add_filter( 'the_excerpt_rss', array($this, 'related_content_rss') );
			add_filter( 'the_content', array($this, 'related_content_rss') );
		}


		/*
		 * defineConstants
		 * Defines a few static helper values we might need
		 */
		protected function defineConstants() {
			define('RELATED_VERSION', '3.0.0');
			define('RELATED_HOME', 'http://zenoweb.nl');
			define('RELATED_FILE', plugin_basename(dirname(__FILE__)));
			define('RELATED_ABSPATH', str_replace('\\', '/', WP_PLUGIN_DIR . '/' . plugin_basename(dirname(__FILE__))));
			define('RELATED_URLPATH', plugins_url() . '/' . plugin_basename(dirname(__FILE__)));
		}


		/*
		 * start
		 * Main function
		 */
		public function start() {

			// Adds a meta box for related posts to the edit screen of each post type in WordPress
			$related_show = get_option('related_show');
			$related_show = json_decode( $related_show );
			if ( empty( $related_show ) ) {
				$related_show = array();
				$related_show[] = 'any';
			}
			if ( in_array( 'any', $related_show ) ) {
				foreach (get_post_types() as $post_type) :
					add_meta_box($post_type . '-related-posts-box', __('Related posts', 'related' ), array(&$this, 'displayMetaBox'), $post_type, 'normal', 'high');
				endforeach;
			} else {
				foreach ($related_show as $post_type) :
					add_meta_box($post_type . '-related-posts-box', __('Related posts', 'related' ), array(&$this, 'displayMetaBox'), $post_type, 'normal', 'high');
				endforeach;
			}

		}


		/*
		 * Load JavaScript for Admin
		 */
		public function adminScripts() {
			wp_enqueue_script('jquery-ui-core');
			wp_enqueue_script('jquery-ui-sortable');
			wp_enqueue_script('related-scripts', RELATED_URLPATH .'/js/scripts.js', false, RELATED_VERSION, true);
			wp_enqueue_script('related-chosen', RELATED_URLPATH .'/chosen/chosen.jquery.min.js', false, RELATED_VERSION, true);
		}


		/*
		 * Load CSS for Admin
		 */
		public function adminCSS() {
			wp_enqueue_style('related-admin-css', RELATED_URLPATH .'/css/admin-style.css', false, RELATED_VERSION, 'all');
			wp_enqueue_style('related-chosen-css', RELATED_URLPATH .'/chosen/chosen.min.css', false, RELATED_VERSION, 'all');
		}


		/*
		 * Load CSS for Frontend
		 */
		public function frontendCSS() {
			wp_enqueue_style('related-frontend-css', RELATED_URLPATH .'/css/frontend-style.css', false, RELATED_VERSION, 'all');
		}

		/*
		 * save
		 * Save related posts when saving the post
		 *
		 * @param $post_id int ID of the current post.
		 */
		public function save( $post_id ) {
			global $pagenow;

			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
				return;
			if ( defined( 'DOING_AJAX' ) && DOING_AJAX )
				return;
			if ( defined( 'DOING_CRON' ) && DOING_CRON )
				return;

			/* Check Nonce */
			$verified = false;
			if ( isset($_POST['related_nonce']) ) {
				$verified = wp_verify_nonce( $_POST['related_nonce'], 'related_nonce' );
			}
			if ( $verified == false ) {
				// Nonce is invalid.
				return;
			}

			if ( isset($_POST['related-posts']) ) {
				$related_posts = $_POST['related-posts'];
				$related_posts_new = array();
				foreach ( $related_posts as $related_post ) {
					if ( $post_id == (int) $related_post ) { continue; }
					$related_posts_new[] = (int) $related_post; // cast to int for security.
				}
				update_post_meta( $post_id, 'related_posts', $related_posts_new );
			}
			/* Only delete on post.php page, not on Quick Edit. */
			if ( empty($_POST['related-posts']) ) {
				if ( $pagenow == 'post.php' ) {
					delete_post_meta($post_id, 'related_posts');
				}
			}
		}


		/*
		 * displayMetaBox
		 * Creates the output on the post screen
		 */
		public function displayMetaBox() {
			global $post;
			$post_id = $post->ID;

			/* Nonce */
			$nonce = wp_create_nonce( 'related_nonce' );
			echo '<input type="hidden" id="related_nonce" name="related_nonce" value="' . $nonce . '" />';

			echo '<p>' . __('Choose related posts. You can drag-and-drop them into the desired order:', 'related' ) . '</p><div id="related-posts">';

			// Get related posts if existing
			$related = get_post_meta($post_id, 'related_posts', true);

			if (!empty($related)) {
				foreach($related as $r) {
					if ( $post_id == $r ) { continue; }
					$p = get_post( (int) $r );

					if ( is_object( $p ) ) {
						if ($p->post_status != 'trash') {
							echo '
								<div class="related-post" id="related-post-' . $r . '">
									<input type="hidden" name="related-posts[]" value="' . $r . '">
									<span class="related-post-title">' . $p->post_title . ' (' . ucfirst(get_post_type($p->ID)) . ')'. Walker_RelatedDropdown::AppendEnglishTitle($p->ID ).'</span>
									<a href="#">' . __('Delete', 'related' ) . '</a>
								</div>';
						}
					}

				}
			}

			/* First option should be empty with a data placeholder for text.
			 * The jQuery call allow_single_deselect makes it possible to empty the selection
			 */
			echo '
				</div>
				<p>
					<select class="related-posts-select chosen-select" name="related-posts-select" data-placeholder="' . __('Choose a related post... ', 'related' ) . '">';

			echo '<option value="0"></option>';


			$related_list = get_option('related_list');
			$related_list = json_decode( $related_list );

			if ( empty( $related_list ) || in_array( 'any', $related_list ) ) {
				// list all the post_types
				$related_list = array();

				$post_types = get_post_types( '', 'names' );
				foreach ( $post_types as $post_type ) {
					if ( $post_type == "revision" || $post_type == "nav_menu_item" ) {
						continue;
					}
					$related_list[] = $post_type;
				}
			}

			foreach ( $related_list as $post_type ) {

				if ( is_post_type_hierarchical($post_type) ) {
					$orderby = 'title';
					$order = 'ASC';
				} else {
					$orderby = 'date';
					$order = 'DESC';
				}
				echo '<optgroup label="' . ucwords($post_type) . ' ' . sprintf( __('(sorted on %s)', 'related'), $orderby ) . '">';

				/* Use suppress_filters to support WPML, only show posts in the right language. */
				$r = array(
					'nopaging' => true,
					'posts_per_page' => 500,
					'orderby' => $orderby,
					'order' => $order,
					'post_type' => $post_type,
					'suppress_filters' => 0,
					'post_status' => 'publish, inherit',
					'exclude' => array( $post_id )
				);

				$posts = get_posts( $r );

				if ( ! empty( $posts ) ) {
					$args = array($posts, 0, $r);

					$walker = new Walker_RelatedDropdown;
					echo call_user_func_array( array( $walker, 'walk' ), $args );
				}

				echo '</optgroup>';

			} // endforeach

			wp_reset_query();
			wp_reset_postdata();

			echo '
					</select>
				</p>';

		}


		/*
		 * show
		 * The frontend function that is used to display the related post list.
		 *
		 * Parameters:
		 * - Post ID: the post ID with the list of related posts.
		 * - Return: If true, returns a simple array of related posts to do as you please.
		 *           If false (default), it will return a string with formatted HTML.
		 */
		public function show( $id, $return = false ) {

			global $wpdb;

			/* Compatibility for Qtranslate and Qtranslate-X, and the get_permalink function */
			if ( function_exists( 'qtrans_convertURL' ) ) {
				add_filter('post_type_link', 'qtrans_convertURL');
			}
			if ( function_exists( 'qtranxf_convertURL' ) ) {
				add_filter('post_type_link', 'qtranxf_convertURL');
			}

			if (!empty($id) && is_numeric($id)) :
				$related = get_post_meta($id, 'related_posts', true);

				if (!empty($related)) :
					$rel = array();
					foreach ($related as $r) :
						$p = get_post( (int) $r );
						$rel[] = $p;
					endforeach;

					// If value should be returned as array, return it.
					if ($return) :
						return $rel;

					// Otherwise return a formatted list
					else :
						if ( is_array( $rel ) && count( $rel ) > 0 ) {
							$extended_view = get_option('related_content_extended', 0);
							if ( $extended_view ) {
								$list = '
										<ul class="related-posts extended_view">';
							} else {
								$list = '
										<ul class="related-posts">';
							}
							foreach ($rel as $r) :
								if ( is_object( $r ) ) {
									if ($r->post_status != 'trash') {
										if ( $extended_view ) {
											$thumb_id = get_post_thumbnail_id($r->ID);
											$tn = wp_get_attachment_image_src( $thumb_id, 'medium');
											$image_url = '';
											if ( isset($tn[0]) ) {
												$image_url = $tn[0];
											}
											$image_alt = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );
											if ( strlen($image_alt) == 0 ) { // No alt set for featured image, use the related post title.
												$image_alt = get_the_title($r->ID);
											}
											$image = '';
											if ( strlen($image_url) > 0 ) {
												$image = '<img src="' . $image_url . '" alt="' . $image_alt . '" class="related-post-image" />';
											}
											$list .= '
											<li class="related-post extended_view">
												<a href="' . get_permalink($r->ID) . '" class="related-post-link">
													' . $image
													 . '<span class="related-post-title">' .  get_the_title($r->ID) . '</span>
												</a>
											</li>';
										} else {
											$list .= '
											<li class="related-post">
												<a href="' . get_permalink($r->ID) . '">' . get_the_title($r->ID) . '</a>
											</li>';
										}
									}
								}
							endforeach;
							$list .= '
										</ul>';

							return $list;
						}
					endif;
				else :
					return false;
				endif;
			else :
				return __('Invalid post ID specified', 'related' );
			endif;
		}


		/*
		 * Add the plugin data to the content, if it is set in the options.
		 */
		public function related_content_filter( $content ) {
			if ( is_feed() ) {
				return $content;
			}
			if ( (get_option( 'related_content', 0 ) == 1 && is_singular()) || get_option( 'related_content_all', 0 ) == 1 ) {
				global $related;
				$related_posts = $related->show( get_the_ID() );
				if ( $related_posts ) {
					$content .= '<div class="related_content" style="clear:both;">';
					$content .= '<h3 class="widget-title">';
					$filtered_title = stripslashes(get_option('related_content_title', __('Related Posts', 'related')));
					$content .= apply_filters( 'related_content_title', $filtered_title );
					$content .= '</h3>';
					$content .= $related_posts;
					$content .= '</div>
					';
				}
			}
			// otherwise returns the old content
			return $content;
		}


		/*
		 * Add the plugin data to the content of the RSS Feed.
		 */
		public function related_content_rss( $content ) {
			if ( is_feed() && get_option( 'related_content_rss', 0 ) == 1 ) {
				global $related;
				$related_posts = $related->show( get_the_ID() );
				if ( $related_posts ) {
					$content .= '<div class="related_content" style="clear:both;">';
					$content .= '<h3 class="widget-title">';
					$filtered_title = stripslashes(get_option('related_content_title', __('Related Posts', 'related')));
					$content .= apply_filters( 'related_content_title', $filtered_title );
					$content .= '</h3>';
					$content .= $related_posts;
					$content .= '</div>
					';
				}
			}
			// otherwise returns the old content
			return $content;
		}
	}

endif;


/**
 * Create HTML dropdown list of hierarchical post_types.
 * Returns the list of <option>'s for the select dropdown.
 */
class Walker_RelatedDropdown extends Walker {
	/**
	 * @see Walker::$tree_type
	 * @since 2.1.0
	 * @var string
	 */
	public $tree_type = 'page';

	/**
	 * @see Walker::$db_fields
	 * @since 2.1.0
	 * @todo Decouple this
	 * @var array
	 */
	public $db_fields = array ('parent' => 'post_parent', 'id' => 'ID');

	/**
	 * @see Walker::start_el()
	 * @since 2.1.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $page   Page data object.
	 * @param int    $depth  Depth of page in reference to parent pages. Used for padding.
	 * @param int $id
	 */
	public function start_el( &$output, $page, $depth = 0, $args = array(), $id = 0 ) {
		$pad = str_repeat('&nbsp;', $depth * 3);

		$output .= "\t<option class=\"level-$depth\" value=\"" . esc_attr( $page->ID ) . "\">";

		$title = $page->post_title;
		$title .= self::AppendEnglishTitle($page->ID );
		if ( '' === $title ) {
			$title = sprintf( __( '#%d (no title)', 'related' ), $page->ID );
		}

		/**
		 * Filter the page title when creating an HTML drop-down list of pages.
		 *
		 * @since 3.1.0
		 *
		 * @param string $title Page title.
		 * @param object $page  Page data object.
		 */
		$title = apply_filters( 'list_pages', $title, $page );
		$output .= $pad . esc_html( $title );
		$output .= "</option>\n";
	}
	
        public static function AppendEnglishTitle($postId){
            $enPost = self::GetEnglish($postId);
            $title = "";
                if(isset($enPost) && $enPost->ID != $postId){
                    $title .= '('.$enPost->post_title.')';
                }
                return $title;
        }
        
        public static function GetEnglish($postId){
            $englishPost = get_post(pll_get_post($postId, 'en'));
            return $englishPost;
        }
}


/*
 * related_links
 * Add Settings link to the main plugin page
 *
 */

function related_links( $links, $file ) {
	if ( $file == plugin_basename( dirname(__FILE__).'/related.php' ) ) {
		$links[] = '<a href="' . admin_url( 'options-general.php?page=related.php' ) . '">'.__( 'Settings', 'related' ).'</a>';
	}
	return $links;
}
add_filter( 'plugin_action_links', 'related_links', 10, 2 );


/* Include Settings page */
include( 'adminpages/page-related.php' );

/* Include widget */
include( 'widgets/related-widget.php' );

/* Include Double Up plugin */
include( 'related_du.php' );


/*
 * related_init
 * Function called at initialisation.
 * - Loads language files
 * - Make an instance of Related()
 */

function related_init() {
	load_plugin_textdomain('related', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/');

	// Start the plugin
	global $related;
	$related = new Related();
}
add_action('plugins_loaded', 'related_init');

