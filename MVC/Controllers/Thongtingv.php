<?php
class Thongtingv extends controller
{
    private $Thongtingv;

    function __construct()
    {
        $this->Thongtingv = $this->model("Thongtingv_m"); // Model để xử lý dữ liệu GIẢNG VIÊN
    }
    function Get_data()
    {
        $this->view('Masterlayout_teacher',
        [
            'page' =>'Thongtingv'
        ]);
    }

    // Hàm xử lý cập nhật thông tin giảng viên
    function updategv() {
        $result = '';

        if (isset($_POST['btncapnhatgv'])) {
            // Cập nhật thông tin giảng viên
            $result = $this->capnhatgv();
        }

        // Gọi view hiển thị kết quả cập nhật thông tin giảng viên
        $this->view('Masterlayout_teacher', [
            'page' => 'Thongtingv',
            'result' => $result,
        ]);
    }

    // Hàm cập nhật thông tin giảng viên
    public function capnhatgv()
    {
        if (isset($_POST['btncapnhatgv'])) {
            // Lấy dữ liệu từ form
            $ID_Giangvien = $_SESSION['ID'];
            $Hoten = $_POST['txtHoten'];
            $Ngaysinh = $_POST['txtNgaysinh'];
            $Diachi = $_POST['txtDiachi'];
            $Email = $_POST['txtEmail'];
            $Sdt = $_POST['txtSdt'];
            $Gioitinh = $_POST['txtGioitinh'];

            // Cập nhật thông tin trong cơ sở dữ liệu
            $kq = $this->Thongtingv->Thongtingv_upd($ID_Giangvien, $Hoten, $Ngaysinh, $Diachi, $Email, $Sdt, $Gioitinh);

            // Nếu cập nhật thành công, cập nhật session
            if ($kq) {
                // Cập nhật thông tin giảng viên trong session
                $_SESSION['Hoten'] = $Hoten;
                $_SESSION['Ngaysinh'] = $Ngaysinh;
                $_SESSION['Diachi'] = $Diachi;
                $_SESSION['Email'] = $Email;
                $_SESSION['Sdt'] = $Sdt;
                $_SESSION['Gioitinh'] = $Gioitinh;
            }

            // Kết quả cập nhật
            return $kq ? 'success' : 'fail';
        }
    }
}
?>