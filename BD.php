<?php
class BD
{

    private $BD_TIPO = "mysql";
    private $BD_HOST = "localhost";
    private $BD_NOME = "db_aula_web";
    private $BD_PORTA = "3306";
    private $BD_USUARIO = "root";
    private $BD_SENHA = "";
    private $BD_CHARSET = "utf8";

    public function connection()
    {
        $str_conn = $this->BD_TIPO . ":host=" . $this->BD_HOST .
            ";dbname=" . $this->BD_NOME . ";port=" . $this->BD_PORTA;


        return new PDO(
            $str_conn,
            $this->BD_USUARIO,
            $this->BD_SENHA,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . $this->BD_CHARSET)
        );
    }

    public function select()
    {
        $conn = self::connection();
        $stmt = $conn->prepare("SELECT * FROM tb_usuario order by id desc");

        $stmt->execute();

        return $stmt;
    }


    public function insert($dados)
    {
        $sql = "INSERT INTO tb_usuario (nome, telefone, cpf ) VALUES (";

        $flag = 0;
        $arrayValue = [];
        foreach ($dados as $campo => $valor) {

            if ($flag == 0) {
                $sql .=  " ? ";
            } else {
                $sql .=  ", ?";
            }

            $flag = 1;

            $arrayValue[] = $valor;
        }

        $sql .= ");";

        $conn =  $this->connection(); //conecta ao banco de dado
        //prepara o SQL
        $stmt = $conn->prepare($sql);
        //execulta o SQL substituindo onde tem a iterrogacao pelos parametros 
        //passados atraves do vetor seguindo a mesma sequencia da esqueda para direita
        $stmt->execute($arrayValue);

        return $stmt;
    }
}
