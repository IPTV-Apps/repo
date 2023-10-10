<?php
include('assets/includes/config.php');
include('assets/includes/db.php');
?>
<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">

            <div class="navbar-brand-box">
                <a href="index.php" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="<?php echo $USER_PROFILE_PANEL_EDITS ? $panel_data['logo_dark_sm'] : $USER_PROFILE_PANEL_LOGO_DARK_SMALL; ?>" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="<?php echo $USER_PROFILE_PANEL_EDITS ? $panel_data['logo_dark'] : $USER_PROFILE_PANEL_LOGO_DARK; ?>" alt="" height="20"> <?php echo '' . $_VERSION; ?>
                    </span>
                </a>

                <a href="index.php" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="<?php echo $USER_PROFILE_PANEL_EDITS ? $panel_data['logo_light_sm'] : $USER_PROFILE_PANEL_LOGO_LIGHT_SMALL; ?>" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="<?php echo $USER_PROFILE_PANEL_EDITS ? $panel_data['logo_light'] : $USER_PROFILE_PANEL_LOGO_LIGHT; ?>" alt="" height="20"> <?php echo '' . $_VERSION; ?>
                    </span>
                </a>

            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="ri-menu-2-line align-middle"></i>
            </button>


        </div>

        <div class="d-flex">

            <div class="dropdown d-none d-lg-inline-block ml-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ri-apps-2-line"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <div class="px-lg-2">
                        <div class="row no-gutters">
                            <div class="col">
                                <a class="dropdown-icon-item" href="https://t.me/IPTVAppsRebrands/">
                                    <img src="https://apklounge.com/down/cp/cpibopro/rm_tg_logo.png" alt="iptvappsrebrands">
                                    <span>IPTV Apps Rebrand</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="https://t.me/ApkLounge/">
                                    <img src="https://apklounge.com/down/cp/cppp/appbuster.ico" alt="apklounge">
                                    <span>Apk Lounge</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="https://t.me/WatchItTv/">
                                    <img src="https://apklounge.com/down/cp/cppp/watchittv.png" alt="watchittv">
                                    <span>WatchItTv</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="https://t.me/OxBox_UK">
                                    <img src="https://apklounge.com/down/cp/cppp/oxbox.ico" alt="oxbox">
                                    <span>OxBox</span>
                                </a>
                            </div>                            
                            <div class="col">
                                <a class="dropdown-icon-item" href="https://t.me/CobraStreams/">
                                    <img src="https://apklounge.com/down/cp/cppp/cobra.png" alt="cobrastreams">
                                    <span>Cobra Streams</span>
                                </a>
                            </div>
                            <div class="col">
                                <div class="col">
                                <a class="dropdown-icon-item" href="https://t.me/barringtonr">
                                    <img src="https://apklounge.com/down/cp/cpmp/barringtonr.jpg" alt="barringtonr">
                                    <span>BarringtonR</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dropdown d-none d-lg-inline-block ml-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="ri-fullscreen-line"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="<?php echo $profile_data['avatar_url']; ?>" alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ml-1"><?php echo $profile_data['profile_name']; ?></span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">

                    <a class="dropdown-item" href="profile_edit.php"><i class="ri-user-line align-middle mr-1"></i> Profile</a>
                    <a class="dropdown-item" href="snoop_logs.php"><i class="ri-spy-line align-middle mr-1"></i> Snoop Logs</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="encryption_tools.php"><i class="ri-folder-keyhole-line align-middle mr-1"></i> Encryption Tools</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="logout.php"><i class="ri-shut-down-line align-middle mr-1 text-danger"></i> Logout</a>
                </div>
            </div>

        </div>
    </div>
</header>