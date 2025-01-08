<?php
class Thongkegv_m extends connectDB
{
    // Cập nhật thông tin admin
    // Phương thức lấy danh sách tên đề tài và số nhóm đã chấm dựa trên ID_Giangvien
    public function getDanhSachDeTai($id_giangvien)
    {
        try {
            // Câu lệnh SQL để lấy tên các đề tài được phân công và số nhóm đã chấm
            $sql = "
                SELECT dt.Tendetai, COUNT(pc.ID_DTSV) AS SoNhomDaCham
                FROM phancong pc
                JOIN detai dt ON pc.Madetai = dt.Madetai
                WHERE pc.ID_Giangvien = ?
                GROUP BY dt.Tendetai;
            ";

            // Chuẩn bị truy vấn
            $stmt = $this->con->prepare($sql);

            // Gán tham số với phương thức bind_param cho mysqli
            $stmt->bind_param('s', $id_giangvien);  // 's' chỉ định tham số là kiểu chuỗi (string)

            // Thực thi truy vấn
            $stmt->execute();

            // Lấy danh sách kết quả
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (mysqli_sql_exception $e) {
            // Xử lý lỗi (ghi log hoặc thông báo lỗi)
            echo "Lỗi: " . $e->getMessage();
            return [];
        }
    }
}
?>
