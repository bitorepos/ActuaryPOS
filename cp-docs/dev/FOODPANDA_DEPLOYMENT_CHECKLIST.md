# Foodpanda Integration - Deployment Checklist

**Date Started:** January 31, 2026  
**Environment:** Development → Staging → Production  
**Completed By:** ____________  
**Date Completed:** ____________

---

## Phase 1: Pre-Deployment Setup

### Code & Files
- [ ] All module files copied to `modules/Foodpanda/`
  - [ ] Services/FoodpandaApiClient.php
  - [ ] Services/OrderSyncService.php
  - [ ] Services/StatusUpdateService.php
  - [ ] Models/FoodpandaOrder.php
  - [ ] Models/FoodpandaLog.php
  - [ ] Http/Controllers/WebhookController.php
  - [ ] Http/Controllers/FoodpandaController.php
  - [ ] Http/Requests/OrderDispatchRequest.php
  - [ ] Http/Requests/OrderStatusUpdateRequest.php
  - [ ] routes.php

### Views & Language Files
- [ ] Views copied to `resources/views/business/partials/`
  - [ ] settings_foodpanda.blade.php
- [ ] Language keys added to `resources/lang/en/lang_v1.php`
  - [ ] All Foodpanda translation keys present
- [ ] Test language keys display correctly in UI

### Database
- [ ] All migrations created
  - [ ] 2026_01_31_110000_create_foodpanda_orders_table.php
  - [ ] 2026_01_31_110100_create_foodpanda_logs_table.php
  - [ ] 2026_01_31_110200_add_foodpanda_settings_to_business_table.php
- [ ] Migrations run successfully: `php artisan migrate`
- [ ] Tables created with proper columns and indexes:
  - [ ] foodpanda_orders table exists
  - [ ] foodpanda_logs table exists
  - [ ] business table has new columns
- [ ] Models updated with relationships and casts

### Routes
- [ ] Routes registered in `routes/web.php` or routing configuration
- [ ] Test webhook endpoints accessible:
  - [ ] POST /foodpanda/webhook/order-dispatch
  - [ ] POST /foodpanda/webhook/order-status-update
  - [ ] POST /foodpanda/webhook/catalog-import-status
  - [ ] POST /foodpanda/webhook/menu-import-request
- [ ] Test management endpoints accessible (authenticated):
  - [ ] GET /foodpanda/orders
  - [ ] GET /foodpanda/api/summary

### Dependencies
- [ ] Guzzle HTTP client available (usually included with Laravel)
- [ ] Required PHP extensions enabled:
  - [ ] curl
  - [ ] json
  - [ ] openssl (for HTTPS)

### Documentation
- [ ] FOODPANDA_IMPLEMENTATION.md exists and complete
- [ ] FOODPANDA_QUICK_REFERENCE.md exists and complete
- [ ] FOODPANDA_DEPLOYMENT_CHECKLIST.md exists (this file)

---

## Phase 2: Environment Configuration

### Development Environment Setup

#### Database
- [ ] Migrations executed in dev database
- [ ] Tables verified with:
  ```bash
  php artisan tinker
  >>> \Modules\Foodpanda\Models\FoodpandaOrder::all()
  >>> \Modules\Foodpanda\Models\FoodpandaLog::all()
  ```

#### Business Settings UI
- [ ] Settings tab visible in Business Configuration
- [ ] All form fields render correctly:
  - [ ] Enable checkbox
  - [ ] Environment dropdown
  - [ ] API username field
  - [ ] API password field
  - [ ] Plugin base URL field
  - [ ] Integration code field
  - [ ] Chain code field
  - [ ] Default currency dropdown
  - [ ] Vendor mappings section
  - [ ] Auto-accept checkbox
  - [ ] Sync interval input
  - [ ] Test connection button
- [ ] Form saves without errors
- [ ] Saved values persist after page reload

#### Testing Credentials
- [ ] Obtain staging API credentials from Foodpanda
- [ ] Add to Business Settings:
  - [ ] API Username: ______________
  - [ ] API Password: ______________
- [ ] Environment set to "staging"
- [ ] Plugin Base URL set to local HTTPS endpoint

### Local Webhook Testing

#### HTTPS Setup
- [ ] HTTPS enabled on local development machine
  - Option 1: ngrok for tunneling
    ```bash
    ngrok http 443  # Get public HTTPS URL
    ```
  - Option 2: Local SSL certificate
  - Option 3: Local network testing

- [ ] Plugin Base URL configured: ______________

