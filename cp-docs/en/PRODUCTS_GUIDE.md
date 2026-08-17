# Managing Your Products

Products are at the heart of your business — they're the items you buy, stock, and sell. This guide shows you how to add, edit, organise, and manage every aspect of your products in {application_name}.

---

## What You'll Learn

- How to add a single product
- How to add products with variations (sizes, colours, etc.)
- How to import products from a file
- How to organise products with categories and brands
- How to set up units of measurement
- How to manage pricing and tax
- How to print barcode labels
- How to add product notes with priority status
- How to track stock and expiry dates

---

## How to Add a New Product

1. Go to **Products → Add Product** from the left sidebar.
2. Fill in the details below.

### Basic Information

- **Product Name** — Enter a clear, descriptive name (e.g., "Organic Honey 500g")
- **SKU (Stock Code)** — A unique code for this product. Leave blank to auto-generate.
- **Barcode Type** — Choose the barcode format (C128, EAN13, etc.) or leave as default.

📸 *[Screenshot: The top section of the Add Product form with name and SKU fields]*

### Classification

- **Brand** — Select a brand or type a new one (e.g., "Nature's Best")
- **Category** — Choose a category (e.g., "Food & Beverages")
- **Sub-Category** — Choose a sub-category if applicable (e.g., "Honey")
- **Unit** — How the product is measured or sold (e.g., "Pieces", "Kg", "Bottle")

### Pricing

- **Purchase Price (Excluding Tax)** — What you pay your supplier for this item
- **Selling Price (Excluding Tax)** — What you charge your customers
- **Product Tax** — Choose a tax rate to apply (e.g., "VAT 20%")
- **Tax Type** — Whether the tax is included in the price or added on top:
  - **Inclusive** — The price already includes tax
  - **Exclusive** — Tax is added on top of the price

📸 *[Screenshot: The pricing section showing purchase price, selling price, and tax settings]*

> 💡 **Tip:** The system automatically calculates your profit margin when you enter both prices.

### Product Type

Choose how this product is structured:

| Type | When to Use It |
|---|---|
| **Single** | A simple product with one price (e.g., a bottle of water) |
| **Variable** | A product with variations like size or colour (e.g., T-shirt S/M/L/XL) |
| **Combo** | A bundle of multiple products sold together (e.g., a gift basket) |

3. Click **Save** at the bottom.

📸 *[Screenshot: The Save button at the bottom of the Add Product form]*

---

## How to Add a Product with Variations

Variations let you sell the same product in different sizes, colours, or options — each with its own price and stock level.

1. When adding a product, set **Product Type** to **Variable**.
2. Choose a **Variation Template** (e.g., "Size" or "Colour").
   - If you don't have one yet, create one under **Products → Variations**.
3. Enter the values for each variation:
   - **Variation Name** — e.g., "Small", "Medium", "Large"
   - **SKU** — Unique code for each variation
   - **Purchase Price** and **Selling Price** — Can be different for each variation
4. Click **Add More** to add additional variations.
5. Click **Save**.

📸 *[Screenshot: The variable product form showing size variations with different prices]*

---

## How to Import Products from a File

If you have many products to add, importing from a spreadsheet is much faster:

1. Go to **Products → Import Products**.
2. Click the **Download Template** link to get the correct file format.
3. Open the template and fill in your products — one row per product.
4. Save the file as **.csv** or **.xlsx**.
5. Back in {application_name}, click **Browse** and select your file.
6. Click **Submit** to start the import.
7. The system will tell you how many products were imported successfully.

📸 *[Screenshot: The Import Products page with file upload and template download link]*

> ⚠️ **Important:** Make sure your column names exactly match the template. Products with errors will be skipped.

---

## How to Edit a Product

1. Go to **Products → List Products**.
2. Find the product you want to change (use the search bar or filters).
3. Click the **Actions** button next to the product.
4. Select **Edit**.
5. Make your changes and click **Update**.

📸 *[Screenshot: The product list with the Actions dropdown showing Edit option]*

---

## How to Add Product Notes

Product Notes help staff record product-specific reminders, warnings, or handling instructions without changing the product master data.

1. Go to **Products → Products Note**.
2. Use the filters at the top if you want to review notes for one product or one priority status.
3. Click **Add**.
4. Select the **Product**.
5. Choose the **Priority Status**:
   - **Low** — General information
   - **Medium** — Normal reminder
   - **High** — Important note
   - **Urgent** — Critical product note
6. Enter the **Note** text.
7. Click **Save**.

