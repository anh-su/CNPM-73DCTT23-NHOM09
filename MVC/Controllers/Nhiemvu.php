<?php
class Nhiemvu extends Controller
{
    private $Nhiemvu;

    function __construct()
    {
        $this->Nhiemvu = $this->model('Nhiemvu_m');
    }

    function Get_data()
    {
        $ID_Giangvien = $_SESSION['ID']; // Lấy ID giảng viên từ session
        $danhsachnhom = $this->Nhiemvu->laydanhsachnhom($ID_Giangvien);
        $this->view('Masterlayout_teacher', [
            'page' => 'Nhiemvu',
            'danhsachnhom' => $danhsachnhom
        ]);
    }

    // Phương thức trả về chi tiết nhóm
    public function Get_group_details()
    {
        if (isset($_POST['ID_DTSV'])) {
            $ID_DTSV = $_POST['ID_DTSV'];
            $groupDetails = $this->Nhiemvu->layDanhSachThanhVien($ID_DTSV);

            if (!empty($groupDetails)) {
                $output = '<table class="table table-bordered">';
                $output .= '<thead><tr><th>STT</th><th>ID Sinh Viên</th><th>Họ và tên</th><th>Ngày Sinh</th><th>Địa Chỉ</th><th>Email</th><th>Liên Hệ</th><th>Giới Tính</th><th>Tên Khoa</th></tr></thead><tbody>';

                foreach ($groupDetails as $index => $member) {
                    $output .= '<tr>';
                    $output .= '<td>' . ($index + 1) . '</td>';
                    $output .= '<td>' . htmlspecialchars($member['ID_Sinhvien']) . '</td>';
                    $output .= '<td>' . htmlspecialchars($member['Hoten']) . '</td>';
                    $output .= '<td>' . htmlspecialchars($member['Ngaysinh']) . '</td>';
                    $output .= '<td>' . htmlspecialchars($member['Diachi']) . '</td>';
                    $output .= '<td>' . htmlspecialchars($member['Email']) . '</td>';
                    $output .= '<td>' . htmlspecialchars($member['Sdt']) . '</td>';
                    $output .= '<td>' . htmlspecialchars($member['Gioitinh']) . '</td>';
                    $output .= '<td>' . htmlspecialchars($member['Tenkhoa']) . '</td>';
                    $output .= '</tr>';
                }

                $output .= '</tbody></table>';
                echo $output;
                exit; // Tạm dừng để xem kết quả
            } else {
                echo '<p>Không có thành viên trong nhóm này.</p>';
            }
        }
    }

    function View_report()
    {
        if (isset($_GET['ID_DTSV'])) {
            $ID_DTSV = $_GET['ID_DTSV'];
            $report = $this->Nhiemvu->layBaoCao($ID_DTSV);
            $this->view('Report', ['report' => $report]);
        }
    }

    function Remove_group()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $ID_DTSV = $_POST['ID_DTSV'];
            $result = $this->Nhiemvu->xoaNhom($ID_DTSV);
            echo json_encode(['status' => $result ? 'success' : 'fail']);
        }
    }

    function Grade_group()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $ID_DTSV = $_POST['ID_DTSV'];
            $Hoten = $_SESSION['Hoten'];
            $Diem = $_POST['score'];
            $Nhanxet = $_POST['comments'];

            $result = $this->Nhiemvu->luuKetQua($ID_DTSV, $Hoten, $Diem, $Nhanxet);
            if ($result) {
                // Update the status in the database
                $updateStatus = $this->Nhiemvu->capNhatTrangThai($ID_DTSV);
                echo json_encode(['status' => $updateStatus ? 'success' : 'fail']);
            } else {
                echo json_encode(['status' => 'fail']);
            }
            exit(); // Ensure the script stops here to prevent duplicate entries
        }
    }

    public function Get_grade_details($ID_DTSV)
    {
        // Truy vấn dữ liệu từ mô hình
        $gradeDetails = $this->Nhiemvu->layDiemVaNhanXet($ID_DTSV);

        if ($gradeDetails) {
            return [
                'Diem' => $gradeDetails['Diem'],
                'Nhanxet' => $gradeDetails['Nhanxet']
            ];
        } else {
            return [
                'Diem' => null,
                'Nhanxet' => null
            ];
        }
    }

    public function Update_grade_details()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $ID_DTSV = $_POST['ID_DTSV'];
            $Diem = $_POST['score'];
            $Nhanxet = $_POST['comments'];

            $result = $this->Nhiemvu->capNhatDiemVaNhanXet($ID_DTSV, $Diem, $Nhanxet);
            if ($result) {
                header('Location: http://localhost/Doan/Nhiemvu/Get_data');
                exit();
            } else {
                echo 'Cập nhật điểm thất bại!';
            }
        }
    }

    function Complete_task()
    {
        if (isset($_POST['ID_DTSV'])) {
            $ID_DTSV = $_POST['ID_DTSV'];
            $TrangthaiDT = 'Hoàn Thành';

            // Cập nhật trạng thái trong bảng detaisinhvien
            $result = $this->Nhiemvu->updateTrangthaiDT($ID_DTSV, $TrangthaiDT);

            if ($result) {
                // Lưu vào bảng lichsutrangthai
                $this->Nhiemvu->saveTrangthaiHistory($ID_DTSV, $TrangthaiDT);
                echo json_encode(['status' => 'success']);
                exit();
            } else {
                echo json_encode(['status' => 'fail']);
            }
        }
    }

    function Get_report_file()
    {
        if (isset($_POST['ID_DTSV'])) {
            $ID_DTSV = $_POST['ID_DTSV'];
            $file_path = $this->Nhiemvu->getReportFilePath($ID_DTSV);

            if ($file_path) {
                echo json_encode(['file_path' => $file_path]);
            } else {
                echo json_encode(['file_path' => null]);
            }
        }
    }
}
?>