<?php
//for log out we resume the session and unset session data finally,we destroy it.
session_start();
session_unset();
session_destroy();
//redirect to index page
header('');
exit();
?>