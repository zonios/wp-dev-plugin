<?php

/**
 * Plugin Name:     Ratatouille
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     Mon premier plugin sous wordpress
 * Author:          Sterio
 * Author URI:      YOUR SITE HERE
 * Text Domain:     ratatouille
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Ratatouille
 */
// Your code starts here.

use App\Features\PostTypes\RecipePostType;
use App\Features\Taxonomies\RecipeTaxonomy;
use App\Features\MetaBoxes\RecipeDetailsMetabox;

require_once('autoload.php');
require_once('env.php');
require_once('helpers.php');

add_action('init', [RecipePostType::class,'register']);
add_action('init', [RecipeTaxonomy::class, 'register']);
add_action('add_meta_boxes', [RecipeDetailsMetabox::class, 'add_meta_boxes']);
// Ajout d'une action de sauvegarde lors de la sauvegarde d'un post type recipe
add_action('save_post_' . RecipePostType::$slug, [RecipeDetailsMetabox::class, 'save']);
// Ajout d'une action pour supprimé toutes les metas d'un post lorsque ce post est supprimé
add_action('delete_post', 'delete_post_metas');
