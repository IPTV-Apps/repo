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

if (isset($_POST['post_tvsg'])) {
    $sql = "UPDATE tvsg_settings SET ";
    $sql .= "widget_id = '" . $_POST['widget_id'] . "', ";
    $sql .= "border_color = '" . $_POST['border_color'] . "', ";
    $sql .= "background_color = '" . $_POST['background_color'] . "', ";
    $sql .= "text_color = '" . $_POST['text_color'] . "',";
    $sql .= "heading = '" . $_POST['heading'] . "', ";
    $sql .= "auto_scroll = '" . (isset($_POST['auto_scroll']) ? '1' : '0') . "';";
    $sqlite3->exec($sql);

    header("Location: webviews_tvsportsguide.php");
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
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">WebViews</a></li>
                                        <li class="breadcrumb-item active">TV Sports Guide</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <div class="col-12 d-flex mx-auto">

                                        <div class="card-body">
                                            <div class="col-md-12">

                                                <div class="row">
                                                    <div class="col-12 col-md-6">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <h5 class="card-title">TV Sports Guide</h5>
                                                                <hr class="mt-0" />
                                                                <form method="POST" id="post_tvsg">
                                                                    <div class="form-row">
                                                                        <div class="form-group col-12 col-md-6">
                                                                            <div class="d-flex-between">
                                                                                <label class="mb-0">Auto-scroll</label>
                                                                                <div class="square-switch float-right">
                                                                                    <input type="checkbox" name="auto_scroll" id="auto_scroll" switch="bool" <?php echo $tvsg_settings['auto_scroll'] == '1' ? 'checked' : '' ?> />
                                                                                    <label for="auto_scroll" data-on-label="Yes" data-off-label="No"></label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <hr class="mt-0" />
                                                                        </div>
                                                                        <div class="form-group col-12 col-md-6">
                                                                            <label>Border Color</label>
                                                                            <input type="color" name="border_color" id="border_color" class="form-control" value="<?php echo $tvsg_settings['border_color']; ?>" />
                                                                        </div>
                                                                        <div class="form-group col-12 col-md-6">
                                                                            <label>Background Color</label>
                                                                            <input type="color" name="background_color" id="background_color" class="form-control" value="<?php echo $tvsg_settings['background_color']; ?>" />
                                                                        </div>
                                                                        <div class="form-group col-12 col-md-6">
                                                                            <label>Font Color</label>
                                                                            <input type="color" name="text_color" id="text_color" class="form-control" value="<?php echo $tvsg_settings['text_color']; ?>" />
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <hr class="mt-0" />
                                                                        </div>
                                                                        <div class="form-group col-12 col-md-6">
                                                                            <label class="mb-0">Widget ID <a href="/assets/images/tvspg.png"><small><i class="ri-question-line"></i></small></a></label>
                                                                            <input type="text" class="form-control float-right" id="widget_id" name="widget_id" placeholder="Widget ID" value="<?php echo $tvsg_settings['widget_id']; ?>">
                                                                        </div>
                                                                        <div class="form-group col-12 col-md-6">
                                                                            <div class="d-flex-between">
                                                                                <label class="mb-0">Heading</label>
                                                                                <input type="text" class="form-control float-right" id="heading" name="heading" placeholder="Heading" value="<?php echo $tvsg_settings['heading']; ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr class="mt-0" />
                                                                    <button class="btn btn-primary" name="post_tvsg" type="submit">Update</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <h5 class="card-title">Preview</h5>
                                                                <hr class="mt-0" />

                                                                <iframe id="iframe_preview" style="width: 100%; height: 382px;" src="https://www.tvsportguide.com/widget/<?php echo $tvsg_settings['widget_id']; ?>/?heading=<?php echo $tvsg_settings['heading']; ?>&border_color=custom&autoscroll=<?php echo $tvsg_settings['auto_scroll']; ?>&custom_colors=<?php echo substr($tvsg_settings['border_color'], 1); ?>,<?php echo substr($tvsg_settings['background_color'], 1); ?>,<?php echo substr($tvsg_settings['text_color'], 1); ?>">
                                                                </iframe>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <h5 class="card-title">Endpoint</h5>
                                                                <hr class="mt-0" />

                                                                <p>You can add to your custom WebView using this URL: <a href="<?php echo str_replace('\\','',(isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] !== 'off') ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/api/webview/tvsg.php'); ?>"><?php echo str_replace('\\','',(isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] !== 'off') ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/api/webview/tvsg.php'); ?></a>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
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