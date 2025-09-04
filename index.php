<?php
get_header();

if (have_posts()) {
  while (have_posts()) {
    the_post();
    // 投稿の内容を表示するためのコード
?>
    <section class="container mx-auto mt-5">
      <?php
      the_content();
      ?>
    </section>
    <section class="container mx-auto mt-5">
      <?php
      $phone = get_option('contact_address', []);
      vardump($phone);
      ?>
    </section>
<?php
  }
}

get_footer();
