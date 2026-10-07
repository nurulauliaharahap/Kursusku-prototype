<?php
session_start();

require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/data.php';

// Akses langsung (GET) dikembalikan ke form
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.php');
    exit;
}

$name            = trim($_POST['name'] ?? '');
$email           = trim($_POST['email'] ?? '');
$courseCode      = $_POST['course_code'] ?? '';
$participantType = $_POST['participant_type'] ?? '';
$learningMode    = $_POST['learning_mode'] ?? '';
$packageCount    = (int) ($_POST['package_count'] ?? 1);
$notes           = trim($_POST['notes'] ?? '');
$interests       = $_POST['interests'] ?? [];

if (!is_array($interests)) {
    $interests = [];
}

$interests = array_values(
    array_intersect($interests, array_keys($interestOptions))
);

$errors = [];

// Validasi nama
if ($name === '') {
    $errors[] = 'Nama wajib diisi.';
}

// Validasi email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Format email tidak valid.';
}

// Cari kursus
$course = findCourse($courses, (string) $courseCode);

if ($course === null) {
    $errors[] = 'Kursus tidak ditemukan.';
} elseif (
    statusKursus($course['quota'], $course['registered']) === 'Penuh'
) {
    $errors[] = 'Kursus yang dipilih sudah penuh.';
}

// Validasi tipe peserta
if (!in_array($participantType, ['mahasiswa', 'guru', 'umum'], true)) {
    $errors[] = 'Tipe peserta tidak valid.';
}

// Validasi metode belajar
if (!in_array($learningMode, ['offline', 'online', 'hybrid'], true)) {
    $errors[] = 'Metode belajar tidak valid.';
}

// Validasi jumlah paket
if (!in_array($packageCount, [1, 2, 3], true)) {
    $errors[] = 'Jumlah paket tidak valid.';
}

// Jika ada error
if ($errors !== []) {
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Data Belum Valid - KursusKu</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, #ecfdf5, #f0fdf4);
            color: #16332c;
        }

        .container {
            max-width: 850px;
            margin: 60px auto;
            padding: 0 20px;
        }

        .card {
            background: #ffffff;
            border-radius: 22px;
            padding: 40px;
            box-shadow: 0 15px 40px rgba(16, 185, 129, 0.12);
            border: 1px solid #d1fae5;
        }

        h1 {
            margin-top: 0;
            color: #047857;
        }

        .error-box {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 14px;
            padding: 18px 22px;
            color: #991b1b;
        }

        .error-box li {
            margin-bottom: 8px;
        }

        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 13px 22px;
            background: #16a34a;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-weight: bold;
        }

        .btn:hover {
            background: #15803d;
        }
    </style>
</head>

<body>

<div class="container">
    <div class="card">

        <h1>Data Belum Dapat Diproses</h1>

        <div class="error-box">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= e($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <a class="btn" href="register.php">
            ← Kembali ke Form
        </a>

    </div>
</div>

</body>
</html>

<?php
exit;
}

// ======================================================
// PERHITUNGAN BIAYA
// ======================================================

$discountPercent = getDiscountPercent($participantType);

$grossTotal = $course['fee'] * $packageCount;

$discountAmount = intdiv(
    $grossTotal * $discountPercent,
    100
);

$finalTotal = $grossTotal - $discountAmount;
// Simpan data pendaftaran ke history
if (!isset($_SESSION['history'])) {
    $_SESSION['history'] = [];
}

$_SESSION['history'][] = [
    'name'   => $name,
    'email'  => $email,
    'course' => $course['name'],
    'total'  => $finalTotal,
    'status' => 'Terdaftar'
];
// Label metode belajar
$learningModeLabel = [
    'offline' => 'Offline',
    'online'  => 'Online',
    'hybrid'  => 'Hybrid',
][$learningMode] ?? $learningMode;

?>

<!doctype html>
<html lang="id">

