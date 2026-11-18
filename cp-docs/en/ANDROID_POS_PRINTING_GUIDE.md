# Android POS Printing

## Module Overview

The Android POS printing integration connects a Web2App Android wrapper directly to a STAR TSP100IIIU USB receipt printer. A cash drawer connected to the printer can also be opened from the POS when the signed-in cashier is permitted to do so.

## Purpose of the Feature

This integration lets an Android POS terminal print receipts and operate its attached cash drawer without routing those jobs through a separate Windows computer or the `pos_print_server`.

## User Access / Permissions

- An administrator must publish/install an Android app update that includes STAR USB support once.
- A device user can enable **STAR USB POS Printer** in the app's **Settings** tab; the choice is saved on that device.
- A cashier must have **Allow to Open Cash Drawer** permission to use the POS drawer control.
- Android asks for access to the connected STAR USB device when the app first opens it for printing. This is a USB-device prompt, not an app permission shown in the Android App info permissions list.

## Step-by-Step Usage Instructions

1. Install the Android app version that includes STAR USB printing support. An app update is required once to add the native printer support.
2. In the app, open the bottom **Settings** tab and turn on **STAR USB POS Printer**.
3. Power on the STAR TSP100IIIU and connect its USB cable directly to the terminal's USB host port.
4. Connect the cash drawer to the printer's **DK port 1**.
5. Sign in to BitorePOS and print a test receipt from the POS. Android should prompt to allow access to the connected STAR USB printer; approve it.
6. To test the drawer, use the POS cash-drawer control with a user account that has **Allow to Open Cash Drawer** permission.

## Field Descriptions

| Field | Type | Description |
|---|---|---|
| **STAR USB POS Printer** | On-device setting (switch) | Enables or disables direct STAR USB printing on this Android device. The setting is stored locally and does not require a customer-specific APK rebuild. |
| **Allow to Open Cash Drawer** | User permission (checkbox) | Allows the signed-in cashier to request a cash-drawer pulse from the POS. |

## Business Logic / Workflow

The Android app includes the native STAR printing support. When **STAR USB POS Printer** is enabled in the app's Settings, BitorePOS sends eligible receipt HTML to the app's native STAR bridge. This also works when the Business Location uses the **Printer** receipt type: the response includes HTML for Android and retains structured printer data for the existing print-server route. The bridge renders the receipt for the 80 mm thermal layout and sends it to the USB-connected TSP100IIIU. An authorized drawer-open request sends a pulse on the printer's DK port 1.

The integration handles POS receipts and authorized drawer-open requests. Kitchen Order Tickets continue to use their existing print route. If the native printer reports an error, BitorePOS displays it instead of silently sending the same job to another printer route.

## Notes or Important Considerations

- Existing Play Store installations need one app update containing native STAR support. After that update, each customer can enable printing in the app without a customer-specific rebuild.
- The printer switch is stored on the device. Enabling it on one terminal does not enable it on other terminals.
- The Android terminal must support USB host access. Keep the printer powered and use a data-capable USB cable.
- USB access is granted for the connected device through Android's USB access prompt; it does not appear as a normal runtime permission in the app's **App info → Permissions** list.
- This direct USB integration does not use Web2Desk's Windows printer service or the PHP `pos_print_server`.
- Android builds with this feature include Star Micronics StarIO libraries; review the vendor's license terms for your app distribution.
- The cash drawer must be connected to the printer's DK port 1. The integration does not send the drawer pulse to port 2.
- Kitchen Order Tickets and other configured printers are not redirected to this receipt printer.
- Confirm receipt alignment, paper feed, drawer operation, and Android USB permission on the physical terminal before using it for live sales.

---

## Workstation KOT and Receipt Printing over the Local Network

Use this workflow when Android devices submit KOT jobs through the Windows workstation instead of printing directly to a USB printer attached to the Android device. The **STAR USB POS Printer** switch must remain off unless that Android device has its own STAR USB printer attached.

### Workstation preparation

1. Install and run the ProSurface Hardware Service on the workstation PC.
2. In **Hardware Setup**, save the appropriate receipt and kitchen-printer assignments for the business location. Receipt printing and kitchen/KOT printing are separate mappings.
3. Ensure the Hardware Service port is reachable from the Android devices on the LAN. Use the workstation's stable LAN address and the displayed pairing code in Mobile POS **Printer Settings**.
4. Pair every Android device with the main PC. The app confirms that the device is paired.
5. Place a test table order and use **Print** to produce a KOT. For browser POS table bills, select the order and use **Print Bill**; this uses the configured receipt-printer mapping.

### When Wi-Fi or the workstation is unavailable

- Mobile POS keeps synchronized products, permitted tables, and eligible table orders locally.
- A print request that cannot reach the workstation is stored in the mobile **Print Queue**. It is retried after the device can reach the paired workstation again.
- Keep the app installed and do not clear its storage while jobs are pending. Confirm queued jobs have completed before treating an order as printed.

### Two-floor restaurant LAN layout

Use one IP network for the workstation, kitchen printers, and Android devices:

1. Keep the ISP router as the only router and DHCP server.
2. Connect the ISP router, both LS1008G switches, the workstation, kitchen printers, and the two AX1500 units using Ethernet as required by the building layout.
3. Set **both AX1500 units to Access Point mode**. Do not use their router/WAN mode, guest isolation, or a separate DHCP range.
4. Use the same staff SSID/security policy on both floors if roaming is required. Keep Android devices off a guest network and disable client/AP isolation.

All Android devices, the workstation Hardware Service, and network printers must receive addresses in the same LAN subnet. A working browser receipt or KOT test proves the workstation/printer path, but each Android device must still be paired to the workstation before it can submit KOT jobs.
