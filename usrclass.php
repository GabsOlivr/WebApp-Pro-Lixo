<?php

class usrclass
{
    public $usuId;
    public $usuNome;
    public $usuCell;
    public $usuEmail;
    public $usuSenha;
    public $usuIcone;
    public $usuTipo;

    function __construct(){
        $this->usuId = 0;
        $this->usuNome = 'NomeVazio';
        $this->usuCell = '000';
        $this->usuEmail = 'EmailVazio';
        $this->usuSenha = 'SenhaVazia';
        $this->usuIcone = 'caminhoVazio';
        $this->usuTipo = 0;
    }

    public function primeiroNome(){
        $nomeInteiro = explode(" ", $this->usuNome);
        $nome = $nomeInteiro[0];
        return $nome;
    }
}
