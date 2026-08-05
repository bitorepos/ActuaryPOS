<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verify Your Email Address</title>
</head>
<body style="margin:0; padding:0; background:#f3f4f6; font-family:Arial, Helvetica, sans-serif; color:#111827;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#f3f4f6; padding:32px 12px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width:560px; background:#ffffff; border-radius:12px; overflow:hidden;">
                    <tr>
                        <td align="center" style="padding:28px 24px; border-bottom:1px solid #e5e7eb;">
                            <h1 style="margin:0; font-size:24px; line-height:1.3; color:#111827;"><?php echo e(config('app.name', 'BitorePOS'), false); ?></h1>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding:34px 34px 26px;">
                            <div style="width:64px; height:64px; border-radius:50%; background:#dbeafe; color:#0ea5e9; line-height:64px; font-size:30px; margin:0 auto 24px;">&#9993;</div>
                            <h2 style="margin:0 0 16px; font-size:22px; line-height:1.35; color:#111827;">Verify Your Email Address</h2>
                            <p style="margin:0 0 24px; font-size:15px; line-height:1.7; color:#374151;">
                                Welcome to <?php echo e(config('app.name', 'BitorePOS'), false); ?>! Please confirm your email address by clicking the button below.
                            </p>
                            <a href="<?php echo e($verificationUrl, false); ?>" style="display:inline-block; background:#2563eb; color:#ffffff; text-decoration:none; font-size:15px; font-weight:700; padding:14px 30px; border-radius:8px;">Confirm Email</a>
                            <p style="margin:26px 0 0; font-size:13px; line-height:1.6; color:#64748b;">
                                This link will expire in 24 hours. If you didn't create an account, you can safely ignore this email.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:24px 34px; border-top:1px solid #e5e7eb;">
                            <p style="margin:0 0 10px; font-size:12px; line-height:1.5; color:#94a3b8; text-align:center;">
                                If the button doesn't work, copy and paste this link into your browser:
                            </p>
                            <p style="margin:0; font-size:12px; line-height:1.6; text-align:center; word-break:break-all;">
                                <a href="<?php echo e($verificationUrl, false); ?>" style="color:#2563eb;"><?php echo e($verificationUrl, false); ?></a>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding:22px 24px; background:#f8fafc; color:#94a3b8; font-size:12px; line-height:1.6;">
                            &copy; <?php echo e(date('Y'), false); ?> <?php echo e(config('app.name', 'BitorePOS'), false); ?><br>
                            Manage your fuel station efficiently
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
