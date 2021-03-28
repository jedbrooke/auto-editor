<?php
    // function run(cmd,id,email);
    // run command
    // when command is done
    shell_exec("$argv[1]");
    shell_exec("mv /exports/$argv[2].mp4 /downloads/$argv[2].mp4");
?>