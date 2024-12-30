<?php
class Controller
{
    // Phương thức model của bạn không thay đổi, chỉ truyền tham số $db vào
    public function model($model, $db = null)
    {
        include_once './MVC/Models/'.$model.'.php';
        
        // Kiểm tra nếu có truyền $db, ta khởi tạo model với db, nếu không thì khởi tạo model bình thường
        if ($db) {
            return new $model($db);
        } else {
            return new $model();
        }
    }

    // Phương thức view không thay đổi
    public function view($view, $data = []) { include_once './MVC/Views/'.$view.'.php'; 
    }
}
?>
