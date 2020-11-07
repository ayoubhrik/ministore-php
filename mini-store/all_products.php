


		<?php 
		
						if(isset($_GET["c"])){
							if($_GET["c"]=="all"){
								$condition = "SELECT * FROM product WHERE 1" ;
								echo "<h2>Tous les <b>Produits</b></h2>";
							}
							if($_GET["c"]=="femme"){
								$condition = "SELECT * FROM product WHERE cat LIKE 'femme'" ;
								echo "<h2>Produits de <b>Femme</b></h2>";
							}
							if($_GET["c"]=="homme"){
								$condition = "SELECT * FROM product WHERE cat LIKE 'homme'" ;
								echo "<h2>Produits d'<b>Homme</b></h2>";
							}
							if($_GET["c"]=="bebe"){
								$condition = "SELECT * FROM product WHERE cat LIKE 'bebe'" ;
								echo "<h2>Produits de <b>Bebes</b></h2>";
							}
						}elseif(isset($_GET["kwrd"])){
							$condition = "SELECT * FROM product WHERE";  
							$query = explode(" ", $_GET["kwrd"]);  
							foreach($query as $text)  
							  {  
								   $condition .= " title LIKE '%$text%' OR price LIKE '$text' OR cat LIKE '%$text%' OR marque LIKE '%$text%' OR ";  
							  } 
							$condition = substr($condition, 0, -4);
							
						}else{
							$condition = "SELECT * FROM product WHERE 1" ; 
							echo "<h2>Tous les <b>Produits</b></h2>";
						}
		?>

			
				<div class="container">
				<div class='row'>
					<?php 
					
					
					   
                        if(isset($_POST["filter"])){
                            $pricefilter = $_POST["pricefilter"];
                            $marquefilter = $_POST["marquefilter"];
                            $taillefilter = $_POST["taillefilter"];
                            
                            if($marquefilter != "#"){
                                $condition .= " AND marque LIKE '$marquefilter'" ;
                            }
                            if($taillefilter != "#"){
                                 $condition .= " AND taille LIKE '%$taillefilter%'" ;
                            }
                            if($pricefilter == "#"){
                                
                            }
                            if($pricefilter == "priceAsc"){
                                $condition .= " ORDER BY price ASC";
                                
                            }
                            if($pricefilter == "priceDesc"){
                                $condition .= " ORDER BY price DESC";
                                
                            }
                            $request = loadDB($condition);
                        }
                        else{
                            
                            $request = loadDB($condition);
                        }
                        
                    
                        while($data = mysqli_fetch_array($request)){
						/*echo "
                        
                        <div class=''>
							<div class='card'>
								<div class='img-box'>
									<img src='".$data["imageurl"]."' class='img-responsive img-fluid' alt=''>	</div>
								<div class='thumb-content'>
									<h4>".$data["title"]."</h4>
									<p class='item-price'><span>$".$data["price"]."</span></p>
									<p><span style='color: #a0a0a0;font-size: 11px;font-style: italic;'>Cat: ".$data["cat"]." | Marque : ".$data["marque"]."</span></p>
									
									<a href='?id=".$data["id"]."' class='btn btn-primary'>Add to Cart</a>
								</div>						
							</div>
						</div>
                        
                        ";*/
						echo "
						    
							
								<div class='col-md-3 col-sm-4 col-xs-6'>
									<div class='p-grid'>
										<div class='product-image'>
											<a href='#'>
												<img class='pic-1' src='".$data["imageurl"]."'>
												
											</a>
											
											<ul class='social'>
												<li><a href='?id=".$data["id"]."'><i class='fa fa-shopping-cart'></i></a></li>
											</ul>
										</div>
										<div class='product-content'>
											<h3 class='title'>".$data["title"]."</h3>
											<div class='price discount'><span>$".$data["price"]."</span> $".$data["price"]."</div>
										</div>
									</div>
								</div>
							   
									


							
						
						";
                            
						}
						?>

							</div>

	</div>
                            		                            