<?php 

	class FolderModel {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["uploadFile"]["name"]);
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

/*        if (in_array($fileActualExt, $allowed)) {
           if ($fileError === 0) {
            if ($FileSize < 900000) {
            $FileNameNew = uniqid('', true).".".$fileActualExt; 
            $fileDestination = 'uploads/'.$FileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                header("Location: index.php?uploadsucesss");
            } else {
                echo "Your file is too big";
            } 
        } else {
            echo 'Something went wrong';
        }
    }  else {
        echo "You can't upload that!";
    }
*/
        if (isset($_POST["submit"])) {
            $file = $_FILES["uploadFile"];
            $fileName = $_FILES["uploadFile"]["tmp_name"];
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

         // Check file size
        if ($_FILES["uploadFile"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($fileType!= "doc" && $fileType != "docx" && $fileType != "pdf"
        && $fileType != "txt" ) {
            echo "Sorry, only doc, docx, pdf & txt files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";

        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["uploadFile"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

    }
?>