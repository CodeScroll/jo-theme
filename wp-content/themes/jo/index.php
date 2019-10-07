<?php

use Library\Menu;

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

	if (is_front_page()) {
	 include locate_template('templates/homepage.php');
	} 

$terms = get_terms(
    array(
        'taxonomy'   => 'book_category',
        'hide_empty' => false,
    )
);

// Check if any term exists
if ( ! empty( $terms ) && is_array( $terms ) ) {
    // Run a loop and print them all
    foreach ( $terms as $term ) { ?>
        <a href="<?php echo esc_url( get_term_link( $term ) ) ?>">
            <?php echo $term->name; ?>
        </a><?php
    }
} 

?>

 

</body>
</html>