<?php 
	class ContactModelsContact extends FSModels{
			
		function save(){
			$fs_table = FSFactory::getClass('fstable');
			$email = FSInput::get('contact_email');
			$fullname = FSInput::get('contact_name');
			$address = FSInput::get('contact_address');
			$telephone = FSInput::get('contact_phone');
			$fax = FSInput::get('contact_fax');
			$subject = FSInput::get('contact_subject');
			$content = htmlspecialchars_decode(FSInput::get('message'));
			$contact_contry = htmlspecialchars_decode(FSInput::get('contact_contry'));
			$time = date("Y-m-d H:i:s");
			$published = 0;

			$sql = " INSERT INTO 
						fs_contact (`email`,fullname,address,telephone,fax,subject,content,edited_time,created_time,published)
						VALUES ('$email','$fullname','$address','$telephone','$fax','$subject','$content','$time','$time','$published')";
			global $db;
			$db->query($sql);
			$id = $db->insert($sql);
			return $id;
		}
		function get_address_list(){
			$fs_table = FSFactory::getClass('fstable');
			$query = "select * from ".$fs_table -> getTable('fs_address');
			global $db;
			// $sql = $db->query($query);
			$list = $db->getObjectList($query);
			return $list;
		}
		function get_address_current(){
			$fs_table = FSFactory::getClass('fstable');
			$add_id=FSInput::get('id');
			$query = "select * from ".$fs_table -> getTable('fs_address')." where id=".$add_id;
			global $db;
			// $sql = $db->query($query);
			$object = $db->getObject($query);
			return $object;
		}
		
		function get_regions(){
			$fs_table = FSFactory::getClass('fstable');
			return $this -> get_records('published = 1',$fs_table -> getTable('fs_locations_regions'),'*',' ordering ASC ');
			
		}
		
	}
?>