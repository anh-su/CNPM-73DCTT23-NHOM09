<?php
class QuanlyTK extends controller
{
    private $QuanlyTK;

    function __construct()
    {
        $this->QuanlyTK = $this->model('QuanlyTK_m');
    }

    function Get_data()
    {
        $danhSachTaiKhoansv = $this->QuanlyTK->layDanhSachTKSV();
       
        $this->view('Masterlayout', [
            'page' => 'QuanlyTK',
            'danhSachTaiKhoansv' => $danhSachTaiKhoansv,
            'dulieu' => $this->QuanlyTK->QuanlyTKSV_find('', ''),

          
        ]);
    }



  

    ////////SINH VIÊN///////////

    function themmoi() {
        $result = '';
    
        // Kiểm tra nút được nhấn và xử lý độc lập
        if (isset($_POST['btnThemSinhvien'])) {
            // Thêm tài khoản sinh viên
            $result = $this->ThemTK_Sinhvien();
    
            // Lấy danh sách tài khoản sinh viên
            $danhSachTaiKhoansv = $this->QuanlyTK->layDanhSachTKSV();
    
            // Gọi view hiển thị danh sách sinh viên
            $this->view('Masterlayout', [
                'page' => 'DStaikhoansv',
                'result' => $result,
                'danhSachTaiKhoansv' => $danhSachTaiKhoansv
            ]);
        }
    }
    
    

    // Phương thức thêm tài khoản Sinh viên
    function ThemTK_Sinhvien()
    {
        // Lấy dữ liệu từ form
        $ID_TK = $_POST['txtID_TK'];
        $Tendangnhap = $_POST['txtTendangnhap'];
        $Matkhau = $_POST['txtMatkhau'];

        // Gán vai trò là 0 cho Sinh viên
        $Vaitro = 0;  // Phân quyền Sinh viên

        // Chỉ nhập ID Sinh viên, ID Giảng viên và ID Admin để null
        $ID_Sinhvien = $_POST['txtID_Sinhvien'];
        $ID_Giangvien = null;  // Trống cho giảng viên
        $ID_Admin = null;      // Trống cho admin

        // Kiểm tra trùng lặp mã tài khoản
        $checkResult = $this->QuanlyTK->checktrungmaTK($ID_TK, $ID_Sinhvien);
        
        if ($checkResult == "duplicate") {
            return "duplicate";  // Nếu trùng mã tài khoản
        
        }

        // Thêm tài khoản Sinh viên vào CSDL
        $insertResult = $this->QuanlyTK->QuanlyTKSV_ins($ID_TK, $Tendangnhap, $Matkhau, $Vaitro, $ID_Sinhvien, $ID_Giangvien, $ID_Admin);

        // Trả về kết quả thêm tài khoản
        return $insertResult;  // success hoặc fail
    }


    function xoa($ID_TK)
    {
        $kq = $this->QuanlyTK-> QuanlyTKSV_del($ID_TK);
        $resultdl = $kq ? 'success' : 'fail';


        // Gọi lại giao diện và truyền $dl ra
        $dl = $this->QuanlyTK->QuanlyTKSV_find('', '');
        $this->view('Masterlayout', [
            'page' => 'DStaikhoansv',
            'dulieu' => $dl,
            'resultdl' => $resultdl
        ]);
    }

    //TÌM KIẾM TKSV
    function timkiem()
    {
        if (isset($_POST['btnTimkiem'])) {
            // Lấy dữ liệu tìm kiếm từ form
            $ID_TK = $_POST['txtID_TK'];
            $ID_Sinhvien = $_POST['txtID_Sinhvien'];
    
            // Gọi hàm tìm kiếm với các tham số
            $danhSachTaiKhoansv = $this->QuanlyTK->QuanlyTKSV_find($ID_TK, $ID_Sinhvien);
    
            // Trả về kết quả tìm kiếm
            $this->view('Masterlayout', [
                'page' => 'DStaikhoansv',
                'danhSachTaiKhoansv' => $danhSachTaiKhoansv,
                'ID_TK' => $ID_TK,
                'ID_Sinhvien' => $ID_Sinhvien
            ]);
            exit;
        }
    }
    

    //cập nhật tài khoản
    public function capnhat()
    {
        if (isset($_POST['txtID_TK'])) {
        $ID_TK = $_POST['txtID_TK'];
        $Tendangnhap = $_POST['txtTendangnhap'];
        $Matkhau = $_POST['txtMatkhau'];

        // Gán vai trò là 0 cho Sinh viên
        $Vaitro = 0;  // Phân quyền Sinh viên

        // Chỉ nhập ID Sinh viên, ID Giảng viên và ID Admin để null
        $ID_Sinhvien = $_POST['txtID_Sinhvien'];
        $ID_Giangvien = null;  // Trống cho giảng viên
        $ID_Admin = null;      // Trống cho admin


           // $this->dshs->User_upd($mahs, $ht, $ns, $dc,  $email, $tl);
            // Gọi model để cập nhật dữ liệu vào database
            $kq = $this->QuanlyTK->QuanlyTKSV_upd($ID_TK,$Tendangnhap, $Matkhau , $Vaitro, $ID_Sinhvien);

            // Gọi lại giao diện và truyền $dl ra
            $result = $kq ? 'success' : 'fail';

            $danhSachTaiKhoansv = $this->QuanlyTK->layDanhSachTKSV();
            $this->view('Masterlayout', [
                'page' => 'DStaikhoansv',
                'editResult' => $result,
                'danhSachTaiKhoansv' =>  $danhSachTaiKhoansv,
                'dulieu' => $this->QuanlyTK->QuanlyTKSV_find('', '')
            ]);
            exit;
        }
    }


    
}
