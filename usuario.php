<?php
class Usuario{
public function __construct(
    public string $nome,
    public string $dataNasc,
    public string $telefone,
    public string $endereco,
    public int $cpf
){}


}