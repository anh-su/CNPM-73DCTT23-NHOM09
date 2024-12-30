<?php
class Sinhvien_m extends connectDB
{
    public function getAllSinhvien()
    {
        $sql = "SELECT ID_Sinhvien, Hoten, Ngaysinh, Diachi, Email, Sdt, Gioitinh, ID_Lop, ID_Khoa FROM sinhvien";
        return $this->con->query($sql); 
    }
    public function deleteSinhvienById($idSinhvien)
{
    $sql = "DELETE FROM sinhvien WHERE ID_Sinhvien = ?";
    $stmt = $this->con->prepare($sql);
    $stmt->bind_param("s", $idSinhvien);
    return $stmt->execute();
}
public function updateSinhvien($idSinhvien, $hoten, $ngaysinh, $diachi, $sdt, $email, $gioitinh)
{
    $sql = "UPDATE sinhvien 
            SET Hoten = ?, Ngaysinh = ?, Diachi = ?, Sdt = ?, Email = ?, Gioitinh = ?
            WHERE ID_Sinhvien = ?";
    $stmt = $this->con->prepare($sql);
    $stmt->bind_param("sssssss", $hoten, $ngaysinh, $diachi, $sdt, $email, $gioitinh, $idSinhvien);
    return $stmt->execute();
}
function Sinhvien_ins($ID_Sinhvien, $Hoten, $Ngaysinh, $Diachi, $Email, $Sdt, $Gioitinh,$ID_Lop,$ID_Khoa) {
    // Kiểm tra xem dữ liệu có rỗng không
    if (
        empty($ID_Sinhvien) || empty($Hoten) || empty($Ngaysinh) || 
        empty($Diachi) || empty($Email) || empty( $Sdt) || empty($Gioitinh) || empty($ID_Lop) || empty($ID_Khoa)
    ) {
        return "empty_fields";
    }

    // Tạo câu lệnh SQL để thêm đề tài
    $sql ="INSERT INTO sinhvien VALUES('$ID_Sinhvien', '$Hoten', '$Ngaysinh', '$Diachi', '$Email', '$Sdt', '$Gioitinh','$ID_Lop','$ID_Khoa')";

    return mysqli_query($this->con, $sql) ? "success" : "fail";
}


function checktrungmasv($ID_Sinhvien){
    // Kiểm tra xem $id có rỗng không
    if (empty($ID_Sinhvien)) {
     return "empty_fields";
 }

 $sql = "SELECT * FROM sinhvien WHERE ID_Sinhvien ='$ID_Sinhvien'";
 $dl = mysqli_query($this->con, $sql);

 return mysqli_num_rows($dl) > 0 ? "duplicate" : "not_duplicate";
 }

function laydanhsachidlop()
{
    $sql = "SELECT ID_Lop FROM lop";
    return mysqli_query($this->con, $sql);
}

function laydanhsachtenkhoa()
{
    $sql = "SELECT ID_Khoa FROM khoa";
    return mysqli_query($this->con, $sql);
}




}
?>