<?php
// controllers/Xemthongbao.php
class Xemthongbao extends Controller
{
    private $xemthongbao;

    public function __construct()
    {
        $this->xemthongbao = $this->model('Xemthongbao_m');
    }

    public function Get_data()
    {
       
        $ID_Sinhvien = isset($_SESSION['ID']) ? $_SESSION['ID'] : null;

        // Kiểm tra thông báo từ query string
        $result = isset($_GET['result']) ? $_GET['result'] : null;

        // Nếu có ID_Sinhvien, lấy danh sách các đề tài đã đăng ký
        if ($ID_Sinhvien) {
            $thongbao = $this->xemthongbao->getThongbaoBySinhvien($ID_Sinhvien); // Truyền ID_Sinhvien vào phương thức
          
        } else {
            $thongbao = []; // Nếu không có ID_Sinhvien, trả về mảng rỗng
         
        }

        $this->view('Masterlayout_student', [
            'page' => 'Xemthongbao',
            'thongbao' => $thongbao, 
            'result' => $result
        ]);
           
    }
  // Hiển thị thông báo cho sinh viên
  


    
}
?>
