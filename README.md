# Lone Wolf

A PHP and MySQL clothing storefront for the Lone Wolf apparel brand. The site includes product browsing, product details, customer sign-in and profiles, and order-related pages.

## Stack

- PHP 8.1 with Apache
- MySQL through the PHP MySQLi extension
- Docker image based on `php:8.1-apache`

## Run with Docker

Build and run the provided Apache image:

```bash
docker build -t lonewolf .
docker run --rm -p 8080:80 lonewolf
```

Open [http://localhost:8080](http://localhost:8080). The application also needs a MySQL database configured for the site; review `db_connect.php` and provide a matching local database and schema. Do not use production credentials in local development.

## Main pages

- `shop.php` and `products.php` — product listings
- `product_details.php` — product detail page
- `login.php`, `profile.php`, and `userdashboard.php` — customer account pages
- `orders.php` and `orderhistory.php` — order views
