<?php
include('./db.php');
if(isset($_COOKIE['adminUser']) AND isset($_COOKIE['adminPass'])){
$adminUser=$_COOKIE['adminUser'];  
$adminPass=$_COOKIE['adminPass'];

}
else{
    header('location:index.php');
}


if(isset($_GET["action"])){
    if($_GET["action"]=="logout"){
        setcookie("adminUser","",time()-1);
        setcookie("adminPass","",time()-1);
        header('location:index.php'); 
    }
}

if(isset($_GET["delete"])){
    
        $r = loadDB("DELETE FROM `product` WHERE `product`.`id` = ".$_GET["delete"]);
       
}
if(isset($_GET["deleteUser"])){
    
        $rz = loadDB("DELETE FROM `user` WHERE `user`.`id` =".$_GET["deleteUser"]);
       
}



if(isset($_POST["addnewuser"])){
		$iusername=$_POST['iusername'];
		$ipassword=$_POST['ipassword'];
		$iname=$_POST['iname'];
        $r = loadDB("SELECT * FROM user WHERE username LIKE '".$iusername."'");
		$count = mysqli_num_rows($r); 
		if($count<=0){
			$req = loadDB("INSERT INTO user (id,name,username,password)  VALUES(NULL,'$iname','$iusername','$ipassword')");
			
		}
		else{
			header('location:index.php');
		}
}

if(isset($_POST["addproduct"])){
	$price=$_POST["price"];
    $title=$_POST["title"];
    $imageurl=$_POST["imageurl"] ;   
    $cat=$_POST["cat"];
    $marque= $_POST["marque"]   ;
    $taille= $_POST["taille"];

		$req = loadDB("INSERT INTO `product` (`id`, `price`, `title`, `imageurl`, `cat`, `marque`, `taille`) VALUES(NULL,'$price','$title','$imageurl','$cat','$marque','$taille')");
		
}

if(isset($_POST["editproduct"])){
		$id_product =$_POST["productid"];
		$price=$_POST["price"];
		$title=$_POST["title"];
		$imageurl=$_POST["imageurl"] ;   
		$cat=$_POST["cat"];
		$marque= $_POST["marque"]   ;
		$taille= $_POST["taille"];
			
		$req = loadDB("UPDATE product SET price='$price',title='$title',imageurl='$imageurl',cat='$cat',marque='$marque',taille='$taille' WHERE id='$id_product'");

}


