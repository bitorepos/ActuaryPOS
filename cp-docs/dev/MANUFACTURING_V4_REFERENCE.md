# Manufacturing Module v4.0 — Developer Reference

Technical reference for the Manufacturing module enhancements introduced in v4.0.

---

## Architecture Overview

The Manufacturing module follows the **nwidart/laravel-modules** architecture pattern. All code lives under `modules/Manufacturing/`.

```
modules/Manufacturing/
├── Config/config.php              # Module config (version 4.0)
├── Database/Migrations/           # 5 new migrations (2026_02_25_*)
├── Entities/                      # Eloquent models
│   ├── MfgRecipe.php             # Existing
│   ├── MfgRecipeIngredient.php   # Existing
│   ├── MfgIngredientGroup.php    # Existing
│   ├── MfgQualityInspection.php  # NEW v4.0
│   └── MfgProductionNote.php     # NEW v4.0
├── Http/Controllers/
│   ├── ProductionController.php   # Modified: enhanced fields in store/update/index
│   ├── RecipeController.php       # Unchanged
│   ├── SettingsController.php     # Modified: new settings
│   ├── DataController.php         # Modified: new permissions
│   ├── ProductionDashboardController.php  # NEW v4.0
│   ├── QualityInspectionController.php    # NEW v4.0
│   └── ProductionStatusController.php     # NEW v4.0
├── Utils/ManufacturingUtil.php    # Modified: dashboard stats, helpers
├── Routes/web.php                 # Modified: new routes
├── Resources/
│   ├── lang/en/lang.php          # Modified: 90+ new keys
│   └── views/
│       ├── dashboard/index.blade.php           # NEW v4.0
│       ├── quality_inspection/                  # NEW v4.0 (4 files)
│       ├── production/partials/enhanced_info.blade.php  # NEW v4.0
│       ├── production/partials/notes.blade.php          # NEW v4.0
│       ├── production/create.blade.php         # Modified
│       ├── production/edit.blade.php           # Modified
│       ├── production/show.blade.php           # Modified
│       ├── production/index.blade.php          # Modified
│       ├── layouts/nav.blade.php               # Modified
│       ├── layouts/partials/sidebar.blade.php  # Modified
│       ├── layouts/partials/common_script.blade.php  # Modified
│       └── settings/index.blade.php            # Modified
└── Providers/ManufacturingServiceProvider.php   # Unchanged
```

---

## Database Schema Changes

### Migration 1: Enhanced Transaction Columns

**File:** `2026_02_25_000001_add_enhanced_manufacturing_columns_to_transactions_table.php`

Adds nullable columns to the existing `transactions` table:

| Column | Type | Default | Index |
|--------|------|---------|-------|
| `mfg_production_status` | `ENUM('planned','in_progress','quality_check','completed','on_hold','cancelled')` | NULL | Yes |
| `mfg_expected_quantity` | `DECIMAL(22,4)` | NULL | No |
| `mfg_actual_quantity` | `DECIMAL(22,4)` | NULL | No |
| `mfg_labor_cost` | `DECIMAL(22,4)` | 0 | No |
| `mfg_overhead_cost` | `DECIMAL(22,4)` | 0 | No |
| `mfg_batch_number` | `VARCHAR(255)` | NULL | Yes |
| `mfg_priority` | `ENUM('low','normal','high','urgent')` | 'normal' | Yes |
| `mfg_due_date` | `DATE` | NULL | Yes |
| `mfg_notes` | `TEXT` | NULL | No |

> **Non-destructive:** All columns are nullable. Existing records unaffected.

### Migration 2: Quality Inspections Table

**File:** `2026_02_25_000002_create_mfg_quality_inspections_table.php`

```sql
CREATE TABLE mfg_quality_inspections (
    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    transaction_id   INT UNSIGNED NOT NULL,   -- FK → transactions(id) CASCADE
    inspector_id     INT UNSIGNED NULL,       -- FK → users(id) SET NULL
    inspection_date  DATETIME NOT NULL,
    status           ENUM('pending','passed','failed','conditional') DEFAULT 'pending',
    parameters       JSON NULL,               -- Array of QC check objects
    notes            TEXT NULL,
    batch_number     VARCHAR(255) NULL,
    created_at       TIMESTAMP NULL,
    updated_at       TIMESTAMP NULL,
    deleted_at       TIMESTAMP NULL,          -- Soft deletes
    INDEX (transaction_id),
    INDEX (inspector_id),
    INDEX (status)
);
```

