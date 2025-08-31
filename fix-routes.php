<?php
$content = file_get_contents('routes/web.php');

// Remove duplicate route definitions
$lines = explode("\n", $content);
$seen_routes = [];
$clean_lines = [];

foreach ($lines as $line) {
    if (preg_match('/->name\([\'"]([^\'"]+)[\'"]\)/', $line, $matches)) {
        $route_name = $matches[1];
        if (!in_array($route_name, $seen_routes)) {
            $seen_routes[] = $route_name;
            $clean_lines[] = $line;
        }
    } else {
        $clean_lines[] = $line;
    }
}

file_put_contents('routes/web.php.cleaned', implode("\n", $clean_lines));
echo "Cleaned routes saved to routes/web.php.cleaned\n";
