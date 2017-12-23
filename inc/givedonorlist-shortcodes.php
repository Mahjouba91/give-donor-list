<?php

require GIVEDONORLIST_DIR . 'inc/helpers.php';

/**
 * A [donor_list] shortcode to list donors with names and amounts with attributes:
 *
 * @number  = the number of donations to list
 *
 * @param $atts
 */
function give_donor_list_shortcode( $atts ) {

	$atts = shortcode_atts( apply_filters( 'GDL/Shortcode/filter_shortcode_atts', array(
		'number'  => '',
	) ), $atts, 'donor_list' );

	$args = apply_filters( 'GDL/Shortcode/filter_query_args', array(
		'post_type'      => 'give_payment',
		'posts_per_page' => $atts['number'],
	), $atts );

	$dons_query = new WP_Query( $args );

	ob_start();

	include( Helpers::locate_template( 'give-donorlist-tpl' ) );

	$out = ob_get_clean();

	return apply_filters( 'GDL/Shortcode/filter_output', $out, $atts );
}

add_shortcode( 'donor_list', 'give_donor_list_shortcode' );