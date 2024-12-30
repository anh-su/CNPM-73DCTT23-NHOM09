<?php
class Thongtinad extends Controller
{
    private $Thongtinad;

    // Khởi tạo Model trong constructor
    function __construct()
    {
        $this->Thongtinad = $this->model("Thongtinad_m"); // Model để xử lý dữ liệu admin
    }

    // Hàm để lấy dữ liệu thông tin admin và hiển thị lên View
    function Get_data()
    {
        $this->view('Masterlayout', [
            'page' => 'Thongtinad'
        ]);
    }

    // Hàm xử lý cập nhật thông tin admin
    function updatead() {
        $result = '';

        if (isset($_POST['btncapnhatad'])) {
            // Cập nhật thông tin admin
            $result = $this->capnhatad();
        }

        // Gọi view hiển thị kết quả cập nhật thông tin admin
        $this->view('Masterlayout', [
            'page' => 'Thongtinad',
            'result' => $result,
        ]);
    }

    // Hàm cập nhật thông tin admin
    public function capnhatad()
    {
        if (isset($_POST['btncapnhatad'])) {
            // Lấy dữ liệu từ form
            $ID_Admin = $_SESSION['ID'];
            $Hoten = $_POST['txtHoten'];
            $Ngaysinh = $_POST['txtNgaysinh'];
            $Diachi = $_POST['txtDiachi'];
            $Email = $_POST['txtEmail'];
            $Sdt = $_POST['txtSdt'];
            $Gioitinh = $_POST['txtGioitinh'];

            // Cập nhật thông tin trong cơ sở dữ liệu
            $kq = $this->Thongtinad->Thongtinad_upd($ID_Admin, $Hoten, $Ngaysinh, $Diachi, $Email, $Sdt, $Gioitinh);

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
            return $kq ? 'success' : 'fail';
        }
    }
}
?>
