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
