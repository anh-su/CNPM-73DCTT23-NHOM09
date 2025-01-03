<?php

class Danhgiasv_m extends connectDB
{

    // Lấy danh sách các tên đề tài
    public function getTopicNames()
    {
        $sql = "SELECT DISTINCT TenDetai FROM detai";
        $result = $this->con->query($sql);

        $topicNames = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $topicNames[] = $row['TenDetai'];
            }
        }
        return $topicNames;
    }

    // Lấy điểm của sinh viên cho từng đề tài
    public function getStudentScoresByTopic($studentID)
    {
        // Truy vấn với tham số chuẩn bị
        $sql = "SELECT nhom.ID_DTSV, ketqua.Diem, detaisinhvien.Tendetai
            FROM nhom
            JOIN detaisinhvien ON nhom.ID_DTSV = detaisinhvien.ID_DTSV
            JOIN ketqua ON nhom.ID_DTSV = ketqua.ID_DTSV
            WHERE nhom.ID_Sinhvien = ?
            ORDER BY nhom.ID_DTSV, detaisinhvien.Tendetai";

        // Chuẩn bị truy vấn
        $stmt = $this->con->prepare($sql);
        if (!$stmt) {
            die("Chuẩn bị truy vấn thất bại: " . $this->con->error);
        }

        // Gắn giá trị tham số
        $stmt->bind_param('s', $studentID);

        // Thực thi truy vấn
        $stmt->execute();

        // Lấy kết quả
        $result = $stmt->get_result();

        // Chuẩn bị mảng lưu dữ liệu
        $scores = [];

        while ($row = $result->fetch_assoc()) {
            $groupID = $row['ID_DTSV'];
            $topicName = $row['Tendetai'];
            $score = $row['Diem'];

            // Tạo cấu trúc dữ liệu để lưu điểm cho từng đề tài
            if (!isset($scores[$groupID])) {
                $scores[$groupID] = [];
            }
            $scores[$groupID][$topicName] = $score;
        }

        // Đóng truy vấn
        $stmt->close();

        return $scores;
    }




}

?>