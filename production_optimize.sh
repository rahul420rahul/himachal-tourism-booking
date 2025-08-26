#!/bin/bash
echo "🚀 Optimizing for Production..."

# 1. Install production dependencies only
composer install --optimize-autoloader --no-dev

# 2. Build frontend assets
npm run build

# 3. Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# 4. Optimize images (if any uploaded)
find public/uploads -type f \( -name "*.jpg" -o -name "*.jpeg" \) -exec jpegoptim {} \;
find public/uploads -type f -name "*.png" -exec optipng {} \;

echo "✅ Production optimization complete!"
