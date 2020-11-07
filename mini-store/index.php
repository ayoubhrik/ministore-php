<?php
include('./db.php');
if(isset($_COOKIE['adminUser'])){
 header('location:admin.php');
}
if(isset($_COOKIE['id'])){
$id=$_COOKIE['id'];     
$req = loadDB("SELECT * FROM user WHERE id=".$id);
$count = mysqli_num_rows($req); 
    if($count==1){
        $data = mysqli_fetch_array($req);
        $name= $data["name"];
        $username= $data["username"];
        $password= $data["password"];
    }


}





if(isset($_GET["id"])){
	if(isset($_COOKIE['id'])){
    $req = loadDB("SELECT * FROM cart WHERE product_id=".$_GET["id"]." AND user_id=".$_COOKIE['id']."");
    $count = mysqli_num_rows($req);
    if($count>0){
        header('location: ');
    }
    else{
        $r = loadDB("INSERT INTO `cart` (`id`, `product_id`, `user_id`, `qty`) VALUES (NULL, '".$_GET["id"]."', '".$_COOKIE['id']."', '1')");
        header('location: ?c=all');
    }
    }
}


function countCart($id){
	if(isset($_COOKIE['id'])){
    $r = loadDB("SELECT * FROM `cart` WHERE `user_id`=".$_COOKIE['id']);
    return mysqli_num_rows($r);
	}
	return 0;
}


if(isset($_GET["search"])){
    $search_keyword = $_GET["kwrd"];
    $req = loadDB("SELECT * FROM product WHERE 'title' LIKE '%$search_keyword%' OR 'cat' LIKE '%$search_keyword%' OR 'marque' LIKE '%$search_keyword%'");
}
 if(isset($_POST["search"]))  
 {  
      if(!empty($_POST["kwrd"]))  
      {  
           $post2get = str_replace(" ", "+", $_POST["kwrd"]);  
           header("location: ?kwrd=".$post2get);  
      }  
 }

