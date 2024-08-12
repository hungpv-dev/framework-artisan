<?php

// Đường dẫn tới thư mục gốc của dự án cài đặt package
$basePath = dirname(__DIR__,4);
// Tạo file artisan
$artisanFile = $basePath . '/artisan';
if (!file_exists($artisanFile)) {
    copy(__DIR__ . '/artisan', $artisanFile);
    echo "artisan file created.\n";
}
// // Tạo thư mục config nếu chưa tồn tại
$configDir = $basePath . '/config';
if (!file_exists($configDir)) {
    mkdir($configDir, 0755, true);
}

$configFile = $configDir . '/artisan.php';
if (!file_exists($configFile)) {
    copy(__DIR__ . '/config.php', $configFile);
    echo "config/artisan.php file created.\n";
}
