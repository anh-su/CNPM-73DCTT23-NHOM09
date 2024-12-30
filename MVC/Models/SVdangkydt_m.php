<?php



class SVdangkydt_m extends connectDB
{
    function checktrungnhom($ID_DTSV)
    {
        // Kiểm tra xem $id có rỗng không


        $sql = "SELECT * FROM detaisinhvien WHERE ID_DTSV ='$ID_DTSV' ";
        $dl = mysqli_query($this->con, $sql);

        return mysqli_num_rows($dl) > 0 ? "duplicate" : "not_duplicate";
    }
    function Dangkydt_ins($ID_DTSV, $Tendetai, $ID_Sinhvien, $Hoten, $Tenkhoa, $Hotengv, $Mota)
    {
        if (empty($ID_DTSV) || empty($Tendetai) || empty($ID_Sinhvien) || empty($Hoten) || empty($Tenkhoa) || empty($Hotengv) || empty($Mota)) {
            return "empty_fields";
        }
    
        // Trạng thái ban đầu
        $TrangthaiDT = "Chờ Duyệt";
    
        // SQL để thêm vào bảng detaisinhvien
        $sql1 = "INSERT INTO detaisinhvien (ID_DTSV, Tendetai, ID_Sinhvien, Hoten, Tenkhoa, Hotengv, Mota, TrangthaiDT) 
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
        // SQL để thêm vào bảng lichsutrangthai
        $sql2 = "INSERT INTO lichsutrangthai (ID_DTSV, TrangthaiDT, Thoigian) 
                 VALUES (?, ?, CURRENT_TIMESTAMP)";
    
        $this->con->begin_transaction(); // Bắt đầu giao dịch
        try {
            // Thêm vào bảng detaisinhvien
            $stmt1 = $this->con->prepare($sql1);
            if ($stmt1) {
                $stmt1->bind_param("ssssssss", $ID_DTSV, $Tendetai, $ID_Sinhvien, $Hoten, $Tenkhoa, $Hotengv, $Mota, $TrangthaiDT);
                if (!$stmt1->execute()) {
                    throw new Exception("Failed to insert into detaisinhvien: " . $stmt1->error);
                }
            } else {
                throw new Exception("Prepare failed for detaisinhvien: " . $this->con->error);
            }
    
            // Thêm vào bảng lichsutrangthai
            $stmt2 = $this->con->prepare($sql2);
            if ($stmt2) {
                $stmt2->bind_param("ss", $ID_DTSV, $TrangthaiDT);
                if (!$stmt2->execute()) {
                    throw new Exception("Failed to insert into lichsutrangthai: " . $stmt2->error);
                }
            } else {
                throw new Exception("Prepare failed for lichsutrangthai: " . $this->con->error);
            }
    
            $this->con->commit(); // Xác nhận giao dịch
            return "success";
        } catch (Exception $e) {
            $this->con->rollback(); // Hoàn tác nếu có lỗi
            return "fail: " . $e->getMessage();
        }
    }
    


    function laytendetai() {
        $sql = "SELECT Tendetai FROM detai WHERE Trangthai != 'Đã Kết Thúc'";
        return mysqli_query($this->con, $sql);
    }
    

    function laytengv()
    {
        $sql = "SELECT Hoten FROM giangvien";
        return mysqli_query($this->con, $sql);
    }

    function laytenkhoa()
    {
        $sql = "SELECT Tenkhoa FROM khoa";
        return mysqli_query($this->con, $sql);
    }
    function laydanhsachDTDK($ID_Sinhvien)
    {
        // Truy vấn để lấy thông tin đề tài đăng ký cho sinh viên cùng nhóm (ID_DTSV)
        $sql = "
        SELECT sv.ID_DTSV, d.Madetai, d.Tendetai AS Tendetai_Detai, 
               sv.Tendetai AS Tendetai_Detaisinhvien, sv.Hotengv, sv.TrangthaiDT  
        FROM nhom AS n
        JOIN detaisinhvien AS sv ON n.ID_DTSV = sv.ID_DTSV
        JOIN detai AS d ON d.Tendetai = sv.Tendetai
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
    
    


    function Dangkydt_del($ID_DTSV)
{
    $sql = "DELETE FROM detaisinhvien  WHERE ID_DTSV ='$ID_DTSV'";
    return mysqli_query($this->con, $sql);
}

function nhom_del($ID_DTSV)
{
    $sql = "DELETE FROM nhom  WHERE ID_DTSV ='$ID_DTSV'";
    return mysqli_query($this->con, $sql);
}



public function layDanhSachThanhVien($ID_DTSV)
{
    $sql = "
       SELECT sv.ID_Sinhvien, sv.Hoten, sv.Ngaysinh, sv.Diachi, sv.Email, sv.Sdt, sv.Gioitinh
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


    // Hàm thêm thành viên vào cơ sở dữ liệu
    public function themThanhVien($ID_DTSV, $ID_Sinhvien, $Hoten, $Tenkhoa)
    {
        if (empty($ID_DTSV)  || empty($ID_Sinhvien) || empty($Hoten) || empty($Tenkhoa)) {
            return "empty_fields"; // Nếu có trường dữ liệu trống
        }

      
        // SQL để thêm thành viên vào cơ sở dữ liệu
        $sql = "INSERT INTO nhom (ID_DTSV, ID_Sinhvien, Hoten,Tenkhoa)  
                 VALUES (?, ?, ?, ?)";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ssss", $ID_DTSV, $ID_Sinhvien, $Hoten, $Tenkhoa);

        return $stmt->execute() ? "success" : "fail";
    }



    


}


?>