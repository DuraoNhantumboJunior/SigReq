<?php
    class DB{
        private static $_instance=null;
        private $_pdo, 
                $_query,
                $_error=false, 
                $_results,
                $_count=0,
                $result;

        private function __construct(){
            try{
                $this->_pdo=new PDO('mysql:host='.Config::get('mysql/host').';dbname='.Config::get('mysql/db'),Config::get('mysql/username'),Config::get('mysql/password'));
                
            }catch(PDOException $e){
                die($e->getMessage());
            }
        }

        public static function getInstance(){
            if(!isset(self::$_instance)){
                self::$_instance=new DB();
            }
            return self::$_instance;
        }

        public function query($sql, $params=array()){
            $this->_error=false;
            if($this->_query = $this->_pdo->prepare($sql)){
                
                $x=1;
                if(count($params)){
                    foreach($params as $param){
                        $this->_query->bindValue($x,$param);
                        $x++;
                    }
                }
                if($this->_query->execute()){
                    
                    $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                    $this->_count=$this->_query->rowCount();
                }else{
                    $this->_error = true;
                }
            }
            return $this;
        }

        public function action($action, $table, $where=array()){
           if(count($where)===3){
                $operators=array('=','>','<','>=','<=');
                $field=$where[0];
                $operator=$where[1];
                $value=$where[2];

                if(in_array($operator, $operators)){
                    $sql="{$action} FROM {$table} WHERE {$field} {$operator} ? ";
                    if(!$this->query($sql,array($value))->error()){
                        return $this;
                    }
                }
            }
            return false;
        }


        public function get($table,$where){
            return $this->action('SELECT *',$table, $where);
        }

        public function getGroup($username){
            $stmt = $this->_pdo->prepare("SELECT grupo FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return $row['grupo'];
            } else {
                return null;
            }
        }
        public function delete($table, $where){
            return $this->action('DELETE',$table, $where);
        }

        public function insert($table, $fields=array()){ 
            $keys = array_keys($fields);
            $values= '';
            $x=1;

            foreach ($fields as $field){
                $values .='?';
                if($x < count($fields)){
                    $values .= ', ';
            }
                $x++;
            }

            $sql="INSERT INTO {$table} (`" . implode('`,`',$keys) . "`) VALUES ({$values})";
            
            if(!$this->query($sql,$fields)->error()){
                return true;
            }
            return false;
        }

        public function insertb($table, $fields=array()){ 
            $keys = array_keys($fields);
          $values = implode(',',array_fill(0,count($fields),'?'));
            $sql="INSERT INTO {$table} (`" . implode('`,`',$keys) . "`) VALUES ({$values})";
            if(!$this->query($sql,$fields)->error()){
                return true;
            }
            return false;
        }
        

        public function update($table,$id,$fields){
            $set='';
            $x=1;

            foreach($fields as $name => $value){
                $set .= "{$name} = ?";
                if($x< count($fields)){
                    $set .=', ';
                }
                $x++;
            }

            

            $sql="UPDATE {$table} SET {$set} WHERE id={$id}";
           
           if(!$this->query($sql, $fields)->error()){
                return true;
           }
           return false;
        }

        public function deleteB($table,$id,$fields){
            $set='';
            $x=1;

            foreach($fields as $name => $value){
                $set .= "{$name} = ?";
                if($x< count($fields)){
                    $set .=', ';
                }
                $x++;
            }
            $sql="DELETE {$table} {$set} WHERE id={$id}";
           
           if(!$this->query($sql, $fields)->error()){
                return true;
           }
           return false;
        }

        public function results(){
            return $this->_results;
        }

        public function first(){
            return $this->results()[0];
        }

        public function error(){
            return $this->_error;
        }

        public function count(){
            return $this->_count;
        }
        //documentos
        public function insertDoc($table,$fields){
            if(count($fields)){
                $keys = array_keys($fields);
                $values= '';
                $x=1;

                foreach ($fields as $field){
                    $values .='?';
                    if($x < count($fields)){
                        $values .= ', ';
                }
                    $x++;
                }
                $sql="INSERT INTO {$table} (`" . implode('`,`',$keys) . "`) VALUES ({$values})";

                if(!$this->query($sql,$fields)->error()){
                    return true;
                }
                return false;
            }
            return false;
    }
    public function geteDoc($table,$where){
        return $this->action('SELECT *',$table, $where);
    }
    public function estados($table,$where){
        return $this->action('SELECT COUNT(estado)',$table, $where);
    }

    public function getAll(){
        $query = "SELECT * FROM pedido";
        $resultData = $this->query($query,'*');

        if (!$resultData) {
            return array();
        }
        
        return $resultData;
    }
    public function relatorio_actividades(){
        $pdf = new FPDF();
        $pdf->AddPage();
        //$pdf->Image('Public/imagens/icons/FEG.jpg', 95, 20, 24, 24, 'JPG');

        $pdf->SetTextColor(42, 157, 199);
        $pdf->SetFont('times', 'B', 18);
        $pdf->Cell(0, 10, 'Faculdade de Económia E Gestão', 1, 1, 'C');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('times', 'B', 12);
        $pdf->Ln(25);


        $cabecalho = array(
            array('Tipo Doc', 'Pedentes', 'Aprovados')
        );
        $typedoc = array(
            'Credencial',
            'Mudança de Turno',
            'Declaração de Notas',
            'Revisão de Exame',
            'Equivalêcia',
            'Reavalisão de exame',
            'Anulação Matricula'
        );
        $larguras = array(70, 40, 40,);

        // Percorre os dados e constrói a tabela
        $pdf->Ln(15);
        $pdf->SetTextColor(42, 157, 199);
        foreach ($cabecalho as $linha) {
            for ($i = 0; $i < count($linha); $i++) {
                $pdf->Cell($larguras[$i], 10, $linha[$i], '1', 0, 'C');
            }
            $pdf->Ln();
        }
        $pdf->SetTextColor(0, 0, 0);
       // $db = new DataBase();
         
        // $pendentes= $db->getColumn('estado','pedentes');
        //   var_dump($pendentes);
        $j=0;
        foreach ($typedoc as $linha) {
            for ($i = 0; $i < 3; $i++) {
                if($i == 0){
                    $pdf->Cell($larguras[$i], 10, $typedoc[$j], '1', 0, 'C');
                }else if($i != 0){
                    $pdf->Cell($larguras[$i], 10,'', '1', 0, 'C');
                 }
                
            }
            $pdf->Ln();
            $j++;
        }
        
        $pdf->Output('relatorio1.pdf', 'I');

    }
    public function count_pendente($table, $situacao){
        return $this->action('SELECT COUNT(estado)',$table, $situacao);
    }
}
// "SELECT COUNT(estado) from $tabela where estado = $situacao"