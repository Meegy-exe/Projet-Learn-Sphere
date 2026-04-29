<?php
/**
 * Wizard
 *
 * @package Consultancy_Firm_Whizzie
 * @author Catapult Themes
 * @since 1.0.0
 */

class Consultancy_Firm_Whizzie {
	
	protected $version = '1.1.0';
	
	/** @var string Current theme name, used as namespace in actions. */
	protected $consultancy_firmtheme_name = '';
	protected $consultancy_firmtheme_title = '';
	
	/** @var string Wizard page slug and title. */
	protected $consultancy_firmpage_slug = '';
	protected $consultancy_firmpage_title = '';
	
	/** @var array Wizard steps set by user. */
	protected $config_steps = array();
	
	/**
	 * Relative plugin url for this plugin folder
	 * @since 1.0.0
	 * @var string
	 */
	protected $consultancy_firmplugin_url = '';

	public $consultancy_firmplugin_path;
	public $parent_slug;
	
	/**
	 * TGMPA instance storage
	 *
	 * @var object
	 */
	protected $tgmpa_instance;
	
	/**
	 * TGMPA Menu slug
	 *
	 * @var string
	 */
	protected $tgmpa_menu_slug = 'tgmpa-install-plugins';
	
	/**
	 * TGMPA Menu url
	 *
	 * @var string
	 */
	protected $tgmpa_url = 'themes.php?page=tgmpa-install-plugins';
	
	/**
	 * Constructor
	 *
	 * @param $config	Our config parameters
	 */
	public function __construct( $config ) {
		$this->set_vars( $config );
		$this->init();
	}
	
	/**
	 * Set some settings
	 * @since 1.0.0
	 * @param $config	Our config parameters
	 */
	public function set_vars( $config ) {
	
		require_once trailingslashit( WHIZZIE_DIR ) . 'tgm/class-tgm-plugin-activation.php';
		require_once trailingslashit( WHIZZIE_DIR ) . 'tgm/tgm.php';

		if( isset( $config['consultancy_firmpage_slug'] ) ) {
			$this->consultancy_firmpage_slug = esc_attr( $config['consultancy_firmpage_slug'] );
		}
		if( isset( $config['consultancy_firmpage_title'] ) ) {
			$this->consultancy_firmpage_title = esc_attr( $config['consultancy_firmpage_title'] );
		}
		if( isset( $config['steps'] ) ) {
			$this->config_steps = $config['steps'];
		}
		
		$this->consultancy_firmplugin_path = trailingslashit( dirname( __FILE__ ) );
		$relative_url = str_replace( get_template_directory(), '', $this->consultancy_firmplugin_path );
		$this->consultancy_firmplugin_url = trailingslashit( get_template_directory_uri() . $relative_url );
		$consultancy_firmcurrent_theme = wp_get_theme();
		$this->consultancy_firmtheme_title = $consultancy_firmcurrent_theme->get( 'Name' );
		$this->consultancy_firmtheme_name = strtolower( preg_replace( '#[^a-zA-Z]#', '', $consultancy_firmcurrent_theme->get( 'Name' ) ) );
		$this->consultancy_firmpage_slug = apply_filters( $this->consultancy_firmtheme_name . '_theme_setup_wizard_consultancy_firmpage_slug', $this->consultancy_firmtheme_name . '-wizard' );
		$this->parent_slug = apply_filters( $this->consultancy_firmtheme_name . '_theme_setup_wizard_parent_slug', '' );

	}
	
	/**
	 * Hooks and filters
	 * @since 1.0.0
	 */	
	public function init() {
		
		if ( class_exists( 'TGM_Plugin_Activation' ) && isset( $GLOBALS['tgmpa'] ) ) {
			add_action( 'init', array( $this, 'get_tgmpa_instance' ), 30 );
			add_action( 'init', array( $this, 'set_tgmpa_url' ), 40 );
		}
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_menu', array( $this, 'menu_page' ) );
		add_action( 'admin_init', array( $this, 'get_plugins' ), 30 );
		add_filter( 'tgmpa_load', array( $this, 'tgmpa_load' ), 10, 1 );
		add_action( 'wp_ajax_setup_plugins', array( $this, 'setup_plugins' ) );
		add_action( 'wp_ajax_consultancy_firmsetup_widgets', array( $this, 'consultancy_firmsetup_widgets' ) );
		
	}
	
