<?php

namespace include\post_types;

use \include\post_types\PostTypeBase;
use \include\taxonomies\NoticeType;


/**
 * カスタム投稿タイプの例 : お知らせ
 */
class Notices extends PostTypeBase
{
  /**
   * 定数：この投稿タイプのスラグ
   */
  private const SLUG = 'notices';

  /**
   * 定数：この投稿タイプのラベル
   */
  private const LABEL = 'お知らせ';

  /**
   * 定数：この投稿の post_per_page の値
   */
  private const POSTS_PER_PAGE = 12;

  /**
   * 定数：投稿一覧のカスタムコラムのスラグ
   */
  private const COL_NOTICE_TYPE = 'notice_type';


  /**
   * コンストラクタ
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * この投稿タイプのスラグを返す
   * @return string
   */
  static public function getSlug(): string
  {
    return self::SLUG;
  }

  /**
   * この投稿タイプの posts_per_page の値を返す
   * @return integer
   */
  static public function getPostsPerPage(): int
  {
    return self::POSTS_PER_PAGE;
  }


  /**
   * 投稿タイプを登録する
   * @return void
   */
  public function registerPostType(): void
  {
    register_post_type(
      self::SLUG,
      [
        'labels' => $this->getLabelsValue(self::LABEL),
        'public' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'supports' => ['title', 'author', 'editor', 'thumbnail'],
        'menu_position' => 5,
        'posts_per_page' => self::POSTS_PER_PAGE,
      ]
    );
  }


  /**
   * 投稿一覧のカスタムコラムの定義を返す
   * @return array
   */
  protected function getColumnDefinitions(): array
  {
    return [];
    // return [
    //   self::COL_NOTICE_TYPE => 'unko',
    // ];
  }


  public function displayColumnValues(string $columnSlug, int $postId): void
  {
    // ハンドラー配列の定義
    $handlers = [
      self::COL_NOTICE_TYPE => fn($postId) => $this->noticeTypeColumnValue($postId),
    ];

    // $handlers の key が $columnSlug と合致したら $handlers の value の関数を実行
    if (isset($handlers[$columnSlug])) {
      echo $handlers[$columnSlug]($postId);
    } else {
      echo "unknown column {$columnSlug}";
    }
  }

  private function noticeTypeColumnValue($postId): string
  {
    $terms = get_the_terms($postId, NoticeType::SLUG);

    // WP_Error が返ってきた場合の処理
    if (is_wp_error($terms)) {
      return $terms->get_error_message();
    }
    // ターム(配列)をjoinして表示
    return $terms ? esc_html(implode(', ', wp_list_pluck($terms, 'name'))) : '-';
  }
}
