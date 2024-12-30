<?php
class ChitietDT extends Controller
{
    private $ChitietDT;

    function __construct()
    {
        $this->ChitietDT = $this->model('ChitietDT_m');
    }

    function Get_data()
    {
        // Lấy ID_Sinhvien từ session
        $ID_Sinhvien = isset($_SESSION['ID']) ? $_SESSION['ID'] : null;

        // Kiểm tra thông báo từ query string
        $result = isset($_GET['result']) ? $_GET['result'] : null;

        // Nếu có ID_Sinhvien, lấy danh sách các đề tài đã đăng ký
        if ($ID_Sinhvien) {
            $danhsachdkdetai = $this->ChitietDT->laydanhsachDTDK($ID_Sinhvien); // Truyền ID_Sinhvien vào phương thức
            $danhsachtenkhoa = $this->ChitietDT->laydanhsachtenkhoa();
          
        } else {
            $danhsachdkdetai = []; // Nếu không có ID_Sinhvien, trả về mảng rỗng
            $danhsachtenkhoa = [];
        }

        $this->view('Masterlayout_student', [
            'page' => 'ChitietDT',
            'danhsachdkdetai' => $danhsachdkdetai,
            'danhsachtenkhoa' => $danhsachtenkhoa,
          
            'result' => $result
        ]);
    }

    function Get_detail()
    {
        if (isset($_POST['ID_DTSV'])) {
            $ID_DTSV = $_POST['ID_DTSV'];
            $detail = $this->ChitietDT->laychitietdetai($ID_DTSV);
            echo json_encode($detail);
        }
    }

    
    public function Get_grade_details() {
        // Kiểm tra xem POST đã gửi đúng dữ liệu chưa
        if (isset($_POST['ID_DTSV'])) {
            $ID_DTSV = $_POST['ID_DTSV'];
            $detail = $this->ChitietDT->laychitietdetai($ID_DTSV);
            
            // Kiểm tra nếu dữ liệu tồn tại và trả về JSON
            if ($detail) {
                echo json_encode($detail);
            } else {
                // Trả về thông báo lỗi nếu không có dữ liệu
                echo json_encode(["error" => "Không tìm thấy dữ liệu"]);
            }
        } else {
            echo json_encode(["error" => "ID_DTSV không được gửi"]);
        }
    }
    

    public function Get_detaisinhvien_details()
    {
        if (!empty($_POST['ID_DTSV'])) {
            $ID_DTSV = htmlspecialchars($_POST['ID_DTSV']);
            $details = $this->ChitietDT->layChiTietDeTaiSinhVien($ID_DTSV);
    
            if (!empty($details)) {
                $output = '<table class="table table-striped table-bordered">';
                $output .= '<thead class="thead-dark">
                                <tr>
                                    <th>STT</th>
                                    <th>ID_DTSV</th>
                                    <th>Tên Đề Tài</th>
                                    <th>ID Sinh Viên</th>
                                    <th>Họ Tên</th>
                                    <th>Giảng Viên Hướng Dẫn</th>
                                    <th>Mô Tả</th>
                                    <th>Tên Khoa</th>
                                    <th>Trạng Thái</th>
                                    <th>File Báo Cáo</th>
                                </tr>
                            </thead>
                            <tbody>';
    
                foreach ($details as $index => $detail) {
                    $output .= '<tr>';
                    $output .= '<td>' . ($index + 1) . '</td>';
                    $output .= '<td>' . htmlspecialchars($detail['ID_DTSV']) . '</td>';
                    $output .= '<td>' . htmlspecialchars($detail['Tendetai']) . '</td>';
                    $output .= '<td>' . htmlspecialchars($detail['ID_Sinhvien']) . '</td>';
                    $output .= '<td>' . htmlspecialchars($detail['Hoten']) . '</td>';
                    $output .= '<td>' . htmlspecialchars($detail['Hotengv']) . '</td>';
                    $output .= '<td>' . htmlspecialchars($detail['Mota']) . '</td>';
                    $output .= '<td>' . htmlspecialchars($detail['Tenkhoa']) . '</td>';
                    $output .= '<td>' . htmlspecialchars($detail['TrangthaiDT']) . '</td>';
                    
                    // Thêm form chọn tệp tại cột File Báo Cáo
                    $disabled = !empty($detail['Filebaitap']) ? '' : 'disabled';
                    $output .= '<td>
                                    <form method="POST" action="http://localhost/Doan/ChitietDT/UploadFileBaoCao" enctype="multipart/form-data">
                                        <input type="hidden" name="ID_DTSV" value="' . htmlspecialchars($detail['ID_DTSV']) . '">
                                        <input type="file" name="file_baocao" accept=".pdf,.doc,.docx" onchange="toggleSubmitButton(this)">
                                        <button style="margin-top:0.5cm; background:green" type="submit" class="btn btn-primary btn-submit-report" data-id="' . htmlspecialchars($detail['ID_DTSV']) . '" disabled>Nộp Báo Cáo</button>
                                        <p id="fileNameDisplay">' . htmlspecialchars($detail['Filebaitap']) . '</p>
                                    </form>
                                </td>';
                    $output .= '</tr>';
                }
    
                $output .= '</tbody></table>';
                echo $output;
                exit();
            } else {
                echo '<p>Không có thông tin chi tiết.</p>';
            }
        } else {
            echo '<p>Yêu cầu không hợp lệ.</p>';
        }
    }
    
