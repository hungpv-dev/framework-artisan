<?php
function logType($type, $msg)
{
    $padding = str_repeat(' ', max(0, 20 - strlen($type)));
    echo "\t\e[1;33m" . $type . "\e[0m" . $padding . ": \e[0;36m" . $msg . "\e[0m\n";
}

echo "\e[1;34mMake (Tạo)\e[0m\n";

logType("make:controller", "Tạo controller");
logType("make:model", "Tạo model");
logType("make:middleware", "Tạo middleware");
logType("make:trait", "Tạo trait");
