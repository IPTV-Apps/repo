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

if (isset($_POST['add_service'])) {
    $sql = "INSERT INTO xc_domains_whmcssmarters (";
    $sql .= "name, ";
    $sql .= "ssl, ";
    $sql .= "dns, ";
    $sql .= "port) ";
    $sql .= "VALUES (";
    $sql .= "'" . $_POST['add-name'] . "', ";
    $sql .= "'" . $_POST['add-ssl'] . "', ";
    $sql .= "'" . $_POST['add-domain'] . "',";
    $sql .= "'" . $_POST['add-port'] . "');";
    $sqlite3->exec($sql);

    header("Location: whmcssmarters_domains.php");
}

if (isset($_POST['edit_service'])) {
    $sql = "UPDATE xc_domains_whmcssmarters SET ";
    $sql .= "name = '" . $_POST['edit-name'] . "', ";
    $sql .= "ssl = '" . $_POST['edit-ssl'] . "', ";
    $sql .= "dns = '" . $_POST['edit-domain'] . "',";
    $sql .= "port = '" . $_POST['edit-port'] . "' ";
    $sql .= "WHERE id = " . $_POST['edit-id'] . ";";
    $sqlite3->exec($sql);

    header("Location: whmcssmarters_domains.php");
}

if (isset($_POST['delete_service'])) {
    $sql = "DELETE FROM xc_domains_whmcssmarters ";
    $sql .= "WHERE id = " . $_POST['delete-id'] . ";";
    $sqlite3->exec($sql);

    header("Location: whmcssmarters_domains.php");
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
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Applications</a></li>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">WHMCS Smarters</a></li>
                                        <li class="breadcrumb-item active">Domain List</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Active Domain List</h4>
                                    <p class="card-title-desc">
                                        <a data-toggle="modal" data-target="#add-modal" class="add-button btn-sm btn-secondary float-right"><i class="dripicons-document-new"></i> Add New Service</a>
                                    </p>

                                    <br />

                                    <table id="datatable-buttons" class="table dt-responsive table-striped table-bordered nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Service Name</th>
                                                <th>SSL</th>
                                                <th>Domain</th>
                                                <th>Port</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <?php while ($row = $service_whmcssmarters_data->fetchArray()) { ?>
                                            <tr>
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['ssl']; ?></td>
                                                <td><?php echo $row['dns']; ?></td>
                                                <td><?php echo $row['port']; ?></td>
                                                <td>
                                                    <button type="button" data-toggle="modal" data-target="#edit-modal" class="edit-button btn-sm btn-primary waves-effect waves-light"><i class="dripicons-document-edit"></i></button>
                                                    <button type="button" data-toggle="modal" data-target="#delete-modal" class="delete-button btn-sm btn-danger waves-effect waves-light"><i class="dripicons-document-delete"></i></button>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </table>

                                    <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header border-bottom-0">
                                                    <h5 class="modal-title" id="addModalLabel">Add Service</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span class="text-danger" aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="add-name">Service Name</label>
                                                            <input type="text" class="form-control" id="add-name" name="add-name" placeholder="Enter service name">
                                                            <small id="add-name-small" class="form-text text-muted"><em>Name for
                                                                    service.</em></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="add-domain">Domain</label>
                                                            <input type="text" class="form-control" id="add-domain" name="add-domain" placeholder="Enter service domain">
                                                            <small id="add-domain-small" class="form-text text-muted"><em>Domain for service. (no
                                                                    http/https)</em></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="add-port">Port</label>
                                                            <input type="text" class="form-control" id="add-port" name="add-port" placeholder="Enter service port">
                                                            <small id="add-port-small" class="form-text text-muted"><em>Port for
                                                                    service.</em></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="add-ssl">SSL</label>
                                                            <select class="custom-select" id="add-ssl" name="add-ssl">
                                                                <option selected="false">Choose an option</option>
                                                                <option value="false">false</option>
                                                                <option value="true">true</option>
                                                            </select>
                                                            <small id="add-ssl-small" class="form-text text-muted"><em>Is service using
                                                                    SSL.</em></small>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer text-center mt-4">
                                                        <button type="submit" name="add_service" class="btn-sm btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header border-bottom-0">
                                                    <h5 class="modal-title" id="editModalLabel">Edit Service</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span class="text-danger" aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST">
                                                    <div class="modal-body">
                                                        <div class="input-group row" hidden>
                                                            <input type="text" class="form-control" id="edit-id" name="edit-id">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="edit-name">Service Name</label>
                                                            <input type="text" class="form-control" id="edit-name" name="edit-name" placeholder="Enter service name">
                                                            <small id="edit-name-small" class="form-text text-muted"><em>Name for
                                                                    service.</em></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="edit-domain">Domain</label>
                                                            <input type="text" class="form-control" id="edit-domain" name="edit-domain" placeholder="Enter service domain">
                                                            <small id="edit-domain-small" class="form-text text-muted"><em>Domain for service. (no
                                                                    http/https)</em></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="edit-port">Port</label>
                                                            <input type="text" class="form-control" id="edit-port" name="edit-port" placeholder="Enter service port">
                                                            <small id="edit-port-small" class="form-text text-muted"><em>Port for
                                                                    service.</em></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="edit-ssl">Status</label>
                                                            <select class="custom-select" id="edit-ssl" name="edit-ssl">
                                                                <option selected="false">false</option>
                                                                <option value="true">true</option>
                                                            </select>
                                                            <small id="edit-ssl-small" class="form-text text-muted"><em>Is service using
                                                                    SSL.</em></small>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer text-center mt-4">
                                                        <button type="submit" name="edit_service" class="btn-sm btn-primary">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header border-bottom-0">
                                                    <h5 class="modal-title" id="deleteModalLabel">Delete Service</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span class="text-danger" aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST">
                                                    <div class="modal-body">
                                                        <div class="form-group" hidden>
                                                            <input type="text" class="form-control" id="delete-id" name="delete-id">
                                                        </div>
                                                        <h3 class="text-center mt-4">Are you sure?</h3>
                                                    </div>
                                                    <div class="modal-footer text-center mt-4">
                                                        <button type="submit" name="delete_service" class="btn-sm btn-danger">Delete</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        $(function() {
                                            $(".edit-button").on('click', function() {
                                                var currentRow = $(this).closest("tr");
                                                var id = currentRow.find("td:eq(0)").text();
                                                var name = currentRow.find("td:eq(1)").text();
                                                var ssl = currentRow.find("td:eq(2)").text();
                                                var dns = currentRow.find("td:eq(3)").text();
                                                var port = currentRow.find("td:eq(4)").text();
                                                $("#edit-id").val(id);
                                                $("#edit-name").val(name);
                                                $("#edit-ssl").val(ssl);
                                                $("#edit-domain").val(dns);
                                                $("#edit-port").val(port);
                                            });
                                            $(".delete-button").on('click', function() {
                                                var currentRow = $(this).closest("tr");
                                                var id = currentRow.find("td:eq(0)").text();
                                                $("#delete-id").val(id);
                                            });
                                        });
                                    </script>

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