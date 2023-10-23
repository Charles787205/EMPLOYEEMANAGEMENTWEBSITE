<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
require_once PROJECT_ROOT_PATH . 'Objects/Announcement.php';
class AnnouncementModel extends Database
{
    public function insertAnnouncement(Announcement $announcement) {
        $query = "INSERT INTO Announcement (title, description,  employeeId) 
                  VALUES (?, ?, ?)";
        
        try {
            $title = $announcement->getTitle();
            $description = $announcement->getDescription();
            $employeeId = $announcement->getEmployeeId();
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param('ssi', $title, $description, $employeeId);
            
            $stmt->execute();
            return $stmt;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getAnnouncements() {
        $query = "SELECT a.*, e.firstName, e.lastName 
                  FROM Announcement AS a
                  INNER JOIN Employee AS e ON a.employeeId = e.id
                  ORDER BY a.dateCreated DESC";
        
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        
        $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $announcements = [];

        foreach ($results as $result) {
            $announcement = new Announcement();

            $announcement->setId($result['id']);
            $announcement->setTitle($result['title']);
            $announcement->setDescription($result['description']);
            $announcement->setDateCreated($result['dateCreated']);
            $announcement->setEmployeeId($result['employeeId']);
            $announcement->setEmployeeName($result['firstName'] . ' ' . $result['lastName']);
            $announcements[] = $announcement;
        }

        return $announcements;
    }

    public function deleteAnnouncementById($announcementId) {
        $query = "DELETE FROM Announcement WHERE id = ?";
        
        try {
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param('i', $announcementId);
            
            $stmt->execute();
            return true; // Successful deletion
        } catch (mysqli_sql_exception $e) {
            // Handle the exception or log the error message
            return false; // Deletion failed
        }
    }
    public function getAnnouncementById($announcementId) {
    $query = "SELECT a.*, e.firstName, e.lastName 
              FROM Announcement AS a
              INNER JOIN Employee AS e ON a.employeeId = e.id
              WHERE a.id = ?
              LIMIT 1";
    
    try {
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('i', $announcementId);
        $stmt->execute();
        
        $result = $stmt->get_result()->fetch_assoc();

        if ($result) {
            $announcement = new Announcement();

            $announcement->setId($result['id']);
            $announcement->setTitle($result['title']);
            $announcement->setDescription($result['description']);
            $announcement->setDateCreated($result['dateCreated']);
            $announcement->setEmployeeId($result['employeeId']);
            $announcement->setEmployeeName($result['firstName'] . ' ' . $result['lastName']);

            return $announcement;
        } else {
            return null; // Announcement not found
        }
    } catch (mysqli_sql_exception $e) {
        // Handle the exception or log the error message
        throw new Exception('Error getting announcement: ' . $e->getMessage());
    }
}

}
