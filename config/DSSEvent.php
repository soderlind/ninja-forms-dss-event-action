<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return apply_filters( 'ninja_forms_action_dssevent_settings', array(
	'dss_event_firstname'    => array(
		'name'           => 'dss_event_firstname',
		'type'           => 'textbox',
		'group'          => 'primary',
		'label'          => __( 'First Name', 'ninja-forms' ),
		'placeholder'    => __( 'First Name field', 'ninja-forms' ),
		'width'          => 'one-half',
		'use_merge_tags' => true,
	),
	'dss_event_lastname'    => array(
		'name'           => 'dss_event_lastname',
		'type'           => 'textbox',
		'group'          => 'primary',
		'label'          => __( 'Last Name', 'ninja-forms' ),
		'placeholder'    => __( 'Last Name', 'ninja-forms' ),
		'width'          => 'one-half',
		'use_merge_tags' => true,
	),
	'dss_event_email'   => array(
		'name'           => 'dss_event_email',
		'type'           => 'textbox',
		'group'          => 'primary',
		'label'          => __( 'Email', 'ninja-forms' ),
		'placeholder'    => __( 'Email address', 'ninja-forms' ),
		'width'          => 'one-half',
		'use_merge_tags' => true,
	),
	'dss_event_phone'     => array(
		'name'           => 'dss_event_phone',
		'type'           => 'textbox',
		'group'          => 'primary',
		'label'          => __( 'Phone', 'ninja-forms' ),
		'placeholder'    => __( 'Phone number (optional)', 'ninja-forms' ),
		'width'          => 'one-half',
		'use_merge_tags' => true,
	),
	'dss_event_title' => array(
		'name'           => 'dss_event_title',
		'type'           => 'textbox',
		'group'          => 'primary',
		'label'          => __( 'Title', 'ninja-forms' ),
		'placeholder'    => __( 'Title  (optional)', 'ninja-forms' ),
		'width'          => 'one-half',
		'use_merge_tags' => true,
	),
	'dss_event_company' => array(
		'name'           => 'dss_event_company',
		'type'           => 'textbox',
		'group'          => 'primary',
		'label'          => __( 'Company', 'ninja-forms' ),
		'placeholder'    => __( 'Company (optional)', 'ninja-forms' ),
		'width'          => 'one-half',
		'use_merge_tags' => true,
	),
) );
