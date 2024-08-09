<?php
/**
 * Plugin Name: Custom Taxonomy Plugin
 * Plugin URI: https://example.com/plugins/
 * Description: This is a plugin that's query data and custome taxonomy practice.
 * Version: 0.1.1
 * Author: Shakil Ahamed
 * Author URI: https://author.example.com/
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI: https://example.com/my-plugin/
 * Text Domain: my-basics-plugin-practis-with-wedevs-academy
 * Domain Path: /languages
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

class Custom_Taxonomy_Create
{

    public function __construct()
    {
        add_action('init', [$this, 'register_post_type']);
        add_action('init', [$this, 'register_taxonomy']);
        add_filter('the_content', [$this, 'add_movie_details']);
        add_filter('the_title', [$this, 'add_movie_year'], 10, 2);

        add_filter('the_content', [$this, 'show_related_movies'], 10, 2);
    }

    public function register_post_type()
    {
        register_post_type('movie', [
            'label' => 'Movie',
            'labels' => [
                'name' => 'Movies',
                'singular_name' => 'Movie',
                'add_new' => 'Add New Movie',
            ],
            'public' => true,
            'has_arvhive' => true,
            'taxonomies' => ['genres', 'actor', 'director', 'years'],
            'supports' => ['title', 'editor', 'thumbnail'],
        ]);
    }

    public function register_taxonomy()
    {
        register_taxonomy('genres', ['movie'], [
            'labels' => [
                'name' => 'Genre',
                'singular_name' => 'Genre',
            ],
            'rewrite' => [
                'slug' => 'movie_genre',
            ],
            'hierarchical' => true,
            'show_admin_column' => true,
        ]);
        register_taxonomy('actor', ['movie'], [
            'labels' => [
                'name' => 'Actors',
                'singular_name' => 'Actor',
            ],
            'rewrite' => [
                'slug' => 'movie_actors',
            ],
            'hierarchical' => true,
            'show_admin_column' => true,
        ]);
        register_taxonomy('director', ['movie'], [
            'labels' => [
                'name' => 'Directors',
                'singular_name' => 'Director',
            ],
            'rewrite' => [
                'slug' => 'movie_director',
            ],
            'hierarchical' => true,
            'show_admin_column' => true,
        ]);
        register_taxonomy('years', ['movie'], [
            'labels' => [
                'name' => 'Years',
                'singular_name' => 'Year',
            ],
            'rewrite' => [
                'slug' => 'movie_year',
            ],
            'hierarchical' => false,
            'show_admin_column' => true,
        ]);
    }

    /*==================================add_movie_details_part start=====================================*/
    public function add_movie_details($content)
    {
        $post = get_post(get_the_ID());

        if ($post->post_type !== 'movie') {
            return $content;

        }
        $genre = get_the_term_list(get_the_ID(), 'genres', '', ', ');
        $actor = get_the_term_list(get_the_ID(), 'actor', '', ', ');
        $director = get_the_term_list(get_the_ID(), 'director', '', ', ');
        $year = get_the_term_list(get_the_ID(), 'years', '', ', ');

        $info = '<ul>';
        if (!is_wp_error($genre)) {
            $info .= '<li>';
            $info .= '<strong>Genre:</strong> ';
            $info .= $genre;
            $info .= '</li>';

        }
        if ($actor) {
            $info .= '<li>';
            $info .= '<strong>Actor:</strong> ';
            $info .= $actor;
            $info .= '</li>';

        }
        if ($director) {
            $info .= '<li>';
            $info .= '<strong>Director:</strong> ';
            $info .= $director;
            $info .= '</li>';

        }
        if (!is_wp_error($year) && $year) {
            $info .= '<li>';
            $info .= '<strong>Year:</strong> ';
            $info .= $year;
            $info .= '</li>';

        }

        $info .= '</ul>';
        return $content . $info;
    }
    /*==================================add_movie_details_part end=====================================*/
    /*==================================add year part start=====================================*/

    public function add_movie_year($title, $id)
    {
        $post = get_post(get_the_ID());

        if ($post->post_type !== 'movie') {
            return $title;

        }
        $years = get_the_terms($post, 'years');

        if ($years) {
            $title .= ' (' . $years[0]->name . ')';
        }


        return $title;
    }
    /*==================================add year part end=====================================*/
    /*==================================show_related_movies start=====================================*/
    public function show_related_movies($content)
    {
        $genre = get_the_terms(get_the_ID(), 'genre');

        if (!$genre) {
            return $content;
        }
        $query = new WP_Query([
            'post_type' => 'movie',
            'post__not_in' => [get_the_ID()],
            'tex_query' => [
                'relation' => 'OR',
                [
                    'texonomy' => 'genre',
                    'terms' => wp_list_pluck($genre, 'term_id'),
                ],
            ],
        ]);

        if (!$query->have_posts()) {
            return $content;
        }

        $related = '<h3>Related Movies</h3>';
        $related .= '<ul>';

        foreach ($query->get_posts() as $movie) {
            $related .= sprintf(
                '<li><a href="%s">%s</a></li>',
                get_permalink($movie),
                get_the_title($movie)
            );
        }


        return $content . $related;
    }
    /*==================================show_related_movies start=====================================*/
}

new Custom_Taxonomy_Create();