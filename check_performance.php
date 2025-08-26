<?php
echo "=== LARAVEL PERFORMANCE CHECK ===\n\n";

// Check cache
echo "✓ Config Cached: " . (file_exists(base_path('bootstrap/cache/config.php')) ? 'YES' : 'NO') . "\n";
echo "✓ Routes Cached: " . (file_exists(base_path('bootstrap/cache/routes-v7.php')) ? 'YES' : 'NO') . "\n";
echo "✓ Views Cached: " . (count(glob(storage_path('framework/views/*.php'))) > 0 ? 'YES' : 'NO') . "\n";

// Check debug mode
$env = file_get_contents(base_path('.env'));
echo "✓ Debug Mode: " . (strpos($env, 'APP_DEBUG=false') !== false ? 'OFF (Good)' : 'ON (Bad for production)') . "\n";
echo "✓ Environment: " . (strpos($env, 'APP_ENV=production') !== false ? 'Production' : 'Development') . "\n";

// Check Composer
echo "✓ Composer Optimized: " . (file_exists(base_path('vendor/composer/autoload_classmap.php')) ? 'YES' : 'NO') . "\n";
