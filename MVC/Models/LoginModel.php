<?php
// models/LoginModel.php

// models/LoginModel.php

class LoginModel extends connectDB
{
    public function checkUser($Tendangnhap, $Matkhau)
    {
        $stmt = $this->con->prepare("
           SELECT q.Vaitro AS Vaitro, gv.Hoten AS Hoten, gv.Diachi AS Diachi,
       q.ID_Giangvien AS ID, gv.Ngaysinh AS Ngaysinh, gv.Email AS Email, gv.Sdt AS Sdt, gv.Gioitinh AS Gioitinh 
FROM quanlytk q
JOIN giangvien gv ON q.ID_Giangvien = gv.ID_Giangvien
WHERE q.Tendangnhap = ? AND q.Matkhau = ?
UNION
SELECT q.Vaitro AS Vaitro, a.Hoten AS Hoten, a.Diachi AS Diachi,
       q.ID_Admin AS ID, a.Ngaysinh AS Ngaysinh, a.Email AS Email, a.Sdt AS Sdt, a.Gioitinh AS Gioitinh 
FROM quanlytk q
JOIN admin a ON q.ID_Admin = a.ID_Admin
WHERE q.Tendangnhap = ? AND q.Matkhau = ?
UNION
SELECT q.Vaitro AS Vaitro, s.Hoten AS Hoten, s.Diachi AS Diachi,
       q.ID_Sinhvien AS ID, s.Ngaysinh AS Ngaysinh, s.Email AS Email, s.Sdt AS Sdt, s.Gioitinh AS Gioitinh 
FROM quanlytk q
JOIN sinhvien s ON q.ID_Sinhvien = s.ID_Sinhvien
WHERE q.Tendangnhap = ? AND q.Matkhau = ?

        ");
        
        // Bind 5 tham số vào câu truy vấn
        $stmt->bind_param("ssssss", $Tendangnhap, $Matkhau, $Tendangnhap, $Matkhau, $Tendangnhap, $Matkhau);
        
        // Thực thi truy vấn
        $stmt->execute();
        
        // Lấy kết quả
        $result = $stmt->get_result();
        $userData = $result->fetch_assoc();

        // Kiểm tra và trả về dữ liệu
        if ($userData) {
            return $userData;
        } else {
            return null;
        }
    }
}