<head>

    <meta charset="utf-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>Ringkasan Pendaftaran - KursusKu</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;

            background:
                linear-gradient(
                    135deg,
                    #ecfdf5 0%,
                    #f0fdf4 50%,
                    #dcfce7 100%
                );

            color: #16332c;
        }

        /* HEADER */

        .top-header {
            background: linear-gradient(
                135deg,
                #047857,
                #16a34a
            );

            color: white;
            padding: 28px 20px;

            box-shadow:
                0 8px 25px rgba(5, 150, 105, 0.25);
        }

        .header-content {
            max-width: 950px;
            margin: auto;
        }

        .logo {
            font-size: 26px;
            font-weight: 800;
            letter-spacing: 0.3px;
        }

        .subtitle {
            margin-top: 6px;
            font-size: 14px;
            opacity: 0.9;
        }

        /* CONTAINER */

        .container {
            max-width: 950px;
            margin: 45px auto;
            padding: 0 20px;
        }

        /* SUCCESS CARD */

        .success-card {
            background: white;

            border-radius: 24px;

            padding: 40px;

            box-shadow:
                0 20px 50px rgba(16, 185, 129, 0.14);

            border: 1px solid #d1fae5;
        }

        /* ICON */

        .success-icon {
            width: 70px;
            height: 70px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin-bottom: 20px;

            background: #dcfce7;
            color: #15803d;

            border-radius: 50%;

            font-size: 36px;
            font-weight: bold;
        }

        h1 {
            margin: 0;
            color: #047857;
            font-size: 32px;
        }

        .description {
            margin-top: 10px;
            color: #64748b;
            font-size: 16px;
        }

        /* DATA PESERTA */

        .section-title {
            margin-top: 35px;
            margin-bottom: 18px;

            color: #065f46;
            font-size: 21px;
        }

        .data-grid {
            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: 15px;
        }

        .data-item {
            background: #f0fdf4;

            border: 1px solid #d1fae5;

            border-radius: 14px;

            padding: 17px;
        }

        .label {
            display: block;

            font-size: 13px;
            color: #64748b;

            margin-bottom: 6px;
        }

        .value {
            font-size: 16px;
            font-weight: 700;

            color: #166534;
        }

        /* BIAYA */

        .price-card {
            margin-top: 25px;

            border-radius: 18px;

            overflow: hidden;

            border: 1px solid #bbf7d0;
        }

        .price-header {
            background: #16a34a;
            color: white;

            padding: 17px 20px;

            font-size: 19px;
            font-weight: bold;
        }

        .price-body {
            padding: 20px;

            background: #f0fdf4;
        }

        .price-row {
            display: flex;
            justify-content: space-between;

            padding: 12px 0;

            border-bottom: 1px solid #d1fae5;
        }

        .price-row:last-child {
            border-bottom: none;
        }

        .price-label {
            color: #475569;
        }

        .price-value {
            font-weight: 600;
        }

        .discount {
            color: #dc2626;
        }

        .total {
            margin-top: 12px;

            padding-top: 18px;

            border-top: 2px solid #86efac;

            display: flex;
            justify-content: space-between;
            align-items: center;

            color: #047857;

            font-size: 21px;
            font-weight: 800;
        }

        /* MINAT */

        .interest-list {
            display: flex;

            flex-wrap: wrap;

            gap: 10px;

            padding: 0;

            list-style: none;
        }

        .interest-list li {
            background: #dcfce7;

            color: #166534;

            border: 1px solid #bbf7d0;

            padding: 9px 14px;

            border-radius: 30px;

            font-size: 14px;
            font-weight: 600;
        }

        .empty-interest {
            color: #64748b;
        }

        /* CATATAN */

        .notes {
            margin-top: 25px;

            background: #f0fdf4;

            border-left: 5px solid #16a34a;

            border-radius: 10px;

            padding: 17px 20px;
        }

        .notes-title {
            font-weight: bold;
            color: #166534;
            margin-bottom: 7px;
        }

        /* BUTTON */

        .actions {
            display: flex;

            gap: 12px;

            margin-top: 35px;

            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;

            padding: 14px 22px;

            border-radius: 12px;

            text-decoration: none;

            font-weight: bold;

            transition: 0.2s;
        }

        .btn-primary {
            background: linear-gradient(
                135deg,
                #16a34a,
                #059669
            );

            color: white;

            box-shadow:
                0 8px 20px rgba(22, 163, 74, 0.25);
        }

        .btn-primary:hover {
            transform: translateY(-2px);

            box-shadow:
                0 12px 25px rgba(22, 163, 74, 0.35);
        }

        .btn-secondary {
            background: white;

            color: #15803d;

            border: 1px solid #86efac;
        }

        .btn-secondary:hover {
            background: #f0fdf4;
        }

        /* FOOTER */

        .footer {
            text-align: center;

            color: #64748b;

            font-size: 13px;

            padding: 10px 20px 40px;
        }

        /* RESPONSIVE */

        @media (max-width: 700px) {

            .container {
                margin: 25px auto;
            }

            .success-card {
                padding: 25px;
            }

            .data-grid {
                grid-template-columns: 1fr;
            }

            h1 {
                font-size: 27px;
            }

            .total {
                font-size: 18px;
            }

        }

    </style>

