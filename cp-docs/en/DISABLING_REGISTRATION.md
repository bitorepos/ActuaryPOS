# Disabling Registration In {application_name}

{application_name} can allow new business registration when registration is enabled. In some installations, you may want to disable public registration so outside users cannot create businesses without approval.

---

## Using Superadmin Settings

Use this method if the Superadmin module/settings are available.

1. Log in as Superadmin.
2. Go to **Superadmin > Settings > Application Settings**.
3. Find the **Allow Registration** option.
4. Uncheck **Allow Registration**.
5. Click **Update** or **Save**.

After this, the registration link/page should no longer be available for public users.

---

## Using The `.env` File

Use this method if you need to change registration from the application configuration file.

1. Open the `.env` file in the application root.
2. Find this setting:

```env
ALLOW_REGISTRATION=true
```

3. Change it to:

```env
ALLOW_REGISTRATION=false
```

4. Save the `.env` file.
5. Clear application cache if needed.
6. Refresh the browser and confirm the registration page/link is no longer available.

To enable registration again, change it back to:

```env
ALLOW_REGISTRATION=true
```

---

## If You Cannot See `.env`

The `.env` file is hidden on many systems because it starts with a dot.

If you are using cPanel or a hosting file manager:

1. Open **File Manager**.
2. Enable **Show Hidden Files** or **Show Dotfiles**.
3. Open the application root folder again.
4. Edit `.env`, not `.env.example`.

---

## Disposable Email Validation

If disposable email validation is enabled during business registration, review the registration and email validation settings from Superadmin or the related configuration area before enabling public registrations.
