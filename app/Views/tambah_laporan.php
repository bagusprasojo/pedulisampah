<!-- app/Views/tambah_laporan.php -->
<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>
    <div class="container mt-4">
        <h2>Tambah Laporan Sampah</h2>
        <?php
                $errors = session()->getFlashdata('errors');
                if ($errors !== null) {
                    echo '<div class="alert alert-danger">' . implode('<br>', $errors) . '</div>';
                }
            ?>

        <form action="/tambah-laporan" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="location">Judul:</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= isset($_SESSION['old']['title']) ? $_SESSION['old']['title'] : '' ?>">
            </div>
            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" class="form-control" id="location" name="location" value="<?= isset($_SESSION['old']['location']) ? $_SESSION['old']['location'] : '' ?>">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description"><?= isset($_SESSION['old']['description']) ? $_SESSION['old']['description'] : '' ?></textarea>
            </div>
            <div class="form-group">
                <label for="photo">Photo:</label>
                <input type="file" class="form-control-file" id="photo" name="photos[]" multiple>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
<?= $this->endSection() ?>