</head>

<body>

<!-- HEADER -->

<header class="top-header">

    <div class="header-content">

        <div class="logo">
            KursusKu
        </div>

        <div class="subtitle">
            Platform pendaftaran kursus
        </div>

    </div>

</header>


<!-- CONTENT -->

<main class="container">

    <div class="success-card">

        <!-- SUCCESS -->

        <div class="success-icon">
            ✓
        </div>

        <h1>
            Pendaftaran Berhasil!
        </h1>

        <p class="description">
            Data pendaftaran kamu telah berhasil diproses.
            Silakan periksa kembali informasi dan rincian biaya
            berikut.
        </p>


        <!-- DATA PESERTA -->

        <h2 class="section-title">
            Data Peserta
        </h2>

        <div class="data-grid">

            <div class="data-item">
                <span class="label">Nama</span>
                <span class="value">
                    <?= e($name) ?>
                </span>
            </div>

            <div class="data-item">
                <span class="label">Email</span>
                <span class="value">
                    <?= e($email) ?>
                </span>
            </div>

            <div class="data-item">
                <span class="label">Kursus</span>
                <span class="value">
                    <?= e($course['name']) ?>
                </span>
            </div>

            <div class="data-item">
                <span class="label">Tipe Peserta</span>
                <span class="value">
                    <?= e(ucfirst($participantType)) ?>
                </span>
            </div>

            <div class="data-item">
                <span class="label">Metode Belajar</span>
                <span class="value">
                    <?= e($learningModeLabel) ?>
                </span>
            </div>

            <div class="data-item">
                <span class="label">Jumlah Paket</span>
                <span class="value">
                    <?= $packageCount ?> Paket
                </span>
            </div>

        </div>


        <!-- CATATAN -->

        <?php if ($notes !== ''): ?>

            <div class="notes">

                <div class="notes-title">
                    Catatan Tambahan
                </div>

                <div>
                    <?= e($notes) ?>
                </div>

            </div>

        <?php endif; ?>


        <!-- BIAYA -->

        <h2 class="section-title">
            Rincian Biaya
        </h2>

        <div class="price-card">

            <div class="price-header">
                💰 Detail Pembayaran
            </div>

            <div class="price-body">

                <div class="price-row">

                    <span class="price-label">
                        Biaya Kursus
                    </span>

                    <span class="price-value">
                        <?= rupiah($course['fee']) ?>
                    </span>

                </div>

                <div class="price-row">

                    <span class="price-label">
                        Jumlah Paket
                    </span>

                    <span class="price-value">
                        <?= $packageCount ?> ×
                        <?= rupiah($course['fee']) ?>
                    </span>

                </div>

                <div class="price-row">

                    <span class="price-label">
                        Subtotal
                    </span>

                    <span class="price-value">
                        <?= rupiah($grossTotal) ?>
                    </span>

                </div>

                <div class="price-row">

                    <span class="price-label">
                        Diskon
                        (<?= $discountPercent ?>%)
                    </span>

                    <span class="price-value discount">
                        - <?= rupiah($discountAmount) ?>
                    </span>

                </div>

                <div class="total">

                    <span>
                        Total Pembayaran
                    </span>

                    <span>
                        <?= rupiah($finalTotal) ?>
                    </span>

                </div>

            </div>

        </div>


        <!-- MINAT -->

        <h2 class="section-title">
            Minat yang Dipilih
        </h2>

        <?php if ($interests === []): ?>

            <div class="empty-interest">
                Belum memilih minat.
            </div>

        <?php else: ?>

            <ul class="interest-list">

                <?php foreach ($interests as $interest): ?>

                    <li>
                        <?= e(
                            $interestOptions[$interest] ?? $interest
                        ) ?>
                    </li>

                <?php endforeach; ?>

            </ul>

        <?php endif; ?>


        <!-- BUTTON -->

        <div class="actions">

            <a
                href="register.php"
                class="btn btn-primary"
            >
                + Daftar Kursus Lagi
            </a>

            <a
                href="index.php"
                class="btn btn-secondary"
            >
                ← Kembali ke Beranda
            </a>

        </div>

    </div>

</main>


<footer class="footer">

    © <?= date('Y') ?> KursusKu —
    Belajar lebih mudah, daftar lebih cepat.

</footer>

</body>

</html>
```
