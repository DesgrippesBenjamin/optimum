<?php
/*
Plugin Name: Fitness managments activities
Description: This is a plugin for manage activities.
Author: Ben
Version: 1.0.0
*/

// Creat activity table in data base

function activities_database() {
    
	global $wpdb;

	$table_name = $wpdb->prefix . 'activities';
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		activity_name varchar(55) NOT NULL,
		activity_date_start DATE NOT NULL,
        activity_hours_start varchar(22) NOT NULL,
		activity_hours_end varchar(22) NOT NULL,
        comment text NOT NULL,
		activity_place INT NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	add_option('activity_db_version', '1.0');
}

register_activation_hook(__FILE__, 'activities_database');


// Creat clients réservation history table in data base

function activities_customers_history_database() {
	global $wpdb;

	$table_name = $wpdb->prefix . 'activities_customers_history';
    $table_activity = $wpdb->prefix . 'activities';
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		customer_first_name varchar(55) NOT NULL,
        customer_last_name varchar(55) NOT NULL,
		customer_phone varchar(20) NOT NULL,
		customer_email varchar(20) NOT NULL,
		customer_address varchar(20) NOT NULL,
		customer_old INT NOT NULL,
        id_activity mediumint(9) NOT NULL, 
		PRIMARY KEY  (id),
        FOREIGN KEY (id_activity) REFERENCES ".$table_activity."(id)
	) $charset_collate;";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	add_option('activities_customers_history_db_version', '1.0');
}

register_activation_hook(__FILE__, 'activities_customers_history_database');


// Creat fake data activity in activity table

function add_data_activity_test(){
    global $wpdb;
    $table_name = $wpdb -> prefix . "activities" ;
    $wpdb -> insert( $table_name,
    array(
    'activity_name' => "Yoga",
    'activity_date_start' =>  "2022-12-01",
    'activity_hours_start' => "7h15",
    'activity_hours_end' => "8h15",
    'activity_place' => 12,
    'comment' => "test"));
}
register_activation_hook(__FILE__, 'add_data_activity_test' );


// Creat fake clients réservation in clients réservation table

function add_data_customers_history_test(){
    global $wpdb;
    $table_name = $wpdb -> prefix . "activities_customers_history" ;
    $wpdb -> insert($table_name,
    array(
    'customer_first_name' => "Became",
	'customer_last_name' => "David",
	'customer_phone' => "83.25.75",
	'customer_email' => "david-became@gmail.com",
	'customer_address' => " 32 rue ici ",
	'customer_old' => 23,
	'id_activity' => 1));
}
register_activation_hook(__FILE__, 'add_data_customers_history_test' );


//Add actyvity plugin to admin

function add_plugin_activity_management_to_admin() {

	function activity_content() {
		echo "<h1>Activity management</h1>";
		echo "<h2>Activity list</h2>";
		echo "<div style='margin-right:20px'>";

		if(class_exists('WP_List_Table')) {
			require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
			require_once(plugin_dir_path( __FILE__ ) . 'activities-list-table.php');
			$activityListTable = new ActivityListTable();
			$activityListTable->prepare_items();
			$activityListTable->display();
		} else {
			echo "WP_List_Table n'est pas disponible.";
		}
		
		echo "</div>";
	}

	//This is a menu
	add_menu_page(
	'Activities', //page title
	'Activities', //menu title
	'manage_options', //capabilities
	'fitness activities management', //menu slug
	'activity_content'); //function

	//this is a submenu create activity
	add_submenu_page('fitness activities management', //parent slug
	'Add New School', //page title
	'Add New Activity', //menu title
	'manage_options', //capability
	'create_activity', //menu slug
	'activity_create'); //function

	//this is a submenu update activity
	add_submenu_page('fitness activities management', //parent slug
	'Update Activity', //page title
	'Update Activity ', //menu title
	'manage_options', //capability
	'sinetiks_schools_update', //menu slug
	'activity_update'); //function

	//this is a submenu update activity
	add_submenu_page('fitness activities management', //parent slug
	'Liste des reservations', //page title
	'Reservation ', //menu title
	'manage_options', //capability
	'sinetiks_schools_update', //menu slug
	'booking_create'); //function
}

add_action('admin_menu', 'add_plugin_activity_management_to_admin');


function show_all_activities() {
    ob_start();

	//Request SQL
    global $wpdb;
    $table_name = $wpdb->prefix . 'activities';
    $activities = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);

	//variables
	$pagename = get_query_var('pagename');

	//HTML
	echo "<div class='container'>";
	echo "<div class='row'>";

    foreach($activities as $activity) {
		if( $pagename == $activity['activity_name']){
        echo "<div class='col-sm-12 col-md-6 col-lg-4 d-flex mt-3'>";
        echo "<div class='card border-light mx-auto' style='width:320px;'>";
		echo "<h5 class='card-header text-center text-dark'>".$activity['activity_date_start']."</h5>";
        echo "<div class='card-body'>";
        echo "<p class='card-title text-dark'>".$activity['activity_name']."</p>";
        echo "<p class='card-text text-dark mb-0'>Pour ".$activity['activity_place']." personnes maximum</p>";
        echo '<p class="text-dark"> De'.$activity['activity_hours_start'].' à '.$activity['activity_hours_end'].'</p>';
        echo '<p class="text-dark"> Pour'.$activity['activity_place'].' personnes maximum</p>';
		echo '<p class="text-dark">'.$activity['comment'].'</p></div>';
        echo "<div class='card-footer text-start d-flex'>";
        echo "<a href='reserve?id=".$activity['id']."' type='submit' style='text-decoration: none;'>";
        echo "<button type='button' class='btn btn-success mt-2 mx-auto '>Reserve</button></a></div>";
        echo "</div></div>";
		}

		if (isset($_POST['submit'])) {
			booking_form();
		} 
    }
    echo "</div>";
	echo "</div>";

    return ob_get_clean();

}
add_shortcode('show_all_activities', 'show_all_activities');

// For this add_shortcode the first param is a name the short code and seconde param is a name function use
add_shortcode('show_activity', 'show_activity');

define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'activities-create.php');
require_once(ROOTDIR . 'activities-update.php');
require_once(ROOTDIR . 'booking-creat.php');


?>