<?php
    

//Function create

function booking_create() {

    //Request SQL get activity
    global $wpdb;
    $table_name = $wpdb->prefix . 'activities';
    $activities = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);

    //Request SQL get booking
    global $wpdb;
    $table_name = $wpdb->prefix . 'activities_customers_history';
    $bookings = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);
    $bookingsCount = $wpdb->get_results("SELECT COUNT(customer_first_name) FROM $table_name", ARRAY_A);


    // insert data in table
	if (isset($_POST['activities_customers_history'])) {
		$customer_first_name = sanitize_text_field($_POST["customer_first_name"]);
		$customer_last_name = sanitize_text_field($_POST["customer_last_name"]);
		$customer_phone = sanitize_text_field($_POST["customer_phone"]);
        $customer_email = sanitize_text_field($_POST["customer_email"]);
        $customer_address = sanitize_text_field($_POST["customer_address"]);
        $customer_old = sanitize_text_field($_POST["customer_old"]);
        $id_activity = sanitize_text_field($_POST["id_activity"]);
		
		if ($customer_first_name != '' && $customer_last_name != '' && $customer_phone  != '' && $customer_email !='' && $customer_address !='' && $customer_old  != 0 && $id_activity  != 0) {
			global $wpdb;

			$table_name = $wpdb->prefix . 'activities_customers_history';
	
			$wpdb->insert( 
				$table_name,
				array( 
					'customer_first_name' => $customer_first_name,
					'customer_last_name' => $customer_last_name,
					'customer_phone' => $customer_phone,
                    'customer_email' => $customer_email,
                    'customer_address' => $customer_address,
                    'customer_old' => $customer_old,
                    'id_activity' => $id_activity,
				) 
			);

			echo "<h4>booking is créate</h4>";
		}
	}
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/management-activities/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Add New booking</h2>
        <form method="POST" class="form">
            <div class="form-part">
                <label for="customer_first_name" class="label-creat-activity">Nom:</label>
                <input type="text" name="customer_first_name"  class="ss-field-width" />
            </div>
            <div class="form-part">
                <label for="customer_last_name" class="label-creat-activity">Prénom:</label>
                <input type="text" name="customer_last_name" class="ss-field-width" />
            </div>
            <div class="form-part">
                <label for="customer_phone" class="label-creat-activity">Telephone:</label>
                <input type="text" name="customer_phone" class="ss-field-width" />
            </div>
            <div class="form-part">
                <label for="customer_email" class="label-creat-activity">Email:</label>
                <input type="email" name="customer_email" class="ss-field-width" />
            </div>
            <div class="form-part">
                <label for="customer_address" class="label-creat-activity">Adress:</label>
                <input type="text" name="customer_address" class="ss-field-width" />
            </div>
            <div class="form-part">
                <label for="customer_old" class="label-creat-activity">Age:</label>
                <input type="number" name="customer_old" class="ss-field-width" />
            </div>
            <div class="form-part">
                <label for="id_activity" class="label-creat-activity">Test id Activités:</label>
                <input type="text" name="id_activity" class="ss-field-width" />
            </div>
            <input type='submit' name="activities_customers_history" value='Crée' class='button'>
        </form>
    </div>
    <?php

    //variables

	//HTML
	echo "<div class='container'>";
	echo "<div class='row'>";
    foreach($activities as $activity) {
        if($activity['activity_place']) {
            echo "<table style='border: 2px solid black; margin: 2em 1em; width: 70%;'>";
                echo "<thead'>";
                    echo "<tr>";
                        echo "<th style='color: black'>".$activity['activity_name']. ' Le '.$activity['activity_date_start'].' de '.$activity['activity_hours_start'].' à '.$activity['activity_hours_end']. "</th>";
                        echo "<th style='color: black'>".'Nombres de places'.' '.$activity['activity_place']. "</th>";

                    echo "</tr>";
                    echo "<tr>";
                        echo "<th style='border: 1px solid black'>" .'Nom'."</th>";
                        echo "<th style='border: 1px solid black'>" .'Prénom'."</th>";
                        echo "<th style='border: 1px solid black'>" .'Telephone'."</th>";
                        echo "<th style='border: 1px solid black'>" .'Mail'."</th>";
                        echo "<th style='border: 1px solid black'>" .'Adresse'."</th>";
                        echo "<th style='border: 1px solid black'>" .'Ages'."</th>";
                        echo "<th style='border: 1px solid black'>" .'test activiter'."</th>";
                    echo "</tr>";
                echo "</thead>";
                foreach($bookings as $booking) {
                    if($booking['id_activity'] === $activity['id']){
                echo "<tbody>";
                    echo "<tr style='border: 2px solid black'>";
                        echo "<td style='border: 1px solid black; text-align: center; color: green; font-weight: bold;'>".$booking['customer_first_name']."</td>";
                        echo "<td style='border: 1px solid black; text-align: center; color: green; font-weight: bold;'>".$booking['customer_last_name']."</td>";
                        echo "<td style='border: 1px solid black; text-align: center; color: green; font-weight: bold;'>".$booking['customer_phone']."</td>";
                        echo "<td style='border: 1px solid black; text-align: center; color: green; font-weight: bold;'>".$booking['customer_email']."</td>";
                        echo "<td style='border: 1px solid black; text-align: center; color: green; font-weight: bold;'>".$booking['customer_address']."</td>";
                        echo "<td style='border: 1px solid black; text-align: center; color: green; font-weight: bold;'>".$booking['customer_old']."</td>";
                        echo "<td style='border: 1px solid black; text-align: center; color: green; font-weight: bold;'>".$booking['id_activity']."</td>";
                    echo "</tr>";
                echo "</tbody>";
                    }
                }
            echo "</table>";
        } 
    }
}

