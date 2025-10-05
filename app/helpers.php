<?php

if (! function_exists('getDirectURL')) {
    function getDirectURL(string $url): string
    {
        return preg_replace('/^.*id=([^&]+).*$/', 'https://lh3.googleusercontent.com/d/$1', $url);
    }
}
