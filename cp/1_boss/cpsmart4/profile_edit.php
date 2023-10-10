<?php
session_start();

include('assets/includes/db.php');
include('assets/includes/config.php');

if($_ERRORS == true){
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) {
    header("location: logout.php");
}

$sql = "SELECT * FROM profile ";
$sql .= "WHERE id = '1';";
$result = $sqlite3->query($sql);
$profile_data = $result->fetchArray();

$sql = "SELECT * FROM panel;";
$result = $sqlite3->query($sql);
$panel_data = $result->fetchArray();

if (isset($_POST['save_profile'])) {
    $sql = "UPDATE profile SET ";
    $sql .= "profile_name = '" . $_POST['profile_first_name'] . "', ";
    $sql .= "username = '" . $_POST['profile_user_name'] . "', ";
    $sql .= "password = '" . $_POST['profile_password'] . "', ";
    $sql .= "avatar_url = '" . $_POST['profile_avatar_url'] . "' ";
    $sql .= "WHERE id = '1';";
    $sqlite3->exec($sql);

    session_regenerate_id();
    $_SESSION['loggedin'] = true;
    $_SESSION['profile_name'] = $_POST['profile_first_name'];
    $_SESSION['username'] = $_POST['profile_user_name'];
    $_SESSION['avatar_url'] = $_POST['profile_avatar_url'];


    header("location: profile_edit.php");
}

if (isset($_POST['save_panel'])) {
    $sql = "UPDATE panel SET ";
    $sql .= "title = '" . $_POST['panel_title'] . "', ";
    $sql .= "logo_light = '" . $_POST['panel_light_logo'] . "', ";
    $sql .= "logo_dark = '" . $_POST['panel_dark_logo'] . "', ";
    $sql .= "logo_light_sm = '" . $_POST['panel_light_logo_small'] . "', ";
    $sql .= "logo_dark_sm = '" . $_POST['panel_dark_logo_small'] . "', ";
    $sql .= "login_gif = '" . $_POST['panel_login_gif'] . "';";
    $sqlite3->exec($sql);

    header("location: profile_edit.php");
}
?>
<!doctype html>
<html lang="en">

<head>

    <?php include('assets/includes/title-meta.php') ?>

    <?php include('assets/includes/head-css.php') ?>

</head>

