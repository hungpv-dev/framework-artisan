<?php

namespace AsfyCode\Artisan\Command;

class StartServer
{
    public function handle()
    {
        echo "Đang khởi động server PHP...\n";
        $output = shell_exec('php -S localhost:8000 > /dev/null 2>&1 &');
        if ($output === null) {
            logHelp('success', "Server PHP đã được khởi động tại http://localhost:8000");
        } else {
            logHelp('danger', "Không thể khởi động server PHP.");
        }
    }

   
}
