<?php

echo "\e[1;34mMake (Tạo)\e[0m\n";

logType("make:controller", "Tạo controller");
logType("make:controller --a", "Tạo controller api resource");
logType("make:controller --r", "Tạo controller resource");
logType("make:model", "Tạo model");
logType("make:middleware", "Tạo middleware");
logType("make:trait", "Tạo trait");
logType("make:view", "Tạo view");

echo "\n";
echo "\e[1;34mServer (Chạy)\e[0m\n";
logType("serve", "Chạy server");
logType("serve --port=????", "Chạy server với port ????");
echo "\n";

echo "\e[1;34mRoute (Đường dẫn)\e[0m\n";
logType("route:list", "Xem danh sách route");
echo "\n";