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

if (isset($_GET['delete_log'])) {
    $sql = "DELETE FROM snoop_logs ";
    $sql .= "WHERE id = " . $_GET['delete_log'] . ";";
    $sqlite3->exec($sql);

    header('location: snoop_logs.php');
}

if (isset($_GET['delete_all'])) {
    $sql = "DELETE FROM snoop_logs;";
    $sqlite3->exec($sql);

    header('location: snoop_logs.php');
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
                                        <li class="breadcrumb-item active">Snoop Logs</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Snoop Logs</h4>
                                    <p class="card-title-desc">Check connections to the Admin panel from unauthorised users.
                                        <a type="button" href="./snoop_logs.php?delete_all=1" class="btn-sm btn-danger waves-effect waves-light float-right"><i class="dripicons-document-delete"></i> Clear all logs</a>
                                    </p>

                                    <br />

                                    <div class="table-responsive">
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>IP Address</th>
                                                    <th>Date</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <?php while ($row = $snoop_logs->fetchArray()) { ?>
                                                <tr>
                                                    <td><?php echo $row['ip']; ?></td>
                                                    <td><?php echo $row['date']; ?></td>
                                                    <td>
                                                        <a type="button" href="./snoop_logs.php?delete_log=<?php echo $row['id']; ?>" class="btn-sm btn-danger waves-effect waves-light"><i class="dripicons-document-delete"></i></a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </table>
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

    <script src="assets/js/app.js"></script>

</body>

</html>