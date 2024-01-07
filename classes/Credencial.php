<?php

class Credencial{
    private $_db,$db,
                $_data;
    public function __construct(){
        $this->_db=DataBase::getInstance();
        $this->db =DB::getInstance();
    }
    public function registroUsers($table){
        $resultData = $this->_db->getAll($table);
        return $resultData;
    }

    public function registroDocumentos($table,$estado){
        $resultData = $this->_db->getAllDoc($table,$estado);
        return $resultData;
    }

    public function dontSee($resultData){
        $this->_db->tabelaRegistros($resultData);
    }

    public function grab($resultData){
        $this->_db->tabelaDocumentosCredencial($resultData);
    }
    
    public function grabTurno($resultData){
        $this->_db->tabelaDocumentosTurno($resultData);
    }
    public function grabCurso($resultData){
        $this->_db->tabelaDocumentosCurso($resultData);
    }
    public function grabAnulacao($resultData){
        $this->_db->tabelaDocumentosAnulacao($resultData);
    }
    public function grabNotas($resultData){
        $this->_db->tabelaDocumentosNotas($resultData);
    }
    public function grabRealizacao($resultData){
        $this->_db->tabelaDocumentosRealizacao($resultData);
    }
    public function grabRevisao($resultData){
        $this->_db->tabelaDocumentosRevisao($resultData);
    }
    public function grabEquivalencia($resultData){
        $this->_db->tabelaDocumentosEquivalencia($resultData);
    }
    public function dadosPDF($db,$id){
        return $this->_db->getAllForPDF($db,$id);
    }
    public function mudarEstado($table,$id){
        $this->db->update($table,$id,array('estado'=> 'Aprovado'));
    }
    public function header($tipo){
        ?> <div class="info-credencial">
        <table class="table">
            <thead>
              <tr>
                <th scope="col"><?php echo ''.$tipo ?></th>
                <th scope="col">Nome</th>
                <th scope="col">Curso</th>
                <th scope="col">Número de Estudante</th>
                <th scope="col">Estado</th>
              </tr>
            </thead>
            
    </div><?php echo '<br> <br> <br> ';
            }
}