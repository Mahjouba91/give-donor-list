<?php
if ( isset( $dons_query ) && $dons_query->have_posts() ) : 
	$date_format = apply_filters( 'GDL/Shortcode/dateformat', 'd F Y, H:i' ); ?>

	<ul class="donor-list">
		<?php while ( $dons_query->have_posts() ) : $dons_query->the_post();
			$meta = get_post_meta( get_the_ID() );
			$paymentmeta = $meta['_give_payment_meta'];
			$getmeta = maybe_unserialize( $paymentmeta[0] );

			$firstname = esc_html( $getmeta['user_info']['first_name'] );
			$lastname  = esc_html( $getmeta['user_info']['last_name'] );
			$name 	   = $firstname . ' ' . $lastname;
			$total     = $meta['_give_payment_total'][0]; 

			$date = new DateTime( reset( $meta['_give_completed_date'] ), get_option('timezone_string') );
			$date = date_i18n( $date_format, $date->getTimestamp() );
			?>

			<li>
				<strong><?php echo give_currency_filter( give_format_amount( $total ) ); ?></strong>
                <strong><?php echo $name; ?></strong>
                <strong><?php echo esc_html( $date ); ?></strong>
			</li>
		<?php endwhile;
		wp_reset_postdata(); ?>
	</ul>
<?php endif;
wp_reset_query();
