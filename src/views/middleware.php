<?php

$classDefinition = <<<PHP
<?php 
    namespace $namespace;
    
    use AsfyCode\Middleware\Middleware;
    use AsfyCode\Utils\Request as Request;
    
    class $className extends Middleware
    {
        public function handle(Request \$request){
            
        }
    }
PHP;

echo $classDefinition;
