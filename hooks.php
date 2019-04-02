<?php

use App\Features\PostTypes\RecipePostType;
use App\Features\Taxonomies\RecipeTaxonomy;
use App\Features\MetaBoxes\RecipeDetailsMetabox;
use App\Features\Widgets\Widget;
use App\Features\Sections\Section;
use App\Features\Pages\Page;
use App\Features\Pages\SendMail;
use App\Setup;

add_action('init', [RecipePostType::class, 'register']);
add_action('init', [RecipeTaxonomy::class, 'register']);
add_action('add_meta_boxes', [RecipeDetailsMetabox::class, 'add_meta_boxes']);
add_action('save_post_' . RecipePostType::$slug, [RecipeDetailsMetabox::class, 'save']);
add_action('delete_post', 'delete_post_metas');
add_action('widgets_init',[Widget::class,'init']);
// Ajout d'une section dans la page reading (lecture) pour choisir le nombre de recette à afficher sur la home page
add_action('admin_init',[Section::class,'init']);
add_action('admin_menu',[Page::class, 'init']);
add_action('admin_action_send-mail',[SendMail::class, 'send_mail']);
add_action('admin_init', [Setup::class, 'start_session']);