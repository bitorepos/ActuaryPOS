# Backup & Data Safety

Your business data is valuable. The **Backup** feature in {application_name} lets you create copies of your entire database, download them, and even sync them to Google Drive for extra safety.

---

## What You'll Learn

- How to create a manual backup
- How to download and restore backups
- How to set up automatic backups
- How to connect Google Drive for cloud backup

---

## How to Create a Manual Backup

1. Go to **Backup** from the left sidebar.
2. You'll see a list of any existing backups.
3. Click the **Create Backup** button.
4. The system will create a copy of your entire database.
5. When finished, the new backup appears in the list with its date and file size.

📸 *[Screenshot: The Backup page with the Create Backup button and backup list]*

> 💡 **Tip:** Create a manual backup before making any major changes to your settings or data.

---

## How to Download a Backup

1. Go to **Backup** from the left sidebar.
2. Find the backup you want in the list.
3. Click the **Download** button next to it.
4. The backup file will download to your computer.
5. Store it in a safe place (external drive, cloud storage, etc.).

📸 *[Screenshot: The backup list with download button highlighted]*

---

## How to Delete Old Backups

1. Go to **Backup** from the left sidebar.
2. Find the backup you want to remove.
3. Click the **Delete** button next to it.
4. Confirm the deletion.

> ⚠️ **Important:** Only delete backups you no longer need. Keep at least 2–3 recent backups at all times.

---

## Google Drive Cloud Backup

For extra safety, you can sync your backups to **Google Drive** automatically.

### How to Set Up Google Drive Backup

1. Go to **Backup** from the left sidebar.
2. Look for the **Google Drive** section.
3. Click **Connect Google Drive** (or **Authorise**).
4. Sign in with your Google account.
5. Grant permission for {application_name} to access your Drive.
6. Once connected, you'll see a green "Connected" status.

📸 *[Screenshot: The Google Drive connection section with the Authorise button]*

### How to Sync a Backup to Google Drive

1. After connecting Google Drive, create a backup as before.
2. Click the **Sync to Google Drive** button next to the backup.
3. The backup will upload to your Google Drive.

📸 *[Screenshot: The sync button next to a backup entry]*

> 💡 **Tip:** Your administrator can enable **automatic sync** — every new backup is automatically sent to Google Drive.

---

## Automatic Backups

Your administrator can schedule automatic daily backups:

- Backups run at the time set in the system (default is 3:55 AM)
- The backup file is stored locally and optionally synced to Google Drive
- Old backups can be automatically cleaned up to save space

Ask your system administrator to set this up if it's not already running.

---

## Settings & Options

| Setting | What It Does | Where to Find It |
|---|---|---|
| **Backup Disk** | Where backup files are saved | System configuration |
| **Backup Time** | What time automatic backups run | System configuration |
| **Google Drive Sync** | Automatically upload new backups to Google Drive | Backup settings |

---

## Common Questions

**Q: How long does a backup take?**
A: Usually a few seconds to a couple of minutes, depending on how much data you have.

**Q: Can I restore from a backup?**
A: Yes, but restoring requires technical assistance. Contact your system administrator for help.

**Q: Does backup include uploaded files (photos, documents)?**
A: The standard backup includes your database (all transactions, settings, products, etc.). Uploaded files may need to be backed up separately.

**Q: How often should I back up?**
A: We recommend **daily backups**. Set up automatic backups so you don't have to remember.

---

## Tips & Best Practices

- 📌 **Back up every day** — even if you think nothing important changed
- 📌 **Download a copy** to your computer or external drive regularly
- 📌 **Connect Google Drive** for automatic cloud backup — two copies are better than one
- 📌 **Create a manual backup** before major changes (like bulk imports or settings changes)
- 📌 **Test your backups** periodically to make sure they can be restored