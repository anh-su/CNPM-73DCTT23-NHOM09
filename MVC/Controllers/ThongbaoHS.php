<?php
class ThongbaoHS extends Controller
{
    private $ThongbaoHS;

    function __construct()
    {
        $this->ThongbaoHS = $this->model('ThongbaoHS_m');
    }

    function Get_data()
    {
        $danhSachID_DTSV = $this->ThongbaoHS->layDanhSachID_DTSV();
        $danhSachThongBao = $this->ThongbaoHS->layDanhSachThongBao();

        $this->view('Masterlayout', [
            'page' => 'ThongbaoHS',
            'danhSachID_DTSV' => $danhSachID_DTSV,
            'danhSachThongBao' => $danhSachThongBao
        ]);
    }

    function linklienhe()
    {
        $this->Get_data();
    }

    function saveThongbao()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_POST['btnluu'])) {
            $td = $_POST['title'];
            $nd = $_POST['message'];
            $id_dtsv = $_POST['ID_DTSV'];
            $thoigian = date('Y-m-d H:i:s'); // Lấy thời gian hiện tại

            if (isset($_SESSION['Hoten'])) {
                $hoten = $_SESSION['Hoten'];
                $kq = $this->ThongbaoHS->thongbao_ins($td, $nd, $id_dtsv, $hoten, $thoigian);
                $result = $kq ? 'success' : 'fail';
                $this->view('Masterlayout', [
                    'page' => 'ThongbaoHS',
                    'result' => $result,
                    'danhSachID_DTSV' => $this->ThongbaoHS->layDanhSachID_DTSV(),
                    'danhSachThongBao' => $this->ThongbaoHS->layDanhSachThongBao()
                ]);
                exit();
            }
        } else {
            echo "Session 'Hoten' không tồn tại.";
        }
    }

    function suaThongbao()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['edit_id'];
            $td = $_POST['edit_title'];
            $nd = $_POST['edit_message'];
            $id_dtsv = $_POST['edit_id_dtsv'];

            $kq = $this->ThongbaoHS->suaThongbaoById($id, $td, $nd, $id_dtsv);
            $result = $kq ? 'success' : 'fail';
            $this->view('Masterlayout', [
                'page' => 'ThongbaoHS',
                'result' => $result,
                'danhSachID_DTSV' => $this->ThongbaoHS->layDanhSachID_DTSV(),
                'danhSachThongBao' => $this->ThongbaoHS->layDanhSachThongBao()
            ]);
            exit();
        } else {
            echo '<script>alert("Yêu cầu không hợp lệ!")</script>';
            header("Location: http://localhost/Doan/ThongbaoHS");
            exit();
        }
    }

    function resetThongbao()
    {
        $result = $this->ThongbaoHS->resetAllThongbao();
        $result = $result ? 'success' : 'fail';
        $this->view('Masterlayout', [
            'page' => 'ThongbaoHS',
            'result' => $result,
            'danhSachID_DTSV' => $this->ThongbaoHS->layDanhSachID_DTSV(),
            'danhSachThongBao' => $this->ThongbaoHS->layDanhSachThongBao()
        ]);
        exit();
    }

    function xoaThongbao($id)
    {
        $result = $this->ThongbaoHS->xoaThongbaoById($id);
        $result = $result ? 'success' : 'fail';
        $this->view('Masterlayout', [
            'page' => 'ThongbaoHS',
            'result' => $result,
            'danhSachID_DTSV' => $this->ThongbaoHS->layDanhSachID_DTSV(),
            'danhSachThongBao' => $this->ThongbaoHS->layDanhSachThongBao()
        ]);
        exit();
    }

    function HS()
    {
        $danhSachThongBao = $this->ThongbaoHS->layDanhSachThongBao();
        $this->view('Masterlayout_student', [
            'page' => 'Xemthongbao',
            'danhSachThongBao' => $danhSachThongBao
        ]);
    }
}
?>
