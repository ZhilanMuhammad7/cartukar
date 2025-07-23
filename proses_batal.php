<?php
session_start();

// Keamanan: Pastikan user sudah login dan form sudah disubmit
if (!isset($_SESSION['user_id']) || $_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: views/index.php");
    exit();
}

// Ambil ID pesanan dari form dan ID user dari session
$id_pesanan = $_POST['id_pesanan'];
$user_id = $_SESSION['user_id'];

// --- KONEKSI DATABASE ---
$koneksi = new mysqli('localhost', 'root', '', 'cartukar_db');
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// --- UPDATE STATUS PESANAN ---
// Query ini SANGAT PENTING:
// Ia hanya akan mengubah status jika ID pesanan DAN ID user cocok.
// Ini mencegah user A membatalkan pesanan milik user B.
$sql = "UPDATE pesanan SET status_pesanan = 'Dibatalkan' WHERE id = ? AND user_id = ?";

$stmt = $koneksi->prepare($sql);
$stmt->bind_param("ii", $id_pesanan, $user_id);

if ($stmt->execute()) {
    // Jika berhasil, kembalikan ke halaman pesanan
    header("Location: views/index.php?page=pesanan&status=batal_sukses");
    exit();
} else {
    // Jika gagal
    echo "Error saat membatalkan pesanan: " . $stmt->error;
}

$stmt->close();
$koneksi->close();
