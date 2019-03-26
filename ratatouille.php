<?php

use App\Features\PostTypes\RecipePostType;
use App\Features\Taxonomies\RecipeTaxonomy;
use App\Features\MetaBoxes\RecipeDetailsMetabox;

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

require_once('autoload.php');

add_action('init', [RecipePostType::class,'register']);
add_action('init', [RecipeTaxonomy::class, 'register']);
add_action('add_meta_boxes_recipe', [RecipeDetailsMetabox::class, 'add_meta_box']);