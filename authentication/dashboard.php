<?php
  session_start();
  if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>
  <title>CSCI 6040</title>
  <link rel="stylesheet" href="custom_style.css">
</head>
<body>
  <div id="content_div">
    <h1>Welcome to CSCI 6040</h1>
    <h2>Dashboard Under-contstruction</h2>
    <form method="POST" action="logout.php">
    <input type="submit" value="Logout">
  </form>
  </div>
</body>
</html>
