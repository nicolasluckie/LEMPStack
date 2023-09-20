<?php

session_start();
include_once("../db.inc.php");

echo "<b>IP:</b><br>" . getRealIpAddr() . "<br>";
echo "<b>Timezone:</b><br>" . $dbConfig["TZ"] . "<br>";
echo "<b>Agent:</b><br>" . getDeviceAgent() . "<br>";

?>