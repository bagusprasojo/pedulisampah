<!-- app/Views/includes/_navbar.php -->
<nav class="navbar navbar-expand-lg navbar-light bg-light" >
    <div class="container" >
        <a class="navbar-brand" href="#">Peduli Sampah</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse m-1 rounded" id="navbarNav" >
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('');?>">Beranda</a>
                </li>
                <!-- Tambahkan menu-menu lainnya sesuai kebutuhan -->
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('trash-reports');?>">Laporan Sampah</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Peta Sampah</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Tentang Kami</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Kontak</a>
                </li>

                <?php
                    $session = session();
                    $userData = $session->get();

                    if (array_key_exists('username', $userData) && $userData['username'] != '') {
                ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?= $userData['name']; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="<?= site_url('user_dashboard');?>">Dashboard</a>
                            <a class="dropdown-item" href="<?= site_url('logout');?>">Logout</a>
                        </div>
                    </li>
                        
                <?php
                    } else {
                ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url('login');?>">Login</a>
                        </li>

                <?php
                    }
                ?>
                
            </ul>
            <!-- Form pencarian -->
            <form class="form-inline my-2 my-lg-0" method='GET' action='/trash-reports'>
                <input class="form-control mr-sm-2" name="search" type="search" placeholder="Cari..." aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Cari</button>
            </form>
        </div>
    </div>
</nav>