?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>La Redoute</title>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
<link rel="stylesheet" href="css/icon.css?family=Material+Icons">
<link rel="stylesheet" href="css/style2.css">
<link rel="stylesheet" href="css/filter.css">
<link rel="shortcut icon" href="./images/favicon.png">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<style type="text/css">
	body{
		font-family: 'Source Sans Pro',sans-serif;
        color: #040707;
	}
	.form-control {
		box-shadow: none;
		border-radius: 4px;        
        border-color: #dfe3e8;
	}
	.form-control:focus {
		border-color: #040707;
		box-shadow: 0 0 0px rgba(0,0,0,0.1);
	}
	.navbar-header.col {
        
		padding: 0 !important;
	}	
	.navbar {
        
		background: #fff;
		padding-left: 16px;
		padding-right: 16px;
		border-bottom: 1px solid #dfe3e8;
		border-radius: 0;
        margin-bottom: 0px !important;
	}
	.navbar .navbar-brand {
		font-size: 20px;
		padding-left: 0;
		padding-right: 50px;
	}
	.navbar .navbar-brand b {
		font-weight: bold;
		color: #040707;		
	}
	.navbar ul.nav li a {
		color: #191919;
	}
	.navbar ul.nav li a:hover, .navbar ul.nav li a:focus {
		color: #040707 !important;
	}
	.navbar ul.nav li.active > a, .navbar ul.nav li.open > a {
		color: #040707 !important;
		background: transparent !important;
	}
    .navbar .form-inline .input-group-addon {
		box-shadow: none;
        border-radius: 2px 0 0 2px;
		background: #f5f5f5;
        border-color: #dfe3e8;
        font-size: 16px;
    }
	.navbar .form-inline i {
		font-size: 16px;
	}
    .navbar-default .navbar-collapse, .navbar-default .navbar-form {
    border-color: #fff; 
    
    }
	.navbar .form-inline .btn ,.form-register .btn{
		border-radius: 2px;
		color: #fff;
        border-color: #040707;
		background: #040707;
		outline: none;
	}
    .form-register input{
       
		border-radius: 0 2px 2px 0;
    }
	.navbar .form-inline .btn:hover, .navbar .form-inline .btn:focus {
        border-color: #040707;
		background: #040707;
    }
	.navbar .search-form {
		display: inline-block;
	}
	.navbar .search-form .btn {
		margin-left: 0px;
	}
    #search-btn{
        border-radius: 0px !important;
        border: 0!important;
        border-bottom: 1px solid #474747!important;
		color: #040707 !important;
        margin-top: 1px;
		background: #fff !important;
		outline: none;
        
        padding: 8px 12px;
        
    }
    
	.navbar .search-form .form-control {
		border-radius: 0px;
        border: 0;
        border-bottom: 1px solid #474747;
	}
	.navbar .login-form .input-group {
		margin-right: 4px;
		float: left;
	}
	.navbar .login-form .form-control {
		max-width: 158px;
		border-radius: 0 2px 2px 0;
	}    	
	.navbar .navbar-right .dropdown-toggle::after {
		display: none;
	}
	.navbar .dropdown-menu {
		border-radius: 1px;
		border-color: #e5e5e5;
		box-shadow: 0 2px 8px rgba(0,0,0,.05);
	}
	    .dropdown-menu-register {
		width: 300px !important;
		
	}
	.navbar .dropdown-menu li a {
		padding: 6px 20px;
	}
	.navbar .navbar-right .dropdown-menu {
		width: 560px;
		padding: 20px;
		left: auto;
		right: 0;
        font-size: 14px;
	}
    #nav-item-moncompte{
        width: 50px !important;
    }
    .section {
      width: 100%;
      height: 56px;
      background-color: #fff;
      border-bottom: 1px solid #dfe3e8;
    }

    .container {
      display: -webkit-box;
      display: -webkit-flex;
      display: -ms-flexbox;
      display: flex;
      height: 100%;
      -webkit-box-pack: center;
      -webkit-justify-content: center;
      -ms-flex-pack: center;
      justify-content: center;
      -webkit-box-align: stretch;
      -webkit-align-items: stretch;
      -ms-flex-align: stretch;
      align-items: stretch;
    }
    
    .list {
      display: -webkit-box;
      display: -webkit-flex;
      display: -ms-flexbox;
      display: flex;
      width: 100%;
      -webkit-box-align: center;
      -webkit-align-items: center;
      -ms-flex-align: center;
      align-items: center;
    }
    .item-wrapper {
      display: -webkit-box;
      display: -webkit-flex;
      display: -ms-flexbox;
      display: flex;
      height: 100%;
      padding-right: 20px;
      padding-left: 20px;
      -webkit-box-align: center;
      -webkit-align-items: center;
      -ms-flex-align: center;
      align-items: center;
    }
    
    .itemlink{
         color: #040707;
         text-decoration: none;
    }
    .itemlink:active,.itemlink:hover,.itemlink:focus{
     text-decoration: none;
       color: #fff;
        background-color: #040707;
    }
    
    .col-sm-4{
        margin-top: 30px;
    }
    .col-md-12 h2 {
        margin-top: 50px;
    }
	.row-card{
		display: flex;
		flex-wrap: wrap;
		margin-right: -15px;
		margin-left: -15px;
	}

	@media (min-width: 1200px){
		.search-form .input-group {
			width: 300px;
			margin-left: 30px;
		}
	}
	@media (max-width: 768px){
		.navbar .navbar-right .dropdown-menu {
			width: 100%;
			background: transparent;
			padding: 10px 20px;
		}
		.navbar .input-group {
			width: 100%;
			margin-bottom: 15px;
		}
		.navbar .input-group .form-control {
			max-width: none;			
		}
		.navbar .login-form .btn {
			width: 100%;
		}
		        .dropdown-menu-register {
            width: 100% !important;
		
		
	    }
	}
    @media (max-width: 479px) {
      .section {
        height: 200px;
      }
      .container {
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -webkit-flex-direction: column;
        -ms-flex-direction: column;
        flex-direction: column;
        -webkit-box-align: center;
        -webkit-align-items: center;
        -ms-flex-align: center;
        align-items: center;
      }
      .item-wrapper {
        padding-top:  10px;
        padding-bottom: 10px;
      }
    }
	

