<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$conn = new mysqli("sql308.infinityfree.com", "if0_39359140", "TurbinePNJ25", "if0_39359140_data_angin");

if ($conn->connect_error) {
    echo json_encode(["error" => "DB connection failed"]);
    exit;
}

$mode = $_GET['mode'] ?? 'recent';

if ($mode === 'harian') {
    $sql = "SELECT * FROM data_angin WHERE DATE(waktu) = CURDATE() ORDER BY waktu ASC";
} else {
    $sql = "SELECT * FROM data_angin ORDER BY waktu DESC LIMIT 10";
}

$result = $conn->query($sql);
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
?>
