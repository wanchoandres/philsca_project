<?php $nav_active = session()->get('nav_active'); ?>

<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="logo text-center">
                <a href="#"><img src="/landingPageAssets/images/philsca-logo.png" style="width: auto; height: 100px;" alt="Logo" srcset=""></a>
            </div>
            <h5 class="mt-3 text-center">Research Management Repository System</h5>
        </div>

        <hr class="m-0">

        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item <?= $nav_active == 'dashboard' ? 'active' : '' ?>">
                    <a href="/AdminController/DashboardPage" class='sidebar-link'>
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li>


                <li class="sidebar-item <?= $nav_active == 'department' ? 'active' : '' ?>">
                    <a href="/AdminController/DepartmentPage" class='sidebar-link'>
                        <i class="bi bi-buildings"></i>
                        <span>Institute</span>
                    </a>
                </li>

                <li class="sidebar-item <?= $nav_active == 'program' ? 'active' : '' ?>">
                    <a href="/AdminController/ProgramPage" class='sidebar-link'>
                        <i class="bi bi-diagram-3"></i>
                        <span>Program</span>
                    </a>
                </li>

                <li class="sidebar-item <?= $nav_active == 'agenda' ? 'active' : '' ?>">
                    <a href="/AdminController/AgendaPage" class='sidebar-link'>
                        <i class="bi bi-list-columns"></i>
                        <span>Agenda</span>
                    </a>
                </li>

                <li class="sidebar-item has-sub <?= $nav_active == 'research' ? 'active' : '' ?>">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-newspaper"></i>
                        <span>Research</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item">
                            <a href="/AdminController/ResearchThesisPage" class="submenu-link">Capstone List</a>
                        </li>

                        <li class="submenu-item">
                            <a href="/AdminController/ResearchArchivePage" class="submenu-link">Archive</a>
                        </li>

                        <li class="submenu-item">
                            <a href="/AdminController/ResearchAnalyticsPage" class="submenu-link">Analytics</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item has-sub <?= $nav_active == 'accounts' ? 'active' : '' ?>">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-person-workspace"></i>
                        <span>Accounts</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item">
                            <a href="/AdminController/AccountsAdministratorPage" class="submenu-link">Administrators</a>
                        </li>

                        <li class="submenu-item">
                            <a href="/AdminController/AccountsStudentPage" class="submenu-link">Students</a>
                        </li>

                        <li class="submenu-item">
                            <a href="/AdminController/AccountsCoordinatorPage" class="submenu-link">Coordinator</a>
                        </li>

                        <li class="submenu-item">
                            <a href="/AdminController/AccountsPendingPage" class="submenu-link">Pending</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-title">Settings</li>

                <li class="sidebar-item  <?= $nav_active == 'profile' ? 'active' : '' ?>">
                    <a href="/AdminController/UpdateProfilePage" class='sidebar-link'>
                        <i class="bi bi-gear"></i>
                        <span>Update Profile</span>
                    </a>
                </li>

                <li class="sidebar-item <?= $nav_active == 'email' ? 'active' : '' ?>">
                    <a href="/AdminController/ChangeEmailPage" class='sidebar-link'>
                        <i class="bi bi-pen"></i>
                        <span>Change Email</span>
                    </a>
                </li>

                <li class="sidebar-item  <?= $nav_active == 'password' ? 'active' : '' ?>">
                    <a href="/AdminController/ChangePasswordPage" class='sidebar-link'>
                        <i class="bi bi-key"></i>
                        <span>Change Password</span>
                    </a>
                </li>

                <li class="sidebar-title">Documentation</li>

                <li class="sidebar-item <?= $nav_active == 'developers' ? 'active' : '' ?>">
                    <a href="/AdminController/DevelopersPage" class='sidebar-link'>
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