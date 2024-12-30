<?php
class DSdetai extends Controller
{
    private $DSdetai;

    function __construct()
    {
        $this->DSdetai = $this->model('DSdetai_m');
    }

    function Get_data()
    {
        $danhsachDT = $this->DSdetai->laydanhsachDT();
        $danhsachtendetai = $this->DSdetai->laytendetai();
        $danhsachtengv = $this->DSdetai->layDanhSachGiangVien();
        $this->view('Masterlayout', [
            'page' => 'DSdetai',
            'danhsachDT' => $danhsachDT,
            'danhsachtendetai' => $danhsachtendetai,
            'danhsachtengv' => $danhsachtengv,
            'dulieu' => $this->DSdetai->DSdetai_find('', '')
        ]);
    }

    // Phương thức trả về danh sách thành viên của nhóm
    public function Get_member_details()
    {
        if (isset($_POST['ID_DTSV'])) {
            $ID_DTSV = $_POST['ID_DTSV'];
            $members = $this->DSdetai->layDanhSachThanhVien($ID_DTSV);
    
            if (!empty($members)) {
                $output = '<table class="table table-bordered">';
                $output .= '<thead><tr><th>STT</th><th>ID Sinh Viên</th><th>Họ và tên</th><th>Ngày Sinh</th><th>Địa Chỉ</th><th>Email</th><th>Liên Hệ</th><th>Giới Tính</th><th>Tên Khoa</th></tr></thead><tbody>';
    
                foreach ($members as $index => $member) {
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

    function timkiem()
    {
        if (isset($_POST['txtTendetai'])) {
            // Lấy dữ liệu tìm kiếm từ form
            $Tendetai = $_POST['txtTendetai'];
           
           
            // Gọi hàm tìm kiếm với các tham số
            $danhsachDT = $this->DSdetai->DSdetai_find($Tendetai);
    
            // Trả về kết quả tìm kiếm
            $this->view('Masterlayout', [
                'page' => 'DSdetai',
                'danhsachDT' => $danhsachDT,
                'Tendetai' =>$Tendetai
               
            ]);
            exit;
        }
    }

    public function approveDetai()
    {
        if (isset($_POST['ID_DTSV'])) {
            $ID_DTSV = $_POST['ID_DTSV'];
        
            // Gọi model để cập nhật trạng thái
            $result = $this->DSdetai->updateTrangThaiDetai($ID_DTSV, 'Đã Duyệt');
    
            // Kiểm tra kết quả và trả về phản hồi đúng định dạng
            if ($result['status']) {
                echo json_encode(['status' => 'success']);
                exit();
            } else {
                echo json_encode(['status' => 'error', 'message' => $result['error']]);
                exit();
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'ID_DTSV không hợp lệ.']);
        }
    }

    public function rejectDetai() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ID_DTSV = $_POST['ID_DTSV'];
            $result = $this->model('DSdetai_m')->rejectDetai($ID_DTSV);

            if ($result['status']) {
                echo json_encode(['status' => 'success']);
                exit();
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Không thể từ chối đề tài. Vui lòng thử lại.']);
            }
        }
    }

    public function phanCongGiangVien() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ID_DTSV = $_POST['ID_DTSV'];
            $madetai = $_POST['madetai'];
            $lecturer = $_POST['lecturer'];
            $lecturerID = $this->DSdetai->layIDGiangVien($lecturer);

            // Log the values being passed
            error_log("ID_DTSV: $ID_DTSV, Madetai: $madetai, Lecturer: $lecturer, LecturerID: $lecturerID");

            $result = $this->DSdetai->phanCongGiangVien($ID_DTSV, $madetai, $lecturerID, $lecturer);

            if ($result['status']) {
                echo json_encode(['status' => 'success']);
            } else {
                error_log("Error: " . $result['error']); // Log the error message
                echo json_encode(['status' => 'error', 'message' => 'Không thể phân công giảng viên. Vui lòng thử lại.']);
            }
        }
    }
}
?>