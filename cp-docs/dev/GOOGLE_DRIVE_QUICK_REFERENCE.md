# Google Drive Integration - Quick Reference Card

## Essential Environment Variables

```env
# Google Cloud OAuth Credentials
GOOGLE_DRIVE_CLIENT_ID=your-client-id.apps.googleusercontent.com
GOOGLE_DRIVE_CLIENT_SECRET=your-client-secret
GOOGLE_DRIVE_REDIRECT_URI=/admin/backup/google-drive/callback

# Feature Enable/Disable
GOOGLE_DRIVE_BACKUP_SYNC_ENABLED=true
GOOGLE_DRIVE_AUTO_SYNC_ON_BACKUP=true

# Sync Configuration
GOOGLE_DRIVE_MAX_RETRIES=3
GOOGLE_DRIVE_SYNC_TIMEOUT=300
GOOGLE_DRIVE_KEEP_BACKUP_VERSIONS=10

# Folder Settings
GOOGLE_DRIVE_ROOT_FOLDER_NAME="BitorePOS Backups"

# Logging
GOOGLE_DRIVE_LOGGING_ENABLED=true
GOOGLE_DRIVE_NOTIFY_ON_FAILURE=true
```

## Key URLs

| Purpose | URL |
|---------|-----|
| Backup Management | `/admin/backup` |
| Google Drive Settings | `/admin/backup/google-drive` |
| Start Authorization | `/admin/backup/google-drive/authorize` |
| OAuth Callback | `/admin/backup/google-drive/callback` |
| Get Sync Status | `/admin/backup/google-drive/sync-status` |
| Recent Syncs | `/admin/backup/google-drive/recent-syncs` |

## Core Classes

| Class | Location | Purpose |
|-------|----------|---------|
| GoogleDriveService | `app/Services/` | Main service class |
| GoogleDriveCredential | `app/` | Model for credentials |
| GoogleDriveBackupSync | `app/` | Model for sync records |
| GoogleDriveIntegrationController | `app/Http/Controllers/` | Admin endpoints |
| GoogleDriveUtil | `app/Utils/` | Helper utilities |
| SyncBackupsToGoogleDrive | `app/Console/Commands/` | Console command |

## Database Tables

### google_drive_credentials
Stores encrypted OAuth tokens
```
- id (PK)
- business_id (FK) 
- user_id (FK)
- access_token (encrypted)
- refresh_token (encrypted)
- token_expires_at
- drive_folder_id
- drive_folder_name
- is_active
```

### google_drive_backup_syncs
Tracks sync history
```
- id (PK)
- business_id (FK)
- backup_file_name
- google_drive_file_id
- file_size_bytes
- sync_status (pending|syncing|completed|failed)
- sync_error_message
- synced_at
- retry_count
```

## Common Code Snippets

### Initialize Service
```php
$service = new GoogleDriveService($businessId, $userId);
```

### Check Credentials
```php
if ($service->hasValidCredentials()) {
    // Credentials exist
}
```

### Sync a File
```php
$success = $service->syncBackupFile($fileName, $filePath);
```

### Get Stats
```php
$stats = GoogleDriveUtil::getStats($businessId);
// Returns: ['total' => 10, 'completed' => 8, 'failed' => 1, 'pending' => 1]
```

### Check Sync Status
```php
$status = GoogleDriveUtil::getSyncStatus($fileName);
// Returns: 'completed', 'failed', 'pending', 'not_synced'
```

### Get Pending Syncs
```php
$pending = GoogleDriveUtil::getPendingSyncs();
```

## Console Commands

```bash
# Sync all pending backups
php artisan backup:sync-to-google-drive

# Sync for specific business
php artisan backup:sync-to-google-drive --business-id=1

# Force resync all files
php artisan backup:sync-to-google-drive --force

# With verbose output
php artisan backup:sync-to-google-drive -v
```

## API Endpoints (JSON)

### Get Statistics
```
GET /admin/backup/google-drive/sync-status
```
Response:
```json
{
  "success": true,
  "data": {
    "total_syncs": 10,
    "completed_syncs": 8,
    "failed_syncs": 1,
    "pending_syncs": 1
  }
}
```

### Get Recent Syncs
```
GET /admin/backup/google-drive/recent-syncs
```

### Retry Failed Sync
```
POST /admin/backup/google-drive/retry-sync
{
  "sync_id": 123
}
```

### Test Connection
```
POST /admin/backup/google-drive/test-connection
```

## Cron Job Setup

Add to crontab:
```bash
* * * * * cd /var/www/bitorépos && php artisan schedule:run >> /dev/null 2>&1
```

