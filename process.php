<?php
/** Process an action */
$allowed_levels = array(9,8,7,0);
require_once 'bootstrap.php';

$_SESSION['last_call'] = time();

if ( !empty( $_GET['do'] ) && $_GET['do'] != 'login' ) {
    check_for_session();
    can_see_content($allowed_levels);
}

$process = new \ProjectSend\Classes\DoProcess($dbh);

switch ($_GET['do']) {
    case 'login':
        $process->login($_POST['username'], $_POST['password'], $_POST['language']);
        break;
    case 'logout':
        $process->logout();
        break;
    case 'download':
        $process->download($_GET['id']);
        break;
    case 'return_files_ids':
        $process->returnFilesIds($_GET['files']);
        break;
    case 'download_zip':
        $process->downloadZip($_GET['files']);
        break;
    default:
        header('Location:' . BASE_URI);
        break;
}

exit;