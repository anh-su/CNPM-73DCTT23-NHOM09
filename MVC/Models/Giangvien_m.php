<?php
class Giangvien_m extends connectDB
{
    public function getAllGiangvien()
    {
        $sql = "SELECT ID_Giangvien, Hoten, Ngaysinh, Diachi, Email, Sdt, Gioitinh, ID_Khoa FROM giangvien";
        return $this->con->query($sql); 
    }
    public function deleteGiangvienById($idGiangvien)
{
    $sql = "DELETE FROM giangvien WHERE ID_Giangvien = ?";
    $stmt = $this->con->prepare($sql);
    $stmt->bind_param("s", $idGiangvien);
    return $stmt->execute();
}
public function updateGiangvien($idGiangvien, $hoten, $ngaysinh, $diachi, $sdt, $email, $gioitinh,$khoa)
{
    $sql = "UPDATE giangvien
            SET Hoten = ?, Ngaysinh = ?, Diachi = ?, Sdt = ?, Email = ?, Gioitinh = ?,ID_Khoa = ?
            WHERE ID_Giangvien = ?";
    $stmt = $this->con->prepare($sql);
    $stmt->bind_param("ssssssss", $hoten, $ngaysinh, $diachi, $sdt, $email, $gioitinh,$khoa, $idGiangvien);
    return $stmt->execute();
}
function Giangvien_ins($ID_Giangvien, $Hoten, $Ngaysinh, $Diachi, $Email, $Sdt, $Gioitinh,$ID_Khoa,) {
    if (
        empty($ID_Giangvien) || empty($Hoten) || empty($Ngaysinh) || 
        empty($Diachi) || empty($Email) || empty( $Sdt) || empty($Gioitinh)  || empty($ID_Khoa)
    ) {
        return "empty_fields";
    }

    // Tạo câu lệnh SQL để thêm đề tài
    $sql ="INSERT INTO giangvien VALUES('$ID_Giangvien', '$Hoten', '$Ngaysinh', '$Diachi', '$Email', '$Sdt', '$Gioitinh','$ID_Khoa')";

    return mysqli_query($this->con, $sql) ? "success" : "fail";
}


function checktrungmagv($ID_Giangvien){
    // Kiểm tra xem $id có rỗng không
    if (empty($ID_Giangvien)) {
     return "empty_fields";
 }

 $sql = "SELECT * FROM giangvien WHERE ID_Giangvien ='$ID_Giangvien'";
 $dl = mysqli_query($this->con, $sql);

 return mysqli_num_rows($dl) > 0 ? "duplicate" : "not_duplicate";
 }

function laydanhsachidkhoa()
{
    $sql = "SELECT ID_Khoa FROM khoa";
    return mysqli_query($this->con, $sql);
}




}
?>