<?php
include('./db.php');

$iusername=$_POST['iusername'];
$ipassword=$_POST['ipassword'];
$iname=$_POST['iname'];


$username=$_POST['username'];
$password=$_POST['password'];



 $price=$_POST["price"];
    $title=$_POST["title"];
    $imageurl=$_POST["imageurl"] ;   
    $cat=$_POST["cat"];
    $marque= $_POST["marque"]   ;
    $taille= $_POST["taille"];
        
if(isset($_POST["addproduct"])){
    
   
    $requ = loadDB("INSERT INTO `product` (`id`, `price`, `title`, `imageurl`, `cat`, `marque`, `taille`) VALUES(NULL,'$price','$title','$imageurl','$cat','$marque','$taille')");
    header('location:admin.php');

}

if(isset($_POST["register"])){
    $r = loadDB("SELECT * FROM user WHERE username=".$iusername);
    $count = mysqli_num_rows($r); 
    if($count==0){
        $req = loadDB("INSERT INTO user (id,name,username,password)  VALUES(NULL,'$iname','$iusername','$ipassword')");
        header('location:index.php');
    }
    else{
        header('location:eroor.php');
    }
    

}


if(isset($_POST["se_connecter"])){
    $req = loadDB("SELECT * FROM user");
    while($data = mysqli_fetch_array($req)){
        if($username==$data["username"] AND $password==$data["password"]){
            $expir=time() + 3600*60;
            setcookie("id",$data["id"],$expir);
            

            header('location:my_account.php');
         }
     }
        
           
    $r = loadDB("SELECT * FROM `admin` WHERE `admin_user` LIKE '$username' AND `admin_password` LIKE '$password'");
  
    while($d = mysqli_fetch_array($r)){
        $exp=time() + 3600*60;
        setcookie("adminUser",$d["admin_user"],$exp);
        setcookie("adminPass",$d["admin_password"],$exp);
        header('location:admin.php');
    }
  
   
    header('location:index.php'); 
   
            
               
            
            
 }
   
    





?>