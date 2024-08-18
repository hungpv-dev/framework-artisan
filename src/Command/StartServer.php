<?php

namespace AsfyCode\Artisan\Command;

class StartServer
{
    public function handle($args)
    {
        $port = 8000;
        if(!empty($args)){
            if(preg_match('/--port=(\d+)/', $args[0], $matches)){
                $port = $matches[1];
            }
        }
        function isPortAvailable($port) {
            $connection = @fsockopen('localhost', $port, $errno, $errstr, 2);
            if (is_resource($connection)) {
                fclose($connection);
                return false;
            }
            return true;
        }
        if (isPortAvailable($port)) {
            $command = "php -S localhost:$port";
            logHelp('success', "Server PHP đã được khởi động tại \e[1;34mhttp://localhost:$port\e[0m\n");
            exec($command);
        } else {
            logHelp('danger', "Cổng $port đã được sử dụng. Vui lòng chọn cổng khác bằng tham số \e[32m--port=????\e[0m");
        }
    }
}
