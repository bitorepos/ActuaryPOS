# [UPDATE GUIDE] Updating {application_name}

Use this guide when updating {application_name} to a newer release.

> **Important:** Always take a full backup before replacing files or running an update.

---

## Before You Update

Back up the following and keep the backup in a safe location:

- Database backup: export the database used by {application_name}.
- `public/uploads` folder.
- `.env` file.
- Translation files, if you added or customized languages:
  - `resources/lang/`
  - `public/js/lang/`

Do not continue until these backups are complete.

---

## Update Steps

1. Download or prepare the new release files.
2. Extract the new release package.
3. Replace the old application code in your project directory with the new code.
4. Make sure your existing `.env` file is still present. If it is missing, restore it from your backup.
5. Open the update URL in your browser:

   `https://yourdomain.com/install/update/`

6. Wait for the update process to finish. Do not close, refresh, or go back while the update is running.
7. After the update completes, the application should redirect to the login page or dashboard.
8. Check the footer or About page to confirm the latest application version is showing.
9. If required, restore or verify the `public/uploads` folder from your backup.
10. Test the main workflows before allowing users to continue daily work.

---

## If The Update Fails

If there is a problem during the update:

1. Do not keep retrying without checking the error.
2. Review the latest log file in `storage/logs`.
3. Confirm file permissions, PHP version, and database access.
4. If needed, restore the backed-up database and files.
5. Run the update again after fixing the cause.

---

## After A Successful Update

After a successful update, this URL should no longer run the updater:

`https://yourdomain.com/install/update/`

It may show a 404 page or no longer be available. This is expected after the update has completed.

---

## Additional Steps For API Or Connector Module

If your installation uses an API, Connector, or integration module, review that module after updating:

- Confirm the module is still enabled.
- Confirm API credentials and tokens are still present.
- Test one API request or integration sync.
- Check module-specific settings for new required fields.

---

## FAQ

**Q: Will skipping one or two updates cause errors?**

A: Usually, no. The updater is designed to update from older versions to newer versions. Still, always read the release notes and take a complete backup before updating.
