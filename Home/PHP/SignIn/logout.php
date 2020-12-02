<?php
echo "Logout Page!";
session_start();
session_destroy();
header("Location:../../HTML/index.php");
return;
?>