if(isset($_POST["edituser"])){
		$iid=$_POST['iid'];
		$iusername=$_POST['iusername'];
		$ipassword=$_POST['ipassword'];
		$iname=$_POST['iname'];
        $r = loadDB("SELECT * FROM user WHERE username LIKE '".$iusername."'");
		$count = mysqli_num_rows($r); 
		if($count<=1){
			
			
			$req = loadDB("UPDATE user SET name='$iname',username='$iusername',password='$ipassword' WHERE id='$iid'");
			
		}
		else{
			header('location:index.php');
		}
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin Control Panel</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="css/icon.css?family=Material+Icons">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="shortcut icon" href="./images/favicon.png">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<style type="text/css">
    body {
        color: #566787;
		background: #f5f5f5;
		font-family: 'Varela Round', sans-serif;
		font-size: 13px;
	}
	.table-wrapper {
        background: #fff;
        padding: 20px 25px;
        margin: 30px 0;
		border-radius: 3px;
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
	.table-title {        
		padding-bottom: 15px;
		background: #435d7d;
		color: #fff;
		padding: 16px 30px;
		margin: -20px -25px 10px;
		border-radius: 3px 3px 0 0;
    }
    .table-title h2 {
		margin: 5px 0 0;
		font-size: 24px;
	}
	.table-title .btn-group {
		float: right;
	}
	.table-title .btn {
		color: #fff;
		float: right;
		font-size: 13px;
		border: none;
		min-width: 50px;
		border-radius: 2px;
		border: none;
		outline: none !important;
		margin-left: 10px;
	}
	.table-title .btn i {
		float: left;
		font-size: 21px;
		margin-right: 5px;
	}
	.table-title .btn span {
		float: left;
		margin-top: 2px;
	}
    table.table tr th, table.table tr td {
        border-color: #e9e9e9;
		padding: 12px 15px;
		vertical-align: middle;
    }
	table.table tr th:first-child {
		width: 60px;
	}
	table.table tr th:last-child {
		width: 100px;
	}
    table.table-striped tbody tr:nth-of-type(odd) {
    	background-color: #fcfcfc;
	}
	table.table-striped.table-hover tbody tr:hover {
		background: #f5f5f5;
	}
    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }	
    table.table td:last-child i {
		opacity: 0.9;
		font-size: 22px;
        margin: 0 5px;
    }
	table.table td a {
		font-weight: bold;
		color: #566787;
		display: inline-block;
		text-decoration: none;
		outline: none !important;
	}
	table.table td a:hover {
		color: #2196F3;
	}
	table.table td a.edit {
        color: #FFC107;
    }
    table.table td a.delete {
        color: #F44336;
    }
    table.table td i {
        font-size: 19px;
    }
	table.table .avatar {
		border-radius: 50%;
		vertical-align: middle;
		margin-right: 10px;
	}
    .pagination {
        float: right;
        margin: 0 0 5px;
    }
    .pagination li a {
        border: none;
        font-size: 13px;
        min-width: 30px;
        min-height: 30px;
        color: #999;
        margin: 0 2px;
        line-height: 30px;
        border-radius: 2px !important;
        text-align: center;
        padding: 0 6px;
    }
    .pagination li a:hover {
        color: #666;
    }	
    .pagination li.active a, .pagination li.active a.page-link {
        background: #03A9F4;
    }
    .pagination li.active a:hover {        
        background: #0397d6;
    }
	.pagination li.disabled i {
        color: #ccc;
    }
    .pagination li i {
        font-size: 16px;
        padding-top: 6px
    }
    .hint-text {
        float: left;
        margin-top: 10px;
        font-size: 13px;
    }    
	/* Custom checkbox */
	.custom-checkbox {
		position: relative;
	}
	.custom-checkbox input[type="checkbox"] {    
		opacity: 0;
		position: absolute;
		margin: 5px 0 0 3px;
		z-index: 9;
	}
	.custom-checkbox label:before{
		width: 18px;
		height: 18px;
	}
	.custom-checkbox label:before {
		content: '';
		margin-right: 10px;
		display: inline-block;
		vertical-align: text-top;
		background: white;
		border: 1px solid #bbb;
		border-radius: 2px;
		box-sizing: border-box;
		z-index: 2;
	}
	.custom-checkbox input[type="checkbox"]:checked + label:after {
		content: '';
		position: absolute;
		left: 6px;
		top: 3px;
		width: 6px;
		height: 11px;
		border: solid #000;
		border-width: 0 3px 3px 0;
		transform: inherit;
		z-index: 3;
		transform: rotateZ(45deg);
	}
	.custom-checkbox input[type="checkbox"]:checked + label:before {
		border-color: #03A9F4;
		background: #03A9F4;
	}
	.custom-checkbox input[type="checkbox"]:checked + label:after {
		border-color: #fff;
	}
	.custom-checkbox input[type="checkbox"]:disabled + label:before {
		color: #b8b8b8;
		cursor: auto;
		box-shadow: none;
		background: #ddd;
	}
	/* Modal styles */
	.modal .modal-dialog {
		max-width: 400px;
	}
	.modal .modal-header, .modal .modal-body, .modal .modal-footer {
		padding: 20px 30px;
	}
	.modal .modal-content {
		border-radius: 3px;
	}
	.modal .modal-footer {
		background: #ecf0f1;
		border-radius: 0 0 3px 3px;
	}
    .modal .modal-title {
        display: inline-block;
    }
	.modal .form-control {
		border-radius: 2px;
		box-shadow: none;
		border-color: #dddddd;
	}
	.modal textarea.form-control {
		resize: vertical;
	}
	.modal .btn {
		border-radius: 2px;
		min-width: 100px;
	}	
	.modal form label {
		font-weight: normal;
	}	
	.id{
        width: 50px;
    }
</style>
<script type="text/javascript">
$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();
	
	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
});
</script>


