<?php



class DSdetai_m extends connectDB
{
    function laydanhsachDT()
    {
        // Truy vấn để lấy thông tin đề tài đăng ký cho tất cả sinh viên trong nhóm
        $sql = "
        SELECT DISTINCT sv.ID_DTSV, d.Madetai, d.Tendetai AS Tendetai_Detai, sv.Hoten,
               sv.Tendetai AS Tendetai_Detaisinhvien, sv.Hotengv, sv.TrangthaiDT  
        FROM nhom AS n
        JOIN detaisinhvien AS sv ON n.ID_DTSV = sv.ID_DTSV
        JOIN detai AS d ON d.Tendetai = sv.Tendetai";
        
        // Sử dụng câu lệnh chuẩn bị (prepared statement) để bảo vệ khỏi SQL Injection
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result;
    }

    public function layDanhSachThanhVien($ID_DTSV)
    {
        $sql = "
            SELECT sv.ID_Sinhvien, sv.Hoten, sv.Ngaysinh, sv.Diachi, sv.Email, sv.Sdt, sv.Gioitinh, n.Tenkhoa
            FROM nhom AS n
            JOIN sinhvien AS sv ON n.ID_Sinhvien = sv.ID_Sinhvien
            WHERE n.ID_DTSV = ?
        ";
    
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('s', $ID_DTSV);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $members = [];
        while ($row = $result->fetch_assoc()) {
            $members[] = $row;
        }
    
        return $members;
    }
    

    function DSdetai_find($Tendetai)
    {
        // SQL query với điều kiện tìm kiếm theo ID_TK và ID_Sinhvien
        $sql = "
            SELECT DISTINCT sv.ID_DTSV, d.Madetai, d.Tendetai AS Tendetai_Detai, sv.Hoten,
                   sv.Tendetai AS Tendetai_Detaisinhvien, sv.Hotengv, sv.TrangthaiDT  
            FROM nhom AS n
            JOIN detaisinhvien AS sv ON n.ID_DTSV = sv.ID_DTSV
            JOIN detai AS d ON d.Tendetai = sv.Tendetai"; 

        // Thêm điều kiện tìm kiếm nếu có giá trị
        if ($Tendetai) {
            $sql .= " AND d.Tendetai LIKE '%$Tendetai%'"; // Tìm kiếm theo ID_TK
        }

        // Thực hiện truy vấn và trả về kết quả
        $result = mysqli_query($this->con, $sql);

        if (!$result) {
            echo "Lỗi truy vấn: " . mysqli_error($this->con);
            return [];
        }
    }

    function laytendetai()
    {
        $sql = "SELECT Tendetai FROM detai";
        return mysqli_query($this->con, $sql);
    }

    public function updateTrangThaiDetai($ID_DTSV, $newStatus)
    {
        // SQL cập nhật trạng thái trong detaisinhvien
        $sql1 = "UPDATE detaisinhvien SET TrangthaiDT = ? WHERE ID_DTSV = ?";
        // SQL thêm trạng thái mới vào lichsutrangthai
        $sql2 = "INSERT INTO lichsutrangthai (ID_DTSV, TrangthaiDT, Thoigian) VALUES (?, ?, CURRENT_TIMESTAMP)";
    
        $this->con->begin_transaction(); // Bắt đầu giao dịch
        try {
            // Cập nhật trạng thái trong detaisinhvien
            $stmt1 = $this->con->prepare($sql1);
            if (!$stmt1) {
                throw new Exception("Prepare failed for detaisinhvien: " . $this->con->error);
            }
            $stmt1->bind_param('ss', $newStatus, $ID_DTSV);
            if (!$stmt1->execute()) {
                throw new Exception("Failed to update detaisinhvien: " . $stmt1->error);
            }
    
            // Thêm trạng thái mới vào bảng lichsutrangthai
            $stmt2 = $this->con->prepare($sql2);
            if (!$stmt2) {
                throw new Exception("Prepare failed for lichsutrangthai: " . $this->con->error);
            }
            $stmt2->bind_param('ss', $ID_DTSV, $newStatus);
            if (!$stmt2->execute()) {
                throw new Exception("Failed to insert into lichsutrangthai: " . $stmt2->error);
            }
    
            $this->con->commit(); // Xác nhận giao dịch
            return ['status' => true];
        } catch (Exception $e) {
            $this->con->rollback(); // Hoàn tác nếu có lỗi
            return ['status' => false, 'error' => $e->getMessage()];
        }
    }
    