function booking_form() {
	ob_start();

	 // insert data in table
     if (isset($_POST['activities_customers_history'])) {
		$customer_first_name = sanitize_text_field($_POST["customer_first_name"]);
		$customer_last_name = sanitize_text_field($_POST["customer_last_name"]);
		$customer_phone = sanitize_text_field($_POST["customer_phone"]);
        $customer_email = sanitize_text_field($_POST["customer_email"]);
        $customer_address = sanitize_text_field($_POST["customer_address"]);
        $customer_old = sanitize_text_field($_POST["customer_old"]);
        $id_activity = sanitize_text_field($_POST["id_activity"]);
		
		if ($customer_first_name != '' && $customer_last_name != '' && $customer_phone  != '' && $customer_email !='' && $customer_address !='' && $customer_old  != 0 && $id_activity  != 0) {
			global $wpdb;

			$table_name = $wpdb->prefix . 'activities_customers_history';
	
			$wpdb->insert( 
				$table_name,
				array( 
					'customer_first_name' => $customer_first_name,
					'customer_last_name' => $customer_last_name,
					'customer_phone' => $customer_phone,
                    'customer_email' => $customer_email,
                    'customer_address' => $customer_address,
                    'customer_old' => $customer_old,
                    'id_activity' => $id_activity,
				) 
			);

			echo "<h4>booking is créate</h4>";
		}
	}

	// Create form html in use shortcode

	echo '<div class="wrap">';
        echo '<h2>Réserver le cour</h2>';
        echo '<form method="POST" class="form">';
            echo '<div>';
                echo '<input type="text" name="customer_first_name" placeholder="Nom" class="mb-2" style="width:70%" required/>';
                echo '<input type="text" name="customer_last_name" placeholder="Prénom" class="mb-2" style="width:70%" required/>';
                echo '<input type="text" name="customer_phone" placeholder="Telephone" class="mb-2" style="width:70%" required/>';
                echo '<input type="email" name="customer_email" placeholder="Mail" class="mb-2" style="width:70%" required/>';
                echo '<input type="text" name="customer_address" placeholder="Adresse" class="mb-2" style="width:70%" required/>';
                echo '<input type="number" name="customer_old" placeholder="Age" class="mb-2" style="width:70%" required" />';
                echo '<input type="hidden" name="id_activity" value="'.$id = $_GET['id'].'" />';
            echo '</div>';
            echo '<div>';
                echo '<input type="submit" name="activities_customers_history" value="Crée" class="button">';
            echo '</div>';

        echo '</form>';
    echo '</div>';

	return ob_get_clean();
}

// For this add_shortcode the first param is a name the short code and seconde param is a name function use
add_shortcode('booking_form', 'booking_form');
?>