<?php
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$studyProgram = trim($_POST['study_program'] ?? '');
$course = $_POST['course'] ?? '';
$participantType = $_POST['participant_type'] ?? '';
$interests = $_POST['interests'] ?? [];
$note = trim($_POST['note'] ?? '');
$source = $_POST['source'] ?? '';
$interestText = implode(', ', $interests);
function e($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
?>

<?php

// Mengambil data dari form
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$study_program = $_POST['study_program'] ?? '';
$course = $_POST['course'] ?? '';
$participant_type = $_POST['participant_type'] ?? '';
$interest = $_POST['interest'] ?? '';

// Daftar nama kursus
$courseNames = [
    'web-dasar' => 'Web Dasar',
    'laravel-fundamental' => 'Laravel Fundamental',
    'database' => 'Database',
    'ui-ux' => 'UI/UX Design'
];

$courseDisplay = $courseNames[$course] ?? $course;
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Hasil Pendaftaran - KursusKu</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 40px 20px;
            font-family: Arial, Helvetica, sans-serif;

            background:
                linear-gradient(
                    135deg,
                    #ecfdf5,
                    #f0fdf4
                );

            color: #16332c;
        }

        .container {
            max-width: 850px;
            margin: auto;
        }

        /* Header */
        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            display: inline-block;

            background: #15803d;
            color: white;

            padding: 10px 20px;
            border-radius: 30px;

            font-size: 18px;
            font-weight: bold;

            margin-bottom: 15px;
        }

        .header h1 {
            margin: 0 0 10px;

            font-size: 32px;
            color: #166534;
        }

        .header p {
            margin: 0;

            color: #64748b;
            font-size: 16px;
        }

        /* Card utama */
        .card {
            background: white;

            border-radius: 18px;

            padding: 30px;

            box-shadow:
                0 10px 30px rgba(22, 101, 52, 0.10);

            border: 1px solid #dcfce7;
        }

        /* Status */
        .success-box {
            display: flex;
            align-items: center;
            gap: 15px;

            background: #f0fdf4;

            border: 1px solid #bbf7d0;

            padding: 18px;

            border-radius: 14px;

            margin-bottom: 25px;
        }

        .success-icon {
            width: 45px;
            height: 45px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #16a34a;
            color: white;

            border-radius: 50%;

            font-size: 22px;
            font-weight: bold;
        }

        .success-text h3 {
            margin: 0 0 5px;

            color: #166534;
        }

        .success-text p {
            margin: 0;

            color: #4b5563;
            font-size: 14px;
        }

        /* Judul bagian */
        .section-title {
            font-size: 20px;

            color: #166534;

            margin: 25px 0 15px;

            padding-bottom: 10px;

            border-bottom: 2px solid #dcfce7;
        }

        /* Data */
        .data-list {
            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 15px;
        }

        .data-item {
            background: #f8fafc;

            border: 1px solid #e2e8f0;

            border-radius: 12px;

            padding: 15px;
        }

        .data-label {
            display: block;

            font-size: 13px;

            color: #64748b;

            margin-bottom: 6px;
        }

        .data-value {
            display: block;

            font-size: 16px;

            font-weight: 600;

            color: #1e293b;

            word-break: break-word;
        }

        /* Kursus */
        .course-box {
            background: #166534;

            color: white;

            padding: 20px;

            border-radius: 14px;

            margin-top: 15px;
        }

        .course-box small {
            display: block;

            color: #bbf7d0;

            margin-bottom: 5px;
        }

        .course-box strong {
            font-size: 21px;
        }

        /* Tombol */
        .actions {
            display: flex;

            gap: 12px;

            margin-top: 30px;
        }

        .btn {
            flex: 1;

            text-align: center;

            text-decoration: none;

            padding: 13px 20px;

            border-radius: 10px;

            font-weight: bold;

            transition: 0.2s;
        }

        .btn-primary {
            background: #16a34a;

            color: white;
        }

        .btn-primary:hover {
            background: #15803d;
        }

        .btn-secondary {
            background: #f0fdf4;

            color: #166534;

            border: 1px solid #bbf7d0;
        }

        .btn-secondary:hover {
            background: #dcfce7;
        }

        /* Footer */
        .footer {
            text-align: center;

            margin-top: 25px;

            color: #64748b;

            font-size: 13px;
        }

        /* Tampilan HP */
        @media (max-width: 650px) {

            body {
                padding: 25px 15px;
            }

            .card {
                padding: 20px;
            }

            .header h1 {
                font-size: 25px;
            }

            .data-list {
                grid-template-columns: 1fr;
            }

            .actions {
                flex-direction: column;
            }

        }

    </style>
</head>

<body>

    <div class="container">

        <!-- Header -->
        <div class="header">

            <div class="logo">
                KursusKu UIN
            </div>

            <h1>
                Pendaftaran Diterima
            </h1>

            <p>
                Terima kasih telah melakukan pendaftaran kursus.
            </p>

        </div>


        <!-- Card -->
        <div class="card">

            <!-- Status berhasil -->
            <div class="success-box">

                <div class="success-icon">
                    ✓
                </div>

                <div class="success-text">

                    <h3>
                        Pendaftaran Berhasil!
                    </h3>

                    <p>
                        Data pendaftaran Anda telah berhasil diproses.
                    </p>

                </div>

            </div>


            <!-- Data peserta -->
            <h2 class="section-title">
                Data Peserta
            </h2>

            <div class="data-list">

                <div class="data-item">

                    <span class="data-label">
                        Nama
                    </span>

                    <span class="data-value">
                        <?= htmlspecialchars($name) ?>
                    </span>

                </div>


                <div class="data-item">

                    <span class="data-label">
                        Email
                    </span>

                    <span class="data-value">
                        <?= htmlspecialchars($email) ?>
                    </span>

                </div>


                <div class="data-item">

                    <span class="data-label">
                        Nomor HP
                    </span>

                    <span class="data-value">
                        <?= htmlspecialchars($phone) ?>
                    </span>

                </div>


                <div class="data-item">

                    <span class="data-label">
                        Program Studi
                    </span>

                    <span class="data-value">
                        <?= htmlspecialchars($study_program) ?>
                    </span>

                </div>


                <div class="data-item">

                    <span class="data-label">
                        Jenis Peserta
                    </span>

                    <span class="data-value">
                        <?= htmlspecialchars($participant_type) ?>
                    </span>

                </div>


                <div class="data-item">

                    <span class="data-label">
                        Minat
                    </span>

                    <span class="data-value">
                        <?= htmlspecialchars($interest) ?>
                    </span>

                </div>

            </div>


            <!-- Informasi kursus -->
            <h2 class="section-title">
                Kursus yang Dipilih
            </h2>

            <div class="course-box">

                <small>
                    Program Kursus
                </small>

                <strong>
                    <?= htmlspecialchars($courseDisplay) ?>
                </strong>

            </div>


            <!-- Tombol -->
            <div class="actions">

                <a
                    href="index.php"
                    class="btn btn-primary"
                >
                    ← Kembali ke Beranda
                </a>

                <a
                    href="registration.php"
                    class="btn btn-secondary"
                >
                    Daftar Kursus Lagi
                </a>

            </div>

        </div>


        <!-- Footer -->
        <div class="footer">

            © <?= date('Y') ?> KursusKu UIN
            · Sistem Pendaftaran Kursus

        </div>

    </div>

</body>

</html>