# Google Drive Integration - Visual Architecture Overview

## System Architecture Diagram

```
┌─────────────────────────────────────────────────────────────────────┐
│                        BITORÉPOS BACKUP SYSTEM                       │
└─────────────────────────────────────────────────────────────────────┘

                         ┌──────────────────────┐
                         │   ADMIN INTERFACE    │
                         │   (/admin/backup)    │
                         └──────────┬───────────┘
                                    │
                    ┌───────────────┼───────────────┐
                    │               │               │
        ┌───────────▼────────┐  ┌───▼──────────┐  ┌───▼──────────┐
        │ CREATE BACKUP      │  │ MANUAL SYNC  │  │ GOOGLE DRIVE │
        │ (Manual)           │  │              │  │ SETTINGS     │
        └────────┬───────────┘  └──┬───────────┘  └──┬───────────┘
                 │                  │                 │
                 └──────────────────┼─────────────────┘
                                    │
                    ┌───────────────▼──────────────┐
                    │  BACKUP CONTROLLER           │
                    │  (BackUpController.php)      │
                    └───────────────┬──────────────┘
                                    │
                    ┌───────────────▼──────────────┐
                    │ GOOGLE DRIVE SERVICE         │
                    │ (GoogleDriveService.php)     │
                    └───┬────────────┬────────────┬┘
                        │            │            │
          ┌─────────────▼┐  ┌──────▼──┐  ┌──────▼──────────┐
          │ OAUTH FLOW   │  │ FILE    │  │ DATABASE        │
          │              │  │ SYNC    │  │ OPERATIONS      │
          │ • Authorize  │  │         │  │                 │
          │ • Refresh    │  │ • Upload│  │ • Store Creds   │
          │ • Revoke     │  │ • Update│  │ • Track Syncs   │
          └──────────────┘  │ • Delete│  │ • Log Errors    │
                            └────┬────┘  └─────────────────┘
                                 │
                    ┌────────────▼────────────┐
                    │   GOOGLE DRIVE API      │
                    │                         │
                    │ • Google Drive v3       │
                    │ • OAuth 2.0             │
                    │ • File Upload           │
                    └─────────────────────────┘
```

## Data Flow Diagram

### Automatic Sync Flow

```
SCHEDULE (2:00 AM)
        │
        ▼
┌─────────────────────────────┐
│ backup:run                  │
│ (Creates backup file)       │
└────────┬────────────────────┘
         │
         ▼
┌─────────────────────────────┐
│ BackUpController::create()  │
│ (Creates backup file)       │
└────────┬────────────────────┘
         │
         ▼
┌─────────────────────────────┐
│ syncBackupToGoogleDrive()   │
│ (Initiates sync)            │
└────────┬────────────────────┘
         │
         ▼
┌─────────────────────────────┐
│ GoogleDriveService::        │
│ syncBackupFile()            │
│ (Uploads to Drive)          │
└────────┬────────────────────┘
         │
    ┌────┴────┐
    │          │
    ▼          ▼
SUCCESS    FAILURE
  │          │
  ▼          ▼
UPDATE    RETRY
RECORD  (Up to 3x)
  │
  ▼
SCHEDULE (2:15 AM)
        │
        ▼
┌─────────────────────────────┐
│ backup:sync-to-google-drive │
│ (Sync pending/failed)       │
└─────────────────────────────┘
```

### Manual Sync Flow

```
ADMIN CLICK
"SYNC"
    │
    ▼
┌──────────────────────────┐
│ /admin/backup/           │
│ sync-to-google-drive/{f} │
└───────┬──────────────────┘
        │
        ▼
┌──────────────────────────┐
│ Check Permissions        │
│ (backup permission)      │
└───────┬──────────────────┘
        │
        ▼
┌──────────────────────────┐
│ Validate File Exists     │
│ (Local storage)          │
└───────┬──────────────────┘
        │
        ▼
┌──────────────────────────┐
│ GoogleDriveService::     │
│ syncBackupFile()         │
└───────┬──────────────────┘
        │
    ┌───┴───┐
    │       │
    ▼       ▼
 SUCCESS  FAILED
    │       │
    ▼       ▼
RETURN   RETURN
SUCCESS  ERROR

     │
     ▼
REDIRECT
/admin/backup
(With status)
```

