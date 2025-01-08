<?php
class Thongkegv extends Controller
{
    private $Thongkegv;

    // Khởi tạo Model trong constructor
    function __construct()
    {
        // Tạo đối tượng model để truy cập các phương thức trong model
        $this->Thongkegv = $this->model("Thongkegv_m"); // Model để xử lý dữ liệu giảng viên
    }

    // Hàm để lấy dữ liệu và hiển thị lên View
    function Get_data()
    {
        // Kiểm tra xem giảng viên đã đăng nhập chưa
        if (isset($_SESSION['ID'])) {
            // Lấy ID_Giangvien từ Session
            $id_giangvien = $_SESSION['ID'];

            // Gọi model để lấy danh sách tên đề tài đã phân công cho giảng viên
            $danhSachDeTai = $this->Thongkegv->getDanhSachDeTai($id_giangvien);

            // Kiểm tra nếu không có dữ liệu trả về từ model
            if (empty($danhSachDeTai)) {
                $message = "Không có đề tài nào được phân công cho giảng viên này.";
            } else {
                $message = null; // Thông báo khi có dữ liệu
            }
        } else {
            // Nếu giảng viên chưa đăng nhập, thông báo lỗi và trả về danh sách rỗng
            $danhSachDeTai = [];
            $message = "Giảng viên chưa đăng nhập.";
        }

        // Truyền dữ liệu ra View
        $this->view('Masterlayout_teacher', [
            'page' => 'Thongkegv',
            'danhSachDeTai' => $danhSachDeTai,  // Truyền danh sách đề tài sang View
            'message' => $message             // Thông báo cho View nếu có
        ]);
    }
}
?>
