<?php
// models/Xemthongbao_m.php
class Xemthongbaogv_m extends connectDB
{
    public function getThongbaoByGiangvien($ID_Giangvien) {
        $sql = "
            SELECT 
                thongbao.Tieude,
                thongbao.Noidung,
                thongbao.ID_DTSV,
                thongbao.Hoten,
                thongbao.Thoigian
            FROM 
                giangvien
            LEFT JOIN 
                phancong ON giangvien.ID_Giangvien = phancong.ID_Giangvien
            LEFT JOIN 
                thongbao ON phancong.ID_DTSV = thongbao.ID_DTSV
            WHERE 
                giangvien.ID_Giangvien = ?
                AND thongbao.Tieude IS NOT NULL
                AND thongbao.Noidung IS NOT NULL
                AND thongbao.Thoigian IS NOT NULL
        ";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $ID_Giangvien);
        $stmt->execute();
        return $stmt->get_result();
    }
}
?>