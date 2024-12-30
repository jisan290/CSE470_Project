<?php


include 'connect.php';

if(isset($_POST['customer'])){
    $id = unique_id();
    $firstName = $_POST['fname'];
    $lastName = $_POST['lname'];
    $gmail = $_POST['gmail'];
    $pass = $_POST['password'];
   
    $phone = $_POST['phone'];

    $address = $_POST['saddress'];
    $parts = explode('-', $address);


 
    $city = $parts[0];
    $road = $parts[1];
    $house = $parts[2];
    
    $nid = $_POST['nid'];
    $image = 'uploads/default.png';

    #-----


     $checkEmail = "SELECT * From users where gmail = '$gmail'";
     $result = $conn->query($checkEmail);
     if($result->num_rows>0){
        echo "email already exits";
     }
     else {
        $insertQuery = "INSERT INTO users(first_name , last_name , gmail , password ,city , road , house, nid  , unique_id , image)
        VALUES('$firstName' , '$lastName' , '$gmail' , '$pass' ,'$city','$road','$house', '$nid' , '$id' , '$image')";


        $insertQuery2 = "INSERT INTO users_phones(supplier_id , phone)
        VALUES('$id' , '$phone')";
        $conn->query($insertQuery2);
        if($conn->query($insertQuery)==TRUE){
            header("location: login.html");
        }
        else {
            echo "error:".$conn->error;
        }
        

     }

}elseif(isset($_POST['owner'])){
    $uniqueID = unique_id();
    $cartID = unique_id();
    $name = $_POST['name'];
    $gmail = $_POST['gmail'];
    $pass = $_POST['password'];
   
    $phone = $_POST['phone'];
    $address = $_POST['saddress'];
    $parts = explode('-', $address);

     
    $city = $parts[0];
    $road = $parts[1];
    $house = $parts[2];
     

     $checkEmail = "SELECT * From  owner where gmail = '$gmail'";
     $result = $conn->query($checkEmail);
     if($result->num_rows>0){
       echo "email already exits";
     }
     else {
        $insertQuery = "INSERT INTO owner(name , gmail , password , city , road , house, unique_id)
        VALUES('$name', '$gmail' , '$pass' , '$city','$road' , '$house', '$uniqueID')";
        // $cart_insert = "INSERT INTO cart(customer_id, cart_id)
        // VALUES('$uniqueID' , '$cartID')";
        $c_phone = "INSERT INTO owners_phones(customer_id , phones)VALUES('$uniqueID' , '$phone')";
        $conn->query($c_phone);
        // $conn->query($cart_insert);
        if($conn->query($insertQuery)== TRUE){
            header("location: login.html");
        }else {

        }echo "error:".$conn->error;

     }


}elseif(isset($_POST['login'])){
    $gmail = $_POST['login_gmail'];
    $pass = $_POST['login_password'];

     if($gmail == 'admin' && $pass == 'admin646'){
        header("location: admin.html");
     }else {
        

        $checkEmail_from_supplier = "SELECT * From supplier where gmail = '$gmail'";
        $checkPassword_from_supplier = "SELECT * From supplier where password = '$pass'";


        $checkEmail_from_customer = "SELECT * From customer where gmail = '$gmail'";
        $checkPassword_from_customer = "SELECT * From customer where password = '$pass'";


        $result1 = $conn->query($checkEmail_from_supplier);
        $passResult1 = $conn->query($checkPassword_from_supplier);



        $result2 = $conn->query($checkEmail_from_customer);
        $passResult2 = $conn->query($checkEmail_from_customer);


        if($result1->num_rows>0 && $passResult1->num_rows>0){
            session_start();

            $fname = "select first_name from supplier where password = '$pass'";
            $lname = "select last_name from supplier where password = '$pass'";

            $selID = "select unique_id from supplier where gmail = '$gmail'";
            $stmt = $conn->query($selID);
            $rs = $stmt->fetch_assoc();
            $resultID = $rs['unique_id'];
            



            $fR = $conn->query($fname);
            $lR = $conn->query($lname);

            $r1 = $fR->fetch_assoc();
            $r2 = $lR->fetch_assoc();

            $firstName = $r1['first_name'];
            $lastName = $r2['last_name'];

            

            $_SESSION['fname'] = $firstName;
            $_SESSION['lname'] = $lastName;
            $_SESSION['supplier_id'] = $resultID;

            header("location: sellerhome.php");
            exit();
            
            



        }elseif($result2->num_rows>0 && $passResult2->num_rows>0){
            session_start();
           


            $cusID = "select unique_id from customer where gmail = '$gmail'";
            $stmt = $conn->query($cusID);
            $rs = $stmt->fetch_assoc();
            $resultID = $rs['unique_id'];
            $_SESSION['customer_id'] = $resultID;
            echo $resultID;
            

            header("location: ../customers_part/home.html");



            exit();

        
        
        }else{

            header("location: login.html");
        }




     }
    
     


}elseif(isset($_POST['add'])){
    session_start();
    $product_id = unique_id();
    $title = $_POST['title'];
    $description = $_POST['description'];
    if (isset($_POST['category'])) {
        $category = $_POST['category'];

        
        $validCategories = ['1', '2', '3']; 
        if (in_array($category, $validCategories)) {
          
            switch ($category) {
                case '1':
                    $category = 'Crops';
                    break;
                case '2':
                    $category = 'Vegetables';
                    break;
                case '3':
                    $category = 'Fruits';
                    break;
                default:
                    $category = 'Unknown'; 
            }
        } else {
            
            $category = null;
        }
    }
    $price = $_POST['price'];
    $discountPercentage = $_POST['discount'];

    $tags = json_encode($_POST['tags']);
    $brand = $_POST['brand'];
  
    $stock = $_POST['stock'];
    $images = json_encode($_POST['imgfile']);
    
   
  
    $shippingInformation = '2 to 3 days';
    $availabilityStatus = 'In Stock';

    $returnPolicy = $_POST['return'];
    $supplier_id = isset($_SESSION['supplier_id_form']) ? $_SESSION['supplier_id_form'] : '';
    $_SESSION['recently-added'];
    


    $sql = "INSERT INTO products (product_id ,title, description, category, price, discountPercentage, stock, tags, brand,shippingInformation ,availabilityStatus,returnPolicy, images, supplier_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssssss",$product_id, $title, $description, $category, $price, $discountPercentage,  $stock, $tags, $brand, $shippingInformation, $availabilityStatus, $returnPolicy, $images, $supplier_id);


    $stmt->execute();
    header("location: sellerhome.php");
    

    $stmt->close();
    $conn->close();
    exit();




}
?>