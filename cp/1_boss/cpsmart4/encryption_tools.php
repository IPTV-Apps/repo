<?php
session_start();

include('assets/includes/config.php');

if ($_ERRORS == true) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}
?>
<!doctype html>
<html lang="en">

<head>

    <?php include('assets/includes/title-meta.php') ?>

    <?php include('assets/includes/head-css.php') ?>

    <style type='text/css'>
        textarea {
            resize: none;
        }

        input {
            width: 60%;
        }
    </style>

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
                                        <li class="breadcrumb-item active">Encryption Tools</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Encryption Tools</h4>
                                    <br />

                                    <form method="post" action="" style="text-align:center;">
                                        Enter your string in the text area below </br>
                                        <textarea name="txtCode" cols="70" rows="8" id="inny"><?= isset($_POST['txtCode']) ? $_POST['txtCode'] : '' ?></textarea><br>
                                        <button class="btn btn-sm btn btn-primary" type="button" value="Clear Input" onClick="clearContents()">Clear Input</button><br />
                                        <hr>

                                        <div class="container">
                                            <div class="row">
                                                <div class="col-sm">
                                                    AES CBC & ECB </br>
                                                    <small>CBC requires an IV</small></br>
                                                    <label for="key">Key </label>
                                                    <span><input class="form-control" name="key" id="inny" value="<?= isset($_POST['key']) ? $_POST['key'] : '' ?>"></span>
                                                    <label for="iv">IV </label>
                                                    <span><input class="form-control" name="iv" id="inny" value="<?= isset($_POST['iv']) ? $_POST['iv'] : '' ?>"></span>
                                                    <select class="form-control" id="select" name="encrypt_method">
                                                        <option value="aes-128-cbc" <?= @$_POST['encrypt_method'] == "aes-128-cbc" ? 'selected' : ''; ?>>AES-128-CBC</option>
                                                        <option value="aes-192-cbc" <?= @$_POST['encrypt_method'] == "aes-192-cbc" ? 'selected' : ''; ?>>AES-192-CBC</option>
                                                        <option value="aes-256-cbc" <?= @$_POST['encrypt_method'] == "aes-256-cbc" ? 'selected' : ''; ?>>AES-256-CBC</option>
                                                        <option value="aes-256-cbc" <?= @$_POST['encrypt_method'] == "aes-128-ecb" ? 'selected' : ''; ?>>AES-128-ECB</option>
                                                        <option value="aes-256-cbc" <?= @$_POST['encrypt_method'] == "aes-192-ecb" ? 'selected' : ''; ?>>AES-192-ECB</option>
                                                        <option value="aes-256-cbc" <?= @$_POST['encrypt_method'] == "aes-256-ecb" ? 'selected' : ''; ?>>AES-256-ECB</option>
                                                    </select><br>
                                                    <button class="btn btn-sm btn btn-primary" name="aesEncode" />Encrypt</button>
                                                    <button class="btn btn-sm btn btn-primary" name="aesDecode" />Decrypt</button>
                                                </div>
                                                <div class="col-sm">
                                                    Base 64 </br>
                                                    <button class="btn btn-sm btn btn-primary" name="b64Decode" />Base 64 Decode</button><br><br>
                                                    <button class="btn btn-sm btn btn-primary" name="b64Encode" />Base 64 Encode</button>
                                                </div>
                                                <div class="col-sm">
                                                    HEX & ASCII </br>
                                                    <button class="btn btn-sm btn btn-primary" name="hex2ascii" />HEX > ASCII</button><br><br>
                                                    <button class="btn btn-sm btn btn-primary" name="ascii2hex" />ASCII > HEX</button>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        Output </br>
                                        <textarea cols="70" rows="8" id="output" style="text-align:unset;">
                                            <?php
                                            $input = rtrim((string)@$_POST['txtCode']);
                                            if (isset($_POST['aesEncode']) && strlen($input)) {
                                                echo bin2hex(openssl_encrypt($input, $_POST['encrypt_method'], $_POST['key'], OPENSSL_RAW_DATA, $_POST['iv']));
                                            }
                                            if (isset($_POST['aesDecode']) && strlen($input)) {
                                                echo openssl_decrypt(hex2bin($input), $_POST['encrypt_method'], $_POST['key'], OPENSSL_RAW_DATA, $_POST['iv']);
                                            }
                                            if (isset($_POST['b64Decode']) && strlen($input)) {
                                                echo base64_decode($input);
                                            }
                                            if (isset($_POST['b64Encode']) && strlen($input)) {
                                                echo base64_encode($input);
                                            }
                                            if (isset($_POST['hex2ascii']) && strlen($input)) {
                                                echo hex2bin($input);
                                            }
                                            if (isset($_POST['ascii2hex']) && strlen($input)) {
                                                echo rtrim(bin2hex($input));
                                            }
                                            ?>
                                            </textarea>
                                        </br>
                                        </br>
                                        <button class="btn btn-sm btn btn-primary" type="button" onClick="changeText('copy', 'Copied Output', 'Copy Output')" id="copy">Copy Output</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        function clearContents() {
                            document.getElementById("inny").value = '';
                        }

                        function changeText(button, text, textToChangeBackTo) {
                            buttonId = document.getElementById(button);
                            buttonId.textContent = text;
                            setTimeout(function() {
                                document.getElementById(button).textContent = textToChangeBackTo;
                            }, 5000);
                        }

                        $(function() {
                            $("#copy").click(function() {
                                var copyText = document.getElementById("output");
                                copyText.select();
                                document.execCommand("copy");
                            });
                        });
                    </script>

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