<?php
session_start();
require __DIR__ . "../../inc/bootstrap.php";
require_once PROJECT_ROOT_PATH . '/Model/AnnouncementModel.php';
if (isset($_GET['id'])) {
    
    $announcementId = $_GET['id'];
    $announcementModel = new AnnouncementModel();
    $announcement = $announcementModel->getAnnouncementById($announcementId);
    }?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/style.css">
  <link rel="stylesheet" href="styles/announcement_page.css">
  <title>Announcement</title>
</head>
<body>
  <?php require_once PROJECT_ROOT_PATH . '/components/employee_navbar.php'; ?>
  <div class="page">
    <div class="announcement_card">
      <div class="announcement_card">
            <h2><?php echo $announcement->getTitle() ?></h2>
          <p><?php echo $announcement->getDescription()?></p>
          <div class="row bottom_row">
            <p>Created by: <?php  echo $announcement->getEmployeeName()?></p>
            <p>Created At: <?php  echo $announcement->getDateCreated()?></p>
          </div>
        </div>
    </div>
  </div>
</body>
</html>