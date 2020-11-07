<?php
include('./db.php');

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
    else{
       header('location:index.php'); 
    }

}
else{
    header('location:index.php');
}



function countCart($id){
    $r = loadDB("SELECT * FROM `cart` WHERE `user_id`=".$_COOKIE['id']);
    return mysqli_num_rows($r);
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
<link rel="stylesheet" href="css/style.css">
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
	.navbar .form-inline .btn {
		border-radius: 2px;
		color: #fff;
        border-color: #040707;
		background: #040707;
		outline: none;
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
    #cart{
        margin-top: 80px;
    }

   .table>tbody>tr>td, .table>tfoot>tr>td{
    vertical-align: middle;
    } 
    #product-row:hover{
        background-color: #fff;
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
        table#cart tbody td .form-control{
		width:20%;
		display: inline !important;
	}
	.actions .btn{
		width:36%;
		margin:1.5em 0;
	}
	
	.actions .btn-info{
		float:left;
	}
	.actions .btn-danger{
		float:right;
	}
        table#cart thead { display: none; }
	table#cart tbody td { display: block; padding: .6rem; min-width:320px;}
	
	table#cart tbody td:before {
		content: attr(data-th); font-weight: bold;
		display: inline-block; width: 8rem;
	}
	
	
	
	table#cart tfoot td{display:block; }
	table#cart tfoot td .btn{display:block;}
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
	</div>
</nav>

    <div class="container">
            <table class="table table-bordered" style="margin-top:50px;">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Tracking Number</th>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Order Status</th>
                        
                         
                    </tr>
                </thead>
                <tbody>
                   <?php 
                    $request = loadDB("SELECT * FROM orders o, product p WHERE p.id=o.product_id AND o.user_id=".$_COOKIE['id']);
                    
                        while($data = mysqli_fetch_array($request)){
                           
                            echo "<tr>
                        <td class='id'>".$data["order_id"]."</td>
                       
                        <td>".$data["tracking_number"]."</td>
                        <td><img src='".$data["imageurl"]."' width='40' height='40'></td>
                        <td>".$data["title"]."</td>
                        <td>".$data["qty"]."</td>
                        <td>".$data["order_status"]."</td>
                        
                        
                        </tr>";
                            
                         }
                    
                    ?>
                </tbody>
            </table>
    </div>      

</body>
</html>                                                                                                                