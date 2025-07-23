<?php
// Keamanan: Pastikan user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?page=login&pesan=login_dulu");
    exit();
}
// Cek ID mobil di URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php?page=bekas");
    exit();
}

$mobil_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// KONEKSI DATABASE
$koneksi = new mysqli('localhost', 'root', '', 'cartukar_db');
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Ambil data mobil
$sql_mobil = "SELECT * FROM mobil WHERE id = ?";
$stmt_mobil = $koneksi->prepare($sql_mobil);
$stmt_mobil->bind_param("i", $mobil_id);
$stmt_mobil->execute();
$result_mobil = $stmt_mobil->get_result();
if ($result_mobil->num_rows === 0) {
    echo "<h1>Mobil tidak ditemukan!</h1>";
    exit();
}
$mobil = $result_mobil->fetch_assoc();
$stmt_mobil->close();

// Ambil data user
$sql_user = "SELECT * FROM users WHERE id = ?";
$stmt_user = $koneksi->prepare($sql_user);
$stmt_user->bind_param("i", $user_id);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$user = $result_user->fetch_assoc();
$stmt_user->close();

$koneksi->close();
?>

<main class="checkout-page">
    <div class="checkout-container">
        <div class="checkout-left-column">
            <div class="order-summary">
                <h3>Ringkasan Pesanan</h3>
                <div class="summary-car-card">
                    <img src="../assets/images/<?php echo htmlspecialchars($mobil['gambar_utama']); ?>" alt="<?php echo htmlspecialchars($mobil['nama']); ?>">
                    <div class="summary-car-info">
                        <h4><?php echo htmlspecialchars($mobil['nama']); ?></h4>
                        <p><?php echo htmlspecialchars($mobil['jarak_tempuh']); ?> Km &middot; <?php echo htmlspecialchars($mobil['transmisi']); ?></p>
                    </div>
                </div>
                <div class="price-details">
                    <div class="price-row">
                        <span>Harga Mobil (Tunai)</span>
                        <strong>Rp <?php echo number_format($mobil['harga_tunai'], 0, ',', '.'); ?></strong>
                    </div>
                    <div class="price-row">
                        <span>Biaya Admin</span>
                        <strong>Rp 1.000.000</strong>
                    </div>
                    <div class="price-row total">
                        <span>Total Pembayaran</span>
                        <strong>Rp <?php echo number_format($mobil['harga_tunai'] + 1000000, 0, ',', '.'); ?></strong>
                    </div>
                </div>
            </div>
            <div class="guarantee-box">
                <h3>Setiap Pembelian Termasuk:</h3>
                <ul>
                    <li><i class="fas fa-check-circle"></i> Lulus Inspeksi 175+ Titik</li>
                    <li><i class="fas fa-shield-alt"></i> Garansi Mesin & Transmisi 1 Tahun</li>
                    <li><i class="fas fa-undo-alt"></i> Jaminan 5 Hari Uang Kembali</li>
                    <li><i class="fas fa-file-alt"></i> Kelengkapan Dokumen Terjamin</li>
                </ul>
            </div>
        </div>

        <div class="checkout-form">
            <form action="../proses_checkout.php" method="POST">
                <input type="hidden" name="mobil_id" value="<?php echo $mobil['id']; ?>">
                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">

                <h3>Informasi Pembeli</h3>
                <div class="input-group">
                    <label>Nama Lengkap</label>
                    <input type="text" value="<?php echo htmlspecialchars($user['nama_lengkap']); ?>" readonly>
                </div>
                <div class="input-group">
                    <label>Email</label>
                    <input type="email" value="<?php echo htmlspecialchars($user['email']); ?>" readonly>
                </div>

                <h3>Opsi Pengambilan</h3>
                <div class="radio-group-wrapper">
                    <label class="radio-label">
                        <input type="radio" name="pengambilan" value="center" checked>
                        <span class="custom-radio"></span>
                        Ambil Di Experience Center
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="pengambilan" value="diantar">
                        <span class="custom-radio"></span>
                        Diantar Ke Rumah
                    </label>
                </div>

                <h3>Metode Pembayaran</h3>
                <div class="payment-cards-container">
                    <label class="payment-card">
                        <input type="radio" name="pembayaran" value="va" checked>
                        <div class="card-content">
                            <i class="fas fa-university card-icon"></i>
                            <div class="card-text">
                                <strong>Virtual Account</strong>
                                <span>Transfer aman melalui bank pilihan.</span>
                            </div>
                        </div>
                    </label>
                    <label class="payment-card">
                        <input type="radio" name="pembayaran" value="kartu_kredit">
                        <div class="card-content">
                            <i class="far fa-credit-card card-icon"></i>
                            <div class="card-text">
                                <strong>Kartu Kredit / Debit</strong>
                                <span>Pembayaran online terenkripsi.</span>
                            </div>
                        </div>
                    </label>
                </div>

                <button type="submit" class="btn">Konfirmasi Pesanan</button>

                <div class="trust-signal">
                    <i class="fas fa-lock"></i>
                    <span>Transaksi Aman Dan Terenkripsi. Data Anda Terlindungi.</span>
                </div>
            </form>
        </div>
    </div>
</main>