.p-grid{
    font-family: 'Roboto', sans-serif;
    position: relative;
}
.p-grid .product-image{
    overflow: hidden;
    position: relative;
}
.p-grid .product-image:before{
    content: "";
    background: rgba(0,0,0,0.3);
    width: 100%;
    height: 100%;
    opacity: 0;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1;
    transition: all 0.4s ease-out 0s;
}
.p-grid:hover .product-image:before{ opacity: 1; }
.p-grid .product-image a{ display: block; }
.p-grid .product-image img{
    width: 100%;
    height: auto;
}




.p-grid .social {
    padding: 0;
    margin: 0;
    list-style: none;
    
    position: absolute;
    top: 45%;
    left: 45%;
    z-index: 4;
}
.p-grid .social li {
    margin: 0 0 12px;
    opacity: 0;
    transform: translateX(-60px);
    transition: transform .3s ease-out 0s;
}
.p-grid:hover .social li {
    opacity: 1;
    transform: translateX(0);
}
.p-grid:hover .social li:nth-child(2){ transition-delay: 0.1s; }
.p-grid:hover .social li:nth-child(3){ transition-delay: 0.2s; }
.p-grid:hover .social li:nth-child(4){ transition-delay: 0.3s; }
.p-grid .social li a {
    color: #fff;
    font-size: 22px;
    transition: all 0.3s;
}

