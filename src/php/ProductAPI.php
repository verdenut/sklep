<?php 
require 'AuthAPI.php';
if(isset($_POST['productName']) && isset($_POST['productDescription']) && isset($_POST['productValue']) && isset($_POST['hidden']) && isset($_POST['productImages']) && isset($_POST['productType'])){
    $product = new Product($_POST['productName'], $_POST['productDescription'], $_POST['productImages'], $_POST['productType'], $_POST['productValue'], $_POST['hidden']);
    $jsonData = array();
    if(addProduct($product)){
        $key = $product->key;
        $params = array('key' => $key, 'images' => $_POST['productImages'], 'upload' => true, 'access' => "M4W9FM9FMW94UFN4WM9UFNGNQ34U9FNWQFW9BFNW9UFN9UNFRW93UFNW39FUW3");
        $query = http_build_query ($params);
        $curl_connection = curl_init('http://localhost/dashboard/projekt/ImageAPI.php');
        curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($curl_connection, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
        curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl_connection, CURLOPT_POSTFIELDS, $query);
        $result = curl_exec($curl_connection);
        $jsonData = array();
        if ($result === FALSE) 
            $jsonData['result'] = false;
        else{
            $jsonData['result'] = true;
            var_dump($result);
            $product = Product::getFromKey($key);
            $jsonData['product'] = $product->getVars();
        }
        curl_close($curl_connection);
    }
    else
        $jsonData['result'] = false;
    echo(json_encode($jsonData));
}

if(isset($_GET['key'])){
    $key = $_GET['key'];
    $product = Product::getFromKey($key);
    $jsonData = array();
    if($product === null)
        $jsonData['result'] = false;
    else 
        {
            $jsonData['result'] = true;
            $jsonData['product'] = $product->getVars();
        }
    echo(json_encode($jsonData));
}
if(isset($_GET['list'])){
    $database = getDatabase("M3098FAn83anr08N3R80NAR0-nr30r3");
    $t = $database->query("SELECT productKey FROM products");
    $jsonData = array();
    $products = array();
    while ($row = $t->fetch_assoc()){
        if(!isset($jsonData['result']))
            $jsonData['result'] = true;
        $key = $row['productKey'];
        $product = Product::getFromKey($key);
        $products[$key] = $product->getVars();
    }
    $database->close();
    if(!isset($jsonData['result']))
        $jsonData['result'] = false;
    $jsonData['products'] = $products;
    echo(json_encode($jsonData));
}
class Product{

    public $name;
    public $description;
    public $images;
    public $type;
    public $key = null;
    public $value;
    public $hidden;
    function __construct($pname, $pdesc, $pimages, $ptype, $pvalue, $phidden, $pkey=null){
        $this->name = $pname;
        $this->description  = $pdesc;
        $this->images  = $pimages;
        $this->type  = $ptype;
        $this->value = $pvalue;
        $this->hidden = $phidden;
        $this->key = $pkey;
    }
    public function getVars(){
        return get_object_vars($this);
    }
    public static function getFromKey($key ) {
        $database = getDatabase("M3098FAn83anr08N3R80NAR0-nr30r3");
        $t = $database->query("SELECT * FROM (products LEFT JOIN productImages ON productImages.productID = products.id) WHERE products.productKey='$key'");
        if(mysqli_num_rows($t) < 1)
            return null;
        $pname;
        $pdesc = '';
        $pimages = array();
        $ptype = 1;
        $pvalue = 0;
        $phidden = false;
        while ($row = $t->fetch_assoc()){
            if(!isset($pname)){
                $pname = $row['name'];
                $pdesc = $row['description'];
                $ptype = $row['productType'];
                $pvalue = $row['value'];
                $phidden = (boolean) $row['hidden'];
            }
            array_push($pimages, $row['url']);
        }
        $database->close();
        $product = new Product($pname, $pdesc, $pimages, $ptype, $pvalue, $phidden, $key);
        return $product;

    }
    function update(){
        authorize();
        if(!($_SESSION['user']->isAdmin))
            return null;
        if($this->key === null)
            return null;
        $database = getDatabase("M3098FAn83anr08N3R80NAR0-nr30r3");
        $sql = "UPDATE products SET name = '$this->name',  description = '$this->description', productType = '$this->type', value = '$this->value', hidden='$this->hidden' WHERE products.productKey = '$this->key'";
        $t = $database->query($sql) === TRUE;
        $database->close();
        return $t;
    }
}

function addProduct($product){
    authorize();
    if(!($_SESSION['user']->isAdmin))
        return null;
    $database = getDatabase("M3098FAn83anr08N3R80NAR0-nr30r3");
    $num = 0;
    do{
        $product->key = generateRandomString(6);
        $t = $database->query("SELECT * FROM products WHERE productKey='$product->key'");
        $num = mysqli_num_rows($t);
    }
    while ($num != 0);
    $sql = "INSERT INTO products (name, description, productType, productKey, value, hidden) VALUES ('$product->name', '$product->description', '$product->type', '$product->key', '$product->value', '$product->hidden')";
   $t = $database->query($sql) === TRUE;
   $database->close();
   return $t;
}

function removeProduct($productKey){
    authorize();
    if(!($_SESSION['user']->isAdmin))
        return null;
    if($productKey === null)
            return null;
    $database = getDatabase("M3098FAn83anr08N3R80NAR0-nr30r3");
    $sql = "DELETE FROM products WHERE productKey= '$productKey'";
    $t = $database->query($sql) === TRUE;
    $database->close();
    return $t;
}
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}