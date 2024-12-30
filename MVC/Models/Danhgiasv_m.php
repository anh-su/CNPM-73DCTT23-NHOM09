<?php

class Danhgiasv_m extends connectDB {
    public function getTopicNames()
    {
        $sql = "SELECT DISTINCT TenDetai FROM detai";
        $result = $this->con->query($sql);
    
        $topicNames = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $topicNames[] = $row['TenDetai'];
            }
        }
        return $topicNames;
    }
    
    public function countGroupsForTopic($topicName)
    {
        $sql = "SELECT COUNT(*) AS count FROM detaisinhvien WHERE Tendetai = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('s', $topicName);
        $stmt->execute();
        $result = $stmt->get_result();
        $count = $result->fetch_assoc()['count'] ?? 0;
    
        $stmt->close();
        return $count;
    }
    
}
?>