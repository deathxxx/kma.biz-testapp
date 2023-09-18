<?php

class DbConnect
{

    private $table = 'urls';

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
// Set up the database connection
        $host = 'localhost';
        $user = 'myuser';
        $password = 'mypassword';
        $database = 'mydatabase';

// Set up the connection
        $connection = mysqli_connect($host, $user, $password);

// Select the database
        mysqli_select_db($database, $connection);
    }

// Define the CRUD functions


    function create($url, $length)
    {
        // Insert a new row into the table
        $sql = "INSERT INTO $this->table (url,length) VALUES ('" . $url . "', '" . $length . "')";
        return mysqli_query($sql);
    }

    function read($url = null)
    {
        // Select one or all rows from the table
        if ($url) {
            $sql = "SELECT * FROM $this->table WHERE url = $url";
        } else {
            $sql = "SELECT * FROM $this->table";
        }
        $result = mysqli_query($sql);
        $rows = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    function update($id, $length)
    {
        // Update an existing row in the table
        $sql = "UPDATE $this->table SET length = '" . $length . "' WHERE id = $id";
        return mysqli_query($sql);
    }

    function delete($id)
    {
        // Delete an existing row from the table
        $sql = "DELETE FROM $this->table WHERE id = $id";
        return mysqli_query($sql);
    }

}