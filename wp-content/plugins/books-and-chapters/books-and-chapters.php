<?php

/**
 * Plugin Name: Books & Chapters
 * Description: A nice project using books and chapters
 * Author URI: https://shakil.me
 * Author: Shakil Ahamed
 */


class Books_And_Chapters
{
    public function __construct()
    {
        add_action('init', [$this, 'init']);
        //add_action('init', [$this, 'cptui_register_my_cpts_book']);
    }

    public function init()
    {
        add_filter('the_content', [$this, 'show_chapters_in_book']);
        add_filter('the_content', [$this, 'show_book_in_chapter']);
        add_filter('post_type_link', [$this, 'chapter_cpt_slug_fix'], 1, 2);
        add_filter('the_content', [$this, 'show_related_books_by_meta']);
        //add_filter('the_content', [$this, 'show_related_books_by_taxonomy']);
    }

    /*=======================show_related_books function start cannot work this code===================== */
    /*=======================show_related_books function start cannot work this code p===================== */

    // public function show_related_books_by_taxonomy($content)
    // {
    //     if (is_singular('book')) {
    //         $book_id = get_the_ID();
    //         $genres = wp_get_post_terms($book_id, 'genre');
    //         $genre = $genres[0]->term_id;
    //         $args = [
    //             'post_type' => 'book',
    //             'post__not_in' => [$book_id],
    //             'tax_query' => [
    //                 [
    //                     'taxonomy' => 'genre',
    //                     'field' => 'term_id',
    //                     'terms' => $genre
    //                 ]
    //             ]
    //         ];
    //         $books = get_posts($args);
    //         if ($books) {
    //             $content .= '<h2>Related Books by Meta taxonomy</h2>';
    //             $content .= '<ul>';
    //             foreach ($books as $book) {
    //                 $content .= '<li><a href="' . get_permalink($book->ID) . '">' . $book->post_title . '</a></li>';

    //             }
    //             $content .= '</ul>';
    //         }
    //     }
    //     return $content;
    // }

    /*=======================show_related_books function start cannot work this code===================== */
    /*=======================show_related_books function start cannot work this code p===================== */
    function show_related_books_by_meta($content)
    {
        if (is_singular('book')) {
            $book_id = get_the_ID();
            $genre = get_post_meta($book_id, 'genre', true);
            $args = [
                'post_type' => 'book',
                'post__not_in' => [$book_id],
                'meta_key' => 'genre',
                'meta_value' => $genre
            ];
            $books = get_posts($args);
            if ($books) {
                $content .= '<h2>Related Books By Meta Field </h2>';
                $content .= '<ul>';
                foreach ($books as $book) {
                    $content .= '<li><a href="' . get_permalink($book->ID) . '">' . $book->post_title . '</a></li>';
                }
                $content .= '</ul>';
            }
        }
        return $content;
    }
    /*=======================show_related_books function start cannot work this code p===================== */
    /*=======================show_related_books function end ### Cannot work this code===================== */
    public function chapter_cpt_slug_fix($post_link, $chapter)
    {
        if (get_post_type($chapter) == 'chapter') {
            $book_id = get_post_meta($chapter->ID, 'book', true);
            $book = get_post($book_id);
            $post_link = str_replace('%book%', $book->post_name, $post_link);
        }
        return $post_link;

    }

    public function show_book_in_chapter($content)
    {
        if (is_singular('chapter')) {
            $chapter_id = get_the_ID();
            $book_id = get_post_meta($chapter_id, 'book', true);
            $book = get_post($book_id);
            $image = get_the_post_thumbnail($book_id, 'medum');
            //$heading = "<h2>Book: <a href = '" . get_permalink($book_id) . "'>" . $book->post_title . "</a></h2>";
            $image_html = '<p><a href = "' . get_permalink($book_id) . '">' . $image . '</a></p>';
            $content = $image_html . $content;
        }

        return $content;
    }
    public function show_chapters_in_book($content)
    {
        if (is_singular('book')) {
            $book_id = get_the_ID();

            $args = array(
                'post_type' => 'chapter',
                'meta_query' => [
                    [
                        'key' => 'book',
                        'value' => $book_id,
                        'compare' => '=',
                    ]

                ],
                'meta_key' => 'chapter_number',
                'orderby' => 'meta_value_num',
                'order' => 'ASC',
            );
            $chapters = get_posts($args);
            if ($chapters) {
                $heading = '<h1>Chepters</h1>';
                $content = $content . $heading;
                $content .= '<ul>';
                foreach ($chapters as $chapter) {
                    $content .= '<li><a href="' . get_permalink($chapter->ID) . '">' . $chapter->post_title . '</a></li>';
                }
                $content .= '</ul>';
            }

        }
        return $content;
    }


    // function cptui_register_my_cpts_book()
    // {

    //     /**
    //      * Post Type: Books.
    //      */

    //     $labels = [
    //         "name" => esc_html__("Books", "hello-elementor"),
    //         "singular_name" => esc_html__("book", "hello-elementor"),
    //         "add_new" => esc_html__("Add new Book", "hello-elementor"),
    //     ];

    //     $args = [
    //         "label" => esc_html__("Books", "hello-elementor"),
    //         "labels" => $labels,
    //         "description" => "",
    //         "public" => true,
    //         "publicly_queryable" => true,
    //         "show_ui" => true,
    //         "show_in_rest" => true,
    //         "rest_base" => "",
    //         "rest_controller_class" => "WP_REST_Posts_Controller",
    //         "rest_namespace" => "wp/v2",
    //         "has_archive" => false,
    //         "show_in_menu" => true,
    //         "show_in_nav_menus" => true,
    //         "delete_with_user" => false,
    //         "exclude_from_search" => false,
    //         "capability_type" => "post",
    //         "map_meta_cap" => true,
    //         "hierarchical" => false,
    //         "can_export" => false,
    //         "rewrite" => ["slug" => "book", "with_front" => true],
    //         "query_var" => true,
    //         "supports" => ["title", "editor", "thumbnail"],
    //         "show_in_graphql" => false,
    //     ];

    //     register_post_type("book", $args);
    // }


}

new Books_And_Chapters();