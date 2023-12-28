<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>
<!-- Page Content-->
<div class="container px-4 px-lg-5">
            <!-- Heading Row-->
            <div class="row gx-4 gx-lg-5 align-items-center my-5">
                <div class="col-lg-7"><img class="img-fluid rounded mb-4 mb-lg-0" src="<?= base_url('img/river.jpg');?>" alt="..." /></div>
                <div class="col-lg-5">
                    <h1 class="font-weight-light">Buktikan Anda Peduli !</h1>
                    <p>"Terkadang, keindahan alam sekitar kita terlihat begitu rapuh. Akankah kita biarkan keabadian foto yang kita lihat hanya menjadi kenangan? Kita semua memiliki kekuatan untuk mengubah cerita ini. Bersama, mari kita jaga kebersihan lingkungan agar tidak ada lagi keindahan yang terabaikan. Satu langkah kecil dapat menyelamatkan keajaiban yang tak ternilai ini. Mulai dari sekarang, bersama kita bangun komitmen untuk melindungi keindahan yang kita cintai. Mari kita jadikan setiap sudut dunia ini sebagai bukti bahwa kebersihan adalah cerminan dari kepedulian kita akan masa depan bumi."</p>
                    <a class="btn btn-primary" href="<?= site_url('trash-reports');?>">Laporkan Sampah!</a>
                </div>
            </div>
            <!-- Call to Action-->
            <div class="card text-white bg-secondary my-5 py-4 text-center">
                <div class="card-body"><p class="text-white m-0">Hanya dengan <strong>tiga</strong> langkah di bawah ini Anda sudah berkontribusi dalam menjaga keindahan bumi !</p></div>
            </div>
            <!-- Content Row-->
            <div class="row gx-4 gx-lg-5">
                <div class="col-md-4 mb-5">
                    <div class="card h-100">
                        <div class="card-body">
                            <h2 class="card-title">Laporkan Sampah</h2>
                            <p class="card-text">“Setiap laporan adalah langkah kecil untuk menyadarkan bahwa setiap sampah tercatat dan setiap tindakan kita berharga untuk memperbaiki bumi.”</p>
                        </div>
                        <div class="card-footer"><a class="btn btn-primary btn-sm" href="<?= site_url('tambah-laporan');?>">Laporkan</a></div>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <div class="card h-100">
                        <div class="card-body">
                            <h2 class="card-title">Share ke Media Sosial</h2>
                            <p class="card-text">“Setiap bagian informasi yang kita sebarkan adalah peluang untuk mengajak lebih banyak orang untuk peduli, karena perubahan dimulai dari kesadaran yang dibagikan.”</p>
                        </div>
                        <div class="card-footer"><a class="btn btn-primary btn-sm" href="<?= site_url('trash-reports');?>">Share !</a></div>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <div class="card h-100">
                        <div class="card-body">
                            <h2 class="card-title">Join Komunitas</h2>
                            <p class="card-text">“Ketika kita bergabung dalam sebuah komunitas, kita membangun kekuatan bersama untuk mewujudkan perubahan yang nyata dalam menjaga kebersihan bumi dari sampah.”</p>
                        </div>
                        <div class="card-footer"><a class="btn btn-primary btn-sm" href="<?= site_url('komunitas');?>">Join</a></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer-->
            
<?= $this->endSection() ?>
