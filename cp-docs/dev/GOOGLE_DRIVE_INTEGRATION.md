# Google Drive API Integration for Backup Storage

## Overview

This integration enables automatic syncing of {application_name} backup files to Google Drive, providing a secure cloud-based backup solution. The system supports:

- **Automatic backup syncing** after scheduled cron jobs or manual backup creation
- **Multi-business support** with separate Google Drive folders per business
- **Credential encryption** for secure token storage
- **Retry mechanism** for failed syncs with configurable max retries
- **Sync tracking** with detailed metadata and status monitoring
- **Admin authentication** with OAuth 2.0 for secure access
- **Rate limiting** compliance with Google Drive API limits

## Features

### 1. Automatic Sync
- Backups are automatically synced to Google Drive 15 minutes after the scheduled backup time
- Can be disabled via configuration if preferred
- Supports retry for failed syncs

### 2. Manual Sync
- Administrators can manually trigger sync for any backup file
- Real-time feedback on sync status
- Ability to retry failed syncs

### 3. Sync Status Tracking
- Database tracking of all sync attempts
- Detailed error logging for troubleshooting
- Comprehensive sync statistics dashboard

### 4. Security
- Encrypted storage of Google Drive access tokens
- User-specific credentials per business
- Automatic token refresh before expiration
- Support for revoking access

## Installation & Setup

### Step 1: Install Dependencies

```bash
composer require google/apiclient:^2.15
```

### Step 2: Create Database Migrations

Run the migrations to create the required tables:

```bash
php artisan migrate
```

This creates:
- `google_drive_credentials` - Stores encrypted OAuth tokens per user/business
- `google_drive_backup_syncs` - Tracks backup sync status and metadata

### Step 3: Google Cloud Project Setup

