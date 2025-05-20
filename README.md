# og-image-preview
OG image preview

### Example Code:
```php
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
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>Open Graph Image Preview</title>
    </head>
    <body>
        <h2>OG Image Preview</h2>
        <?php if ($ogImage): ?>
        <div>
            <img src="<?= htmlspecialchars($ogImage) ?>" alt="OG Image" height="100%" width="100%"/>
        </div>
        <?php else: ?>
        <p>No Open Graph image found for <?= htmlspecialchars($url) ?></p>
        <?php endif; ?>
    </body>
</html>
```
