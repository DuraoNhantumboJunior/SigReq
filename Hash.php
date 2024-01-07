<?php
class Hash {
    public static function make($string, $salt = '') {
        return hash('sha256', $string . $salt);
    }

    public static function salt($length) {
        // Substituído mcrypt_create_iv por random_bytes
        return bin2hex(random_bytes($length));
    }

    public static function unique() {
        return self::make(uniqid());
    }
}
?>