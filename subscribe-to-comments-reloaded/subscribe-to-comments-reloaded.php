<?php
/*
Plugin Name: Subscribe to Comments Reloaded

Version: 150207
Stable tag: 150207
Requires at least: 2.9.2
Tested up to: 4.1

Plugin URI: http://wordpress.org/extend/plugins/subscribe-to-comments-reloaded/
Description: Subscribe to Comments Reloaded is a robust plugin that enables commenters to sign up for e-mail notifications. It includes a full-featured subscription manager that your commenters can use to unsubscribe to certain posts or suspend all notifications.
Contributors: camu, reedyseth, andreasbo, raamdev
Author: camu, reedyseth, Raam Dev
*/

namespace stcr {
	// Avoid direct access to this piece of code
	if ( ! function_exists( 'add_action' ) ) {
		header( 'Location: /' );
		exit;
	}
	require_once dirname(__FILE__).'\\wp_subscribe_reloaded.php';
	if(class_exists('\\'.__NAMESPACE__.'\\wp_subscribe_reloaded'))
	{
		// Initialize the cool stuff
		$wp_subscribe_reloaded = new wp_subscribe_reloaded();
		// Set a cookie if the user just subscribed without commenting
		$subscribe_to_comments_action  = ! empty( $_POST['sra'] ) ? $_POST['sra'] : ( ! empty( $_GET['sra'] ) ? $_GET['sra'] : 0 );
		$subscribe_to_comments_post_ID = ! empty( $_POST['srp'] ) ? intval( $_POST['srp'] ) : ( ! empty( $_GET['srp'] ) ? intval( $_GET['srp'] ) : 0 );

		if ( ! empty( $subscribe_to_comments_action ) && ! empty( $_POST['subscribe_reloaded_email'] ) &&
			( $subscribe_to_comments_action == 's' ) && ( $subscribe_to_comments_post_ID > 0 )
		) {
			$subscribe_to_comments_clean_email = $wp_subscribe_reloaded->clean_email( $_POST['subscribe_reloaded_email'] );
			setcookie( 'comment_author_email' . COOKIEHASH, $subscribe_to_comments_clean_email, time() + 1209600, '/' );
		}
	}
}