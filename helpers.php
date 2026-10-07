<?php 
    function rupiah(int $amount): string 
{    
    return 'Rp ' . number_format($amount, 0, ',', '.'); 
} 
    function statusKursus(int $quota, int $registered): string 
{    
    return $registered >= $quota ? 'Penuh' : 'Tersedia'; 
} 
function sisaKursi(int $quota, int $registered): int 
{    
    return max(0, $quota - $registered); 
} 
function formatTanggal(string $date): string 
{    
    $value = new DateTimeImmutable($date);    
    return $value->format('d-m-Y'); 
}
function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function formatRupiah(int $amount): string
{
    return 'Rp ' . number_format($amount, 0, ',', '.');
}

function findCourse(array $courses, string $code): ?array
{
    foreach ($courses as $course) {
        if ($course['code'] === $code) {
            return $course;
        }
    }

    return null;
}

function getDiscountPercent(string $participantType): int
{
    if ($participantType === 'mahasiswa') {
        return 20;
    } elseif ($participantType === 'guru') {
        return 15;
    }

    return 0;
}