<?php
// ioncube_callback.php

function get_system_mac_address()
{
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        $content = shell_exec('getmac');
        preg_match('/([0-9A-F]{2}[:-]){5}([0-9A-F]{2})/i', $content, $mac);
        return $mac[0] ?? 'Unknown MAC';
    } else {
        $ifconfig = shell_exec('/sbin/ifconfig -a 2>/dev/null || ifconfig -a 2>/dev/null');
        preg_match('/([0-9a-f]{2}[:-]){5}([0-9a-f]{2})/i', $ifconfig, $mac);
        if (!empty($mac[0])) {
            return strtoupper($mac[0]);
        }
        $ip = shell_exec('/sbin/ip link 2>/dev/null || ip link 2>/dev/null');
        preg_match('/([0-9a-f]{2}[:-]){5}([0-9a-f]{2})/i', $ip, $mac);
        return !empty($mac[0]) ? strtoupper($mac[0]) : 'Unknown MAC';
    }
}

function ioncube_event_handler($err_code, $params)
{
    // $err_code 3 means "License not found"
    // $err_code 4 means "Invalid license" (e.g., wrong MAC address, expired)

    $license_path = __DIR__ . DIRECTORY_SEPARATOR . 'client-license.txt';
    $license_file_missing = ! is_file($license_path);
    $license_header = '';
    if (! $license_file_missing) {
        $license_header = implode("\n", array_slice(file($license_path, FILE_IGNORE_NEW_LINES), 0, 8));
    }

    $html = '<div style="font-family: sans-serif; max-width: 760px; margin: 50px auto; padding: 30px; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-align: center;">';

    if ($err_code == 3 || ($license_file_missing && in_array((int) $err_code, [4, 6, 7, 11], true))) {
        $html .= '<h1 style="color: #e53e3e;">License File Required</h1>';
        $html .= '<p style="color: #4a5568; font-size: 16px;">The application cannot start because the required <strong>client-license.txt</strong> file is missing.</p>';
        $html .= '<p style="color: #4a5568; font-size: 16px;">Please place the valid <strong>client-license.txt</strong> file in the application root folder, then refresh this page.</p>';
        $html .= '<p style="color: #4a5568; font-size: 16px;">If you do not have a license file, please contact your application provider company to purchase a license or request license support. Include the Machine ID (MAC Address) shown below with your request.</p>';
    } elseif ($err_code == 4 || $err_code == 7) {
        $html .= '<h1 style="color: #e53e3e;">Invalid License</h1>';
        $html .= '<p style="color: #4a5568; font-size: 16px;">The license file provided is invalid or has been corrupted.</p>';
        $html .= '<p style="color: #283347; font-size: 16px;">Please contact support to generate a valid license for this hardware.</p>';
    } elseif ($err_code == 6 || $err_code == 11) {
        $current_domain = htmlspecialchars($_SERVER['HTTP_HOST'] ?? $_SERVER['SERVER_NAME'] ?? 'Unknown Domain');
        $html .= '<h1 style="color: #e53e3e;">Domain / Hardware Mismatch</h1>';
        $html .= '<p style="color: #4a5568; font-size: 16px;">This software is not authorized to run on this specific domain or server.</p>';
        $html .= '<p style="color: #4a5568; font-size: 16px;">You are currently accessing from: <strong style="color:#d97706;">' . $current_domain . '</strong></p>';
        $html .= '<p style="color: #4a5568; font-size: 16px;">If you have changed your domain or networking hardware, please contact support.</p>';
    } else {
        $html .= '<h1 style="color: #e53e3e;">System Error</h1>';
        $html .= '<p style="color: #4a5568; font-size: 16px;">A system error occurred. (Error Code: ' . htmlspecialchars($err_code) . ')</p>';
        if (!empty($params) && is_array($params)) {
            $html .= '<pre style="text-align:left; background:#f4f4f4; padding: 10px; font-size:12px;">' . htmlspecialchars(print_r($params, true)) . '</pre>';
        }
    }

    $mac_address = get_system_mac_address();
    $html .= '<div style="margin-top: 25px; padding: 15px; background: #f7fafc; border-radius: 6px; border: 1px dashed #cbd5e0;">';
    $html .= '<p style="color: #718096; font-size: 14px; margin-bottom: 5px; margin-top: 0;">Your Machine ID (MAC Address):</p>';
    $html .= '<code style="font-size: 18px; color: #2b6cb0; font-weight: bold;">' . htmlspecialchars($mac_address) . '</code>';
    $html .= '<p style="color: #718096; font-size: 12px; margin-top: 8px; margin-bottom: 0;">Send this Machine ID with your license request so your provider can issue a valid license for this hardware.</p>';
    $html .= '</div>';

    $html .= '</div>';

    if (isset($_GET['license_debug']) && $_GET['license_debug'] === '1') {
        $debug = [
            'ioncube_error_code' => $err_code,
            'ioncube_params' => $params,
            'callback_dir' => __DIR__,
            'current_working_dir' => getcwd(),
            'license_path_checked_by_callback' => $license_path,
            'license_file_exists' => ! $license_file_missing,
            'license_file_size' => $license_file_missing ? null : filesize($license_path),
            'license_file_modified' => $license_file_missing ? null : date('Y-m-d H:i:s', filemtime($license_path)),
            'license_header' => $license_header,
            'php_version' => PHP_VERSION,
            'php_sapi' => PHP_SAPI,
            'server_name' => $_SERVER['SERVER_NAME'] ?? null,
            'http_host' => $_SERVER['HTTP_HOST'] ?? null,
            'server_addr' => $_SERVER['SERVER_ADDR'] ?? null,
            'document_root' => $_SERVER['DOCUMENT_ROOT'] ?? null,
            'script_filename' => $_SERVER['SCRIPT_FILENAME'] ?? null,
            'request_uri' => $_SERVER['REQUEST_URI'] ?? null,
        ];

        $html .= '<details style="margin-top: 20px; text-align: left; font-size: 12px; color: #283347;" open>';
        $html .= '<summary style="cursor: pointer; font-weight: 700;">License diagnostics</summary>';
        $html .= '<pre style="white-space: pre-wrap; background: #f4f4f4; padding: 12px; border-radius: 6px; overflow:auto;">' . htmlspecialchars(print_r($debug, true)) . '</pre>';
        $html .= '</details>';
    }

    // Stop execution and output the beautiful HTML
    die($html);
}
?>
