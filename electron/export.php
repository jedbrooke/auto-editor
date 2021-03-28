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

    <style>

        html {
            --spinner: #66c3f8;
            --center: translate(-50%, -50%);
        }
        .center {
            position: absolute;
            width: 30px;
            height: 30px;
            background: var(--spinner);
            border-radius: 50%;
            top: 50%;
            left: 50%;
            transform: var(--center); 
        }
        .outer-spin, .inner-spin {
            position: absolute;
            top: 50%;
            left: 50%;
        }
        .outer-spin {
            animation: spin 4s linear infinite;
        }
        .outer-arc, .inner-arc {
            position: absolute;
            border-radius: 50%;
            border: 4px solid;
        }
        .outer-arc {
            width: 100px;
            height: 100px;
        }
        .outer-arc_start-a {
            border-color: transparent transparent transparent var(--spinner);
            /*NOTE: the order here very much matters!  */
            transform: var(--center) rotate(65deg); 
        }
        .outer-arc_end-a {
            border-color: var(--spinner) transparent transparent transparent;
            transform: var(--center) rotate(45deg);
        }
        .outer-arc_start-b {
            border-color: transparent transparent transparent var(--spinner); 
            transform: var(--center) rotate(65deg) scale(-1, -1);
        }
        .outer-arc_end-b {
            border-color: var(--spinner) transparent transparent transparent;
            transform: var(--center) rotate(45deg) scale(-1, -1);
        }

        .outer-moon-a {
            position: absolute;
            top:50%;
            left:50%;
            width: 15px;
            height: 15px;
            background: var(--spinner);
            border-radius: 50%;
            transform: var(--center) translate(52px, 0); 
        }
        .outer-moon-b {
            position: absolute;
            top:50%;
            left:50%;
            width: 15px;
            height: 15px;
            background: var(--spinner);
            border-radius: 50%;
            transform: var(--center) translate(-52px, 0); 
        }
        .inner-spin {
            animation: spin 3s linear infinite;
        }
        .inner-arc {
            width: 62px;
            height: 62px;
        }
        .inner-arc_start-a {
            border-color: transparent transparent transparent var(--spinner);
            /*NOTE: the order here very much matters!  */
            transform: var(--center) rotate(65deg); 
        }
        .inner-arc_end-a {
            border-color: var(--spinner) transparent transparent transparent;
            transform: var(--center) rotate(45deg);
        }
        .inner-arc_start-b {
            border-color: transparent transparent transparent var(--spinner); 
            transform: var(--center) rotate(65deg) scale(-1, -1);
        }
        .inner-arc_end-b {
            border-color: var(--spinner) transparent transparent transparent;
            transform: var(--center) rotate(45deg) scale(-1, -1);
        }
        .inner-moon-a {
            position: absolute;
            top:50%;
            left:50%;
            width: 12px;
            height: 12px;
            background: var(--spinner);
            border-radius: 50%;
            transform: var(--center) translate(33px, 0); 
        }
        .inner-moon-b {
            position: absolute;
            top:50%;
            left:50%;
            width: 12px;
            height: 12px;
            background: var(--spinner);
            border-radius: 50%;
            transform: var(--center) translate(-33px, 0); 
        }
        @keyframes spin { 100% {transform: rotate(360deg); } }

    </style>

</head>

<body>
    <div style="display:flex;">
        <h1 id="auto">Auto</h1><h1 id="editor">-Editor</h1>
    </div>

    <div class="center"></div>

<div class="inner-spin">
  
  <div class="inner-arc inner-arc_start-a"></div>
  <div class="inner-arc inner-arc_end-a"></div>

  <div class="inner-arc inner-arc_start-b"></div>
  <div class="inner-arc inner-arc_end-b"></div>
  
  <div class="inner-moon-a"></div>
 <div class="inner-moon-b"></div>
  
</div>

<div class="outer-spin">
  
  <div class="outer-arc outer-arc_start-a"></div>
  <div class="outer-arc outer-arc_end-a"></div>

  <div class="outer-arc outer-arc_start-b"></div>
  <div class="outer-arc outer-arc_end-b"></div>
  
  <div class="outer-moon-a"></div>
 <div class="outer-moon-b"></div>
  
</div>

<div style="form-group">
    <?php
    $cmd = "auto-editor " . $_POST['inputFiles'][0] . $_POST['exportRes'];

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

    $output=null;
    $retval=null;

    // generate a video ID
    $id = uniqid(string $prefix = "" , bool $more_entropy = false);

    // non blocking call to process.php with $cmd and $id
    // exec($cmd, $output, $retval);
    shell_exec("php process.php $cmd $id &");
    echo("you video is being processed, when it's done it will be at this link: <a href='download.php?id=$id'>link text</a>");
    ?>
    </div>
</body>

</html>