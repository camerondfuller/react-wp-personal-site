<?php
/**
 * Loads needed stuffs.
 *
 * @package lychee
 * @since 1.0.0
 */



defined( 'F_PATH' )		OR	define(	'F_PATH',	'core' );
defined( 'T_NAME' )		OR	define(	'T_NAME',	'lychee');
defined( 'F_DIR' )		OR	define(	'F_DIR',	F_PATH );
defined( 'T_URI' )		OR	define(	'T_URI', 	get_template_directory_uri() );
defined( 'T_PATH' )		OR	define(	'T_PATH',	get_template_directory() );


// ----------------------------------------------------------------------------------------------------
// PageOptions Class include
// ----------------------------------------------------------------------------------------------------
locate_template	( 'core/classes/themeoptions.class.php',				true );

// ----------------------------------------------------------------------------------------------------
// Header Walker Class integration
// ----------------------------------------------------------------------------------------------------
locate_template( 'core/classes/primarynavwalker.class.php',				true );

// ----------------------------------------------------------------------------------------------------
// Aqua Resizer Class integration
// ----------------------------------------------------------------------------------------------------
locate_template( 'core/classes/aq_resizer.class.php',					true );

// ----------------------------------------------------------------------------------------------------
// TGM Activation Plugin integration
// ----------------------------------------------------------------------------------------------------
locate_template( 'core/classes/tgm-activation.class.php',				true );