	public function enqueue_scripts() {
		wp_enqueue_style( 'consultancy-firm-homepage-setup-style', get_template_directory_uri() . '/inc/homepage-setup/assets/css/homepage-setup-style.css');
		wp_register_script( 'consultancy-firm-homepage-setup-script', get_template_directory_uri() . '/inc/homepage-setup/assets/js/homepage-setup-script.js', array( 'jquery' ), time() );
		wp_localize_script( 
			'consultancy-firm-homepage-setup-script',
			'whizzie_params',
			array(
				'ajaxurl' 		=> admin_url( 'admin-ajax.php' ),
				'wpnonce' 		=> wp_create_nonce( 'whizzie_nonce' ),
				'verify_text'	=> esc_html( 'verifying', 'consultancy-firm' )
			)
		);
		wp_enqueue_script( 'consultancy-firm-homepage-setup-script' );
	}
	
	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}
	
	public function tgmpa_load( $status ) {
		return is_admin() || current_user_can( 'install_themes' );
	}
			
	/**
	 * Get configured TGMPA instance
	 *
	 * @access public
	 * @since 1.1.2
	 */
	public function get_tgmpa_instance() {
		$this->tgmpa_instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
	}
	
	/**
	 * Update $tgmpa_menu_slug and $tgmpa_parent_slug from TGMPA instance
	 *
	 * @access public
	 * @since 1.1.2
	 */
	public function set_tgmpa_url() {
		$this->tgmpa_menu_slug = ( property_exists( $this->tgmpa_instance, 'menu' ) ) ? $this->tgmpa_instance->menu : $this->tgmpa_menu_slug;
		$this->tgmpa_menu_slug = apply_filters( $this->consultancy_firmtheme_name . '_theme_setup_wizard_tgmpa_menu_slug', $this->tgmpa_menu_slug );
		$tgmpa_parent_slug = ( property_exists( $this->tgmpa_instance, 'parent_slug' ) && $this->tgmpa_instance->parent_slug !== 'themes.php' ) ? 'admin.php' : 'themes.php';
		$this->tgmpa_url = apply_filters( $this->consultancy_firmtheme_name . '_theme_setup_wizard_tgmpa_url', $tgmpa_parent_slug . '?page=' . $this->tgmpa_menu_slug );
	}
	
	/**
	 * Make a modal screen for the wizard
	 */
	public function menu_page() {
		add_theme_page( esc_html( $this->consultancy_firmpage_title ), esc_html( $this->consultancy_firmpage_title ), 'manage_options', $this->consultancy_firmpage_slug, array( $this, 'wizard_page' ) );
	}
	
	/**
	 * Make an interface for the wizard
	 */
	public function wizard_page() { 
		tgmpa_load_bulk_installer();

		if ( ! class_exists( 'TGM_Plugin_Activation' ) || ! isset( $GLOBALS['tgmpa'] ) ) {
			die( esc_html__( 'Failed to find TGM', 'consultancy-firm' ) );
		}

		$url = wp_nonce_url( add_query_arg( array( 'plugins' => 'go' ) ), 'whizzie-setup' );
		$method = '';
		$fields = array_keys( $_POST );

		if ( false === ( $creds = request_filesystem_credentials( esc_url_raw( $url ), $method, false, false, $fields ) ) ) {
			return true;
		}

		if ( ! WP_Filesystem( $creds ) ) {
			request_filesystem_credentials( esc_url_raw( $url ), $method, true, false, $fields );
			return true;
		}

		$consultancy_firmtheme = wp_get_theme();
		$consultancy_firmtheme_title = $consultancy_firmtheme->get( 'Name' );
		$consultancy_firmtheme_version = $consultancy_firmtheme->get( 'Version' );

		?>
		<div class="wrap">
			<?php
				printf( '<h1>%s %s</h1>', esc_html( $consultancy_firmtheme_title ), esc_html( '(Version :- ' . $consultancy_firmtheme_version . ')' ) );
			?>
			<div class="homepage-setup">
				<div class="homepage-setup-theme-bundle">
					<div class="homepage-setup-theme-bundle-one">
						<h1><?php echo esc_html__( 'WP Theme Bundle', 'consultancy-firm' ); ?></h1>
						<p><?php echo wp_kses_post( 'Get <span>15% OFF</span> on all WordPress themes! Use code <span>"BNDL15OFF"</span> at checkout. Limited time offer!' ); ?></p>
					</div>
					<div class="homepage-setup-theme-bundle-two">
						<p><?php echo wp_kses_post( 'Extra <span>15%</span> OFF' ); ?></p>
					</div>
					<div class="homepage-setup-theme-bundle-three">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/inc/homepage-setup/assets/homepage-setup-images/bundle-banner.png' ); ?>" alt="<?php echo esc_attr__( 'Theme Bundle Image', 'consultancy-firm' ); ?>">
					</div>
					<div class="homepage-setup-theme-bundle-four">
						<p><?php echo wp_kses_post( '<span>$2795</span>$69' ); ?></p>
						<a target="_blank" href="<?php echo esc_url( CONSULTANCY_FIRM_BUNDLE_BUTTON ); ?>"><?php echo esc_html__( 'SHOP NOW', 'consultancy-firm' ); ?> <span class="dashicons dashicons-arrow-right-alt2"></span></a>
					</div>
				</div>
			</div>
			
			<div class="card whizzie-wrap">
				<div class="demo_content_image">
					<div class="demo_content">
						<?php
							$consultancy_firmsteps = $this->get_steps();
							echo '<ul class="whizzie-menu">';
							foreach ( $consultancy_firmsteps as $consultancy_firmstep ) {
								$class = 'step step-' . esc_attr( $consultancy_firmstep['id'] );
								echo '<li data-step="' . esc_attr( $consultancy_firmstep['id'] ) . '" class="' . esc_attr( $class ) . '">';
								printf( '<h2>%s</h2>', esc_html( $consultancy_firmstep['title'] ) );

								$content = call_user_func( array( $this, $consultancy_firmstep['view'] ) );
								if ( isset( $content['summary'] ) ) {
									printf(
										'<div class="summary">%s</div>',
										wp_kses_post( $content['summary'] )
									);
								}
								if ( isset( $content['detail'] ) ) {
									printf(
										'<div class="detail">%s</div>',
										wp_kses_post( $content['detail'] )
									);
								}
								if ( isset( $consultancy_firmstep['button_text'] ) && $consultancy_firmstep['button_text'] ) {
									printf( 
										'<div class="button-wrap"><a href="#" class="button button-primary do-it" data-callback="%s" data-step="%s">%s</a></div>',
										esc_attr( $consultancy_firmstep['callback'] ),
										esc_attr( $consultancy_firmstep['id'] ),
										esc_html( $consultancy_firmstep['button_text'] )
									);
								}
								echo '</li>';
							}
							echo '</ul>';
						?>
						
						<ul class="whizzie-nav">
							<?php
							$step_number = 1;	
							foreach ( $consultancy_firmsteps as $consultancy_firmstep ) {
								echo '<li class="nav-step-' . esc_attr( $consultancy_firmstep['id'] ) . '">';
								echo '<span class="step-number">' . esc_html( $step_number ) . '</span>';
								echo '</li>';
								$step_number++;
							}
							?>
							<div class="blank-border"></div>
						</ul>

						<div class="homepage-setup-links">
							<div class="homepage-setup-links buttons">
								<a href="<?php echo esc_url(  CONSULTANCY_FIRM_LITE_DOCS_PRO ); ?>" target="_blank" class="button button-primary"><?php echo esc_html__( 'Free Documentation', 'consultancy-firm' ); ?></a>
								<a href="<?php echo esc_url(  CONSULTANCY_FIRM_BUY_NOW ); ?>" class="button button-primary" target="_blank"><?php echo esc_html__( 'Get Premium', 'consultancy-firm' ); ?></a>
								<a href="<?php echo esc_url(  CONSULTANCY_FIRM_DEMO_PRO ); ?>" class="button button-primary" target="_blank"><?php echo esc_html__( 'Premium Demo', 'consultancy-firm' ); ?></a>
								<a href="<?php echo esc_url(  CONSULTANCY_FIRM_SUPPORT_FREE ); ?>" target="_blank" class="button button-primary"><?php echo esc_html__( 'Support Forum', 'consultancy-firm' ); ?></a>
							</div>
						</div> <!-- .demo_image -->

						<div class="step-loading"><span class="spinner"></span></div>
					</div> <!-- .demo_content -->

					<div class="homepage-setup-image">
						<div class="homepage-setup-theme-buynow">
							<div class="homepage-setup-theme-buynow-one">
								<h1><?php echo wp_kses_post( ' Consultancy Firm<br>WordPress Theme' ); ?></h1>
								<p><?php echo wp_kses_post( '<span>25%<br>Off</span> SHOP NOW' ); ?></p>
							</div>
							<div class="homepage-setup-theme-buynow-two">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/inc/homepage-setup/assets/homepage-setup-images/consultancy-firm.png' ); ?>" alt="<?php echo esc_attr__( 'Theme Bundle Image', 'consultancy-firm' ); ?>">
							</div>
							<div class="homepage-setup-theme-buynow-three">
								<p><?php echo wp_kses_post( 'Get <span>25% OFF</span> on Premium  Consultancy Firm WordPress Theme Use code <span>"NYTHEMES25"</span> at checkout.' ); ?></p>
							</div>
							<div class="homepage-setup-theme-buynow-four">
								<a target="_blank" href="<?php echo esc_url(  CONSULTANCY_FIRM_BUY_NOW ); ?>"><?php echo esc_html__( 'Upgrade To Pro With Just $40', 'consultancy-firm' ); ?></a>
							</div>
						</div>
					</div> <!-- .demo_image -->

				</div> <!-- .demo_content_image -->
			</div> <!-- .whizzie-wrap -->
		</div> <!-- .wrap -->
		<?php
	}


	/**
	 * Set options for the steps
	 * Incorporate any options set by the theme dev
	 * Return the array for the steps
	 * @return Array
	 */
	public function get_steps() {
		$consultancy_firmdev_steps = $this->config_steps;
		$consultancy_firmsteps = array( 
			'plugins' => array(
				'id'			=> 'plugins',
				'title'			=> __( 'Install and Activate Essential Plugins', 'consultancy-firm' ),
				'icon'			=> 'admin-plugins',
				'view'			=> 'get_step_plugins',
				'callback'		=> 'install_plugins',
				'button_text'	=> __( 'Install Plugins', 'consultancy-firm' ),
				'can_skip'		=> true
			),
			'widgets' => array(
				'id'			=> 'widgets',
				'title'			=> __( 'Setup Home Page', 'consultancy-firm' ),
				'icon'			=> 'welcome-widgets-menus',
				'view'			=> 'get_step_widgets',
				'callback'		=> 'consultancy_firminstall_widgets',
				'button_text'	=> __( 'Start Home Page Setup', 'consultancy-firm' ),
				'can_skip'		=> false
			),
			'done' => array(
				'id'			=> 'done',
				'title'			=> __( 'Customize Your Site', 'consultancy-firm' ),
				'icon'			=> 'yes',
				'view'			=> 'get_step_done',
				'callback'		=> ''
			)
		);
		
		// Iterate through each step and replace with dev config values
		if( $consultancy_firmdev_steps ) {
			// Configurable elements - these are the only ones the dev can update from homepage-setup-settings.php
			$can_config = array( 'title', 'icon', 'button_text', 'can_skip' );
			foreach( $consultancy_firmdev_steps as $consultancy_firmdev_step ) {
				// We can only proceed if an ID exists and matches one of our IDs
				if( isset( $consultancy_firmdev_step['id'] ) ) {
					$id = $consultancy_firmdev_step['id'];
					if( isset( $consultancy_firmsteps[$id] ) ) {
						foreach( $can_config as $element ) {
							if( isset( $consultancy_firmdev_step[$element] ) ) {
								$consultancy_firmsteps[$id][$element] = $consultancy_firmdev_step[$element];
							}
						}
					}
				}
			}
		}
		return $consultancy_firmsteps;
	}

	/**
	 * Get the content for the plugins step
	 * @return $content Array
	 */
	public function get_step_plugins() {
		$plugins = $this->get_plugins();
		$content = array(); 
		
		// Add plugin name and type at the top
		$content['detail'] = '<div class="plugin-info">';
		$content['detail'] .= '<p><strong>Plugin</strong></p>';
		$content['detail'] .= '<p><strong>Type</strong></p>';
		$content['detail'] .= '</div>';
		
		// The detail element is initially hidden from the user
		$content['detail'] .= '<ul class="whizzie-do-plugins">';
		
		// Add each plugin into a list
		foreach( $plugins['all'] as $slug=>$plugin ) {
			if ( $slug != 'easy-post-views-count') {
				$content['detail'] .= '<li data-slug="' . esc_attr( $slug ) . '">' . esc_html( $plugin['name'] ) . '<span>';
				$keys = array();
				if ( isset( $plugins['install'][ $slug ] ) ) {
					$keys[] = 'Installation';
				}
				if ( isset( $plugins['update'][ $slug ] ) ) {
					$keys[] = 'Update';
				}
				if ( isset( $plugins['activate'][ $slug ] ) ) {
					$keys[] = 'Activation';
				}
				$content['detail'] .= implode( ' and ', $keys ) . ' required';
				$content['detail'] .= '</span></li>';
			}
		}
		
		$content['detail'] .= '</ul>';
		
		return $content;
	}
	
	/**
	 * Print the content for the widgets step
	 * @since 1.1.0
	 */
	public function get_step_widgets() { ?> <?php }
	
	/**
	 * Print the content for the final step
	 */
	public function get_step_done() { ?>
		<div id="consultancy-firm-demo-setup-guid">
			<div class="customize_div">
				<div class="customize_div finish">
					<div class="customize_div finish btns">
						<h3><?php echo esc_html( 'Your Site Is Ready To View' ); ?></h3>
						<div class="btnsss">
							<a target="_blank" href="<?php echo esc_url( get_home_url() ); ?>" class="button button-primary">
								<?php esc_html_e( 'View Your Site', 'consultancy-firm' ); ?>
							</a>
							<a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary">
								<?php esc_html_e( 'Customize Your Site', 'consultancy-firm' ); ?>
							</a>
							<a href="<?php echo esc_url(admin_url()); ?>" class="button button-primary">
								<?php esc_html_e( 'Finsh', 'consultancy-firm' ); ?>
							</a>
						</div>
					</div>
					<div class="consultancy-firm-setup-finish">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/screenshot.png' ); ?>"/>
					</div>
				</div>
			</div>
		</div>
	<?php }

	/**
	 * Get the plugins registered with TGMPA
	 */
	public function get_plugins() {
		$instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
		$plugins = array(
			'all' 		=> array(),
			'install'	=> array(),
			'update'	=> array(),
			'activate'	=> array()
		);
		foreach( $instance->plugins as $slug=>$plugin ) {
			if( $instance->is_plugin_active( $slug ) && false === $instance->does_plugin_have_update( $slug ) ) {
				// Plugin is installed and up to date
				continue;
			} else {
				$plugins['all'][$slug] = $plugin;
				if( ! $instance->is_plugin_installed( $slug ) ) {
					$plugins['install'][$slug] = $plugin;
				} else {
					if( false !== $instance->does_plugin_have_update( $slug ) ) {
						$plugins['update'][$slug] = $plugin;
					}
					if( $instance->can_plugin_activate( $slug ) ) {
						$plugins['activate'][$slug] = $plugin;
					}
				}
			}
		}
		return $plugins;
	}

	/**
	 * Get the widgets.wie file from the /content folder
	 * @return Mixed	Either the file or false
	 * @since 1.1.0
	 */
	public function has_widget_file() {
		if( file_exists( $this->widget_file_url ) ) {
			return true;
		}
		return false;
	}
	
	public function setup_plugins() {
		if ( ! check_ajax_referer( 'whizzie_nonce', 'wpnonce' ) || empty( $_POST['slug'] ) ) {
			wp_send_json_error( array( 'error' => 1, 'message' => esc_html__( 'No Slug Found','consultancy-firm' ) ) );
		}
		$json = array();
		// send back some json we use to hit up TGM
		$plugins = $this->get_plugins();
		
		// what are we doing with this plugin?
		foreach ( $plugins['activate'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-activate',
					'action2'       => - 1,
					'message'       => esc_html__( 'Activating Plugin','consultancy-firm' ),
				);
				break;
			}
		}
		foreach ( $plugins['update'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-update',
					'action2'       => - 1,
					'message'       => esc_html__( 'Updating Plugin','consultancy-firm' ),
				);
				break;
			}
		}
		foreach ( $plugins['install'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-install',
					'action2'       => - 1,
					'message'       => esc_html__( 'Installing Plugin','consultancy-firm' ),
				);
				break;
			}
		}
		if ( $json ) {
			$json['hash'] = md5( serialize( $json ) ); // used for checking if duplicates happen, move to next plugin
			wp_send_json( $json );
		} else {
			wp_send_json( array( 'done' => 1, 'message' => esc_html__( 'Success','consultancy-firm' ) ) );
		}
		exit;
	}


	public function consultancy_firmcustomizer_nav_menu() {

		/* -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+- Consultancy Firm Primary Menu -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-*/

		$consultancy_firmthemename = 'Consultancy Firm';
		$consultancy_firmmenuname = $consultancy_firmthemename . ' Primary Menu';
		$consultancy_firmmenulocation = 'consultancy-firm-primary-menu';
		$consultancy_firmmenu_exists = wp_get_nav_menu_object($consultancy_firmmenuname);

		if (!$consultancy_firmmenu_exists) {
			$consultancy_firmmenu_id = wp_create_nav_menu($consultancy_firmmenuname);

			// Home
			wp_update_nav_menu_item($consultancy_firmmenu_id, 0, array(
				'menu-item-title' => __('Home', 'consultancy-firm'),
				'menu-item-classes' => 'home',
				'menu-item-url' => home_url('/'),
				'menu-item-status' => 'publish'
			));

			// About Us
			$consultancy_firmpage_about = get_page_by_path('about');
			if($consultancy_firmpage_about){
				wp_update_nav_menu_item($consultancy_firmmenu_id, 0, array(
					'menu-item-title' => __('About Us', 'consultancy-firm'),
					'menu-item-classes' => 'birthday',
					'menu-item-url' => get_permalink($consultancy_firmpage_about),
					'menu-item-status' => 'publish'
				));
			}

			// Services
			$consultancy_firmpages_services = get_page_by_path('services');
			if($consultancy_firmpages_services){
				wp_update_nav_menu_item($consultancy_firmmenu_id, 0, array(
					'menu-item-title' => __('Services', 'consultancy-firm'),
					'menu-item-classes' => 'services',
					'menu-item-url' => get_permalink($consultancy_firmpages_services),
					'menu-item-status' => 'publish'
				));
			}

			// PRICING
			$consultancy_firmpages = get_page_by_path('pricing');
			if($consultancy_firmpages){
				wp_update_nav_menu_item($consultancy_firmmenu_id, 0, array(
					'menu-item-title' => __('PRICING', 'consultancy-firm'),
					'menu-item-classes' => 'pricing',
					'menu-item-url' => get_permalink($consultancy_firmpages),
					'menu-item-status' => 'publish'
				));
			}

			// Blogs
			$consultancy_firmpage_blog = get_page_by_path('blogs');
			if($consultancy_firmpage_blog){
				wp_update_nav_menu_item($consultancy_firmmenu_id, 0, array(
					'menu-item-title' => __('Blogs', 'consultancy-firm'),
					'menu-item-classes' => 'blog',
					'menu-item-url' => get_permalink($consultancy_firmpage_blog),
					'menu-item-status' => 'publish'
				));
			}

			// Conatact Us
			$consultancy_firmpage_blog = get_page_by_path('conatact');
			if($consultancy_firmpage_blog){
				wp_update_nav_menu_item($consultancy_firmmenu_id, 0, array(
					'menu-item-title' => __('Conatact Us', 'consultancy-firm'),
					'menu-item-classes' => 'conatact',
					'menu-item-url' => get_permalink($consultancy_firmpage_blog),
					'menu-item-status' => 'publish'
				));
			}

			if (!has_nav_menu($consultancy_firmmenulocation)) {
				$consultancy_firmlocations = get_theme_mod('nav_menu_locations');
				$consultancy_firmlocations[$consultancy_firmmenulocation] = $consultancy_firmmenu_id;
				set_theme_mod('nav_menu_locations', $consultancy_firmlocations);
			}
		}
	}

	
	/**
	 * Imports the Demo Content
	 * @since 1.1.0
	 */
	public function consultancy_firmsetup_widgets(){

		/* -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+- MENUS PAGES -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-*/
		
			// Creation of home page //
			$consultancy_firmhome_content = '';
			$consultancy_firmhome_title = 'Home';
			$consultancy_firmhome = array(
					'post_type' => 'page',
					'post_title' => $consultancy_firmhome_title,
					'post_content'  => $consultancy_firmhome_content,
					'post_status' => 'publish',
					'post_author' => 1,
					'post_slug' => 'home'
			);
			$consultancy_firmhome_id = wp_insert_post($consultancy_firmhome);

			add_post_meta( $consultancy_firmhome_id, '_wp_page_template', 'frontpage.php' );

			$consultancy_firmhome = get_page_by_path( 'Home' );
			update_option( 'page_on_front', $consultancy_firmhome->ID );
			update_option( 'show_on_front', 'page' );

			// Creation of blog page //
			$consultancy_firmblog_title = 'Blog';
			$consultancy_firmblog_check = get_page_by_path('blogs');
			if (!$consultancy_firmblog_check) {
				$consultancy_firmblog = array(
					'post_type'    => 'page',
					'post_title'   => $consultancy_firmblog_title,
					'post_status'  => 'publish',
					'post_author'  => 1,
					'post_name'    => 'blog'
				);
				$consultancy_firmblog_id = wp_insert_post($consultancy_firmblog);

				if (!is_wp_error($consultancy_firmblog_id)) {
					update_option('page_for_posts', $consultancy_firmblog_id);
				}
			}

			// Creation of about page //
			$consultancy_firmabout_title = 'About Us';
			$consultancy_firmabout_content = 'What is Lorem Ipsum?
														Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
														&nbsp;
														Why do we use it?
														It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
														&nbsp;
														Where does it come from?
														There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
														&nbsp;
														Why do we use it?
														It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
														&nbsp;
														Where does it come from?
														There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
			$consultancy_firmabout_check = get_page_by_path('about');
			if (!$consultancy_firmabout_check) {
				$consultancy_firmabout = array(
					'post_type'    => 'page',
					'post_title'   => $consultancy_firmabout_title,
					'post_content'   => $consultancy_firmabout_content,
					'post_status'  => 'publish',
					'post_author'  => 1,
					'post_name'    => 'about'
				);
				wp_insert_post($consultancy_firmabout);
			}

			// Creation of services page //
			$consultancy_firmservices_title = 'Contact';
			$consultancy_firmservices_content = 'What is Lorem Ipsum?
														Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
														&nbsp;
														Why do we use it?
														It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
														&nbsp;
														Where does it come from?
														There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
														&nbsp;
														Why do we use it?
														It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
														&nbsp;
														Where does it come from?
														There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
			$consultancy_firmservices_check = get_page_by_path('conatact');
			if (!$consultancy_firmservices_check) {
				$consultancy_firmservices = array(
					'post_type'    => 'page',
					'post_title'   => $consultancy_firmservices_title,
					'post_content'   => $consultancy_firmservices_content,
					'post_status'  => 'publish',
					'post_author'  => 1,
					'post_name'    => 'conatact'
				);
				wp_insert_post($consultancy_firmservices);
			}

			// Creation of pricing page //
			$consultancy_firmpricing_title = 'Services';
			$consultancy_firmpricing_content = 'What is Lorem Ipsum? Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.';
			$consultancy_firmpricing_check = get_page_by_path('services');
			if (!$consultancy_firmpricing_check) {
				$consultancy_firmpricing = array(
					'post_type'    => 'page',
					'post_title'   => $consultancy_firmpricing_title,
					'post_content'   => $consultancy_firmpricing_content,
					'post_status'  => 'publish',
					'post_author'  => 1,
					'post_name'    => 'Services'
				);
				wp_insert_post($consultancy_firmpricing);
			}

			// Creation of support page //
			$consultancy_firmpricings_title = 'PRICING';
			$consultancy_firmpricings_content = 'What is Lorem Ipsum? Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.';
			$consultancy_firmsupport_check = get_page_by_path('pricing');
			if (!$consultancy_firmsupport_check) {
				$consultancy_firmpricings = array(
					'post_type'    => 'page',
					'post_title'   => $consultancy_firmpricings_title,
					'post_content'   => $consultancy_firmpricings_content,
					'post_status'  => 'publish',
					'post_author'  => 1,
					'post_name'    => 'support'
				);
				wp_insert_post($consultancy_firmpricings);
			}

			// Creation of features page //
			$consultancy_firmfeatures_title = 'About Us';
			$consultancy_firmfeatures_content = 'What is Lorem Ipsum? Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.';
			$consultancy_firmfeatures_check = get_page_by_path('features');
			if (!$consultancy_firmfeatures_check) {
				$consultancy_firmfeatures = array(
					'post_type'    => 'page',
					'post_title'   => $consultancy_firmfeatures_title,
					'post_content'   => $consultancy_firmfeatures_content,
					'post_status'  => 'publish',
					'post_author'  => 1,
					'post_name'    => 'features'
				);
				wp_insert_post($consultancy_firmfeatures);
			}

			// Creation of services page //
			$consultancy_firmbirthday_title = 'Contact Us';
			$consultancy_firmbirthday_content = 'What is Lorem Ipsum? Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.';
			$consultancy_firmbirthday_check = get_page_by_path('birthday');
			if (!$consultancy_firmbirthday_check) {
				$consultancy_firmbirthday = array(
					'post_type'    => 'page',
					'post_title'   => $consultancy_firmbirthday_title,
					'post_content'   => $consultancy_firmbirthday_content,
					'post_status'  => 'publish',
					'post_author'  => 1,
					'post_name'    => 'Contact'
				);
				wp_insert_post($consultancy_firmbirthday);
			}

			// Creation of Pages //
			$consultancy_firmnotfound_title = 'Pages';
			$consultancy_firmnotfound = array(
				'post_type'   => 'pages',
				'post_title'  => $consultancy_firmnotfound_title,
				'post_status' => 'publish',
				'post_author' => 1,
				'post_slug'   => 'pages'
			);
			$consultancy_firmnotfound_id = wp_insert_post($consultancy_firmnotfound);
			add_post_meta($consultancy_firmnotfound_id, '_wp_page_template', 'pages.php');


			/* -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+- SLIDER POST -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-*/
				set_theme_mod('consultancy_firm_header_banner_cat', 'Slider');
				$consultancy_firm_slider_title = array('Strategic Consulting Experts in the UK');
				for($consultancy_firm_i=1;$consultancy_firm_i<=1;$consultancy_firm_i++){

					$consultancy_firm_title = $consultancy_firm_slider_title[$consultancy_firm_i-1];
					$consultancy_firm_content = 'Empowering businesses to overcome challenges, seize opportunities, and scale sustainably.';

					// Create post object
					$consultancy_firm_my_post = array(
							'post_title'    => wp_strip_all_tags( $consultancy_firm_title ),
							'post_content'  => $consultancy_firm_content,
							'post_status'   => 'publish',
							'post_type'     => 'post',
					);
					// Insert the post into the database
					$consultancy_firm_post_id = wp_insert_post( $consultancy_firm_my_post );

					wp_set_object_terms($consultancy_firm_post_id, 'Slider', 'category', true);

					wp_set_object_terms($consultancy_firm_post_id, 'Slider', 'post_tag', true);

					$consultancy_firm_image_url = get_template_directory_uri().'/assets/images/slider-img1.png';

					$consultancy_firm_image_name= 'slider-img1.png';
					$upload_dir       = wp_upload_dir();
					// Set upload folder
					$consultancy_firm_image_data       = file_get_contents($consultancy_firm_image_url);
					// Get image data
					$unique_file_name = wp_unique_filename( $upload_dir['path'], $consultancy_firm_image_name );

					$consultancy_firm_filename = basename( $unique_file_name ); 
					
					// Check folder permission and define file location
					if( wp_mkdir_p( $upload_dir['path'] ) ) {
							$consultancy_firm_file = $upload_dir['path'] . '/' . $consultancy_firm_filename;
					} else {
							$consultancy_firm_file = $upload_dir['basedir'] . '/' . $consultancy_firm_filename;
					}
					// Create the image  file on the server
					// Generate unique name
					if ( ! function_exists( 'WP_Filesystem' ) ) {
						require_once( ABSPATH . 'wp-admin/includes/file.php' );
					}
					
					WP_Filesystem();
					global $wp_filesystem;
					
					if ( ! $wp_filesystem->put_contents( $consultancy_firm_file, $consultancy_firm_image_data, FS_CHMOD_FILE ) ) {
						wp_die( 'Error saving file!' );
					}
					// Check image file type
					$wp_filetype = wp_check_filetype( $consultancy_firm_filename, null );
					// Set attachment data
					$consultancy_firm_attachment = array(
							'post_mime_type' => $wp_filetype['type'],
							'post_title'     => sanitize_file_name( $consultancy_firm_filename ),
							'post_content'   => '',
							'post_type'     => 'post',
							'post_status'    => 'inherit'
					);
					// Create the attachment
					$consultancy_firm_attach_id = wp_insert_attachment( $consultancy_firm_attachment, $consultancy_firm_file, $consultancy_firm_post_id );
					// Include image.php
					require_once(ABSPATH . 'wp-admin/includes/image.php');
					// Define attachment metadata
					$consultancy_firm_attach_data = wp_generate_attachment_metadata( $consultancy_firm_attach_id, $consultancy_firm_file );
					// Assign metadata to attachment
						wp_update_attachment_metadata( $consultancy_firm_attach_id, $consultancy_firm_attach_data );
					// And finally assign featured image to post
					set_post_thumbnail( $consultancy_firm_post_id, $consultancy_firm_attach_id );

	 			}

	 		/* -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+- Service POST -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-*/

				set_theme_mod('consultancy_firm_locations_post_cat', 'Service');

				$consultancy_firm_slider_title = array('Sarah Morgan','James lee','Priya meheta');
				for($consultancy_firm_i=1;$consultancy_firm_i<=3;$consultancy_firm_i++){

					set_theme_mod('consultancy_firm_service_icon'.$consultancy_firm_i,[$consultancy_firm_i-1]);

					$consultancy_firm_title = $consultancy_firm_slider_title[$consultancy_firm_i-1];
					$consultancy_firm_content = 'Lead Strategy Consultant';

					// Create post object
					$consultancy_firm_my_post = array(
							'post_title'    => wp_strip_all_tags( $consultancy_firm_title ),
							'post_content'  => $consultancy_firm_content,
							'post_status'   => 'publish',
							'post_type'     => 'post',
					);
					// Insert the post into the database
					$consultancy_firm_post_id = wp_insert_post( $consultancy_firm_my_post );

					wp_set_object_terms($consultancy_firm_post_id, 'Service', 'category', true);

					wp_set_object_terms($consultancy_firm_post_id, 'Service', 'post_tag', true);

					$consultancy_firm_image_url = get_template_directory_uri().'/assets/images/team'.$consultancy_firm_i.'.png';

					$consultancy_firm_image_name= 'team'.$consultancy_firm_i.'.png';
					$upload_dir       = wp_upload_dir();
					// Set upload folder
					$consultancy_firm_image_data       = file_get_contents($consultancy_firm_image_url);
					// Get image data
					$unique_file_name = wp_unique_filename( $upload_dir['path'], $consultancy_firm_image_name );

					$consultancy_firm_filename = basename( $unique_file_name ); 
					
					// Check folder permission and define file location
					if( wp_mkdir_p( $upload_dir['path'] ) ) {
							$consultancy_firm_file = $upload_dir['path'] . '/' . $consultancy_firm_filename;
					} else {
							$consultancy_firm_file = $upload_dir['basedir'] . '/' . $consultancy_firm_filename;
					}
					// Create the image  file on the server
					// Generate unique name
					if ( ! function_exists( 'WP_Filesystem' ) ) {
						require_once( ABSPATH . 'wp-admin/includes/file.php' );
					}
					
					WP_Filesystem();
					global $wp_filesystem;
					
					if ( ! $wp_filesystem->put_contents( $consultancy_firm_file, $consultancy_firm_image_data, FS_CHMOD_FILE ) ) {
						wp_die( 'Error saving file!' );
					}
					// Check image file type
					$wp_filetype = wp_check_filetype( $consultancy_firm_filename, null );
					// Set attachment data
					$consultancy_firm_attachment = array(
							'post_mime_type' => $wp_filetype['type'],
							'post_title'     => sanitize_file_name( $consultancy_firm_filename ),
							'post_content'   => '',
							'post_type'     => 'post',
							'post_status'    => 'inherit'
					);
					// Create the attachment
					$consultancy_firm_attach_id = wp_insert_attachment( $consultancy_firm_attachment, $consultancy_firm_file, $consultancy_firm_post_id );
					// Include image.php
					require_once(ABSPATH . 'wp-admin/includes/image.php');
					// Define attachment metadata
					$consultancy_firm_attach_data = wp_generate_attachment_metadata( $consultancy_firm_attach_id, $consultancy_firm_file );
					// Assign metadata to attachment
						wp_update_attachment_metadata( $consultancy_firm_attach_id, $consultancy_firm_attach_data );
					// And finally assign featured image to post
					set_post_thumbnail( $consultancy_firm_post_id, $consultancy_firm_attach_id );

	 			}
        
        $this->consultancy_firmcustomizer_nav_menu();

	    exit;
	}
}