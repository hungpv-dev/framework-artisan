<?php

namespace AsfyCode\Artisan\Command;

class StartServer
{
    public function handle()
    {
        echo "Đang khởi động server PHP...\n";

        $command = 'php -S localhost:8000';
        $descriptorspec = [
            0 => ["pipe", "r"],
            1 => ["pipe", "w"],
            2 => ["pipe", "w"]
        ];

        $process = proc_open($command, $descriptorspec, $pipes);

        if (is_resource($process)) {
            // Lệnh đã chạy, thông báo thành công
            logHelp('success', "Server PHP đã được khởi động tại http://localhost:8000");

            // Đọc và hiển thị log của server nếu cần
            while (!feof($pipes[1])) {
                echo fgets($pipes[1]);
            }

            // Đóng các pipe sau khi hoàn thành
            fclose($pipes[0]);
            fclose($pipes[1]);
            fclose($pipes[2]);

            // Đợi quá trình kết thúc
            proc_close($process);
        } else {
            logHelp('danger', "Không thể khởi động server PHP.");
        }
    }
}
