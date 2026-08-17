# Google Drive API Integration - Implementation Guide

## Quick Start

### 1. Install Google API Client
```bash
composer require google/apiclient:^2.15
```

### 2. Run Migrations
```bash
php artisan migrate
```

### 3. Google Cloud Setup

Go to [Google Cloud Console](https://console.cloud.google.com/):

1. Create a new project or select existing one
2. Enable "Google Drive API"
3. Create OAuth 2.0 Credentials:
   - Type: Web Application
   - Authorized URLs:
     - Authorized redirect URIs: `https://yourapp.com/admin/backup/google-drive/callback`

### 4. Add Environment Variables

```env
GOOGLE_DRIVE_CLIENT_ID=xxx.apps.googleusercontent.com
GOOGLE_DRIVE_CLIENT_SECRET=xxx
GOOGLE_DRIVE_REDIRECT_URI=/admin/backup/google-drive/callback
GOOGLE_DRIVE_BACKUP_SYNC_ENABLED=true
GOOGLE_DRIVE_AUTO_SYNC_ON_BACKUP=true
```

### 5. Admin Setup

1. Navigate to: `/admin/backup`
2. Click "Connect Google Drive"
3. Authorize the application
4. Done! Backups will now sync automatically

## Project Structure

### Created Files

```
app/
├── Services/
│   └── GoogleDriveService.php           # Main service class
├── Console/
│   └── Commands/
│       └── SyncBackupsToGoogleDrive.php # Sync command
├── Http/
│   └── Controllers/
│       └── GoogleDriveIntegrationController.php
├── GoogleDriveCredential.php            # Model for credentials
├── GoogleDriveBackupSync.php            # Model for sync records
└── Utils/
    └── GoogleDriveUtil.php              # Helper utilities

config/
└── google-drive.php                      # Configuration file

database/
└── migrations/
    ├── 2026_01_29_100000_create_google_drive_credentials_table.php
    └── 2026_01_29_100001_create_google_drive_backup_syncs_table.php

routes/
└── web.php                               # Updated with new routes

resources/
└── views/
    └── backup/
        └── google-drive-index.blade.php # Admin UI

documentation/
├── GOOGLE_DRIVE_INTEGRATION.md          # Full documentation
└── GOOGLE_DRIVE_ENV_EXAMPLE.txt         # Environment variables example
```

## Configuration Options

All options in `config/google-drive.php`:

| Option | Default | Description |
|--------|---------|-------------|
| `client_id` | env | Google OAuth Client ID |
| `client_secret` | env | Google OAuth Client Secret |
| `redirect_uri` | `/admin/backup/google-drive/callback` | OAuth redirect URI |
| `backup_sync.enabled` | false | Enable/disable sync feature |
| `backup_sync.auto_sync_on_backup` | true | Auto-sync after manual backup |
| `backup_sync.max_retries` | 3 | Max retry attempts for failed syncs |
| `backup_sync.timeout_seconds` | 300 | Sync timeout duration |
| `backup_sync.chunk_size_bytes` | 5242880 | File upload chunk size (5MB) |
| `backup_sync.keep_backup_versions` | 10 | Keep this many versions in Drive |
| `backup_sync.delete_local_after_sync` | false | Delete local after sync (careful!) |
| `folder_structure.root_folder_name` | "BitorePOS Backups" | Google Drive folder name |
| `logging.enabled` | true | Enable sync logging |
| `logging.notify_on_success` | false | Email on successful sync |
| `logging.notify_on_failure` | true | Email on failed sync |

## API Endpoints

### Admin Routes (Protected)

All routes require `backup` permission.

| Method | Route | Handler |
|--------|-------|---------|
| GET | `/admin/backup/google-drive` | Show settings |
| GET | `/admin/backup/google-drive/authorize` | Start OAuth flow |
| GET | `/admin/backup/google-drive/callback` | OAuth callback |
| POST | `/admin/backup/google-drive/disconnect` | Revoke access |
| GET | `/admin/backup/google-drive/sync-status` | Get statistics |
| GET | `/admin/backup/google-drive/recent-syncs` | Get sync history |
| POST | `/admin/backup/google-drive/retry-sync` | Retry failed sync |
| DELETE | `/admin/backup/google-drive/delete-sync/{id}` | Delete sync record |
| POST | `/admin/backup/google-drive/test-connection` | Test connection |

### Backup Routes

| Method | Route | Handler |
|--------|-------|---------|
| GET | `/admin/backup` | List backups with sync status |
| POST | `/admin/backup` | Create backup |
| GET | `/admin/backup/{id}` | Show backup |
| GET | `/admin/backup/download/{filename}` | Download backup |
| GET | `/admin/backup/delete/{filename}` | Delete backup |
| GET | `/admin/backup/sync-to-google-drive/{filename}` | Manual sync |

## Console Commands

### Sync Command

```bash
# Sync all pending backups for all businesses
php artisan backup:sync-to-google-drive

# Sync for specific business
php artisan backup:sync-to-google-drive --business-id=1

# Force resync all files
php artisan backup:sync-to-google-drive --force

# With output
php artisan backup:sync-to-google-drive -v
```

## Using the Service Directly

### In Controllers or Jobs

```php
use App\Services\GoogleDriveService;

// Initialize service
$driveService = new GoogleDriveService($businessId, $userId);

// Get authorization URL
$authUrl = $driveService->getAuthorizationUrl();

// Exchange code for token
$driveService->exchangeCodeForToken($code);

// Check credentials
if ($driveService->hasValidCredentials()) {
    // Sync a file
    $success = $driveService->syncBackupFile($fileName, $filePath);
    
    // Get folder
    $folderId = $driveService->getOrCreateBackupFolder();
    
    // List files
    $files = $driveService->listBackupFilesInDrive();
    
    // Cleanup old versions
    $driveService->cleanupOldBackups();
}
```

## Using Utilities

```php
use App\Utils\GoogleDriveUtil;

// Check if enabled
if (GoogleDriveUtil::isEnabled()) {
    // Check if business has credentials
    if (GoogleDriveUtil::hasCredentials($businessId)) {
        // Get service
        $service = GoogleDriveUtil::getService($businessId);
        
        // Get statistics
        $stats = GoogleDriveUtil::getStats($businessId);
        // Returns: ['total' => 10, 'completed' => 8, 'failed' => 1, 'pending' => 1]
        
        // Get sync status
        $status = GoogleDriveUtil::getSyncStatus($fileName);
        // Returns: 'completed', 'pending', 'failed', 'syncing', or 'not_synced'
        
        // Get pending syncs
        $pending = GoogleDriveUtil::getPendingSyncs();
        
        // Get failed syncs
        $failed = GoogleDriveUtil::getFailedSyncs();
        
        // Cleanup old records (90 days)
        GoogleDriveUtil::cleanupOldSyncRecords(90);
    }
}
```

## Database Queries

### Get Sync Status

```php
use App\GoogleDriveBackupSync;

// Get all syncs for business
$syncs = GoogleDriveBackupSync::where('business_id', $businessId)->get();

// Get completed syncs
$completed = GoogleDriveBackupSync::where('business_id', $businessId)
    ->where('sync_status', 'completed')
    ->get();

// Get failed syncs that can be retried
$failed = GoogleDriveBackupSync::where('business_id', $businessId)
    ->where('sync_status', 'failed')
    ->where('retry_count', '<', 3)
    ->get();

// Get by file name
$sync = GoogleDriveBackupSync::where('business_id', $businessId)
    ->where('backup_file_name', 'backup-2026-01-29.zip')
    ->first();

// Get recently synced
$recent = GoogleDriveBackupSync::where('business_id', $businessId)
    ->where('sync_status', 'completed')
    ->orderBy('synced_at', 'desc')
    ->first();
```

### Get Credentials

```php
use App\GoogleDriveCredential;

// Check if authenticated
$credential = GoogleDriveCredential::where('business_id', $businessId)
    ->where('user_id', $userId)
    ->where('is_active', true)
    ->first();

if ($credential) {
    $accessToken = $credential->access_token; // Auto-decrypted
    $isExpired = $credential->isTokenExpired();
}
```

## Error Handling

All errors are logged to `storage/logs/laravel.log`:

```php
try {
    $driveService = new GoogleDriveService($businessId, $userId);
    $driveService->syncBackupFile($fileName, $filePath);
} catch (\Exception $e) {
    \Log::error("Sync error: " . $e->getMessage());
    // Handle error
}
```

## Scheduling

The system schedules two cron jobs:

1. **Backup**: Runs daily at configured time
2. **Sync**: Runs 15 minutes after backup

To manually verify:
```bash
php artisan schedule:list
```

To manually run sync:
```bash
php artisan backup:sync-to-google-drive
```

## Security Considerations

1. **Tokens are encrypted** in database using Laravel's encryption
2. **Only admins** with `backup` permission can authorize
3. **Credentials are isolated** per user/business
4. **Tokens auto-refresh** before expiration
5. **Access can be revoked** immediately
6. **All operations logged** for audit trails

## Testing

### Test Connection
```php
$service = new GoogleDriveService($businessId, $userId);
if ($service->hasValidCredentials()) {
    echo "Connection OK";
} else {
    echo "No credentials";
}
```

### Test File Sync
```php
$success = $service->syncBackupFile(
    'backup-2026-01-29.zip',
    storage_path('backups/backup-2026-01-29.zip')
);
```

### Test Folder Creation
```php
$folderId = $service->getOrCreateBackupFolder();
if ($folderId) {
    echo "Folder ID: " . $folderId;
}
```

## Troubleshooting

### Debug Mode

Enable detailed logging:

```php
// In config/google-drive.php
'logging' => [
    'enabled' => true,
    'log_channel' => 'single', // or 'stderr' for more detail
]
```

Check logs:
```bash
tail -f storage/logs/laravel.log | grep "Google Drive"
```

### Check Credentials

```php
$cred = GoogleDriveCredential::where('business_id', 1)->first();
if ($cred) {
    echo "Token expires: " . $cred->token_expires_at;
    echo "Folder: " . $cred->drive_folder_id;
}
```

### Manual Sync

```bash
php artisan backup:sync-to-google-drive --business-id=1 -v
```

## Performance Tuning

### For Large Backups

Increase chunk size:
```env
GOOGLE_DRIVE_CHUNK_SIZE=10485760  # 10MB
```

Increase timeout:
```env
GOOGLE_DRIVE_SYNC_TIMEOUT=600  # 10 minutes
```

### Use Queue for Async Sync

Create a job:
```php
// app/Jobs/SyncBackupToGoogleDrive.php
class SyncBackupToGoogleDrive implements ShouldQueue {
    public function handle(GoogleDriveService $service) {
        $service->syncBackupFile($this->fileName, $this->filePath);
    }
}
```

### Rate Limiting

System respects Google Drive API limits. Retries are automatic with backoff.

## Support

For issues:

1. Check `storage/logs/laravel.log`
2. Review Google Drive sync status in admin panel
3. Try test connection
4. Check Google Cloud Console for API errors
5. Verify credentials are not expired

## Future Features

- Backup compression before sync
- Email notifications
- Restore from Google Drive
- Multi-account support
- Team Drive support
- Bandwidth throttling
- Differential backups

---

**Last Updated**: January 29, 2026
