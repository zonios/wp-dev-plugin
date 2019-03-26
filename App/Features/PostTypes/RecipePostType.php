<?php 
namespace App\Features\PostTypes;
class RecipePostType
{
  public static $slug = 'recipe';
  /**
   * Enregistrement du type de contenu recipe
   *
   * @return void
   */
  public static function register(){

    $labels = [
      'name' => __('Recette'),
      'singular_name' => __('Recette'),
      'add_new' => __('Ajouter une nouvelle rerececette')
    ];

    $options = [
      'labels' => $labels,
      'description' => '',
      'public' => true,
      'hierarchical' => false,
      'exclude_from_search' => null,
      'publicly_queryable' => null,
      'show_ui' => null,
      'show_in_menu' => null,
      'show_in_nav_menus' => null,
      'show_in_admin_bar' => null,
      'menu_position' => null,
      'menu_icon' => null,
      'capability_type' => 'post',
      'capabilities' => array(),
      'map_meta_cap' => null,
      'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
      'register_meta_box_cb' => null,
      'taxonomies' => array(),
      'has_archive' => false,
      'rewrite' => true,
      'query_var' => true,
      'can_export' => true,
      'delete_with_user' => null,
      'show_in_rest' => true,
      'rest_base' => false,
      'rest_controller_class' => false,
      '_builtin' => false,
      '_edit_link' => 'post.php?post=%d'
    ];

    register_post_type(self::$slug, $options);
  }
}