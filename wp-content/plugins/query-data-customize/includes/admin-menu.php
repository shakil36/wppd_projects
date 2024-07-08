<?php

class Admin_Menu_Query_Data_Customize
{
    public function __construct()
    {
        add_action('admin_menu', [$this, "admin_menu_customize"]);
    }

    public function admin_menu_customize()
    {
        add_menu_page(
            'Academy WP Plugin',
            'Academy WP Plugin',
            'manage_options',
            'academy_wp_plugin_callback',

            array($this, 'academy_wp_plugin_callback'),

        );
    }



    public function academy_wp_plugin_callback()
    {
        $post_args = array(
            'posts_type' => 'post',
        );

        if (isset($_GET['customized_category']) && $_GET['customized_category'] != '-1') {
            $post_args['tax_query'] = array(
                array(
                    'taxonomy' => 'category',
                    'field' => 'term_id',
                    'terms' => $_GET['customized_category'],

                ),
            );
        }

        $posts = get_posts($post_args);

        $terms = get_terms(
            array(
                'taxonomy' => 'category',
            )
        );


        include_once __DIR__ . "/templates/academy-wp-plugin-callback.php";
    }
}