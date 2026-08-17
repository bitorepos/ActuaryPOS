# Removing `/public` From URL

{application_name} is built on Laravel. In Laravel applications, the server should ideally point to the `public` folder as the web document root. If the server is not configured this way, the URL may show `/public`.

---

## Enable URL Rewriting

If you are using Apache, make sure `mod_rewrite` is enabled.

If you are not sure how to enable it, contact your hosting provider or server administrator and ask them to enable Apache URL rewriting for your domain.

After enabling URL rewriting:

1. Confirm the `.htaccess` file exists.
2. Confirm the domain points to the correct application path.
3. Open the application without `/public` in the URL.

---

## Recommended Domain Setup

Avoid installing the application inside a subdirectory when possible.

Not recommended:

```text
www.example.com/pos
```

Recommended:

```text
pos.example.com
```

Recommended:

```text
example.com
```

---

## Best Server Configuration

For the cleanest URL, configure your domain or subdomain document root to point directly to:

```text
application-root/public
```

This keeps application files outside the public web path and removes the need to show `/public` in the browser URL.

---

## Update `APP_URL`

After fixing the URL, open `.env` and make sure `APP_URL` does not include `/public`.

Example:

```env
APP_URL=https://pos.example.com
```

Save the file and clear application cache if needed.
