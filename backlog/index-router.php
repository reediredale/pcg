<?php
declare(strict_types=1);
require_once __DIR__ . '/partials/contact-handler.php';

$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';
$path = rtrim($path, '/');
if ($path === '') {
    $path = '/';
}

// Safety net for old-style .php links / bookmarks - send them to the clean URL permanently.
$legacyRedirects = [
    '/index.php'      => '/',
    '/the-system.php' => '/the-system',
    '/results.php'    => '/results',
];
if (isset($legacyRedirects[$path])) {
    header('Location: ' . $legacyRedirects[$path], true, 301);
    exit;
}

$routes = [
    '/'            => __DIR__ . '/partials/pages/home.php',
    '/the-system'  => __DIR__ . '/partials/pages/the-system.php',
    '/results'     => __DIR__ . '/partials/pages/results.php',
];

$pageFile = $routes[$path] ?? null;

if ($pageFile === null) {
    http_response_code(404);
    $pageFile = __DIR__ . '/partials/pages/404.php';
}

require $pageFile;
