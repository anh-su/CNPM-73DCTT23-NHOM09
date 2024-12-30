<?php
class Nhiemvu_m extends connectDB
{
    // Hàm lấy danh sách nhóm đã được phân công cho giảng viên
    public function laydanhsachnhom($ID_Giangvien)
    {
        $sql = "
            SELECT pc.ID_DTSV, d.Madetai, d.Tendetai, sv.Hoten, sv.Tenkhoa, sv.TrangthaiDT, kq.Diem
            FROM phancong AS pc
            JOIN detai AS d ON pc.Madetai = d.Madetai
            JOIN detaisinhvien AS sv ON pc.ID_DTSV = sv.ID_DTSV
            LEFT JOIN ketqua AS kq ON pc.ID_DTSV = kq.ID_DTSV
            WHERE pc.ID_Giangvien = ?
        ";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('s', $ID_Giangvien);
        $stmt->execute();
        $result = $stmt->get_result();
        $danhsachnhom = [];
        while ($row = $result->fetch_assoc()) {
            $danhsachnhom[] = $row;
        }
        return $danhsachnhom;
    }

    // Hàm lấy chi tiết nhóm
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

    public function luuKetQua($ID_DTSV, $Hoten, $Diem, $Nhanxet)
    {
        // Bắt đầu giao dịch
        $this->con->begin_transaction();

        try {
            // Câu lệnh chèn hoặc cập nhật kết quả vào bảng ketqua
            $stmt = $this->con->prepare("INSERT INTO ketqua (ID_DTSV, Hoten, Diem, Nhanxet) 
                                         VALUES (?, ?, ?, ?) 
                                         ON DUPLICATE KEY UPDATE Diem = VALUES(Diem), Nhanxet = VALUES(Nhanxet)");
            $stmt->bind_param("ssds", $ID_DTSV, $Hoten, $Diem, $Nhanxet);
            if (!$stmt->execute()) {
                throw new Exception('Không thể lưu kết quả.');
            }

            // Câu lệnh chèn thông tin trạng thái vào bảng lichsutrangthai
            $sqlHistory = "INSERT INTO lichsutrangthai (ID_DTSV, TrangthaiDT, Thoigian) 
                           VALUES (?, 'Đã Chấm', NOW())";
            $stmtHistory = $this->con->prepare($sqlHistory);
            $stmtHistory->bind_param('s', $ID_DTSV);
            if (!$stmtHistory->execute()) {
                throw new Exception('Không thể lưu vào bảng lịch sử trạng thái.');
            }

            // Commit giao dịch
            $this->con->commit();

            return true; // Trả về true nếu mọi thao tác thành công
        } catch (Exception $e) {
            // Nếu có lỗi, rollback giao dịch
            $this->con->rollback();
            return false; // Trả về false nếu có lỗi
        }
    }


    public function capNhatTrangThai($ID_DTSV)
    {
        $sql = "UPDATE detaisinhvien SET TrangthaiDT = 'Đã Chấm' WHERE ID_DTSV = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('s', $ID_DTSV);
        return $stmt->execute();
    }

    // Hàm lấy điểm và nhận xét từ bảng ketqua
    public function layDiemVaNhanXet($ID_DTSV)
    {
        $sql = "SELECT Diem, Nhanxet FROM ketqua WHERE ID_DTSV = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('s', $ID_DTSV);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function capNhatDiemVaNhanXet($ID_DTSV, $Diem, $Nhanxet)
    {
        $sql = "UPDATE ketqua SET Diem = ?, Nhanxet=? WHERE ID_DTSV = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('sss', $Diem, $Nhanxet, $ID_DTSV);
        return $stmt->execute();
    }

    public function updateTrangthaiDT($ID_DTSV, $TrangthaiDT)
    {
        $sql = "UPDATE detaisinhvien SET TrangthaiDT = ? WHERE ID_DTSV = ?";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([$TrangthaiDT, $ID_DTSV]);
    }

    public function saveTrangthaiHistory($ID_DTSV, $TrangthaiDT)
    {
        $sql = "INSERT INTO lichsutrangthai (ID_DTSV, TrangthaiDT) VALUES (?, ?)";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([$ID_DTSV, $TrangthaiDT]);
    }

    public function getReportFilePath($ID_DTSV)
    {
        $sql = "SELECT Filebaitap FROM detaisinhvien WHERE ID_DTSV = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('s', $ID_DTSV);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row ? $row['Filebaitap'] : null;
    }
}

?>