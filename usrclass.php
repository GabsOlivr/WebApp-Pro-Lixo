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
    public $usuEnd;

    function __construct(){
        $this->usuId = 0;
        $this->usuNome = 'NomeVazio';
        $this->usuCell = '000';
        $this->usuEmail = 'EmailVazio';
        $this->usuSenha = 'SenhaVazia';
        $this->usuIcone = 'caminhoVazio';
        $this->usuTipo = 0;
        $this->usuEnd = 'EnderecoVazio';
    }

    public function primeiroNome(){
        $nomeInteiro = explode(" ", $this->usuNome);
        $nome = $nomeInteiro[0];
        return $nome;
    }

    public function formataCell(){
        $cellSeparado = str_split($this->usuCell);
        $cellFormatado = "(".$cellSeparado[0].$cellSeparado[1].") ".
                     $cellSeparado[2].$cellSeparado[3].$cellSeparado[4].
                     $cellSeparado[5].$cellSeparado[6]."-".$cellSeparado[7].
                     $cellSeparado[8].$cellSeparado[9].$cellSeparado[10];
        return $cellFormatado;
    }
}
