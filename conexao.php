<?php

class conexaoBD
{
    public $dns;
    public $username;
    public $password;
    public $connection;

    function __construct(){
        $this->dns = 'mysql:host=127.0.0.1;port=3306;dbname=prolixo';
        $this->username = 'root';
        $this->password = '1234';
        $this->connection = new PDO($this->dns, $this->username, $this->password);
        //PS: N estou certo quanto à necessidade do atributo connection, mas vou deixar aqui por precaução.
        //Ele funciona, só que é mais rolê usar ele do que criar um PDO novo a cada página.
    }
}