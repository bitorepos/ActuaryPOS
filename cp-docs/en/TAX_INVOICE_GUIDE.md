# Tax Rates & Invoice Settings

Setting up taxes and invoices correctly ensures your business looks professional and stays compliant. This guide covers how to configure tax rates, invoice numbering, and invoice layouts.

---

## What You'll Learn

- How to create and manage tax rates
- How to set up group taxes
- How to configure invoice numbering
- How to design invoice layouts
- How to set up barcode labels

---

## Part 1: Tax Rates

### How to Add a Tax Rate

1. Go to **Settings → Tax Rates** from the left sidebar.
2. Click **Add** at the top right.
3. Fill in:
   - **Name** — A clear name (e.g., "VAT 20%", "GST 17%", "Sales Tax 5%")
   - **Rate (%)** — The percentage (e.g., 20)
4. Click **Save**.

📸 *[Screenshot: The Add Tax Rate form]*

### Group Tax Rates

If you need to apply multiple taxes together (e.g., CGST + SGST in India):

1. Go to **Settings → Tax Rates**.
2. Click **Add** and set the type to **Group**.
3. Give it a name (e.g., "GST 18%").
4. Select the individual tax rates that make up this group (e.g., "CGST 9%" + "SGST 9%").
5. Click **Save**.

When this group tax is applied, each component is calculated separately and shown on the invoice.

📸 *[Screenshot: A group tax rate with component taxes]*

### Applying Tax Rates

Taxes can be applied at several levels:

| Level | Where to Set It |
|---|---|
| **Default for all sales** | **Settings → Business Settings → Tax → Default Sales Tax** |
| **Default for all purchases** | **Settings → Business Settings → Tax → Default Purchase Tax** |
| **Per product** | When adding/editing a product, select the **Product Tax** |
| **Per transaction** | When creating a sale or purchase, change the tax on individual items |

---

## Part 2: Invoice Settings

### Invoice Schemes (Numbering)

Invoice schemes control how your invoice numbers are generated.

1. Go to **Settings → Invoice Settings**.
2. You'll see the **Invoice Schemes** section.
3. Click **Add** to create a new scheme.
4. Fill in:
   - **Name** — A name for this scheme (e.g., "Main Invoice")
   - **Prefix** — Text before the number (e.g., "INV-")
   - **Start Number** — Where to start counting (e.g., 1 or 1001)
   - **Number of Digits** — How many digits to show (e.g., 4 → INV-0001)
5. Click **Save**.
6. Click **Set as Default** to use this scheme automatically.

📸 *[Screenshot: The Invoice Schemes list with Add button]*

> 💡 **Tip:** You can have different invoice schemes for different locations or sale types.

### Invoice Layouts (Design)

Invoice layouts control how your printed invoices look.

1. Go to **Settings → Invoice Settings**.
2. Scroll to the **Invoice Layouts** section.
3. Click **Add** to create a new layout.
4. Configure:
   - **Layout Name** — e.g., "Standard Invoice", "Thermal Receipt"
   - **Design** — Choose a template style
   - **Header** — Business name, logo, and contact details
   - **Show/Hide Fields** — Choose which information appears:
     - Customer details, tax breakdown, shipping info, payment info
   - **Footer** — Add custom text at the bottom (e.g., "Thank you for your business!")
   - **Module Fields** — Additional fields for specific features
5. Click **Save**.

📸 *[Screenshot: The Invoice Layout editor with design options]*

---

## Part 3: Barcode Settings

Configure how product barcode labels are printed.

1. Go to **Settings → Barcode Settings**.
2. Click **Add** to create a new barcode format.
3. Fill in:
   - **Name** — e.g., "Standard Label", "Small Price Tag"
   - **Description** — What this format is used for
   - **Paper Size** — A4, Letter, or custom
   - **Stickers Per Sheet** — How many labels fit on one page
   - **Label Width & Height** — Size in inches
   - **Show Fields** — What to print on each label:
     - Product name, price, SKU, business name, barcode
4. Click **Save**.

📸 *[Screenshot: The Barcode Settings page with label size options]*

---

## Part 4: Receipt Printers

Set up thermal or network printers for printing receipts directly from the POS.

1. Go to **Settings → Receipt Printers**.
2. Click **Add** to set up a new printer.
3. Fill in:
   - **Printer Name** — A friendly name (e.g., "Counter Printer")
   - **Connection Type** — Network/IP or Windows shared
   - **IP Address / Path** — The printer's address
   - **Port** — Usually 9100 for network printers
   - **Character Per Line** — How wide the receipt is (usually 32 or 42)
4. Click **Save**.

📸 *[Screenshot: The Add Receipt Printer form]*

---

## Common Questions

**Q: Can I have different tax rates for different products?**
A: Yes! Set a default tax in Business Settings, but override it per product. The product's tax rate takes priority.

**Q: Can I change my invoice numbering later?**
A: Yes, but be careful — changing the start number may create gaps or duplicates. It's best to set it correctly from the beginning.

**Q: Can I have different invoice layouts for different locations?**
A: Yes! Each business location can use a different invoice layout and invoice scheme.

---

## Tips & Best Practices

- 📌 Set up all your tax rates **before** adding products — it saves time
- 📌 Use **group taxes** if your region requires showing tax components separately
- 📌 Customise your **invoice layout** with your logo and business details for a professional look
- 📌 Add a friendly message in the **invoice footer** (e.g., "Thank you for your business!")
- 📌 Test your **receipt printer** setup before going live