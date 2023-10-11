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
        array('open' => '09:00', 'close' => '12:00'),
        array('open' => '15:00', 'close' => '18:00')
    ),
    'tuesday'   => array(
        array('open' => '09:00', 'close' => '18:00')
    ),
    'wednesday' => array(
        array('open' => '09:00', 'close' => '13:00')
    ),
    'thursday'  => array(
        array('open' => '09:00', 'close' => '18:00')
    ),
    'friday'    => array(
        array('open' => '09:00', 'close' => '18:00')
    ),
    'saturday'  => array(
        array('open' => '10:00', 'close' => '15:00')
    ),
    'sunday'    => array() // Closed on Sunday
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
    
    // Add style to error message
    echo '<style>
        .woocommerce-notices-wrapper {
            background-color: #ff6666; 
            padding: 10px; 
            border: 1px solid #ff3333; 
            border-radius: 4px; 
        }

        .woocommerce-notices-wrapper .woocommerce-error li {
            list-style-type: none; 
        }

        .woocommerce-notices-wrapper .woocommerce-error li::before {
            content: "\274C ";
            font-size: 16px;
            margin-right: 5px;
        }

        /* Rimuovi il bordo superiore */
        .woocommerce .woocommerce-error[role="alert"]::before {
            content: none !important;
        }

        .woocommerce .woocommerce-error {
            border-top: 0 !important;
        }
    </style>';
}

add_action('wp', 'disable_checkout_outside_store_hours');
