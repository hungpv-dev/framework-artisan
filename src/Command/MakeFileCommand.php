<?php

namespace AsfyCode\Artisan\Command;

class MakeFileCommand
{
    public $filename;
    public function handle($type, $args)
    {
        global $$type;
        $this->filename = $type;
        if (empty($args[0])) {
            echo "Tên $type là bắt buộc!\n";
            return;
        }
        $name = $args[0];
        if($type == 'view'){
            $path = $$type . $name . '.blade.php';
        }else{
            $path = $$type . $name . '.php';
        }
        if (file_exists($path)) {
            logHelp('info',ucwords($type) . " đã tồn tại: $path \n");
            return;
        }
        $content = $this->setContent($path,$args);
        file_put_contents($path,$content);
        logHelp('success',"Tạo $type thành công: $path");
    }

    public function setContent($path,$args)
    {
        global $namespace;
        $startNamespace = $namespace[0];
        $mapPath = str_replace('/','\\',$namespace[1]);
        $lastSlashPos = strrpos($path, '/');
        $folder = substr($path, 0, $lastSlashPos);
        $namespace = str_replace('/','\\',$folder);
        $namespace = rtrim(str_replace($mapPath,$startNamespace,$namespace),'/');

        if (!is_dir($folder)) {
            mkdir($folder, 0755, true);
        }

        $agm = isset($args[1]) ? $args[1] : 0;

        $fileName = substr($path, $lastSlashPos + 1);
    
        $className = pathinfo($fileName, PATHINFO_FILENAME);

        $data = [
            'namespace' => $namespace,
            'className' => $className,
            'agm' => $agm
        ];

        ob_start();
        extract($data);
        include __DIR__ . '/../views/' . $this->filename . '.php';
        return ob_get_clean();
    }
}
