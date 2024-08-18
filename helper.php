<?php 
function logType($type, $msg)
{
    $padding = str_repeat(' ', max(0, 20 - strlen($type)));
    echo "\t\e[1;33m" . $type . "\e[0m" . $padding . ": \e[0;36m" . $msg . "\e[0m\n";
}

function logHelp($type, $msg)
{
    $colors = [
        'info' => '0;36',   
        'warning' => '1;33',
        'success' => '1;32',
        'danger' => '1;31', 
    ];
    $colorCode = $colors[$type] ?? '0'; // Màu mặc định (đen)
    $padding = str_repeat(' ', max(0, 20 - strlen($type)));
    echo "\e[{$colorCode}m" . strtoupper($type) . "\e[0m" . $padding . ": \e[0;37m" . $msg . "\e[0m\n";
}