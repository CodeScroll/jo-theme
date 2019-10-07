<?php

use Library\Menu;
use Library\Post;
use Library\Page;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Blog Template for Bootstrap</title>

  <?php wp_head();?>
</head>

<body>

<?php

	$menu = new Menu();
	$menu->getMenu();

	$post = new PostCustom();
  print_r($post->getAllPostTypes());
  $allPosts = $post->listPosts();

  foreach ($allPosts as $key => $value) {
    echo '<a href="'.$value['link'].'">'.$value['title'].'</a>';
  }
?>

</body>
</html>