<?php
use Elementor\Core\Common\Modules\Connect\Admin;

/*
 * Plugin Name: Query Data & Customize
 * Plugin URI: https://example.com/plugins/the-basics/
 * Description: This is a plugin that's query data and custome colum practice.
 * Version: 1.0.0
 * Requires at least: 5.2
 * Requires PHP: 7.2
 * Author: Shakil Ahamed
 * Author URI: https://author.example.com/
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI: https://example.com/my-plugin/
 * Text Domain: my-basics-plugin-practis-with-wedevs-academy
 * Domain Path: /languages
 */


class Query_Data_Customize
{
    private static $instance;

    public static function get_instance()
    {

        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct()
    {
        $this->require_classes();

    }

    private function require_classes()
    {
        require_once __DIR__ . "/includes/admin-menu.php";
        require_once __DIR__ . "/includes/post-column.php";
        require_once __DIR__ . "/includes/post-type.php";

        new Admin_Menu_Query_Data_Customize();
        new Admin_Menu_Query_Data_Customize_post_column();
        new Admin_menu_post_type_customize();
    }
}

Query_Data_Customize::get_instance();



//class Query_Data_Customize
// {

//     // Constructor
//     public function __construct()
//     {
//         $this->init_hooks();
//         $this->require_classes();
//     }

//     // Initialize hooks and filters
//     private function init_hooks()
//     {
//         add_action('admin_menu', [$this, 'add_admin_menu']);
//         add_filter('some_filter', [$this, 'custom_filter_function']);
//     }

//     // Include necessary classes
//     private function require_classes()
//     {
//         require_once __DIR__ . "/includes/admin-menu.php";
//     }

//     // Example method to add an admin menu
//     public function add_admin_menu()
//     {
//         new Admin_Menu_Query_Data_Customize();
//     }

//     // Example filter function
//     public function custom_filter_function($content)
//     {
//         // Modify $content as needed
//         return $content;
//     }
// }

// // Initialize the class
// new Query_Data_Customize();