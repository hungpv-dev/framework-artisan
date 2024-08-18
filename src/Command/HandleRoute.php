<?php

namespace AsfyCode\Artisan\Command;

use App\Providers\RouteServiceProvider;
use App\Utils\Route;

class HandleRoute
{
    public function handle($type, $args)
    {
        $this->$type($args);
    }

    public function list($args)
    {

        $routeServiceProvider = new RouteServiceProvider();
        $routeServiceProvider->boot();
        $routes = Route::$routes;

        define('RESET', "\033[0m");
        define('BOLD', "\033[1m");
        define('UNDERLINE', "\033[4m");
        define('BLACK', "\033[30m");
        define('RED', "\033[31m");
        define('GREEN', "\033[32m");
        define('YELLOW', "\033[33m");
        define('BLUE', "\033[34m");
        define('MAGENTA', "\033[35m");
        define('CYAN', "\033[36m");

        $terminalWidth = (int) exec('tput cols');
        function removeAnsiCodes($string) {
            return preg_replace('/\033\[[0-9;]*m/', '', $string);
        }
        // In bảng với màu sắc
        foreach ($routes as $row) {
            $method = $row['method'];
            $path = $row['path'];
            $name = '';
            if(is_array($row['callback'])){
                $class = $row['callback'][0];
                $function = $row['callback'][1];
            }else{
                $class = '';
                $function = 'function';
            }
            $methodColor = $this->getMethodColor($method);
            $pathColor = $this->getPathColor($path);
            $nameColor = $this->getNameColor($name);
            $classColor = $this->getClassColor($class);
            $functionColor = $this->getFunctionColor($function);
             // Định dạng các phần
            $formattedMethod = BOLD . $methodColor . $method . RESET;
            $formattedPath = $pathColor . $path . RESET;
            $formattedName = $nameColor . $name . RESET;
            $formattedClass = $classColor . $class . RESET;
            $formattedFunction = $functionColor . $function . RESET;

            $leftPart = sprintf("%s - %s", $formattedMethod, $formattedPath);
            $rightPart = sprintf("%s.%s@%s", $formattedName, $formattedClass, $formattedFunction);
            $leftPartLength = strlen(removeAnsiCodes($leftPart));
            $rightPartLength = strlen(removeAnsiCodes($rightPart));
            $dotsLength = $terminalWidth - $leftPartLength - $rightPartLength - 3; 
            $dots = str_repeat('.', max($dotsLength, 0));
            $line = sprintf("%s %s%s", $leftPart, $dots, $rightPart);
            echo $line . PHP_EOL;
        }
    }
    function getMethodColor($method)
    {
        switch (strtoupper($method)) {
            case 'GET':
                return GREEN;
            case 'POST':
                return MAGENTA;
            case 'DELETE':
                return RED;
            default:
                return BLUE;
        }
    }
    function getPathColor($path) {
        return CYAN;
    }
    
    function getNameColor($name) {
        return RESET;
    }
    
    function getClassColor($class) {
        return BLUE;
    }
    
    function getFunctionColor($function) {
        return YELLOW;
    }
}