**Parameters JSON structure:**
```json
[
    {
        "name": "Weight",
        "expected": "500g ± 5g",
        "actual": "498g",
        "result": "pass"
    },
    {
        "name": "pH Level",
        "expected": "6.5-7.5",
        "actual": "7.0",
        "result": "pass"
    }
]
```

### Migration 3: Production Notes Table

**File:** `2026_02_25_000003_create_mfg_production_notes_table.php`

```sql
CREATE TABLE mfg_production_notes (
    id              INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    transaction_id  INT UNSIGNED NOT NULL,    -- FK → transactions(id) CASCADE
    user_id         INT UNSIGNED NULL,        -- FK → users(id) SET NULL
    note            TEXT NOT NULL,
    note_type       ENUM('comment','status_change','quality_check','cost_update','general') DEFAULT 'comment',
    created_at      TIMESTAMP NULL,
    updated_at      TIMESTAMP NULL,
    INDEX (transaction_id),
    INDEX (note_type)
);
```

### Migration 4: Recipe Versioning

**File:** `2026_02_25_000004_add_version_to_mfg_recipes_table.php`

| Column | Type | Default |
|--------|------|---------|
| `version` | `INT UNSIGNED` | 1 |
| `change_log` | `TEXT` | NULL |

### Migration 5: New Permissions

**File:** `2026_02_25_000005_add_enhanced_manufacturing_permissions.php`

Inserts into `permissions` table:

| Permission Name | Guard |
|----------------|-------|
| `manufacturing.access_quality_control` | web |
| `manufacturing.access_dashboard` | web |
| `manufacturing.manage_production_status` | web |
| `manufacturing.add_quality_inspection` | web |

---

## Route Map

### New Routes (v4.0)

All routes are under the `manufacturing` prefix with middleware: `web`, `authh`, `SetSessionData`, `auth`, `language`, `timezone`, `AdminSidebarMenu`.

| Method | URI | Controller@Method | Permission |
|--------|-----|-------------------|------------|
| GET | `/manufacturing/dashboard` | `ProductionDashboardController@index` | `manufacturing.access_dashboard` or `manufacturing.access_production` |
| GET | `/manufacturing/quality-inspection` | `QualityInspectionController@index` | `manufacturing.access_quality_control` |
| GET | `/manufacturing/quality-inspection/create` | `QualityInspectionController@create` | `manufacturing.add_quality_inspection` |
| POST | `/manufacturing/quality-inspection` | `QualityInspectionController@store` | `manufacturing.add_quality_inspection` |
| GET | `/manufacturing/quality-inspection/{id}` | `QualityInspectionController@show` | `manufacturing.access_quality_control` |
| GET | `/manufacturing/quality-inspection/{id}/edit` | `QualityInspectionController@edit` | `manufacturing.access_quality_control` |
| PUT/PATCH | `/manufacturing/quality-inspection/{id}` | `QualityInspectionController@update` | `manufacturing.access_quality_control` |
| DELETE | `/manufacturing/quality-inspection/{id}` | `QualityInspectionController@destroy` | `manufacturing.access_quality_control` |
| POST | `/manufacturing/production/{id}/update-status` | `ProductionStatusController@updateStatus` | `manufacturing.manage_production_status` |
| GET | `/manufacturing/production/{id}/notes` | `ProductionStatusController@getNotes` | `manufacturing.access_production` |
| POST | `/manufacturing/production/{id}/notes` | `ProductionStatusController@storeNote` | `manufacturing.access_production` |
| POST | `/manufacturing/production/{id}/update-yield` | `ProductionStatusController@updateYield` | `manufacturing.access_production` |

### Existing Routes (Unchanged)

