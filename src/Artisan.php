<?php

namespace AsfyCode\Artisan;

use AsfyCode\Artisan\Command\MakeFileCommand;
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

class Artisan
{
    protected $commands = [];
    public function __construct(){
        $this->commands = [
            'make' => new MakeFileCommand(),
        ];   
    }
    public function run()
    {
        global $argv;
        if (isset($argv[1])) {
            $command = $argv[1];
            $action = explode(':', $command);
            $type = $action[0];
            if (isset($this->commands[$type])) {
                $function = $action[1] ?? NULL;
                if($function){
                    $this->commands[$type]->handle($function,array_slice($argv, 2));
                }else{
                    include __DIR__ . '/../help.php';
                    die();
                }
            } else {
                echo "Command không tồn tại: $command\n";
            }
        } else {
            include __DIR__ . '/../help.php';
            die();
        }
    }
}