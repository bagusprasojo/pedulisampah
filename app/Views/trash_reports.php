<!-- app/Views/trash_reports.php -->
<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>
    <!-- Daftar Laporan Sampah -->
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center p-3 rounded row" style="background-color: #DEE0D5; margin-bottom: 10px;">
            
            <div>
                <a href="<?= site_url('tambah-laporan'); ?>" class="btn btn-primary mx-2">Tambah Laporan</a>
                <a href="<?= site_url('trash-reports'); ?>" class="btn btn-success">Refresh</a>
            </div>
        </div>
        <div class="d-flex p-3 rounded row" style="background-color: #DEE0D5;">
            <?php foreach ($latestReports as $report): ?>
                <div class="card mb-2 ml-2 mr-2" style="width: 22rem; ">
                    <a href="full-trash-report/<?= $report['slug']; ?>"><img src="<?= base_url('public/uploads/' . $report['photo']); ?>" class="card-img-top" alt="Photo Sampah" style="max-width: 100%; height: auto;"></a>
                    <div class="card-body">
                    <a href="full-trash-report/<?= $report['slug']; ?>"><h5 class="card-title"><?= $report['title']; ?> (<?= $report['location']; ?>)</h5></a>
                        <small class="text-muted">Reported by <?= $report['username']; ?> on <?= date('F j, Y', strtotime($report['created_at'])); ?></small>
                        <p class="card-text"><?= $report['desc250']; ?></p>
                        
                    </div>
                    <div class="card-body border-top d-flex justify-content-between">
                        <div>
                            <i class="fa-regular fa-comments"></i> <?= $report['comment_count']; ?>
                            <i class="fa-regular fa-eye"></i> <?= $report['click_count']; ?>
                        </div>
                        <div class="share-icons">
                            <?php
                            $url = urlencode(site_url("full-trash-report/" . $report['slug']));
                            $text = urlencode('Tinjau ini: ' . site_url("full-trash-report/" . $report['slug']));
                            ?>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>" target="_blank"><img src="<?= base_url('img/fb.png'); ?>"/></a>
                            <a href="https://api.whatsapp.com/send?text=<?php echo $url; ?>" target="_blank"><img src="<?= base_url('img/wa.png'); ?>"/></a>
                            <a href="https://twitter.com/intent/tweet?url=<?php echo $url; ?>" target="_blank"><img src="<?= base_url('img/tw.png'); ?>"/></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Tampilkan link navigasi -->
            
        </div>
        <div class="mt-3 d-flex p-3 rounded row" style="background-color: #DEE0D5; margin-bottom: 10px;">
                <p>Halaman <?= $pager->simplelinks() ?></p>
            
        </div>        
    </div>
<?= $this->endSection() ?>
