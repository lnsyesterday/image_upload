<?php 
require_once("ImageController.php");
$cntrl = new ImageController();
$cntrl->init();
$result = $cntrl->get_all();
$pages = $cntrl->pages();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>WhereWouldYouTravel</title>
	<link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="wrapper">
	<header class="header">
		<h1>Where Would You Travel?</h1>
		<p>Place an image of your favorite destination point, to inspire others.</p>
		<p>We support the following file formats: jpg., png. and gif.</p>
	</header>

	
<main class="content">
  		<form method="POST"  enctype="multipart/form-data">
        <div class="upload-container">
          <input id="browse" type="file" title="" name="image">
          <label for="browse" class="form__label">Browse</label>
          <button class="form__button" type="submit" name="upload">Upload</button>
        </div>
          <textarea class="form__textarea" id="text" cols="40" rows="3" name="image_text" placeholder="Say something about your trip..."></textarea>
      </form>
      <div class="img-box">
        <?php

        foreach ($result as $key => $row) { ?>
        
            <span href="single.php?id=<?=$row['id']?>"><img src="data:image/png;base64, <?=$row['image']?>" alt="<?=$row['image_text']?>" />
            <p><?=$row['image_text']?></p>
            <a href="single.php?id=<?=$row['id']?>">View image</a></span>

            
       <?php } ?>
      </div>
      <div class="pagination-box">
        <?php for ($i=1; $i < $pages; $i++) { ?>
        <a type="button" href="?page=<?=$i?>"><?=$i?></a>
  
        <?php }?>
      </div>
		
</main>
	
</div><!-- End of wrapper -->
<footer class="footer">
      <p>&copy; Linas Mackonis, <?php echo date("Y"); ?></p>
</footer> 
	
</body>
</html>