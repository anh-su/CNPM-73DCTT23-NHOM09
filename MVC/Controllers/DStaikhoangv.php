<?php
class DStaikhoangv extends controller
{
    private $DStaikhoangv;

    function __construct()
    {
        $this->DStaikhoangv = $this->model('DStaikhoangv_m');
    }

    function Get_data()
    {
        $danhSachTaiKhoangv = $this->DStaikhoangv->layDanhSachTKGV();
       
        $this->view('Masterlayout', [
            'page' => 'DStaikhoangv',
            'danhSachTaiKhoangv' => $danhSachTaiKhoangv,
            'dulieu' => $this->DStaikhoangv->QuanlyTKGV_find('', '')

          
        ]);
    }
    ////////SINH VIÊN///////////

    function themmoi() {
        $result = '';
    
     if (isset($_POST['btnThemGiangvien'])) {
            // Thêm tài khoản giảng viên
            $result = $this->ThemTK_Giangvien();
    
            // Lấy danh sách tài khoản giảng viên
            $danhSachTaiKhoangv = $this->DStaikhoangv->layDanhSachTKGV();
    
            // Gọi view hiển thị danh sách giảng viên
            $this->view('Masterlayout', [
                'page' => 'DStaikhoangv',
                'result' => $result,
                'danhSachTaiKhoangv' => $danhSachTaiKhoangv
            ]);
        }
    }
    
    

   

      ////////GIẢNG VIÊN///////////

     
    

    // Phương thức thêm tài khoản Sinh viên
    function ThemTK_Giangvien()
    {
        // Lấy dữ liệu từ form
        $ID_TK = $_POST['txtID_TK'];
        $Tendangnhap = $_POST['txtTendangnhap'];
        $Matkhau = $_POST['txtMatkhau'];

        // Gán vai trò là 0 cho Sinh viên
        $Vaitro = 2;  // Phân quyền Sinh viên

        // Chỉ nhập ID Sinh viên, ID Giảng viên và ID Admin để null
        $ID_Sinhvien = null;
        $ID_Giangvien = $_POST['txtID_Giangvien'];  // Trống cho giảng viên
        $ID_Admin = null;      // Trống cho admin

        // Kiểm tra trùng lặp mã tài khoản
        $checkResult = $this->DStaikhoangv->checktrungmaTKGV($ID_TK, $ID_Giangvien);
        
        if ($checkResult == "duplicate") {
            return "duplicate";  // Nếu trùng mã tài khoản
        
        }

        // Thêm tài khoản Sinh viên vào CSDL
        $insertResult = $this->DStaikhoangv->QuanlyTKGV_ins($ID_TK, $Tendangnhap, $Matkhau, $Vaitro, $ID_Sinhvien, $ID_Giangvien, $ID_Admin);

        // Trả về kết quả thêm tài khoản
        return $insertResult;  // success hoặc fail
    }


    function xoagv($ID_TK)
    {
        $kq = $this->DStaikhoangv-> QuanlyTKGV_del($ID_TK);
        $resultdl = $kq ? 'success' : 'fail';


        // Gọi lại giao diện và truyền $dl ra
        $dl = $this->DStaikhoangv->QuanlyTKGV_find('', '');
        $this->view('Masterlayout', [
            'page' => 'DStaikhoangv',
            'dulieu' => $dl,
            'resultdl' => $resultdl
        ]);
    }
   //TÌM KIẾM TKGV

    function timkiemgv()
    {
        if (isset($_POST['btnTimkiemgv'])) {
            // Lấy dữ liệu tìm kiếm từ form
            $ID_TK = $_POST['txtID_TK'];
            $ID_Giangvien = $_POST['txtID_Giangvien'];
    
            // Gọi hàm tìm kiếm với các tham số
            $danhSachTaiKhoangv = $this->DStaikhoangv->QuanlyTKGV_find($ID_TK, $ID_Giangvien);
    
            // Trả về kết quả tìm kiếm
            $this->view('Masterlayout', [
                'page' => 'DStaikhoangv',
                'danhSachTaiKhoangv' => $danhSachTaiKhoangv,
                'ID_TK' => $ID_TK,
                'ID_Giangvien' => $ID_Giangvien
            ]);
            exit;
        }
    }

   

    //cập nhật tài khoản
    public function capnhatgv()
    {
        if (isset($_POST['txtID_TK'])) {
        $ID_TK = $_POST['txtID_TK'];
        $Tendangnhap = $_POST['txtTendangnhap'];
        $Matkhau = $_POST['txtMatkhau'];

        // Gán vai trò là 2 cho giảng viên
        $Vaitro = 2;  // Phân quyền giảng viên

        // Chỉ nhập ID Sinh viên, ID Giảng viên và ID Admin để null
        $ID_Sinhvien = null;
        $ID_Giangvien = $_POST['txtID_Giangvien'];  // Trống cho giảng viên
        $ID_Admin = null;      // Trống cho admin


           // $this->dshs->User_upd($mahs, $ht, $ns, $dc,  $email, $tl);
            // Gọi model để cập nhật dữ liệu vào database
            $kq = $this->DStaikhoangv->QuanlyTKGV_upd($ID_TK,$Tendangnhap, $Matkhau , $Vaitro, $ID_Giangvien);

            // Gọi lại giao diện và truyền $dl ra
            $result = $kq ? 'success' : 'fail';

            $danhSachTaiKhoangv = $this->DStaikhoangv->layDanhSachTKGV();
            $this->view('Masterlayout', [
                'page' => 'DStaikhoangv',
                'editResult' => $result,
                'danhSachTaiKhoangv' =>  $danhSachTaiKhoangv,
                'dulieu' => $this->DStaikhoangv->QuanlyTKGV_find('', '')
            ]);
            exit;
        }
    }
}