#### Test Webhook Receipt
- [ ] Send test order via curl/Postman:
  ```bash
  curl -X POST https://your-local-url/foodpanda/webhook/order-dispatch \
    -H "Content-Type: application/json" \
    -d '{
      "order_token": "test_123",
      "vendor_code": "vendor_001",
      "customer_name": "John Doe",
      "customer_phone": "+1234567890",
      "order_total": 50.00,
      "currency": "USD",
      "items": [{
        "name": "Burger",
        "quantity": 1,
        "unit_price": 50.00
      }]
    }'
  ```

- [ ] Response status: 200 or 422 (validation) expected
- [ ] FoodpandaOrder created in database
- [ ] Error logged if validation fails

---

## Phase 3: Staging Environment Deployment

### Code Deployment
- [ ] Code pushed to staging branch
- [ ] All files deployed to staging server
- [ ] File permissions set correctly (755 for dirs, 644 for files)
- [ ] Composer dependencies installed: `composer install --no-dev`

### Database Migration
- [ ] SSH to staging server
- [ ] Run migrations:
  ```bash
  php artisan migrate --env=staging
  ```
- [ ] Verify migration success
- [ ] Backup production database before any changes

### Configuration
- [ ] Environment file updated (.env):
  - [ ] APP_ENV=staging
  - [ ] APP_DEBUG=false (in production)
  - [ ] APP_URL=https://staging.yourpos.com

- [ ] Configure staging API credentials:
  - [ ] Obtain staging credentials from Foodpanda
  - [ ] Add to Business Settings (staging environment selected)

### SSL Certificate
- [ ] Valid SSL certificate installed:
  ```bash
  # Check expiry
  openssl x509 -in /path/to/cert -noout -dates
  ```
- [ ] Certificate not self-signed
- [ ] Certificate matches domain name

### Network Configuration
- [ ] Firewall allows Foodpanda IP addresses:
  ```
  Staging: 34.246.34.27, 18.202.142.208, 54.72.10.41
  ```
- [ ] Webhook URL accessible from internet:
  ```bash
  curl -I https://staging.yourpos.com/foodpanda/webhook/order-dispatch
  # Should return 405 (method not allowed) since we're GET-ing a POST endpoint
  ```

### Testing on Staging

#### Connection Test
- [ ] Navigate to Business Settings → Foodpanda Integration
- [ ] Click "Test Connection"
- [ ] Verify success message
- [ ] Check logs: `/foodpanda/logs`

#### Order Receiving Test
- [ ] Request test vendor from Foodpanda support
- [ ] Configure vendor code and remote ID in mappings
- [ ] Place test order on Foodpanda platform
- [ ] Verify order received in dashboard: `/foodpanda/orders`
- [ ] Check order status is "pending"

#### Order Acceptance Test
- [ ] Click "Accept" on test order
- [ ] Verify API call logged in `/foodpanda/logs`
- [ ] Check Foodpanda platform shows order as "accepted"
- [ ] Verify transaction created in POS if auto-accept enabled

#### Order Rejection Test
- [ ] Create another test order
- [ ] Click "Reject" and select reason
- [ ] Verify API call logged
- [ ] Verify Foodpanda shows order as "rejected"

#### Status Update Test
- [ ] Accept order
- [ ] Click "Mark as Prepared"
- [ ] Verify status sent to Foodpanda
- [ ] Check Foodpanda shows as "prepared"

#### Log Verification
- [ ] Check `/foodpanda/logs` dashboard
- [ ] Verify all API calls logged
- [ ] Check request/response payloads
- [ ] Verify no "failed" status in recent calls

### Error Handling Test
- [ ] Disable API credentials
- [ ] Try to accept order
- [ ] Verify error message displayed
- [ ] Verify error logged
- [ ] Re-enable credentials

### Performance Check
- [ ] Response times in logs < 5 seconds typical
- [ ] No timeout errors
- [ ] Check server resources:
  ```bash
  top  # CPU/Memory usage
  df -h  # Disk space
  ```

---

## Phase 4: Production Deployment

### Pre-Production Review
- [ ] All staging tests passed
- [ ] Foodpanda support confirms ready for production
- [ ] Production API credentials obtained from Foodpanda
- [ ] Backup plan documented and tested

### Code Deployment
- [ ] Code merged to main/master branch
- [ ] Tag created: `v1.0-foodpanda`
- [ ] Deployed to production
- [ ] File permissions verified

### Database
- [ ] Backup production database:
  ```bash
  mysqldump -u user -p database > backup_$(date +%Y%m%d).sql
  ```
- [ ] Run migrations on production:
  ```bash
  php artisan migrate --env=production --force
  ```
- [ ] Verify tables created
- [ ] Verify no data loss

### Production Configuration
- [ ] Environment file:
  - [ ] APP_ENV=production
  - [ ] APP_DEBUG=false
  - [ ] APP_URL=https://yourpos.com
