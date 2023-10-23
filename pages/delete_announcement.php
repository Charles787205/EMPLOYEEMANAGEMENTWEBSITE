<?php
session_start();
require __DIR__ . "../../inc/bootstrap.php";
require_once PROJECT_ROOT_PATH . '/Model/AnnouncementModel.php';
if (isset($_GET['id'])) {
    
    $announcementId = $_GET['id'];
    $announcementModel = new AnnouncementModel();
    $announcementModel->deleteAnnouncementById($announcementId);
    header('Location: announcements.php');
    
} else {
    // Handle invalid requests
    http_response_code(400); // Bad Request
}
?>