<?php
class GuithongbaoHS extends Controller
{
    private $GuithongbaoHS;

    function __construct()
    {
        $this->GuithongbaoHS = $this->model('GuithongbaoHS_m');
    }

    function Get_data()
    {
        $danhSachID_DTSV = $this->GuithongbaoHS->layDanhSachID_DTSV();
        $danhSachThongBao = $this->GuithongbaoHS->layDanhSachThongBao();

        $this->view('Masterlayout_teacher', [
            'page' => 'GuithongbaoHS',
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
                $kq = $this->GuithongbaoHS->thongbao_ins($td, $nd, $id_dtsv, $hoten, $thoigian);
                $result = $kq ? 'success' : 'fail';
                $this->view('Masterlayout_teacher', [
                    'page' => 'GuithongbaoHS',
                    'result' => $result,
                    'danhSachID_DTSV' => $this->GuithongbaoHS->layDanhSachID_DTSV(),
                    'danhSachThongBao' => $this->GuithongbaoHS->layDanhSachThongBao()
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

            $kq = $this->GuithongbaoHS->suaThongbaoById($id, $td, $nd, $id_dtsv);
            $result = $kq ? 'success' : 'fail';
            $this->view('Masterlayout_teacher', [
                'page' => 'GuithongbaoHS',
                'result' => $result,
                'danhSachID_DTSV' => $this->GuithongbaoHS->layDanhSachID_DTSV(),
                'danhSachThongBao' => $this->GuithongbaoHS->layDanhSachThongBao()
            ]);
            exit();
        } else {
            echo '<script>alert("Yêu cầu không hợp lệ!")</script>';
            header("Location: http://localhost/Doan/GuithongbaoHS");
            exit();
        }
    }

    function resetThongbao()
    {
        $result = $this->GuithongbaoHS->resetAllThongbao();
        $result = $result ? 'success' : 'fail';
        $this->view('Masterlayout_teacher', [
            'page' => 'GuithongbaoHS',
            'result' => $result,
            'danhSachID_DTSV' => $this->GuithongbaoHS->layDanhSachID_DTSV(),
            'danhSachThongBao' => $this->GuithongbaoHS->layDanhSachThongBao()
        ]);
        exit();
    }

    function xoaThongbao($id)
    {
        $result = $this->GuithongbaoHS->xoaThongbaoById($id);
        $result = $result ? 'success' : 'fail';
        $this->view('Masterlayout_teacher', [
            'page' => 'GuithongbaoHS',
            'result' => $result,
            'danhSachID_DTSV' => $this->GuithongbaoHS->layDanhSachID_DTSV(),
            'danhSachThongBao' => $this->GuithongbaoHS->layDanhSachThongBao()
        ]);
        exit();
    }

 
}
?>
