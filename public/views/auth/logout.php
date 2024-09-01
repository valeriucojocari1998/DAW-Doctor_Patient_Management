<?php
session_start();
session_destroy();
header("Location: /DAW-Doctor_Patient_Management/public/index.php");
exit();
