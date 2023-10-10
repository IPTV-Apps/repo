<?php
/**
 * Current Panel Version
 */
$_VERSION = '1.2.0b';
/**
 * Display PHP Errors
 */
$_ERRORS = true;
/**
 * Latest Panel Version
 */
$VERSION_JSON = json_decode(file_get_contents('https://iptv-apps.github.io/repo/cp/article/version/120b/cpsmart4/boss/version.json'), true);
/**
 * Update Message
 */
$_UPDATE_MESSAGE = '<div class="row">
                        <div class="col-6 mx-auto">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="mdi mdi-alert-outline mr-2"></i> 
                                Your <strong>CP Smart4 Panel</strong> 
                                is not using the latest version of the software. Contact 
                                <a href="https://iptvapps.net/members/rick-sanchez.5344/" target="_blank"> @IPTVAppsRebrands</a>.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span></button>
                            </div>
                        </div>
                    </div>';
/** 
 * Enable/Disable Dashboard
 */
$DASHBOARD = true;
/**
 * Dashboard Article 1 JSON
 */
$ARTICLE_1_JSON = json_decode(file_get_contents('https://iptv-apps.github.io/repo/cp/1_boss/cpsmart4/article_1.json'), true);
/**
 * Dashboard Article 2 JSON
 */
$ARTICLE_2_JSON = json_decode(file_get_contents('https://iptv-apps.github.io/repo/cp/1_boss/cpsmart4/article_2.json'), true);
/**
 * Enable/Disable IPTVApps Branding (SUPPORT THE COMMUNITY!)
 */
$IPTVAPPS_BRANDING = true;
/**
 * Enable/Disable User Profile Panel Edits
 */
$USER_PROFILE_PANEL_EDITS = true;
/**
 * Manual User Profile Panel Title
 * Note: This is only used if $USER_PROFILE_PANEL_EDITS is set to false.
 */
$USER_PROFILE_PANEL_TITLE = 'Panel Title';
/**
 * Manual User Profile Panel Logo Light
 * Note: This is only used if $USER_PROFILE_PANEL_EDITS is set to false.
 */
$USER_PROFILE_PANEL_LOGO_LIGHT = 'example.com/logo-light-221x45.png';
/**
 * Manual User Profile Panel Logo Dark
 * Note: This is only used if $USER_PROFILE_PANEL_EDITS is set to false.
 */
$USER_PROFILE_PANEL_LOGO_DARK = 'example.com/logo-dark-221x45.png';
/**
 * Manual User Profile Panel Logo Light (small)
 * Note: This is only used if $USER_PROFILE_PANEL_EDITS is set to false.
 */
$USER_PROFILE_PANEL_LOGO_LIGHT_SMALL = 'example.com/logo-light-small-36x40.png';
/**
 * Manual User Profile Panel Logo Dark (small)
 * Note: This is only used if $USER_PROFILE_PANEL_EDITS is set to false.
 */
$USER_PROFILE_PANEL_LOGO_DARK_SMALL = 'example.com/logo-dark-small-36x40.png';
/**
 * Manual User Profile Panel Login GIF
 * Note: This is only used if $USER_PROFILE_PANEL_EDITS is set to false.
 */
$USER_PROFILE_PANEL_LOGIN_GIF = 'example.com/login-gif-2000x1333.gif';
