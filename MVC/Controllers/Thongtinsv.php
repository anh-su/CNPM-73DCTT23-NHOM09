<?php
class Thongtinsv extends controller
{
    private $Thongtinsv;

    function __construct()
    {
        $this->Thongtinsv = $this->model("Thongtinsv_m"); // Model để xử lý dữ liệu sinh viênviên
    }
    function Get_data()
    {
        $this->view('Masterlayout_student',
        [
            'page' =>'Thongtinsv'
        ]);
    }
    // Hàm xử lý cập nhật thông tin admin
    function updatesv() {
        $result = '';

        if (isset($_POST['btncapnhatsv'])) {
            // Cập nhật thông tin admin
            $result = $this->capnhatsv();
        }

        // Gọi view hiển thị kết quả cập nhật thông tin admin
        $this->view('Masterlayout_student', [
            'page' => 'Thongtinsv',
            'result' => $result,
        ]);
    }

    // Hàm cập nhật thông tin admin
    public function capnhatsv()
{
    if (isset($_POST['btncapnhatsv'])) {
        // Lấy dữ liệu từ form
        $ID_Sinhvien =$_SESSION['ID'];
        $Hoten = $_POST['txtHoten'];
        $Ngaysinh = $_POST['txtNgaysinh'];
        $Diachi = $_POST['txtDiachi'];
        $Email = $_POST['txtEmail'];
        $Sdt = $_POST['txtSdt'];
        $Gioitinh = $_POST['txtGioitinh'];

        // Cập nhật thông tin trong cơ sở dữ liệu
        $kq = $this->Thongtinsv->Thongtinsv_upd($ID_Sinhvien, $Hoten, $Ngaysinh, $Diachi, $Email, $Sdt, $Gioitinh);

        // Nếu cập nhật thành công, cập nhật session
        if ($kq) {
            // Cập nhật thông tin admin trong session
            $_SESSION['Hoten'] = $Hoten;
            $_SESSION['Ngaysinh'] = $Ngaysinh;
            $_SESSION['Diachi'] = $Diachi;
            $_SESSION['Email'] = $Email;
            $_SESSION['Sdt'] = $Sdt;
            $_SESSION['Gioitinh'] = $Gioitinh;
        }

        // Kết quả cập nhật
        $result = $kq ? 'success' : 'fail';

        // Trả dữ liệu về view để hiển thị
        $this->view('Masterlayout_student', [
            'page' => 'Thongtinsv',
            'result' => $result,
        ]);
    }
}
}