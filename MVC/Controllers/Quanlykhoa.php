<?php
class Quanlykhoa extends controller
{
    private $Quanlykhoa;

    function __construct()
    {
        $this->Quanlykhoa = $this->model('Quanlykhoa_m');
    }

    function Get_data()
    {
        $danhsachkhoa = $this->Quanlykhoa->danhsachkhoa();
       
        $this->view('Masterlayout', [
            'page' => 'Quanlykhoa',
            'danhsachkhoa' => $danhsachkhoa,
            'dulieu' => $this->Quanlykhoa->QuanlyKHOA_find('', '')

          
        ]);
    }
    ////////ADMIN///////////

    function themmoi() {
        $result = '';
    
     if (isset($_POST['btnThemkhoa'])) {
            // Thêm tài khoản giảng viên
            $result = $this->Themkhoa();
    
            // Lấy danh sách tài khoản giảng viên
            $danhsachkhoa= $this->Quanlykhoa->danhsachkhoa();
    
            // Gọi view hiển thị danh sách giảng viên
            $this->view('Masterlayout', [
                'page' => 'Quanlykhoa',
                'result' => $result,
                'danhsachkhoa' => $danhsachkhoa
            ]);
        }
    }
    
    

   

     

     
    

    // Phương thức thêm tài khoản Sinh viên
    function Themkhoa()
    {
        // Lấy dữ liệu từ form
        $ID_Khoa = $_POST['txtID_Khoa'];
        $Tenkhoa = $_POST['txtTenkhoa'];
        $Email = $_POST['txtEmail'];

      

      
        $Sdt =$_POST['txtSdt'];    
        // Kiểm tra trùng lặp mã tài khoản
        $checkResult = $this->Quanlykhoa->checktrungID_Khoa($ID_Khoa);
        
        if ($checkResult == "duplicate") {
            return "duplicate";  // Nếu trùng mã tài khoản
        
        }

        // Thêm tài khoản Sinh viên vào CSDL
        $insertResult = $this->Quanlykhoa->Quanlykhoa_ins($ID_Khoa, $Tenkhoa, $Email, $Sdt);

        // Trả về kết quả thêm tài khoản
        return $insertResult;  // success hoặc fail
    }


    function xoakhoa($ID_Khoa)
    {
        $kq = $this->Quanlykhoa-> Quanlykhoa_del($ID_Khoa);
        $resultdl = $kq ? 'success' : 'fail';

        $danhsachkhoa = $this->Quanlykhoa->danhsachkhoa();
        // Gọi lại giao diện và truyền $dl ra
        $dl = $this->Quanlykhoa->Quanlykhoa_find('', '');
        $this->view('Masterlayout', [
            'page' => 'Quanlykhoa',
            'dulieu' => $dl,
            'danhsachkhoa' => $danhsachkhoa,
            'resultdl' => $resultdl
        ]);
    }

    //TÌM KIẾM TKAD


    function timkiem()
    {
        if (isset($_POST['btnTimkiem'])) {
            // Lấy dữ liệu tìm kiếm từ form
            $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';
    
            // Gọi hàm tìm kiếm với từ khóa
            $danhsachkhoa = $this->Quanlykhoa->Quanlykhoa_find($keyword);
    
            // Trả về kết quả tìm kiếm
            $this->view('Masterlayout', [
                'page' => 'Quanlykhoa',
                'danhsachkhoa' => $danhsachkhoa,
                'keyword' => $keyword
            ]);
            exit;
        }
    }
    
    //cập nhật tài khoản
    public function capnhatkhoa()
    {
        if (isset($_POST['txtID_Khoa'])) {
        $ID_Khoa = $_POST['txtID_Khoa'];
        $Tenkhoa = $_POST['txtTenkhoa'];
        $Email = $_POST['txtEmail'];
        $Sdt = $_POST['txtSdt'];  // Trống cho admin


           // $this->dshs->User_upd($mahs, $ht, $ns, $dc,  $email, $tl);
            // Gọi model để cập nhật dữ liệu vào database
            $kq = $this->Quanlykhoa->Quanlykhoa_upd($ID_Khoa, $Tenkhoa, $Email, $Sdt);

            // Gọi lại giao diện và truyền $dl ra
            $result = $kq ? 'success' : 'fail';

            $danhsachkhoa = $this->Quanlykhoa->danhsachkhoa();
            $this->view('Masterlayout', [
                'page' => 'Quanlykhoa',
                'editResult' => $result,
                'danhsachkhoa' =>   $danhsachkhoa,
                'dulieu' => $this->Quanlykhoa->Quanlykhoa_find('', '')
            ]);
            exit;
        }
    }
}
