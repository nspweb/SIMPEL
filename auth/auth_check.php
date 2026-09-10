<?php
/**
 * SIMPEL BPVP Kendari - Server-Side Authentication Guard
 * Melindungi halaman PHP dari akses tanpa otentikasi / inspect element
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Security Headers
header("X-Frame-Options: SAMEORIGIN");
header("X-Content-Type-Options: nosniff");
header("X-XSS-Protection: 1; mode=block");

// Pastikan pengguna sudah terotentikasi
if (!isset($_SESSION['user']) || empty($_SESSION['user']['id'])) {
    header("Location: index.php?error=unauthorized");
    exit();
}

$currentUser = $_SESSION['user'];

/**
 * Helper untuk membatasi akses peran tertentu pada halaman tertentu
 * @param array $allowedRoles Daftar peran yang diizinkan (misal: ['pengadaan', 'admin'])
 */
function requireRoleAccess(array $allowedRoles) {
    global $currentUser;
    $userRole = $currentUser['role'] ?? '';
    
    // Super Administrator memiliki akses ke seluruh modul
    if ($userRole === 'admin') {
        return true;
    }
    
    if (!in_array($userRole, $allowedRoles)) {
        $home = $currentUser['home'] ?? 'dashboard.php';
        header("Location: " . $home . "?error=forbidden");
        exit();
    }
    return true;
}
