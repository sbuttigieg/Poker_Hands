<?php
// Initialise/reset variable used to flag validity of file
$validFile = true;

// If a file was uploaded
// Get the temporary name assigned to the file by PHP
if (isset($_FILES['fileToProcess']) && 
        is_uploaded_file($_FILES['fileToProcess']['tmp_name'])) {
    $uploadedFile = $_FILES['fileToProcess']['tmp_name'];

    // Make sure the file is a text file
    // If not, flag it as invalid
    // If it is, flag it as valid ad save the file in the upload folder
    // and save the file location to SESSION
    $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
    $fileType = finfo_file($fileInfo, $uploadedFile);
    $allowedTypes = 'text/plain'; // text files only
    if ($fileType !== $allowedTypes) {
        $validFile = false;
    } else{            
        $validFile = true;
        $uploadFolder = 'Upload/'; // Define upload folder
        $uniqueName = time().uniqid(rand()); // Rename file to a unique file name to avoid duplicate file names
        $ext = pathinfo($_FILES['fileToProcess']['name'])['extension']; // Detect file extension
        $destFile = $uploadFolder . $uniqueName . '.' . $ext; // Build up File address
        move_uploaded_file($uploadedFile, $destFile); // Move uploaded file from temporary location to the upload folder
        $_SESSION['destFile'] = $destFile;
    }
}

include 'View/title.php'; // print titles ?>

<div class="row">
    <div class="col-md-4"></div>  
    <div class="col-md-4">
        <?php
        //Show "Choose File" and "Upload" buttons if file not uploaded
        if (!isset($_SESSION['destFile'])){?>
            <form class="rounded border border-dark" role="form" 
                  enctype="multipart/form-data" method="POST">
                <input class="form-control border-0" name='fileToProcess' 
                       type='file' accept=".txt">
                <br>
                <button class="form-control btn btn-primary text-white" 
                        type="submit">Upload</button>
            </form>
        <br>
        <?php }?>
    </div>
    <div class="col-md-4"></div>
</div>

<div class="row">
    <div class="col-md-4"></div>  
    <div class="col-md-4 align-self-center">
        <?php
        // Show whether upload was successful
        if (isset($_SESSION['destFile']) && $validFile == true) {
            echo "<h6 class=\"text-center\" style=\"color:red;\">"
            . "File successfully uploaded";
        } else if ($validFile == false){
            echo "<h6 class=\"text-center\" style=\"color:red;\">"
            . "Invalid file format";
        }?>
    </div>
    <div class="col-md-4"></div>
</div>

<div class="row">
    <div class="col-md-4"></div>  
    <div class="col-md-4">
        <?php
        // If file has been uploaded, show "See Results" button
        // Calls "results" if pressed
        if (isset($_SESSION['destFile'])){?>
            <form role="form" name="resultsForm" id="resultsForm" 
                  action="index.php?results" method="POST">
                <button class="form-control btn btn-primary text-white"
                        type="submit" >See Results</button>
            </form>
        <?php }?> 
    </div>
    <div class="col-md-4"></div>
</div>
<div class="row" style="height:100px;"></div>
<div class="row">
    <div class="col-md-4"></div>  
    <div class="col-md-4">
        <?php
        // If user is logged in, show "Logout" button
        // Calls logout if pressed
        if (isset($_SESSION['adminUser'])){?>
            <form name="logoutForm" id="logoutForm" action="index.php?logout" 
                  method="POST">
                <button class="bg-dark form-control btn btn-primary text-white" 
                        type="submit" >Logout</button>
            </form>
        <?php }?> 
    </div>
    <div class="col-md-4"></div>
</div>