After saving, the note appears in the Product Notes table with product name, SKU, priority, note text, creator, and created date.

### Managing Product Notes

- Use **Product** and **Priority Status** filters to review notes quickly.
- Use **Edit** to update a product note.
- Use **Delete** to remove an active note from the main list.
- Enable **Show Deleted** to review or restore deleted notes.

---

## How to Print Barcode Labels

1. Go to **Products → Print Labels**.
2. Search for the product(s) you want to print labels for.
3. Add them to the print list.
4. Choose:
   - **Barcode Setting** — The label size and format
   - **Number of Labels** — How many copies to print
5. Click **Preview** to see how they'll look.
6. Click **Print** to send to your printer.

📸 *[Screenshot: The Print Labels page with products selected and preview shown]*

---

## Organising Products

### Categories

Categories help you group similar products together (e.g., "Electronics", "Clothing", "Food").

1. Go to **Products → Categories**.
2. Click **Add** to create a new category.
3. Enter:
   - **Category Name** — e.g., "Electronics"
   - **Short Code** — A short abbreviation (e.g., "ELEC")
   - **Parent Category** — Leave blank for a main category, or select one to create a sub-category
4. Click **Save**.

📸 *[Screenshot: The Add Category popup with name and parent category fields]*

### Brands

Brands identify the manufacturer or maker of your products.

1. Go to **Products → Brands**.
2. Click **Add** to create a new brand.
3. Enter the **Brand Name** and save.
4. To create a sub-brand, enable **Add as sub taxonomy** and select a parent brand.

Notes:
- Parent brand appears as a main row.
- Sub-brand appears indented under the selected parent.
- Sub-brand cannot be assigned under another sub-brand.

📸 *[Screenshot: The Brands list with the Add button]*

### Gender

Gender helps you classify products for reporting and filtering.

1. Go to **Products → Gender**.
2. Click **Add** to create a new gender.
3. Enter the **Gender Name** and save.
4. To create a sub-gender, enable **Add as sub taxonomy** and select a parent gender.

Notes:
- Parent gender appears as a main row.
- Sub-gender appears indented under the selected parent.
- Sub-gender cannot be assigned under another sub-gender.

### Procurement Sources

Procurement Source helps track where products are procured from.

1. Go to **Products → Procurement Sources**.
2. Click **Add** to create a new source.
3. Enter the **Procurement Source Name** and save.
4. To create a sub-source, enable **Add as sub taxonomy** and select a parent source.

Notes:
- Parent source appears as a main row.
- Sub-source appears indented under the selected parent.
- Sub-source cannot be assigned under another sub-source.

### Selling Price Groups

If you sell the same product at different prices for different customer types (e.g., retail vs. wholesale):

1. Go to **Products → Selling Price Groups**.
2. Create groups like "Retail", "Wholesale", "Export".
3. Set different prices per product for each group.

📸 *[Screenshot: The Selling Price Groups page]*

---

## Units of Measurement

Units define how products are counted or measured.

1. Go to **Products → Units**.
2. Click **Add** to create a new unit.
3. Enter:
   - **Name** — e.g., "Kilogram"
   - **Short Name** — e.g., "Kg"
   - **Allow Decimal** — Turn on if this unit can have decimal quantities (e.g., 1.5 Kg)
4. Click **Save**.

### Sub-Units

Sub-units let you buy in one unit and sell in another (e.g., buy by the carton, sell by the piece):

1. Edit a unit or create a new one.
2. Set the **Base Unit** (e.g., "Carton").
3. Define the sub-unit and the conversion factor (e.g., "Piece = 1/24 of a Carton").

📸 *[Screenshot: The Units page showing a unit with sub-unit defined]*

---

## Stock & Inventory

### Checking Stock Levels

1. Go to **Reports → Stock Report**.
2. You'll see every product with:
   - **Current Stock** — How many you have right now
   - **Total Sold** — How many have been sold
   - **Total Purchased** — How many you've bought
3. Use the filters to view stock by location, category, or brand.

📸 *[Screenshot: The Stock Report showing product quantities]*

### Tracking Expiry Dates

If you sell perishable products (food, medicine, etc.):

1. Ask your administrator to enable **Track Expiry Dates** in **Settings → Business Settings → Product** tab.
2. When adding or purchasing products, you'll see an **Expiry Date** field.
3. The system will:
   - Alert you when products are nearing expiry
   - Optionally block sales of expired items

📸 *[Screenshot: The expiry date field on a product/purchase form]*

### Lot Numbers

For batch tracking:

