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

    function resetAllThongbao()
    {
        $stmt = $this->con->prepare("DELETE FROM thongbao");
        if ($stmt === false) {
            echo "Lỗi chuẩn bị câu lệnh xoá: " . $this->con->error;
            return false;
        }

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
        $sql = "SELECT * FROM thongbao";
        $result = $this->con->query($sql);

        if (!$result) {
            echo "Lỗi truy vấn: " . $this->con->error;
            return [];
        }

        $thongbaoList = $result->fetch_all(MYSQLI_ASSOC);
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
