<?php

/**
 * Ninja Form Action for DSS Events
 *
 * @package     Ninja Form Action for DSS Events
 * @author      Per Soderlind
 * @copyright   2018 Per Soderlind
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: Ninja Form Action for DSS Events
 * Plugin URI: https://github.com/soderlind/ninja-forms-dss-event-action
 * GitHub Plugin URI: https://github.com/soderlind/ninja-forms-dss-event-action
 * Description: description
 * Version:     3.0.1
 * Author:      Per Soderlind
 * Author URI:  https://soderlind.no
 * Text Domain: ninja-forms-dss-event-action
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

namespace Soderlind\NinjaForms\Action\DSSEvent;

add_filter(
	'ninja_forms_register_actions',
	function( $actions ) {
		$actions['dssevent'] = new class extends \NF_Abstracts_Action { // anonymous class, PHP 7.x requiered
			/**
			 * @var string
			 */
			protected $_name = 'dssevent';

			/**
			 * @var array
			 */
			protected $_tags = array();

			/**
			 * @var string
			 */
			protected $_timing = 'late';

			/**
			 * @var int
			 */
			protected $_priority = '10';

			/**
			 * Constructor
			 */
			public function __construct() {
				parent::__construct();

				$this->_nicename = __( 'DSS Event', 'ninja-forms' );

				$available_events = $this->get_events();
				$settings         = self::config( 'DSSEvent' );
				$this->_settings  = array_merge( $available_events, $settings );
			}

			/*
			* PUBLIC METHODS
			*/

			public function save( $action_settings ) {
			}

			public function process( $action_settings, $form_id, $data ) {

				if ( isset( $action_settings['dss_event_id'] ) ) {
					$event = \DSS\WP_Events\Event::get_event( $action_settings['dss_event_id'] );
					if ( $event instanceof \WP_Error ) {
						$errors = $event->get_error_message();
					}

					if ( ! isset( $errors ) && true !== $event->is_signup_allowed() ) {
						$errors = esc_html__( 'Sign up is not possible at the moment. The deadline date has already passed.', 'dss-wp-events' );
					}
					if ( ! isset( $errors ) ) {
						$event->add_guest(
							$action_settings['dss_event_firstname'],
							$action_settings['dss_event_lastname'],
							$action_settings['dss_event_email'],
							$action_settings['dss_event_phone'],
							$action_settings['dss_event_title'],
							$action_settings['dss_event_company']
						);
					}
				}

				if ( isset( $errors ) ) {
					$data['errors']['form']['dssevent-error'] = $errors;
				}

				return $data;
			}

			public static function config( $file_name ) {
				return include plugin_dir_path( __FILE__ ) . 'config/' . $file_name . '.php';
			}

			protected function get_events() {
				$events  = get_posts(
					[
						'post_type'   => 'dss-wp-event',
						'post_status' => 'publish',
					]
				);
				$options = [];
				$value   = '';
				foreach ( $events as  $event ) {
					if ( '' == $value ) {
						$value = $event->ID;
					}
					$options[] = [
						'label' => $event->post_title,
						'value' => $event->ID,
					];
				}

				return [
					'dss_event_id' => [
						'name'        => 'dss_event_id',
						'type'        => 'select',
						'label'       => __( 'Event', 'date-range-ninja-forms' ),
						'placeholder' => __( 'Select Event', 'ninja-forms' ),
						'width'       => 'full',
						'group'       => 'primary',
						'options'     => $options,
						'value'       => $value,
					],
				];
			}
		};

		return $actions;
	}
);
