<header>
    <nav class="navbar navbar-expand navbar-light navbar-top">
        <div class="container-fluid">
            <a href="#" class="burger-btn d-block">
                <i class="bi bi-justify fs-3"></i>
            </a>

            <span class="ms-3 m-0"><?= date('F j, Y') ?></span>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-lg-0">
                    <div class="user-menu d-flex">
                        <div class="user-name text-end me-3">
                            <h6 class="mb-0 text-gray-600"><?= session()->get('logged_fullname') ?></h6>
                            <p class="mb-0 text-sm text-gray-600">ICS Research Coordinator</p>
                        </div>
                        <div class="user-img d-flex align-items-center">
                            <div class="avatar avatar-md">
                                <img src="<?= session()->get('logged_profile') ?>" style="object-fit: cover; aspect-ratio: 1/1;">
                            </div>
                        </div>
                    </div>
                </ul>

            </div>
        </div>
    </nav>
</header>