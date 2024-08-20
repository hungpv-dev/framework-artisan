<?php

$classDefinition = <<<PHP
<?php
namespace $namespace;
use App\Http\Controllers\Controller;
use AsfyCode\Utils\Request;

class $className extends Controller{

PHP;

if ((strpos($agm, '--r') !== false) || strpos($agm, '--a') !== false) {
    $classDefinition .= <<<PHP

    # [GET] /  =>  Danh sách dữ liệu 
    public function index(){
    
    }

PHP;
    if (strpos($agm, '--r') !== false) {
        $classDefinition .= <<<PHP

    # [GET] /create  =>  Hiện thị form thêm 
    public function create(){
    
    }

PHP;
    }

    $classDefinition .= <<<PHP

    # [POST] /create  =>  Thực thi thêm dữ liệu 
    public function store(Request \$request){
    
    }

    # [GET] /{id}  =>  Xem thông tin một bản ghi 
    public function show(\$id){
    
    }

PHP;

    if (strpos($agm, '--r') !== false) {
        $classDefinition .= <<<PHP

    # [GET] /update/{id}  =>  Hiển thị form cập nhật 
    public function edit(\$id){
    
    }

PHP;
    }

    $classDefinition .= <<<PHP

    # [PUT] /update/{id}  =>  Hiển thị form cập nhật 
    public function update(\$id,Request \$request){
    
    }

    # [DELETE] /{id}  =>  Xóa 1 bản ghi 
    public function destroy(\$id){
    
    }

PHP;
}

$classDefinition .= <<<PHP

}

PHP;

echo $classDefinition;