    public function rejectDetai() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ID_DTSV = $_POST['ID_DTSV'];
            $result = $this->ChitietDT->rejectDetai($ID_DTSV);
     

            if ($result['status']) {
                echo json_encode(['status' => 'success']);
                exit();
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Không thể từ chối đề tài. Vui lòng thử lại.']);
            }
        }
    }

    public function danhDauTrangThai($ID_DTSV)
{
    // Lấy danh sách lịch sử trạng thái từ model
    $trangThaiLichSu = $this->ChitietDT->layLichSuTrangThai($ID_DTSV);

    // Kiểm tra nếu danh sách trống, trả về mảng rỗng
    if (empty($trangThaiLichSu)) {
        return [];
    }

    $ketQua = [];
    $trangThaiTruoc = null; // Biến lưu trạng thái trước đó

    // Duyệt qua từng trạng thái trong lịch sử
    foreach ($trangThaiLichSu as $trangThai) {
        $mau = 'xanh'; // Mặc định là màu xanh (tiến triển tốt)

        // So sánh trạng thái hiện tại với trạng thái trước đó
        if ($trangThaiTruoc !== null && $trangThai < $trangThaiTruoc) {
            $mau = 'do'; // Nếu trạng thái giảm, đánh dấu màu đỏ
        }

        // Lưu kết quả
        $ketQua[] = [
            'TrangthaiDT' => $trangThai,
            'Mau' => $mau
        ];

        // Cập nhật trạng thái trước đó
        $trangThaiTruoc = $trangThai;
    }

    return $ketQua; // Trả về danh sách trạng thái với màu tương ứng
}

    

    function addMember()
    {
        if (isset($_POST['ID_DTSV']) && isset($_POST['ID_Sinhvien']) && isset($_POST['Hoten']) && isset($_POST['TenKhoa'])) {
            $ID_DTSV = $_POST['ID_DTSV'];
            $ID_Sinhvien = $_POST['ID_Sinhvien'];
            $Hoten = $_POST['Hoten'];
            $Tenkhoa = $_POST['TenKhoa'];

            // Kiểm tra xem ID_Sinhvien có tồn tại trong bảng sinhvien không
            $exists = $this->ChitietDT->kiemtraSinhvien($ID_Sinhvien);

            if ($exists) {
                // Nếu tồn tại, thêm vào bảng nhom
                $result = $this->ChitietDT->themThanhVien($ID_DTSV, $ID_Sinhvien, $Hoten, $Tenkhoa);
                echo json_encode(['status' => $result ? 'success' : 'fail']);
                exit();
            } else {
                // Nếu không tồn tại, trả về thông báo lỗi
                echo json_encode(['status' => 'fail', 'message' => 'Sinh viên chưa có trong hệ thống']);
            }
        }
    }

   
    

    
    function UploadFileBaoCao()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file_baocao']) && isset($_POST['ID_DTSV'])) {
            $ID_DTSV = htmlspecialchars($_POST['ID_DTSV']);
            $file = $_FILES['file_baocao'];
    
            if ($file['error'] === UPLOAD_ERR_OK) {
                $allowedExtensions = ['pdf', 'doc', 'docx'];
                $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    
                if (in_array($fileExtension, $allowedExtensions)) {
                    $uploadDir = 'uploads/';
                    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
    
                    $fileName = $ID_DTSV . '_' . time() . '.' . $fileExtension;
                    $filePath = $uploadDir . $fileName;
    
                    if (move_uploaded_file($file['tmp_name'], $filePath)) {
                        // Lưu vào cơ sở dữ liệu (giả sử bạn đã làm điều này)
                            // Kiểm tra thông báo từ query string
                            $ID_Sinhvien = isset($_SESSION['ID']) ? $_SESSION['ID'] : null;

        $result = isset($_GET['result']) ? $_GET['result'] : null;
        if ($ID_Sinhvien) {
            $danhsachdkdetai = $this->ChitietDT->laydanhsachDTDK($ID_Sinhvien); // Truyền ID_Sinhvien vào phương thức
            $danhsachtenkhoa = $this->ChitietDT->laydanhsachtenkhoa();
        } else {
            $danhsachdkdetai = []; // Nếu không có ID_Sinhvien, trả về mảng rỗng
            $danhsachtenkhoa = [];
        }
                        $this->ChitietDT->saveUploadedFile($filePath, $ID_DTSV);
                        $this->view('Masterlayout_student', [
                            'page' => 'ChitietDT',
                            'danhsachdkdetai' => $danhsachdkdetai,
                            'danhsachtenkhoa' => $danhsachtenkhoa,
                            'result' => $result
                        ]);
                        // Trả về thông báo thành công
                        echo json_encode(['status' => 'success', 'message' => 'Nộp báo cáo thành công!', 'file_name' => $fileName]);
                        return;
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'Không thể lưu file.', 'file_name' => $fileName]);
                        return;
                    }
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Định dạng file không được hỗ trợ.']);
                    return;
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Lỗi tải file.']);
                return;
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Dữ liệu không hợp lệ.']);
            return;
        }
    }

  
   
}
?>
