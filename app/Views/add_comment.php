<!-- app/Views/add_comment.php -->

<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>
    <div class="container mt-5 mb-5">
        <div class="card mb-1 bg-secondary" id="add_comment">
            <div class="card-body">
                <!-- Form untuk Input Komentar -->
                <form action="/comment/add/<?= $slug; ?>" method="post" class="d-flex">
                    <Input class="form-control form-rounded flex-grow-1 mr-2" type="text" name="comment_text" placeholder="Masukkan komentar Anda" required>
                    <button type="submit" class="btn btn-primary form-rounded">Simpan</button>
                </form>
            </div>            
        </div>
    </div>
<?= $this->endSection() ?>
