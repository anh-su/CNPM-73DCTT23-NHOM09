<?php
class QuanlyDT_m extends connectDB
{
    function detai_ins($Madetai, $Tendetai, $Tieude, $Ngaybatdau, $Ngayketthuc, $Mota) {
        // Kiểm tra xem dữ liệu có rỗng không
        if (
            empty($Madetai) || empty($Tendetai) || empty($Tieude) || 
            empty($Ngaybatdau) || empty($Ngayketthuc) || empty($Mota)
        ) {
            return "empty_fields";
        }
    
        // Đặt trạng thái mặc định là "Chờ thực hiện"
        $Trangthai = "Đã Tạo";
    
        // Tạo câu lệnh SQL để thêm đề tài
        $sql = "INSERT INTO detai (Madetai, Tendetai, Tieude, Trangthai, Ngaybatdau, Ngayketthuc, Mota) 
                VALUES ('$Madetai', '$Tendetai', '$Tieude', '$Trangthai', '$Ngaybatdau', '$Ngayketthuc', '$Mota')";
    
        return mysqli_query($this->con, $sql) ? "success" : "fail";
    }
    
    function checktrungmadetai($Madetai){
       // Kiểm tra xem $id có rỗng không
       if (empty($Madetai)) {
        return "empty_fields";
    }

    $sql = "SELECT * FROM detai WHERE Madetai ='$Madetai'";
    $dl = mysqli_query($this->con, $sql);

    return mysqli_num_rows($dl) > 0 ? "duplicate" : "not_duplicate";
    }

    function laydanhsachdetai()
    {
        $sql = "SELECT Madetai, Tendetai, Tieude, Trangthai, Ngaybatdau, Ngayketthuc, Mota FROM detai";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $danhsachdetai = [];
        $currentDate = date('Y-m-d');

        while ($row = $result->fetch_assoc()) {
            if ($currentDate > $row['Ngayketthuc']) {
                $row['Trangthai'] = 'Đã Kết Thúc';
                $this->updateTrangThaiDetai($row['Madetai'], 'Đã Kết Thúc');
            }
            $danhsachdetai[] = $row;
        }
        return $danhsachdetai;
    }

    function updateTrangThaiDetai($Madetai, $newStatus)
    {
        $sql = "UPDATE detai SET Trangthai = ? WHERE Madetai = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('ss', $newStatus, $Madetai);
        $stmt->execute();
    }

    function detai_update($Madetai, $Tendetai, $Tieude, $Ngaybatdau, $Ngayketthuc, $Mota)
    {
        $sql = "UPDATE detai SET Tendetai = ?, Tieude = ?, Ngaybatdau = ?, Ngayketthuc = ?, Mota = ? WHERE Madetai = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('ssssss', $Tendetai, $Tieude, $Ngaybatdau, $Ngayketthuc, $Mota, $Madetai);
        return $stmt->execute() ? "update_success" : "fail";
    }

    function detai_delete($Madetai)
    {
        $sql = "DELETE FROM detai WHERE Madetai = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('s', $Madetai);
        return $stmt->execute() ? "delete_success" : "delete_fail";
    }
}
?>