</head>
<body>
    <div class="container">
       <div class="row" style="margin-top:40px;">
                    <div class="col-sm-9" ></div>
                    <div class="col-sm-3">
                        <a href="?action=logout" class="btn btn-info add-new"><i class="fa fa-sign-out"></i> Log Out</a>
                    </div>
                </div>
		<div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Manage <b>Users</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addUser" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New User</span></a>
										
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
					
                         <th class="id">ID</th>
                        <th>Nom et prenom</th>
                        <th>Utilisateur</th>
                        <th>Mot de passe</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
				 <?php $request = loadDB("SELECT * FROM user"); 
						 while($data = mysqli_fetch_array($request)){
				 ?>
				
                    <tr>
						
                        <td><?php echo $data["id"]; ?></td>
                        <td><?php echo $data["name"];  ?></td>
						<td><?php echo $data["username"];  ?></td>
                        <td><?php echo $data["password"];  ?></td>
                        <td>
                            <a href="#editUserDetails<?php echo $data["id"]; ?>" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <a href="?deleteUser=<?php echo $data["id"]; ?>" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                        </td>
                    </tr>
						<!-- Edit Modal HTML -->
							<div id="editUserDetails<?php echo $data["id"]; ?>" class="modal fade">
								<div class="modal-dialog">
									<div class="modal-content">
										<form method="post">
											<div class="modal-header">						
												<h4 class="modal-title">Edit User <?php echo $data["id"]; ?></h4>
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											</div>
											<div class="modal-body">					
												<div class="form-group">
													<label>Full Name</label>
													<input type="hidden" name="iid" value="<?php echo $data["id"];  ?>">
													<input type="text" name="iname" value="<?php echo $data["name"];  ?>" class="form-control" required>
												</div>
												<div class="form-group">
													<label>User Name</label>
													<input type="text" name="iusername" value="<?php echo $data["username"];  ?>" class="form-control" required>
												</div>
												<div class="form-group">
													<label>Password</label>
													<input type="text" name="ipassword" value="<?php echo $data["password"];  ?>" class="form-control" required>
												</div>
																
											</div>
											<div class="modal-footer">
												<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
												<input type="submit" name="edituser" class="btn btn-info" value="Save">
											</div>
										</form>
									</div>
								</div>
							</div>
					 <?php  } ?>
                </tbody>
            </table>
			
        </div>
		
		
		
		
		
		
    </div>
	<!-- Edit Modal HTML -->
	<div id="addUser" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="post">
					<div class="modal-header">						
						<h4 class="modal-title">Add User</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Full Name</label>
							<input type="text" name="iname" class="form-control" required>
						</div>
						<div class="form-group">
							<label>User Name</label>
							<input type="text" name="iusername" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="text" name="ipassword" class="form-control" required>
						</div>
										
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" name="addnewuser" class="btn btn-success" value="Add">
					</div>
				</form>
			</div>
		</div>
	</div>

     
	
	<div class="container">
				<div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Manage <b>Products</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addProduct" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Product</span></a>
												
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
					<th class="id">ID</th>
                        <th class="image">Image</th>
                        <th class="prix">Prix</th>
                        <th class="titre">Titre</th>
                        <th>Categorie</th>
                        <th>Marque</th>
                        <th>Taille</th>
                         <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $request = loadDB("SELECT * FROM product"); 
						 while($data = mysqli_fetch_array($request)){
					?>
                    <tr>
						
                        <td class='id'><?php echo $data["id"];  ?></td>
                        <td><img src='<?php echo $data["imageurl"];  ?>' width='30' height='30'></td>
                        <td>$<?php echo $data["price"];  ?></td>
                        <td><?php echo $data["title"];  ?></td>
                        <td><?php echo $data["cat"];  ?></td>
                        <td><?php echo $data["marque"];  ?></td>
                        <td><?php echo $data["taille"];  ?></td>
                        <td>
                            <a href="#editProductDetails<?php echo $data["id"];  ?>" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <a href="?delete=<?php echo $data["id"];  ?>" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                        </td>
                    </tr>
					<!-- Edit Modal HTML -->
					<div id="editProductDetails<?php echo $data["id"];  ?>" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<form method="post">
									<div class="modal-header">						
										<h4 class="modal-title">Edit Product <?php echo $data["id"];  ?></h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									</div>
									<div class="modal-body">					
										<div class="form-group">
											<label>Title</label>
											<input type="text" name="title" value="<?php echo $data["title"];  ?>" class="form-control" required>
											<input type="hidden" name="productid" value="<?php echo $data["id"];  ?>">
										</div>
										<div class="form-group">
											<label>Price</label>
											<input type="text" name="price" value="<?php echo $data["price"];  ?>" class="form-control" required>
										</div>
										<div class="form-group">
											<label>Image Url</label>
											<input type="text" name="imageurl" value="<?php echo $data["imageurl"];  ?>" class="form-control" required>
										</div>
										<div class="form-group">
											<label>Categorie</label>
											<input type="text" name="cat" value="<?php echo $data["cat"];  ?>" class="form-control" required>
										</div>
										<div class="form-group">
											<label>Marque</label>
											<input type="text" name="marque" value="<?php echo $data["marque"];  ?>" class="form-control" required>
										</div>
										<div class="form-group">
											<label>Taille</label>
											<input type="text" name="taille" value="<?php echo $data["taille"];  ?>" class="form-control" required>
										</div>						
									</div>
									<div class="modal-footer">
										<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
										<input type="submit" name="editproduct" class="btn btn-info" value="Save">
									</div>
								</form>
							</div>
						</div>
					</div>
					<?php  } ?>
                </tbody>
            </table>
			
        </div>
		
	
	
	<!-- Edit Modal HTML -->
	<div id="addProduct" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="post">
					<div class="modal-header">						
						<h4 class="modal-title">Add Product</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Title</label>
							<input type="text" name="title" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Price</label>
							<input type="text" name="price" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Image Url</label>
							<input type="text" name="imageurl" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Categorie</label>
							<input type="text" name="cat" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Marque</label>
							<input type="text" name="marque" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Taille</label>
							<input type="text" name="taille" class="form-control" required>
						</div>						
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" name="addproduct" class="btn btn-success" value="Add">
					</div>
				</form>
			</div>
		</div>
	</div>

	
	</div>
	
</body>
</html>                            