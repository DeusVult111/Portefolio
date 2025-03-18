<?php 
	class photoveh extends Model{
		var $table="photoveh";
		
		function getPhotos($idveh){
			$condition=" idveh =".$idveh;
			
			return $this->find(array(
				"condition" => $condition,
				"order" => ' id ASC'
			));	
		}
		function getChemin($id){
			
			echo "getchemin";
			
			$condition=" id =".$id;
			
			return $this->findfirst(array(
				"fields" => ' chemin',
				"condition" => $condition
			));	
		}
		function deletePhotosVeh($idveh){
			return $this->deletecond(" idveh =".$idveh);	
		}
		
	}
?>