| Method | URI | Controller |
|--------|-----|------------|
| GET/POST | `/manufacturing/install` | `InstallController` |
| GET | `/manufacturing/install/update` | `InstallController@update` |
| GET | `/manufacturing/install/uninstall` | `InstallController@uninstall` |
| GET | `/manufacturing/is-recipe-exist/{variation_id}` | `RecipeController@isRecipeExist` |
| GET | `/manufacturing/ingredient-group-form` | `RecipeController@getIngredientGroupForm` |
| GET | `/manufacturing/get-recipe-details` | `RecipeController@getRecipeDetails` |
| GET | `/manufacturing/get-recipe-details-reverse` | `RecipeController@getRecipeDetailsReverse` |
| GET | `/manufacturing/get-ingredient-row/{variation_id}` | `RecipeController@getIngredientRow` |
| GET | `/manufacturing/get-ingredient-row-production/{variation_id}` | `RecipeController@getIngredientRowProduction` |
| GET | `/manufacturing/add-ingredient` | `RecipeController@addIngredients` |
| RESOURCE | `/manufacturing/recipe` | `RecipeController` (except edit, update) |
| GET | `/manufacturing/recipe/restore/{id}` | `RecipeController@restore` |
| GET | `/manufacturing/recipe-report` | `RecipeController@getRecipeReport` |
| POST | `/manufacturing/update-product-prices` | `RecipeController@updateRecipeProductPrices` |
| RESOURCE | `/manufacturing/production` | `ProductionController` |
| RESOURCE | `/manufacturing/reverse-production` | `ReverseProductionController` |
| GET/POST | `/manufacturing/settings` | `SettingsController` |
| GET | `/manufacturing/report` | `ReportController` |

---

## Models

### MfgQualityInspection

**File:** `Entities/MfgQualityInspection.php`

```php
class MfgQualityInspection extends Model
{
    use SoftDeletes;

    protected $table = 'mfg_quality_inspections';

    protected $guarded = ['id'];

    protected $casts = ['parameters' => 'array'];

    // Relationships
    public function transaction()  // belongsTo Transaction
    public function inspector()    // belongsTo User (inspector_id)

    // Accessors
    public function getStatusBadgeAttribute()  // Returns HTML badge

    // Scopes
    public function scopePassed($query)
    public function scopeFailed($query)
    public function scopePending($query)
}
```

### MfgProductionNote

**File:** `Entities/MfgProductionNote.php`

```php
class MfgProductionNote extends Model
{
    protected $table = 'mfg_production_notes';

    protected $guarded = ['id'];

    // Relationships
    public function transaction()  // belongsTo Transaction
    public function user()         // belongsTo User

    // Accessors
    public function getNoteTypeBadgeAttribute()  // Returns HTML badge

    // Scopes
    public function scopeOfType($query, $type)
}
```

---

## Controllers

### ProductionDashboardController

**Methods:**
- `index(Request $request)` — Returns dashboard view with stats from `ManufacturingUtil::getDashboardStats()`. Supports AJAX (returns JSON) and standard HTML rendering. Accepts `location_id`, `start_date`, `end_date` query params.

### QualityInspectionController

Full CRUD resource controller. Key behaviours:
- **store()** — Creates `MfgQualityInspection`, builds parameters JSON from input arrays, adds auto production note. If status is 'passed' and production is in 'quality_check', auto-advances to 'completed'.
- **update()** — Updates inspection, logs status changes as production notes.
- **destroy()** — Soft-deletes only.

### ProductionStatusController

- **updateStatus()** — Validates against enum values, updates `mfg_production_status`, logs old→new transition as production note.
- **getNotes()** — Returns rendered partial view of notes for AJAX.
- **storeNote()** — Validates note (max 1000 chars), creates `MfgProductionNote` with configurable `note_type`.
- **updateYield()** — Updates `mfg_expected_quantity` and `mfg_actual_quantity`, calculates efficiency, adds note.

---

## Utility Methods (ManufacturingUtil)

### New Methods Added in v4.0

```php
// Dashboard aggregation — returns array with status_counts, total_value,
// yield_efficiency, cost_data, priority_counts, overdue_count, qc_stats,
// recent_productions
public function getDashboardStats($business_id, $start_date = null, $end_date = null, $location_id = null)

// Returns localized label string for a status value
public static function getProductionStatusLabel($status)

// Returns Bootstrap badge HTML for a status value
public static function getProductionStatusBadge($status)

// Returns Bootstrap badge HTML for a priority value
public static function getPriorityBadge($priority)

// Creates a MfgProductionNote record (user_id defaults to auth user)
public function addProductionNote($transaction_id, $note, $note_type = 'comment', $user_id = null)

// Calculates (actual / expected) * 100
public function calculateYieldEfficiency($expected, $actual)

// Returns [key => label] array for status dropdown
public static function productionStatuses()

// Returns [key => label] array for priority dropdown
public static function priorityLevels()
```

