<?php

include "../Config.php";
class bd
{

    public function connection()
    {
        $str_conn = Config::DB_TIPO . ":host=" . Config::DB_HOST .
            ";dbname=" . Config::DB_NOME . ";port=" . Config::DB_PORTA;

        return new PDO(
            $str_conn,
            Config::DB_USUARIO,
            Config::DB_SENHA,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . Config::DB_CHARSET)
        );
    }

    public function select($nome_tabela)
    {
        $conn = $this->connection();

        $stmt = $conn->prepare("SELECT * FROM $nome_tabela");

        $stmt->execute();

        return $stmt;
    }

    public function find($nome_tabela, $id)
    {
        $conn = $this->connection();

        $stmt = $conn->prepare("SELECT * FROM $nome_tabela WHERE id = ?;");

        $stmt->execute([$id]);

        return $stmt->fetchObject();
    }

    //UPDATE `tb_usuario` SET `nome`='Lucas', `telefone`='49 8899-8800', `cpf`='000.555.999-55' WHERE  `id`=5;
    public function update($nome_tabela, $dados)
    {
        $id = $dados['id'];
        $sql = "UPDATE $nome_tabela SET ";

        $flag = 0;
        $arrayValor = [];
        foreach ($dados as $campo => $valor) {

            if ($flag == 0) {
                $sql .= " $campo = ?";
            } else {
                $sql .= ", $campo = ?";
            }
            $flag = 1;
            $arrayValor[] = $valor;
        }

        $sql .= " WHERE id = $id;";

        $conn = $this->connection();

        $stmt = $conn->prepare($sql);

        $stmt->execute($arrayValor);

        return $stmt;
    }

    public function insert($nome_tabela, $dados)
    {
        unset($dados['id']); //remove o atributo id do vetor
        $sql = "INSERT INTO $nome_tabela (";

        $flag = 0;
        foreach ($dados as $campo => $valor) {

            if ($flag == 0) {
                $sql .= " $campo";
            } else {
                $sql .= ", $campo";
            }
            $flag = 1;
        }
        $sql .= ") VALUES (";


        $flag = 0;
        $arrayValor = [];
        foreach ($dados as $valor) {

            if ($flag == 0) {
                $sql .= " ?";
            } else {
                $sql .= ", ?";
            }
            $flag = 1;
            $arrayValor[] = $valor;
        }
        $sql .= ");";
        $conn = $this->connection();

        var_dump($dados);
        var_dump($sql);
        // exit;

        $stmt = $conn->prepare($sql);

        $stmt->execute($arrayValor);

        return $stmt;
    }

    public function remove($nome_tabela, $id)
    {
        $conn = $this->connection();

        $stmt = $conn->prepare("DELETE FROM $nome_tabela WHERE id = ?;");

        $stmt->execute([$id]);

        return $stmt;
    }

    public function search($nome_tabela, $dados)
    {
        $conn = $this->connection();
        $campo = $dados['tipo'];

        $stmt = $conn->prepare("SELECT * FROM $nome_tabela WHERE $campo like ?;");

        $stmt->execute(["%" . $dados['valor'] . "%"]);

        return $stmt;
    }
}
