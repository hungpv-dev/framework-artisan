<?php

namespace AsfyCode\Artisan;

use AsfyCode\Artisan\Command\MakeFileCommand;

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