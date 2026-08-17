# Installing {application_name}

This guide explains how to install {application_name} on a local computer or on a live hosting/server environment. Before starting, make sure you have the application files, database details, and server access ready.

---

## Server Requirements

Your server must support the required PHP version and extensions before installation can continue.

Required software and extensions:

- PHP 8.1 or higher
- OpenSSL PHP extension
- PDO PHP extension
- Mbstring PHP extension
- Tokenizer PHP extension
- XML PHP extension
- cURL PHP extension
- Zip PHP extension
- GD PHP extension
- MySQL or MariaDB database
- Apache or Nginx web server

If any requirement fails during the installer check, enable the missing extension or ask your hosting provider/server administrator to enable it.

---

## Server Recommendation

{application_name} can be installed on localhost for testing, training, or development.

For online use, a cloud server or VPS is recommended because it gives better control over PHP, database, file permissions, and server configuration. Shared hosting can also work if it supports the required PHP version, extensions, file permissions, and URL rewriting.

For best results, install the application on a main domain or subdomain such as:

- `https://yourdomain.com`
- `https://pos.yourdomain.com`

Avoid installing it inside deep subfolders when possible, such as:

- `https://yourdomain.com/folder/pos`

---

## Installing On Localhost

Use this method when installing on your own computer.

1. Install a local server package such as XAMPP, WAMP, Laragon, or another stack that includes Apache/Nginx, PHP, and MySQL.
2. Open the web root folder. For XAMPP this is usually `htdocs`; for Laragon it is usually `www`.
3. Copy the application codebase folder into the web root.
4. Rename the copied folder to a simple project name, for example `{application_name}`.
5. Open the installer in your browser:
   - `http://localhost/{application_name}/install`
   - `http://localhost/{application_name}/public/install`
6. Review the pre-installation check screen.
7. Fix any item marked as failed, then refresh the page.
8. When all checks pass, continue to the next step.
9. Follow the installer instructions and enter the required database, application, and administrator details.
10. After installation is complete, delete the `public/install` folder.

---

## Installing On Live Hosting

Use this method when installing on a production domain, subdomain, VPS, or shared hosting account.

1. Confirm that your domain or subdomain points to the correct document root.
2. Upload all application files and folders to the server document root.
3. Use FTP, SFTP, SSH, cPanel File Manager, DirectAdmin File Manager, or your hosting provider's file manager.
4. Open the installer in your browser:
   - `https://yourdomain.com/install`
   - `https://yourdomain.com/public/install`
5. Review the pre-installation check screen.
6. Fix any failed server requirement or permission issue.
7. Continue once all checks pass.
8. Follow the installer steps and enter database, email, app, and administrator details.
9. Wait for the installer to finish. Depending on the hosting, this can take a few minutes.
10. After installation is complete, delete the `public/install` folder.

> **Important:** Do not leave the install folder available after installation. Removing it helps protect the application from accidental or unauthorized re-installation attempts.

---

## Installer Flow

The installer normally follows this sequence:

1. Pre-installation server check
2. Environment and database details
3. Application settings
4. Database migration and setup
5. Administrator or owner account creation
6. Installation success confirmation

Keep these details ready before starting:

- Database host
- Database name
- Database username
- Database password
- Application URL
- Email configuration, if required
- Administrator name, email, username, and password

---

## Not Found After Next Step

If the installer opens but a "Not Found" error appears after clicking the next step, try opening one of these URLs:

- `https://yourdomain.com/public/install-start`
- `https://yourdomain.com/public/index.php/install-start`

If the `index.php` URL works but the clean URL does not, enable `mod_rewrite` on Apache or configure URL rewriting on your server.

---

## Common Installation Errors

### Syntax Error

If a syntax error appears, check the PHP version first. The server must use PHP 8.1 or higher.

### 500 Internal Server Error

A 500 error usually means the server configuration, permissions, or PHP setup needs attention.

Check the server error log. Common fixes include:

- Set the `public` folder permission to `755`.
- Set `public/index.php` permission to `755` or a secure file permission supported by your server.
- Confirm the required PHP extensions are enabled.
- Confirm the correct PHP version is selected for the domain.

### Images Or Uploaded Files Not Showing

If uploaded files or images do not show after installation, check:

- The `public/uploads` folder permission.
- The configured application URL.
- The storage link, if your installation uses Laravel storage links.
- Whether the domain is loading from the correct `public` folder.

### `mysqli_connect` Error

If an error mentions `mysqli_connect`, check:

- Database host, name, username, and password.
- The MySQL or MariaDB service is running.
- The PHP MySQL extension is enabled.
- The database user has permission to access the selected database.

### Access Denied For Database User

If the database returns an access denied error, give the database user the required privileges for the application database. On cPanel or similar hosting panels, assign the user to the database and grant all required permissions.

### There Is No Active Transaction

If this appears during an update and the update otherwise completes successfully, review the update result and application logs. In many cases, this message does not require reinstalling the application.

---

## Removing `/public` From URL

Sometimes the application may open as:

`https://yourdomain.com/public/login`

To remove `/public` from the visible URL:

1. Confirm `mod_rewrite` or equivalent URL rewriting is enabled.
2. Try opening the domain without `/public`.
3. Check the `.env` file and update `APP_URL` so it does not include `/public`.
4. Make sure the server document root points to the application's `public` folder where possible.

---

## Creating `.env` On Windows

Windows may show "You must type a file name" when creating a file named `.env`.

To create it manually:

1. Open File Explorer.
2. Create a new text file.
3. Rename it to `.env.`
4. Windows will save it as `.env`.

You can also copy `.env.example` and rename the copy to `.env`.

---

## `.env.example` Missing

If `.env.example` is missing:

- Re-extract the original downloaded application package.
- Enable "show hidden files" or "show dotfiles" in your operating system, cPanel, FTP client, or file manager.
- Avoid copying files from a location that hides dotfiles.

If the installer says the `.env` file was not created, create `.env` in the application root and continue the installation.

---

## After Installation

After installation:

1. Open {application_name}.
2. Register or create the first business, depending on your setup flow.
3. Enter business details such as name, address, currency, and contact information.
4. Configure tax, stock accounting, and business settings.
5. Create the owner/admin login details.
6. Log in using the username and password created during registration.
7. Delete the `public/install` folder if it still exists.
8. Review **Settings > Business Settings** before entering live data.

If your currency is missing, add or update currencies from the currency settings area before continuing daily operations.

---

## Installation Already Done

If the installer says installation is already complete, the application has likely detected an existing `.env` file.

Only remove or replace `.env` if you intentionally want to reinstall or connect the codebase to different database details. Be careful: changing `.env` can disconnect the application from its current database.
