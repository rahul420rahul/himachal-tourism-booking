#!/bin/bash

echo "🔧 Fixing MyBirBilling Project..."

# 1. Clean migrations
echo "Cleaning migrations..."
cd database/migrations
rm -f *.backup *.disabled *.old 2>/dev/null
cd ../..

# 2. Clean controllers  
echo "Cleaning controllers..."
cd app/Http/Controllers
rm -f *.backup *.backup2.php *.old "BookingController.php'" 2>/dev/null
cd ../..

# 3. Fix permissions
echo "Fixing permissions..."
chmod -R 755 storage
chmod -R 755 bootstrap/cache
chmod -R 775 public/storage

# 4. Clear all caches
echo "Clearing caches..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 5. Rebuild
echo "Rebuilding..."
npm run build

echo "✅ Done!"
