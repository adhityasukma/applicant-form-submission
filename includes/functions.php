<?php
if(!function_exists("get_all_submission")){
    function get_all_submission(){
        global $wpdb;
            $result = $wpdb->get_results(
                $wpdb->prepare(
                    "
			SELECT *
			FROM {$wpdb->prefix}applicant_submissions
			    ORDER BY created_at DESC
			LIMIT %d
		",
                    5
                )
            );


        if($result){
            return $result;
        }
        return false;
    }
}
