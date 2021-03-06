<?php 
session_start();


?>
<!DOCTYPE html>
<html>
	<head>
		<title>Webslesson Demo | Simple PHP Mysql Shopping Cart</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
	<body>
		<br />
		<div class="container">
			<br />
			<br />
			<br />
			<h3 align="center">Tutorial - <a href="http://www.webslesson.info/2016/08/simple-php-mysql-shopping-cart.html" title="Simple PHP Mysql Shopping Cart">Simple PHP Mysql Shopping Cart</a></h3><br />
			<br /><br />
			<?php
				$query = "SELECT * FROM produit ORDER BY id_produit ASC";
				$result = mysqli_query($connect, $query);
				if(!$result || mysqli_num_rows($result) >0)
				{
					while( $mysqli_num_rows = mysqli_fetch_array($result))
					{
				?>
			<div class="col-md-4">
				<form method="post" action="chekout.php?action=add&id_produit=<?php echo $mysqli_num_rows["id_produit"]; ?>">
					<div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">
						<img src="images/<?php echo $mysqli_num_rows["img"]; ?>" class="img-responsive" /><br />

						<h4 class="text-info"><?php echo $mysqli_num_rows["nom"]; ?></h4>

						<h4 class="text-danger">$ <?php echo $mysqli_num_rows["prix"]; ?></h4>

						<input type="text" name="Quantite" value="1" class="form-control" />

						<input type="hidden" name="hidden_nom" value="<?php echo $mysqli_num_rows["nom"]; ?>" />

						<input type="hidden" name="hidden_prix" value="<?php echo $mysqli_num_rows["prix"]; ?>" />

						<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />

					</div>
				</form>
			</div>
			<?php
					}
				}
			?>
			<div style="clear:both"></div>
			<br />
			<h3>Order Details</h3>
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr>
						<th width="40%">Item Nom</th>
						<th width="10%">Quantite</th>
						<th width="20%">Prix</th>
						<th width="15%">Total</th>
						<th width="5%">Action</th>
					</tr>
					<?php
					if(!empty($_SESSION["shopping_cart"]))
					{
						$total = 0;
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
					?>
					<tr>
						<td><?php echo $values["item_nom"]; ?></td>
						<td><?php echo $values["item_quantite"]; ?></td>
						<td>$ <?php echo $values["item_prix"]; ?></td>
						<td>$ <?php echo number_format($values["item_quantite"] * $values["item_prix"], 2);?></td>
						<td><a href="index.php?action=delete&id_produit=<?php echo $values["item_id_produit"]; ?>"><span class="text-danger">Remove</span></a></td>
					</tr>
					<?php
							$total = $total + ($values["item_quantite"] * $values["item_prix"]);
						}
					?>
					<tr>
						<td colspan="3" align="right">Total</td>
						<td align="right">$ <?php echo number_format($total, 2); ?></td>
						<td></td>
					</tr>
					<?php
					}
					?>
						
				</table>
			</div>
		</div>
	</div>
	<br />
	</body>
</html>
<?php