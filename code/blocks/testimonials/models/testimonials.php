<?php
class TestimonialsBModelsTestimonials {
	
	function __construct() {
	
	}
	
	function get_testimonials($limit) {
		$query = " SELECT *
		global $db;
		
		$db->query ( $query );
		
		return $db->getObjectList ();
	}
}

?>