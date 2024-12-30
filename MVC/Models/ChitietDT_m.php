<?php

class ChitietDT_m extends connectDB
{
    function laydanhsachDTDK($ID_Sinhvien)
    {
        // Truy vấn để lấy thông tin đề tài đăng ký cho sinh viên cùng nhóm (ID_DTSV) và thông tin từ bảng ketqua
        $sql = "
        SELECT sv.ID_DTSV, d.Madetai, d.Tendetai AS Tendetai_Detai, 
               sv.Tendetai AS Tendetai_Detaisinhvien, sv.Hotengv, sv.TrangthaiDT,
               k.Hoten, k.Diem, k.Nhanxet  -- Thêm thông tin từ bảng ketqua
        FROM nhom AS n
        JOIN detaisinhvien AS sv ON n.ID_DTSV = sv.ID_DTSV
        JOIN detai AS d ON d.Tendetai = sv.Tendetai
        LEFT JOIN ketqua AS k ON k.ID_DTSV = sv.ID_DTSV  -- Kết nối với bảng ketqua theo ID_DTSV
        WHERE n.ID_Sinhvien = ? 
        LIMIT 0, 25;
        ";
    
        // Sử dụng câu lệnh chuẩn bị (prepared statement) để bảo vệ khỏi SQL Injection
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('s', $ID_Sinhvien); // 's' chỉ ra rằng ID_Sinhvien là kiểu string
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result;
    }
    
    function laydanhsachidkhoa()
    {
        $sql = "SELECT Tenkhoa FROM khoa";
        return mysqli_query($this->con, $sql);
    }

    function laydanhsachtenkhoa()
    {
        $sql = "SELECT Tenkhoa FROM khoa";
        $result = mysqli_query($this->con, $sql);
        $danhsachtenkhoa = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $danhsachtenkhoa[] = $row;
        }
        return $danhsachtenkhoa;
    }

    function kiemtraSinhvien($ID_Sinhvien)
    {
        $sql = "SELECT COUNT(*) as count FROM sinhvien WHERE ID_Sinhvien = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('s', $ID_Sinhvien);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['count'] > 0;
    }

    function themThanhVien($ID_DTSV, $ID_Sinhvien, $Hoten, $Tenkhoa)
    {
        $sql = "INSERT INTO nhom (ID_DTSV, ID_Sinhvien, Hoten, Tenkhoa) VALUES (?, ?, ?, ?)";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('ssss', $ID_DTSV, $ID_Sinhvien, $Hoten, $Tenkhoa);
        return $stmt->execute();
    }

    
    public function layChiTietDeTaiSinhVien($ID_DTSV) {
        $stmt = $this->con->prepare("SELECT ID_DTSV, Tendetai, ID_Sinhvien,Hoten, Hotengv,Mota, Tenkhoa, TrangthaiDT, Filebaitap FROM detaisinhvien WHERE ID_DTSV = ?");
        $stmt->bind_param('s', $ID_DTSV);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
  

    public function saveUploadedFile($file_path, $ID_DTSV)
    {
       
        $sql = "UPDATE detaisinhvien SET Filebaitap = ? WHERE ID_DTSV = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('ss', $file_path, $ID_DTSV);
        $stmt->execute();
    }
    

    // Lấy trạng thái dựa trên ID_DTSV
    public function layLichSuTrangThai($ID_DTSV)
{
    // Truy vấn lấy danh sách trạng thái sắp xếp theo thời gian
    $sql = "SELECT TrangthaiDT FROM lichsutrangthai WHERE ID_DTSV = ? ORDER BY Thoigian ASC";
    $stmt = $this->con->prepare($sql);
    $stmt->bind_param('s', $ID_DTSV);
    $stmt->execute();
    $result = $stmt->get_result();

    $trangThai = [];
    while ($row = $result->fetch_assoc()) {
        $trangThai[] = $row['TrangthaiDT'];
    }
    return $trangThai; // Trả về danh sách trạng thái
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

    
  
}
?>