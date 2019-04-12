<?php

include ('iRadovi.php');

class DiplomskiRadovi implements iRadovi {
    private $naziv_rada;
    private $tekst_rada;
    private $link_rada;
    private $oib_tvrtke;

  //pravi se konstruktor klase dipl radovi
    function create($data)
    {
		$this->naziv_rada = $data['naziv_rada'];
        $this->tekst_rada = $data['tekst_rada'];
        $this->link_rada = $data['link_rada'];
        $this->oib_tvrtke = $data['oib_tvrtke'];
		
		echo 'Data created';
	}

//funkcija za spremanje u bazu, na phpmyadmin treba napraviti bazu radovi sa tablicom diplomski_radovi sa 4 stupca, naziv_rada, tekst_rada, link_rada i oib_tvrtke
    function save($data)
    {
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "radovi";
		
		$conn = new mysqli($servername, $username, $password, $dbname);
					
		$sql = "INSERT INTO diplomski_radovi (naziv_rada, tekst_rada, link_rada, oib_tvrtke) VALUES ('".$data['naziv_rada']."', '".$data['tekst_rada']."', '".$data['link_rada']."', '".$data['oib_tvrtke']."')";
		
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}

//citanje iz baze i prikaz na ekranu
    function read()
    {
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "radovi";
		
		$conn = new mysqli($servername, $username, $password, $dbname);
		
		$sql = "SELECT * FROM diplomski_radovi";
		$result = $conn->query($sql);
		
		if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo 'Naslov: ' . $row['naziv_rada'] . "<br>" . 'Tekst: ' . $row['tekst_rada'] . "<br>" . 'Link: ' . $row['link_rada'] . "<br>" . 'OIB: ' . $row['oib_tvrtke'] . "<br>";
			}
		}
		
		echo"<br>";
    }
}