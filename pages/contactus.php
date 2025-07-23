<?php
// Koneksi ke database
require_once '../configdb.php';

// Proses form saat disubmit
$success = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Cegah XSS
    $name    = htmlspecialchars(trim($_POST['name']));
    $email   = htmlspecialchars(trim($_POST['email']));
    $phone   = htmlspecialchars(trim($_POST['phone']));
    $message = htmlspecialchars(trim($_POST['message']));

    try {
        $stmt = $conn->prepare("INSERT INTO contacts (name, email, phone, message) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $phone, $message]);
        $success = true;
    } catch (PDOException $e) {
        echo "Gagal menyimpan data: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Us - CarTukar</title>
  <link rel="stylesheet" href="../assets/CSS/contactus.css" />
  <link rel="stylesheet" href="../assets/css/home.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" />
  <style>
    .success-message {
      position: fixed;
      top: 20px;
      right: 20px;
      background-color: #28a745;
      color: white;
      padding: 12px 18px;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
      z-index: 9999;
      font-size: 16px;
      font-weight: 600;
      opacity: 0;
      transition: opacity 0.3s ease;
    }
  </style>
</head>

<body>

<?php if ($success): ?>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const notif = document.createElement('div');
      notif.className = 'success-message';
      notif.textContent = "✅ Pesan berhasil dikirim!";
      document.body.appendChild(notif);
      setTimeout(() => notif.style.opacity = '1', 100); // Fade in
      setTimeout(() => {
        notif.style.opacity = '0';
        setTimeout(() => notif.remove(), 300); // Fade out
      }, 3000); // Tampilkan 3 detik
    });
  </script>
<?php endif; ?>

<section class="contact-us">
  <h1 class="heading"><span>Contact</span> Us</h1>

  <div class="horizontal-boxes">
    <div class="box">
      <i class="fas fa-question-circle"></i>
      <h3>Pertanyaan Umum / Feedback</h3>
      <div class="divider"></div>
      <p><strong>(022) 522 4138</strong></p>
      <p>08.30 - 17.30 WIB (Senin - Minggu)</p>
      <p><a href="mailto:info@carsome.id">info@cartukar.id</a></p>
    </div>
    <div class="box">
      <i class="fas fa-comments"></i>
      <h3>Chat dengan Kami</h3>
      <div class="divider"></div>
      <div class="qr-content">
        <img src="pic/wa-my.webp" alt="QR Code WhatsApp" class="qr-code" />
        <div class="qr-text">
          <p><strong>WhatsApp ID</strong></p>
          <p><a href="https://wa.me/622150202030" target="_blank">+62 2150202030</a></p>
        </div>
      </div>
    </div>
  </div>

  <div class="vertical-boxes">
    <div class="box">
      <i class="fas fa-briefcase"></i>
      <h3>Peluang</h3>
      <div class="divider"></div>
      <p><strong>Kemitraan Dealer</strong></p>
      <p><a href="mailto:info@cartukar.id">info@cartukar.id</a></p>
      <p><strong>Kolaborasi/Brand Partnership</strong></p>
      <p><a href="mailto:partnership@cartukar.id">partnership@cartukar.id</a></p>
    </div>
    <div class="box">
      <i class="fas fa-map-marker-alt"></i>
      <h3>Alamat Kantor Pusat</h3>
      <div class="divider"></div>
      <p><strong>Kantor Pusat CARTUKAR</strong></p>
      <p>Jl. Telekomunikasi No.1, Sukapura, Kec. Dayeuhkolot, Kabupaten Bandung, Jawa Barat 40257</p>
      <p><strong>(022) 522 4138</strong></p>
    </div>
  </div>

  <div class="long-box">
    <i class="fas fa-headset"></i>
    <h3>Layanan Pengaduan Konsumen</h3>
    <div class="divider"></div>
    <p><strong>PT Car Tukar Indonesia</strong></p>
    <p>No. Telp: <strong>(022) 522 4138</strong></p>
    <p>Email: <a href="mailto:info@cartukar.id">info@cartukar.id</a></p>
    <p>Direktorat Jenderal Perlindungan Konsumen dan Tertib Niaga Kementerian Perdagangan Republik Indonesia</p>
    <p>WhatsApp: <a href="https://wa.me/6285311111010" target="_blank">+62 853 1111 1010</a></p>
  </div>
</section>

<section class="contact" id="contact">
  <h1 class="heading"><span>Contact </span>us</h1>
  <div class="row">
    <iframe class="map"
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.304324586581!2d107.63261750000001!3d-6.9733772000000025!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e9afad6fa06f%3A0xd4fc2f579a78668a!2sFakultas%20Ilmu%20Terapan%20Universitas%20Telkom!5e0!3m2!1sid!2sid!4v1734290847299!5m2!1sid!2sid"
      allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

    <form action="" method="post">
      <h3>get in touch</h3>
      <input type="text" name="name" placeholder="Name" class="box" required />
      <input type="email" name="email" placeholder="Email" class="box" required />
      <input type="number" name="phone" placeholder="Mobile phone number" class="box" />
      <textarea name="message" placeholder="Message" class="box" cols="30" rows="10"></textarea>
      <input type="submit" value="Send message" class="btn" />
    </form>
  </div>
</section>

</body>
</html>
