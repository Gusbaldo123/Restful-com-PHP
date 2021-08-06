<?php
include_once('SqlConnection.php');
    class Compra
    {
        //Copiado a mão o nome dos campos do Postgres
        private int $id;
        private ?int $CPF;
        private ?string $Carro;
        private ?float $Val;
        private ?DateTime $DtCompra;

        private Connection $conn;

        public function __construct($args)
        {
            //Conexão com o banco
            $this->conn = new Connection();
            //Cobra todos os campos do Compra logo no construtor
            $this->id = $args[0];
            $this->CPF = $args[1];
            $this->Carro = $args[2];
            $this->Val = $args[3];
            $this->DtCompra = $args[4];
        }
        public function Insert()
        {
            //Vai inserir no Banco todos os campos
            //Vai filtrar os campos NULL, e adicionar a apóstrofe nos campos que requerem
            //Vale dizer que o campo AcessoCurso NÃO pode ser nulo
            $id=$this->id;
            $CPF=$this->CPF;
            $Carro="'".$this->Carro."'";
            $Val=$this->Val;
            $DtCompra=$this->DtCompra;
            if($DtCompra!=null)
            $DtCompra = "'".$DtCompra->format('Y-m-d')."'";
            else $DtCompra = "NULL";
            //
            //SqlString que o Query do SqlConnection cobra
            $sql = "insert into Compra ( CPF, Carro, Valor, DtCompra ) values($CPF,$Carro,$Val,$DtCompra)";
            $this->conn->SqlQuery($sql);
        }
        public function Select()
        {
            $id = $this->id;
            //SqlString que o Select do SqlConnection cobra
            $sql = "select * from Compra where id=$id";
            var_dump($sql);
            $result = $this->conn->SqlSelect($sql);

            $select = array();

            while ($line = $result->fetch(PDO::FETCH_ASSOC)) {
                //Cada Resultado do SQL
                $select[] = $line;
            }

            if(!$select) throw new Exception("Nenhuma compra no sistema");

            return $select;
        }
        public function Update()
        {
            //Vai atualizar no Banco todos os campos
            //Vai filtrar os campos NULL, e adicionar a apóstrofe nos campos que requerem
            $id=$this->id;
            $CPF=$this->CPF;
            $Carro="'".$this->Carro."'";
            $Val=$this->Val;
            $DtCompra=$this->DtCompra;
            if($DtCompra!=null)
            $DtCompra = "'".$DtCompra->format('Y-m-d')."'";
            else $DtCompra = "NULL";

            //SqlString que o Query do SqlConnection cobra
            $sql = "UPDATE Compra SET id=$id, CPF=$CPF, Carro=$Carro, Valor=$Val, DtCompra=$DtCompra WHERE id = $id;";

            $this->conn->SqlQuery($sql);
        }
        public function Delete()
        {
            //Vai deletar no Banco
            $id=$this->id;

            //SqlString que o Query do SqlConnection cobra
            $sql = "DELETE FROM Compra WHERE id = $id;";

            $this->conn->SqlQuery($sql);
        }
    }
?>