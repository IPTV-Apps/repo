<?php

session_start();

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) {
    header("location: logout.php");
}

include('assets/includes/db.php');

if (isset($_POST['delete_feedback'])) {
    $sql = "DELETE FROM feedback_whmcssmarters ";
    $sql .= "WHERE id = " . $_POST['delete-id'] . ";";
    $sqlite3->exec($sql);

    header("Location: whmcssmarters_feedback.php");
}

if (isset($_POST['delete_report'])) {
    $sql = "DELETE FROM reports_whmcssmarters ";
    $sql .= "WHERE id = " . $_POST['delete2-id'] . ";";
    $sqlite3->exec($sql);

    header("Location: whmcssmarters_feedback.php");
}

include('assets/includes/db.php');

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
                                        <li class="breadcrumb-item active">Feedback & Reports</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Feedback</h4>

                                    <div class="table-responsive">
                                        <table id="datatable" class="datatable table-striped table-bordered nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Username</th>
                                                    <th>MAC</th>
                                                    <th>Feedback</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <?php while ($row = $feedback_whmcssmarters_data->fetchArray()) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $row['id']; ?></td>
                                                    <td><?php echo $row['username']; ?></td>
                                                    <td><?php echo $row['macaddress']; ?></td>
                                                    <td><?php echo $row['feedback_content']; ?></td>

                                                    <td>
                                                        <button type="button" data-toggle="modal" data-target="#delete-modal" class="delete-button btn-sm btn-danger waves-effect waves-light"><i class="dripicons-trash"></i></button>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </table>
                                    </div>

                                    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header border-bottom-0">
                                                    <h5 class="modal-title" id="deleteModalLabel">Delete Feedback</h5>
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
                                                        <button type="submit" name="delete_feedback" class="btn-sm btn-danger">Delete</button>
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
                                                $("#delete-id").val(id);
                                            });
                                        });
                                    </script>

                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Reports</h4>

                                    <div class="table-responsive">
                                        <table id="datatable" class="datatable table-striped table-bordered nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Username</th>
                                                    <th>MAC</th>
                                                    <th>Section</th>
                                                    <th>Section Category</th>
                                                    <th>Report Title</th>
                                                    <th>Report Sub Title</th>
                                                    <th>Report Cases</th>
                                                    <th>Report Custom Message</th>
                                                    <th>Stream Name</th>
                                                    <th>Stream ID</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <?php while ($row = $reports_whmcssmarters_data->fetchArray()) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $row['id']; ?></td>
                                                    <td><?php echo $row['username']; ?></td>
                                                    <td><?php echo $row['macaddress']; ?></td>
                                                    <td><?php echo $row['section']; ?></td>
                                                    <td><?php echo $row['section_category']; ?></td>
                                                    <td><?php echo $row['report_title']; ?></td>
                                                    <td><?php echo $row['report_sub_title']; ?></td>
                                                    <td><?php echo $row['report_cases']; ?></td>
                                                    <td><?php echo $row['report_custom_message']; ?></td>
                                                    <td><?php echo $row['stream_name']; ?></td>
                                                    <td><?php echo $row['stream_id']; ?></td>
                                                    <td>
                                                        <button type="button" data-toggle="modal" data-target="#delete2-modal" class="delete2-button btn-sm btn-danger waves-effect waves-light"><i class="dripicons-trash"></i></button>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </table>
                                    </div>

                                    <div class="modal fade" id="delete2-modal" tabindex="-1" role="dialog" aria-labelledby="delete2ModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header border-bottom-0">
                                                    <h5 class="modal-title" id="delete2ModalLabel">Delete Report</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span class="text-danger" aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST">
                                                    <div class="modal-body">
                                                        <div class="form-group" hidden>
                                                            <input type="text" class="form-control" id="delete2-id" name="delete2-id">
                                                        </div>
                                                        <h3 class="text-center mt-4">Are you sure?</h3>
                                                    </div>
                                                    <div class="modal-footer text-center mt-4">
                                                        <button type="submit" name="delete_report" class="btn-sm btn-danger">Delete</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        $(function() {
                                            $(".delete2-button").on('click', function() {
                                                var currentRow2 = $(this).closest("tr");
                                                var id2 = currentRow2.find("td:eq(0)").text();
                                                $("#delete2-id").val(id2);
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