<?php
class Danhgia extends Controller
{
    private $Danhgia;

    function __construct()
    {
        $this->Danhgia = $this->model('Danhgia_m'); // Kết nối tới model Danhgia_m
    }

    // Hiển thị trang chính
    function Get_data()
    {
          // Lấy danh sách tên đề tài và số lượng đề tài
          $topicNames = $this->Danhgia->getTopicNames();
        
          $topicCounts = [];
          foreach ($topicNames as $topicName) {
              $topicCounts[] = $this->Danhgia->countGroupsForTopic($topicName);
          }
        $this->view('Masterlayout', [
            'page' => 'Danhgia', // Load nội dung trang Danhgia
            'topicNames' => $topicNames, 
            'topicCount' => $topicCounts
        ]);
    }
}
?>
