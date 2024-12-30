<?php

class DStaikhoangv_m extends connectDB
{
      ////////////////GIẢNG VIÊN////////////////////
      

 // Kiểm tra trùng lặp ID tài khoản
 function checktrungmaTKGV($ID_TK,$ID_Giangvien){
    // Kiểm tra xem $id có rỗng không
  

    $sql = "SELECT * FROM quanlytk WHERE ID_TK ='$ID_TK' or ID_Giangvien ='$ID_Giangvien'" ;
    $dl = mysqli_query($this->con, $sql);

    return mysqli_num_rows($dl) > 0 ? "duplicate" : "not_duplicate";
}

// Thêm tài khoản Sinh viên vào cơ sở dữ liệu
function QuanlyTKGV_ins($ID_TK, $Tendangnhap, $Matkhau, $Vaitro,$ID_Sinhvien, $ID_Giangvien)
{
   

    // Gán vai trò luôn là 0 và ID_Giangvien, ID_Admin là NULL
    $Vaitro = 2;
    $ID_Sinhvien = null;
    $ID_Admin = null;

    // Câu lệnh SQL thêm tài khoản sinh viên
    $sql = "INSERT INTO quanlytk (ID_TK, Tendangnhap, Matkhau, Vaitro, ID_Sinhvien, ID_Giangvien, ID_Admin) 
            VALUES ('$ID_TK', '$Tendangnhap', '$Matkhau', '$Vaitro', '$ID_Sinhvien', '$ID_Giangvien', '$ID_Admin')";

    // Debugging SQL query (in ra câu lệnh SQL để kiểm tra)


    // Thực hiện truy vấn và trả kết quả
    return mysqli_query($this->con, $sql) ? "success" : "fail: " . mysqli_error($this->con);
}


function QuanlyTKGV_del($ID_TK)
{
    $sql = "DELETE FROM quanlytk WHERE ID_TK ='$ID_TK'";
    return mysqli_query($this->con, $sql);
}

//tìm kiếm theo id của các tài khoản

function QuanlyTKGV_find($ID_TK, $ID_Giangvien)
{
    // SQL query với điều kiện tìm kiếm theo ID_TK và ID_Sinhvien
    $sql = "SELECT ID_TK, Tendangnhap, Matkhau, Vaitro, ID_Giangvien FROM quanlytk WHERE Vaitro = 2";  // Chỉ tìm tài khoản sinh viên (Vaitro = 0)

    // Thêm điều kiện tìm kiếm nếu có giá trị
    if ($ID_TK) {
        $sql .= " AND ID_TK LIKE '%$ID_TK%'"; // Tìm kiếm theo ID_TK
    }
    if ($ID_Giangvien) {
        $sql .= " AND ID_Giangvien LIKE '%$ID_Giangvien%'"; // Tìm kiếm theo ID_Sinhvien
    }

    // Thực hiện truy vấn và trả về kết quả
    $result = mysqli_query($this->con, $sql);

    if (!$result) {
        echo "Lỗi truy vấn: " . mysqli_error($this->con);
        return [];
    }

    // Trả về danh sách tài khoản tìm được
    $TaiKhoanList = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $TaiKhoanList;
}


function QuanlyTKGV_upd($ID_TK, $Tendangnhap, $Matkhau)
{
// Sử dụng Prepared Statements để bảo vệ khỏi SQL Injection
$sql = "UPDATE quanlytk SET Tendangnhap = ?, Matkhau = ? WHERE ID_TK = ?";

// Chuẩn bị câu lệnh SQL
$stmt = $this->con->prepare($sql);

// Liên kết tham số với câu lệnh SQL
$stmt->bind_param("ssi", $Tendangnhap, $Matkhau, $ID_TK);

// Thực thi câu lệnh SQL
return $stmt->execute();
}





//lấy danh sách của các tài khoản

function layDanhSachTKGV()
{
    $sql = "SELECT ID_TK, Tendangnhap, Matkhau, Vaitro, ID_Giangvien FROM quanlytk WHERE Vaitro = 2";
    $result = $this->con->query($sql);

    if (!$result) {
        echo "Lỗi truy vấn: " . $this->con->error;
        return [];
    }

    $TaiKhoangvList = $result->fetch_all(MYSQLI_ASSOC);
    return $TaiKhoangvList;
}

}
?>

