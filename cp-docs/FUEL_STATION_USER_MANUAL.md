# Fuel Station Management — User Manual

## 1. Module Overview

The **Fuel Station Management** module turns the system into a complete petrol/diesel station operations tool. It lets you manage fuel tanks, dispensers (pumps) and nozzles, run operator shifts, record fuel sales and credit/fleet sales, track tank stock automatically, integrate with dispenser hardware, and view dashboards and reports.

The module is built on top of the existing system: it reuses your **business locations**, **users and roles**, **inventory products and stock**, **contacts (suppliers)**, and the standard **reports framework** — nothing is duplicated.

---

## 2. Purpose of the Feature

Fuel stations need accurate control of high-value liquid stock that is sold continuously across multiple pumps and shifts. This module solves:

- Knowing exactly how much fuel is in each tank at any time.
- Reconciling meter readings against cash, card, bank and credit collections per shift.
- Detecting cash short/excess and stock losses (leakage, evaporation, testing).
- Recording supplier refills, tank transfers and approved adjustments.
- Reporting on sales by day, product, dispenser, staff and credit customer.

---

## 3. User Access / Permissions

Access is controlled by role permissions. A user only sees the menus and actions allowed by their role.

| Permission | Allows |
|---|---|
| View Dashboard | Open the Fuel Station dashboard |
| Manage Tanks | Add/edit/delete fuel tanks |
| Manage Dispensers | Add/edit/delete dispensers |
| Manage Nozzles | Add/edit/delete nozzles |
| Open Shift | Start a new shift |
| Close Shift | Enter closing readings and collections |
| Approve Shift | Approve a closed shift |
| Manage Refill | Record tank refills |
| Manage Tank Adjustment | Create stock adjustments |
| Approve Tank Adjustment | Approve/reject adjustments |
| Manage Tank Transfer | Transfer fuel between tanks |
| Manage Integration | Configure dispenser hardware integration |
| View Reports | Open all fuel reports |

All actions are also scoped by **business location**, so users only work with the locations assigned to them.

---

## 4. Step-by-Step Usage Instructions

### A. First-time setup
1. Open **Fuel Station** from the sidebar menu.
2. Go to **Tanks → Add Tank**. Enter the tank name, link an inventory product (the fuel item), set capacity, opening stock and minimum-stock alert, then save.
3. Go to **Dispensers → Add Dispenser**. Enter the pump name, model and serial number, then save.
4. Go to **Nozzles → Add Nozzle**. Select the dispenser and the tank it draws from, set the opening meter reading, then save. The nozzle inherits the tank's product automatically.

### B. Running a shift
1. Go to **Shifts → Open Shift**. Choose the operator, location, dispenser and start time.
2. The active nozzles load automatically with their current readings. Confirm the opening readings and save.
3. At the end of the shift, open the shift and click **Close Shift**.
4. Enter each nozzle's closing reading and any test quantity. The system calculates litres sold and amount per nozzle.
5. Enter the **cash, card, bank and credit** amounts collected. The system shows **expected cash** and **cash short/excess**.
6. Save to close the shift. Tank stock is reduced automatically.
7. A supervisor with the **Approve Shift** permission can then approve the closed shift.

### C. Refills, adjustments and transfers
- **Tank Refills → Add Refill:** select the tank and supplier, enter quantity and rate; the total and weighted-average cost are calculated.
- **Tank Adjustments → Add Adjustment:** choose the tank, type (leakage, loss, gain, testing, evaporation, calibration), direction and quantity. Adjustments require approval before they affect stock.
- **Tank Transfers → Add Transfer:** move fuel from one tank to another; the source tank's stock is validated.

### D. Dispenser integration (optional)
1. Go to **Integration → Add Integration**.
2. Select the dispenser, brand, model and protocol (Manual, Serial, RS232, TCP/IP or API) and enter the connection details.
3. Use **Test Read** to verify the connection. Results are stored in the integration log.

### E. Dashboard and reports
- **Dashboard:** view today's sales, litres, active shifts, pending approvals, tank stock, alerts and charts.
- **Reports:** open any of the eleven reports and filter by location and date range; use the Print button for a printable copy.

---

## 5. Field Descriptions

### Fuel Tank
| Field | Type | Description |
|---|---|---|
| Tank Name | Text | Display name of the tank |
| Code | Text | Optional reference code |
| Location | Dropdown | Business location of the tank |
| Linked Product | Dropdown | Inventory product representing the fuel |
| Fuel Type | Text | e.g. Petrol, Diesel |
| Placement | Dropdown | Underground or Above-ground |
| Capacity | Number | Maximum litres the tank holds |
| Opening Stock | Number | Litres at setup |
| Min Stock Alert | Number | Litres below which a low-stock alert shows |
| Graph Colour | Colour | Colour used in charts |
| Status | Dropdown | Active or Inactive |

### Dispenser
| Field | Type | Description |
|---|---|---|
| Name | Text | Pump name |
| Code | Text | Optional reference |
| Model | Text | Hardware model |
| Serial Number | Text | Hardware serial |
| Location | Dropdown | Business location |
| Status | Dropdown | Active or Inactive |

### Nozzle
| Field | Type | Description |
|---|---|---|
| Name | Text | Nozzle name |
| Dispenser | Dropdown | Parent dispenser |
| Tank | Dropdown | Tank the nozzle draws from (sets the product) |
| Opening Reading | Number | Starting meter value |
| Status | Dropdown | Active, Inactive or Maintenance |

### Shift (close)
| Field | Type | Description |
|---|---|---|
| Closing Reading | Number | Meter value at shift end |
| Test Quantity | Number | Litres dispensed for testing (not sold) |
| Rate per Litre | Number | Selling price per litre |
| Cash / Card / Bank / Credit | Number | Amounts collected by each method |
| Expected Cash | Calculated | Total sales minus card, bank and credit |
| Short / Excess | Calculated | Cash received minus expected cash |

---

## 6. Business Logic / Workflow

- **Tank stock** = opening stock + refills + transfers in − transfers out − shift sales − approved decrease adjustments + approved increase adjustments. It is recalculated automatically after each refill, transfer, shift close and adjustment approval.
- **Shift sales** per nozzle = closing reading − opening reading − test quantity, multiplied by the rate per litre.
- **Cash short/excess** = cash received − (total sales − card − bank − credit).
- **Adjustments** only affect stock once approved; pending and rejected adjustments do not change stock.
- **Refills** update the tank's weighted-average purchase price.
- **Products, locations, suppliers, users and roles** come from the core system, so fuel data stays consistent with the rest of the ERP/POS.

---

## 7. Notes / Important Considerations

- A dispenser can have only **one open shift** at a time to prevent duplicate readings.
- Closing readings cannot be lower than opening readings; the system guards against negative sales.
- Dispenser integration is **integration-ready and extendable** — the included protocol drivers are stubs designed to be implemented for your specific hardware, not locked to one machine.
- Full POS sell-transaction posting is intentionally **deferred** in this release; shift sales are captured inside the module and the `transaction_id` links are reserved for a future release.
- The module must be **installed** (Superadmin → Modules) and the role must have the relevant permissions before the menus appear.
