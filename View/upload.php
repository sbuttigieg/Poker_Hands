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
        }
    }
?>

<!DOCTYPE html>
<html>
    <head></head>
    <body>    
        <?php 
        include 'View/title.php'; // print titles
        
        // Show file location or error message
        if (isset($destFile) && $validFile == true) {
            echo $destFile;
        } else if ($validFile == false){
            echo 'Invalid file format';
        }
        ?>
        
        <!-- Show "Choose File" and "Upload" buttons -->
        <form enctype="multipart/form-data" method="POST">
            <input name='fileToProcess' type='file' accept=".txt">
            <br>
            <input type='submit' value='Upload'>
        </form>
        <br><br>
        <?php 
        
        // If user is logged in, show "Logout" button
        // Calls logout if pressed
        if (isset($_SESSION['adminUser'])){?>
            <form name="logoutForm" id="logoutForm" action="index.php?logout" method="POST">
                <button type="submit" >Logout</button>
            </form>
        <?PHP }?>      
    </body>
</html>