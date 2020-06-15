<?php
class Rest {
	private $host		= 'localhost';
	private $user		= 'root';
	private $password 	= "";
	private $database	= "json";
	private $wstTable	= 'wisata';
	private $dbConnect	= false;

	public function __construct(){
		if(!$this->dbConnect){
			$conn = new mysqli ($this->host, $this->user, $this->password, $this->database);
			if($conn->connect_error){
				die("Error failed to connect to MySQL: " . $conn->connect_error);
			}else{
				$this->dbConnect = $conn;
			}
		}
	}
	public function getWisata($wstId) {
		$sqlQuery	= '';
		if ($wstId) {
				$sqlQuery = "WHERE id_wisata = '".$wstId."'";
		}
		$wstQuery = "
			SELECT id_wisata, kota, landmark, tarif
			FROM ".$this->wstTable." $sqlQuery
			ORDER BY id_wisata ASC";
		$resultData = mysqli_query($this->dbConnect, $wstQuery);
		$wstData = array();
		while( $wstRecord = mysqli_fetch_assoc($resultData) ) {
				$wstData[] = $wstRecord;
		}
		header('Content-Type: application/json');
		echo json_encode($wstData);
	}
	public function insertWisata($wstData){
		$wstKota=$wstData["kota"];
		$wstLandmark=$wstData["landmark"];
		$wstTarif=$wstData["tarif"];
	
		$wstQuery="
		INSERT INTO ".$this->wstTable."
		SET kota='".$wstKota."', landmark='".$wstLandmark."', tarif='".$wstTarif."'";
	
		mysqli_query($this->dbConnect, $wstQuery);
		if (mysqli_affected_rows($this->dbConnect) > 0) {
				$message = "wisata sukses dibuat.";
				$status = 1;
		}else{
				$message = "wisata gagal dibuat.";
		}
		$wstResponse = array(
				'status' => $status,
				'status_message' => $message
		);
		header('Content-Type: application/json');
		echo json_encode($wstResponse);
	}

	public function updateWisata($wstData){
		if($wstData["id"]) {
		$wstKota=$wstData["kota"];
		$wstLandmark=$wstData["landmark"];
		$wstTarif=$wstData["tarif"];
		
		$wstQuery="
			UPDATE ".$this->wstTable."
			SET kota='".$wstKota."', landmark='".$wstLandmark."', tarif='".$wstTarif."'
			WHERE id_wisata= '".$wstData["id"]."'";
		
		mysqli_query($this->dbConnect, $wstQuery);
		if(mysqli_affected_rows($this->dbConnect) > 0) {
						$message = "wisata sukses diperbaiki.";
						$status = 1;
		}else{
				$message = "Invalid request.";
				$status = 0;
		}
		$wstResponse = array(
				'status' => $status,
				'status_message' => $message
		);
		header('Content-Type: application/json');
		echo json_encode($wstResponse);
		}
	}
	
	public function deleteWisata($wstId) {
		if($wstId) {
				$wstQuery = "
					DELETE FROM ".$this->wstTable."
					WHERE id_wisata = '".$wstId."'
					ORDER BY id_wisata DESC";
		mysqli_query($this->dbConnect, $wstQuery);
		if(mysqli_affected_rows($this->dbConnect) > 0) {
						$message = "wisata sukses dihapus.";
						$status = 1;
				} else {
						$message = "wisata gagal dihapus.";
						$status = 0;
				}
		} else {
				$message = "Invalid request.";
				$status = 0;
		}
		$wstResponse = array(
				'status' => $status,
				'status_message' => $message
		);
		header('Content-Type: application/json');
		echo json_encode($wstResponse);
	}
	
	public function getWisata_total_rows($q = NULL) {
		$sqlQuery = '';
		if($q) {
			$sqlQuery = "WHERE id_wisata LIKE '%".$q."%' ESCAPE '!'
						OR kota LIKE '%".$q."%' ESCAPE '!'
						OR landmark LIKE '%".$q."%' ESCAPE '!'
						OR tarif LIKE '%".$q."%' ESCAPE '!'";
		}
		$wstQuery = "SELECT id_wisata, kota, landmark, tarif
					FROM ".$this->wstTable." $sqlQuery
					ORDER BY id_wisata ASC";
		$resultData = mysqli_query($this->dbConnect, $wstQuery);
		$wstResponse = array(
			'total_rows' => mysqli_num_rows($resultData)
		);
		header('Content-Type: application/json');
		echo json_encode($wstResponse);
	}

	public function getWisata_limit($limit, $start = 0, $q = NULL) {
		$sqlQuery = '';
		if($q){
			$sqlQuery = "WHERE id_wisata LIKE '%".$q."%' ESCAPE '!'
						OR kota LIKE '%".$q."%' ESCAPE '!'
						OR landmark LIKE '%".$q."%' ESCAPE '!'
						OR tarif LIKE '%".$q."%' ESCAPE '!'";
		}
		$wstQuery = "SELECT id_wisata, kota, landmark, tarif
					FROM ".$this->wstTable." $sqlQuery
					ORDER BY id_wisata ASC
					LIMIT ".$start.",".$limit;
		
		$resultData = mysqli_query($this->dbConnect, $wstQuery);
		$wstData = array();
		while ($wstRecord = mysqli_fetch_assoc($resultData)) {
			$wstData[] = $wstRecord;
	}
	header('Content-Type: application/json');
	echo json_encode($wstData);
	
	}
}
?>