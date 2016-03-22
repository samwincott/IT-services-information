<?php
	//destroying session variables, redirecting to output page
    session_start();
    session_destroy();
    header('Location: ../Output.php');
?>