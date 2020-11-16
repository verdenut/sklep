<?php

    
function getDatabase($s){

      if($s == "M3098FAn83anr08N3R80NAR0-nr30r3"){
        $host = "127.0.0.1";
        $user = "dbconnect";
        $password = "znq2pnrxu8Ln390L";
        $db = "main";
        $database = new mysqli($host,$user,$password,$db);

        if ($database -> connect_errno) 
          return false;
        return $database;
    }
      return null;
    }
?>