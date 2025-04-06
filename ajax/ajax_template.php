<?php


if (file_exists(__DIR__ . "/../autoload.php")) {
    include_once __DIR__ . "/../autoload.php";
}



if (isset($_GET['action'])) {
  $action = $_GET['action'];
}


switch ($action) {
    case 'delete_devs':
        echo "devs deleted successfull";
        break;

    case 'devs_status_update':

        // get data 
        $id = $_POST["statusId"];
        $status = $_POST["status"];


        $updateStatus = !$status;

        // update status 
        $sql = "UPDATE devs SET status='$updateStatus' WHERE id='$id' ";
        $statement = connect()->prepare($sql);
        $statement -> execute();
        return true;
        break;

    case 'create_devs':
       // get data 
       $name = $_POST["name"];
       $age = $_POST["age"];
       $skill = $_POST["skill"];
       $location = $_POST["location"];

       // upload photo 
      $filename =  move([
        "name" => $_FILES["photo"]["name"],
        "tmp_name" => $_FILES["photo"]["tmp_name"]
      ], "../media/devs/");


       // send data to database 
       $sql = "INSERT INTO devs (name, age, skill, location, photo ) VALUES (?, ?, ?, ?, ?)";
       $statement = connect()->prepare($sql);
       $statement -> execute([$name, $age, $skill, $location, $filename]);
       echo $name;
        break;

    case 'update_devs':
           // get data 
           $name = $_POST["name"];
           $age = $_POST["age"];
           $skill = $_POST["skill"];
           $location = $_POST["location"];
           $updateId = $_POST["updateId"];

           $updatePhoto = $_POST["old_photo"];

           if ($_FILES["new_photo"]["name"]) {
            $updatePhoto = move([
                "name" => $_FILES["new_photo"]["name"],
                "tmp_name" => $_FILES["new_photo"]["tmp_name"]
              ], "../media/devs/");

              if (file_exists("../media/devs/" . $_POST["old_photo"])) {
                  unlink("../media/devs/" . $_POST["old_photo"]);
              }
           }
           

            // send data to database 
            $sql = "UPDATE devs SET name='$name', age='$age', skill='$skill', photo='$updatePhoto', location='$location' WHERE id='$updateId' ";
            $statement = connect()->prepare($sql);
            $statement -> execute();
            $data = $statement ->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($data);


        break;


    case 'all_devs':
          // send data to database 
          $sql = "SELECT * FROM devs";
          $statement = connect()->prepare($sql);
          $statement -> execute();
          $data = $statement ->fetchAll(PDO::FETCH_OBJ);
          echo json_encode($data);
        break;

        case 'devs_edit':
              $editId = $_POST["editIdData"];
    
               // send data to database 
               $sql = "SELECT * FROM devs WHERE id='$editId' ";
               $statement = connect()->prepare($sql);
               $statement -> execute();
               $data = $statement -> fetch(PDO::FETCH_OBJ);
               echo json_encode($data);
            break;
    
    default:
        break;
}






?>
