<?php

session_start();

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) {
    header("location: logout.php");
}

include('assets/includes/db.php');

if (isset($_POST['add_banners'])) {
    $sql = "INSERT INTO banners_whmcssmarters (";
    $sql .= "title, ";
    $sql .= "type, ";
    $sql .= "path) ";
    $sql .= "VALUES (";
    $sql .= "'" . $_POST['add-title'] . "', ";
    $sql .= "'" . $_POST['add-type'] . "', ";
    $sql .= "'" . $_POST['add-path'] . "');'";
    $sqlite3->exec($sql);

    header("Location: whmcssmarters_banners.php");
}

if (isset($_POST['edit_banners'])) {
    $sql = "UPDATE banners_whmcssmarters SET ";
    $sql .= "title = '" . $_POST['edit-title'] . "', ";
    $sql .= "type = '" . $_POST['edit-type'] . "', ";
    $sql .= "path = '" . $_POST['edit-path'] . "' ";
    $sql .= "WHERE id = '" . $_POST['edit-id'] . "';";
    $sqlite3->exec($sql);

    header("Location: whmcssmarters_banners.php");
}

if (isset($_POST['delete_banners'])) {
    $sql = "DELETE FROM banners_whmcssmarters ";
    $sql .= "WHERE id = " . $_POST['delete-id'] . ";";
    $sqlite3->exec($sql);

    header("Location: whmcssmarters_banners.php");
}

$app_banners_array = array();

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
                                <h4 class="mb-0">WHMCS Smarters</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Applications</a></li>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">WHMCS Smarters</a></li>
                                        <li class="breadcrumb-item active">Rotating Banners List</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-12">
                            <script src="https://cdn.jsdelivr.net/npm/ad-rotator"></script>
                            <center>
                                <div id="iptvapps-banners"></div>
                            </center>
                        </div>

                    </div>

                    <br />

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Banners List</h4>
                                    <p class="card-title-desc">
                                        <a data-toggle="modal" data-target="#add-modal" class="add-button btn-sm btn-secondary float-right"><i class="dripicons-document-new"></i> Add New Banner</a>
                                    </p>

                                    <br />

                                    <div class="table-responsive">
                                        <table id="datatable" class="table table-striped table-bordered nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Title</th>
                                                    <th>Type</th>
                                                    <th>Path</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <?php while ($row = $banners_whmcssmarters_data->fetchArray()) {
                                                array_push($app_banners_array, ["url" => "#", "img" => $row['path']]);
                                            ?>
                                                <tr>
                                                    <td><?php echo $row['id']; ?></td>
                                                    <td><?php echo $row['title']; ?></td>
                                                    <td><?php echo $row['type']; ?></td>
                                                    <td><?php echo $row['path']; ?></td>

                                                    <td>
                                                        <button type="button" data-toggle="modal" data-target="#edit-modal" class="edit-button btn-sm btn-primary waves-effect waves-light"><i class="dripicons-document-edit"></i></button>
                                                        <button type="button" data-toggle="modal" data-target="#delete-modal" class="delete-button btn-sm btn-danger waves-effect waves-light"><i class="dripicons-trash"></i></button>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </table>
                                    </div>

                                    <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header border-bottom-0">
                                                    <h5 class="modal-title" id="addModalLabel">Add Banner</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span class="text-danger" aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="add-title">Title</label>
                                                            <input type="text" class="form-control" id="add-title" name="add-title" placeholder="Enter title">
                                                            <small id="add-title-small" class="form-text text-muted"><em>Title for
                                                                    ad.</em></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="add-type">Type</label>
                                                            <select class="form-control" id="add-type" name="add-type">
                                                                <option value="vod">VOD</option>
                                                                <option value="series">Series</option>
                                                            </select>
                                                            <small id="add-type-small" class="form-text text-muted"><em>Type of ad.</em></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="add-path">URL for Image</label>
                                                            <input type="text" class="form-control" id="add-path" name="add-path" placeholder="Enter path">
                                                            <small id="add-path-small" class="form-text text-muted"><em>(1047x212px .png)</em></small>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer text-center mt-4">
                                                        <button type="submit" name="add_banners" class="btn-sm btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header border-bottom-0">
                                                    <h5 class="modal-title" id="editModalLabel">Edit Banner</h5>
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
                                                            <label for="edit-title">Title</label>
                                                            <input type="text" class="form-control" id="edit-title" name="edit-title" placeholder="Enter title">
                                                            <small id="edit-title-small" class="form-text text-muted"><em>Title for
                                                                    ad.</em></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="edit-type">Type</label>
                                                            <select class="form-control" id="edit-type" name="edit-type">
                                                                <option value="vod">VOD</option>
                                                                <option value="series">Series</option>
                                                            </select>
                                                            <small id="edit-type-small" class="form-text text-muted"><em>Type of ad.</em></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="edit-path">URL for Image</label>
                                                            <input type="text" class="form-control" id="edit-path" name="edit-path" placeholder="Enter path">
                                                            <small id="edit-path-small" class="form-text text-muted"><em>(1047x212px .png)</em></small>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer text-center mt-4">
                                                        <button type="submit" name="edit_banners" class="btn-sm btn-primary">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header border-bottom-0">
                                                    <h5 class="modal-title" id="deleteModalLabel">Delete Banner</h5>
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
                                                        <button type="submit" name="delete_banners" class="btn-sm btn-danger">Delete</button>
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
                                                var title = currentRow.find("td:eq(1)").text();
                                                var type = currentRow.find("td:eq(2)").text();
                                                var path = currentRow.find("td:eq(3)").text();

                                                $("#edit-id").val(id);
                                                $("#edit-title").val(title);
                                                $("#edit-type").val(type);
                                                $("#edit-path").val(path);
                                            });
                                            $(".delete-button").on('click', function() {
                                                var currentRow = $(this).closest("tr");
                                                var id = currentRow.find("td:eq(0)").text();
                                                $("#delete-id").val(id);
                                            });
                                        });

                                        const instance = rotator(
                                            document.getElementById("iptvapps-banners"),
                                            <?php echo json_encode($app_banners_array); ?>
                                        );
                                        instance.start();
                                    </script>


                                    <style>
                                        #iptvapps-banners {
                                            height: 212px;
                                            width: 1047px;
                                        }

                                        #iptvapps-banners img {
                                            height: 100%;
                                            width: 100%;
                                        }
                                    </style>

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