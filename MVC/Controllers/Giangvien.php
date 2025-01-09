<?php
class Giangvien extends controller
{
    private $Giangvien;

    function __construct()
    {
        $this->Giangvien= $this->model('Giangvien_m');
    }
    public function Get_data()
    {
        $danhSachID_Khoa = $this->Giangvien->laydanhsachidkhoa();
        $dulieu = $this->Giangvien->getAllGiangvien();
        $this->view('Masterlayout', [
            'page' => 'Giangvien',
            'danhSachID_Khoa' => $danhSachID_Khoa,
            'dulieu' => $dulieu
        ]);
    }


    function themmoi() {
        if (isset($_POST['btnthemgv'])) {
            $resultt = $this->Themgv();
            $dulieu = $this->Giangvien->getAllGiangvien();
            $danhSachID_Khoa = $this->Giangvien->laydanhsachidkhoa();
            $this->view('Masterlayout', [
                'page' => 'Giangvien',
                'resultt' => $resultt,
                'danhSachID_Khoa' => $danhSachID_Khoa,
                'dulieu' => $dulieu
            ]);
        }
    }


    function Themgv()
    {
        $ID_Giangvien = $_POST['txtID_Giangvien'] ?? '';
        $Hoten = $_POST['txtHoten'] ?? '';
        $Ngaysinh = $_POST['txtNgaysinh'] ?? '';
        $Diachi = $_POST['txtDiachi'] ?? '';
       
        $Email = $_POST['txtEmail'] ?? '';
        $Sdt = $_POST['txtSdt'] ?? '';
        $Gioitinh = $_POST['txtGioitinh'] ?? '';
        $ID_Khoa = $_POST['txtID_Khoa'] ?? '';
        $checkResult = $this->Giangvien->checktrungmagv($ID_Giangvien);
        if ($checkResult == "duplicate") {
            return "duplicate"; // Nếu trùng mã đề tài
        }

       

        // Thêm đề tài vào CSDL
        $insertResult = $this->Giangvien->Giangvien_ins($ID_Giangvien, $Hoten, $Ngaysinh, $Diachi, $Email, $Sdt, $Gioitinh,$ID_Khoa);

        // Trả về kết quả thêm đề tài
        return $insertResult; // success hoặc fail
    }
    
    
    function deleteGiangvien($idGiangvien)
    {
        $result = $this->Giangvien->deleteGiangvienById($idGiangvien);
        $dulieu = $this->Giangvien->getAllGiangvien();
        $this->view('Masterlayout', [
            'page' => 'Giangvien',
            'deleteResult' => $result ? 'success' : 'fail',
            'dulieu' => $dulieu
        ]);
    }



    public function capnhatgv()
    {
        if (isset($_POST['btnsua'])) {
            $idGiangvien = $_POST['magv'];
            $hoten = $_POST['hoten'];
            $ngaysinh = $_POST['ngaysinh'];
            $diachi = $_POST['diachi'];
            $sdt = $_POST['dienthoai'];
            $email = $_POST['email'];
            $gioitinh = $_POST['gioitinh'];
            $khoa = $_POST['id_khoa'];
            $kq = $this->Giangvien->updateGiangvien($idGiangvien, $hoten, $ngaysinh, $diachi, $sdt, $email, $gioitinh,$khoa);
            $result = $kq ? 'success' : 'fail';
    
            // Lấy lại tất cả sinh viên
            $dulieu = $this->Giangvien->getAllGiangvien();
            $danhSachID_Khoa = $this->Giangvien->laydanhsachidkhoa();
            // Truyền dữ liệu ra view
            $this->view('Masterlayout', [
                'page' => 'Giangvien',
                'editResult' => $result,
                'danhSachID_Khoa' => $danhSachID_Khoa,
                'dulieu' => $dulieu
            ]);
            exit;
        }
    }
    

   
}
