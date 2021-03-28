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
        <h1 id="auto"><a href="http://auto-editor.ddns.net/">Auto</h1><h1 id="editor">-Editor</a></h1>
    </div>

<div style="form-group">
    <?php
    // generate a video ID
    $id = uniqid("", $more_entropy = false);

    $cmd = array("/usr/bin/python3","-m","/home/ubuntu/auto-editor/auto_editor","/home/ubuntu/imports/$id.mp4");

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

    // non blocking call to process.php with $cmd and $id
    $cmd = implode(" ",$cmd);
    // echo("$cmd <br>");
    move_uploaded_file($_POST['filePath'], "/home/ubuntu/imports/$id.mp4");
    shell_exec("php process.php \"$cmd\" $id &");
    echo("<h3>Your video is being processed, when it's done it will be <a href='download.php?id=$id'>here</a></h3>");
    ?>
    </div>

    <div class="Footer">
        <p>
            <a style="color:#adb5bd;" href="https://github.com/jedbrooke/auto-editor">https://github.com/jedbrooke/auto-editor</a>
        </p>
    </div>
</body>

</html>