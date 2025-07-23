<?php
session_start();

// Keamanan: Pastikan user sudah login dan form sudah disubmit
if (!isset($_SESSION['user_id']) || $_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: views/index.php"); // Arahkan ke home jika akses tidak sah
    exit();
}

// --- KONEKSI DATABASE ---
$koneksi = new mysqli('localhost', 'root', '', 'cartukar_db');
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// --- AMBIL DATA DARI FORM ---
$user_id = $_POST['user_id'];
$mobil_id = $_POST['mobil_id'];
$opsi_pengambilan = $_POST['pengambilan'];
$metode_pembayaran = $_POST['pembayaran'];

// --- AMBIL HARGA TERBARU DARI DATABASE (LEBIH AMAN) ---
$sql_mobil = "SELECT harga_tunai FROM mobil WHERE id = ?";
$stmt_mobil = $koneksi->prepare($sql_mobil);
$stmt_mobil->bind_param("i", $mobil_id);
$stmt_mobil->execute();
$result_mobil = $stmt_mobil->get_result();
$mobil = $result_mobil->fetch_assoc();
$harga_final = $mobil['harga_tunai'] + 1000000; // Harga mobil + biaya admin
$stmt_mobil->close();

// --- SIMPAN DATA PESANAN KE TABEL `pesanan` ---
$sql_insert = "INSERT INTO pesanan (user_id, mobil_id, total_harga, opsi_pengambilan, metode_pembayaran, status_pesanan) VALUES (?, ?, ?, ?, ?, ?)";
$stmt_insert = $koneksi->prepare($sql_insert);

$status_pesanan = "Pending"; // Status awal untuk setiap pesanan baru
$stmt_insert->bind_param("iidsss", $user_id, $mobil_id, $harga_final, $opsi_pengambilan, $metode_pembayaran, $status_pesanan);

// Eksekusi statement
if ($stmt_insert->execute()) {
    // Jika berhasil, arahkan ke halaman "Pesanan Saya" dengan pesan sukses
    header("Location: views/index.php?page=pesanan&status=sukses");
    exit();
} else {
    // Jika gagal, tampilkan error (untuk debugging)
    echo "Error saat memproses pesanan: " . $stmt_insert->error;
}

$stmt_insert->close();
$koneksi->close();
