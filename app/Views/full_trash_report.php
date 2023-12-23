<!-- app/Views/full_trash_report.php -->
<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>
    <div class="container mt-4">
        <div class="card mb-1">
            <div id="carouselExampleIndicators" class="carousel slide border border-primary" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php foreach ($photos as $key => $photo) : ?>
                    <li data-target="#carouselExampleIndicators" data-slide-to="<?= $key ?>" <?= $key === 0 ? 'class="active"' : '' ?>></li>
                    <?php endforeach; ?>
                </ol>
                <div class="carousel-inner">
                    <?php foreach ($photos as $key => $photo) : ?>
                    <div class="carousel-item <?= $key === 0 ? 'active' : '' ?>">
                        <img src="<?= base_url('uploads/' . $photo['photo_path']); ?>" class="d-block w-100" alt="Photo <?= $key ?>">
                    </div>
                    <?php endforeach; ?>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" type="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" type="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            
            
            <div class="card-body">
                <h5 class="card-title"><?= $report['title']; ?></h5>
                <small class="text-muted">Reported by <?= $report['username']; ?> on <?= date('F j, Y', strtotime($report['created_at'])); ?></small>                        
                <p class="card-text"><?= $report['description']; ?></p>
                <p>
                    <button id="btn_show_comment" class="btn btn-primary form-rounded"><?= "Number of Comments : " . $commentCount; ?></button>
                </p>
            </div>            
        </div>
        <div class="card mb-1 bg-secondary" id="add_comment" style="display:none;">
            <div class="card-body">
                <!-- Form untuk Input Komentar -->
                <form action="/comment/add/<?= $report['id']; ?>" method="post" class="d-flex">
                    <Input class="form-control form-rounded flex-grow-1 mr-2" type="text" name="comment_text" placeholder="Masukkan komentar Anda" required>
                    <button type="submit" class="btn btn-primary form-rounded">Simpan</button>
                </form>
            </div>            
        </div>

        <div class="card mb-1" id="list_comment" style="display:none;">
            <!-- Tampilan Komentar -->
            <div class="card-body">
                <?php foreach ($comments as $comment): ?>
                    <div class="comment">
                        <span class="font-weight-bold"><?= $comment['name']?></span><small class="text-muted"><?= ' - ' . $comment['created_at']?></small>
                        
                        <p><?= $comment['comment_text']; ?></p>
                    </div>
                <?php endforeach; ?>

                
            </div>
        </div>
    </div>
    <script>
        const showBtn = document.getElementById('btn_show_comment')
        const div_add_comment = document.getElementById("add_comment");
        const div_list_comment = document.getElementById("list_comment");

        showBtn.addEventListener('click', () => {
            div_add_comment.style.display = 'block'
            div_list_comment.style.display = 'block'
        })
    </script>
<?= $this->endSection() ?>
