<?php
// Pastikan user sudah login untuk melihat halaman ini
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?page=login");
    exit();
}
$user_id = $_SESSION['user_id'];

// KONEKSI DATABASE
$koneksi = new mysqli('localhost', 'root', '', 'cartukar_db');
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Query untuk mengambil data pesanan user yang sedang login, diurutkan dari yang terbaru
// JOIN digunakan untuk mengambil info mobil dari tabel 'mobil'
$sql = "SELECT pesanan.*, mobil.nama, mobil.gambar_utama 
        FROM pesanan 
        JOIN mobil ON pesanan.mobil_id = mobil.id 
        WHERE pesanan.user_id = ? 
        ORDER BY pesanan.tgl_pesanan DESC";

$stmt = $koneksi->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$koneksi->close();
?>

<main class="my-orders-page">
    <div class="orders-container">
        <h1>Pesanan Saya</h1>

        <?php
        // Menampilkan pesan sukses setelah membuat atau membatalkan pesanan
        if (isset($_GET['status'])) {
            if ($_GET['status'] == 'sukses') {
                echo "<div class='success-message'>Pesanan Anda berhasil dibuat! Tim kami akan segera menghubungi Anda.</div>";
            } elseif ($_GET['status'] == 'batal_sukses') {
                echo "<div class='success-message'>Pesanan Anda telah berhasil dibatalkan.</div>";
            }
        }
        ?>

        <div class="order-list">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($pesanan = $result->fetch_assoc()): ?>
                    <div class="order-card">
                        <img src="../assets/images/<?php echo htmlspecialchars($pesanan['gambar_utama']); ?>" alt="Gambar Mobil">

                        <div class="order-details">
                            <h4><?php echo htmlspecialchars($pesanan['nama']); ?></h4>
                            <p>Tanggal Pesan: <?php echo date('d M Y, H:i', strtotime($pesanan['tgl_pesanan'])); ?></p>
                            <p>Total: <strong>Rp <?php echo number_format($pesanan['total_harga'], 0, ',', '.'); ?></strong></p>
                        </div>

                        <div class="order-status">
                            <span>Status</span>
                            <strong class="status-<?php echo strtolower(htmlspecialchars($pesanan['status_pesanan'])); ?>">
                                <?php echo htmlspecialchars($pesanan['status_pesanan']); ?>
                            </strong>
                        </div>

                        <div class="order-actions">
                            <?php if ($pesanan['status_pesanan'] == 'Pending'): ?>
                                <form action="../proses_batal.php" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?');">
                                    <input type="hidden" name="id_pesanan" value="<?php echo $pesanan['id']; ?>">
                                    <button type="submit" class="btn-cancel">Batalkan</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="no-orders">
                    <p>Anda belum memiliki riwayat pesanan.</p>
                    <a href="index.php?page=bekas" class="btn">Mulai Belanja</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>