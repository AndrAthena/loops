<!DOCTYPE html>
<html lang="<?php bloginfo( 'language' ) ?>">
<head>
  <meta charset="<?php bloginfo( 'charset' ) ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php wp_title('Loops |') ?></title>
  <?php wp_head() ?>
</head>
<body <?php body_class() ?>>
  <header>
    <div class="container h-100">
      <nav class="navbar navbar-expand-lg h-100">
        <?php get_template_part( 'template-parts/custom', 'logo' ) ?>
        <?php get_template_part( 'template-parts/site', 'menu' ) ?>
      </nav>
    </div>
  </header>
  <main>