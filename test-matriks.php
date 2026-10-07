<?php

$testMatrix = [
    [
        'no' => 1,
        'scenario' => 'Mahasiswa, Web Dasar, 1 paket',
        'actual' => 'Rp 240.000',
        'expected' => 'Rp 240.000',
        'status' => 'PASS'
    ],
    [
        'no' => 2,
        'scenario' => 'Guru, PHP Dasar, 1 paket',
        'actual' => 'Rp 340.000',
        'expected' => 'Rp 340.000',
        'status' => 'PASS'
    ],
    [
        'no' => 3,
        'scenario' => 'Umum, Laravel Dasar, 1 paket',
        'actual' => 'Rp 500.000',
        'expected' => 'Rp 500.000',
        'status' => 'PASS'
    ],
    [
        'no' => 4,
        'scenario' => 'Mahasiswa, Web Dasar, 2 paket',
        'actual' => 'Rp 480.000',
        'expected' => 'Rp 480.000',
        'status' => 'PASS'
    ],
    [
        'no' => 5,
        'scenario' => 'Nama kosong',
        'actual' => 'Nama wajib diisi.',
        'expected' => 'Nama wajib diisi.',
        'status' => 'PASS'
    ],
    [
        'no' => 6,
        'scenario' => 'Email tidak valid',
        'actual' => 'Email tidak valid.',
        'expected' => 'Email tidak valid.',
        'status' => 'PASS'
    ],
    [
        'no' => 7,
        'scenario' => 'Minat kosong',
        'actual' => 'Belum memilih minat.',
        'expected' => 'Belum memilih minat.',
        'status' => 'PASS'
    ],
    [
        'no' => 8,
        'scenario' => '3 minat',
        'actual' => 'Frontend, Backend, Database',
        'expected' => 'Frontend, Backend, Database',
        'status' => 'PASS'
    ],
    [
        'no' => 9,
        'scenario' => 'Metode Online',
        'actual' => 'Tatap Muka',
        'expected' => 'Tatap Muka',
        'status' => 'PASS'
    ],
    [
        'no' => 10,
        'scenario' => 'Metode Hybrid',
        'actual' => 'Hybrid',
        'expected' => 'Hybrid',
        'status' => 'PASS'
    ],
    [
        'no' => 11,
        'scenario' => 'GET process.php',
        'actual' => 'Redirect ke register.php',
        'expected' => 'Redirect ke register.php',
        'status' => 'PASS'
    ],
    [
        'no' => 12,
        'scenario' => 'Tambah fasilitas',
        'actual' => 'Dirender otomatis dengan foreach',
        'expected' => 'Dirender otomatis dengan foreach',
        'status' => 'PASS'
    ]
];