- [ ] Add production API credentials to Business Settings
- [ ] Set environment to "production"
- [ ] Set plugin base URL to production URL
- [ ] Configure all vendor codes and remote IDs

### Network & Security
- [ ] SSL certificate valid and not self-signed
- [ ] Firewall configured:
  - [ ] Allow Foodpanda IP addresses:
    - [ ] Europe: 63.32.162.210, 34.255.237.245, 63.32.145.112
    - [ ] Latin America: 54.161.200.26, 54.174.130.155, 18.204.190.239
    - [ ] Middle East: 63.32.225.161, 18.202.96.85, 52.208.41.152
    - [ ] Asia Pacific: 3.0.217.166, 3.1.134.42, 3.1.56.76
  - [ ] Webhook endpoint accessible
- [ ] DDoS protection (if applicable) whitelist Foodpanda IPs

### Monitoring Setup
- [ ] Error log monitoring:
  ```bash
  tail -f storage/logs/laravel.log | grep -i foodpanda
  ```
- [ ] Set up alerts for failed orders:
  - [ ] Email alert on 5+ failed orders
  - [ ] Alert if no orders received in 1 hour
- [ ] Dashboard monitoring:
  - [ ] Check `/foodpanda/logs` regularly
  - [ ] Review `/foodpanda/orders` status

### Go-Live Steps
- [ ] Schedule go-live time (preferably low-traffic)
- [ ] Notify Foodpanda support of go-live date
- [ ] Have staff ready to monitor
- [ ] Request Foodpanda send test order
- [ ] Verify test order received
- [ ] Foodpanda enables live orders

### Post-Deployment (First 24 Hours)
- [ ] Monitor all incoming orders
- [ ] Verify transactions created correctly
- [ ] Check order status updates work
- [ ] Review logs every hour
- [ ] No errors in application log
- [ ] Staff trained on order management
- [ ] Have rollback plan ready if issues occur

---

## Phase 5: Post-Deployment Verification

### Week 1 Monitoring
- [ ] All orders received successfully
- [ ] No duplicate orders
- [ ] Order acceptance working
- [ ] Order rejection working
- [ ] Status updates to Foodpanda working
- [ ] No API errors in logs
- [ ] Database queries performing well
- [ ] Staff confident with order dashboard

### Week 2-4 Optimization
- [ ] Review logs for patterns
- [ ] Check sync interval is appropriate
- [ ] Optimize auto-accept vs manual as needed
- [ ] Train additional staff
- [ ] Document any issues found

### Ongoing Maintenance
- [ ] Monitor `/foodpanda/logs` weekly
- [ ] Archive old logs monthly
- [ ] Review failed orders
- [ ] Update vendor mappings as needed
- [ ] Keep API credentials updated
- [ ] Monitor token expiration
- [ ] Review Foodpanda documentation for updates

---

## Rollback Procedure

If critical issues occur:

### Immediate Action
- [ ] Contact Foodpanda support
- [ ] Set `enable_foodpanda_integration` to false
- [ ] Pending orders won't be received
- [ ] Staff can continue with manual order entry

### Investigation
- [ ] Check `/foodpanda/logs` for errors
- [ ] Review `storage/logs/laravel.log`
- [ ] Verify API credentials
- [ ] Check network connectivity
- [ ] Review recent code changes

### Restore Previous State
- [ ] Disable integration
- [ ] Restore from backup if data corrupted
- [ ] Roll back code to previous version if needed

### Re-enable Integration
- [ ] Only after root cause identified and fixed
- [ ] Test thoroughly on staging first
- [ ] Get Foodpanda approval before going live again

---

## Sign-Off

### Staging Approval
- **Tested By:** ________________
- **Date:** ________________
- **Approved By:** ________________
- **Notes:** ________________________________________________

### Production Approval
- **Deployed By:** ________________
- **Date:** ________________
- **Approved By:** ________________
- **Go-Live Time:** ________________
- **Notes:** ________________________________________________

---

## Contacts

| Role | Name | Email | Phone |
|------|------|-------|-------|
| Foodpanda Integration Contact | | | |
| IT Manager | | | |
| POS Support Lead | | | |
| Database Admin | | | |
| Backup Contact | | | |

---

## Resources

- [Foodpanda API Documentation](https://integration.foodpanda.com/en/documentation/)
- [Implementation Guide](FOODPANDA_IMPLEMENTATION.md)
- [Quick Reference](FOODPANDA_QUICK_REFERENCE.md)
- [API Logs Dashboard](/foodpanda/logs)
- [Orders Dashboard](/foodpanda/orders)

---

**Next Review Date:** ________________
