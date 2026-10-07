<?php 
require __DIR__ . '/data.php'; 
require __DIR__ . '/helpers.php'; 
?> 
 
<!doctype html> 
<html lang="id"> 
<head> 
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    
    <title>Daftar Kursus - KursusKu</title> 

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link 
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" 
        rel="stylesheet"
    >

    <link rel="stylesheet" href="assets/css/style.css"> 
</head> 

<body class="register-page"> 

<!-- NAVBAR -->
<nav class="register-nav">

    <a href="index.php" class="brand">
        KursusKu UIN
    </a>

    <div class="nav-menu">
        <a href="index.php">Beranda</a>
        <a href="index.php#katalog">Katalog</a>
        <a href="register.php" class="active">Daftar P6</a>
        <a href="history.php">History</a>
    </div>

</nav>


<!-- MAIN -->
<main class="register-container">


    <!-- JUDUL -->
    <section class="register-hero">

        <span class="register-badge">
            KURSUSKU
        </span>

        <h1>
            Pendaftaran Kursus
        </h1>

        <p>
            Lengkapi data berikut untuk mendaftar
            dan mulai belajar bersama KursusKu.
        </p>

    </section>


    <!-- FORM -->
    <form method="POST" action="process.php">


        <!-- NAMA -->
        <div class="form-group">

            <label for="name">
                Nama lengkap
            </label>

            <input 
                id="name" 
                name="name" 
                type="text" 
                placeholder="Masukkan nama lengkap"
                required
            >

        </div>


        <!-- EMAIL -->
        <div class="form-group">

            <label for="email">
                Email
            </label>

            <input 
                id="email" 
                name="email" 
                type="email" 
                placeholder="contoh@email.com"
                required
            >

        </div>


        <!-- KURSUS -->
        <div class="form-group">

            <label for="course_code">
                Pilih kursus
            </label>

            <select 
                id="course_code" 
                name="course_code" 
                required
            >

                <option value="">
                    -- Pilih kursus --
                </option>

                <?php foreach ($courses as $course): ?>

                    <option value="<?= e($course['code']) ?>">
                        <?= e($course['name']) ?> 
                        - <?= formatRupiah($course['fee']) ?>
                    </option>

                <?php endforeach; ?>

            </select>

        </div>


        <!-- TIPE PESERTA -->
        <fieldset>

            <legend>
                Tipe peserta
            </legend>

            <div class="option-group">

                <label class="option-card">

                    <input 
                        type="radio" 
                        name="participant_type" 
                        value="mahasiswa" 
                        required
                    >

                    <span>
                        Mahasiswa
                    </span>

                </label>


                <label class="option-card">

                    <input 
                        type="radio" 
                        name="participant_type" 
                        value="guru"
                    >

                    <span>
                        Guru
                    </span>

                </label>


                <label class="option-card">

                    <input 
                        type="radio" 
                        name="participant_type" 
                        value="umum"
                    >

                    <span>
                        Umum
                    </span>

                </label>

            </div>

        </fieldset>


        <!-- MINAT BELAJAR -->
        <fieldset>

            <legend>
                Minat belajar
            </legend>

            <div class="option-group">

                <?php foreach ($interestOptions as $value => $label): ?>

                    <label class="option-card">

                        <input 
                            type="checkbox" 
                            name="interests[]" 
                            value="<?= e($value) ?>"
                        >

                        <span>
                            <?= e($label) ?>
                        </span>

                    </label>

                <?php endforeach; ?>

            </div>

        </fieldset>


        <!-- METODE BELAJAR -->
        <div class="form-group">

            <label for="learning_mode">
                Metode belajar
            </label>

            <select 
                id="learning_mode" 
                name="learning_mode" 
                required
            >

                <option value="">
                    -- Pilih metode --
                </option>

                <option value="offline">
                    Tatap muka
                </option>

                <option value="online">
                    Online
                </option>

                <option value="hybrid">
                    Hybrid
                </option>

            </select>

        </div>


        <!-- JUMLAH PAKET -->
        <div class="form-group">

            <label for="package_count">
                Jumlah paket
            </label>

            <select 
                id="package_count" 
                name="package_count" 
                required
            >

                <?php for ($i = 1; $i <= 3; $i++): ?>

                    <option value="<?= $i ?>">
                        <?= $i ?> paket
                    </option>

                <?php endfor; ?>

            </select>

        </div>


        <!-- CATATAN -->
        <div class="form-group">

            <label for="notes">
                Catatan tambahan
            </label>

            <textarea 
                id="notes" 
                name="notes" 
                rows="4" 
                maxlength="300"
                placeholder="Tulis catatan tambahan jika ada..."
            ></textarea>

        </div>


        <!-- BUTTON -->
        <button 
            type="submit" 
            class="register-button"
        >
            Proses Pendaftaran
        </button>

    </form>


    <!-- FASILITAS -->
    <section class="facilities-section">

        <div class="facilities-heading">

            <span class="small-title">
                KEUNTUNGAN
            </span>

            <h2>
                Fasilitas yang Kamu Dapatkan
            </h2>

            <p>
                Nikmati berbagai fasilitas untuk mendukung
                proses belajar kamu.
            </p>

        </div>


        <ul class="facilities-list">

            <?php foreach ($facilities as $facility): ?>

                <li>

                    <div class="facility-icon">
                        ✓
                    </div>

                    <span>
                        <?= e($facility) ?>
                    </span>

                </li>

            <?php endforeach; ?>

        </ul>

    </section>


</main>

</body> 
</html>