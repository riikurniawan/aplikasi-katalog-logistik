<?php
function base_url()
{
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $script = $_SERVER['SCRIPT_NAME'];

    $segments = explode('/', $script);
    $segments = array_filter($segments);
    $segments = array_map('strtolower', $segments);

    $base_url = $protocol . '://' . $host . '/' . reset($segments) . '/';
    return $base_url;
}
