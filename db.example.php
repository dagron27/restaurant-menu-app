<?php
// Example / template only -- not included by any page. See db.php.
//
// db.php reads its MySQL connection settings from environment variables
// instead of hardcoding them in source control. To run this app locally
// or in any deployment, set the following environment variables before
// starting the PHP web server:
//
//   DB_HOST  - MySQL host (optional, defaults to "localhost")
//   DB_USER  - MySQL username (required, no default)
//   DB_PASS  - MySQL password (required, no default)
//   DB_NAME  - MySQL database name (optional, defaults to "restaurant_db")
//
// How to set them depends on your environment, for example:
//
//   Linux/macOS shell:
//     export DB_HOST=localhost
//     export DB_USER=your_mysql_user
//     export DB_PASS=your_mysql_password
//     export DB_NAME=restaurant_db
//
//   Windows PowerShell:
//     $env:DB_HOST = "localhost"
//     $env:DB_USER = "your_mysql_user"
//     $env:DB_PASS = "your_mysql_password"
//     $env:DB_NAME = "restaurant_db"
//
//   Apache (httpd.conf / vhost):
//     SetEnv DB_HOST localhost
//     SetEnv DB_USER your_mysql_user
//     SetEnv DB_PASS your_mysql_password
//     SetEnv DB_NAME restaurant_db
//
//   php-fpm (pool .conf file):
//     env[DB_HOST] = localhost
//     env[DB_USER] = your_mysql_user
//     env[DB_PASS] = your_mysql_password
//     env[DB_NAME] = restaurant_db
//
// If DB_USER or DB_PASS are not set, db.php will stop with a clear error
// instead of connecting with missing credentials.
//
// Never commit real credentials to source control. This file is a
// documentation template only and intentionally contains no real values.
