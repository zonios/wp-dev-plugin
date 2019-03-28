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
      'name' => __('Type de recettes'),
      'singular_name' => __('Type de recette'),
      'search_items' => __('Search Type de recettes'),
      'all_items' => __('All Type de recettes'),
      'parent_item' => __('Parent Type de recette'),
      'parent_item_colon' => __('Parent Type de recette:'),
      'edit_item' => __('Edit Type de recette'),
      'update_item' => __('Update Type de recette'),
      'add_new_item' => __('Add New Type de recette'),
      'new_item_name' => __('New Type de recette Name'),
      'menu_name' => __('Type de recette'),
    ];

    $options = [
      'hierarchical' => true,
      'labels' => $labels,
      'show_ui' => true,
      'show_admin_column' => true,
      'query_var' => true,
      'rewrite' => ['slug' => 'recette']
    ];

    register_post_type(self::$slug, $options);
  }
}