<!-- Image and text -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <!-- Image and text -->
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="<?= base_url('/'); ?>">
            <img src="<?= base_url('assets/img/unila.png'); ?>" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
            PEMIRA UNILA 2020
        </a>
    </nav>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="<?= base_url('/'); ?>">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('/user'); ?>">Voting</a>
            </li>
        </ul>
    </div>
    <?php if ($this->session->userdata('npm')) : ?>
        <div class="d-flex justify-content-end">
            <a class="btn btn-danger" style="color: white;" href="<?php echo base_url('auth/logout'); ?>">Logout</a>
        </div>
    <?php else : ?>
        <div class="d-flex justify-content-end">
            <a class="btn btn-primary" style="color: white;" href="<?php echo base_url('auth/'); ?>">Login</a>
        </div>
    <?php endif; ?>
</nav>