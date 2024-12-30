<?php



$host = "localhost";
$user = "root";
$pass = "";
$db = "login";
$conn = new mysqli('localhost' , 'root' , '' , 'park_n_go' );

if($conn->connect_error){
    echo "failed to connect DB".$conn->connect_error;

;

}
function unique_id(){
    $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIKLMNOPQRSTUVWXYZ';
    $charLenght = strlen($char);
    $randomString = '';
    for($i = 0; $i < 20; $i++){

        $randomString.=$char[mt_rand(0 , $charLenght)-1];

    }
    return $randomString;
}



?>