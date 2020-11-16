<?php
    function encryptDecrypt($text, $key, $encrypt){
        
        $cipher = "aes-256-ctr";  
        $iv = base64_decode('tkv0Eu0err46lhv888uewQ==');
        $s = '';
        if($encrypt)
            $s = openssl_encrypt($text, $cipher, $key, $options=0, $iv);
        else
            $s =  openssl_decrypt($text, $cipher, $key, $options=0, $iv);   
        return $s;  
    }
    //echo (encryptDecrypt('Administrator', 'T7tEko2RcwKRP7sJ6ib6RfJ2BTBp5baTc+YK8Y6iXqk=', true) . ":" . encryptDecrypt('root', 'T7tEko2RcwKRP7sJ6ib6RfJ2BTBp5baTc+YK8Y6iXqk=', true) . ":" . md5("346T4jacnaRFN39n3f93M(f(#FANF9n3faN#Buaf"));
?>