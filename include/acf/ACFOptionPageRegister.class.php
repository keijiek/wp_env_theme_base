<?php


namespace include\acf;

class ACFOptionPageRegister
{
  public function __construct()
  {
    if (function_exists('acf_add_options_page')) {
    } else {
      add_action('admin_menu', [$this, 'register_menu_without_acf']);
    }
  }

  public function register_option_page(): void
  {
    if (!function_exists('acf_add_options_page')) {
      return;
    }

    acf_add_options_page([
      'page_title' => 'サイト設定',
      'menu_title' => 'サイト設定',
      'menu_slug' => 'site-options',
      'capability' => 'manage_options',
      'position' => 80,
      'icon_url' => 'dashicons-admin-settings',
      'redirect' => false,
      'post_id' => 'site-options',
      'autoload' => true,
      'update_button' => '設定を保存',
      'updated_message' => '設定が保存されました',
    ]);
  }


  public function register_menu_without_acf(): void
  {
    add_menu_page(
      'サイト設定',
      'サイト設定',
      'manage_options',
      'site-options',
      function () {
        echo '<div class="wrap"><h1>サイト設定</h1><p>この設定ページを使用するにはACFプラグインのPRO版が必要です。</p></div>';
      },
      'dashicons-admin-settings',
      80
    );
  }
}
