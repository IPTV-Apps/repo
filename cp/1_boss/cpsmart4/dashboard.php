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
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">CP Smart4 Dashboard</a></li>
                                        <li class="breadcrumb-item active">News</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>

                    <?php

                    if ($_VERSION !== $VERSION_JSON['version']) {
                        echo '' . $_UPDATE_MESSAGE;
                    }
                    ?>

                    <div class="row">
                        <div class="col-10 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media mb-4">
                                        <img class="d-flex mr-3 rounded-circle avatar-sm" src="<?php echo $ARTICLE_1_JSON['author_avatar']; ?>" alt="Avatar image">
                                        <div class="media-body">
                                            <h5 class="font-size-14 my-1"><?php echo $ARTICLE_1_JSON['author_name'] . ' (' . $ARTICLE_1_JSON['author_role'] . ')'; ?></h5>
                                            <small class="text-muted"><a href="<?php echo $ARTICLE_1_JSON['author_telegram_url']; ?>" target="_blank"><?php echo $ARTICLE_1_JSON['author_telegram']; ?></a></small>
                                        </div>
                                    </div>

                                    <h4 class="mt-0 font-size-16"><?php echo $ARTICLE_1_JSON['article_title']; ?> <span class="badge badge-<?php echo $ARTICLE_1_JSON['article_badge']; ?>"><?php echo $ARTICLE_1_JSON['article_type']; ?></span></h4>

                                    <?php echo $ARTICLE_1_JSON['article_header'] . $profile_data['profile_name'] . ', </p>'; ?>
                                    <?php echo $ARTICLE_1_JSON['article_body']; ?>
                                    <?php echo $ARTICLE_1_JSON['article_footer']; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-10 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media mb-4">
                                        <img class="d-flex mr-3 rounded-circle avatar-sm" src="<?php echo $ARTICLE_2_JSON['author_avatar']; ?>" alt="Avatar image">
                                        <div class="media-body">
                                            <h5 class="font-size-14 my-1"><?php echo $ARTICLE_2_JSON['author_name'] . ' (' . $ARTICLE_2_JSON['author_role'] . ')'; ?></h5>
                                            <small class="text-muted"><a href="<?php echo $ARTICLE_2_JSON['author_telegram_url']; ?>" target="_blank"><?php echo $ARTICLE_2_JSON['author_telegram']; ?></a></small>
                                        </div>
                                    </div>

                                    <h4 class="mt-0 font-size-16"><?php echo $ARTICLE_2_JSON['article_title']; ?> <span class="badge badge-<?php echo $ARTICLE_2_JSON['article_badge']; ?>"><?php echo $ARTICLE_2_JSON['article_type']; ?></span></h4>

                                    <?php echo $ARTICLE_2_JSON['article_header'] . $profile_data['profile_name'] . ', </p>'; ?>
                                    <?php echo $ARTICLE_2_JSON['article_body']; ?>
                                    <?php echo $ARTICLE_2_JSON['article_footer']; ?>
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