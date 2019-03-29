<?php
/**
 * fonction pour rendre une view
 *
 * @param string $path chemin du fichier à partir du dossier views sans l'extention .html.php
 * @param array $data tableau de données qui sont passées dans la view
 * @return void
 */

function view($path, $data = array()){
  extract($data);
  include(RAT_VIEW_DIR . $path . '.html.php');
}

/**
 * Extrait la valeur dans un tableau si la valeur existe dans ce tableau
 * cela permet de ne pas avoir d'erreur lorsque l'on créer un nouveau post
 *
 * @param string $key la meta key dans la base de donnée
 * @param array $data le tableau resultant de get_post_meta
 * @return string la valeur si la clé a été trouvé sinon un string vide
 */
function extract_data_attr(string $key, array $data){
  // Vérification que la clé exist bien dans le tableau
  if (array_key_exists($key, $data)) {
    // on renvoi la valeur et on en profite pour échapper la valeur pour la sécurité
    return esc_attr($data[$key][0]);
  }
  return '';
}

/**
 * fonction qui renvoi la data sécurisé si elle existe dans le tableau
 *
 * @param  $key la valeur du name dans le formulaire
 * @param  $data le tableau dans lequel chercher ex: $_POST
 */
function post_data($key, $data)
{
  if (array_key_exists($key, $data)){
    return sanitize_text_field($data[$key]);
  }
  return '';
}

/**
 * Suppression de toutes les meta d'un post
 *
 * @param  $post_id
 * @return void
 */
function delete_post_metas($post_id)
{
  $metas = get_post_meta($post_id);
  foreach ($metas as $key => $value) {
    delete_post_meta($post_id, $key);
  }
} 

/**
 * Enregistrement de toutes les valeurs du tableau en utilisant leur key comme meta key dans la base de donnée
 *
 * @param [type] $post_id id du post courant
 * @param [type] $data tableau de valeurs de la metabox
 * @return void
 */
function update_post_metas($post_id, $data){
  foreach ($data as $key => $value) {
    update_post_meta($post_id, $key, $value);
  }
}