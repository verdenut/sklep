<?php
include 'DatabaseAPI.php';
include 'EncryptionAPI.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
session_start();
    if(isset($_POST['action'])){
		
        $jsonObj = [];
        if($_POST['action'] == "register"){
          if(isset($_POST['name']) && isset($_POST['lastname']) && isset($_POST['pass']) && isset($_POST['mail']) && isset($_POST['phone']) && isset($_POST['city']) && isset($_POST['code'])  && isset($_POST['street'])  && isset($_POST['number'])  && isset($_POST['mnumber']) ){
              $name = $_POST['name'];
              $lastname = $_POST['lastname'];
              $pass = $_POST['pass'];
              $mail = $_POST['mail'];
              $phone = $_POST['phone'];
              $city = $_POST['city'];
              $code = $_POST['code'];
              $street = $_POST['street'];
              $number = $_POST['number'];
              $mnumber = $_POST['mnumber'];
              $jsonObj["result"] = registerUser($name, $lastname, $pass, $mail, $phone, $city, $code, $street, $number, $mnubmer);
          }
        }
        else if($_POST['action'] == "login"){
          if(isset($_POST['mail']) && isset($_POST['pass'])){
              $mail = $_POST['mail'];
              $pass = $_POST['pass'];
              $jsonObj["result"] = login($mail, $pass);
          }
        }
        else if($_POST['action'] == "get_session"){
          $varr = authorize();
          $jsonObj["result"] = $varr;
          if($varr){
              $jsonObj["user"] = $_SESSION['user'];
          }
        }
		else if($_POST['action'] == "logout"){

			session_unset();
			$jsonObj["result"] = true;
		}
        else
          $jsonObj["result"] = "undefined";
        $json = json_encode($jsonObj);
        echo($json);
    }
