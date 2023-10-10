<?php
session_start();

date_default_timezone_set('UTC');

include('assets/includes/db.php');
include('assets/includes/config.php');

if ($_ERRORS == true) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) {
    header("location: logout.php");
}

if (isset($_POST['update_submit'])) {
    $sql = "UPDATE update_whmcssmarters SET ";
    $sql .= "version_code = '" . $_POST['version_code'] . "', ";
    $sql .= "package_name = '" . $_POST['package_name'] . "', ";
    $sql .= "apk_url = '" . $_POST['apk_url'] . "';";
    $sqlite3->exec($sql);

    header('Location: whmcssmarters_extras.php');
}
if (isset($_POST['rateus_submit'])) {
    $sql = "UPDATE rate_whmcssmarters SET ";
    $sql .= "rateus_url = '" . $_POST['rateus_url'] . "';";
    $sqlite3->exec($sql);

    header('Location: whmcssmarters_extra.php');
}
if (isset($_POST['note_submit'])) {
    $sql = "UPDATE note_whmcssmarters SET ";
    $sql .= "Title = '" . $_POST['Title'] . "', ";
    $sql .= "Description = '" . $_POST['Description'] . "', ";
    $sql .= "CreateDate = '" . $_POST['CreateDate'] . "';";
    $sqlite3->exec($sql);

    header('Location: whmcssmarters_extras.php');
}
if (isset($_POST['maint_submit'])) {
    $sql = "UPDATE maintenance_whmcssmarters SET ";
    $sql .= "title = '" . $_POST['maint_title'] . "', ";
    $sql .= "body = '" . $_POST['maint_body'] . "', ";
    $sql .= "mode = '" . $_POST['maint_mode'] . "' WHERE id = 1;";
    $sqlite3->exec($sql);

    header('Location: whmcssmarters_extras.php');
}
if (isset($_POST["submit_intro"])) {
    move_uploaded_file($_FILES['intro']['tmp_name'], "./api/whmcssmarters/intro.mp4");

    header('Location: whmcssmarters_extras.php');
}

if (isset($_POST["submit_logo"])) {
    move_uploaded_file($_FILES['logo']['tmp_name'], "./api/whmcssmarters/logo.png");

    header('Location: whmcssmarters_extras.php');
}

