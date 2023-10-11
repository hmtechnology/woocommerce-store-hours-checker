<?php

/*
 * Synchronize WooCommerce shop's checkout with physical store's open hours
 * This code restricts checkout when the store is closed.
 */

// Set the time zone to "Europe/Rome"
date_default_timezone_set('Europe/Rome');

// Define the opening and closing hours for each day
$store_hours = array(
    'monday'    => array(
        array('open' => '09:00', 'close' => '12:00'), // Two opening and closing times on Monday
        array('open' => '15:00', 'close' => '18:00')  // Two opening and closing times on Monday
    ),
    'tuesday'   => array('open' => '09:00', 'close' => '18:00'),
    'wednesday' => array('open' => '09:00', 'close' => '18:00'),
    'thursday'  => array('open' => '09:00', 'close' => '18:00'),
    'friday'    => array('open' => '09:00', 'close' => '18:00'),
    'saturday'  => array('open' => '10:00', 'close' => '15:00'),
    'sunday'    => array('open' => '00:00', 'close' => '00:00'), // Closed on Sunday
);

// Function to check if the store is open
function is_store_open() {
    global $store_hours;

    $current_day = strtolower(date('l'));
    $current_time = date('H:i');

    if (isset($store_hours[$current_day])) {
        foreach ($store_hours[$current_day] as $time_range) {
            $open_time = strtotime($time_range['open']);
            $close_time = strtotime($time_range['close']);
            $current_time = strtotime($current_time);

            if ($current_time >= $open_time && $current_time <= $close_time) {
                return true;
            }
        }
    }

    return false;
}

// Disable checkout when store is closed
function disable_checkout_outside_store_hours() {
    if (!is_cart() && !is_checkout()) return;

    if (!is_store_open()) {
        wc_add_notice('The store is closed outside of the opening hours.', 'error');
        remove_action('woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20);
    }
}

add_action('wp', 'disable_checkout_outside_store_hours');
