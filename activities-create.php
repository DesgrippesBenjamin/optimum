<?php

//Function create

function activity_create() {

    // insert data in table
	if (isset($_POST['activity'])) {
		$activity_name = sanitize_text_field($_POST["activity_name"]);
		$activity_place = sanitize_text_field($_POST["activity_place"]);
		$activity_date_start = sanitize_text_field($_POST["activity_date_start"]);
        $activity_hours_start = sanitize_text_field($_POST["activity_hours_start"]);
        $activity_hours_end = sanitize_text_field($_POST["activity_hours_end"]);
		$comment = esc_textarea($_POST["comment"]);
		
		if ($activity_name != '' && $activity_place != '' && $activity_date_start  != '' && $activity_hours_start !='' && $activity_hours_end !='' && $comment  != '') {
			global $wpdb;

			$table_name = $wpdb->prefix . 'activities';
	
			$wpdb->insert( 
				$table_name,
				array( 
					'activity_name' => $activity_name,
					'activity_place' => $activity_place,
					'activity_date_start' => $activity_date_start,
                    'activity_hours_start' => $activity_hours_start,
                    'activity_hours_end' => $activity_hours_start,
					'comment' => $comment,
				) 
			);

			echo "<h4>Activity is créate</h4>";
		}
	}
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/management-activities/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Add New Activity</h2>
        <form method="POST" class="form">
            <div class="form-part">
                <label for="activity_name" class="label-creat-activity">Nom de l'événement:</label>
                <input type="text" name="activity_name"  class="ss-field-width" />
            </div>
            <div class="form-part">
                <label for="activity_place" class="label-creat-activity">Nombre de place:</label>
                <input type="number" name="activity_place" class="ss-field-width" />
            </div>
            <div class="form-part">
                <label for="activity_date_start" class="label-creat-activity">Date de debut:</label>
                <input type="date" name="activity_date_start" class="ss-field-width" />
            </div>
            <div class="form-part">
                <label for="activity_hours_start" class="label-creat-activity">Debut d'heure:</label>
                <input type="text" name="activity_hours_start" class="ss-field-width" />
            </div>
            <div class="form-part">
                <label for="activity_hours_end" class="label-creat-activity">Fin d'heure:</label>
                <input type="text" name="activity_hours_end" class="ss-field-width" />
            </div>
            <div class="form-part">
                <label for="comment" class="label-creat-activity">Commentaire:</label>
                <textarea name='comment' placeholder='Ajouter un commentaire' class="comment" required></textarea>
            </div>
            <input type='submit' name="activity" value='Crée' class='button'>
        </form>
        
    </div>
    <?php

    

}

