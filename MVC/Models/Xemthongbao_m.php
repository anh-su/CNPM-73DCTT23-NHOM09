<?php
// models/Xemthongbao_m.php
class Xemthongbao_m extends connectDB
{
    public function getThongbaoBySinhvien($ID_Sinhvien) {
        $sql = "
           SELECT 
    thongbao.Tieude,
    thongbao.Noidung,
    thongbao.ID_DTSV,
    thongbao.Hoten,
    thongbao.Thoigian
FROM 
    sinhvien
LEFT JOIN 
    nhom ON sinhvien.ID_Sinhvien = nhom.ID_Sinhvien
LEFT JOIN 
    thongbao ON nhom.ID_DTSV = thongbao.ID_DTSV
WHERE 
    sinhvien.ID_Sinhvien = ?
    AND thongbao.Tieude IS NOT NULL
    AND thongbao.Noidung IS NOT NULL
    AND thongbao.Thoigian IS NOT NULL
    AND thongbao.Tieude != 'Xin chào giảng viên!!!'

        ";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $ID_Sinhvien);
        $stmt->execute();
        return $stmt->get_result();
    }
}
?>