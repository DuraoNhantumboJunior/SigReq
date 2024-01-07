<?php
    class Hash{
        public static function make($string, $salt=''){
            return hash('sha256',$string.$salt);
        }

        public static function salt($length){
            return hex2bin(random_bytes(($length)));
        
        }
        

        public static function unique(){
            return self::make(uniqid());
        }
    }