function registerUser ($name, $lastname, $pass, $mail, $phone, $city, $code, $street, $number, $mnumber) {

    $name = encryptDecrypt($name, 'T7tEko2RcwKRP7sJ6ib6RfJ2BTBp5baTc+YK8Y6iXqk=', true);
    $lastname = encryptDecrypt($lastname, 'T7tEko2RcwKRP7sJ6ib6RfJ2BTBp5baTc+YK8Y6iXqk=', true);
    $mail = encryptDecrypt($mail, 'T7tEko2RcwKRP7sJ6ib6RfJ2BTBp5baTc+YK8Y6iXqk=', true);
    $phone = encryptDecrypt($phone, 'T7tEko2RcwKRP7sJ6ib6RfJ2BTBp5baTc+YK8Y6iXqk=', true);
    $city = encryptDecrypt($city, 'T7tEko2RcwKRP7sJ6ib6RfJ2BTBp5baTc+YK8Y6iXqk=', true);
    $code = encryptDecrypt($code, 'T7tEko2RcwKRP7sJ6ib6RfJ2BTBp5baTc+YK8Y6iXqk=', true);
    $street = encryptDecrypt($street, 'T7tEko2RcwKRP7sJ6ib6RfJ2BTBp5baTc+YK8Y6iXqk=', true);
    $number = encryptDecrypt($number, 'T7tEko2RcwKRP7sJ6ib6RfJ2BTBp5baTc+YK8Y6iXqk=', true);
    $mnumber = encryptDecrypt($mnumber, 'T7tEko2RcwKRP7sJ6ib6RfJ2BTBp5baTc+YK8Y6iXqk=', true);
    $pass = md5($pass);

    $sql = "INSERT INTO users (name, lastname, mail, phone, city, code, street, number, mnumber, pass) VALUES ('$name', '$lastname', '$mail', '$phone', '$city', '$code', '$street', '$number', '$mnumber', '$pass')";
    $database = getDatabase("M3098FAn83anr08N3R80NAR0-nr30r3");
    $t = $database->query($sql) === TRUE;
    $database->close();
    return $t;
}
function login($mail, $pass){
  if(isset($_SESSION['user']))
    return null;
  $smail = encryptDecrypt($mail, 'T7tEko2RcwKRP7sJ6ib6RfJ2BTBp5baTc+YK8Y6iXqk=', true);
  $spass = md5($pass);
  $sql = "SELECT * FROM users WHERE mail = '$smail' AND pass = '$spass' LIMIT 1";
  $database = getDatabase("M3098FAn83anr08N3R80NAR0-nr30r3");
  $t = $database->query($sql);
  if($t === false)
    return false;
  if(mysqli_num_rows($t) <= 0){

    $sql = "SELECT * FROM admins WHERE email = '$smail' AND pass = '$spass' LIMIT 1";
    $t = $database->query($sql);
    if(mysqli_num_rows($t) <= 0)
      return false;
    $row = mysqli_fetch_assoc($t);
    $database->close();
    $name = encryptDecrypt($row['name'], 'T7tEko2RcwKRP7sJ6ib6RfJ2BTBp5baTc+YK8Y6iXqk=', false);

    $user = new User($name, '', $mail, '', new Address('', '', '', '', ''), $spass);
    $user->isAdmin = true;
    $_SESSION['user'] = $user;
    $_SESSION['activity'] = time();
    return $user;
  }
  $row = mysqli_fetch_assoc($t);
  $name = encryptDecrypt($row['name'], 'T7tEko2RcwKRP7sJ6ib6RfJ2BTBp5baTc+YK8Y6iXqk=', false);

  $lastname = encryptDecrypt($row['lastname'], 'T7tEko2RcwKRP7sJ6ib6RfJ2BTBp5baTc+YK8Y6iXqk=', false);
  $phone = encryptDecrypt($row['phone'], 'T7tEko2RcwKRP7sJ6ib6RfJ2BTBp5baTc+YK8Y6iXqk=', false);
  $city = encryptDecrypt($row['city'], 'T7tEko2RcwKRP7sJ6ib6RfJ2BTBp5baTc+YK8Y6iXqk=', false);
  $code = encryptDecrypt($row['code'], 'T7tEko2RcwKRP7sJ6ib6RfJ2BTBp5baTc+YK8Y6iXqk=', false);
  $street = encryptDecrypt($row['street'], 'T7tEko2RcwKRP7sJ6ib6RfJ2BTBp5baTc+YK8Y6iXqk=', false);
  $number = encryptDecrypt($row['number'], 'T7tEko2RcwKRP7sJ6ib6RfJ2BTBp5baTc+YK8Y6iXqk=', false);
  $mnumber = encryptDecrypt($row['mnumber'], 'T7tEko2RcwKRP7sJ6ib6RfJ2BTBp5baTc+YK8Y6iXqk=', false);
  $user = new User($name, $lastname, $mail, $phone, new Address($city, $code, $street, $number, $mnumber), $spass);
  $_SESSION['user'] = $user;
  $_SESSION['activity'] = time();
  $database->close();
  return $user;
}
function authorize(){
  if(!isset($_SESSION['user']))
    {
      header("Location: test.php");
      die();
    }
    $t = time();
    $t0 = $_SESSION['activity'];
    $diff = $t - $t0;
    if ($diff > 1500 || !isset($t0))
    {          
      session_unset();
      session_destroy();
      header("Location: test.php");         
      exit;
    }
    else
        $_SESSION['activity'] = time();
    
    if($_SESSION['user']->isAdmin){
      $database = getDatabase("M3098FAn83anr08N3R80NAR0-nr30r3");
      $t = $database->query('SELECT * FROM admins WHERE pass= "' . $_SESSION['user']->pass . '"');
      if($t === false || mysqli_num_rows($t) <= 0){
        session_unset();
        $database->close();
        return false;
      }
      $database->close();
    }
  return true;
}
class User{
public $name;
public $lastname;
public $mail;
public $phone;
public $adress;
public $pass;
public $isAdmin = false;
  function __construct($Name, $Lastname, $Mail, $Phone, $Address, $Pass)
  {
    $this->name = $Name;
    $this->lastname = $Lastname;
    $this->mail = $Mail;
    $this->phone = $Phone;
    $this->adress = $Address;
    $this->pass = $Pass;
  }
}
class Address{
public $city;
public $code;
public $street;
public $streetNumber;
public $flatNumber;
  function __construct($cit, $cod, $stret, $numStreet, $numFlat){
    $this->city = $cit;
    $this->code = $cod;
    $this->street = $stret;
    $this->streetNumber = $numStreet;
    $this->flatNumber = $numFlat;
  }
}
?>