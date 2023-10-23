<?php 
  
  require_once PROJECT_ROOT_PATH . 'Model/AnnouncementModel.php';
  require_once PROJECT_ROOT_PATH . 'Objects/Announcement.php';
  $announcementModel = new AnnouncementModel();
  $announcements = $announcementModel->getAnnouncements(); 
  ?>
<div class="side_panel">
  <h2>Announcements</h2>
  
    <?php 
      foreach($announcements as $announcement){
        ?>
        <a href="announcement.php?id=<?php echo $announcement->getId()?>"><?php echo $announcement->getTitle() ?></a>
    <?php  } ?>
    

</div>