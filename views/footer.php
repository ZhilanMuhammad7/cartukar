<?php
require_once '../configdb.php'; 

$newsletterSuccess = false;

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['newsletter_email'])) {
    $email = filter_var(trim($_POST['newsletter_email']), FILTER_SANITIZE_EMAIL);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        try {
            $stmt = $conn->prepare("INSERT INTO newsletter_subscribers (email) VALUES (:email)");
            $stmt->bindParam(':email', $email);
            $newsletterSuccess = $stmt->execute();
        } catch (PDOException $e) {
        
        }
    }
}
?>

<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-top">
            <div class="footer-about">
                <h3 class="footer-logo">CAR<span>TUKAR</span></h3>
                <p>CARTUKAR merupakan portal e-commerce mobil yang terintegrasi dan terbesar di Asia Tenggara. Hadir di Malaysia, Indonesia, Thailand, dan Singapura.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="footer-newsletter">
                <h4>Berlangganan Newsletter Kami</h4>
                <p>Dapatkan diskon terbaru, promosi & keuntungan eksklusif yang dikirimkan langsung ke email Anda.</p>

                <?php if ($newsletterSuccess): ?>
                <div style="background-color: #dff0d8; color: #3c763d; padding: 10px; border-radius: 4px; margin-bottom: 10px;">
                    Terima kasih! Email Anda berhasil didaftarkan.
                </div>
                <?php endif; ?>

                <form class="newsletter-form" method="post" action="">
                    <input type="email" name="newsletter_email" placeholder="Alamat email" required>
                    <button type="submit" class="btn">Kirim</button>
                </form>
            </div>
        </div>

        <div class="footer-links-container">
            <div class="footer-column">
                <h4>Layanan</h4>
                <a href="#">Beli Mobil</a>
                <a href="#">Jual Mobil</a>
                <a href="#">Tukar Tambah</a>
                <a href="#">Masuk sebagai Dealer</a>
            </div>
            <div class="footer-column">
                <h4>Bantuan</h4>
                <a href="#">FAQ</a>
                <a href="#">Hubungi Kami</a>
                <a href="#">Lokasi Kami</a>
            </div>
            <div class="footer-column">
                <h4>Tentang CARTUKAR</h4>
                <a href="#">Tentang Kami</a>
                <a href="#">Mobil Bekas CARTUKAR</a>
                <a href="#">Ulasan Mobil</a>
                <a href="#">Pelaporan Pelanggaran</a>
                <a href="#">Karir</a>
                <a href="#">Semua Artikel</a>
                <a href="#">CARTUKAR Academy</a>
            </div>
            <div class="footer-column">
                <h4>Partner Websites</h4>
                <a href="#">Autofun</a>
                <a href="#">Mobil123</a>
                <a href="#">Carmudi</a>
                <a href="#">CarTimes</a>
            </div>
        </div>

        <div class="footer-bottom">
            <h4>Unduh Aplikasi</h4>
            <div class="app-buttons">
                <a href="#"><img src="../assets/images/app store.png" alt="Download on the App Store"></a>
                <a href="#"><img src="../assets/images/play store.png" alt="Get it on Google Play"></a>
            </div>
        </div>
    </div>

    <div class="footer-legal">
        <div class="footer-container legal-content">
            <p>© 2016-2025 PT CARTUKAR INDONESIA (0120102153901) Dilindungi oleh hak cipta. <a href="#">Kebijakan Privasi</a> | <a href="#">Syarat Penggunaan</a></p>
            <div class="country-selector">
                <img src="../assets/images/indonesia-flag.jpg" alt="Indonesia Flag">
                <span>Indonesia</span>
                <i class="fas fa-chevron-up"></i>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="../assets/js/home.js"></script>
</body>
</html>
