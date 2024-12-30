<?php

class QuanlyTK_m extends connectDB
{

    ////////////////SINH VIÊN////////////////////
    // Kiểm tra trùng lặp ID tài khoản
    function checktrungmaTK($ID_TK,$ID_Sinhvien){
        // Kiểm tra xem $id có rỗng không
      

        $sql = "SELECT * FROM quanlytk WHERE ID_TK ='$ID_TK' or ID_Sinhvien ='$ID_Sinhvien'" ;
        $dl = mysqli_query($this->con, $sql);

        return mysqli_num_rows($dl) > 0 ? "duplicate" : "not_duplicate";
    }

    // Thêm tài khoản Sinh viên vào cơ sở dữ liệu
    function QuanlyTKSV_ins($ID_TK, $Tendangnhap, $Matkhau, $Vaitro, $ID_Sinhvien)
    {
       
    
        // Gán vai trò luôn là 0 và ID_Giangvien, ID_Admin là NULL
        $Vaitro = 0;
        $ID_Giangvien = null;
        $ID_Admin = null;
    
        // Câu lệnh SQL thêm tài khoản sinh viên
        $sql = "INSERT INTO quanlytk (ID_TK, Tendangnhap, Matkhau, Vaitro, ID_Sinhvien, ID_Giangvien, ID_Admin) 
                VALUES ('$ID_TK', '$Tendangnhap', '$Matkhau', '$Vaitro', '$ID_Sinhvien', '$ID_Giangvien', '$ID_Admin')";
    
        // Debugging SQL query (in ra câu lệnh SQL để kiểm tra)

    
        // Thực hiện truy vấn và trả kết quả
        return mysqli_query($this->con, $sql) ? "success" : "fail: " . mysqli_error($this->con);
    }


    function QuanlyTKSV_del($ID_TK)
    {
        $sql = "DELETE FROM quanlytk WHERE ID_TK ='$ID_TK'";
        return mysqli_query($this->con, $sql);
    }

//tìm kiếm theo id của các tài khoản

function QuanlyTKSV_find($ID_TK, $ID_Sinhvien)
{
    // SQL query với điều kiện tìm kiếm theo ID_TK và ID_Sinhvien
    $sql = "SELECT ID_TK, Tendangnhap, Matkhau, Vaitro, ID_Sinhvien FROM quanlytk WHERE Vaitro = 0";  // Chỉ tìm tài khoản sinh viên (Vaitro = 0)

    // Thêm điều kiện tìm kiếm nếu có giá trị
    if ($ID_TK) {
        $sql .= " AND ID_TK LIKE '%$ID_TK%'"; // Tìm kiếm theo ID_TK
    }
    if ($ID_Sinhvien) {
        $sql .= " AND ID_Sinhvien LIKE '%$ID_Sinhvien%'"; // Tìm kiếm theo ID_Sinhvien
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


function QuanlyTKSV_upd($ID_TK, $Tendangnhap, $Matkhau)
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

    function layDanhSachTKSV()
    {
      
        $sql = "SELECT ID_TK, Tendangnhap, Matkhau, Vaitro, ID_Sinhvien FROM quanlytk WHERE Vaitro = 0";
        $result = $this->con->query($sql);
    
        if (!$result) {
            echo "Lỗi truy vấn: " . $this->con->error;
            return [];
        }
    
        $TaiKhoanList = $result->fetch_all(MYSQLI_ASSOC);
        return $TaiKhoanList;
    }
    

   

}
?>

