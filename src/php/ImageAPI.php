<?php
include 'ProductAPI.php';
if(isset($_POST['key']) && isset($_POST['images']) && isset($_POST['upload']) && isset($_POST['access'])){
    if($_POST['access'] == "M4W9FM9FMW94UFN4WM9UFNGNQ34U9FNWQFW9BFNW9UFN9UNFRW93UFNW39FUW3"){
    $sql = '';
    $database = getDatabase("M3098FAn83anr08N3R80NAR0-nr30r3");
    
    
    if($_POST['upload']){
        $key = $_POST['key'];
        $dir = "images\\";
        if (!file_exists($dir)) 
            mkdir($dir, 0777, true);
        
        $t = $database->query("SELECT * FROM products WHERE productKey='$key' LIMIT 1");

        $row = mysqli_fetch_assoc($t);
        if(mysqli_num_rows($t) <= 0){
         $database-> close();
         return;
        }
        $id = $row['id'];
        $sql = 'INSERT INTO productimages(url, productID) VALUES ';
        foreach($_POST['images'] as $image){
            $base64 = base64_decode(explode(',', $image)[1]);
            $ext =  '.' . explode('/', explode(';', $image)[0])[1];
            $name = generateRandomString(8);
            $filepath = $dir . $name . $ext;
            while(file_exists($filepath)){
                $name = generateRandomString(8);
                $filepath = $dir . $name . $ext;
            }
            $file = fopen($filepath, 'w');
            fwrite($file, $base64);
            fclose($file);
            $sql .= "('$filepath', $id)"; 
            $sql .= ',';
        }
       $sql= rtrim($sql, ',');
        $sql .= ';';
        
    }
    else {
        $sql = 'DELETE FROM productimages WHERE ';
        foreach($_POST['images'] as $image){

               $sql .= ',';
               
            $sql .= "url='$image'";
            $sql .= ',';
        }
        $sql= rtrim($sql, ',');
        $sql .= ';';
    }
    $sql= str_replace('\\', '\\\\', $sql);
    echo($sql);
    $database->query($sql);
    $database-> close();
}
}
?>