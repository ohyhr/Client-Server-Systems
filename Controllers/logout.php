<?php
// logs the user out by destroying the session and then sending them back to the last page
    session_start();
    session_destroy();
    header("Location: /");