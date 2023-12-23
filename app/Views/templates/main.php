<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peduli Sampah</title>
    <link rel="stylesheet" href="<?= base_url('css/styles.css'); ?>">

    <!-- Link ke Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- Letakkan CSS kustom atau link ke file CSS Anda di sini jika ada -->

    <script src="https://kit.fontawesome.com/1f76d780ab.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Navbar -->
    
    <?php 
        include(APPPATH . 'Views/includes/_navbar.php'); 
        
        $session = session();

        if (!$session->has('visitor_id')) {
            $visitorId = 'visitor_' . time();

            $session->set('visitor_id', $visitorId);
        }
    ?>

    <!-- Banner -->
    <!-- <div class="banner" style="height: 200px; background-color: #f0f0f0;"> -->
        <!-- Konten banner -->
        <!-- Anda bisa menambahkan gambar, teks, atau konten lainnya di sini -->
    <!-- </div> -->

    <!-- Content -->
    <div class="d-flex justify-content-between " style="background-color: #A7C5C5;">
    <?= $this->renderSection('content') ?>
    </div>

    <!-- File JavaScript Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <!-- Letakkan JavaScript kustom atau link ke file JavaScript Anda di sini jika ada -->
</body>
</html>
