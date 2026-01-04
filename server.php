<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 */

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// Emulate mod_rewrite from PHP's built-in server so public assets are served
// directly and everything else is forwarded to the front controller.
if ($uri !== '/' && file_exists(__DIR__ . '/public' . $uri)) {
    return false;
}

require_once __DIR__ . '/public/index.php';
