<?php

/* 
Plugin Name: Woo Estimated Delivery Banner
Description: Inser an Estimated Delivery Time in your Product Page.
Version: 0.1
Author: Mauro De Falco
Author URI: maurodefalco.it
Text Domain: wcesb
Domain Path: /languages
*/

if(! defined('ABSPATH')){
    exit ;
}

add_action('plugins_loaded', 'wcesb_check_for_woocommerce');
function wcesb_check_for_woocommerce() {
    if (!defined('WC_VERSION')) {
	wp_admin_notice(
	__( 'Install WooCommerce for use plugin.', 'wcesb' ),
	array(
		'id'                 => 'message',
		'additional_classes' => array( 'error' ),
		'dismissible'        => true

	)
);
	}
}

function wcesb_enqueue_style(){
wp_enqueue_style('wcesb', plugins_url( 'style.css', __FILE__ ));
}

add_action('wp_enqueue_scripts', 'wcesb_enqueue_style');

add_action('woocommerce_after_add_to_cart_button', 'wcesb_delivery_date_shipping');
function wcesb_delivery_date_shipping() {
	$shipping_dates = 3;
	date_default_timezone_set('Europe/Rome');
	
	if(date('w') == 6){
		$datefinal = date('d-m-Y', strtotime($shipping_dates. 'days +2 days'));
		$day = strtotime($datefinal);  
		?>
		
	<div class="wcesb_delivery_date_shipping">Il prodotto sarà consegnato partire da <span class="wcesb_date"><?php echo date('l', $day) ?> <?php echo $datefinal; ?> </span></div>
		
	<?php } else if(date('w') == 7){
				$datefinal = date('d-m-Y', strtotime($shipping_dates. 'days +2 days'));
				$day = strtotime($datefinal);  
	echo 'Il prodotto sarà consegnato a partire dal ' . date('l', $day) . $datefinal;
	} else{
		$datefinal = date('d-m-Y', strtotime($shipping_dates. 'days +2 days'));
		$day = strtotime($datefinal);  
	echo 'Il prodotto sarà a casa a partire dal ' . date('l', $day) .  $datefinal . '<br>';
	}
	}

    ?>