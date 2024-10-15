<?php
include '../config/connection.php';
$r = $_GET['r'];
switch ($r) {
    //GET
    case 'getSubK':
        include 'nextSubKriteria.php';
        break;
    
    //POST
    case 'insertJabatan':
        include 'insertjabatan.php';
        break;
    case 'addAssessment':
        include 'tambahPenilaian.php';
        break;
    case 'delSubKriteria':
        include 'deleteSubKriteria.php';
        break;
    case 'delKriteria':
        include 'deleteKriteria.php';
        break;
    case 'updateAssessment':
        include 'editPenilaian.php';
        break;
    case 'refreshAssessmentExist':
        include 'refreshExist.php';
        break;
    case 'refreshAssessmentEmpty':
        include 'refreshEmpty.php';
        break;
    case 'updateActionTahun':
        include 'updateActionTahun.php';
        break;
    case 'fetchActionTahun':
        include 'fetchActionTahun.php';
        break;
    case 'updateActionBulan':
        include 'updateActionBulan.php';
        break;
    case 'fetchActionBulan':
        include 'fetchActionBulan.php';
        break;
    case 'insertFinishPenilaian':
        include 'finishPenilaian.php';
        break;
    default:
        echo '<h1>error</h1>';
        break;
}
?>