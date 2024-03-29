<?= $this->extend('templates/main') ?>

<style>
    body{
    margin-top:20px;
    color: #1a202c;
    text-align: left;
    background-color: #e2e8f0;    
}
.main-body {
    padding: 15px;
}
.card {
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: .25rem;
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}

.gutters-sm {
    margin-right: -8px;
    margin-left: -8px;
}

.gutters-sm>.col, .gutters-sm>[class*=col-] {
    padding-right: 8px;
    padding-left: 8px;
}
.mb-3, .my-3 {
    margin-bottom: 1rem!important;
}

.bg-gray-300 {
    background-color: #e2e8f0;
}
.h-100 {
    height: 100%!important;
}
.shadow-none {
    box-shadow: none!important;
}
</style>

<?= $this->section('content') ?>
    
<div class="container mt-4 mb-4">
    <div class="main-body">
    
          <!-- Breadcrumb -->
          <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">User Dashboard</li>
            </ol>
          </nav>
          <!-- /Breadcrumb -->
    
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="<?= base_url('img/User-icon.png'); ?>" alt="Admin" class="rounded-circle" width="150">
                    
                    <div class="mt-3">
                      <h4><?= $userData['name'] ?></h4>
                      <p class="text-muted font-size-sm"><?= $userData['address'] ?></p>
                      <?php if ($is_show_button){ ?>
                        <?php if ($is_follow) {?>
                          <a href="<?= site_url('unfollow/' . $userData['id']); ?>" class="btn btn-primary">Unfollow</a>
                        <?php } else {?>
                          <a href="<?= site_url('follow/' . $userData['id']); ?>" class="btn btn-primary">Follow</a>
                        <?php } ?>
                        <button class="btn btn-outline-primary">Message</button>
                      <?php }?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mt-3">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><i class="mr-2 fa-regular fa-file" aria-hidden="true"></i>Trash Reports</h6>
                    <span class="text-secondary"><?= $statistics['jumlah_laporan'] ?></span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><i class="mr-2 fa-regular fa-comments" aria-hidden="true"></i>Comment In</h6>
                    <span class="text-secondary"><?= $statistics['jumlah_komentar_masuk'] ?></span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><i class="mr-2 fa-regular fa-comment-dots" aria-hidden="true"></i>Comment Out</h6>
                    <span class="text-secondary"><?= $statistics['jumlah_komentar_keluar'] ?></span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><i class="mr-2 fa-regular fa-eye" aria-hidden="true"></i>Trash Report Views</h6>
                    <span class="text-secondary"><?= $statistics['jumlah_view'] ?></span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><i class="mr-2 fa-solid fa-person-walking-arrow-loop-left"></i>Follower</h6>
                    <span class="text-secondary"><?= $userData['follower_count'] ?></span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><i class="mr-2 fa-solid fa-person-walking-arrow-right"></i>Following</h6>
                    <span class="text-secondary"><?= $userData['following_count'] ?></span>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-md-8">
              <div class="row gutters-sm">
                <div class="col-sm-12 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <h5 class="d-flex align-items-center mb-3">Trash Report by <?= $userData['name'];?></h5>
                      <?php foreach ($latestReports as $report): ?>
                        <a href="<?= site_url(); ?>/full-trash-report/<?= $report['slug'] ?>"><?= $report['title'] ?></a><hr>
                        
                      <?php endforeach; ?>
                      

                      <div class="pagination">
                        <p>Halaman </p>
                        <?= $pager->links() ?>
                    </div>
                    </div>
                  </div>
                </div>                
              </div>



            </div>
          </div>

        </div>
    </div>

    
<?= $this->endSection() ?>
