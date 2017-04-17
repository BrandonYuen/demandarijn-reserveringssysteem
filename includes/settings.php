<?php
//Define DB credentials
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "de_mandarijn");

//Custom error handler, so every error will throw a custom ErrorException
set_error_handler(function ($severity, $message, $file, $line) {
    throw new ErrorException($message, $severity, $severity, $file, $line);
});
