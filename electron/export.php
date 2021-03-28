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
    $id = uniqid("", $more_entropy = false);

    $cmd = "python3 -m /home/ubuntu/auto-editor/auto_editor " . "/home/ubuntu/imports/$id.mp4 " . $_POST['exportRes'];

    $clip = " -mclip " . (string) $_POST['minClip'];
    $cut = " -mcut " . (string) $_POST['minCut'];
    $vidSpeed = " -v " . (string) $_POST['vidSpeed'];
    $silentSpeed = " -s " . (string) $_POST['silentSpeed'];

    if($_POST['vidBit'] == null && $_POST['audbit'] == null){
        $cmd .= $_POST['exportBit'];
    }else{
        $audio = " -ab " . (string) $_POST['audBit'];
        $video = " -crf " . (string) $_POST['vidBit'];
        $cmd .= $audio;
        $cmd .= $video;
    }

    $cmd .= $clip;
    $cmd .= $cut;
    $cmd .= $vidSpeed;
    $cmd .= $silentSpeed;

    $cmd .= $_POST['exportType'];

    $cmd .= "--output /home/ubuntu/exports/$id.mp4";

    // non blocking call to process.php with $cmd and $id
    echo("$cmd <br>");
    move_uploaded_file($_POST['filePath'], "/home/ubuntu/imports/$id.mp4");
    // shell_exec("php process.php $cmd $id &");
    echo("<h3>Your video is being processed, when it's done it will be <a href='download.php?id=$id'>here</a></h3>");
    ?>
    </div>
</body>

</html>