Verify:
```bash
php artisan schedule:list
```

Scheduled tasks:
- **backup:run** - Daily at configured time (e.g., 2:00 AM)
- **backup:sync-to-google-drive** - 15 minutes after backup

## Error Handling

All errors logged to: `storage/logs/laravel.log`

Check logs:
```bash
tail -f storage/logs/laravel.log | grep "Google Drive"
```

Common errors:
| Error | Cause | Solution |
|-------|-------|----------|
| No valid credentials | Not authenticated | Authorize via admin panel |
| Token expired | OAuth token old | Auto-refresh or re-authorize |
| API rate limiting | Too many requests | Wait or adjust chunk size |
| Folder not found | Permission issue | Check Google Drive permissions |

## Troubleshooting Commands

### Test in Tinker
```php
php artisan tinker

// Check if credentials exist
App\GoogleDriveCredential::where('business_id', 1)->first()

// Check recent syncs
App\GoogleDriveBackupSync::where('business_id', 1)->latest()->get()

// Test service
$service = new App\Services\GoogleDriveService(1, 1);
$service->hasValidCredentials()

// List Drive files
$service->listBackupFilesInDrive()
```

### Database Queries

```sql
-- Check credentials
SELECT * FROM google_drive_credentials WHERE business_id = 1;

-- Check syncs
SELECT * FROM google_drive_backup_syncs WHERE business_id = 1 ORDER BY created_at DESC;

-- Check failed syncs
SELECT * FROM google_drive_backup_syncs WHERE business_id = 1 AND sync_status = 'failed';

-- Count by status
SELECT sync_status, COUNT(*) FROM google_drive_backup_syncs GROUP BY sync_status;
```

## Security Notes

1. **Never** commit credentials to version control
2. **Always** use environment variables for sensitive data
3. **Encrypt** OAuth tokens (done automatically)
4. **Rotate** credentials annually
5. **Log** all sync operations
6. **Revoke** access when needed
7. **Verify** permissions regularly

## Performance Tips

1. Increase chunk size for faster uploads:
   ```env
   GOOGLE_DRIVE_CHUNK_SIZE=10485760  # 10MB
   ```

2. Increase timeout for large files:
   ```env
   GOOGLE_DRIVE_SYNC_TIMEOUT=600  # 10 minutes
   ```

3. Use Laravel queues for async syncing (future enhancement)

4. Clean up old records periodically:
   ```php
   GoogleDriveUtil::cleanupOldSyncRecords(90);
   ```

## Monitoring Checklist

### Daily
- [ ] Backup created successfully
- [ ] Backup synced to Drive
- [ ] No errors in logs
- [ ] Sync count increased

### Weekly
- [ ] Review failed syncs
- [ ] Check Drive folder size
- [ ] Monitor API usage

### Monthly
- [ ] Test restore process
- [ ] Review retention policy
- [ ] Check credentials expiration

## Important Files

```
config/google-drive.php
app/Services/GoogleDriveService.php
app/Http/Controllers/GoogleDriveIntegrationController.php
app/Http/Controllers/BackUpController.php (updated)
app/Console/Commands/SyncBackupsToGoogleDrive.php
app/Console/Kernel.php (updated)
routes/web.php (updated)
database/migrations/2026_01_29_100000_*.php
database/migrations/2026_01_29_100001_*.php
```

## Documentation Files

1. **GOOGLE_DRIVE_INTEGRATION.md** - Full user documentation
2. **GOOGLE_DRIVE_IMPLEMENTATION_GUIDE.md** - Technical guide
3. **GOOGLE_DRIVE_DEPLOYMENT_CHECKLIST.md** - Deployment steps
4. **GOOGLE_DRIVE_ENV_EXAMPLE.txt** - Environment variables
5. **GOOGLE_DRIVE_INTEGRATION_SUMMARY.md** - Implementation overview

## Useful Links

- [Google Drive API Documentation](https://developers.google.com/drive/api)
- [OAuth 2.0 Flow](https://developers.google.com/identity/protocols/oauth2)
- [Laravel Encryption](https://laravel.com/docs/encryption)
- [Laravel Scheduling](https://laravel.com/docs/scheduling)

## Support Contact

For issues:
1. Check error message in sync record
2. Review application logs
3. Run test connection from admin panel
4. Check Google Cloud Console
5. Verify network connectivity

## Version Info

- **Implementation Date**: January 29, 2026
- **Google API Client**: ^2.15
- **Laravel Version**: ^9.51
- **PHP Version**: ^8.0

---

**Last Updated**: January 29, 2026
**Status**: Ready for Production