1. Visit [Google Cloud Console](https://console.cloud.google.com/)
2. Create a new project (or use existing)
3. Enable the "Google Drive API"
4. Create OAuth 2.0 credentials:
   - Application type: Web application
   - Authorized redirect URIs: `https://your-domain.com/admin/backup/google-drive/callback`
5. Copy the Client ID and Client Secret

### Step 4: Configure Environment Variables

Add to your `.env` file:

```env
GOOGLE_DRIVE_CLIENT_ID=your-client-id.apps.googleusercontent.com
GOOGLE_DRIVE_CLIENT_SECRET=your-client-secret
GOOGLE_DRIVE_REDIRECT_URI=/admin/backup/google-drive/callback

# Backup Sync Settings
GOOGLE_DRIVE_BACKUP_SYNC_ENABLED=true
GOOGLE_DRIVE_AUTO_SYNC_ON_BACKUP=true
GOOGLE_DRIVE_MAX_RETRIES=3
GOOGLE_DRIVE_SYNC_TIMEOUT=300
GOOGLE_DRIVE_KEEP_BACKUP_VERSIONS=10

# Folder Settings
GOOGLE_DRIVE_ROOT_FOLDER_NAME="BitorePOS Backups"

# Logging
GOOGLE_DRIVE_LOGGING_ENABLED=true
GOOGLE_DRIVE_NOTIFY_ON_FAILURE=true
```

### Step 5: Admin Authentication

1. Navigate to Backup Settings: `/admin/backup`
2. Click "Connect Google Drive"
3. Authorize the application to access your Google Drive
4. The system will create a "{application_name} Backups" folder automatically

## Usage

### Admin Dashboard

The backup page now includes:
- **Google Drive Connection Status** - Shows if connected
- **Sync Status Indicator** - Per backup file sync status
- **Manual Sync Button** - Manually trigger sync for any backup
- **Google Drive Settings** - Configure and manage Google Drive integration

### API Endpoints

#### Get Integration Status
```
GET /admin/backup/google-drive
```

#### Authorize with Google
```
GET /admin/backup/google-drive/authorize
```

#### OAuth Callback
```
GET /admin/backup/google-drive/callback?code=xxx
```

#### Disconnect Google Drive
```
POST /admin/backup/google-drive/disconnect
```

#### Get Sync Statistics
```
GET /admin/backup/google-drive/sync-status
```

#### Get Recent Syncs
```
GET /admin/backup/google-drive/recent-syncs
```

#### Retry Failed Sync
```
POST /admin/backup/google-drive/retry-sync
{
    "sync_id": 123
}
```

#### Test Connection
```
POST /admin/backup/google-drive/test-connection
```

#### Delete Sync Record
```
DELETE /admin/backup/google-drive/delete-sync/{syncId}
```

### Console Commands

#### Sync All Pending Backups
```bash
php artisan backup:sync-to-google-drive
```

#### Sync for Specific Business
```bash
php artisan backup:sync-to-google-drive --business-id=1
```

#### Force Resync All Backups
```bash
php artisan backup:sync-to-google-drive --force
```

## Scheduled Tasks

The system includes two scheduled tasks:

1. **Daily Backup** - Runs at configured time (e.g., 2:00 AM)
```
backup:run
```

2. **Google Drive Sync** - Runs 15 minutes after backup (e.g., 2:15 AM)
```
backup:sync-to-google-drive
```

To verify cron is running:
```bash
php artisan schedule:list
```

## Architecture

### Models

#### GoogleDriveCredential
Stores encrypted OAuth tokens per user/business:
```php
- business_id (FK)
- user_id (FK)
- access_token (encrypted)
- refresh_token (encrypted)
- token_expires_at
- drive_folder_id
- drive_folder_name
- is_active
```

#### GoogleDriveBackupSync
Tracks backup sync attempts and status:
```php
- business_id (FK)
- backup_file_name
- google_drive_file_id
- file_size_bytes
- sync_status (pending|syncing|completed|failed)
- sync_error_message
- synced_at
- retry_count
```

### Service: GoogleDriveService

The main service class handling all Google Drive operations:

```php
class GoogleDriveService {
    // Authentication
    public function getAuthorizationUrl()
    public function exchangeCodeForToken($code)
    public function hasValidCredentials()
    public function revokeAccess()
    
    // Folder Management
    public function getOrCreateBackupFolder()
    
    // File Operations
    public function syncBackupFile($backupFileName, $localFilePath)
    public function deleteFileFromDrive($fileId)
    public function listBackupFilesInDrive()
    
    // Maintenance
    public function cleanupOldBackups()
    public function getSyncRecords($limit = 50)
    public function getPendingSyncs()
    public function retryFailedSync($backupFileName, $localFilePath)
}
```

### Database Schema

#### google_drive_credentials
```sql
CREATE TABLE google_drive_credentials (
    id BIGINT PRIMARY KEY,
    business_id BIGINT UNSIGNED,
    user_id BIGINT UNSIGNED NOT NULL,
    access_token LONGTEXT NOT NULL,
    refresh_token VARCHAR(255),
    token_expires_at DATETIME,
    drive_folder_id VARCHAR(255),
    drive_folder_name VARCHAR(255) DEFAULT 'BitorePOS Backups',
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    deleted_at TIMESTAMP,
    FOREIGN KEY (business_id) REFERENCES business(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);
```

#### google_drive_backup_syncs
```sql
CREATE TABLE google_drive_backup_syncs (
    id BIGINT PRIMARY KEY,
    business_id BIGINT UNSIGNED,
    backup_file_name VARCHAR(255) NOT NULL,
    google_drive_file_id VARCHAR(255),
    google_drive_file_name VARCHAR(255),
    file_size_bytes BIGINT,
    sync_status ENUM('pending','syncing','completed','failed'),
    sync_error_message TEXT,
    synced_at DATETIME,
    last_synced_at DATETIME,
    retry_count INT DEFAULT 0,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    deleted_at TIMESTAMP,
    UNIQUE (business_id, backup_file_name)
);
```

## Configuration

The `config/google-drive.php` file contains all configuration options:

```php
return [
    'client_id' => env('GOOGLE_DRIVE_CLIENT_ID'),
    'client_secret' => env('GOOGLE_DRIVE_CLIENT_SECRET'),
    'redirect_uri' => env('GOOGLE_DRIVE_REDIRECT_URI'),
    
    'scopes' => [
        'https://www.googleapis.com/auth/drive.file',
        'https://www.googleapis.com/auth/drive.metadata',
    ],
    
    'backup_sync' => [
        'enabled' => env('GOOGLE_DRIVE_BACKUP_SYNC_ENABLED', false),
        'auto_sync_on_backup' => env('GOOGLE_DRIVE_AUTO_SYNC_ON_BACKUP', true),
        'max_retries' => env('GOOGLE_DRIVE_MAX_RETRIES', 3),
        'timeout_seconds' => env('GOOGLE_DRIVE_SYNC_TIMEOUT', 300),
        'chunk_size_bytes' => env('GOOGLE_DRIVE_CHUNK_SIZE', 5242880),
        'keep_backup_versions' => env('GOOGLE_DRIVE_KEEP_BACKUP_VERSIONS', 10),
    ],
    
    'folder_structure' => [
        'root_folder_name' => env('GOOGLE_DRIVE_ROOT_FOLDER_NAME', 'BitorePOS Backups'),
        'create_business_folders' => true,
        'date_format' => 'Y/m',
    ],
];
```

## Error Handling & Logging

All operations are logged to the application's default log channel:

```
storage/logs/laravel.log
```

Example log entries:
```
[2026-01-29 10:30:15] production.INFO: Backup 'backup-2026-01-29.zip' synced successfully to Google Drive
[2026-01-29 10:30:20] production.ERROR: Error syncing backup file: Google Drive API error
```

Monitor logs for:
- Authentication failures
- Sync failures and retries
- API rate limiting
- Token expiration issues

## Troubleshooting

### Issue: "No valid Google Drive credentials"
**Solution:** Ensure the admin user has completed the Google Drive authorization flow

### Issue: "Failed to create/get backup folder"
**Solution:** Check Google Drive API is enabled and credentials have proper scopes

### Issue: "Token expired"
**Solution:** Token will auto-refresh; if issues persist, disconnect and re-authorize

### Issue: Syncs stuck in "pending" status
**Solution:** Check error message in sync record; manually retry after fixing issue

### Issue: Rate limiting errors
**Solution:** System respects rate limits; errors are retried; check logs for details

## Performance Considerations

1. **Large Files**: Files are uploaded with 5MB chunks (configurable)
2. **Async Processing**: Consider using Laravel queues for large backups
3. **Cleanup**: Old backups are not deleted by default (configurable)
4. **Retry Logic**: Failed syncs retry up to 3 times with exponential backoff

## Security Best Practices

1. **Never commit credentials** to version control
2. **Use environment variables** for sensitive configuration
3. **Rotate credentials regularly** in Google Cloud Console
4. **Monitor sync logs** for unauthorized access attempts
5. **Limit admin users** who can authorize Google Drive
6. **Enable Google Drive folder encryption** for additional security
7. **Regularly review shared folder permissions**

## Future Enhancements

Potential improvements for future versions:

1. **Differential Backups** - Only sync changes
2. **Compression** - Compress backups before syncing
3. **Email Notifications** - Notify admins on sync completion/failure
4. **Backup Scheduling UI** - Configure backup times through admin panel
5. **Google Workspace Integration** - Team Drive support
6. **Multi-Drive Support** - Store backups across multiple accounts
7. **Bandwidth Throttling** - Limit sync speeds
8. **Restore from Google Drive** - Direct restore functionality

## Support & Issues

For issues or questions:

1. Check the troubleshooting section above
2. Review application logs in `storage/logs/`
3. Check Google Cloud Console for API errors
4. Verify network connectivity to Google Drive API

## License

This integration is part of {application_name} and follows the same license.
