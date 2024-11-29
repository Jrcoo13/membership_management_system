<div class="header">
    <div class="header-left">
        <a href="<?= base_url('admin/index') ?>" class="logo"> <img src="<?= base_url('assets/img/logo.png') ?>" width="50" height="70" alt="logo"> <span class="logoclass text-dark">LSC</span> </a>
        <a href="<?= base_url('admin/index') ?>" class="logo logo-small"> <img src="<?= base_url('assets/img/logo.png') ?>" alt="Logo" width="30" height="30"> </a>
    </div>
    <a href="javascript:void(0);" id="toggle_btn"> <i class="fe fe-text-align-left text-dark"></i> </a>
    <a class="mobile_btn" id="mobile_btn"> <i class="fas fa-bars"></i> </a>
    <ul class="nav user-menu">
        <li class="nav-item dropdown has-arrow">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"> <span class="user-img"><img class="rounded-circle" src="<?= session()->get('user')['profile_picture']
                                                                                                                                                ? base_url('upload/' . session()->get('user')['profile_picture'])
                                                                                                                                                : base_url('assets/img/default_profile.png') ?>" width="35" height="35" style="border: 0.1px solid #000;"></span> </a>
            <div class="dropdown-menu">
                <div class="user-header">
                    <div class="avatar avatar-sm"> <img src="<?= session()->get('user')['profile_picture']
                                                                    ? base_url('upload/' . session()->get('user')['profile_picture'])
                                                                    : base_url('assets/img/default_profile.png') ?>" alt="User Image" class="avatar-img rounded-circle" style="border: 0.1px solid #000; background-color: transparent"> </div>
                    <div class="user-text">
                        <h6><?= session()->get('user')['first_name'] . ' ' . session()->get('user')['last_name'] ?></h6>
                        <p class="text-muted mb-0"><?= session()->get('user')['role'] ?></p>
                    </div>
                </div>
                <a class="dropdown-item" href="<?= base_url('/admin/admin_profile') ?>">My Profile</a>
                <a class="dropdown-item" href="<?= base_url('logout') ?>">Logout</a>
            </div>
        </li>
    </ul>
</div>