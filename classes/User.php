<?php 
    class User{
        private $_db,
                $_data,
                $_sessionName,
                $_cookieName,
                $_isLoggedIn;
        public function __construct($user=null){
            $this->_db=DB::getInstance();
            $this->_sessionName = Config::get('session/session_name');
            $this->_cookieName = Config::get('remember/cookie_name');

            if(!$user){
                if(Session::exists($this->_sessionName)){
                    $user=Session::get($this->_sessionName);
                   // echo $user;


                    if($this->find($user)){
                        $this->_isLoggedIn=true;
                    }else{
                        //process logout
                    }
                }
            }else{
                $this->find($user);
            }
        }

        public function update($fields=array(),$id=null){

            if(!$id && $this->isLoggedIn()){
                $id=$this->data()->id;
            }

            if(!$this->_db->update('users',$id,$fields)){
                throw new Exception('There was a problem updating.');
            }
        }
        public function updateForAdmin($fields = array(),$id){
            if(!$this->_db->update('users',$id,$fields)){
                throw new Exception('There was a problem updating.');
            }
        }
        public function create($fields = array()){
            if(!$this->_db->insert('users',$fields)){
                throw new Exception('There was a problem creating an account.');
            }else{

            }
        }
        public function delete($fields=array(),$id=null){
            if(!$id && $this->isLoggedIn()){
                $id=$this->data()->id;
            }

            if(!$this->_db->update('users',$id,$fields)){
                throw new Exception('There was a problem updating.');
            }
        }

        public function find($user=null){
            if($user){
                $field= (is_numeric($user))? 'id' : 'username';
                $data=$this->_db->get('users', array($field,'=',$user));

                if($data->count()){
                    $this->_data=$data->first();
                    return true;
                }
            }
            return false;
        }

        public function login($username=null,$password=null,$remember=false){
            

            if(!$username && !$password && $this->exists()){
                Session::put($this->_sessionName, $this->data()->id);
            }else{
                $user=$this->find($username);
                if($user){
                    
                    //echo '"ok';
                    
                    if($this->data()->password === Hash::make($password, $this->data()->salt)){
                        
                        Session::put($this->_sessionName, $this->data()->id);
                        
                        if($remember){
                            $hash = Hash::unique();

                            $hashCheck = $this->_db->get('users_session', array('user_id','=',$this->data()->id));
    
                            if(!$hashCheck->count()){
                                $this->_db->insert('users_session',array(
                                    'user_id'=>$this->data()->id,
                                    'hash'=> $hash
                                ));
                            }else{
                                $hash=$hashCheck->first()->hash;
                            }
    
                            Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));
                        }
                        return true;
                    }
                    echo $this->data()->password .'<br>';
                    echo $password.'<br>';
                    echo 'Da Base de dados '. Hash::make($password, $this->data()->salt);
                    die();
                    }
            }
            return false;
        }

        // public function hasPermission($key){
        //     $group=$this->_db->get('users',array('id', '=',$this->data()->group));
        //     //print_r($group->first());
        //     if($group->count()){
        //         $permissions = json_decode($group->first()->permissions,true);
        //         if($permissions[$key] == true){
        //             return true;
        //         }
        //     }
        //     return false;
        // }
        public function hasPermission(){
            if($this->data()->grupo==2){
                return true;
            }
            return false;
        }

        public function exists(){
            return (!empty($this->_data)) ? true : false;
        }
        public function logout(){
            $this->_db->delete('users_session',array('user_id','=',$this->data()->id));
            Session::delete($this->_sessionName);
            unset($_SESSION['usuario']);
            Cookie::delete($this->_cookieName);
        }

        public function data(){
            return $this->_data;
        }

        public function isLoggedIn(){
            return $this->_isLoggedIn;
        }
        public function getSession($data){ 
            return $this->_db->getGroup($data);
        }

        public function Credencial($estudante = array(),$credencial = array()){
           try{
            if($this->_db->insert('Estudante',$estudante)){
                $utimoEstudanteId =$this->_db->lastInsertId();
                $credencial ['IdEstudante'] = $utimoEstudanteId;
                if($this->_db->insert('Credencial',$credencial)){

                }
                return true;
            }else{
                return false;
            }

           }catch(Exception $e){
                echo "erro".$e->getMessage();
                die;
           }
            
        }
        public function Enviar($db,$fields = array()){
            if(!$this->_db->insert($db,$fields)){
                throw new Exception('Erro na insercao');
            }else{
                return true;
            }
        }
        public function activitades($tabela,$situacao){
            return $this->_db->count_pendente($tabela,$situacao);
        }
    }
