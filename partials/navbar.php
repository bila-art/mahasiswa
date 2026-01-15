<?php $userName = $_SESSION['nama'] ?? 'Guest';
$base = $base ?? '.'; ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?= $base ?>/index.php text-white">Akademik</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link" href="<?= $base ?>/index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $base ?>/mahasiswa/index.php">Mahasiswa</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $base ?>/prodi/index.php">Prodi</a></li>
                <li class="nav-item dropdown ms-lg-3">
                    <a class="nav-link dropdown-toggle btn btn-outline-light btn-sm text-white px-3" href="#" data-bs-toggle="dropdown">
                        <?= htmlspecialchars($userName) ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li><a class="dropdown-item" href="<?= $base ?>/profile.php">Edit Profil</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item text-danger" href="<?= $base ?>/logout.php" onclick="return confirm('Logout?')">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>