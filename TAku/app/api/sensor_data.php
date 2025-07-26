<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Jika perlu untuk method OPTIONS (preflight CORS request)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");
    exit(0);
}


header("Content-Type: application/json");
include '../database/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle POST: Menyimpan data sensor dari Arduino
    $data = json_decode(file_get_contents("php://input"), true);

    if (!$data) {
        http_response_code(400);
        echo json_encode(["message" => "Data JSON tidak valid."]);
        exit();
    }

    $suhu = $data['suhu'];
    $kelembapan = $data['kelembapan'];

    $sql = "INSERT INTO data_sensor (suhu, kelembapan)
            VALUES ('$suhu', '$kelembapan')";

    if ($conn->query($sql) === TRUE) {
        http_response_code(201); // Created
        echo json_encode(["message" => "Data sensor berhasil disimpan."]);
    } else {
        http_response_code(500); // Internal Server Error
        echo json_encode(["message" => "Gagal menyimpan data: " . $conn->error]);
    }
    
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Handle GET: Mengambil data sensor terbaru untuk monitoring
    $sql = "SELECT suhu, kelembapan, waktu FROM data_sensor ORDER BY id DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode([
            "suhu" => $row['suhu'],
            "kelembapan" => $row['kelembapan'],
            "waktu" => $row['waktu']
        ]);
    } else {
        http_response_code(404); // Not Found
        echo json_encode(["message" => "Data sensor tidak ditemukan."]);
    }

} else {
    // Jika metode selain POST/GET dipakai
    http_response_code(405); // Method Not Allowed
    echo json_encode(["message" => "Metode tidak diizinkan."]);
}

$conn->close();
?>
