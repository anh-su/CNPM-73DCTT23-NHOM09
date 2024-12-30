<?php
class Sinhvien extends controller
{
    private $Sinhvien;

    function __construct()
    {
        $this->Sinhvien = $this->model('Sinhvien_m');
    }
    public function Get_data()
    {
        $danhSachID_Lop = $this->Sinhvien->laydanhsachidlop();
        $danhSachID_Khoa = $this->Sinhvien->laydanhsachtenkhoa();
        // Lấy dữ liệu sinh viên
        $dulieu = $this->Sinhvien->getAllSinhvien();
        // Truyền dữ liệu vào view
        $this->view('Masterlayout', [
            'page' => 'Sinhvien',
            'danhSachID_Lop' => $danhSachID_Lop,
            'danhSachID_Khoa' => $danhSachID_Khoa,
            'dulieu' => $dulieu
          
        ]);
    }


    function themmoi() {
        if (isset($_POST['btnthemsv'])) {
            // Xử lý thêm mới đề tài
            $resultt = $this->Themsv();
            $dulieu = $this->Sinhvien->getAllSinhvien();
            // Gọi view hiển thị kết quả
            $this->view('Masterlayout', [
                'page' => 'Sinhvien',
                'resultt' => $resultt,
                'dulieu' => $dulieu
            ]);
        }
    }


    function Themsv()
    {
        // Lấy dữ liệu từ form
        $ID_Sinhvien = $_POST['txtID_Sinhvien'] ?? '';
        $Hoten = $_POST['txtHoten'] ?? '';
        $Ngaysinh = $_POST['txtNgaysinh'] ?? '';
        $Diachi = $_POST['txtDiachi'] ?? '';
       
        $Email = $_POST['txtEmail'] ?? '';
        $Sdt = $_POST['txtSdt'] ?? '';
        $Gioitinh = $_POST['txtGioitinh'] ?? '';
        $ID_Lop = $_POST['txtID_Lop'] ?? '';
        $ID_Khoa = $_POST['txtID_Khoa'] ?? '';
        // Kiểm tra trùng mã đề tài
        $checkResult = $this->Sinhvien->checktrungmasv($ID_Sinhvien);
        if ($checkResult == "duplicate") {
            return "duplicate"; // Nếu trùng mã đề tài
        }

       

        // Thêm đề tài vào CSDL
        $insertResult = $this->Sinhvien->Sinhvien_ins($ID_Sinhvien, $Hoten, $Ngaysinh, $Diachi, $Email, $Sdt, $Gioitinh,$ID_Lop,$ID_Khoa);

        // Trả về kết quả thêm đề tài
        return $insertResult; // success hoặc fail
    }
    
    
    function deleteSinhvien($idSinhvien)
    {
        $result = $this->Sinhvien->deleteSinhvienById($idSinhvien);
        $dulieu = $this->Sinhvien->getAllSinhvien();
        $this->view('Masterlayout', [
            'page' => 'Sinhvien',
            'deleteResult' => $result ? 'success' : 'fail',
            'dulieu' => $dulieu
        ]);
    }
    public function capnhatsv()
    {
        if (isset($_POST['mahs'])) {
            $idSinhvien = $_POST['mahs'];
            $hoten = $_POST['hoten'];
            $ngaysinh = $_POST['ngaysinh'];
            $diachi = $_POST['diachi'];
            $sdt = $_POST['dienthoai'];
            $email = $_POST['email'];
            $gioitinh = $_POST['gioitinh'];
    
            // Cập nhật sinh viên
            $kq = $this->Sinhvien->updateSinhvien($idSinhvien, $hoten, $ngaysinh, $diachi, $sdt, $email, $gioitinh);
            
            // Kiểm tra kết quả cập nhật
            $result = $kq ? 'success' : 'fail';
    
            // Lấy lại tất cả sinh viên
            $dulieu = $this->Sinhvien->getAllSinhvien();
            $danhSachID_Lop = $this->Sinhvien->laydanhsachidlop();
            $danhSachID_Khoa = $this->Sinhvien->laydanhsachidkhoa();
    
            // Truyền dữ liệu ra view
            $this->view('Masterlayout', [
                'page' => 'Sinhvien',
                'danhSachID_Lop' => $danhSachID_Lop,
                'danhSachID_Khoa' => $danhSachID_Khoa,
                'editResult' => $result,
                'dulieu' => $dulieu
            ]);
            exit;
        }
    }
    

   
}