<body data-sidebar="dark">

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner">
                <i class="ri-loader-line spin-icon"></i>
            </div>
        </div>
    </div>

    <div id="layout-wrapper">

        <?php include('assets/includes/topbar.php') ?>

        <?php include('assets/includes/sidebar.php') ?>

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0">CP Smart4 Panel</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="dashboard.php">CP Smart4 Dashboard</a></li>
                                        <li class="breadcrumb-item active">Profile Edit</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card h-100">
                                <div class="card-body">

                                    <h4 class="card-title">Profile Edit</h4>
                                    <p class="card-title-desc">Update your profile information.</p>

                                    <form method="POST">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="profile_first_name">Profile
                                                Name</label>
                                            <div class="col-md-9">
                                                <input <?php echo $USER_PROFILE_PANEL_EDITS ? '' : 'disabled'; ?> type="text" id="profile_first_name" name="profile_first_name" class="form-control" placeholder="Enter first name" value="<?php echo $profile_data['profile_name']; ?>">
                                                <span class="text-muted">profile name displayed on menu</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="profile_user_name">Username</label>
                                            <div class="col-md-9">
                                                <input <?php echo $USER_PROFILE_PANEL_EDITS ? '' : 'disabled'; ?> type="text" id="profile_user_name" name="profile_user_name" class="form-control" placeholder="Enter username" value="<?php echo $profile_data['username']; ?>">
                                                <span class="text-muted">username to login to panel</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="profile_password">Password</label>
                                            <div class="col-md-9">
                                                <input <?php echo $USER_PROFILE_PANEL_EDITS ? '' : 'disabled'; ?> type="password" id="profile_password" name="profile_password" class="form-control" placeholder="Enter password" value="<?php echo $profile_data['password']; ?>">
                                                <span class="text-muted">password to login to panel</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="profile_avatar_url">Avatar
                                                Image</label>
                                            <div class="col-md-9">
                                                <input <?php echo $USER_PROFILE_PANEL_EDITS ? '' : 'disabled'; ?> type="url" id="profile_avatar_url" name="profile_avatar_url" class="form-control" placeholder="Enter avatar url" value="<?php echo $profile_data['avatar_url']; ?>">
                                                <span class="text-muted">.jpg 128x128</span>
                                            </div>
                                        </div>
                                        <div class="text-center mt-4">
                                            Remember to keep your username and password safe,<br>
                                            The default username and password is <u>admin</u> & <u>admin</u>
                                            if you need help contact your reseller.
                                        </div>
                                        <div class="text-center mt-4">
                                            <button class="btn btn-primary waves-effect waves-light" type="submit" name="save_profile">Save Profile</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> <!-- end col -->

                        <div class="col-xl-6">
                            <div class="card h-100">
                                <div class="card-body">

                                    <h4 class="card-title">Panel Edit</h4>
                                    <p class="card-title-desc">Update your panel information.</p>

                                    <form method="POST">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="panel_title">Panel Title</label>
                                            <div class="col-md-9">
                                                <input <?php echo $USER_PROFILE_PANEL_EDITS ? '' : 'disabled'; ?> type="text" id="panel_title" name="panel_title" class="form-control" placeholder="Enter panel title" value="<?php echo $panel_data['title']; ?>">
                                                <span class="text-muted">Title of Panel</span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="panel_light_logo">Panel Logo
                                                Light</label>
                                            <div class="col-md-9">
                                                <input <?php echo $USER_PROFILE_PANEL_EDITS ? '' : 'disabled'; ?> type="url" id="panel_light_logo" name="panel_light_logo" class="form-control" placeholder="Enter panel logo light url" value="<?php echo $panel_data['logo_light']; ?>">
                                                <span class="text-muted">.png 221x45</span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="panel_dark_logo">Panel Logo
                                                Dark</label>
                                            <div class="col-md-9">
                                                <input <?php echo $USER_PROFILE_PANEL_EDITS ? '' : 'disabled'; ?> type="url" id="panel_dark_logo" name="panel_dark_logo" class="form-control" placeholder="Enter panel logo dark url" value="<?php echo $panel_data['logo_dark']; ?>">
                                                <span class=" text-muted">.png 221x45</span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="panel_light_logo_small">Panel
                                                Logo Light (Small)</label>
                                            <div class="col-md-9">
                                                <input <?php echo $USER_PROFILE_PANEL_EDITS ? '' : 'disabled'; ?> type="url" id="panel_light_logo_small" name="panel_light_logo_small" class="form-control" placeholder="Enter panel logo light small url" value="<?php echo $panel_data['logo_light_sm']; ?>">
                                                <span class=" text-muted">.png 36x40</span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="panel_dark_logo_small">Panel
                                                Logo Dark (Small)</label>
                                            <div class="col-md-9">
                                                <input <?php echo $USER_PROFILE_PANEL_EDITS ? '' : 'disabled'; ?> type="url" id="panel_dark_logo_small" name="panel_dark_logo_small" class="form-control" placeholder="Enter panel logo dark small url" value="<?php echo $panel_data['logo_dark_sm']; ?>">
                                                <span class=" text-muted">.png 36x40</span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="panel_login_gif">Panel Login
                                                GIF</label>
                                            <div class="col-md-9">
                                                <input <?php echo $USER_PROFILE_PANEL_EDITS ? '' : 'disabled'; ?> type="url" id="panel_login_gif" name="panel_login_gif" class="form-control" placeholder="Enter panel login gif url" value="<?php echo $panel_data['login_gif']; ?>">
                                                <span class=" text-muted">.gif 2000x1333</span>
                                            </div>
                                        </div>

                                        <div class="text-center mt-4">
                                            <button class="btn btn-primary waves-effect waves-light" type="submit" name="save_panel">Save Panel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include('assets/includes/footer.php'); ?>

        </div>

    </div>

    <?php include('assets/includes/right-sidebar.php'); ?>

    <?php include('assets/includes/vendor-scripts.php'); ?>

    <script src="./assets/js/app.js"></script>

</body>

</html>