<?php
    // function run(cmd,id,email);
    // run command
    // when command is done
    shell_exec("$argv[1]");
    if(!file_exists("/var/www/html/downloads")) {
        mkdir("/var/www/html/downloads");
    }
    rename("/home/ubuntu/exports/$argv[2].mp4","/var/www/html/downloads/$argv[2].mp4");
    delete("/home/ubuntu/imports/$argv[2]");
?>