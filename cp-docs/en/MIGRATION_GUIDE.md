# Transfer Data To New Domain & Changing Hosting

Use this guide when moving {application_name} to a new domain, new subdomain, or different hosting/server.

---

## Backup

Before starting any migration, take a complete backup.

Recommended backup items:

- Database export
- Full application codebase
- `public/uploads` folder
- `.env` file
- Any custom translation files or modified files

You can use the application backup feature if it is available, or create backups manually from your hosting panel, SSH, phpMyAdmin, database tool, or server control panel.

---

## Transferring To A New Domain

Use this when the hosting/server stays the same, but the domain changes.

Example:

- Old domain: `example1.com`
- New domain: `example2.com`

Steps:

1. Point the new domain or subdomain to the existing application codebase.
2. Confirm the new domain opens the correct server directory.
3. Open the `.env` file.
4. Change `APP_URL` to the new domain.

Example:

```env
APP_URL=https://example2.com
```

5. Save the `.env` file.
6. Clear application cache if needed.
7. Open the new domain in your browser and test login, dashboard, uploads, invoices, and receipts.

---

## Changing Hosting Or Moving To A Different Server

Use this when moving from one hosting/server to another.

### Move The Codebase

1. Zip or archive the existing {application_name} codebase from the old hosting.
2. Upload the archive to the new hosting/server.
3. Extract it in the correct document root.
4. Confirm file and folder permissions are correct.

### Move The Database

1. Export the database from the old hosting/server.
2. Create a new database on the new hosting/server.
3. Create or assign a database user.
4. Import the database backup into the new database.
5. Give the database user the required privileges.

### Update Configuration

1. Point the domain to the new hosting/server by updating DNS or nameservers.
2. Open the `.env` file on the new hosting/server.
3. Update database values:

```env
DB_HOST=your_database_host
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

4. Update `APP_URL` if the domain or URL changed.
5. Save the `.env` file.
6. Clear application cache if needed.
7. Test the migrated application.

---

## Migration Checklist

After migration, verify:

- Login works.
- Dashboard loads.
- Existing products, contacts, sales, and purchases are visible.
- Uploaded images/files load correctly.
- Invoice and receipt printing works.
- Email settings still work, if configured.
- Scheduled jobs/cron jobs are configured on the new server, if used.
- HTTPS/SSL is active on the new domain.

---

## Frequently Asked Questions

**Q: Can I use the same license after migrating to new hosting?**

A: In most cases, yes. If license verification fails after migration, confirm the license terms, domain settings, and server connectivity.

**Q: Can I use a new domain name?**

A: Yes. Update `APP_URL` in the `.env` file and make sure the new domain points to the correct application directory.
