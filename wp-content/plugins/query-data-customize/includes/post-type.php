<?php

/**
 * Here we will create custom type post
 */

class Admin_menu_post_type_customize
{

    public function __construct()
    {
        add_action('init', [$this, 'initialize']);
    }

    public function initialize()
    {
        register_post_type(
            'myself_post',
            array(
                'public' => true,
                'labels' => array(

                    'name' => "weDevs Post",
                    'singular_name' => "wedevs",
                    'add_new' => "Create new Post",
                    'add_new_item' => "Creating a new Post",
                    'edit_items' => "Edit Post",
                    'search_items' => "Search Post",
                    'menu_name' => "wedevs",
                ),
                'menu_position' => 82,
                'menu_icon' => 'dashicons-admin-home',
                'supports' => ['title', 'editor', 'thumbnail'],
                'rewrite' => [
                    'slug' => 'wedevs',
                ],
                'show_in_rest' => true,
            )
        );

        add_shortcode('wedevs-posts', [$this, 'display_wedevs_posts']);
    }

    public function display_wedevs_posts()
    {
        ob_start();
        include __DIR__ . '/templates/wedevs-posts.php';
        return ob_get_clean();
    }
}
