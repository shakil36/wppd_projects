<?php
/*
 * Plugin Name:       Word Counter
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       This is a plugin that's refine your post and text or page.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Shakil Ahamed
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       my-basics-plugin-practis-with-wedevs-academy
 * Domain Path:       /languages
 */


/*============================object Orinted Programming Start==================================*/

class word_counter_wpd
{
    public function __destruct()
    {
        add_action('init', array($this, 'initialize'));
    }

    function initialize()
    {
        add_filter('the_title', [$this, 'word_counter_change_title']);
        add_filter('the_content', [$this, 'word_counter_change_content'], 9);
    }

    function word_counter_change_title($post_title)
    {   //return uppercase
        return strtoupper($post_title);
    }

    function word_counter_change_content($post_content)
    //find word count
    {
        $content = strip_tags($post_content);
        $word_count = str_word_count($content);

        //approximate reading time
        $reading_time = ceil($word_count / 200);
        return $post_content . "<p>{$word_count} words, approximate reading time = {$reading_time} munites </p>";
    }
}

new word_counter_wpd();

/*============================object Orinted Programming End==================================*/


// /*============================add action hooks procidoural waye with wedevs academy start==================================*/
// add_filter('the_title', 'refine_post_change_title');

// function refine_post_change_title($post_title)
// {   //return uppercase
//     return strtoupper($post_title);
// }

// add_filter('the_content', 'refine_post_change_content');
// function refine_post_change_content($post_content)
// //find word count
// {
//     $content = strip_tags($post_content);
//     $word_count = str_word_count($content);

//     //approximate reading time
//     $reading_time = ceil($word_count / 200);
//     return $post_content . "<p>{$word_count} words, approximate reading time = {$reading_time} munites </p>";
// }
// /*============================add action hooks procidoural waye with wedevs academy end==================================*/