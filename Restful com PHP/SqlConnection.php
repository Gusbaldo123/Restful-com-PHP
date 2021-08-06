<?php
class Connection
{
    //Não esquecer de alterar o Host, Dbname, user e password
    private $host = "localhost";
    private $dbname = "restfultest";
    private $user = "root";
    private $password = "";
    private function SqlConnect()
    {
        $host = $this->host;
        $dbname = $this->dbname;
        $user = $this->user;
        $password = $this->password;
        $conn = new PDO("mysql:host=$host;dbname=$dbname;user=$user;password=$password");
        return $conn;
    }
    public function SqlQuery($_sql)
    {
        //Vai basicamente aplicar a SqlString
        $conn = $this->SqlConnect();
        $conn->query($_sql);
        $conn = null;
    }
    public function SqlSelect($_sql)
    {
        //Vai aplicar a SqlString e retornar o resultado
        $conn = $this->SqlConnect();
        $result = $conn->query($_sql);
        $conn = null;
        return $result;
    }
}
?>