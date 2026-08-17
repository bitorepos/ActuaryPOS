# [Troubleshooting ERROR] Invalid License

During installation, you may see an "Invalid license" or "Invalid purchase code" message even when the entered code looks correct. Use the checks below to troubleshoot the issue.

---

## Troubleshooting

1. Confirm the server is using the PHP version required by your current {application_name} release. For current installations, use PHP 8.1 or higher unless your release notes say otherwise.

2. On the installer's **Server Requirements** screen, make sure every requirement is marked as passed. If any item fails, enable the missing PHP extension or dependency and refresh the installer.

3. Check the license or purchase code carefully. Make sure there are no extra spaces before or after the code.

4. If installing on localhost, make sure the computer has an active internet connection during installation. The application can work offline after installation, but license verification may require internet access during setup.

5. Confirm the marketplace or license username exactly matches the original account username. Usernames can be case-sensitive.

6. Ask your hosting provider to confirm that outbound HTTPS traffic on port `443` is allowed. On a local computer, antivirus or firewall software can also block license verification, so temporarily adjust firewall settings and try again.

---

## If The Error Still Appears

1. Go to the application log folder:

   `storage/logs`

2. Delete old log files from that folder.

3. Run the installer again.

4. A new log file should be created with a name similar to:

   `laravel-YYYY-MM-DD.log`

5. Share that log file with your system administrator or support team for review.

> **Note:** Do not share your license code, database password, or other private credentials in public messages.
