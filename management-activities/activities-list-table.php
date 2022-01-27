<?php
    class ActivityListTable extends WP_List_Table {

        function get_data() {
            global $wpdb;
            $table_name = $wpdb->prefix . 'activities';
            return $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);
        }

        function get_columns() {
            return array(
                'id' => 'ID',
                'activity_name' => "Type d'activité",
                'activity_place' => 'Nombres de place',
                'activity_date_start' => 'Date',
                'activity_hours_start' => 'De',
                'activity_hours_end' => 'A',
                'comment' => 'Commentaire',
            );
        }

        function get_sortable_columns() {
            return array(
                'id' => array('id', false),
            );
        }

        function column_default($item, $column_name) {
            return $item[$column_name];
        }
        
        function usort_reorder($a, $b) {
            $orderby = (!empty($_GET['orderby'])) ? $_GET['orderby'] : 'id';
            $order = (!empty($_GET['order'])) ? $_GET['order'] : 'asc';
            $result = strcmp($a[$orderby], $b[$orderby]);
            return ($order === 'asc') ? $result : -$result;
        }

        function prepare_items() {
            $data = $this->get_data();
            $columns = $this->get_columns();
            $sortable = $this->get_sortable_columns();
            $this->_column_headers = array($columns, array(), $sortable);
            usort($data, array($this,'usort_reorder'));
            $this->items = $data;
        }

        function crudActivity() {
            global $wpdb;
            $table_name = $wpdb->prefix . 'activities';

            if (isset($_GET['del'])) {
                $del_id = $_GET['del'];
                $wpdb->query("DELETE FROM $table_name WHERE id = '$del_id'");
              }


        }

    }
?>