1. Enable **Lot Numbers** in **Settings → Business Settings → Product** tab.
2. When making a purchase, enter the **Lot Number** for each batch.
3. You can track which lot number was sold to which customer.

---

## Product Settings & Options

| Setting | What It Does | Where to Find It |
|---|---|---|
| **SKU Prefix** | Adds a prefix to auto-generated SKU codes | **Settings → Business Settings → Product** |
| **Enable Categories** | Show/hide the Categories feature | **Settings → Business Settings → Product** |
| **Enable Brands** | Show/hide the Brands feature | **Settings → Business Settings → Product** |
| **Enable Product Expiry** | Track expiry dates on products | **Settings → Business Settings → Product** |
| **Enable Lot Number** | Track batch/lot numbers | **Settings → Business Settings → Product** |
| **Enable Warranty** | Add warranty information per product | **Settings → Business Settings → Product** |
| **Default Unit** | The unit automatically selected for new products | **Settings → Business Settings → Product** |

---

## Products Card Tab

### 1. Module Overview
The Products Card tab is an additional tab on the Products index page. It shows variable products in a storefront-style card layout with larger images, swatch-style variation cues, and quick actions.

### 2. Purpose of the Feature
This tab helps users review variable products faster by separating them from single/combo/package items and presenting image-first cards that make variation details easier to scan.

### 3. User Access / Permissions
- Users with Products view permission can open the tab and view variable products.
- Actions shown in each card (edit, delete, stock history, duplicate, etc.) still follow the same permission rules used in the main product list.

### 4. Step-by-Step Usage Instructions
1. Go to Products → List Products.
2. Click the Products Card tab (next to Product List).
3. Use the filter panel (location, category, brand, supplier, status, and others).
4. Review the variable-product metrics cards and search field at the top of the tab.
5. Check each product card for image, color swatches, size/options pills, stock, and selling price.
6. Use the action menu on a card to perform product operations.
6. Optionally click Download Variable Products to export variable product data.

### 5. Field Descriptions
| Field Label | Type | Description |
|---|---|---|
| Products Card | Tab | Opens the variable-only product card showcase |
| Filtered Variations | Metric card | Total filtered variable entries returned by current filters |
| Visible Cards | Metric card | Number of cards shown on the current showcase page |
| Display Mode | Metric card | Indicates the tab is forced to variable products only |
| Download Variable Products | Button | Downloads variable product Excel export |
| Search SKU or Name | Search field | Filters the current variable product card result set |
| Product Image | Card area | Shows the main image of the variable product variation |
| Color Swatches | Card area | Visual swatches generated from recognized variation color values |
| Sizes and Options | Card area | Pills generated from variation size or option text |
| Action Menu | Card control | Card-level operations based on user permission |
| SKU | Card detail | Variation SKU/sub-SKU |
| Category | Card detail | Product category |
| Brand | Card detail | Product brand |
| Selling Price | Card footer | Variation selling price |
| Stock | Card footer | Current stock quantity with unit |

### 6. Business Logic / Workflow
- The tab uses the same products data source as the main Product List.
- Product type is forced to variable for this tab, independent of the Product Type filter selection.
- Other active filters still apply (location, category, brand, supplier, stock visibility, deleted/deactivated, and related toggles).
- Variation text is parsed to separate color-like values into swatches and other values into option pills when possible.
- Search shortcuts from product search modal also target this tab's card showcase when available.

### 7. Notes or Important Considerations
- This tab does not replace Product List; it is a focused visual view for variable products.
- If no variable products match current filters, the card grid appears empty and summary cards show 0.
- Export/download behavior remains aligned with existing variable-product export functionality.

---

## Common Questions

**Q: Can I delete a product?**
A: You can only delete products that have no transactions (no sales or purchases). If a product has transactions, you can make it inactive instead.

**Q: How do I change a product's price?**
A: Edit the product and update the selling price. The new price applies to future sales only — past sales are not affected.

**Q: Can I have the same product at different prices for different customer groups?**
A: Yes! Use **Selling Price Groups** to set different prices for wholesale, retail, etc.

**Q: How do I track stock across multiple locations?**
A: Stock is automatically tracked per location. When you make a sale or purchase at a specific location, the stock updates for that location.

---

## Tips & Best Practices

- 📌 Use **categories** and **brands** to keep your product list organised
- 📌 Set a **reorder level** for each product to get alerts before you run out
- 📌 Use the **import feature** when adding many products at once
- 📌 Review the **Stock Report** weekly to spot slow-moving items
- 📌 Enable **expiry tracking** if you sell perishable goods
