<?php
class Thongkegv extends Controller
{
    private $Thongkegv;

    // Khởi tạo Model trong constructor
    function __construct()
    {
     $this->Thongkegv = $this->model("Thongkegv_m"); // Model để xử lý dữ liệu admin
    }

    // Hàm để lấy dữ liệu thông tin admin và hiển thị lên View
    function Get_data()
    {
        $this->view('Masterlayout_teacher', [
            'page' => 'Thongkegv'
        ]);
    }
}