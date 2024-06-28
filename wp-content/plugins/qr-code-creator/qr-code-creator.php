<?php
/*
 * Plugin Name:       QR Code Creator
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       This is a plugin that's convart to QR code your post and text or link.
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

/*=======================QR Code Creator Plugin Practis Start by OOP===========================*/

class QR_Code_Creator
{
    public function __construct()
    {

        add_action('init', array($this, 'initialize'));
    }

    function initialize()
    {
        add_filter('the_content', [$this, 'display_qr_code'], 11);
    }

    function display_qr_code($content)
    {
        $current_post_url = get_permalink();
        $size = 100;
        $color = '000';
        $heading = 22;
        $final_size = apply_filters('qr_code_size', $size);
        $final_color = apply_filters('qr_code_color', $color);
        $heading = apply_filters('qr_code_heading', 'Amizing QR Code');
        $qr_code_image = "https://api.qrserver.com/v1/create-qr-code/?size={$final_size}x{$final_size}&color={$final_color}&data=" . $current_post_url;
        $newcontent = $content . "<h2>{$heading}</h2><p><img src='{$qr_code_image}'></p>";
        return $newcontent;
        //return $content . "<p> URL: {$current_post_url} </p>";
    }
}

new QR_Code_Creator();
/*=======================QR Code Creator Plugin Practis End by OOP=============================*/