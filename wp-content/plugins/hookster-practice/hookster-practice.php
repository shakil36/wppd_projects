<?php
/*
 * Plugin Name:       Hookster
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       This is a plugin that's hooks and filter practice.
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


/*=====###############################=== hooks & filter practice Start ====#######################======*/

class Hookster_Practice_Plugin
{
    public function __construct()
    {
        add_action('init', [$this, 'initialize']);
    }

    function initialize()
    {
        add_filter('the_content', [$this, 'change_content']);
        add_filter('the_content', [$this, 'change_content1']);
        add_filter('the_content', [$this, 'change_content2']);
        add_filter('the_content', [$this, 'change_content3']);
        add_action('wp_footer', [$this, 'add_footer_content']);
        add_action('wp_head', [$this, 'add_header_content']);
        add_filter('the_title', [$this, 'change_title'], 10, 2);
        add_filter('the_date', [$this, 'change_date'], 10, 4);
        add_filter('logout_redirect', [$this, 'logout_change_url'], 10, 3);
        add_filter('qr_code_size', [$this, 'change_qr_code_size']);
        add_filter('qr_code_color', [$this, 'change_qr_code_color']);
    }

    function change_qr_code_color($color)
    {
        return;
    }
    function change_qr_code_size($size)
    {
        return 70;
    }
    function logout_change_url($url, $redir_params, $user)
    {
        return "http://wps.local/sample-page/";
    }
    function change_date($date, $format, $before, $after)
    {
        return $format;
    }

    function change_title($title, $post_id)
    {
        $after_change_title = $title . " -- Second Plugin-- {$post_id}";
        return $after_change_title;
    }
    function add_header_content()
    {
        ?>
        <style>
            body {
                background-color: ffffff;
            }
        </style>
        <?php
    }
    function add_footer_content()
    {
        ?>
        <script>
            consol.log(script test);
        </script>
        <?php
    }
    function change_content($content)
    {
        return $content . "<p>First content change</p>";
    }

    function change_content1($content)
    {
        return $content . "<p>Second content change</p>";
    }

    function change_content2($content)
    {
        return $content . "<p>third content change</p>";
    }

    function change_content3($content)
    {
        return $content . "<p>Fourth content change</p>";
    }
}
new Hookster_Practice_Plugin();
/*=====###############################=== hooks & filter practice end ===#######################======*/