    public function rejectDetai($ID_DTSV)
    {
        return $this->updateTrangThaiDetai($ID_DTSV, 'Từ Chối');
    }

    public function layDanhSachGiangVien() {
        $sql = "SELECT ID_Giangvien, Hoten FROM giangvien";
        $result = $this->con->query($sql);
        $danhsach = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $danhsach[] = $row;
            }
        }
        return $danhsach;
    }

    public function layIDGiangVien($Hoten) {
        $sql = "SELECT ID_Giangvien FROM giangvien WHERE Hoten = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('s', $Hoten);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['ID_Giangvien'];
    }

    public function kiemTraPhanCongTonTai($ID_DTSV, $madetai, $lecturerID) {
        $sql = "SELECT COUNT(*) as count FROM phancong WHERE ID_DTSV = ? AND Madetai = ? AND ID_Giangvien = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('sss', $ID_DTSV, $madetai, $lecturerID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['count'] > 0;
    }

    public function phanCongGiangVien($ID_DTSV, $madetai, $lecturerID, $lecturer) {
        if ($this->kiemTraPhanCongTonTai($ID_DTSV, $madetai, $lecturerID)) {
            return ['status' => false, 'error' => 'Phân công đã tồn tại.'];
        }
    
        $sql = "INSERT INTO phancong (ID_DTSV, Madetai, ID_Giangvien, Hoten) VALUES (?, ?, ?, ?)";
        $stmt = $this->con->prepare($sql);
    
        if (!$stmt) {
            error_log("Prepare failed: " . $this->con->error); // Log the error
            return ['status' => false, 'error' => $this->con->error];
        }
    
        $stmt->bind_param('ssss', $ID_DTSV, $madetai, $lecturerID, $lecturer);
        if (!$stmt->execute()) {
            error_log("Execute failed: " . $stmt->error); // Log the error
            return ['status' => false, 'error' => $stmt->error];
        }
    
        // Update the TrangthaiDT field in the detaisinhvien table
        $updateStatus = $this->updateTrangThaiDetai($ID_DTSV, 'Đã Duyệt / Đã Phân Công');
        if (!$updateStatus['status']) {
            return ['status' => false, 'error' => $updateStatus['error']];
        }
    
        // Gửi thông báo cho giảng viên được phân công
        $notificationStatus = $this->guiThongBaoGiangVien($ID_DTSV, $lecturer);
        if (!$notificationStatus['status']) {
            return ['status' => false, 'error' => $notificationStatus['error']];
        }
    
        return ['status' => true];
    }
    
    private function guiThongBaoGiangVien($ID_DTSV, $lecturer) {
        $hoten = $_SESSION['Hoten']; // Lấy tên từ session
        $tieude = "Xin chào giảng viên!!!";
        $noidung = "Giảng viên đã được phân công chấm đề tài.";
        $thoigian = date('Y-m-d H:i:s'); // Lấy thời gian hiện tại
    
        $sql = "INSERT INTO thongbao (Hoten, Tieude, Noidung, ID_DTSV, Thoigian) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->con->prepare($sql);
    
        if (!$stmt) {
            error_log("Prepare failed: " . $this->con->error); // Log the error
            return ['status' => false, 'error' => $this->con->error];
        }
    
        $stmt->bind_param('sssss', $hoten, $tieude, $noidung, $ID_DTSV, $thoigian);
        if (!$stmt->execute()) {
            error_log("Execute failed: " . $stmt->error); // Log the error
            return ['status' => false, 'error' => $stmt->error];
        }
    
        return ['status' => true];
    }
    

}
?>