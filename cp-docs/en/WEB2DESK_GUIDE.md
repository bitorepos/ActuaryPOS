# {application_name} Desktop App

The {application_name} Desktop App lets your shop use the POS in a normal desktop window and print directly to the printers installed on that computer.

It is useful for counters, shops, restaurants, warehouses, and offices where staff need fast POS access, thermal receipt printing, label printing, and local transaction export.

---

## What You Can Do

- Open {application_name} from a desktop shortcut.
- Connect to the online shop URL by entering the shop subdomain.
- Connect to a local or Laragon URL, such as localhost, an IP address, or a `.test` / `.local` website.
- Save the connection so staff do not need to enter the URL every time.
- Print receipts, invoices, kitchen orders, reports, labels, and cash register summaries without the browser print popup.
- Use 80mm thermal receipt printers for counter sales.
- Print labels from the label print screen.
- Open the cash drawer from the POS printer when the workstation and user are allowed to do it.
- Keep the app window fitted to the screen for a cleaner counter display.
- Use more than one desktop installation on the same computer when separate shortcuts and settings are needed.
- Save transaction export files to a local folder when local export is enabled by the administrator.

---

## First Setup

1. Open the {application_name} Desktop App.
2. If the settings screen opens, choose the connection type.
3. For an online shop, choose **Subdomain** and enter only your shop subdomain.
4. For a local installation, choose **Local / Laragon** and enter the full local address.
5. Click **Test Connection**.
6. When the connection is successful, click **Save**.
7. Sign in to {application_name} as usual.

After this, the app remembers the saved connection.

---

## Printer Setup

Printer selection is controlled from the workstation settings inside {application_name}.

1. Go to **Business Location > Settings**.
2. Open the **Workstation** tab.
3. Add or edit the workstation used by this computer.
4. Select the POS receipt printer, report printer, and label printer as needed.
5. Save the workstation.
6. Print a test receipt or label from the POS screen.

Once the printer is selected, staff can print from POS normally. The desktop app sends the print directly to the selected printer.

---

## Cash Drawer Setup

The cash drawer opens through the POS receipt printer.

1. Go to **Business Location > Settings > Workstation**.
2. Edit the workstation used by this counter.
3. Turn on **Enable Cash Drawer (POS Printer)**.
4. Turn on **Password Protected to Open Cash Drawer** if a password should be required for manual drawer opening.
5. Go to **Users > Settings > POS** for the cashier.
6. Turn on **Allow to Open Cash Drawer**.
7. Save the settings.

When allowed, staff can open the drawer from the POS cash drawer button or the Big Buttons **Open Till** button. If password protection is enabled, the cashier must enter their password before the drawer opens.

---

## Local Transaction Export

When local export is enabled by the administrator, the desktop app can save transaction export files to a folder on the computer.

This helps keep a local copy of important sales data. The app checks for new export files while it is open and saves them to the selected folder.

For best results:

- Keep the desktop app open during trading hours.
- Make sure the export folder is available.
- Do not move or rename the export folder without telling the administrator.

---

## Update Log

This history is written in simple user wording from the desktop app change history.

| Date | What Improved | What It Means for Users |
|---|---|---|
| 2026-03-07 | Desktop app started | Users could open the POS from a desktop app instead of only using a browser. |
| 2026-03-27 | Better saved connection | Local URLs and online shop URLs were saved more reliably. |
| 2026-04-12 | Direct receipt printing | POS receipts could print directly without showing the normal browser print popup. |
| 2026-04-13 | Better 80mm printing | Thermal receipts became easier to print on common 80mm receipt printers. |
| 2026-04-16 | Safer back navigation | The app became more stable when staff tried to go back after adding products on the POS screen. |
| 2026-04-17 | Separate desktop shortcuts | More than one desktop app setup could be used on the same computer, each with its own shortcut and saved settings. |
| 2026-04-17 | Better screen fit | The app opened in a larger, cleaner window and fitted counter screens better. |
| 2026-04-19 | Cleaner online shop display | Main-domain and subdomain screens displayed more consistently. |
| 2026-04-20 | Cash register printing | Cash register opening and closing summaries could print through the desktop app. |
| 2026-04-28 | Better printed product names | Product names printed more clearly on receipts. |
| 2026-04-28 | Label printing support | Product labels could be printed more smoothly from the desktop app. |
| 2026-05-15 | Full quantity printing | Quantities such as decimals printed fully instead of being cut short. |
| 2026-05-19 | Better table spacing on receipts | Product columns on thermal receipts became easier to read. |
| 2026-05-20 | Better slim receipt layouts | Slim receipt formats printed with fewer missing layout parts. |
| 2026-06-17 | Local transaction export | Transaction files could be saved automatically to a local folder when enabled. |
| 2026-06-18 | More reliable local export | Local export handling was improved so files save more consistently. |

---

## Common Problems

**The app does not open my shop.**  
Open settings and check the saved subdomain or local URL. Use **Test Connection** before saving.

**Receipts are not printing.**  
Check that the printer is installed on the computer, turned on, and selected in the workstation settings.

**The cash drawer does not open.**  
Check that the POS receipt printer is selected, cash drawer is enabled on the workstation, and the cashier has **Allow to Open Cash Drawer** turned on.

**Labels are not printing correctly.**  
Check that the label printer is selected in the workstation settings and that the correct label layout is being used.

**Local export is not saving files.**  
Keep the desktop app open and ask the administrator to check the export folder setting.
