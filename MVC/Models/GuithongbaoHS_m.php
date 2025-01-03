<?php
class GuithongbaoHS_m extends connectDB
{
    function layDanhSachMonHocTen()
    {
        $sql = "SELECT Tenlop FROM lophoc";
        $result = $this->con->query($sql);

        if (!$result) {
            echo "Lỗi truy vấn: " . $this->con->error;
            return false;
        }

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function layDanhSachID_DTSV()
    {
        $query = "SELECT ID_DTSV FROM detaisinhvien";
        $result = $this->con->query($query);
        $danhSachID_DTSV = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $danhSachID_DTSV[] = $row;
            }
        }
        return $danhSachID_DTSV;
    }

    function thongbao_ins($td, $nd, $id_dtsv, $hoten, $thoigian)
    {
        if (empty($td) || empty($nd) || empty($id_dtsv) || empty($hoten) || empty($thoigian)) {
            echo "Dữ liệu không được để trống!";
            return false;
        }

        $stmt = $this->con->prepare("INSERT INTO thongbao (Hoten, Tieude, Noidung, ID_DTSV, Thoigian) VALUES (?, ?, ?, ?, ?)");
        if ($stmt === false) {
            echo "Lỗi chuẩn bị câu lệnh: " . $this->con->error;
            return false;
        }
        $stmt->bind_param("sssss", $hoten, $td, $nd, $id_dtsv, $thoigian);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            echo "Lỗi truy vấn: " . $stmt->error;
            $stmt->close();
            return false;
        }
    }

    public function resetAllThongbao()
    {
        // Lấy tên người đăng nhập từ session
        $hoten = $_SESSION['Hoten'];
    
        // Chuẩn bị câu lệnh xóa thông báo của người đăng nhập
        $stmt = $this->con->prepare("DELETE FROM thongbao WHERE Hoten = ?");
        
        if ($stmt === false) {
            echo "Lỗi chuẩn bị câu lệnh xoá: " . $this->con->error;
            return false;
        }
    
        // Liên kết tham số với câu lệnh SQL
        $stmt->bind_param('s', $hoten);
    
        // Thực thi câu lệnh
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            echo "Lỗi xoá thông báo: " . $stmt->error;
            $stmt->close();
            return false;
        }
    }
    

    function layDanhSachThongBao()
    {
        // Kiểm tra xem session Hoten có tồn tại không
        if (!isset($_SESSION['Hoten'])) {
            echo "Người dùng chưa đăng nhập.";
            return [];
        }
    
        // Lấy Hoten từ session
        $hotenNguoiDung = $_SESSION['Hoten'];
    
        // Chuẩn bị câu truy vấn với điều kiện Hoten
        $sql = "SELECT * FROM thongbao WHERE Hoten = ?";
        $stmt = $this->con->prepare($sql);
    
        if (!$stmt) {
            echo "Lỗi chuẩn bị truy vấn: " . $this->con->error;
            return [];
        }
    
        // Gắn giá trị Hoten vào truy vấn
        $stmt->bind_param('s', $hotenNguoiDung);
    
        // Thực thi truy vấn
        if (!$stmt->execute()) {
            echo "Lỗi thực thi truy vấn: " . $stmt->error;
            return [];
        }
    
        // Lấy kết quả và chuyển thành mảng
        $result = $stmt->get_result();
        $thongbaoList = $result->fetch_all(MYSQLI_ASSOC);
    
        // Trả về danh sách thông báo
        return $thongbaoList;
    }
    

    function xoaThongbaoById($id)
    {
        $stmt = $this->con->prepare("DELETE FROM thongbao WHERE ID = ?");
        if ($stmt === false) {
            echo "Lỗi chuẩn bị câu lệnh xoá: " . $this->con->error;
            return false;
        }
        
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            echo "Lỗi truy vấn: " . $stmt->error;
            $stmt->close();
            return false;
        }
    }

    function suaThongbaoById($id, $td, $nd, $id_dtsv)
    {
        if (empty($id) || empty($td) || empty($nd) || empty($id_dtsv)) {
            echo "Dữ liệu không được để trống!";
            return false;
        }

        $stmt = $this->con->prepare("UPDATE thongbao SET Tieude = ?, Noidung = ?, ID_DTSV = ? WHERE ID = ?");
        if ($stmt === false) {
            echo "Lỗi chuẩn bị câu lệnh sửa: " . $this->con->error;
            return false;
        }

        $stmt->bind_param("sssi", $td, $nd, $id_dtsv, $id);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            echo "Lỗi truy vấn: " . $stmt->error;
            $stmt->close();
            return false;
        }
    }
}
?>
