<?php
class Danhgiasv extends Controller
{
    private $Danhgiasv;

    function __construct()
    {
        $this->Danhgiasv = $this->model('Danhgiasv_m'); // Kết nối tới model Danhgia_m
    }

    // Hiển thị trang chính
    public function Get_data()
    {

         // Kiểm tra xem session có chứa ID_SV hay không
    if (!isset($_SESSION['ID'])) {
        die("Bạn cần đăng nhập để xem thông tin."); // Thông báo lỗi nếu chưa đăng nhập
    }

    // Lấy ID sinh viên từ session
    $studentID = $_SESSION['ID'];
        // Lấy danh sách tên đề tài và số lượng đề tài
        $topicNames = $this->Danhgiasv->getTopicNames();
    
        // Lấy điểm của tất cả sinh viên theo từng đề tài
        $studentScores = $this->Danhgiasv->getStudentScoresByTopic($studentID);
        
        // Chuyển dữ liệu vào view
        $this->view('Masterlayout_student', [
            'page' => 'Danhgiasv',
            'topicNames' => $topicNames, 
            'studentScores' => $studentScores
        ]);
    }
    
}
?>
