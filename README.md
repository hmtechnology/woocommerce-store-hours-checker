# woocommerce-store-hours-checker
a function to check and restrict woocommerce checkout outside of store opening hours based on the specified time zone

# WooCommerce Store Hours Checker

![GitHub](https://img.shields.io/github/license/hmtechnology/woocommerce-store-hours-checker)
![GitHub release (latest by date)](https://img.shields.io/github/v/release/hmtechnology/woocommerce-store-hours-checker)

A PHP function to check and restrict WooCommerce checkout outside of store opening hours based on the specified time zone (e.g., "Europe/Rome").

## Table of Contents

- [About](#about)
- [Features](#features)
- [Getting Started](#getting-started)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)

## About

This function is designed to help WooCommerce store owners restrict the checkout process during specific hours, ensuring it aligns with their physical store's opening hours.

## Features

- Set your WooCommerce store's time zone.
- Define opening and closing hours for each day of the week.
- Check if the store is open during the current time and day.
- Restrict WooCommerce checkout outside of specified open hours.
- Provide a user-friendly error message for customers trying to check out during closed hours.

## Getting Started

To get started, follow these steps:

1. Clone the repository: `git clone https://github.com/hmtechnology/woocommerce-store-hours-checker.git`
2. Integrate the `is_store_open()` and `disable_checkout_outside_store_hours()` functions into your WooCommerce project.
3. Customize the opening and closing hours for each day in the `$store_hours` array.
4. Configure the time zone to match your store's location.
5. Save the changes and enjoy automated store hour restrictions.

## Usage

Integrate function contained in functions.php into your active functions.php to automatically restrict checkout outside of your store's opening hours. Make sure to customize the `$store_hours` array and set the correct time zone using `date_default_timezone_set()`.

## Contributing

Contributions are welcome! If you have any improvements or new features to suggest, please open an issue or submit a pull request. We appreciate your feedback.

## License

This project is licensed under the GNU General Public License v3.0 - see the LICENSE file for details.
