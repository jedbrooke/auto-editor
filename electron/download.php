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

        <?php
            $id = $_GET["id"];
            if( file_exists("/var/www/html/downloads/$id.mp4") ) {
                echo("<h3>Your video has finished processing, it's available <a href=\'downloads/$id.mp4\'>here</a></h3>");
            }else{
                echo("<h3>Your video has not processed yet, please refresh in a moment.</h3>");
            }
                // if id is finished by checking output dir
            // give them the download
            // <video src="finished_videos/$id.mp4"></video>
            // else:
                // tis still processing wait pls
        ?>

    </body>
</html>