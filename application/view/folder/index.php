<nav class="navbar navbar-light bg-faded">
	<section class="function-bar">
	   <button class="btn btn-outline-success" type="button">New Folder</button>
	   <button class="btn btn-outline-success" type="button">Downloaden</button>
	   <button class="btn btn-outline-success" type="button">Delete</button>
       <input class="btn btn-outline-success" type="file" name="file" />
	</section>
</nav>

<form name="form1" method="post" action="php_folder.php">
  <p>
    <input type="text" name="textfield" id="textfield"> 
  Create folder_name</p>
  <p>
    <input type="submit" name="button" id="button" value="Submit">
  </p>
</form>

<form action="/file-upload" class="dropzone" id="my-awesome-dropzone">
     
</form>

<div class="container">
  <h1>FolderController/index</h1>
    <div class="box">


        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <h3>What happens here ?</h3>
        <p>
            Here is the user suppose to create New Folders, change the name, open the folder, upload data to the folder, delete folders, delete data.
        </p>

    </div>

    <?php

        // $curdir = getcwd();

        // if(mkdir ($curdir ."/organisation" , 0777)) {
        //     echo "Folder succesfully created";
        // } else {
        //     echo "Failed to create folder";
        // }
    ?>

</div>
