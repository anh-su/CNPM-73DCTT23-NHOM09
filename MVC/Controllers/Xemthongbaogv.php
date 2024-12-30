<?php
// controllers/Xemthongbao.php
class Xemthongbaogv extends Controller
{
    private $xemthongbaogv;

    public function __construct()
    {
        $this->xemthongbaogv = $this->model('Xemthongbaogv_m');
    }

    public function Get_data()
    {
       
        $ID_Giangvien = isset($_SESSION['ID']) ? $_SESSION['ID'] : null;

        // Kiểm tra thông báo từ query string
        $result = isset($_GET['result']) ? $_GET['result'] : null;

        // Nếu có ID_Sinhvien, lấy danh sách các đề tài đã đăng ký
        if ($ID_Giangvien) {
            $thongbaogv = $this->xemthongbaogv->getThongbaoByGiangvien($ID_Giangvien); // Truyền ID_Sinhvien vào phương thức
          
        } else {
            $thongbaogv = []; // Nếu không có ID_Sinhvien, trả về mảng rỗng
         
        }

        $this->view('Masterlayout_teacher', [
            'page' => 'Xemthongbaogv',
            'thongbaogv' => $thongbaogv, 
            'result' => $result
        ]);
           
    }
  // Hiển thị thông báo cho sinh viên
  


    
}
?>