if (isset($_POST["submit_bg"])) {
    move_uploaded_file($_FILES['bg']['tmp_name'], "./api/whmcssmarters/bg.png");

    header('Location: whmcssmarters_extras.php');
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
                                <h4 class="mb-0"> </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">WHMCS Smarters</a></li>
                                        <li class="breadcrumb-item active">Extra Options</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-6">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Maintenance Mode</h4>
                                    <p class="card-title-desc">Enable/Disable Applications remotely.</p>

                                    <br />

                                    <div class="col-12 d-flex mx-auto">

                                        <div class="card-body">
                                            <form method="POST">
                                                <div class="form-group col-9 float-left">
                                                    <label for="maint_title">Body</label>
                                                    <input class="form-control" id="maint_title" name="maint_title" value="<?php echo $maintenance_whmcssmarters_data['title'] ?>" type="text" />
                                                </div>
                                                
                                                <div class="form-group col-3 float-left">
                                                    <label for="maint_mode">Status</label>
                                                    <select class="form-control" id="maint_mode" name="maint_mode">
                                                        <option value="on" <?php if ($maintenance_whmcssmarters_data['mode'] == 'on') echo 'selected'; ?>>Enabled</option>
                                                        <option value="off" <?php if ($maintenance_whmcssmarters_data['mode'] == 'off') echo 'selected'; ?>>Disabled</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="maint_body">Footer</label>
                                                    <input class="form-control" id="maint_body" name="maint_body" value="<?php echo $maintenance_whmcssmarters_data['body'] ?>" type="text" />
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-primary" name="maint_submit" type="maint_submit">Save</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="col-6">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">'Rate us' URL</h4>
                                    <p class="card-title-desc">Redirect your users to your <a href="https://iptvapps.net/services/">IPTVApps service</a> thread to leave ratings and feedback.</p>

                                    <br />

                                    <div class="col-12 d-flex mx-auto">

                                        <div class="card-body">
                                            <form method="POST">
                                                <div class="form-group">
                                                    <label for="rateus_url">URL</label>
                                                    <input class="form-control" id="rateus_url" name="rateus_url" value="<?php echo $rateus_whmcssmarters_data['rateus_url'] ?>" type="text" />
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-primary" name="rateus_submit" type="rateus_submit">Save</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Remote Application Update</h4>
                                    <p class="card-title-desc">Update your application remotely from a direct URL.</p>

                                    <br />

                                    <div class="col-4 d-flex mx-auto">

                                        <div class="card-body">
                                            <form method="POST">
                                                <div class="form-group">
                                                    <label for="version_code">Application Version Number</label>
                                                    <input class="form-control" id="description" name="version_code" value="<?php echo $update_whmcssmarters_data['version_code'] ?>" type="text" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="package_name">Application Package Name</label>
                                                    <input class="form-control" id="description" name="package_name" value="<?php echo $update_whmcssmarters_data['package_name'] ?>" type="text" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="apk_url">Application URL (direct)</label>
                                                    <input class="form-control" id="description" name="apk_url" value="<?php echo $update_whmcssmarters_data['apk_url'] ?>" type="text" />
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-primary" name="update_submit" type="submit">Save</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Base64 Conversion</h4>
                                    <p class="card-title-desc">Convert Appname and Package name to Base64</p>

                                    <br />

                                    <!-- <div class="col-4 d-flex mx-auto"> -->

                                    <div class="card-body">
                                        <form method="POST">
                                            <div class="col-6 float-left">
                                                <div class="form-group">
                                                    <label for="b64_appname">Old App Name</label>
                                                    <input class="form-control" id="b64_appname" name="b64_appname" type="text" />
                                                    <?php
                                                    $_app_name = rtrim((string)@$_POST['b64_appname']);
                                                    if (isset($_POST['b64_encode']) && strlen($_app_name)) {
                                                        echo 'Search for: ' . base64_encode($_app_name);
                                                    }
                                                    ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="b64_appnamenew">New App Name</label>
                                                    <input class="form-control" id="b64_appnamenew" name="b64_appnamenew" type="text" />
                                                    <?php
                                                    $_app_name = rtrim((string)@$_POST['b64_appnamenew']);
                                                    if (isset($_POST['b64_encode']) && strlen($_app_name)) {
                                                        echo 'Replace with: ' . base64_encode($_app_name);
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-6 float-right">
                                                <div class="form-group">
                                                    <label for="b64_pkgname">Old Package Name</label>
                                                    <input class="form-control" id="b64_pkgname" name="b64_pkgname" type="text" />
                                                    <?php
                                                    $_pkg_name = rtrim((string)@$_POST['b64_pkgname']);
                                                    if (isset($_POST['b64_encode']) && strlen($_pkg_name)) {
                                                        echo 'Search for: ' . base64_encode($_pkg_name);
                                                    }
                                                    ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="b64_pkgnamenew">New Package Name</label>
                                                    <input class="form-control" id="b64_pkgnamenew" name="b64_pkgnamenew" type="text" />
                                                    <?php
                                                    $_pkg_name = rtrim((string)@$_POST['b64_pkgnamenew']);
                                                    if (isset($_POST['b64_encode']) && strlen($_pkg_name)) {
                                                        echo 'Replace with: ' . base64_encode($_pkg_name);
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-primary" name="b64_encode" type="">Encode</button>
                                            </div>
                                        </form>
                                        <!-- </div> -->

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Logo</h4>

                                    <form method="POST" enctype="multipart/form-data">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input class="form-control" name="logo" id="logo" type="file" accept="image/*">
                                                <button class="btn btn-warning" type="submit" name="submit_logo"><i class="ri-upload-line"></i></button>
                                            </div>
                                        </div>
                                    </form>

                                    </br>
                                    <h4 class="card-title">Background</h4>

                                    <form method="POST" enctype="multipart/form-data">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input class="form-control" name="bg" id="bg" type="file" accept="image/*">
                                                <button class="btn btn-warning" type="submit" name="submit_bg"><i class="ri-upload-line"></i></button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Intro Video</h4>
                                    <p class="card-title-desc">The selected video will affect all connected applicatons.</br>Not all Apps support Intro video (from remote).</p>

                                    <form method="POST" enctype="multipart/form-data">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input class="form-control" name="intro" id="intro" type="file" accept="video/*">
                                                <button class="btn btn-warning" type="submit" name="submit_intro"><i class="ri-upload-line"></i></button>
                                            </div>
                                        </div>
                                    </form>

                                    </br>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <video class="card-img-bottom" width="200px" controls>
                                                <source src="./api/whmcssmarters/intro.mp4" type="video/mp4">
                                            </video>
                                        </div>
                                    </div>

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