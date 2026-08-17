# Applying Patch

Patches are small code updates used to fix a specific issue without performing a full version update. Apply a patch only when it matches your installed version or when your support/admin team confirms it is required.

---

## When To Apply A Patch

Apply a patch when:

- {application_name} is already installed.
- Your installed version matches the patch instructions.
- A patch was released after your current version was installed.
- The patch is meant to fix an issue affecting your installation.

You usually do not need to apply an older patch during a fresh installation if the latest full application package already includes that fix.

---

## Before Applying A Patch

Back up the following before replacing any file:

- Database
- `.env` file
- `public/uploads` folder
- Any file mentioned in the patch instructions

---

## Steps

1. Download or receive the patch package from your official update/support source.
2. Extract the patch package.
3. Open the patch folder. It may be named something like:
   - `Patch-VERSION`
   - `Patch-FEATURE-NAME`
4. Look for a `README.txt` or instruction file inside the patch folder.
5. Follow the instructions exactly.
6. If the patch says to replace a file, replace only the listed file.
7. If the patch says to create a new file, create it in the exact path shown.
8. Clear application/cache files if the patch instructions require it.
9. Test the affected feature after applying the patch.

> **Important:** Do not blindly copy the whole patch folder into the application root unless the patch instructions specifically say to do that.
