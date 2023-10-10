<?php

session_start();

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) {
    header("location: logout.php");
}

include('assets/includes/db.php');

if (isset($_POST['add_ad'])) {
    $sql = "INSERT INTO ads_whmcssmarters (";
    $sql .= "title, ";
    $sql .= "type, ";
    $sql .= "link, ";
    $sql .= "description, ";
    $sql .= "orderby, ";
    $sql .= "position, ";
    $sql .= "extension, ";
    $sql .= "createdon, ";
    $sql .= "path, ";
    $sql .= "orignal, ";
    $sql .= "thumbpath) ";
    $sql .= "VALUES (";
    $sql .= "'" . $_POST['add-title'] . "', ";
    $sql .= "'" . $_POST['add-type'] . "', ";
    $sql .= "'" . $_POST['add-link'] . "', ";
    $sql .= "'" . $_POST['add-description'] . "', ";
    $sql .= "'" . $_POST['add-orderby'] . "', ";
    $sql .= "'" . $_POST['add-position'] . "', ";
    $sql .= "'" . $_POST['add-extension'] . "', ";
    $sql .= "'" . $_POST['add-createdon'] . "', ";
    $sql .= "'" . $_POST['add-path'] . "', ";
    $sql .= "'" . $_POST['add-path'] . "', ";
    $sql .= "'" . $_POST['add-path'] . "');'";
    $sqlite3->exec($sql);

    header("Location: whmcssmarters_adz.php");
}

if (isset($_POST['edit_ad'])) {
    $sql = "UPDATE ads_whmcssmarters SET ";
    $sql .= "title = '" . $_POST['edit-title'] . "', ";
    $sql .= "type = '" . $_POST['edit-type'] . "', ";
    $sql .= "link = '" . $_POST['edit-link'] . "', ";
    $sql .= "description = '" . $_POST['edit-description'] . "', ";
    $sql .= "orderby = '" . $_POST['edit-orderby'] . "', ";
    $sql .= "position = '" . $_POST['edit-position'] . "', ";
    $sql .= "extension = '" . $_POST['edit-extension'] . "', ";
    $sql .= "createdon = '" . $_POST['edit-createdon'] . "', ";
    $sql .= "path = '" . $_POST['edit-path'] . "', ";
    $sql .= "orignal = '" . $_POST['edit-path'] . "', ";
    $sql .= "thumbpath = '" . $_POST['edit-path'] . "' ";
    $sql .= "WHERE id = '" . $_POST['edit-id'] . "';";
    $sqlite3->exec($sql);

    header("Location: whmcssmarters_adz.php");
}

