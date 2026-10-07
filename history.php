<?php

session_start();

require_once __DIR__ . '/helpers.php';

$history = $_SESSION['history'] ?? [];

// Data dummy yang sudah ada
$dummyTotalPendaftaran = 3;
$dummyTotalPembayaran = 1080000;

// Total pendaftaran
$totalPendaftaran = $dummyTotalPendaftaran + count($history);

// Total pembayaran
$totalPembayaran = $dummyTotalPembayaran;

foreach ($history as $item) {
    $totalPembayaran += (int) $item['total'];
}

// Daftar kursus dummy
$kursusDummy = [
    'Web Dasar',
    'PHP Dasar',
    'Laravel Dasar'
];

$semuaKursus = $kursusDummy;

foreach ($history as $item) {
    $semuaKursus[] = $item['course'];
}

$totalKursus = count(array_unique($semuaKursus));

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>History Pendaftaran | KursusKu</title>

    <meta name="description"
          content="Riwayat pendaftaran kursus pada website KursusKu.">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
          rel="stylesheet">

    <!-- CSS utama -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="history-page">

    <!-- HEADER -->
    <header class="history-header">

        <div class="history-nav">

            <a href="index.php" class="history-brand">
                KursusKu
            </a>

            <nav>
                <a href="index.php">Beranda</a>
                <a href="registration.php">Daftar Kursus</a>
                <a href="history.php" class="active">
                    History
                </a>
            </nav>

        </div>

    </header>


    <!-- MAIN -->
    <main class="history-main">

        <!-- HERO -->
        <section class="history-hero">

            <div class="history-icon">
                📚
            </div>

            <div>
                <p class="history-label">
                    RIWAYAT PENDAFTARAN
                </p>

                <h1>
                    History Pendaftaran
                </h1>

                <p class="history-description">
                    Lihat daftar kursus yang telah didaftarkan
                    melalui platform KursusKu.
                </p>
            </div>

        </section>


        <!-- STATISTIK -->
        <section class="history-stats">

            <div class="history-stat-card">

                <div class="stat-icon">
                    📋
                </div>

                <div>
                    <span>Total Pendaftaran</span>
                    <strong><?= $totalPendaftaran ?></strong>
                </div>

            </div>


            <div class="history-stat-card">

                <div class="stat-icon">
                    🎓
                </div>

                <div>
                    <span>Total Kursus</span>
                    <strong><?= $totalKursus ?></strong>
                </div>

            </div>


            <div class="history-stat-card">

                <div class="stat-icon">
                    💰
                </div>

                <div>
                    <span>Total Pembayaran</span>
                    <strong><?= rupiah($totalPembayaran) ?></strong>
                </div>

            </div>

        </section>


        <!-- TABLE CARD -->
        <section class="history-card">

            <div class="history-card-header">

                <div>
                    <h2>Riwayat Kursus</h2>

                    <p>
                        Data pendaftaran kursus terbaru
                    </p>
                </div>

                <a href="registration.php" class="history-button">
                    + Daftar Kursus
                </a>

            </div>


            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kursus</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>

                    </thead>

                    <tbody>
                        <!-- DATA ALYA -->
<tr>
    <td>01</td>

    <td>
        <div class="student">
            <div class="avatar">A</div>
            <div>
                <strong>Alya</strong>
                <small>Peserta Kursus</small>
            </div>
        </div>
    </td>

    <td>
        <span class="course-name">Web Dasar</span>
    </td>

    <td>
        <strong class="price">Rp 240.000</strong>
    </td>

    <td>
        <span class="status success">✓ Terdaftar</span>
    </td>
</tr>


<!-- DATA BIMA -->
<tr>
    <td>02</td>

    <td>
        <div class="student">
            <div class="avatar">B</div>
            <div>
                <strong>Bima</strong>
                <small>Peserta Kursus</small>
            </div>
        </div>
    </td>

    <td>
        <span class="course-name">PHP Dasar</span>
    </td>

    <td>
        <strong class="price">Rp 340.000</strong>
    </td>

    <td>
        <span class="status success">✓ Terdaftar</span>
    </td>
</tr>


<!-- DATA CITRA -->
<tr>
    <td>03</td>

    <td>
        <div class="student">
            <div class="avatar">C</div>
            <div>
                <strong>Citra</strong>
                <small>Peserta Kursus</small>
            </div>
        </div>
    </td>

    <td>
        <span class="course-name">Laravel Dasar</span>
    </td>

    <td>
        <strong class="price">Rp 500.000</strong>
    </td>

    <td>
        <span class="status success">✓ Terdaftar</span>
    </td>
</tr>

<?php if (empty($history)): ?>

    <tr>
        <td colspan="5" style="text-align:center; padding:40px;">
            Belum ada data pendaftaran.
        </td>
    </tr>

<?php else: ?>

    <?php foreach ($history as $index => $item): ?>

        <tr>

            <!-- NO -->
            <td>
                <?= str_pad($index + 4, 2, '0', STR_PAD_LEFT) ?>
            </td>

            <!-- NAMA -->
            <td>
                <div class="student">

                    <div class="avatar">
                        <?= strtoupper(substr($item['name'], 0, 1)) ?>
                    </div>

                    <div>
                        <strong>
                            <?= e($item['name']) ?>
                        </strong>

                        <small>
                            Peserta Kursus
                        </small>
                    </div>

                </div>
            </td>

            <!-- KURSUS -->
            <td>
                <span class="course-name">
                    <?= e($item['course']) ?>
                </span>
            </td>

            <!-- TOTAL -->
            <td>
                <strong class="price">
                    <?= rupiah($item['total']) ?>
                </strong>
            </td>

            <!-- STATUS -->
            <td>
                <span class="status success">
                    ✓ <?= e($item['status']) ?>
                </span>
            </td>

        </tr>

    <?php endforeach; ?>

<?php endif; ?>

</tbody>

                </table>

            </div>

        </section>


        <!-- FOOTER INFO -->
        <div class="history-footer-info">

            <span>🔒 Data pendaftaran tersimpan dengan aman</span>

            <span>•</span>

            <span>KursusKu</span>

        </div>

    </main>

</body>

</html>