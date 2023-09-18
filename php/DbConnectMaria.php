<?php

class DbConnectMaria
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

    function create($url, $length, $time)
    {
        $sql = "INSERT INTO $this->table (url,length,timestamp) VALUES ('" . $url . "', '" . $length . "', " . $time . ")";
        return mysqli_query($this->connect, $sql);
    }

    private function migrate()
    {
        $sql = "CREATE TABLE $this->table
                    (
                    id        int auto_increment,
                    url       text                                 null,
                    length    bigint                               null,
                    timestamp varchar(50)                          null,
                    date      datetime default current_timestamp() null,
                        unique (id)
                );
        ";
        return mysqli_query($this->connect, $sql);
    }

    private function drop()
    {
        $sql = "DROP TABLE $this->table";
        return mysqli_query($this->connect, $sql);
    }

    public function checkMigration($drop = false)
    {
        if ($drop) {
            $this->drop();
        }
        $query = "SHOW TABLES LIKE '$this->table'";
        $result = $this->connect->query($query);

        if ($result->num_rows > 0) {
            echo "Table '$this->table' exists in database database.\n";
        } else {
            echo "Table '$this->table' does not exist in database database.\n";
            $this->migrate();
        }
    }

    public function selectAverageLength(){
        $query = "SELECT avg(length) FROM $this->table";
        $result = $this->connect->query($query);
        return $result->fetch_assoc()['avg(length)'];
    }
}