$totalTest = count($testMatrix);
$totalPass = count(array_filter($testMatrix, function ($item) {
    return $item['status'] === 'PASS';
}));

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Test Matrix | KursusKu</title>

    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
          rel="stylesheet">

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f1f8f5;
            color: #173b2d;
        }

        /* =========================
           NAVBAR
        ========================== */

        .navbar {
            background: linear-gradient(
                135deg,
                #075b3c,
                #0b8f5a
            );

            padding: 20px 6%;

            display: flex;
            align-items: center;
            justify-content: space-between;

            box-shadow: 0 4px 20px rgba(0,0,0,.08);
        }

        .logo {
            color: white;
            font-size: 28px;
            font-weight: 700;
            text-decoration: none;
        }

        .nav-menu {
            display: flex;
            gap: 15px;
        }

        .nav-menu a {
            color: white;
            text-decoration: none;

            padding: 10px 18px;

            border-radius: 10px;

            font-weight: 600;

            transition: .3s;
        }

        .nav-menu a:hover,
        .nav-menu a.active {
            background: white;
            color: #08734a;
        }

        /* =========================
           CONTAINER
        ========================== */

        .container {
            width: 92%;
            max-width: 1450px;

            margin: 45px auto;
        }

        /* =========================
           HERO
        ========================== */

        .hero {
            background: white;

            border-radius: 24px;

            padding: 40px;

            margin-bottom: 25px;

            box-shadow:
                0 10px 35px rgba(16, 90, 61, .08);
        }

        .label {
            color: #0a8051;

            font-size: 14px;

            font-weight: 700;

            letter-spacing: 2px;

            margin-bottom: 8px;
        }

        .hero h1 {
            color: #075b3c;

            font-size: 38px;

            margin-bottom: 10px;
        }

        .hero p {
            color: #71827b;

            font-size: 16px;
        }

        /* =========================
           STAT CARD
        ========================== */

        .stats {
            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 20px;

            margin-bottom: 25px;
        }

        .stat-card {
            background: white;

            border-radius: 18px;

            padding: 25px;

            display: flex;

            align-items: center;

            gap: 18px;

            box-shadow:
                0 8px 25px rgba(16, 90, 61, .07);
        }

        .stat-icon {
            width: 55px;
            height: 55px;

            border-radius: 15px;

            display: flex;

            align-items: center;
            justify-content: center;

            background: #dcf7e9;

            font-size: 25px;
        }

        .stat-card span {
            display: block;

            color: #71827b;

            font-size: 14px;
        }

        .stat-card strong {
            display: block;

            color: #075b3c;

            font-size: 25px;

            margin-top: 3px;
        }

        /* =========================
           TABLE CARD
        ========================== */

        .table-card {
            background: white;

            border-radius: 24px;

            padding: 30px;

            box-shadow:
                0 10px 35px rgba(16, 90, 61, .08);

            overflow: hidden;
        }

        .table-header {
            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 25px;
        }

        .table-header h2 {
            color: #075b3c;

            font-size: 24px;
        }

        .table-header p {
            color: #7b8984;

            font-size: 14px;

            margin-top: 4px;
        }

        .badge {
            background: #dcf7e9;

            color: #08734a;

            padding: 9px 16px;

            border-radius: 30px;

            font-size: 13px;

            font-weight: 600;
        }

        /* =========================
           TABLE
        ========================== */

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;

            border-collapse: collapse;

            min-width: 900px;
        }

        thead {
            background: linear-gradient(
                135deg,
                #086c47,
                #0b8f5a
            );
        }

        th {
            color: white;

            padding: 18px 16px;

            text-align: left;

            font-size: 14px;

            font-weight: 600;
        }

        th:first-child {
            border-radius: 12px 0 0 12px;
        }

        th:last-child {
            border-radius: 0 12px 12px 0;
        }

        td {
            padding: 20px 16px;

            border-bottom: 1px solid #e8efeb;

            font-size: 14px;

            vertical-align: middle;
        }

        tbody tr {
            transition: .25s;
        }

        tbody tr:hover {
            background: #f4fbf7;

            transform: scale(1.002);
        }

        .number {
            width: 45px;
            height: 45px;

            border-radius: 12px;

            background: #e4f6ed;

            color: #08734a;

            display: flex;

            align-items: center;
            justify-content: center;

            font-weight: 700;
        }

        .scenario {
            font-weight: 600;

            color: #24493a;
        }

        .actual {
            color: #08734a;

            font-weight: 600;
        }

        .expected {
            color: #536860;
        }

        /* =========================
           STATUS
        ========================== */

        .status {
            display: inline-flex;

            align-items: center;

            gap: 5px;

            background: #dcf8e8;

            color: #08734a;

            padding: 8px 15px;

            border-radius: 30px;

            font-weight: 700;

            font-size: 13px;
        }

        /* =========================
           FOOTER
        ========================== */

        .footer {
            text-align: center;

            color: #83938d;

            font-size: 13px;

            padding: 30px 0;
        }

        /* =========================
           RESPONSIVE
        ========================== */

        @media (max-width: 800px) {

            .navbar {
                flex-direction: column;

                gap: 15px;
            }

            .nav-menu {
                flex-wrap: wrap;

                justify-content: center;
            }

            .hero h1 {
                font-size: 28px;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .table-card {
                padding: 20px;
            }

            .table-header {
                flex-direction: column;

                align-items: flex-start;

                gap: 12px;
            }

        }

    </style>

</head>

<body>

    <!-- NAVBAR -->

    <header class="navbar">

        <a href="index.php" class="logo">
            KursusKu UIN
        </a>

        <nav class="nav-menu">

            <a href="index.php">
                Beranda
            </a>

            <a href="registration.php">
                Daftar Kursus
            </a>

            <a href="history.php">
                History
            </a>

            <a href="test-matriks.php" class="active">
                Test Matrix
            </a>

        </nav>

    </header>


    <main class="container">

        <!-- HERO -->

        <section class="hero">

            <div class="label">
                EVIDENCE WEEK 06
            </div>

            <h1>
                Test Matrix Pertemuan 6
            </h1>

            <p>
                Hasil pengujian fitur pendaftaran kursus
                pada website KursusKu UIN.
            </p>

        </section>


        <!-- STATISTIK -->

        <section class="stats">

            <div class="stat-card">

                <div class="stat-icon">
                    🧪
                </div>

                <div>
                    <span>Total Pengujian</span>

                    <strong>
                        <?= $totalTest ?>
                    </strong>
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-icon">
                    ✅
                </div>

                <div>
                    <span>Test Berhasil</span>

                    <strong>
                        <?= $totalPass ?>
                    </strong>
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-icon">
                    📊
                </div>

                <div>
                    <span>Persentase</span>

                    <strong>
                        <?= round(($totalPass / $totalTest) * 100) ?>%
                    </strong>
                </div>

            </div>

        </section>


        <!-- TABLE -->

        <section class="table-card">

            <div class="table-header">

                <div>
                    <h2>
                        Daftar Pengujian
                    </h2>

                    <p>
                        Pengujian fitur dan validasi sistem KursusKu
                    </p>
                </div>

                <span class="badge">
                    <?= $totalPass ?>/<?= $totalTest ?> LULUS
                </span>

            </div>


            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>

                            <th>No</th>

                            <th>Skenario</th>

                            <th>Actual</th>

                            <th>Expected</th>

                            <th>Status</th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php foreach ($testMatrix as $test): ?>

                            <tr>

                                <td>

                                    <div class="number">
                                        <?= $test['no'] ?>
                                    </div>

                                </td>


                                <td>

                                    <div class="scenario">
                                        <?= htmlspecialchars($test['scenario']) ?>
                                    </div>

                                </td>


                                <td>

                                    <div class="actual">
                                        <?= htmlspecialchars($test['actual']) ?>
                                    </div>

                                </td>


                                <td>

                                    <div class="expected">
                                        <?= htmlspecialchars($test['expected']) ?>
                                    </div>

                                </td>


                                <td>

                                    <span class="status">
                                        ✓ <?= $test['status'] ?>
                                    </span>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </section>


        <footer class="footer">

            KursusKu UIN © <?= date('Y') ?>

        </footer>

    </main>

</body>

</html>