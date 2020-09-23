<?php
// Show PHP errors
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once 'classes/article.php';

$objUser = new User();
// GET
if(isset($_GET['edit_id'])){
    $id = $_GET['edit_id'];
    $stmt = $objUser->runQuery("SELECT * FROM main WHERE id=:id");
    $stmt->execute(array(":id" => $id));
    $rowUser = $stmt->fetch(PDO::FETCH_ASSOC);
}else{
  $id = null;
  $rowUser = null;
}

// POST
if(isset($_POST['btn_save'])){
  $name   = strip_tags($_POST['name']);
  $headline  = strip_tags($_POST['headline']);

  try{
     if($id != null){
       if($objUser->update($name, $headline, $id)){
         $objUser->redirect('index.php?updated');
       }
     }else{
       if($objUser->insert($name, $headline)){
         $objUser->redirect('index.php?inserted');
       }else{
         $objUser->redirect('index.php?error');
       }
     }
  }catch(PDOException $e){
    echo $e->getMessage();
  }
}

?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Head metas, css, and title -->
        <?php require_once 'includes/head.php'; ?>
    </head>
    <body>
        <!-- Header banner -->
        <?php require_once 'includes/header.php'; ?>
        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar menu -->
                <?php require_once 'includes/sidebar.php'; ?>
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                  <h1 style="margin-top: 10px">Add / Edit Article</h1>
                  <p>Required fields are in (*)</p>
                  <form  method="post">
                    <b-row class="col-12">
                    <div class="form-group col-4">
                        <label for="id">ID</label>
                        <input class="form-control" type="text" name="id" id="id" value="<?php print($rowUser['id']); ?>" readonly>
                    </div>
                    <div class="form-group col-4">
                        <label for="id">Clicks</label>
                        <input class="form-control" type="text" name="clicks" id="clicks" value="<?php print($rowUser['clicks']); ?>" readonly>
                    </div>
                    </b-row>
                    
                    <div class="form-group">
                        <label for="source">Source *</label>
                        <input  class="form-control" type="text" name="source" id="source" placeholder="News Media Outlet" value="<?php print($rowUser['source']); ?>" required maxlength="100">
                    </div>
                    <div class="form-group">
                        <label for="headline">headline *</label>
                        <input  class="form-control" type="text" name="headline" id="headline" placeholder="johndoel@gmail.com" value="<?php print($rowUser['headline']); ?>" required maxlength="100">
                    </div>
                    <div class="form-group">
                        <label for="url">url *</label>
                        <input  class="form-control" type="text" name="url" id="url" placeholder="johndoel@gmail.com" value="<?php print($rowUser['url']); ?>" required maxlength="100">
                    </div>
                    <div class="form-group">
                        <label for="img_url">img_url *</label>
                        <input  class="form-control" type="text" name="img_url" id="img_url" placeholder="johndoel@gmail.com" value="<?php print($rowUser['img_url']); ?>" required maxlength="100">
                    </div>
                    <div class="form-group">
                        <label for="status">status *</label>
                        <input  class="form-control" type="text" name="status" id="status" placeholder="johndoel@gmail.com" value="<?php print($rowUser['status']); ?>" required maxlength="100">
                    </div>
                    
                    <div class="form-group">
                        <label for="location">location *</label>
                        <input  class="form-control" type="text" name="location" id="location" placeholder="johndoel@gmail.com" value="<?php print($rowUser['location']); ?>" required maxlength="100">
                    </div>
                    <div class="form-group">
                        <label for="alert">alert *</label>
                        <input  class="form-control" type="text" name="alert" id="alert" placeholder="johndoel@gmail.com" value="<?php print($rowUser['alert']); ?>" required maxlength="100">
                    </div>
                    <div class="form-group">
                        <label for="ad">ad *</label>
                        <input  class="form-control" type="text" name="ad" id="ad" placeholder="johndoel@gmail.com" value="<?php print($rowUser['ad']); ?>" required maxlength="100">
                    </div>
                    <input class="btn btn-primary mb-2" type="submit" name="btn_save" value="Save">
                  </form>
                </main>
            </div>
        </div>
        <!-- Footer scripts, and functions -->
        <?php require_once 'includes/footer.php'; ?>
    </body>
</html>