---

## Settings Schema

Settings are stored as JSON in the `manufacturing_settings` column of the `businesses` table.

### New Settings Keys (v4.0)

| Key | Type | Default | Description |
|-----|------|---------|-------------|
| `enable_production_status` | `boolean` | `false` | Enable the production status workflow |
| `enable_quality_control` | `boolean` | `false` | Enable Quality Control features |
| `enable_yield_tracking` | `boolean` | `false` | Enable yield tracking fields |
| `enable_batch_tracking` | `boolean` | `false` | Enable batch number fields |
| `enable_enhanced_costs` | `boolean` | `false` | Enable labour and overhead cost fields |
| `auto_generate_batch_number` | `boolean` | `false` | Auto-generate batch numbers |

### Existing Settings Keys

| Key | Type | Description |
|-----|------|-------------|
| `ref_no_prefix` | `string` | Production reference number prefix |
| `reverse_ref_no_prefix` | `string` | Reverse production reference prefix |
| `enable_reverse_production` | `boolean` | Allow reverse productions |
| `disable_editing_ingredient_qty` | `boolean` | Lock ingredient quantities in production |
| `enable_updating_product_price` | `boolean` | Update product purchase price on finalize |

---

## Permission Map

### New Permissions (v4.0)

| Permission | Guard | Used By |
|-----------|-------|---------|
| `manufacturing.access_quality_control` | web | QualityInspectionController (index, show, edit, update, destroy), nav/sidebar |
| `manufacturing.access_dashboard` | web | ProductionDashboardController (index), nav/sidebar |
| `manufacturing.manage_production_status` | web | ProductionStatusController (updateStatus) |
| `manufacturing.add_quality_inspection` | web | QualityInspectionController (create, store) |

### Existing Permissions

| Permission | Description |
|-----------|-------------|
| `manufacturing.access_recipe` | View recipes |
| `manufacturing.add_recipe` | Create recipes |
| `manufacturing.edit_recipe` | Edit recipes |
| `manufacturing.access_production` | View and manage productions |
| `manufacturing.view_own_production` | View only own productions |

---

## Event Flow: Production Lifecycle

```
1. CREATE PRODUCTION (store)
   ├── Creates Transaction (type: production_purchase, status: pending/received)
   ├── Sets mfg_production_status (default: 'planned')
   ├── Sets mfg_priority, mfg_due_date, mfg_batch_number
   ├── Sets mfg_expected_quantity, mfg_actual_quantity
   ├── Sets mfg_labor_cost, mfg_overhead_cost
   ├── Creates PurchaseLines
   ├── Creates production_sell Transaction (child)
   ├── Creates SellLines (ingredient consumption)
   └── If finalized: auto-sets status to 'completed'

2. UPDATE STATUS (updateStatus)
   ├── Validates new status against enum
   ├── Updates mfg_production_status
   └── Creates MfgProductionNote (type: status_change)

3. CREATE QC INSPECTION (store)
   ├── Creates MfgQualityInspection
   ├── Stores QC parameters as JSON
   ├── Creates MfgProductionNote (type: quality_check)
   └── If passed + production in 'quality_check':
       └── Auto-advances production to 'completed'

4. UPDATE YIELD (updateYield)
   ├── Updates mfg_expected_quantity, mfg_actual_quantity
   ├── Calculates yield efficiency %
   └── Creates MfgProductionNote (type: comment)

5. ADD NOTE (storeNote)
   └── Creates MfgProductionNote with user-selected type
```

---

## DataTable Changes

### Production Index DataTable

**New columns added (v4.0):**

| Column | Data Key | Sortable | Searchable |
|--------|----------|----------|------------|
| Production Status | `mfg_status` | Yes (by `mfg_production_status`) | Yes |
| Priority | `mfg_priority_badge` | Yes (by `mfg_priority`) | No |

**New filter parameter:** `production_status` — filters by `mfg_production_status` value.

Column order: Date, Ref No, Location, Product, Quantity, **Status**, **Priority**, Total Cost, Action.

The action column target index changed from 6 to 8 in `columnDefs`.

---

## Testing Checklist