## Database Schema Diagram

```
┌──────────────────────────────────────────┐
│     google_drive_credentials             │
├──────────────────────────────────────────┤
│ id                      BIGINT PRIMARY    │
│ business_id             BIGINT FK         │
│ user_id                 BIGINT FK         │
│ access_token            LONGTEXT ENCRYPTED│
│ refresh_token           VARCHAR ENCRYPTED │
│ token_expires_at        DATETIME          │
│ drive_folder_id         VARCHAR           │
│ drive_folder_name       VARCHAR           │
│ is_active               BOOLEAN           │
│ created_at              TIMESTAMP         │
│ updated_at              TIMESTAMP         │
│ deleted_at              TIMESTAMP SOFT    │
└──────────────────────────────────────────┘
         │ (Foreign Keys)
         ├──→ business.id
         └──→ users.id


┌──────────────────────────────────────────┐
│   google_drive_backup_syncs              │
├──────────────────────────────────────────┤
│ id                      BIGINT PRIMARY    │
│ business_id             BIGINT FK         │
│ backup_file_name        VARCHAR UNIQUE    │
│ google_drive_file_id    VARCHAR           │
│ google_drive_file_name  VARCHAR           │
│ file_size_bytes         BIGINT            │
│ sync_status             ENUM              │
│ sync_error_message      TEXT              │
│ synced_at               DATETIME          │
│ last_synced_at          DATETIME          │
│ retry_count             INT               │
│ created_at              TIMESTAMP         │
│ updated_at              TIMESTAMP         │
│ deleted_at              TIMESTAMP SOFT    │
└──────────────────────────────────────────┘
         │ (Foreign Keys)
         └──→ business.id
```

## Component Interaction Diagram

```
┌─────────────────────────────────────────────────────────┐
│                   PRESENTATION LAYER                    │
├─────────────────────────────────────────────────────────┤
│ • BackUpController        (index, create, sync)         │
│ • GoogleDriveIntegrationController (OAuth, settings)   │
│ • Blade Views             (Admin UI)                    │
└────────────────┬──────────────────────────┬─────────────┘
                 │                          │
      ┌──────────▼──────────┐    ┌─────────▼──────────┐
      │ BUSINESS LOGIC LAYER│    │  COMMAND LAYER     │
      ├─────────────────────┤    ├────────────────────┤
      │ GoogleDriveService  │    │ SyncBackupsToGD    │
      │ • OAuth Flow        │    │ • Sync Command     │
      │ • File Operations   │    │ • Scheduling       │
      │ • Folder Mgmt       │    │ • Batch Processing │
      └─────────┬───────────┘    └────────────────────┘
                │
      ┌─────────▼──────────┐
      │   DATA LAYER       │
      ├─────────────────────┤
      │ GoogleDriveCredential│
      │ GoogleDriveBackupSync│
      │ • Queries            │
      │ • Relationships      │
      │ • Scopes             │
      └─────────┬───────────┘
                │
      ┌─────────▼──────────────┐
      │  DATABASE & STORAGE    │
      ├────────────────────────┤
      │ • MySQL Database       │
      │ • Encrypted Credentials│
      │ • Sync History         │
      │ • Local Backups        │
      └────────────────────────┘
```

## OAuth 2.0 Flow Diagram

