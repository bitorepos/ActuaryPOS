# Manufacturing Module v4.0 — Deployment Checklist

Use this checklist when deploying the Manufacturing v4.0 enhancements to a production environment.

---

## Pre-Deployment

- [ ] Backup the database (full dump)
- [ ] Backup the `modules/Manufacturing/` directory
- [ ] Note the current module version (should be 3.1)
- [ ] Verify PHP version ≥ 7.4
- [ ] Verify Laravel framework compatibility
- [ ] Confirm the `modules_statuses.json` has Manufacturing enabled

## File Deployment

- [ ] Deploy all new files:
  - `Database/Migrations/2026_02_25_000001_*` through `2026_02_25_000005_*`
  - `Entities/MfgQualityInspection.php`
  - `Entities/MfgProductionNote.php`
  - `Http/Controllers/ProductionDashboardController.php`
  - `Http/Controllers/QualityInspectionController.php`
  - `Http/Controllers/ProductionStatusController.php`
  - `Resources/views/dashboard/index.blade.php`
  - `Resources/views/quality_inspection/` (4 files: index, create, show, edit)
  - `Resources/views/production/partials/enhanced_info.blade.php`
  - `Resources/views/production/partials/notes.blade.php`

- [ ] Deploy all modified files:
  - `Config/config.php` (version 3.1 → 4.0)
  - `Http/Controllers/ProductionController.php`
  - `Http/Controllers/SettingsController.php`
  - `Http/Controllers/DataController.php`
  - `Utils/ManufacturingUtil.php`
  - `Routes/web.php`
  - `Resources/lang/en/lang.php`
  - `Resources/views/production/create.blade.php`
  - `Resources/views/production/edit.blade.php`
  - `Resources/views/production/show.blade.php`
  - `Resources/views/production/index.blade.php`
  - `Resources/views/production/production_script.blade.php`
  - `Resources/views/layouts/nav.blade.php`
  - `Resources/views/layouts/partials/sidebar.blade.php`
  - `Resources/views/layouts/partials/common_script.blade.php`
  - `Resources/views/settings/index.blade.php`

## Database Migration

```bash
php artisan module:migrate Manufacturing
```

- [ ] Migration runs without errors
- [ ] Verify `transactions` table has 9 new `mfg_*` columns
- [ ] Verify `mfg_quality_inspections` table exists
- [ ] Verify `mfg_production_notes` table exists
- [ ] Verify `mfg_recipes` table has `version` and `change_log` columns
- [ ] Verify `permissions` table has 4 new `manufacturing.*` rows

## Cache Clear

```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

- [ ] All cache commands succeed

## Post-Deployment Verification

- [ ] Login as admin — no errors
- [ ] Navigate to Manufacturing → Settings — shows version 4.0
- [ ] 6 new settings checkboxes visible and functional
- [ ] Navigate to Manufacturing → Production — list loads with Status and Priority columns
- [ ] Existing production records display correctly (new columns show empty/default)
- [ ] Create a new production with all enhanced fields — saves correctly
- [ ] Navigate to Manufacturing → Dashboard — loads with KPIs
- [ ] Navigate to Manufacturing → Quality Control — list loads
- [ ] Create a QC inspection with parameters — saves correctly
- [ ] Nav bar shows Dashboard and Quality Control links
- [ ] Sidebar shows Dashboard and Quality Control items
- [ ] User Management → Roles shows 4 new Manufacturing permissions

## Permission Assignment

- [ ] Assign `manufacturing.access_dashboard` to appropriate roles
- [ ] Assign `manufacturing.access_quality_control` to appropriate roles
- [ ] Assign `manufacturing.add_quality_inspection` to appropriate roles
- [ ] Assign `manufacturing.manage_production_status` to appropriate roles

## Feature Activation

- [ ] Enable desired features in Manufacturing → Settings:
  - [ ] Enable Production Status Workflow
  - [ ] Enable Quality Control
  - [ ] Enable Yield Tracking
  - [ ] Enable Batch Number Tracking
  - [ ] Enable Labour & Overhead Costs
  - [ ] Auto-generate Batch Numbers (optional)

## Smoke Test

- [ ] Create a production (planned status, high priority, with due date and batch number)
- [ ] Edit the production — change status to "In Progress"
- [ ] Add a production note
- [ ] Create a QC inspection for the production (set status to "Quality Check" first)
- [ ] Pass the QC inspection — verify auto-advance to "Completed"
- [ ] Check the Dashboard — verify KPI counts are correct
- [ ] Delete a production — verify it's removed from the list

## Rollback Plan (if needed)

```bash
# 1. Rollback migrations in reverse order
php artisan migrate:rollback --path=modules/Manufacturing/Database/Migrations/2026_02_25_000005_add_enhanced_manufacturing_permissions.php
php artisan migrate:rollback --path=modules/Manufacturing/Database/Migrations/2026_02_25_000004_add_version_to_mfg_recipes_table.php
php artisan migrate:rollback --path=modules/Manufacturing/Database/Migrations/2026_02_25_000003_create_mfg_production_notes_table.php
php artisan migrate:rollback --path=modules/Manufacturing/Database/Migrations/2026_02_25_000002_create_mfg_quality_inspections_table.php
php artisan migrate:rollback --path=modules/Manufacturing/Database/Migrations/2026_02_25_000001_add_enhanced_manufacturing_columns_to_transactions_table.php

# 2. Restore backed-up files
# 3. Clear caches
php artisan cache:clear && php artisan config:clear && php artisan view:clear && php artisan route:clear
```
