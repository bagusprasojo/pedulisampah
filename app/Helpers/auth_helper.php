<?php

if (!function_exists('is_logged_in')) {
    function is_logged_in()
    {
        // Logika untuk memeriksa apakah pengguna sudah login
        // Misalnya, periksa sesi atau status autentikasi pengguna

        // Gantikan dengan logika validasi sesuai dengan kebutuhan Anda
        return isset($_SESSION['user_id']); // Contoh: Cek apakah ada 'user_id' di sesi
    }
}
