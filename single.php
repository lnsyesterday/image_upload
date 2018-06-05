<?php 
require_once("ImageController.php");
$cntrl = new ImageController();
$cntrl->init();
if(isset($_GET["id"])){
 $id = $_GET["id"];
}
else{
	$id = null;
}
$image = $cntrl->get_single($id);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/normalize.css">
  	<link rel="stylesheet" href="css/style.css">
	<title>View image</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<main class="img-viewer">
		<h1>Where Would You Travel</h1>
        <img src="data:image/png;base64, <?=$image['image']?>" alt="Red dot" />
        <p><?=$image['image_text']?></p>
	</main>
</body>
</html>