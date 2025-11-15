<?php

/*
 * URL Functions
 * 
 */

/*
 * Check if a URL exists and is accessible
 */
function url_exists($url)
{

    // Validate URL format first
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        return false;
    }

    // Initialize cURL
    $ch = curl_init($url);
    
    // Set cURL options
    curl_setopt($ch, CURLOPT_NOBODY, true); // Don't download the body
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow redirects
    curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Timeout after 10 seconds
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Don't verify SSL (for testing)
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    // Execute the request
    curl_exec($ch);
    
    // Get the HTTP response code
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    // Close cURL
    curl_close($ch);
    
    // Check if the response code indicates success (2xx or 3xx)
    return ($http_code >= 200 && $http_code < 400);
    
}
