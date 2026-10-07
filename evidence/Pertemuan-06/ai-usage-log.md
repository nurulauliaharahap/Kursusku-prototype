# AI Usage Log - Pertemuan 6

## Identitas Proyek

- **Nama Proyek:** KursusKu UIN
- **Pertemuan:** 6
- **Topik:** Pengembangan dan Pengujian Website KursusKu
- **Teknologi:** PHP, HTML, CSS
- **AI Assistant:** ChatGPT

---

## 1. Tujuan Penggunaan AI

AI digunakan sebagai bantuan dalam proses pengembangan website KursusKu,
terutama untuk:

- memperbaiki kode PHP;
- membantu proses pendaftaran kursus;
- menyimpan data pendaftaran ke history;
- memperbaiki tampilan halaman history;
- membuat Test Matrix;
- memperbaiki error pada kode;
- membuat tampilan website lebih rapi dan menarik.

AI digunakan sebagai alat bantu, sedangkan proses pengecekan,
pengujian, dan keputusan akhir dilakukan oleh pengembang.

---

## 2. Penggunaan AI pada Fitur Pendaftaran

### Prompt
> Bagaimana cara membuat data pendaftaran dari process.php
> tersimpan dan muncul di history.php?

### Bantuan AI
AI memberikan contoh penggunaan PHP Session untuk menyimpan
data pendaftaran.

Contoh konsep yang digunakan:

```php
session_start();

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