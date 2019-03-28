<?php
namespace App\Features\MetaBoxes;
use App\Features\PostTypes\RecipePostType;
class RecipeDetailsMetabox {
  public static $slug = 'recipe_details_metabox';
  /**
   * Ajout d'une méta box au type de contenu qui sont passer dans le tableau $screens
   * https://developer.wordpress.org/plugins/metadata/custom-meta-boxes/
   *
   * @return void
   */
  public static function add_meta_boxes()
  {
    $screens = [RecipePostType::$slug,'post'];
    foreach ($screens as $screen) {
      add_meta_box(
        self::$slug,           // Unique ID
        __("Détails de la cette lalalala"),  // Box title
        [self::class, 'render'],  // Content callback, must be of type callable
        $screen                   // Post type
      );
    }
  }
  /**
   * Fonction pour rendre le code html dans la metabox
   *
   * @return void
   */
  public static function render(){
    $data = get_post_meta(get_the_ID());
    $time = extract_data_attr('rat_time_preparation',$data);
    $num_person = extract_data_attr('rat_person_number', $data);
    view('metaboxes/recipe-detail', compact('time','num_person'));
  }
  /**
   * sauvegarde des données de la métabox
   *
   * @param [type] $post_id reçu par le do_action
   * @return void
   */
  public static function save($post_id){
    // On verifie que $_POST ne soit pas vide pour effectuer l'action uniquement à la sauvegarde du post Type
    if (count($_POST) != 0) {
      $data = [
        'rat_time_preparation' => post_data('rat_time_preparation', $_POST),
        'rat_person_number' => post_data('rat_person_number', $_POST)
      ];
      // enregistrement de toutes les valeurs grâce au helper
      update_post_metas($post_id, $data);
    }
  }
}