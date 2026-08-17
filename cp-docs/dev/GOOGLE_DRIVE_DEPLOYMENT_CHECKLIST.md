# Google Drive Integration - Deployment Checklist

## Pre-Deployment

### Development Environment
- [ ] Install `google/apiclient:^2.15` via composer
- [ ] Run database migrations
- [ ] Configure environment variables with test credentials
- [ ] Test OAuth flow in development
- [ ] Verify backup creation and sync
- [ ] Test retry mechanism with intentional failures
- [ ] Check error logging

### Code Review
- [ ] Review GoogleDriveService.php for security
- [ ] Verify token encryption/decryption
- [ ] Check permission validations in controllers
- [ ] Review error handling and logging
- [ ] Validate database relationships
- [ ] Ensure no hardcoded credentials

### Testing
- [ ] Unit tests for GoogleDriveService
- [ ] Integration tests for OAuth flow
- [ ] Test backup creation → auto sync flow
- [ ] Test manual sync functionality
- [ ] Test retry mechanism
- [ ] Test token refresh
- [ ] Test cleanup of old backups
- [ ] Test with different file sizes
- [ ] Test with multiple businesses
- [ ] Test permission checks

## Google Cloud Setup

### Google Cloud Project
- [ ] Create/select Google Cloud project
- [ ] Enable Google Drive API
- [ ] Create OAuth 2.0 Web Application credentials
- [ ] Set authorized redirect URIs:
  - [ ] Development: `http://localhost/admin/backup/google-drive/callback`
  - [ ] Production: `https://yourdomain.com/admin/backup/google-drive/callback`
- [ ] Download credentials JSON
- [ ] Verify API quotas are sufficient
- [ ] Set up billing (if not on free tier)

### Security in Google Cloud
- [ ] Use service account (if not user credentials)
- [ ] Set up API key restrictions
- [ ] Enable audit logging
- [ ] Set up alerts for quota usage
- [ ] Review IAM permissions

## Production Deployment

### Database
- [ ] Backup existing database
- [ ] Test migrations on staging
- [ ] Run migrations on production
- [ ] Verify tables created successfully
- [ ] Check table structure and indexes

### Environment Configuration
- [ ] Add credentials to production .env:
  ```
  GOOGLE_DRIVE_CLIENT_ID=xxxxx
  GOOGLE_DRIVE_CLIENT_SECRET=xxxxx
  GOOGLE_DRIVE_BACKUP_SYNC_ENABLED=true
  GOOGLE_DRIVE_AUTO_SYNC_ON_BACKUP=true
  GOOGLE_DRIVE_MAX_RETRIES=3
  ```
- [ ] Verify encryption key is set
- [ ] Update redirect URI to production domain
- [ ] Test environment variables are loaded

### Application
- [ ] Clear Laravel cache: `php artisan cache:clear`
- [ ] Clear config cache: `php artisan config:cache`
- [ ] Verify file permissions on `storage/logs`
- [ ] Test application boots correctly
- [ ] Verify all routes load
- [ ] Check admin panel loads

### Backup Configuration
- [ ] Verify backup schedule is correct
- [ ] Configure backup time in app config
- [ ] Calculate sync time (backup + 15 minutes)
- [ ] Verify cron job is set up:
  ```
  * * * * * cd /path/to/app && php artisan schedule:run >> /dev/null 2>&1
  ```

### Admin Setup
- [ ] Test admin can access `/admin/backup`
- [ ] Test "Connect Google Drive" flow
- [ ] Complete OAuth authorization
- [ ] Verify folder created in Google Drive
- [ ] Test manual backup creation
- [ ] Verify backup syncs automatically
- [ ] Check sync status in admin panel
- [ ] Test manual sync of existing backup
- [ ] Test retry of failed sync

## Post-Deployment

### Verification
- [ ] Verify backups are being created on schedule
- [ ] Check backups are syncing to Google Drive
- [ ] Monitor sync logs for errors
- [ ] Verify no API rate limiting issues
- [ ] Test token refresh after expiration
- [ ] Check admin panel for sync status

### Monitoring Setup
- [ ] Configure log rotation
- [ ] Set up alerts for failed syncs
- [ ] Monitor API usage in Google Cloud
- [ ] Set up monitoring for disk space
- [ ] Track backup size trends

### Documentation
- [ ] Update admin documentation
- [ ] Add Google Drive to backup procedures
- [ ] Document emergency restore process
- [ ] Add to disaster recovery plan
- [ ] Document credential rotation process

### Training
- [ ] Train admins on Google Drive integration
- [ ] Document how to test connection
- [ ] Document how to retry failed sync
- [ ] Document how to disconnect
- [ ] Document error resolution steps

