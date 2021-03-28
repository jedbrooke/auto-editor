<?php
    // function run(cmd,id,email);
    // run command
    // when command is done
    shell_exec("$argv[1]");
    rename("/var/www/exports/$argv[2].mp4","/var/www/html/downloads/$argv[2].mp4");
    // unlink("/home/ubuntu/imports/$argv[2].mp4");
?>