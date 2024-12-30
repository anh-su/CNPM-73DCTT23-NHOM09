<?php
class SVdangkydt extends controller
{
    private $SVdangkydt;

    function __construct()
    {
        $this->SVdangkydt = $this->model('SVdangkydt_m');
    }

    function Get_data()
    {
        // Lấy ID_Sinhvien từ session
        $ID_Sinhvien = isset($_SESSION['ID']) ? $_SESSION['ID'] : null;


        // Kiểm tra thông báo từ query string
        $result = isset($_GET['result']) ? $_GET['result'] : null;

        // Nếu có ID_Sinhvien, lấy danh sách các đề tài đã đăng ký
        if ($ID_Sinhvien) {
            $danhsachdkdetai = $this->SVdangkydt->laydanhsachDTDK($ID_Sinhvien); // Truyền ID_Sinhvien vào phương thức
        } else {
            $danhsachdkdetai = []; // Nếu không có ID_Sinhvien, trả về mảng rỗng
        }



        // Lấy các danh sách khác (tên đề tài, giảng viên, khoa)
        $danhsachtendetai = $this->SVdangkydt->laytendetai();
        $danhsachtengv = $this->SVdangkydt->laytengv();
        $danhsachtenkhoa = $this->SVdangkydt->laytenkhoa();


        // Truyền tất cả dữ liệu vào view
        $this->view('Masterlayout_student', [
            'page' => 'SVdangkydt',
            'danhsachtendetai' => $danhsachtendetai,
            'danhsachtengv' => $danhsachtengv,
            'danhsachtenkhoa' => $danhsachtenkhoa,
            'danhsachdkdetai' => $danhsachdkdetai,

            'result' => $result // Thêm thông báo nếu có
        ]);
    }



    function dangky()
    {
        if (isset($_POST['btndangky'])) {
            // Xử lý đăng ký
            $result = $this->dangkydt();
    
            // Lấy ID_Sinhvien từ session
            $ID_Sinhvien = isset($_SESSION['ID']) ? $_SESSION['ID'] : null;
            $Hoten = isset($_SESSION['Hoten']) ? $_SESSION['Hoten'] : null;
    
            if ($result === 'success') {
                // Xử lý thêm thành viên nếu có
                $addedSelf = false; // Biến để theo dõi nếu sinh viên đăng nhập đã được thêm
                if (isset($_POST['members']) && !empty($_POST['members'])) {
                    $members = json_decode($_POST['members'], true); // Giải mã chuỗi JSON thành mảng
                    if (is_array($members)) {
                        foreach ($members as $member) {
                            $this->SVdangkydt->themThanhVien(
                                $_POST['txtID_DTSV'],
                                $member['ID_Sinhvien'],
                                $member['Hoten'],
                                $_POST['txtTenkhoa']
                            );
                            // Kiểm tra nếu thành viên hiện tại là sinh viên đăng nhập
                            if ($member['ID_Sinhvien'] == $ID_Sinhvien) {
                                $addedSelf = true;
                            }
                        }
                    }
                }
    
                // Nếu chưa thêm sinh viên đăng nhập, tự động thêm
                if (!$addedSelf && $ID_Sinhvien !== null && $Hoten !== null) {
                    $this->SVdangkydt->themThanhVien(
                        $_POST['txtID_DTSV'],
                        $ID_Sinhvien,
                        $Hoten,
                        $_POST['txtTenkhoa']
                    );
                }
    
                // Chuyển hướng về lại trang sau khi đăng ký thành công
                header('Location: http://localhost/Doan/SVdangkydt');
                exit();
            } else {
                // Xử lý lỗi và hiển thị thông báo
                $danhsachdkdetai = $this->SVdangkydt->laydanhsachDTDK($ID_Sinhvien);
    
                $this->view('Masterlayout_student', [
                    'page' => 'SVdangkydt',
                    'danhsachdkdetai' => $danhsachdkdetai,
                    'result' => 'fail'
                ]);
            }
        }
    }
    





    function dangkydt()
    {
        $ID_DTSV = $_POST['txtID_DTSV'] ?? '';
        $Tendetai = $_POST['txtTendetai'] ?? '';
        $ID_Sinhvien = $_POST['txtID_Sinhvien'] ?? '';
        $Hoten = $_POST['txtHoten'] ?? '';
        $Tenkhoa = $_POST['txtTenkhoa'];
        $Hotengv = $_POST['txtHotengv'] ?? '';
        $Mota = $_POST['txtMota'] ?? '';


        $checkResult = $this->SVdangkydt->checktrungnhom($ID_DTSV);

        if ($checkResult == "duplicate") {
            return "duplicate";  // Nếu trùng mã tài khoản

        }

        // Kiểm tra dữ liệu trùng lặp trước khi thêm
        $checkExist = $this->SVdangkydt->Dangkydt_ins($ID_DTSV, $Tendetai, $ID_Sinhvien, $Hoten, $Tenkhoa, $Hotengv, $Mota);


        return $checkExist; // Trả về kết quả từ model
    }

  
    
    // Phương thức hiển thị danh sách sinh viên của một nhóm
    public function Get_member_details()
    {
        if (!empty($_POST['ID_DTSV'])) {
            $ID_DTSV = htmlspecialchars($_POST['ID_DTSV']);
            $members = $this->SVdangkydt->layDanhSachThanhVien($ID_DTSV);
    
            if (!empty($members)) {
                $output = '<table class="table table-striped table-bordered">';
                $output .= '<thead class="thead-dark">
                                <tr>
                                    <th>STT</th>
                                    <th>ID Sinh Viên</th>
                                    <th>Họ và tên</th>
                                    <th>Ngày Sinh</th>
                                    <th>Địa Chỉ</th>
                                    <th>Email</th>
                                    <th>Liên Hệ</th>
                                    <th>Giới Tính</th>
                                    <th>Tên Khoa</th>
                                </tr>
                            </thead>
                            <tbody>';
    
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
            } else {
                echo '<p>Không có thành viên trong nhóm này.</p>';
            }
        } else {
            echo '<p>Yêu cầu không hợp lệ.</p>';
        }
    }
    
}
