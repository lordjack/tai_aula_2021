<?php

class bd
{

    private $bd_tipo = "mysql";
    private $bd_host = "localhost";
    private $bd_nome = "db_tai_aula_2021";
    private $bd_porta = "3306";
    private $bd_usuario = "root";
    private $bd_senha = "";
    private $bd_charset = "utf8mb4";

    public function connection()
    {
        $str_conn = $this->bd_tipo . ":host=" . $this->bd_host .
            ";dbname=" . $this->bd_nome . ";port=" . $this->bd_porta;

        return new PDO(
            $str_conn,
            $this->bd_usuario,
            $this->bd_senha,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . $this->bd_charset)
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