if (isset($_POST['delete_ad'])) {
    $sql = "DELETE FROM ads_whmcssmarters ";
    $sql .= "WHERE id = " . $_POST['delete-id'] . ";";
    $sqlite3->exec($sql);

    header("Location: whmcssmarters_adz.php");
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
                                <h4 class="mb-0">WHMCS Smarters</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Applications</a></li>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">WHMCS Smarters</a></li>
                                        <li class="breadcrumb-item active">Rotating Ads List</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Ads List</h4>
                                    <p class="card-title-desc">
                                        <a data-toggle="modal" data-target="#add-modal" class="add-button btn-sm btn-secondary float-right"><i class="dripicons-document-new"></i> Add New Ad</a>
                                    </p>

                                    <br />

                                    <div class="table-responsive">
                                        <table id="datatable" class="table table-striped table-bordered nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Title</th>
                                                    <th>Type</th>
                                                    <th hidden>Link</th>
                                                    <th>Message</th>
                                                    <th hidden>Orderby</th>
                                                    <th hidden>Position</th>
                                                    <th hidden>Extension</th>
                                                    <th>Created on</th>
                                                    <th>Path</th>
                                                    <th hidden>Original</th>
                                                    <th hidden>Thumbpath</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <?php while ($row = $ads_whmcssmarters_data->fetchArray()) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $row['id']; ?></td>
                                                    <td><?php echo $row['title']; ?></td>
                                                    <td><?php echo $row['type']; ?></td>
                                                    <td hidden><?php echo $row['link']; ?></td>
                                                    <td><?php echo $row['description']; ?></td>
                                                    <td hidden><?php echo $row['orderby']; ?></td>
                                                    <td hidden><?php echo $row['position']; ?></td>
                                                    <td hidden><?php echo $row['extension']; ?></td>
                                                    <td><?php echo $row['createdon']; ?></td>
                                                    <td><?php echo $row['path']; ?></td>
                                                    <td hidden><?php echo $row['original']; ?></td>
                                                    <td hidden><?php echo $row['thumbpath']; ?></td>

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
                                                    <h5 class="modal-title" id="addModalLabel">Add Ad</h5>
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
                                                                <option value="image">Image</option>
                                                                <option value="message">Message</option>
                                                            </select>
                                                            <small id="add-type-small" class="form-text text-muted"><em>Type of ad.</em></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <!-- <label for="add-link">Link</label> -->
                                                            <input hidden type="text" class="form-control" id="add-link" name="add-link" value="https://iptvapps.net/">
                                                            <!-- <small id="add-link-small" class="form-text text-muted"><em>Link for ad.</em></small> -->
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="add-description">Message</label>
                                                            <input type="text" class="form-control" id="add-description" name="add-description" placeholder="Enter message">
                                                            <small id="add-description-small" class="form-text text-muted"><em>Message for ad.</em></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <!-- <label for="add-orderby">Order by</label> -->
                                                            <input hidden type="text" class="form-control" id="add-orderby" name="add-orderby" value="0">
                                                            <!-- <small id="add-orderby-small" class="form-text text-muted"><em>Order by for ad.</em></small> -->
                                                        </div>
                                                        <div class="form-group">
                                                            <!-- <label for="add-position">Position</label> -->
                                                            <input hidden type="position" class="form-control" id="add-position" name="add-position" value="vertical">
                                                            <!-- <small id="add-position-small" class="form-text text-muted"><em>Position of ad.</em></small> -->
                                                        </div>
                                                        <div class="form-group">
                                                            <!-- <label for="add-extension">Extension</label> -->
                                                            <input hidden type="text" class="form-control" id="add-extension" name="add-extension" value="png">
                                                            <!-- <small id="add-extension-small" class="form-text text-muted"><em>Extension for ad.</em></small> -->
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="add-createdon">Creation date</label>
                                                            <input type="text" class="form-control" id="add-createdon" name="add-createdon" value="<?php echo date("Y-m-d H:i:s"); ?>">
                                                            <small id="add-createdon-small" class="form-text text-muted"><em>Created on date/time.</em></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="add-path">URL for Image</label>
                                                            <input type="text" class="form-control" id="add-path" name="add-path" placeholder="Enter path">
                                                            <small id="add-path-small" class="form-text text-muted"><em>for type 'image'</em></small>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer text-center mt-4">
                                                        <button type="submit" name="add_ad" class="btn-sm btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header border-bottom-0">
                                                    <h5 class="modal-title" id="editModalLabel">Edit Ad</h5>
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
                                                                <option value="image">Image</option>
                                                                <option value="message">Message</option>
                                                            </select>
                                                            <small id="edit-type-small" class="form-text text-muted"><em>Type of ad.</em></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <!-- <label for="edit-link">Link</label> -->
                                                            <input hidden type="text" class="form-control" id="edit-link" name="edit-link" value="https://iptvapps.net/">
                                                            <!-- <small id="edit-link-small" class="form-text text-muted"><em>Link for ad.</em></small> -->
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="edit-description">Message</label>
                                                            <input type="text" class="form-control" id="edit-description" name="edit-description" placeholder="Enter message">
                                                            <small id="edit-description-small" class="form-text text-muted"><em>Message for ad.</em></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <!-- <label for="edit-orderby">Order by</label> -->
                                                            <input hidden type="text" class="form-control" id="edit-orderby" name="edit-orderby" value="0">
                                                            <!-- <small id="edit-orderby-small" class="form-text text-muted"><em>Orderby for ad.</em></small> -->
                                                        </div>
                                                        <div class="form-group">
                                                            <!-- <label for="edit-position">Position</label> -->
                                                            <input hidden type="text" class="form-control" id="edit-position" name="edit-position" value="vertical">
                                                            <!-- <small id="edit-position-small" class="form-text text-muted"><em>Position for ad.</em></small> -->
                                                        </div>
                                                        <div class="form-group">
                                                            <!-- <label for="edit-extension">Extension</label> -->
                                                            <input hidden type="text" class="form-control" id="edit-extension" name="edit-extension" value="png">
                                                            <!-- <small id="edit-extension-small" class="form-text text-muted"><em>Extension for app.</em></small> -->
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="edit-createdon">Creation date</label>
                                                            <input type="text" class="form-control" id="edit-createdon" name="edit-createdon" placeholder="<?php echo date("Y-m-d H:i:s"); ?>">
                                                            <small id="edit-createdon-small" class="form-text text-muted"><em>Created on date/time.</em></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="edit-path">URL for Image</label>
                                                            <input type="text" class="form-control" id="edit-path" name="edit-path" placeholder="Enter path">
                                                            <small id="edit-path-small" class="form-text text-muted"><em>(360x660px .png)</em></small>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer text-center mt-4">
                                                        <button type="submit" name="edit_ad" class="btn-sm btn-primary">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header border-bottom-0">
                                                    <h5 class="modal-title" id="deleteModalLabel">Delete Ad</h5>
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
                                                        <button type="submit" name="delete_ad" class="btn-sm btn-danger">Delete</button>
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
                                                var link = currentRow.find("td:eq(3)").text();
                                                var description = currentRow.find("td:eq(4)").text();
                                                var orderby = currentRow.find("td:eq(5)").text();
                                                var position = currentRow.find("td:eq(6)").text();
                                                var extension = currentRow.find("td:eq(7)").text();
                                                var createdon = currentRow.find("td:eq(8)").text();
                                                var path = currentRow.find("td:eq(9)").text();

                                                $("#edit-id").val(id);
                                                $("#edit-title").val(title);
                                                $("#edit-type").val(type);
                                                $("#edit-link").val(link);
                                                $("#edit-description").val(description);
                                                $("#edit-orderby").val(orderby);
                                                $("#edit-position").val(position);
                                                $("#edit-extension").val(extension);
                                                $("#edit-createdon").val(createdon);
                                                $("#edit-path").val(path);
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