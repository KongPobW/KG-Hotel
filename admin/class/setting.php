<?php
class Setting {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getSettingInfo() {
        $query = "SELECT * FROM setting WHERE sr_no = 1";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

$database = new Database();
$db = $database->getConnection();

$setting = new Setting($db);
$setting_info = $setting->getSettingInfo();

$site_title = $setting_info['site_title'];
$site_about = $setting_info['site_about'];
$shutdown = $setting_info['shutdown'];
?>