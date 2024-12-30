<?php
class QuanlyDT extends controller
{
    private $QuanlyDT;

    function __construct()
    {
        $this->QuanlyDT = $this->model("QuanlyDT_m");
    }

    function Get_data()
    {
        $danhsachdetai = $this->QuanlyDT->laydanhsachdetai();
        $this->view('Masterlayout',
        [
            'page' => 'QuanlyDT',
            'danhsachdetai' => $danhsachdetai
        ]);
    }

    function themmoi() {
        if (isset($_POST['btnthemdt'])) {
            // Xử lý thêm mới đề tài
            $result = $this->Themdt();
            $danhsachdetai = $this->QuanlyDT->laydanhsachdetai();
            // Gọi view hiển thị kết quả
            $this->view('Masterlayout', [
                'page' => 'QuanlyDT',
                'danhsachdetai' => $danhsachdetai,
                'result' => $result
            ]);
        }
    }

    function Themdt()
    {
        // Lấy dữ liệu từ form
        $Madetai = $_POST['txtMadetai'] ?? '';
        $Tendetai = $_POST['txtTendetai'] ?? '';
        $Tieude = $_POST['txtTieude'] ?? '';
        $Ngaybatdau = $_POST['txtNgaybatdau'] ?? '';
        $Ngayketthuc = $_POST['txtNgayketthuc'] ?? '';
        $Mota = $_POST['txtMota'] ?? '';

        // Kiểm tra trùng mã đề tài
        $checkResult = $this->QuanlyDT->checktrungmadetai($Madetai);
        if ($checkResult == "duplicate") {
            return "duplicate"; // Nếu trùng mã đề tài
        }

        // Kiểm tra tính hợp lệ của ngày bắt đầu và ngày kết thúc
        $ngayBatDau = strtotime($Ngaybatdau);
        $ngayKetThuc = strtotime($Ngayketthuc);
        $today = strtotime(date("Y-m-d"));

        if ($ngayBatDau <= $today) {
            return "invalid_start_date"; // Ngày bắt đầu phải trong tương lai
        }

        if ($ngayKetThuc <= $ngayBatDau) {
            return "invalid_end_date"; // Ngày kết thúc phải sau ngày bắt đầu
        }

        // Thêm đề tài vào CSDL
        $insertResult = $this->QuanlyDT->detai_ins($Madetai, $Tendetai, $Tieude, $Ngaybatdau, $Ngayketthuc, $Mota);

        // Trả về kết quả thêm đề tài
        return $insertResult; // success hoặc fail
    }

    function sua() {
        if (isset($_POST['Madetai'])) {
            // Lấy dữ liệu từ form
            $Madetai = $_POST['Madetai'];
            $Tendetai = $_POST['Tendetai'];
            $Tieude = $_POST['Tieude'];
            $Ngaybatdau = $_POST['Ngaybatdau'];
            $Ngayketthuc = $_POST['Ngayketthuc'];
            $Mota = $_POST['Mota'];

            // Cập nhật đề tài trong CSDL
            $updateResult = $this->QuanlyDT->detai_update($Madetai, $Tendetai, $Tieude, $Ngaybatdau, $Ngayketthuc, $Mota);
            $danhsachdetai = $this->QuanlyDT->laydanhsachdetai();
            // Gọi view hiển thị kết quả
            $this->view('Masterlayout', [
                'page' => 'QuanlyDT',
                'result' => $updateResult,
                'danhsachdetai' => $danhsachdetai
            ]);
        }
    }

    function xoa() {
        if (isset($_POST['Madetai'])) {
            // Lấy mã đề tài từ form
            $Madetai = $_POST['Madetai'];

            // Xóa đề tài trong CSDL
            $deleteResult = $this->QuanlyDT->detai_delete($Madetai);
            $danhsachdetai = $this->QuanlyDT->laydanhsachdetai();
            // Gọi view hiển thị kết quả
            $this->view('Masterlayout', [
                'page' => 'QuanlyDT',
                'danhsachdetai' => $danhsachdetai,
                'result' => $deleteResult
               
            ]);
        }
    }
}
?>
