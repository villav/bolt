<?php
/*
 * jQuery File Upload Plugin PHP Example 5.7
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

error_reporting(E_ALL | E_STRICT);

if (strpos(__DIR__, DIRECTORY_SEPARATOR.'bolt-public'.DIRECTORY_SEPARATOR) !== false) { // installed bolt with composer
    require_once __DIR__.'/../../../../vendor/bolt/bolt/app/bootstrap.php';
} else {
    require_once __DIR__.'/../../bootstrap.php';
}

// Make sure the session is started.
if(session_id() == "") {
    session_start();
}

// Don't do anything if we're not logged in..
if (!isset($_SESSION['_sf2_attributes']['user']['id'])) {
    echo "Not logged in.";
    die();
}

// Make sure the folder exists.
makeDir(__DIR__.'/../../../files/'.date('Y-m'));

require('upload.class.php');

// Default accepted filetypes are: gif|jpe?g|png|zip|tgz|txt|md|docx?|pdf|xlsx?|pptx?|mp3|ogg|wav|m4a|mp4|m4v|ogv|wmv|avi|webm
if (is_array($app['config']->get('general/accept_file_types'))) {
    $accepted_ext = implode('|', $app['config']->get('general/accept_file_types'));
} else {
    $accepted_ext = $app['config']->get('general/accept_file_types');
}

$upload_handler = new UploadHandler(array(
    'upload_dir' => dirname(dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])))).'/files/'.date('Y-m')."/",
    'upload_url' => '/files/'.date('Y-m')."/",
    'accept_file_types' => '/\.(' . $accepted_ext . ')$/i'
));