.p-grid .product-content{ padding: 12px 0; }
.p-grid .title{
    font-size: 15px;
    font-weight: 400;
    text-transform: capitalize;
    margin: 0 0 5px;
}
.p-grid .title a{ color: #040707; text-decoration:none; }
.p-grid .title a:hover{ color:  #e74c3c; text-decoration:none; }
.p-grid .price{
    color: #333;
    font-size: 14px;
    font-weight: 400;
}
.p-grid .price span{
    color: #333;
    text-decoration: line-through;
    margin-right: 3px;
}
.p-grid .price.discount{ color:  #e74c3c; }
@media only screen and (max-width:990px){
    .p-grid{ margin-bottom: 30px; }
}


</style>
</head> 
<body>
<nav class="navbar navbar-default navbar-expand-lg navbar-light">
	<div class="navbar-header d-flex col">
		<a class="navbar-brand" href="index.php"><img src="images/LR-logo.svg"></a>  		
		<button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle navbar-toggler ml-auto">
			<span class="navbar-toggler-icon"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
	</div>
	
	<div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
	
		<form class="navbar-form form-inline search-form" method="post" action="">
			<div class="input-group">
				<input type="text" class="form-control" name="kwrd" placeholder="Que recherchez-vous ?">
				<span class="input-group-btn">
					<button type='submit' name="search" id="search-btn"><i class="fa fa-search"></i></button>
				</span>
			</div>
		</form>
		<?php 
		if(isset($_COOKIE['id'])){
		?>
		
		<ul class="nav navbar-nav navbar-right ml-auto">
		    
			<li class="nav-item dropdown" >
				<a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle user-action"><i class="fa fa-user"></i> <?php echo $name; ?> <b class="caret"></b></a>
				<ul class="dropdown-menu" id="nav-item-moncompte">
					<li><a href="#" class="dropdown-item"><i class="fa fa-user-o"></i> Profile</a></li>
					
					<li><a href="my_orders.php" class="dropdown-item"><i class="fa fa-sliders"></i> Orders</a></li>
					<li class="divider dropdown-divider"></li>
					<li><a href="logout.php" class="dropdown-item"><i class="fa fa-sign-out"></i> Logout</a></li>
				</ul>
			</li>
			
			<li><a class="nav-link" href="cart.php"><i class="fa fa-shopping-cart"></i> MON PANIER (<?php echo countCart($_COOKIE['id']) ?>)</a></li>
		</ul>
		<?php		
		}else{
		?>
				<ul class="nav navbar-nav navbar-right ml-auto">
		    <li class="nav-item dropdown"><a data-toggle="dropdown"  class="nav-link" href="#"><i class="fa fa-user-plus"></i> CREER MON COMPTE</a>
		        <ul class="dropdown-menu form-wrapper dropdown-menu-register">					
					<li>
						<form action="acces.php" method="post" class="form-register">
							<p class="hint-text">Remplissez ce formulaire pour créer votre compte!</p>
							<div class="form-group">
								<input type="text" class="form-control" name="iname" placeholder="Votre nom et prenom" required="required">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" name="iusername" placeholder="Votre username" required="required">
							</div>
							<div class="form-group">
								<input type="password" class="form-control" name="ipassword" placeholder="Votre Mot de passe" required="required">
							</div>
							
							<input type="submit" class="btn btn-primary btn-block" name="register" value="Créer votre compte">
						</form>
					</li>
				</ul>
		    </li>
			<li class="nav-item dropdown">
				<a data-toggle="dropdown" class="nav-link dropdown-toggle" href="#"><i class="fa fa-user"></i> SE CONNECTER</a>
				<ul class="dropdown-menu">
					<li>
                        <form class="form-inline login-form" action="acces.php" method="post">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" name="username" placeholder="Username" required>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="text" class="form-control" name="password" placeholder="Password" required>
                            </div>
                            <button type="submit" name="se_connecter" class="btn btn-primary">Se Connecter</button>
                        </form> 
                                      
					</li>
				</ul>
			</li>
			
			<li><a class="nav-link" href="#"><i class="fa fa-shopping-cart"></i> MON PANIER (0)</a></li>
		</ul>
		<?php
		}
		?>
		
	</div>
</nav>

<div class="section">
    <div class="container w-container">
       <a href="?c=femme" class="itemlink">
           <div class="item-wrapper">
              <div class="item-list">Femme</div>
           </div>
       </a>
      <a href="?c=homme" class="itemlink">
           <div class="item-wrapper">
              <div class="item-list">Homme</div>
           </div>
       </a>
       <a href="?c=bebe" class="itemlink">
           <div class="item-wrapper">
              <div class="item-list">Enfant & Bébé</div>
           </div>
       </a>
       <a href="?c=all" class="itemlink">
           <div class="item-wrapper">
              <div class="item-list">Tous les produits</div>
           </div>
       </a>
      
    </div>
  </div>
  
  
             <div class="filter">
            <div  class="form-block w-form">
              
                <form id="email-form" method="post" name="email-form" class="form">
                    <select id="field" name="pricefilter" class="select-field-3 w-select">
                        <option value="#">Trier par ..</option>
                        <option value="priceAsc">Du - cher au + cher</option>
                        <option value="priceDesc">Du + cher au - cher</option>
                        
                    </select>
                    <select id="field-3" name="marquefilter" class="select-field-2 w-select">
                        <option value="#">Marques</option>
                        <option value="redoute">REDOUTE</option>
                        <option value="oxbow">OXBOW</option>
                        <option value="j&j">J&J</option>
                        <option value="addidas">Addidas</option>
                        <option value="converse">Converse</option>
                    </select>
                    <select id="field-2" name="taillefilter"  class="select-field w-select">
                        <option value="#">Taille</option>
                        <option value="unique">Unique</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        
                    </select>
                    <input type="submit" value="Filtrer" name="filter" class="submit-button w-button">
                    </form>
            
            </div>
          </div>

<?php 
    

include "all_products.php";

            
                
?>
</body>
</html>                                                                                                                