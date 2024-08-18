<?php

namespace AsfyCode\Artisan;

use AsfyCode\Artisan\Command\{
    StartServer,
    MakeFileCommand,
    HandleRoute,
};
include __DIR__ . '/../helper.php';
class Artisan
{
    protected $commands = [];
    public function __construct(){
        $this->commands = [
            'make' => new MakeFileCommand(),
            'serve' => new StartServer(),
            'route' => new HandleRoute(),
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
                    $this->commands[$type]->handle(array_slice($argv, 2));
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