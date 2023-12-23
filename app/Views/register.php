<!-- Di dalam view register.php -->
<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>
    <div class="container">
        <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
            <div class="card p-4" style="width: 400px;">

                
                <?php
                    $errors = session()->getFlashdata('errors');
                    if ($errors !== null) {
                        echo '<div class="alert alert-danger">' . implode('<br>', $errors) . '</div>';
                    }
                ?>

                <form action="/register" method="post">
                    <div class="mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Username" value="<?= isset($_SESSION['old']['username']) ? $_SESSION['old']['username'] : '' ?>">
                    </div>
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email"value="<?= isset($_SESSION['old']['email']) ? $_SESSION['old']['email'] : '' ?>">
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Nama" value="<?= isset($_SESSION['old']['name']) ? $_SESSION['old']['name'] : '' ?>">
                    </div>
                    <div class="mb-3">
                        <textarea name="alamat" class="form-control" placeholder="Alamat"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Daftar</button>
                </form>
            </div>
        </div>
    </div>

<?php
    unset($_SESSION['errors']);
    unset($_SESSION['old']);    
?>

<?= $this->endSection() ?>