```
┌─────────────────────────────────────────────────────────┐
│                   OAUTH 2.0 FLOW                        │
└─────────────────────────────────────────────────────────┘

Step 1: Authorization Request
┌───────┐                               ┌────────────┐
│ Admin │─────────────────────────────→ │  Google    │
│ Panel │  "Authorize" Button Click     │  Login     │
└───────┘                               └────────────┘
          /backup/google-drive/authorize

Step 2: Admin Signs In
                                        ┌────────────┐
                                        │ Google     │
                                        │ OAuth      │
                                        │ Consent    │
                                        │ Screen     │
                                        └────────────┘

Step 3: Authorization Code Returned
┌───────┐                               ┌────────────┐
│ Admin │  ← ← ← ← ← ← ← ← ← ← ← ← ← ← │  Google    │
│ Panel │  code=xxxxx                   │            │
└───────┘                               └────────────┘
          /backup/google-drive/callback

Step 4: Exchange Code for Token
┌──────────────────────┐  
│ GoogleDriveService   │─────────────────→ ┌────────────┐
│ • POST Token Request │  code=xxxxx       │  Google    │
│ • Client ID/Secret   │  client_id=xxx    │  OAuth     │
└──────────────────────┘  client_secret=xx │  Server    │
                                           └────────────┘

Step 5: Tokens Returned & Stored
┌────────────────────────────┐
│ access_token (encrypted)   │
│ refresh_token (encrypted)  │
│ expires_in                 │
│ token_type                 │
└───────────┬────────────────┘
            │
            ▼
    ┌───────────────────┐
    │ GoogleDrive       │
    │ Credential Model  │
    │ (Database)        │
    └───────────────────┘

Step 6: Drive Access
┌──────────────────────┐  
│ GoogleDriveService   │─────────────────→ ┌────────────┐
│ • Get/Create Folder  │  access_token     │  Google    │
│ • Upload Files       │  (in request)     │  Drive API │
│ • List Files         │                   │            │
└──────────────────────┘                   └────────────┘
```

## File Upload Process Diagram

```
LOCAL BACKUP FILE
        │
        ▼
┌─────────────────────────┐
│ Check Credentials       │
│ (hasValidCredentials)   │
└────────┬────────────────┘
         │
         ▼
┌─────────────────────────┐
│ Get/Create Folder       │
│ (getOrCreateFolder)     │
└────────┬────────────────┘
         │
         ▼
┌─────────────────────────┐
│ Check File Exists       │
│ (findFileInFolder)      │
└────────┬────────────────┘
         │
    ┌────┴─────┐
    │           │
 EXISTS     NOT EXISTS
    │           │
    ▼           ▼
UPDATE      CREATE
FILE        FILE
    │           │
    └─────┬─────┘
          │
          ▼
┌─────────────────────────┐
│ Upload in Chunks        │
│ (5MB default)           │
└────────┬────────────────┘
         │
         ▼
┌─────────────────────────┐
│ Get File ID from Drive  │
│ & Metadata              │
└────────┬────────────────┘
         │
         ▼
┌─────────────────────────┐
│ Update Sync Record      │
│ (Mark Completed)        │
└────────┬────────────────┘
         │
         ▼
    SUCCESS!
```

## Configuration Flow Diagram

```
environment
    │
    ├─── GOOGLE_DRIVE_CLIENT_ID
    ├─── GOOGLE_DRIVE_CLIENT_SECRET
    ├─── GOOGLE_DRIVE_REDIRECT_URI
    ├─── GOOGLE_DRIVE_BACKUP_SYNC_ENABLED
    ├─── GOOGLE_DRIVE_AUTO_SYNC_ON_BACKUP
    ├─── GOOGLE_DRIVE_MAX_RETRIES
    ├─── GOOGLE_DRIVE_SYNC_TIMEOUT
    ├─── GOOGLE_DRIVE_KEEP_BACKUP_VERSIONS
    └─── GOOGLE_DRIVE_ROOT_FOLDER_NAME
         │
         ▼
   config/google-drive.php
         │
    ┌────┴─────┬──────────┬─────────┐
    │           │          │         │
    ▼           ▼          ▼         ▼
SERVICE    BACKUP      FOLDER    LOGGING
LAYER      SYNC        CONFIG    CONFIG
    │           │          │         │
    └────┬──────┴──────────┴─────────┘
         │
         ▼
  RUNTIME ACCESS
```

