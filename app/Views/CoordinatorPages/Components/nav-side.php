<?php $nav_active = session()->get('nav_active'); ?>

<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="logo text-center">
                <a href="#"><img src="/landingPageAssets/images/ics-logo.png" style="width: auto; height: 100px;" alt="Logo" srcset=""></a>
            </div>
            <h5 class="mt-3 text-center">Research Management Repository System</h5>
        </div>

        <hr class="m-0">

        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item <?= $nav_active == 'dashboard' ? 'active' : '' ?>">
                    <a href="/CoordinatorController/DashboardPage" class='sidebar-link'>
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item has-sub <?= $nav_active == 'research' ? 'active' : '' ?>">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-newspaper"></i>
                        <span>Research</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item">
                            <a href="/CoordinatorController/ResearchThesisPage" class="submenu-link">Capstone List</a>
                        </li>

                        <li class="submenu-item">
                            <a href="/CoordinatorController/ResearchAnalyticsPage" class="submenu-link">Analytics</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-title">Settings</li>

                <li class="sidebar-item  <?= $nav_active == 'profile' ? 'active' : '' ?>">
                    <a href="/CoordinatorController/UpdateProfilePage" class='sidebar-link'>
                        <i class="bi bi-gear"></i>
                        <span>Update Profile</span>
                    </a>
                </li>

                <li class="sidebar-item <?= $nav_active == 'email' ? 'active' : '' ?>">
                    <a href="/CoordinatorController/ChangeEmailPage" class='sidebar-link'>
                        <i class="bi bi-pen"></i>
                        <span>Change Email</span>
                    </a>
                </li>

                <li class="sidebar-item  <?= $nav_active == 'password' ? 'active' : '' ?>">
                    <a href="/CoordinatorController/ChangePasswordPage" class='sidebar-link'>
                        <i class="bi bi-key"></i>
                        <span>Change Password</span>
                    </a>
                </li>

                <li class="sidebar-title">Documentation</li>

                <li class="sidebar-item <?= $nav_active == 'developers' ? 'active' : '' ?>">
                    <a href="/CoordinatorController/DevelopersPage" class='sidebar-link'>
                        <i class="bi bi-person-workspace"></i>
                        <span>Developers</span>
                    </a>
                </li>

                <br>

                <a href="/LoginController/Logout" class="btn btn-secondary w-100"><i class="bi bi-box-arrow-in-left me-2"></i><small>Logout</small></a>
            </ul>
        </div>
    </div>
</div>