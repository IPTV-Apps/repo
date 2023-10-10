<?php
$sqlite3 = new SQLite3('../.cockpit-0001.db');
$sql = "SELECT * FROM update_whmcssmarters;";
$update_data = $sqlite3->query($sql);

if (@$_GET['hl'] == "en") {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="IE=edge" http-equiv="X-UA-Compatible">
        <meta content="width=device-width,initial-scale=1,shrink-to-fit=no" name="viewport">
        <meta content="Cockpit WHMCS Smarters Update" name="description">
        <meta content="Ian" name="author">
        <meta content="notranslate" name="google">
    </head>

    <body>
        <title>WHMCS Smarters Update</title>
        <div class="styling">
            Updated
            15 May 2022
        </div>
        <div class="styling">
            Size
            82.27M
        </div>
        <div class="styling">
            Installs
            5,000,000+
        </div>
        <div class="styling">
            Current Version
            <?php echo $update_data->fetchArray()['version_code']; ?>
        </div>
        <div class="styling">
            Requires Android
            4.2 and up
        </div>
        <div class="styling">
            Content rating
            <div>PEGI 3</div>
            <div><a href="https://iptvapps.net/">Learn more</a></div>
        </div>

        </div>
        <div class="styling">
            In-app Products
            Contact <a href="https://t.me/jlwockee">Jlwockee</a> for Rebrands
        </div>
        <div class="styling">
            Permission
            N/A
        </div>
        <div>
            <div class="styling">
                Contact Us
                <a href="https://iptvapps.net/" target=_blank>IPTVApps.net</a>
            </div>

        </div>
        </div>
        <div class="styling">
            Created By
            <div><a href="https://iptvapps.net/members/ian.11/">Ian</a></div>
        </div>

        <style>
            .styling {
                background: #fff;
                display: cover;
                font-size: 14px;
                line-height: 24px;
                margin-bottom: 30px;
                margin-top: 30px;
                padding: 0 50px 0 50px;
                position: relative;
                text-align: center
            }
        </style>
    </body>

    </html>
<?php
} else {
?>
    <html>

    <body>
        <center>
            Your file should start downloading in a few seconds.
            <br>
            <br>
            If downloading doesn't start automatically
            <br>
            <br>
            <a href="<?php echo $update_data->fetchArray()['apk_url']; ?>">
                Click here to get your file
            </a>
        </center>
    </body>

    </html>
<?php 
    @header("Location: " . $update_data->fetchArray()['apk_url']);
} ?>