-- =====================================================================
-- Fix: products not appearing in purchase / sell search at newly added
--      business locations even though the Product Index "Business
--      Location" column shows the location.
--
-- Root cause: When a product is assigned to extra business locations
-- through the Excel import (column 49) the code only writes the pivot
-- table `product_locations` and never seeds `variation_location_details`
-- (VLD). The product search joins VLD per location, so without a VLD
-- row the variation does not surface for that location until the
-- product is opened in Edit and saved (which does seed VLD).
--
-- This script does two things on the `yousafs` database:
--   1. Assigns every product to every (non-deleted) business location
--      that belongs to the same business.
--   2. Seeds a 0-quantity VLD row for every variation × assigned
--      location pair that is missing.
--
-- Safe to re-run: both inserts use NOT EXISTS / LEFT JOIN guards so
-- no duplicate rows are created and existing qty_available values
-- are preserved.
--
-- Usage (Laragon shell or HeidiSQL / phpMyAdmin):
--   USE yousafs;
--   SOURCE d:/laragon/www/BitorePOS502/cp-docs/fix-product-all-locations-yousafs.sql;
-- =====================================================================

USE yousafs;

START TRANSACTION;

-- 1) Assign every product to every business location of its business.
INSERT INTO product_locations (product_id, location_id)
SELECT p.id, bl.id
FROM products p
JOIN business_locations bl
  ON bl.business_id = p.business_id
 AND bl.deleted_at IS NULL
LEFT JOIN product_locations pl
  ON pl.product_id  = p.id
 AND pl.location_id = bl.id
WHERE p.deleted_at IS NULL
  AND pl.product_id IS NULL;

-- 2) Seed variation_location_details rows so every variation is
--    searchable at every assigned location even when no stock has
--    been recorded there yet.
INSERT INTO variation_location_details
    (product_id, product_variation_id, variation_id, location_id,
     qty_available, created_at, updated_at)
SELECT v.product_id,
       v.product_variation_id,
       v.id,
       pl.location_id,
       0,
       NOW(),
       NOW()
FROM variations v
JOIN product_locations pl
  ON pl.product_id = v.product_id
LEFT JOIN variation_location_details vld
  ON vld.variation_id = v.id
 AND vld.location_id  = pl.location_id
 AND vld.deleted_at   IS NULL
WHERE v.deleted_at IS NULL
  AND vld.id IS NULL;

COMMIT;

-- Verification queries (optional)
-- SELECT COUNT(*) AS total_product_location_rows FROM product_locations;
-- SELECT COUNT(*) AS total_vld_rows FROM variation_location_details WHERE deleted_at IS NULL;
-- SELECT p.id, p.name,
--        (SELECT COUNT(*) FROM product_locations pl WHERE pl.product_id = p.id) AS locations,
--        (SELECT COUNT(DISTINCT vld.location_id)
--           FROM variation_location_details vld
--           JOIN variations v ON v.id = vld.variation_id
--          WHERE v.product_id = p.id AND vld.deleted_at IS NULL) AS vld_locations
-- FROM products p
-- WHERE p.deleted_at IS NULL
-- HAVING locations <> vld_locations;
