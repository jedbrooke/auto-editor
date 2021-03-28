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
    <div class="mouseover" style="display:flex;">
        <h1 id="auto"><a href="http://auto-editor.ddns.net/" style="color:#3b8eda;">Auto</a></h1><h1 id="editor"><a href="http://auto-editor.ddns.net/" style="color:#66c3f8;">-Editor</a></h1>
    </div>

<div style="form-group">
    <?php
    // generate a video ID
    $uploads_dir = "/home/ubuntu/imports";

    $id = uniqid("", $more_entropy = false);
    $name = "$id.mp4";

    $cmd = array("/usr/bin/python3","/home/ubuntu/auto-editor/auto_editor/__main__.py","$uploads_dir/$name","--no_open");

    array_push($cmd,$_POST['exportRes']);

    $clip = "--min_clip_length " . (string) $_POST['minClip'];
    $cut = "--min_cut_length " . (string) $_POST['minCut'];
    $vidSpeed = "--video_speed " . (string) $_POST['vidSpeed'];
    $silentSpeed = "--silent_speed " . (string) $_POST['silentSpeed'];

    if($_POST['vidBit'] == null && $_POST['audbit'] == null){
        array_push($cmd,$_POST['exportBit']);
    }else{
        array_push($cmd,"--audio_bitrate",(string) $_POST['audBit'],"--constant_rate_factor",(string) $_POST['vidBit']);
    }

    array_push($cmd,$clip);
    array_push($cmd,$cut);
    array_push($cmd,$vidSpeed);
    array_push($cmd,$silentSpeed);

    array_push($cmd,$_POST['exportType']);

    array_push($cmd,"--output","/home/ubuntu/exports/$id.mp4");
    array_push($cmd,"--video_codec libx264");

    
    $cmd = implode(" ",$cmd);
    
    // handle uploaded file
    $upload_limit = 100000000;
    $upload_ok = TRUE;
    $allowed_file_types = array("mp4","mp3","wav","mov","avi","mkv");
    
    $temp_name = $_FILES["filePath"]["name"];
    $image_file_type = strtolower(pathinfo($temp_name,PATHINFO_EXTENSION));

    echo("Temp name: $temp_name <br>");
    echo("file type: $image_file_type <br>");

    echo("changes<br>");
    foreach($_FILES["filePath"] as $key => $value) {
        echo("'$key':'$value'<br>");
    }

    if ($_FILES["filePath"]["size"] > $upload_limit) {
        $upload_ok = FALSE;
        echo("<h3>Sorry, your file is too large, there is a 100MB limit for free tier customers</h3>");
        
        if(!in_array($image_file_type,$allowed_file_types)) {
            $upload_ok = FALSE;
            echo("<h3>Sorry, we do not support .$image_file_type files</h3>");
            echo("<h4> supported file types: " . implode(" ", $allowed_file_types) . "</h4>");
    
            if(!move_uploaded_file($_FILES["filePath"]["tmp_name"], "$uploads_dir/$name")) {
                $upload_ok = FALSE;
                echo("<h3>Sorry, something went wrong uploading your video :/</h3>");
            }
        }
    } 
    
    
    
    if($upload_ok) {
        // non blocking call to process.php with $cmd and $id
        echo("php process.php \"$cmd\" $id &");
        shell_exec("php process.php \"$cmd\" $id &");
        echo("<h3>Your video is being processed, when it's done it will be <a href='download.php?id=$id'>here</a></h3>");
    }
    ?>
    </div>

    <div class="Footer">
        <div style="width:100%">
            <a style="color:#adb5bd;" href="https://github.com/jedbrooke/auto-editor">Find us on GitHub</a>
            <img src="GithubLogo.png" alt="GitHub" style="width:3.5em; height:2em;">
        </div>
        <div style="width:100%">
            Hosted on Oracle
        </div>
    </div>
</body>

</html>