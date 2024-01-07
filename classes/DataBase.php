<?php

class DataBase {
    private static $_instance;
    private static $_error,$_results;
    private $_query,$_pdo,$_count;

    private function __construct(){
        try{
            $this->_pdo=new PDO('mysql:host='.Config::get('mysql/host').';dbname='.Config::get('mysql/db'),Config::get('mysql/username'),Config::get('mysql/password'));
            
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public static function getInstance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new DataBase(); // Assuming DaBase is the class containing this code
        }
        return self::$_instance;
    }

    public function getAll($db) {
        $query = "SELECT * FROM {$db}";
        return $this->select($query);
    }

    
    public function getAllDoc($db,$estado=null) {
        $query = "SELECT * FROM {$db} where estado='$estado'";
        return $this->select($query);
    }
    public function getAllForPDF($db,$id) {
        $query = "SELECT * FROM {$db} where id={$id}";
        return $this->select($query);
    }

    public function tabelaRegistros($resultData) {
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">PASSWORD</th>
                    <th scope="col">Categoria</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultData as $linha): ?>
                    <tr>
                        <th scope="row"><?= $linha['id'] ?></th>
                        <td><?= $linha['username'] ?></td>
                        <td><?= $linha['name'] ?></td>
                        <td><?= $linha['password'] ?></td>
                        <td><?= $linha['grupo'] ?></td>
                        <td><button class="btn btn-primary"><a class="text-light" target="blank" href="changepasswordadmin.php?trocarsenhaId=<?= $linha['id'] ?>">Trocar Senha</a></button></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php
    }

    public function tabelaDocumentosCredencial($resultData){
        //$this->cabecalho('Credencial');
        ?>
    
            <?php foreach ($resultData as $linha): ?>
                <tr>
                    <th scope="row"><?= $linha['id'] ?></th>
                    <td><?= $linha['nome'] ?></td>
                    <td><?= $linha['curso'] ?></td>
                    <td><?= $linha['numero_estudante'] ?></td>
                    <td><?= $linha['estado'] ?></td>
                    <td><button class="btn btn-primary"><a class="text-light" target="blank" href="pdf.php?downloadId=<?= $linha['id'] ?>">Baixar</a></button></td>
                    <td><button class="btn btn-danger"><a class="text-light" target="blank" href="pdf.php?mudarestado=<?= $linha['id'] ?>">Mudar Estado</a></button></td>
                </tr>
            <?php endforeach; ?>
         
    <?php
    }
    public function tabelaDocumentosTurno($resultData){?>
        
            <?php foreach ($resultData as $linha): ?>
                <tr>
                    <th scope="row"><?= $linha['id'] ?></th>
                    <td><?= $linha['nome'] ?></td>
                    <td><?= $linha['curso'] ?></td>
                    <td><?= $linha['numero_estudante'] ?></td>
                    <td><?= $linha['estado'] ?></td>
                    <td><button class="btn btn-primary"><a class="text-light" target="blank" href="pdf_turno.php?downloadId=<?= $linha['id'] ?>">Baixar</a></button></td>
                    <td><button class="btn btn-danger"><a class="text-light" target="blank" href="pdf.php?downloadId=<?= $linha['id'] ?>">Mudar Estado</a></button></td>
                </tr>
            <?php endforeach; ?>
         
    <?php
    }
    public function tabelaDocumentosCurso($resultData){?>
        
            <?php foreach ($resultData as $linha): ?>
                <tr>
                    <th scope="row"><?= $linha['id'] ?></th>
                    <td><?= $linha['nome'] ?></td>
                    <td><?= $linha['curso'] ?></td>
                    <td><?= $linha['numero_estudante'] ?></td>
                    <td><?= $linha['estado'] ?></td>
                    <td><button class="btn btn-primary"><a class="text-light" target="blank" href="pdf_curso.php?downloadId=<?= $linha['id'] ?>">Baixar</a></button></td>
                    <td><button class="btn btn-danger"><a class="text-light" target="blank" href="pdf.php?downloadId=<?= $linha['id'] ?>">Mudar Estado</a></button></td>
                </tr>
            <?php endforeach; ?>
         
    <?php
    }
    public function tabelaDocumentosAnulacao($resultData){?>
        
            <?php foreach ($resultData as $linha): ?>
                <tr>
                    <th scope="row"><?= $linha['id'] ?></th>
                    <td><?= $linha['nome'] ?></td>
                    <td><?= $linha['curso'] ?></td>
                    <td><?= $linha['numero_estudante'] ?></td>
                    <td><?= $linha['estado'] ?></td>
                    <td><button class="btn btn-primary"><a class="text-light" target="blank" href="pdf_anulacao.php?downloadId=<?= $linha['id'] ?>">Baixar</a></button></td>
                    <td><button class="btn btn-danger"><a class="text-light" target="blank" href="pdf.php?downloadId=<?= $linha['id'] ?>">Mudar Estado</a></button></td>
                </tr>
            <?php endforeach; ?>
         
    <?php
    }
    public function tabelaDocumentosNotas($resultData){?>
        
            <?php foreach ($resultData as $linha): ?>
                <tr>
                    <th scope="row"><?= $linha['id'] ?></th>
                    <td><?= $linha['nome'] ?></td>
                    <td><?= $linha['curso'] ?></td>
                    <td><?= $linha['numero_estudante'] ?></td>
                    <td><?= $linha['estado'] ?></td>
                    <td><button class="btn btn-primary"><a class="text-light" target="blank" href="pdf_nota.php?downloadId=<?= $linha['id'] ?>">Baixar</a></button></td>
                    <td><button class="btn btn-danger"><a class="text-light" target="blank" href="pdf.php?downloadId=<?= $linha['id'] ?>">Mudar Estado</a></button></td>
                </tr>
            <?php endforeach; ?>
         
    <?php
    }
    public function tabelaDocumentosRealizacao($resultData){?>
        
            <?php foreach ($resultData as $linha): ?>
                <tr>
                    <th scope="row"><?= $linha['id'] ?></th>
                    <td><?= $linha['nome'] ?></td>
                    <td><?= $linha['curso'] ?></td>
                    <td><?= $linha['numero_estudante'] ?></td>
                    <td><?= $linha['estado'] ?></td>
                    <td><button class="btn btn-primary"><a class="text-light" target="blank" href="pdf_realizar.php?downloadId=<?= $linha['id'] ?>">Baixar</a></button></td>
                    <td><button class="btn btn-danger"><a class="text-light" target="blank" href="pdf.php?downloadId=<?= $linha['id'] ?>">Mudar Estado</a></button></td>
                </tr>
            <?php endforeach; ?>
         
    <?php
    }
    public function tabelaDocumentosRevisao($resultData){?>
        
            <?php foreach ($resultData as $linha): ?>
                <tr>
                    <th scope="row"><?= $linha['id'] ?></th>
                    <td><?= $linha['nome'] ?></td>
                    <td><?= $linha['curso'] ?></td>
                    <td><?= $linha['numero_estudante'] ?></td>
                    <td><?= $linha['estado'] ?></td>
                    <td><button class="btn btn-primary"><a class="text-light" target="blank" href="pdf_revisao.php?downloadId=<?= $linha['id'] ?>">Baixar</a></button></td>
                    <td><button class="btn btn-danger"><a class="text-light" target="blank" href="pdf.php?downloadId=<?= $linha['id'] ?>">Mudar Estado</a></button></td>
                </tr>
            <?php endforeach; ?>
         
    <?php
    }
    public function tabelaDocumentosEquivalencia($resultData){?>
        
            <?php foreach ($resultData as $linha): ?>
                <tr>
                    <th scope="row"><?= $linha['id'] ?></th>
                    <td><?= $linha['nome'] ?></td>
                    <td><?= $linha['curso'] ?></td>
                    <td><?= $linha['numero_estudante'] ?></td>
                    <td><?= $linha['estado'] ?></td>
                    <td><button class="btn btn-primary"><a class="text-light" target="blank" href="pdf_equivalencia.php?downloadId=<?= $linha['id'] ?>">Baixar</a></button></td>
                    <td><button class="btn btn-danger"><a class="text-light" target="blank" href="pdf.php?downloadId=<?= $linha['id'] ?>">Mudar Estado</a></button></td>
                </tr>
            <?php endforeach; ?>
         
    <?php
    }
    private function select($query) {
        try {
            $stmt = $this->_pdo->query($query);
    
            if ($stmt === false) {
                throw new PDOException("Query execution failed. Error Info: " . implode(", ", $this->_pdo->errorInfo()));
            }
    
            $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultData;
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
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
    public function cabecalho($tipo){
        ?><div class="info-credencial">
         <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col"><?php echo ''.$tipo ?></th>
                <th scope="col">Nome</th>
                <th scope="col">Curso</th>
                <th scope="col">Número de Estudante</th>
                <th scope="col">Estado</th>
              </tr>
            </thead>
    </div><?php 
            }
}

