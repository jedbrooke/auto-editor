<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale = 1.0">
  <link rel="stylesheet" href="bootstrap.css">
  <link rel="stylesheet" href="AddOns.css">
  <title>Auto-Editor</title>
  <meta http-equiv="Content-Security-Policy" content="script-src 'self' 'unsafe-inline';" />
  <!-- CSS only -->
  <script src="./js/bootstrap.bundle.js"></script>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

</head>

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

// non blocking call to process.php with cmd and ID and email
// exec($cmd, $output, $retval);
echo("you video is being processed, when it's done it will be at this link: ");

?>

</html>