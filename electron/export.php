<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale = 1.0">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="AddOns.css">
    <title>Auto-Editor (Processing Video)</title>
    <meta http-equiv="Content-Security-Policy" content="script-src 'self' 'unsafe-inline';" />
    <!-- CSS only -->
    <script src="./js/bootstrap.bundle.js"></script>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

</head>

<body>
    <div style="display:flex;">
        <h1 id="auto">Auto</h1><h1 id="editor">-Editor</h1>
    </div>

<div style="form-group">
    <?php
    // generate a video ID
    $uploads_dir = "/home/ubuntu/imports/";

    $id = uniqid("", $more_entropy = false);
    $name = "$id.mp4";

    $cmd = array("/usr/bin/python3","-m","/home/ubuntu/auto-editor/auto_editor","$uploads_dir/$name");

    array_push($cmd,$_POST['exportRes']);

    $clip = " -mclip " . (string) $_POST['minClip'];
    $cut = " -mcut " . (string) $_POST['minCut'];
    $vidSpeed = " -v " . (string) $_POST['vidSpeed'];
    $silentSpeed = " -s " . (string) $_POST['silentSpeed'];

    if($_POST['vidBit'] == null && $_POST['audbit'] == null){
        array_push($cmd,$_POST['exportBit']);
    }else{
        array_push($cmd,"-ab",(string) $_POST['audBit'],"-crf",(string) $_POST['vidBit']);
    }

    array_push($cmd,$clip);
    array_push($cmd,$cut);
    array_push($cmd,$vidSpeed);
    array_push($cmd,$silentSpeed);

    array_push($cmd,$_POST['exportType']);

    array_push($cmd,"--output","/home/ubuntu/exports/$id.mp4");

    
    $cmd = implode(" ",$cmd);
    
    // handle uploaded file
    $upload_limit = 100000000;
    $upload_ok = TRUE;
    $allowed_file_types = array("mp4","mp3","wav","mov","avi","mkv");

    $image_file_type = strtolower(pathinfo(basename($_FILES["filePath"]["name"]),PATHINFO_EXTENSION));

    if ($_FILES["filePath"]["size"] > $upload_limit) {
        $upload_ok = FALSE;
        echo("<h3>Sorry, your file is too large, there is a 100MB limit for free tier customers</h3>");
    }
    if(!in_array($image_file_type,$allowed_file_types)) {
        $upload_ok = FALSE;
        echo("<h3>Sorry, we do not support .$image_file_type files</h3>");
        echo("<h4> supported file types: " . implode(" ", $allowed_file_types) . "</h4>");
    }


    if(!move_uploaded_file($_FILES["filePath"]["tmp_name"], "$uploads_dir/$name")) {
        $upload_ok = FALSE;
        echo("<h3>Sorry, something went wrong uploading your video :/</h3>");
    }
    if($upload_ok) {
        // non blocking call to process.php with $cmd and $id
        shell_exec("php process.php \"$cmd\" $id &");
        echo("<h3>Your video is being processed, when it's done it will be <a href='download.php?id=$id'>here</a></h3>");
    }
    ?>
    </div>
</body>

</html>