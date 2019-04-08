<?php

use App\Features\PostTypes\RecipePostType;
use App\Features\Taxonomies\RecipeTaxonomy;
use App\Features\MetaBoxes\RecipeDetailsMetabox;
use App\Features\Widgets\Widget;
use App\Features\Sections\Section;
use App\Features\Pages\Page;
use App\Http\Controllers\MailController;
use App\Setup;
use App\Database\Database;

add_action('init', [RecipePostType::class, 'register']);
add_action('init', [RecipeTaxonomy::class, 'register']);
add_action('add_meta_boxes', [RecipeDetailsMetabox::class, 'add_meta_boxes']);
add_action('save_post_' . RecipePostType::$slug, [RecipeDetailsMetabox::class, 'save']);
add_action('delete_post', 'delete_post_metas');
add_action('widgets_init',[Widget::class,'init']);
add_action('admin_init',[Section::class,'init']);
add_action('admin_menu',[Page::class, 'init']);
add_action('admin_action_send-mail',[MailController::class, 'send']);
add_action('admin_action_mail-delete', [MailController::class, 'delete']);
add_action('admin_action_mail-update', [MailController::class, 'update']);
add_action('admin_init', [Setup::class, 'start_session']);

register_activation_hook(__DIR__ . '/ratatouille.php', [Database::class, 'init']);

add_action('admin_enqueue_scripts', [Setup::class, 'enqueue_scripts']);