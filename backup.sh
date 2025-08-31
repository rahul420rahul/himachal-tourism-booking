#!/bin/bash
DATE=$(date +%Y%m%d_%H%M%S)
mkdir -p backups
sqlite3 database/database.sqlite ".backup backups/db_$DATE.sqlite"
tar -czf backups/files_$DATE.tar.gz public/storage/
echo "Backup created: backups/*_$DATE.*"
