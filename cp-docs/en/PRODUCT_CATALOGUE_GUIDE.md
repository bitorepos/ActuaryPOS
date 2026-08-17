# Product Catalogue Module — User Guide

## Table of Contents
1. [Overview](#1-overview)
2. [Key Features](#2-key-features)
3. [Getting Started](#3-getting-started)
4. [QR Code Generation](#4-qr-code-generation)
5. [Catalogue Settings](#5-catalogue-settings)
6. [Public Catalogue (Customer View)](#6-public-catalogue-customer-view)
7. [Product Search](#7-product-search)
8. [Shopping Cart & Ordering](#8-shopping-cart--ordering)
9. [Order Types & Customer Info](#9-order-types--customer-info)
10. [Table Selection (Restaurant)](#10-table-selection-restaurant)
11. [Analytics Dashboard](#11-analytics-dashboard)
12. [Order Notes](#12-order-notes)
13. [Announcement Banner](#13-announcement-banner)
14. [Social Sharing & WhatsApp](#14-social-sharing--whatsapp)
15. [Appearance & Branding](#15-appearance--branding)
16. [Permissions & Roles](#16-permissions--roles)
17. [Notifications](#17-notifications)
18. [Best Practices](#18-best-practices)
19. [Troubleshooting](#19-troubleshooting)
20. [FAQ](#20-faq)

---

## 1. Overview

The **Product Catalogue** module turns your BitorePOS product inventory into a beautiful, customer-facing digital catalogue accessible via a simple QR code scan. Customers browse products, view details, add items to cart, and place orders directly from their smartphones — no app installation required.

**Use Cases:**
- **Restaurants & Cafés** — Digital menus with table-specific QR codes
- **Retail Stores** — Product showcase for in-store or window display
- **Food Trucks & Pop-ups** — Quick contactless ordering
- **Wholesale** — Share product catalogue links with B2B customers
- **Events & Exhibitions** — Temporary product displays with QR ordering

---

## 2. Key Features

| Feature | Description |
|---------|-------------|
| **QR Code Generator** | Generate customisable QR codes per location and per table |
| **Responsive Catalogue** | Mobile-first product grid with category navigation |
| **Shopping Cart** | Easy cart with quantity management — items stay saved even if customers refresh the page |
| **QR Ordering** | Customers place orders → new orders appear on your screen automatically |
| **Table Billing** | Link QR codes to restaurant tables for dine-in ordering |
| **Product Search** | Instant product search within the catalogue |
| **Analytics Dashboard** | Track page views, product views, add-to-cart, orders, conversion rate |
| **Order Notes** | Capture customer name, phone, special instructions, order type |
| **Announcement Banner** | Display promotions or alerts on the catalogue |
| **Branding Controls** | Customise colours, logo, title, product display options |
| **Social Sharing** | Share catalogue via WhatsApp, Facebook, Twitter, or copy link |
| **Stock Awareness** | Automatically shows out-of-stock badges; optionally hide OOS products |
| **Multi-location** | Separate catalogues per business location |
| **Discount Display** | Brand/category discounts shown as badges on products |
| **Notification** | Staff receive real-time notifications when QR orders are placed |

---

## 3. Getting Started

### Prerequisites
- BitorePOS installed and configured
- At least one business location created
- Products added to inventory with images and prices
- Product Catalogue module installed and activated

### Quick Setup (5 Minutes)
1. **Navigate to:** Sidebar → **Product Catalogue** → **Generate QR**
2. Select your **Business Location**
3. (Optional) Select a **Table** if using restaurant tables
4. Click **Generate QR Code**
5. Download the QR image and print/display it
6. Done! Customers can scan and browse immediately

---

## 4. QR Code Generation

### How to Generate
1. Go to **Product Catalogue → Generate QR**
2. **Select Location** — Choose the business location (products shown will match this location)
3. **Select Table** (if tables are enabled) — Each table gets a unique QR code with table auto-linked
4. **QR Code Color** — Pick a colour using the colour picker
5. **Title** — Defaults to your business name; customise as needed
6. **Subtitle** — Auto-fills with table name if selected; or add custom text
7. **Show Logo** — Check to embed your business logo in the QR code centre
8. Click **Generate QR Code**

### Download & Share
- Click **Download Image** to save as PNG
- Print QR codes on table tents, receipts, flyers, or stickers
- QR links can also be shared digitally via messaging apps

### Per-Table QR Codes
When the Restaurant/Tables module is enabled:
- Each table gets its own unique QR code
- Orders placed via table QR are automatically linked to that table
- Kitchen staff can see which table the order belongs to

---

## 5. Catalogue Settings

Navigate to **Product Catalogue → Settings** to configure the full catalogue behaviour.

### General Settings
| Setting | Description |
|---------|-------------|
| **Catalogue Title** | Custom title shown on the catalogue page |
| **Catalogue Description** | Brief text displayed below the title |
| **Out of Stock Products** | Show or Hide — hide removes OOS items from catalogue entirely |
| **Show SKU** | Toggle SKU display on product cards |
| **Show Description** | Toggle product description visibility |
| **Products Per Row** | 2, 3, 4, or 6 columns on desktop |

### Ordering Features
| Setting | Description |
|---------|-------------|
| **Enable QR Ordering** | Turn on/off the ability for customers to place orders |
| **Collect Customer Info** | When enabled, checkout asks for name and phone |
| **Enable Search** | Show/hide the search bar on the catalogue |

### Social & Sharing
| Setting | Description |
|---------|-------------|
| **Social Share Buttons** | Enable WhatsApp, Facebook, Twitter share buttons |
| **WhatsApp Number** | Your business WhatsApp number for direct ordering |

### Announcement Banner
| Setting | Description |
|---------|-------------|
| **Enable Announcement** | Toggle the banner on/off |
| **Announcement Text** | e.g. "Free delivery on orders over $50!" |

---

## 6. Public Catalogue (Customer View)

When customers scan the QR code, they are taken to your catalogue page automatically.

### What Customers See
1. **Hero Header** — Business logo, name, location name, and address
2. **Category Navbar** — Sticky navigation with horizontal category tabs
3. **Product Grid** — Cards showing image, name, price, SKU, and Add to Cart
4. **Discount Badges** — Percentage badges for active brand/category discounts
5. **Out of Stock Badges** — Visual OOS indicator on unavailable items
6. **Floating Cart Button** — Shows item count and running total
7. **Announcement Banner** — Promotional text (when enabled)

### Product Detail Modal
Click any product to see:
- Full-size product image
- Price (including tax)
- SKU, category, sub-category, brand
- Custom fields
- Product description
- Variable product options with per-variation images
- Combo product components
- Add to Cart button

---

## 7. Product Search

When enabled in settings, customers see a search bar above the product grid.

- **Minimum 2 characters** to trigger search
- Searches product **name** and **SKU**
- Returns up to 20 matching products
- Respects out-of-stock visibility settings
- Results include image, name, price, and Add to Cart action

---

## 8. Shopping Cart & Ordering

### Adding Items
- Click **Add to Cart** on any single/combo product
- For variable products, click **View Options** → select variation → Add
- Cart items are saved automatically (they remain even if the customer refreshes the page)

### Cart Management
- **Floating button** (bottom-right) shows count and total
- Click to open **Cart Modal**:
  - See all items with quantities
  - Increment/decrement quantities with +/- buttons
  - Remove items with × button
  - Running total updates in real-time

### Placing an Order
1. Review items in cart modal
2. (If required) Enter customer name, phone, special instructions
3. Click **Place Order**
4. System creates a **Draft sell transaction**
5. Stock is automatically decreased
6. Staff receive real-time notification
7. Cart clears automatically on success

---

## 9. Order Types & Customer Info

When **Collect Customer Info** is enabled in settings:

| Field | Description |
|-------|-------------|
| **Customer Name** | Optional name field |
| **Customer Phone** | Optional phone number |
| **Order Type** | Dine In, Takeaway, or Delivery |
| **Special Instructions** | Free-text notes (e.g. "No onions, extra sauce") |

This data is saved to the **Order Notes** section for staff to review.

---

## 10. Table Selection (Restaurant)

When BitorePOS restaurant tables module is enabled:

1. QR Generation page shows a **Table** dropdown
2. Each table gets its own unique QR code
3. Customer scans table QR → table is automatically detected
4. Order is linked to that specific table
5. Table status shows as occupied after order placement
6. Staff can see table assignments in order notifications

### Table Status
- **Free** — No active draft/final orders
- **Occupied** — Has pending orders (not yet served)

---

## 11. Analytics Dashboard

Navigate to **Product Catalogue → Analytics** to see performance data.

### KPI Cards
| Metric | Description |
|--------|-------------|
| **Page Views** | Total catalogue page loads |
| **Unique Visitors** | Distinct sessions |
| **Product Views** | Times product detail modals were opened |
| **Add to Cart** | Times Add to Cart was clicked |
| **Orders Placed** | Completed QR orders |
| **Conversion Rate** | Orders ÷ Page Views × 100 |

### Filters
- **Business Location** — Filter by specific location or view all
- **Date Range** — Custom from/to date selection

### Charts & Tables
- **Daily Page Views** — Line chart showing traffic over time
- **Top 10 Viewed Products** — Ranked table of most popular products

### What Gets Tracked Automatically
The system automatically records the following actions for your analytics:
- When the catalogue page is opened
- When a customer views a product's details
- When a customer adds an item to their cart
- When an order is placed
- When a QR code is scanned

---

## 12. Order Notes

Navigate to **Product Catalogue → Order Notes** to review customer-submitted information.

### Table Columns
| Column | Description |
|--------|-------------|
| **Invoice / Ref** | Linked transaction reference number |
| **Customer Name** | Name provided by customer |
| **Customer Phone** | Phone number provided |
| **Order Type** | Dine In / Takeaway / Delivery badge |
| **Special Instructions** | Customer's notes |
| **Total** | Order amount |
| **Status** | Transaction status (draft/final) |
| **Date** | When the order was placed |

Orders display 25 per page with pagination.

---

## 13. Announcement Banner

Use the announcement feature to communicate with catalogue visitors:

### Examples
- "🎉 Happy Hour — 20% off all beverages until 6 PM!"
- "📦 Free delivery on orders above $50"
- "⚠️ Kitchen closes at 10 PM"
- "🆕 Try our new seasonal menu items!"

### Setup
1. Go to **Catalogue Settings**
2. Enable **Show Announcement on Catalogue**
3. Enter your **Announcement Text**
4. Save

The banner appears at the top of the customer catalogue page.

---

## 14. Social Sharing & WhatsApp

### Social Share Buttons
When enabled, customers see share icons on the catalogue:
- **WhatsApp** — Opens WhatsApp with catalogue link
- **Facebook** — Share to Facebook
- **Twitter** — Tweet the catalogue link
- **Copy Link** — Copies URL to clipboard

### WhatsApp Ordering
Enter your WhatsApp business number in settings (with country code). Customers can:
- Tap WhatsApp button to open a chat with your business
- Share the catalogue with friends/family

---

## 15. Appearance & Branding

### Customisable Elements
| Element | Control |
|---------|---------|
| **Header Gradient** | Primary + Secondary colour |
| **Category Bar** | Follows primary colour |
| **Product Cards** | Clean white with shadow |
| **Add to Cart Button** | Uses primary colour gradient |
| **Discount Badge** | Gold/amber gradient |
| **Cart FAB Button** | Green gradient |
| **QR Code** | Custom colour selection |

### Logo Display
- Logo appears in catalogue header
- Can be embedded in QR center
- Shown in category navigation bar

### Mobile Responsive
The catalogue is fully responsive:
- **Desktop** — 4 products per row (configurable)
- **Tablet** — 3 products per row
- **Mobile** — 2 products per row
- Floating cart button spans full width on mobile

---

## 16. Permissions & Roles

### Available Permissions

| Permission | Description |
|-----------|-------------|
| **Catalogue Settings** | Access to configure catalogue settings |
| **Catalogue Analytics** | View analytics dashboard |
| **Catalogue Order Notes** | View customer order notes |

### Assigning Permissions
1. Go to **User Management → Roles**
2. Edit a role
3. Under module permissions, find **Product Catalogue**
4. Toggle desired permissions
5. Save

**Note:** The catalogue public pages (customer-facing) do not require any authentication. Only the admin sections (QR generation, settings, analytics, order notes) require login.

---

## 17. Notifications

### QR Order Notification
When a customer places an order through the catalogue:
1. All users of the business receive a database notification
2. Notification shows:
   - "New QR order draft received"
   - Table name (if applicable)
   - Invoice/reference number
3. Clicking the notification goes to the **Drafts** page
4. Staff can then finalize the order

### Notification Example
You will see a message like: "New QR order received — Table 5 (INV-001234)"

---

## 18. Best Practices

### Product Setup
- ✅ Add high-quality product images (400×400px minimum)
- ✅ Write clear, concise product names
- ✅ Set accurate prices including tax
- ✅ Categorise all products for easy navigation
- ✅ Keep stock levels updated for accurate availability
- ✅ Add product descriptions for detail view

### QR Code Placement
- ✅ Print on table tents for restaurants
- ✅ Add to receipts for repeat customers
- ✅ Display on storefront windows
- ✅ Include in marketing materials and social media
- ✅ Use per-table QR codes for table service

### Ordering Workflow
- ✅ Process QR orders promptly from the Drafts section
- ✅ Enable notifications for all staff
- ✅ Review Order Notes for special instructions
- ✅ Regularly check Analytics for insights
- ✅ Finalize draft orders to update stock

### Performance
- ✅ Monitor conversion rate in Analytics
- ✅ Track top-viewed products to inform promotions
- ✅ Use Announcement Banner for time-sensitive offers
- ✅ Update catalogue settings seasonally

---

## 19. Troubleshooting

### QR Code Not Working
| Issue | Solution |
|-------|----------|
| QR code not scanning | Ensure sufficient contrast between QR colour and background |
| QR leads to error page | Verify the business location exists and has products |
| QR shows wrong products | Check that products are assigned to the correct location |

### Ordering Issues
| Issue | Solution |
|-------|----------|
| "Product not available" error | Product may be inactive, not for selling, or not assigned to location |
| "Walk-in customer not configured" | Create a Walk-in customer in Contacts |
| Stock quantity errors | Check stock levels in inventory management |
| Order not appearing | Check Drafts section; verify staff notifications are enabled |

### Display Issues
| Issue | Solution |
|-------|----------|
| No products showing | Verify products exist at the selected location |
| Out of stock showing | Enable stock management or update stock quantities |
| Images not loading | Ensure product images are uploaded and accessible |
| Styles broken | Contact your system administrator to refresh the module files |

### Settings Not Saving
| Issue | Solution |
|-------|----------|
| Permission denied | Ensure the user's role has the **Catalogue Settings** permission enabled |
| Settings reverting | Clear browser cache and try again |
| System error | Contact your system administrator to check the error logs |

---

## 20. FAQ

**Q: Can customers pay through the catalogue?**
A: Currently, the catalogue creates draft orders. Payment is handled when staff finalize the order through the POS. Online payment integration is planned for future versions.

**Q: Can I use this without restaurant tables?**
A: Absolutely! The table feature is optional. You can generate simple location-based QR codes without any table selection.

**Q: Does the catalogue work offline?**
A: The cart uses localStorage and persists between visits. However, browsing products and placing orders requires an internet connection.

**Q: Can I have different catalogues for different locations?**
A: Yes! Each QR code is location-specific. Products, prices, and stock levels are filtered per location.

**Q: How do customers know their order was placed?**
A: After clicking Place Order, a success message is displayed. Staff receive a real-time notification and can confirm via the Drafts page.

**Q: Can I customize the catalogue design beyond color settings?**
A: The settings page covers the most common branding needs (colours, logo, layout). For further customisation, contact your system administrator.

**Q: Is the catalogue SEO-friendly?**
A: The catalogue pages include proper HTML structure, meta titles, and responsive design. For better SEO, consider adding meta descriptions in the catalogue settings.

**Q: How do I track which QR code performs best?**
A: The Analytics dashboard shows views per location. Generate per-table QR codes to track specific placement performance.

**Q: Can I disable ordering and use it as a view-only catalogue?**
A: Yes! Disable "Enable QR Ordering" in settings. The Add to Cart buttons and cart will be hidden. Customers can still browse products.

**Q: What happens if a product goes out of stock while it's in someone's cart?**
A: When the order is placed, the system validates stock availability. If insufficient stock is available, an error message lists the affected products and the order is not placed.

---

*Last updated: June 2025*
