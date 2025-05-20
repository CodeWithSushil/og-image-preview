<?php
function getOgImage($url)
{
    $html = file_get_contents($url);
    if ($html === false) {
        return null;
    }
    // Use DOMDocument to parse the HTML
    libxml_use_internal_errors(true);
    // Suppress HTML parsing warnings
    $doc = new DOMDocument();
    $doc->loadHTML($html);
    $xpath = new DOMXPath($doc);

    // Query for og:image
    $metaTags = $xpath->query("//meta[@property='og:image']");

    if ($metaTags->length > 0) {
        return $metaTags[0]->getAttribute("content");
    }
    return null;
}

// Example URL
$url = "https://github.com/laravel/laravel.git";
$ogImage = getOgImage($url);
?>
