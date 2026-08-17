# Manufacturing Module v4.0 — Quick Reference Card

## Key URLs

| Purpose | URL |
|---------|-----|
| Dashboard | `/manufacturing/dashboard` |
| Production List | `/manufacturing/production` |
| Add Production | `/manufacturing/production/create` |
| QC Inspection List | `/manufacturing/quality-inspection` |
| Add QC Inspection | `/manufacturing/quality-inspection/create` |
| Update Status | `POST /manufacturing/production/{id}/update-status` |
| Get Notes | `GET /manufacturing/production/{id}/notes` |
| Add Note | `POST /manufacturing/production/{id}/notes` |
| Update Yield | `POST /manufacturing/production/{id}/update-yield` |
| Settings | `/manufacturing/settings` |

## Core Classes

| Class | Location | Purpose |
|-------|----------|---------|
| ProductionDashboardController | `Http/Controllers/` | Dashboard KPIs and stats |
| QualityInspectionController | `Http/Controllers/` | Full CRUD for QC inspections |
| ProductionStatusController | `Http/Controllers/` | Status, notes, and yield management |
| MfgQualityInspection | `Entities/` | QC inspection model (soft deletes) |
| MfgProductionNote | `Entities/` | Production activity notes model |
| ManufacturingUtil | `Utils/` | Dashboard stats, helpers, status badges |

## Additional Key URLs

| Purpose | URL |
|---------|-----|
| Recipe Report | `GET /manufacturing/recipe-report` |
| Update Product Prices | `POST /manufacturing/update-product-prices` |

## Database Tables

### New columns on `transactions`
```
mfg_production_status  ENUM(planned,in_progress,quality_check,completed,on_hold,cancelled)
mfg_expected_quantity   DECIMAL(22,4)
mfg_actual_quantity     DECIMAL(22,4)
mfg_labor_cost          DECIMAL(22,4) DEFAULT 0
mfg_overhead_cost       DECIMAL(22,4) DEFAULT 0
mfg_batch_number        VARCHAR(255)
mfg_priority            ENUM(low,normal,high,urgent) DEFAULT 'normal'
mfg_due_date            DATE
mfg_notes               TEXT
```

### `mfg_quality_inspections`
```
id, transaction_id(FK), inspector_id(FK), inspection_date, 
status(ENUM), parameters(JSON), notes, batch_number, 
created_at, updated_at, deleted_at
```

### `mfg_production_notes`
```
id, transaction_id(FK), user_id(FK), note, 
note_type(ENUM), created_at, updated_at
```

## Permissions

| Permission | Feature |
|-----------|---------|
| `manufacturing.access_dashboard` | View dashboard |
| `manufacturing.access_quality_control` | View QC list |
| `manufacturing.add_quality_inspection` | Create QC inspections |
| `manufacturing.manage_production_status` | Change production status |

## Settings (JSON in `businesses.manufacturing_settings`)

| Key | Type | Description |
|-----|------|-------------|
| `enable_production_status` | bool | Status workflow |
| `enable_quality_control` | bool | QC features |
| `enable_yield_tracking` | bool | Yield tracking |
| `enable_batch_tracking` | bool | Batch numbers |
| `enable_enhanced_costs` | bool | Labor/overhead costs |
| `auto_generate_batch_number` | bool | Auto batch IDs |

## Status Badges (ManufacturingUtil)

```php
ManufacturingUtil::getProductionStatusBadge('completed')
// Returns: <span class="badge bg-success">Completed</span>

ManufacturingUtil::getPriorityBadge('urgent')
// Returns: <span class="badge bg-danger">Urgent</span>
```

## QC Parameters JSON Format

```json
[
  {"name": "Weight", "expected": "500g", "actual": "498g", "result": "pass"},
  {"name": "pH", "expected": "6.5-7.5", "actual": "7.0", "result": "pass"}
]
```

## Production Lifecycle

```
CREATE → planned → in_progress → quality_check → completed
                        ↕                            ↑
                    on_hold                      (auto on QC pass)
                        ↓
                    cancelled
```

## Upgrade Commands

```bash
php artisan module:migrate Manufacturing
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## Migration Files (run order)

```
2026_02_25_000001  Add enhanced columns to transactions
2026_02_25_000002  Create mfg_quality_inspections table
2026_02_25_000003  Create mfg_production_notes table
2026_02_25_000004  Add version to mfg_recipes table
2026_02_25_000005  Add enhanced manufacturing permissions
```
