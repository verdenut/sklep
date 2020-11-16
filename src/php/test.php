<?php
include 'AuthAPI.php';
$msg = "";
if(isset($_POST['mail']) && isset($_POST['password'])){
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $reg = isset($_POST['register']);
    if($reg){
        
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $city = $_POST['city'];
        $code = $_POST['code'];
        $street = $_POST['street'];
        $streetNumber = $_POST['streetNumber'];
        $flatNumber = $_POST['flatNumber'];
        $phoneNumber = $_POST['phone'];
        $_POST = array();
        if($name == null || $lastname == null || $city == null || $street == null || $code == null || $streetNumber == null || $phoneNumber == null){
            
        }
        if($flatNumber == null)
            $flatNumber = 'null';
        if(registerUser($name, $lastname, $password, $mail, $phoneNumber, $city, $code, $street, $streetNumber, $flatNumber))
            $msg = '<p><span style="color: green">Zarejestrowano! Możesz się teraz zalogować:</span></p>';
        else
             $msg = '<p><span style="color: red">Podany e-mail już posiada konto w naszym serwisie.</span></p>';
        
    }
    else{
    $_POST = array();
    $log = login($mail, $password);
    if($log === null || isset($_SESSION["user"])){
        header("Location: profile.php");
        die();
    }
    else
    {
        $msg = '<p><span style="color: red">Niepoprawny login lub hasło.</span></p>';
    }
    }
}



?>


<!DOCTYPE html>
<html>
    <head>
        <title>Test</title>
        <meta charset='utf-8'>
        <script src="../assets/js/jquery.min.js"></script>
    </head>
    <body>
        <center>
            <?php echo $msg; ?>
            <form action="test.php" method="post">
                <div style="margin: auto; display: inline;">
                <label for="mail">Adres e-mail:</label>
                <input type="text" name="mail" >
                <br>
                <label for="password">Hasło:</label>
                <input type="password" name="password">
                <br>
                
                <div id="nameField" style="display: none;">
                    <label for="name">Imię:</label>
                    <input type="text" name="name">
                </div>
                <br>
                <div id="lastnameField" style="display: none;">
                    <label for="lastname">Nazwisko:</label>
                    <input type="text" name="lastname">
                </div>
                <br>
                <div id="cityField" style="display: none;">
                    <label for="city">Miasto:</label>
                    <input type="text" name="city">
                </div>
                <br>
                <div id="codeField" style="display: none;">
                    <label for="name">Kod pocztowy:</label>
                    <input type="text" name="code">
                </div>
                <br>
                <div id="streetField" style="display: none;">
                    <label for="name">Ulica:</label>
                    <input type="text" name="street">
                </div>
                <br>
                <div id="streetNumberField" style="display: none;">
                    <label for="name">Numer ulicy:</label>
                    <input type="text" name="streetNumber">
                </div>
                <br>
                <div id="flatNumberField" style="display: none;">
                    <label for="name">Numer mieszkania:</label>
                    <input type="text" name="flatNumber">
                </div>
                <br>
                <div id="phoneField" style="display: none;">
                    <label for="name">Numer telefonu:</label>
                    <input type="number" name="phone">
                </div>
                <br>
                </div>
                <div style="margin: auto; display: inline;">
                <label for="register">Zarejestruj</label>
                <input  type="checkbox" name="register" id="registerBox">
                <br>
                <input type="submit" value="Zaloguj">
                </div>
            </form>
        </center>
        <script>
            let elements = [$('#nameField'), $('#lastnameField'), $('#cityField'), $('#codeField'), $('#streetField'), $('#streetNumberField'), $('#flatNumberField'), $('#phoneField')];
            $('#registerBox').click( function(){
                if( $(this).is(':checked') ){
                    for(var i of elements)
                        i.css("display", "inline");
                }
                else
                    for(var i of elements)
                        i.css("display", "none");
            });
        </script>
    </body>
</html>