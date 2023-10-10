<?php
include('assets/includes/config.php');
?>
<footer class="footer">
    <div class="container-fluid">
        <div class="row">

            <?php if ($IPTVAPPS_BRANDING) { ?>
            <div class="col-sm-6">
                <script>document.write(new Date().getFullYear())</script> © IPTVApps.net
            </div>
            <div class="col-sm-6">
                <div class="text-sm-right d-none d-sm-block">
                    Crafted with <i class="mdi mdi-heart text-danger"></i> by <a href="https://iptvapps.net/members/ian.11/">Ian</a> & <a href="https://t.me/IPTVAppsRebrands/">IPTV Apps Rebrands</a> & <a href="https://t.me/WatchItTv/">*Watch It Tv*</a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</footer>