## Error Handling & Retry Diagram

```
SYNC INITIATED
     │
     ▼
┌──────────────────┐
│ Try Sync         │
│ (syncBackupFile) │
└────┬─────────────┘
     │
  ┌──┴──┐
  │     │
  YES  NO
  │    │
  ▼    ▼
SUCCESS FAILED
  │      │
  ▼      ▼
UPDATE  CHECK
STATUS  RETRY
TO:     COUNT
COMPLETE│
        ▼
      < MAX?
        │
    ┌───┴────┐
    │        │
   YES       NO
    │        │
    ▼        ▼
RETRY    FAIL
COUNT    STATUS
++       FAILED
    │    │
    └─┬──┘
      │
      ▼
   UPDATE
   RECORD
   WITH
   ERROR
```

## Access Control Diagram

```
┌─────────────────────────────────┐
│       ADMIN REQUESTS            │
└──────────────┬──────────────────┘
               │
               ▼
        ┌──────────────────┐
        │ Middleware Check │
        │ (Auth Required)  │
        └────────┬─────────┘
                 │
              ┌──┴────┐
              │       │
          LOGGED   NOT LOGGED
            │       │
            ▼       ▼
         CHECK   REDIRECT
         PERM    TO LOGIN
             │
         ┌───┴────┐
         │        │
      CAN       CANNOT
      │          │
      ▼          ▼
   ALLOW     ABORT 403
   ACCESS
```

## Deployment Architecture

```
┌─────────────────────────────────────────────────────┐
│              PRODUCTION SERVER                      │
├─────────────────────────────────────────────────────┤
│                                                     │
│  ┌─────────────────────────────────────────────┐   │
│  │         LARAVEL APPLICATION                 │   │
│  │                                             │   │
│  │ ┌─────────────────────────────────────────┐ │   │
│  │ │      GoogleDriveService              │ │   │
│  │ │      GoogleDriveIntegrationController  │ │   │
│  │ │      SyncBackupsToGoogleDrive Command  │ │   │
│  │ └─────────────────────────────────────────┘ │   │
│  │                                             │   │
│  │ ┌─────────────────────────────────────────┐ │   │
│  │ │         DATABASE                       │ │   │
│  │ │  • google_drive_credentials            │ │   │
│  │ │  • google_drive_backup_syncs           │ │   │
│  │ └─────────────────────────────────────────┘ │   │
│  │                                             │   │
│  │ ┌─────────────────────────────────────────┐ │   │
│  │ │      STORAGE                            │ │   │
│  │ │  • Backup Files (local)                 │ │   │
│  │ │  • Log Files                            │ │   │
│  │ └─────────────────────────────────────────┘ │   │
│  │                                             │   │
│  └─────────────────────────────────────────────┘   │
│                     │                              │
│  ┌──────────────────┴──────────────────┐          │
│  │                                     │          │
│  ▼                                     ▼          │
│ CRON SCHEDULER              ADMIN WEB REQUESTS   │
│ • Backup at 2:00 AM        • Authorize          │
│ • Sync at 2:15 AM          • Manual Sync        │
│                            • View Status        │
└──────────────────────────────────────────────────┘
         │
         ├──→ INTERNET CONNECTION
         │
         ▼
    ┌─────────────────────────────┐
    │   GOOGLE CLOUD SERVICES     │
    │  • Google Drive API         │
    │  • OAuth 2.0 Server         │
    │  • File Storage             │
    └─────────────────────────────┘
```

---

**Last Updated**: January 29, 2026
**Architecture Version**: 1.0
