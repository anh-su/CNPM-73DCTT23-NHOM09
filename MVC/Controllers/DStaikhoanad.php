<?php
class DStaikhoanad extends controller
{
    private $DStaikhoanad;

    function __construct()
    {
        $this->DStaikhoanad = $this->model('DStaikhoanad_m');
    }

    function Get_data()
    {
        $danhSachTaiKhoanad = $this->DStaikhoanad->layDanhSachTKAD();
       
        $this->view('Masterlayout', [
            'page' => 'DStaikhoanad',
            'danhSachTaiKhoanad' => $danhSachTaiKhoanad,
            'dulieu' => $this->DStaikhoanad->QuanlyTKAD_find('', '')

          
        ]);
    }
    ////////ADMIN///////////

    function themmoi() {
        $result = '';
    
     if (isset($_POST['btnThemAdmin'])) {
            // Thêm tài khoản giảng viên
            $result = $this->ThemTK_Admin();
    
            // Lấy danh sách tài khoản giảng viên
            $danhSachTaiKhoanad = $this->DStaikhoanad->layDanhSachTKAD();
    
            // Gọi view hiển thị danh sách giảng viên
            $this->view('Masterlayout', [
                'page' => 'DStaikhoanad',
                'result' => $result,
                'danhSachTaiKhoangad' => $danhSachTaiKhoanad
            ]);
        }
    }
    
    

   

     

     
    

    // Phương thức thêm tài khoản Sinh viên
    function ThemTK_Admin()
    {
        // Lấy dữ liệu từ form
        $ID_TK = $_POST['txtID_TK'];
        $Tendangnhap = $_POST['txtTendangnhap'];
        $Matkhau = $_POST['txtMatkhau'];

        // Gán vai trò là 0 cho Sinh viên
        $Vaitro = 1;  // Phân quyền Sinh viên

        // Chỉ nhập ID Sinh viên, ID Giảng viên và ID Admin để null
        $ID_Sinhvien = null;
        $ID_Giangvien = null; // Trống cho giảng viên
        $ID_Admin =$_POST['txtID_Admin'];     // Trống cho admin

        // Kiểm tra trùng lặp mã tài khoản
        $checkResult = $this->DStaikhoanad->checktrungmaTKAD($ID_TK, $ID_Admin);
        
        if ($checkResult == "duplicate") {
            return "duplicate";  // Nếu trùng mã tài khoản
        
        }

        // Thêm tài khoản Sinh viên vào CSDL
        $insertResult = $this->DStaikhoanad->QuanlyTKAD_ins($ID_TK, $Tendangnhap, $Matkhau, $Vaitro, $ID_Sinhvien, $ID_Giangvien, $ID_Admin);

        // Trả về kết quả thêm tài khoản
        return $insertResult;  // success hoặc fail
    }


    function xoaad($ID_TK)
    {
        $kq = $this->DStaikhoanad-> QuanlyTKAD_del($ID_TK);
        $resultdl = $kq ? 'success' : 'fail';


        // Gọi lại giao diện và truyền $dl ra
        $dl = $this->DStaikhoanad->QuanlyTKAD_find('', '');
        $this->view('Masterlayout', [
            'page' => 'DStaikhoangad',
            'dulieu' => $dl,
            'resultdl' => $resultdl
        ]);
    }

    //TÌM KIẾM TKAD


   function timkiemad()
   {
       if (isset($_POST['btnTimkiemad'])) {
           // Lấy dữ liệu tìm kiếm từ form
           $ID_TK = $_POST['txtID_TK'];
           $ID_Admin = $_POST['txtID_Admin'];
   
           // Gọi hàm tìm kiếm với các tham số
           $danhSachTaiKhoanad = $this->DStaikhoanad->QuanlyTKAD_find($ID_TK, $ID_Admin);
   
           // Trả về kết quả tìm kiếm
           $this->view('Masterlayout', [
               'page' => 'DStaikhoanad',
               'danhSachTaiKhoanad' => $danhSachTaiKhoanad,
               'ID_TK' => $ID_TK,
               'ID_Admin' => $ID_Admin
           ]);
           exit;
       }
   }


    //cập nhật tài khoản
    public function capnhatad()
    {
        if (isset($_POST['txtID_TK'])) {
        $ID_TK = $_POST['txtID_TK'];
        $Tendangnhap = $_POST['txtTendangnhap'];
        $Matkhau = $_POST['txtMatkhau'];

        // Gán vai trò là 2 cho giảng viên
        $Vaitro = 1;  // Phân quyền giảng viên

        // Chỉ nhập ID Sinh viên, ID Giảng viên và ID Admin để null
        $ID_Sinhvien = null;
        $ID_Giangvien = null; // Trống cho giảng viên
        $ID_Admin = $_POST['txtID_Admin'];  // Trống cho admin


           // $this->dshs->User_upd($mahs, $ht, $ns, $dc,  $email, $tl);
            // Gọi model để cập nhật dữ liệu vào database
            $kq = $this->DStaikhoanad->QuanlyTKAD_upd($ID_TK,$Tendangnhap, $Matkhau , $Vaitro, $ID_Admin);

            // Gọi lại giao diện và truyền $dl ra
            $result = $kq ? 'success' : 'fail';

            $danhSachTaiKhoanad = $this->DStaikhoanad->layDanhSachTKAD();
            $this->view('Masterlayout', [
                'page' => 'DStaikhoanad',
                'editResult' => $result,
                'danhSachTaiKhoanad' =>  $danhSachTaiKhoanad,
                'dulieu' => $this->DStaikhoanad->QuanlyTKAD_find('', '')
            ]);
            exit;
        }
    }
}
