<?php

class DbConnect
{

    private $table = 'urls';
    private $connect;

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        $host = '173.25.0.4';
        $user = 'myuser';
        $password = 'mypassword';
        $database = 'mydatabase';

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        $this->connect = new mysqli($host, $user, $password, $database);

        $this->connect->set_charset('utf8mb4');

        printf("Success... %s\n", $this->connect->host_info);
    }

    function create($url, $length)
    {
        // Insert a new row into the table
        $sql = "INSERT INTO $this->table (url,length,timestamp) VALUES ('" . $url . "', '" . $length . "', ".microtime(true).")";
        return mysqli_query($this->connect,$sql);
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


    private function migrate() {
        $sql = "CREATE TABLE $this->table
    (
    id        int auto_increment,
    url       text                                 null,
    length    bigint                               null,
    timestamp varchar(50)                          null,
    date      datetime default current_timestamp() null,
        unique (id)
);";
        return mysqli_query($this->connect,$sql);
    }
    public function checkMigration(){

        $query = "SHOW TABLES LIKE '$this->table'";
        $result = $this->connect->query($query);

        if ($result->num_rows > 0) {
            echo "Table '$this->table' exists in database database.";
        } else {
            echo "Table '$this->table' does not exist in database database.";
            $this->migrate();
        }
    }
}