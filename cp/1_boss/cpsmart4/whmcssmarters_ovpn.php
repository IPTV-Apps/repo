<?php
session_start();

include('assets/includes/db.php');
include('assets/includes/config.php');

if ($_ERRORS == true) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) {
    header("location: logout.php");
}

if (isset($_POST['delete-record'])) {
    $sql = "DELETE FROM `ovpn_whmcssmarters` ";
    $sql .= "WHERE id = " . $_POST['delete-id'] . ";";
    $sqlite3->exec($sql);

    unlink('assets/data/ovpn/' . $_POST['delete-file-name']);

    header("Location: whmcssmarters_ovpn.php");
}

if (isset($_POST['vpn_cred_submit'])) {
    $sql = "UPDATE `vpn_cred_whmcssmarters` SET ";
    $sql .= "ovpn_user = '" . $_POST['ovpn_user'] . "', ";
    $sql .= "ovpn_pass = '" . $_POST['ovpn_pass'] . "' ";
    $sql .= "WHERE id = 1;";
    $sqlite3->exec($sql);

    header("Location: whmcssmarters_ovpn.php");
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
    <!-- <div id="preloader">
        <div id="status">
            <div class="spinner">
                <i class="ri-loader-line spin-icon"></i>
            </div>
        </div>
    </div> -->

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
                                        <li class="breadcrumb-item active">OpenVPN Archive</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">OpenVPN Credentials</h4>
                                    <p class="card-title-desc">Insert your OpenVPN login for users to use.</p>

                                    <br />

                                    <form method="POST">
                                        <div class="row">
                                            <div class="form-group col-6 float-left">
                                                <label for="ovpn_user">Username</label>
                                                <input class="form-control" id="ovpn_user" name="ovpn_user" type="text" <?php if (!empty($vpn_cred_whmcssmarters_data['ovpn_user'])) echo 'value="' . $vpn_cred_whmcssmarters_data['ovpn_user'] . '"'; ?> />
                                            </div>
                                            <div class="form-group col-6 float-right">
                                                <label for="ovpn_pass">Password</label>
                                                <input class="form-control" id="ovpn_pass" name="ovpn_pass" type="text" <?php if (!empty($vpn_cred_whmcssmarters_data['ovpn_pass'])) echo 'value="' . $vpn_cred_whmcssmarters_data['ovpn_pass'] . '"'; ?> />

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary" name="vpn_cred_submit" type="submit">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">OpenVPN Archive Creator</h4>
                                    <p class="card-title-desc">Upload and create your ovpn.zip from the panel.</p>

                                    <br />

                                    <div class="col-lg-6 mx-auto">

                                        <form action="./assets/includes/file_upload.php" method="POST" enctype="multipart/form-data">
                                            <h5>Upload New .ovpn File:</h5> <br />
                                            <input type="file" name="file" id="file" accept=".ovpn"> <br />
                                            <center><input type="submit" name="submit" value="Upload File" class="delete-button btn-sm btn-primary waves-effect waves-light"></center>
                                        </form>

                                    </div>

                                    <hr>

                                    <div class="col-lg-6 mx-auto">
                                        <div class="table-responsive">
                                            <table id="datatable" class="table table-striped table-bordered  nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th hidden>ID</th>
                                                        <th>File Name</th>
                                                        <th>File Size (Kb)</th>
                                                        <th hidden>File Type</th>
                                                        <th>Added</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <?php while ($row = $ovpn_whmcssmarters_data->fetchArray()) { ?>
                                                    <tr>
                                                        <td hidden><?php echo $row['id']; ?></td>
                                                        <td><?php echo $row['file_name']; ?></td>
                                                        <td><?php echo $row['file_size']; ?></td>
                                                        <td hidden><?php echo $row['file_type']; ?></td>
                                                        <td><?php echo $row['create_time']; ?></td>
                                                        <td>
                                                            <button onclick="window.location.href='/assets/data/ovpn/<?php echo $row['file_name']; ?>'" class="btn-sm btn-primary waves-effect waves-light"><i class="ri-download-2-line"></i></button>
                                                            <button type="button" data-toggle="modal" data-target="#delete-modal" class="delete-button btn-sm btn-danger waves-effect waves-light"><i class="ri-delete-bin-2-line"></i></button>
                                                        </td>
                                                    </tr>
                                                <?php
                                                } ?>
                                            </table>
                                        </div>
                                        <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header border-bottom-0">
                                                        <h5 class="modal-title" id="deleteModalLabel">Delete Record</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span class="text-danger" aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST">
                                                        <div class="modal-body">
                                                            <div class="form-group" hidden>
                                                                <input type="text" class="form-control" id="delete-id" name="delete-id">
                                                            </div>
                                                            <div class="form-group" hidden>
                                                                <input type="text" class="form-control" id="delete-file-name" name="delete-file-name">
                                                            </div>
                                                            <h3 class="text-center mt-4">Are you sure?</h3>
                                                        </div>
                                                        <div class="modal-footer text-center mt-4">
                                                            <button type="submit" name="delete-record" class="btn-sm btn-danger">Delete</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <script>
                                            $(function() {
                                                $(".delete-button").on('click', function() {
                                                    var currentRow = $(this).closest("tr");
                                                    var id = currentRow.find("td:eq(0)").text();
                                                    var fileName = currentRow.find("td:eq(1)").text();
                                                    $("#delete-id").val(id);
                                                    $("#delete-file-name").val(fileName);
                                                });
                                            });
                                        </script>

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

    <?php include('assets/includes/right-sidebar.php'); ?>

    <?php include('assets/includes/vendor-scripts.php'); ?>

    <script src="./assets/js/app.js"></script>

</body>

</html>