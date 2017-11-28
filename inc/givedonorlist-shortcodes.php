<?php
/**
  * Version: 1.0
  * Author: Jason Tucker
  * Author URI: http://www.jasontucker.us/
  * License: GPLv2
  *
  **/

add_shortcode( 'give_donor_list', 'recent_givedonorlist' );

/**
 * Output recent GIVE donors in a list
 * @param array $atts 
 * @return string of names comma seperated
 */
function recent_givedonorlist( $atts ) {

	if ( ! class_exists( 'Give' ) ) {
		return '';
	}

	$args = shortcode_atts(
        array(
            'number'   =>   '100',
            'id'       =>   '1'
        ), $atts
    );

    $number = (int) $args['number'];
    $id = (int) $args['id'];

    $output = '';

    // First check that Give exist
    $donors = Give()->customers->get_customers( $number, $id );
    if ( is_array( $donors ) && ! empty( $donors ) ) {
	    shuffle( $donors );
	    $output = '<ul class="give-donors-list">';
	    foreach ( $donors as $donor ) {
		    $output .= '<li>' . $donor->name . "</li>";
	    }
	    $output .= '</ul>';
    }
    return $output;
}