# Enabling HTTPS Or SSL For {application_name}

Use HTTPS to secure traffic between users and {application_name}. Before forcing HTTPS in the application, make sure a valid SSL certificate is already installed for your domain or subdomain.

---

## Before You Start

1. Confirm the SSL certificate is installed on the server.
2. Open your domain using HTTPS:

   `https://yourdomain.com`

3. Confirm the browser shows the secure lock symbol.
4. Continue only after HTTPS works directly.

If HTTPS does not open correctly, fix the SSL certificate first through your hosting panel, server control panel, or hosting provider.

---

## Force HTTPS Redirect

If your installation uses Apache and the application root contains a `.htaccess` file, you can force all HTTP requests to HTTPS.

1. Open the `.htaccess` file in the application codebase.
2. Back up the existing `.htaccess` content before changing it.
3. Add the HTTPS redirect rules above the public-folder rewrite rule.

Example:

```apache
RewriteEngine On

RewriteCond %{HTTPS} !=on
RewriteRule ^ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]

RewriteRule ^(.*)$ public/$1 [L]
```

4. Save the file.
5. Open the `.env` file.
6. Update `APP_URL` so it uses `https`.

Example:

```env
APP_URL=https://yourdomain.com
```

7. Clear application/browser cache if needed.
8. Open the application again and confirm it redirects to HTTPS.

---

## Notes

- Use your real domain or subdomain in `APP_URL`.
- Do not force HTTPS until the SSL certificate is working.
- If your server points directly to the `public` folder, the rewrite rules may be different.
- If you use Nginx, configure HTTPS redirects in the Nginx server block instead of `.htaccess`.
