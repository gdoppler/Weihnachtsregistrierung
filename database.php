<?php

class DB{

   
    private $conn; 
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "christmasdinner";

    public function __construct(){
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        // Check connection
        if ($this->conn->connect_error) {
            $this->create_database(); 
        }
    }

    private function create_database(){    
        // Create connection
        $conn = new mysqli($this->servername, $this->username, $this->password);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        // Create database
        $sql = "CREATE DATABASE if not exists $this->dbname";
        if ($conn->query($sql) === TRUE) {
            //echo "Database created successfully";
        } else {
            //echo "Error creating database: " . $conn->error;
        }

        $conn->close();

        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // sql to create table
        $sql = "CREATE TABLE if not exists registrations (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            firstname nvarchar(50),
            lastname nvarchar(50),
            food nvarchar(50),
            dessert nvarchar(50),
            registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
            )";
        if ($conn->query($sql) === TRUE) {
                //echo "Table testdata created successfully";
        } else {
            //echo "Error creating table: " . $conn->error;
        }
        $this->conn=$conn;  
        
    }

    public function __destruct(){
        $this->conn->close(); 
    }

    public function insert_registration($firstname, $lastname, $food, $dessert){
        // first clean the stuff to avoid funny things (script injection)
        $firstname = $this->clean_string($_POST["firstname"]);
        $lastname =  $this->clean_string($_POST["lastname"]);
        $food =  $this->clean_string($_POST["food"]);
        $dessert =  $this->clean_string($_POST["dessert"]);
        
        // prepare and bind
        $stmt = $this->conn->prepare("INSERT INTO registrations (firstname, lastname, food, dessert) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $firstname, $lastname, $food, $dessert);
        $stmt->execute(); 
    }

    public function get_registrations(){
        $sql="select * from registrations"; 
        $result = $this->conn->query($sql);
        $data=[]; 

        while($row = $result->fetch_assoc()) {
            $data[]=$row; 
            
        }

        return $data; 
    }

    private function clean_string($s){
        return substr(trim(htmlspecialchars($s)),0,50); 
    }

}

