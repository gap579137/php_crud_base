<?php

require_once 'database.php';

class User {
    private $conn;

    // Constructor
    public function __construct(){
      $database = new Database();
      $db = $database->dbConnection();
      $this->conn = $db;
    }


    // Execute queries SQL
    public function runQuery($sql){
      $stmt = $this->conn->prepare($sql);
      return $stmt;
    }

    // Insert
    public function insert($source, $headline, $url, $img_url, $status, $clicks, $location, $alert, $ad){
      try{
        $stmt = $this->conn->prepare("INSERT INTO main (source, headline, url, img_url, status, clicks, location, alert, ad) VALUES(:source, :headline, :url, :img_url, :status, :clicks, :location, :alert, :ad)");
        $stmt->bindparam(":source", $source);
        $stmt->bindparam(":headline", $headline);
        $stmt->bindparam(":url", $url);
        $stmt->bindparam(":img_url", $img_url);
        $stmt->bindparam(":status", $status);
        $stmt->bindparam(":clicks", $clicks);
        $stmt->bindparam(":location", $location);
        $stmt->bindparam(":alert", $alert);
        $stmt->bindparam(":ad", $ad);
        $stmt->execute();
        return $stmt;
      }catch(PDOException $e){
        echo $e->getMessage();
      }
    }


    // Update
    public function update($source, $headline, $url, $img_url, $status, $clicks, $location, $alert, $ad, $id){
        try{
          $stmt = $this->conn->prepare("UPDATE main SET source = :source, headline = :headline, url = :url, img_url = :img_url, status = :status, clicks = :clicks, location = :location, alert = :alert, ad = :ad WHERE id = :id");
          $stmt->bindparam(":source", $source);
          $stmt->bindparam(":headline", $headline);
          $stmt->bindparam(":url", $url);
          $stmt->bindparam(":img_url", $img_url);
          $stmt->bindparam(":status", $status);
          $stmt->bindparam(":clicks", $clicks);
          $stmt->bindparam(":location", $location);
          $stmt->bindparam(":alert", $alert);
          $stmt->bindparam(":ad", $ad);
          $stmt->bindparam(":id", $id);
          $stmt->execute();
          return $stmt;
        }catch(PDOException $e){
          echo $e->getMessage();
        }
    }


    // Delete
    public function delete($id){
      try{
        $stmt = $this->conn->prepare("DELETE FROM main WHERE id = :id");
        $stmt->bindparam(":id", $id);
        $stmt->execute();
        return $stmt;
      }catch(PDOException $e){
          echo $e->getMessage();
      }
    }

    // Redirect URL method
    public function redirect($url){
      header("Location: $url");
    }
}
?>
