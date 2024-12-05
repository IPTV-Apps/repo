<?php
function isHttps()
{
    $httpsHeaders = [
        'HTTPS' => ['on', '1'],
        'SERVER_PORT' => ['443'],
        'HTTP_X_FORWARDED_PROTO' => ['https'],
        'HTTP_X_FORWARDED_SSL' => ['on'],
        'HTTP_X_FORWARDED_PROTOCOL' => ['https'],
        'HTTP_FRONT_END_HTTPS' => ['on'],
        'HTTP_CF_VISITOR' => ['https'],
        'HTTP_X_AMZ_CF_PROTO' => ['https'],
        'HTTP_FASTLY_SSL' => ['1'],
        'HTTP_X_FORWARDED_SCHEME' => ['https'],
        'HTTP_X_URL_SCHEME' => ['https'],
    ];
    foreach ($httpsHeaders as $key => $values) {
        if (isset($_SERVER[$key])) {
            foreach ($values as $value) {
                if (stripos($_SERVER[$key], $value) !== false) {
                    return true;
                }
            }
        }
    }
    return false;
}

$protocol = isHttps() ? 'https' : 'http';
$current_directory = dirname($_SERVER['PHP_SELF']);
$api_path = dirname(dirname(dirname(dirname($current_directory))));
if (substr($api_path, -1) !== '/') {
    $api_path .= '/';
}
$api_path .= 'api/webview';
$path_prefix = './'
?>

<section class="endpoints-section">
    <div class="endpoints-item">
        <h5 class="name">Framed Views 1-3</h5>
        <div class="input-group flex-nowrap mb-3">
            <input type="text" id="endpoint_1" name="endpoint_1" class="form-control" value="<?php echo "$protocol://$_SERVER[HTTP_HOST]$api_path/frameview.php?layout=layout_##"; ?>" readonly />
            <button class="btn btn-outline-theme" type="button" data-toggle="clipboard" data-clipboard-target="#endpoint_1"><i class="fa fa-copy"></i></button>
        </div>
    </div>
    
    <div class="endpoints-item">
        <h5 class="name">Media Slideshow</h5>
        <div class="input-group flex-nowrap mb-3">
            <input type="text" id="endpoint_2" name="endpoint_2" class="form-control" value="<?php echo "$protocol://$_SERVER[HTTP_HOST]$api_path/slideshow.php"; ?>" readonly />
            <button class="btn btn-outline-theme" type="button" data-toggle="clipboard" data-clipboard-target="#endpoint_2"><i class="fa fa-copy"></i></button>
        </div>
    </div>

    <div class="endpoints-item">
        <h5 class="name">TheSportsDB: Top</h5>
        <div class="input-group flex-nowrap mb-3">
            <input type="text" id="endpoint_3" name="endpoint_3" class="form-control" value="<?php echo "$protocol://$_SERVER[HTTP_HOST]$api_path/thesportsdb.php?page=sport_top"; ?>" readonly />
            <button class="btn btn-outline-theme" type="button" data-toggle="clipboard" data-clipboard-target="#endpoint_3"><i class="fa fa-copy"></i></button>
        </div>
    </div>

    <div class="endpoints-item">
        <h5 class="name">TheSportsDB: TV Today</h5>
        <div class="input-group flex-nowrap mb-3">
            <input type="text" id="endpoint_4" name="endpoint_4" class="form-control" value="<?php echo "$protocol://$_SERVER[HTTP_HOST]$api_path/thesportsdb.php?page=sport_tv_today"; ?>" readonly />
            <button class="btn btn-outline-theme" type="button" data-toggle="clipboard" data-clipboard-target="#endpoint_4"><i class="fa fa-copy"></i></button>
        </div>
    </div>

    <div class="endpoints-item">
        <h5 class="name">TheSportsDB: League Tables</h5>
        <div class="input-group flex-nowrap mb-3">
            <input type="text" id="endpoint_5" name="endpoint_5" class="form-control" value="<?php echo "$protocol://$_SERVER[HTTP_HOST]$api_path/thesportsdb.php?page=sport_l_table"; ?>" readonly />
            <button class="btn btn-outline-theme" type="button" data-toggle="clipboard" data-clipboard-target="#endpoint_5"><i class="fa fa-copy"></i></button>
        </div>
    </div>

    <div class="endpoints-item">
        <h5 class="name">TheSportsDB: League Cards</h5>
        <div class="input-group flex-nowrap mb-3">
            <input type="text" id="endpoint_6" name="endpoint_6" class="form-control" value="<?php echo "$protocol://$_SERVER[HTTP_HOST]$api_path/thesportsdb.php?page=sports_l_cards"; ?>" readonly />
            <button class="btn btn-outline-theme" type="button" data-toggle="clipboard" data-clipboard-target="#endpoint_6"><i class="fa fa-copy"></i></button>
        </div>
    </div>

    <div class="endpoints-item">
        <h5 class="name">The Movie Database 1-22</h5>
        <div class="input-group flex-nowrap mb-3">
            <input type="text" id="endpoint_7" name="endpoint_7" class="form-control" value="<?php echo "$protocol://$_SERVER[HTTP_HOST]$api_path/tmdb.php?layout=layout_##"; ?>" readonly />
            <button class="btn btn-outline-theme" type="button" data-toggle="clipboard" data-clipboard-target="#endpoint_6"><i class="fa fa-copy"></i></button>
        </div>
    </div>

    <div class="endpoints-item">
        <h5 class="name">TVSportGuide</h5>
        <div class="input-group flex-nowrap mb-3">
            <input type="text" id="endpoint_8" name="endpoint_8" class="form-control" value="<?php echo "$protocol://$_SERVER[HTTP_HOST]$api_path/tvsportguide.php"; ?>" readonly />
            <button class="btn btn-outline-theme" type="button" data-toggle="clipboard" data-clipboard-target="#endpoint_8"><i class="fa fa-copy"></i></button>
        </div>
    </div>

    <div class="endpoints-item">
        <h5 class="name">XXLinked</h5>
        <div class="input-group flex-nowrap mb-3">
            <input type="text" id="endpoint_9" name="endpoint_9" class="form-control" value="<?php echo "$protocol://$_SERVER[HTTP_HOST]$api_path/xxlinked.php"; ?>" readonly />
            <button class="btn btn-outline-theme" type="button" data-toggle="clipboard" data-clipboard-target="#endpoint_9"><i class="fa fa-copy"></i></button>
        </div>
    </div>

    <div class="endpoints-item">
        <h5 class="name">Website</h5>
        <div class="input-group flex-nowrap mb-3">
            <input type="text" id="endpoint_10" name="endpoint_10" class="form-control" value="<?php echo "$protocol://$_SERVER[HTTP_HOST]$api_path/website.php"; ?>" readonly />
            <button class="btn btn-outline-theme" type="button" data-toggle="clipboard" data-clipboard-target="#endpoint_10"><i class="fa fa-copy"></i></button>
        </div>
    </div>

</section>