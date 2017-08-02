<?php
require_once('config.php');
if(!isset($_REQUEST['entry'])){
 exit();
}

$hash = $_REQUEST['entry'];

$db = mysqli_init();
$db->real_connect($hostname, $user, $password, $database);

$query = $db->prepare("select username from directory_public where hash = ?");
$query->bind_param("s", $hash);
$query->execute();
$query->bind_result($username);
if($query->fetch()){
 
  $im = imagecreate(200, 18);

  // White background and black text
  $bg = imagecolorallocate($im, 255, 255, 255);
  $textcolor = imagecolorallocate($im, 0, 0, 0);

  // Write the string at the top left
  imagestring($im, 4, 0, 0, "$username@uwosh.edu", $textcolor);

  // Output the image
  header('Content-type: image/png');

  imagepng($im);
  imagedestroy($im);
}
$db->close();
?>

