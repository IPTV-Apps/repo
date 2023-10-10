<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <div id="sidebar-menu">

            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Cockpit Menu</li>
                <?php
                if ($DASHBOARD == true) {
                    echo '<li>
                            <a href="dashboard.php" class="waves-effect">
                                <i class="ri-dashboard-line"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>';
                }
                ?>

                <li class="menu-title">Streaming Applications</li>
                
                <li class="mm-active">
                    <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="true">
                        <i class="ri-tv-line"></i>
                        <span>WHMCS Smarters</span>
                    </a>

                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <a href="whmcssmarters_domains.php">
                                <span><i class="ri-global-line"></i>Domain List</span>
                            </a>
                        </li>
                        <li>
                            <a href="whmcssmarters_ovpn.php">
                                <span><i class="ri-shield-cross-line"></i>OpenVPN Archive</span>
                            </a>
                        </li>
                        <li>
                            <a href="whmcssmarters_announcements.php">
                                <span><i class="ri-chat-3-line"></i>Announcements</span>
                            </a>
                        </li>
                        <li>
                            <a href="whmcssmarters_adz.php">
                                <span><i class="ri-advertisement-line"></i>Advertisements</span>
                            </a>
                        </li>
                        <li>
                            <a href="whmcssmarters_feedback.php">
                                <span><i class="ri-feedback-line"></i>Feedback & Reports</span>
                            </a>
                        </li>
                        <li>
                            <a href="whmcssmarters_banners.php">
                                <span><i class="ri-menu-line"></i>Rotating Banners</span>
                            </a>
                        </li>
                        <li>
                            <a href="whmcssmarters_extras.php">
                                <span><i class="ri-add-box-line"></i>Extras</span>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="menu-title">Custom WebViews</li>

                <li>
                    <a href="webviews_tvsportsguide.php" class="waves-effect">
                        <i class="ri-football-line"></i>
                        <span>TV Sports Guide</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>