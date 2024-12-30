<?php
class Danhgiasv extends Controller
{
    private $Danhgiasv;

    function __construct()
    {
        $this->Danhgiasv = $this->model('Danhgiasv_m'); // Kết nối tới model Danhgia_m
    }

    // Hiển thị trang chính
    function Get_data()
    {
          // Lấy danh sách tên đề tài và số lượng đề tài
          $topicNames = $this->Danhgiasv->getTopicNames();
        
          $topicCounts = [];
          foreach ($topicNames as $topicName) {
              $topicCounts[] = $this->Danhgiasv->countGroupsForTopic($topicName);
          }
        $this->view('Masterlayout_student', [
            'page' => 'Danhgia', // Load nội dung trang Danhgia
            'topicNames' => $topicNames, 
            'topicCount' => $topicCounts
        ]);
    }
}
?>
