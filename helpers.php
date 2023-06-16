<?php

if (!function_exists('asset')) {
    function asset(string $path): string
    {
        $assets_path = DIRECTORY_SEPARATOR . "assets";

        return $assets_path . DIRECTORY_SEPARATOR . $path;
    }
}

if (!function_exists('public_path')) {
    function public_path(): string
    {
        return "public";
    }
}

if (!function_exists('abort')) {
    function abort(string $key, string $message, int $code = 422)
    {
        http_response_code($code);
        $_SESSION[$key] = $message;
        header("Location: /");
        exit();
    }
}

if (!function_exists('dd')) {
    function dd($vars): void
    {
        echo '<pre>';
        var_dump($vars);
        echo '</pre>';
        die();
    }
}