### Migrations
- [ ] Run `php artisan module:migrate Manufacturing` — no errors
- [ ] Verify new columns on `transactions` table
- [ ] Verify `mfg_quality_inspections` table created
- [ ] Verify `mfg_production_notes` table created
- [ ] Verify `version` and `change_log` columns on `mfg_recipes`
- [ ] Verify 4 new permissions in `permissions` table
- [ ] Rollback: `php artisan module:migrate-rollback Manufacturing` — clean

### Production CRUD
- [ ] Create production with all new fields (status, priority, due date, batch, yield, costs, notes)
- [ ] Edit non-finalized production — all new fields editable and persisted
- [ ] Finalize production — status auto-set to 'completed'
- [ ] Show production — enhanced info displayed (status, priority, batch, costs, yield, notes)
- [ ] Delete production — works normally

### Production Index
- [ ] Status and Priority columns display correctly
- [ ] Status filter works
- [ ] Location filter still works
- [ ] Date range filter still works
- [ ] Finalize checkbox filter still works

### Dashboard
- [ ] Dashboard loads with correct KPIs
- [ ] Status breakdown counts match actual data
- [ ] Priority breakdown counts match
- [ ] QC summary shows correct pass rate
- [ ] Cost breakdown shows correct totals
- [ ] Recent productions table populated
- [ ] Location and date filters work

### Quality Control
- [ ] QC list loads with DataTable
- [ ] Create inspection with QC parameters
- [ ] Parameters stored as valid JSON
- [ ] Passing QC on 'quality_check' production auto-advances to 'completed'
- [ ] Edit inspection — changes saved
- [ ] Delete inspection — soft-deleted

### Production Status
- [ ] Update status works for all enum values
- [ ] Status change creates production note
- [ ] Previous status is logged correctly

### Production Notes
- [ ] Add manual note with each type
- [ ] Notes display in reverse chronological order
- [ ] Automatic notes created on status change/QC/yield update

### Settings
- [ ] All 6 new settings checkboxes display correctly
- [ ] Settings save and restore on page reload
- [ ] Existing settings still work

### Permissions
- [ ] Users without `access_dashboard` cannot access dashboard
- [ ] Users without `access_quality_control` cannot access QC
- [ ] Users without `manage_production_status` cannot change status
- [ ] Users without `add_quality_inspection` cannot create inspections
- [ ] Existing permissions still work correctly

### Backward Compatibility
- [ ] Existing productions (without new fields) display correctly
- [ ] Status/Priority columns show empty gracefully for old records
- [ ] Old recipes unaffected (version defaults to 1)
- [ ] No data loss on any existing records

---

## Upgrade Instructions

```bash
# 1. Run module migrations
php artisan module:migrate Manufacturing

# 2. Clear caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# 3. Verify version
# Check Manufacturing → Settings — should show "Manufacturing module version - 4.0"

# 4. Assign new permissions
# Go to User Management → Roles and assign the 4 new permissions as needed

# 5. Enable new features
# Go to Manufacturing → Settings and enable desired features:
#   - Enable Production Status Workflow
#   - Enable Quality Control
#   - Enable Yield Tracking
#   - Enable Batch Number Tracking
#   - Enable Labour & Overhead Costs
#   - Auto-generate Batch Numbers
```

---

## Rollback

To revert to v3.1:

```bash
# Rollback the 5 new migrations
php artisan migrate:rollback --path=modules/Manufacturing/Database/Migrations/2026_02_25_000005_add_enhanced_manufacturing_permissions.php
php artisan migrate:rollback --path=modules/Manufacturing/Database/Migrations/2026_02_25_000004_add_version_to_mfg_recipes_table.php
php artisan migrate:rollback --path=modules/Manufacturing/Database/Migrations/2026_02_25_000003_create_mfg_production_notes_table.php
php artisan migrate:rollback --path=modules/Manufacturing/Database/Migrations/2026_02_25_000002_create_mfg_quality_inspections_table.php
php artisan migrate:rollback --path=modules/Manufacturing/Database/Migrations/2026_02_25_000001_add_enhanced_manufacturing_columns_to_transactions_table.php
```

> **Note:** Rolling back Migration 1 will drop the new columns from the `transactions` table. Any data stored in those columns will be lost. The new `mfg_quality_inspections` and `mfg_production_notes` tables will be dropped entirely.
