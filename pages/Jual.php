<main class="sell-car-landing-page">
    <section class="sell-hero-v2">
        <div class="valuation-form-container">
            <div class="valuation-form-left">
                <div class="form-header">
                    <div class="title-decorator"></div>
                    <h2>Masukkan Data Mobil Anda Untuk Cek Harga GRATIS!</h2>
                </div>
                <form action="../proses_jual.php" method="POST" class="valuation-form">
                    <div class="form-grid-inputs">
                        <select name="merek" required>
                            <option value="" disabled selected>Pilih Merek</option>
                        </select>
                        <select name="model" required disabled>
                            <option value="" disabled selected>Pilih Model</option>
                        </select>
                        <select name="tahun" required>
                            <option value="" disabled selected>Pilih Tahun</option>
                        </select>
                        <select name="tipe" required>
                            <option value="" disabled selected>Pilih Tipe</option>
                            <option value="suv">SUV</option>
                            <option value="mpv">MPV</option>
                            <option value="sedan">Sedan</option>
                            <option value="hatchback">Hatchback</option>
                        </select>
                        <select name="mesin" required>
                            <option value="" disabled selected>Pilih Jenis Mesin</option>
                            <option value="bensin">Bensin</option>
                            <option value="diesel">Diesel</option>
                            <option value="hybrid">Hybrid</option>
                            <option value="listrik">Listrik</option>
                        </select>
                        <select name="transmisi" required>
                            <option value="" disabled selected>Pilih Transmisi</option>
                            <option value="automatic">Automatic</option>
                            <option value="manual">Manual</option>
                        </select>
                    </div>
                    <button type="submit" class="btn">Mulai Disini</button>
                    <p class="form-disclaimer">Dengan menekan tombol, Anda setuju dengan Kebijakan Privasi & Syarat Penggunaan kami.</p>
                </form>
            </div>
            <div class="valuation-steps-right">
                <div class="step-item">
                    <div class="step-icon"><i class="fas fa-car"></i></div>
                    <div class="step-text">
                        <strong>Isi Detail Mobil</strong>
                        <span>Kurang dari 2 menit</span>
                    </div>
                </div>
                <div class="step-item">
                    <div class="step-icon"><i class="fas fa-calendar-alt"></i></div>
                    <div class="step-text">
                        <strong>Jadwalkan Inspeksi</strong>
                        <span>Di lokasi pilihan Anda</span>
                    </div>
                </div>
                <div class="step-item">
                    <div class="step-icon"><i class="fas fa-hand-holding-usd"></i></div>
                    <div class="step-text">
                        <strong>Dapatkan Penawaran</strong>
                        <span>Harga terbaik dalam 1 jam</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="sell-experience">
        <div class="sell-experience-container">
            <div class="section-header">
                <div class="title-decorator"></div>
                <h2>Pengalaman Penjualan Mobil Anda Jadi Bebas Ribet</h2>
            </div>

            <div class="steps-grid">
                <div class="step-card">
                    <div class="step-number-badge">1</div>
                    <div class="step-icon">
                        <img src="../assets/images/Jualmobil_img1.png" alt="Jadwalkan Inspeksi">
                    </div>
                    <h3>1. Jadwalkan Inspeksi Mobil Gratis</h3>
                    <p>Isi data diri Anda dan dapatkan perkiraan harga secara instan untuk mobil Anda sebelum menjadwalkan inspeksi.</p>
                </div>

                <div class="step-card">
                    <div class="step-number-badge">2</div>
                    <div class="step-icon">
                        <img src="../assets/images/Jualmobil_img2.png" alt="Inspeksi Mobil">
                    </div>
                    <h3>2. Inspeksi Mobil</h3>
                    <p>Tim Inspektor Profesional kami akan melakukan pemeriksaan di 175 titik pada mobil Anda dan memberikan penawaran terbaik.</p>
                </div>

                <div class="step-card">
                    <div class="step-number-badge">3</div>
                    <div class="step-icon">
                        <img src="../assets/images/Jualmobil_img3.png" alt="Jual Mobil Anda">
                    </div>
                    <h3>3. Jual Mobil Anda</h3>
                    <p>Jual langsung mobil lama Anda kepada kami atau pilih sistem penawaran terbaik sesuai kondisi mobilmu.</p>
                </div>

                <div class="step-card">
                    <div class="step-number-badge">4</div>
                    <div class="step-icon">
                        <img src="../assets/images/Jualmobil_img4.png" alt="Dapatkan Pembayaran">
                    </div>
                    <h3>4. Dapatkan Pembayaran dalam 24 Jam*</h3>
                    <p>Serahkan semua urusan dokumen kepada kami dan nikmati pembayaran dengan cepat.</p>
                </div>
            </div>

            <div class="sell-experience-footer">
                <p>*Syarat & Ketentuan Berlaku</p>
            </div>
        </div>
    </section>


</main>