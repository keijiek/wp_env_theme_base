<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width" />
  <meta name="description" content="<?php bloginfo('description'); ?>" />
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> id="top_of_page">
  <?php wp_body_open(); ?>
  <header class="bg-success text-white">
    <div class="container mx-auto">
      <h1 class="mb-0"><?php bloginfo('name'); ?></h1>
      <p class="mb-0"><?php bloginfo('description'); ?></p>
    </div>
  </header>

  <main style="min-height: 80vh;">