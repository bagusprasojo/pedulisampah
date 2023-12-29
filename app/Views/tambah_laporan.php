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

        <form action="<?= site_url('tambah-laporan') ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="location">Judul:</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?= isset($_SESSION['old']['title']) ? $_SESSION['old']['title'] : '' ?>">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="location">Location:</label>
                        <input type="text" class="form-control" id="location" name="location" value="<?= isset($_SESSION['old']['location']) ? $_SESSION['old']['location'] : '' ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <script>
                tinymce.init({
                    selector: 'textarea',
                    plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
                    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                    tinycomments_mode: 'embedded',
                    tinycomments_author: 'Author name',
                    mergetags_list: [
                    { value: 'First.Name', title: 'First Name' },
                    { value: 'Email', title: 'Email' },
                    ],
                    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
                });
                </script>
                <textarea class="form-control" id="description" name="description"><?= isset($_SESSION['old']['description']) ? $_SESSION['old']['description'] : '' ?></textarea>
            </div>
            <div class="form-group">
                <label for="photo">Photos (bisa upload beberapa file sekaligus):</label>
                <input type="file" class="form-control-file" id="photo" name="photos[]" multiple>
            </div>
            <button type="submit" class="btn btn-primary mb-2">Submit</button>
        </form>
    </div>
<?= $this->endSection() ?>