## Production Monitoring

### Daily Checks
- [ ] Backup completed successfully
- [ ] Backup synced to Google Drive
- [ ] No errors in application logs
- [ ] Sync count increased

### Weekly Checks
- [ ] Review sync statistics
- [ ] Check for failed syncs
- [ ] Verify folder organization in Drive
- [ ] Review disk space usage
- [ ] Check API quota usage

### Monthly Checks
- [ ] Review backup retention policy
- [ ] Verify credentials are still active
- [ ] Test restore process
- [ ] Update documentation if needed
- [ ] Review Google Cloud console for updates

## Maintenance Tasks

### Regular Maintenance
- [ ] Monitor storage usage
- [ ] Clean up old sync records (if needed)
- [ ] Review and rotate credentials annually
- [ ] Test restore from Google Drive backup
- [ ] Verify folder permissions in Drive

### Troubleshooting Procedures
- [ ] If sync fails:
  - [ ] Check error message in sync record
  - [ ] Verify admin credentials still active
  - [ ] Check Google API status
  - [ ] Retry failed sync manually
  - [ ] Review logs for details

- [ ] If authentication fails:
  - [ ] Verify credentials in .env
  - [ ] Test connection from admin panel
  - [ ] Re-authorize if needed
  - [ ] Check Google account permissions

- [ ] If rate limiting occurs:
  - [ ] Review API usage in Google Cloud
  - [ ] Adjust chunk size if needed
  - [ ] Space out retries if needed

## Rollback Plan

### If Issues Occur
- [ ] Identify the problem
- [ ] Document the issue
- [ ] Disable sync if critical:
  ```
  GOOGLE_DRIVE_BACKUP_SYNC_ENABLED=false
  ```
- [ ] Fix the issue
- [ ] Re-enable sync
- [ ] Retry failed syncs

### If Complete Removal Needed
- [ ] Disable sync feature
- [ ] Backup current database
- [ ] Rollback migrations
- [ ] Remove Google Drive code
- [ ] Restore previous version
- [ ] Re-test backup system

## Communication

### Stakeholders to Notify
- [ ] End users about new backup feature
- [ ] Support team about Google Drive integration
- [ ] Security team about new integrations
- [ ] IT about new Google Cloud project
- [ ] Management about backup improvements

### Documentation to Provide
- [ ] Admin guide for Google Drive integration
- [ ] Technical documentation
- [ ] Troubleshooting guide
- [ ] FAQ for common issues

## Sign-Off

### Pre-Production
- [ ] Dev Lead: _____________________ Date: _______
- [ ] QA Lead: _____________________ Date: _______
- [ ] Security Review: _____________ Date: _______

### Post-Production
- [ ] Deployment Completed: ________ Date: _______
- [ ] Testing Verified: ____________ Date: _______
- [ ] Admin Trained: ______________ Date: _______
- [ ] Go-Live Approval: __________ Date: _______

## Additional Notes

```
[Space for additional notes, observations, or special considerations]

```

---

## Quick Reference

### Important URLs
- Admin Backup Page: `/admin/backup`
- Google Drive Settings: `/admin/backup/google-drive`
- API Docs: `/docs/google-drive` (if available)

### Important Commands
```bash
# Test
php artisan tinker
>>> new App\Services\GoogleDriveService(1, 1)->hasValidCredentials()

# Run migrations
php artisan migrate

# Sync backups
php artisan backup:sync-to-google-drive

# Clear cache
php artisan cache:clear

# Check logs
tail -f storage/logs/laravel.log
```

### Environment Variables
```
GOOGLE_DRIVE_CLIENT_ID
GOOGLE_DRIVE_CLIENT_SECRET
GOOGLE_DRIVE_REDIRECT_URI
GOOGLE_DRIVE_BACKUP_SYNC_ENABLED
GOOGLE_DRIVE_AUTO_SYNC_ON_BACKUP
GOOGLE_DRIVE_MAX_RETRIES
GOOGLE_DRIVE_KEEP_BACKUP_VERSIONS
```

### Database Tables
- `google_drive_credentials` - User credentials
- `google_drive_backup_syncs` - Sync history

### Key Files
- `config/google-drive.php` - Configuration
- `app/Services/GoogleDriveService.php` - Main service
- `app/Http/Controllers/GoogleDriveIntegrationController.php` - Admin endpoints
- `app/Console/Commands/SyncBackupsToGoogleDrive.php` - Cron command

---

**Checklist Version**: 1.0
**Last Updated**: January 29, 2026
