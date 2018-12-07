<?php

include('includes/header.php');

?>

<div class="container">

	<header class="flex">
		<p class="margin-right">Bienvenue sur l'application Comptes Bancaires</p>
	</header>

	<h1>Mon application bancaire</h1>

	<form class="newAccount" action="../controllers/index.php" method="post">
		<label>Sélectionner un type de compte</label>
		<select class="" name="name" required>
			<option value="PEL">PEL</option>
			<option value="Livret A">Livret A</option>
			<option value="Compte Courant">Compte courant</option>
			<?php // List of the accounts?>
		</select>
		<input type="submit" name="new" value="Ouvrir un nouveau compte">
	</form>

	<hr>

	<div class="main-content flex">


	<?php foreach($getAccounts as $account){// loop for displaing the name and the balance
	

	?>

		<div class="card-container">

			<div class="card">
				<h3><strong><?php echo $account->getName(); // display the name of account ?></strong></h3>
				<div class="card-content">


					<p>Somme disponible : <?php echo $account->getBalance();// display the balance?> €</p>

					<!-- Form for dipositing/withdrawing -->
					<h4>Dépot / Retrait</h4>
					<form action="index.php" method="post">
						<input type="hidden" name="id" value=" <?php echo $account->getId(); ?>"  required>
						<label>Entrer une somme à débiter/créditer</label>
						<input type="number" name="balance" placeholder="Ex: 250" required>
						<input type="submit" name="payment" value="Créditer">
						<input type="submit" name="debit" value="Débiter">
					</form>


					<!-- Form for transfaring balance-->
			 		<form action="index.php" method="post">

						<h4>Transfert</h4>
						<label>Entrer une somme à transférer</label>
						<input type="number" name="balance" placeholder="Ex: 300"  required>
						<input type="hidden" name="idDebit" value="<?php echo $account->getId();?>" required>
						<label for="">Sélectionner un compte pour le virement</label>
						<select name="idPayment" required>
							<option placeholder="Choisir un compte">Choisir un compte</option>
							
							<?php foreach($getAccounts as $accountlist){ //list of all the accounts?>
							<option value="<?php echo $accountlist->getId(); ?>"><?php echo $accountlist->getName(); ?></option>
							<?php } ?>
						</select>
						<input type="submit" name="transfer" value="Transférer l'argent">
					</form>

					<!-- Form for deleting account -->
			 		<form class="delete" action="index.php" method="post">
				 		<input type="hidden" name="id" value="<?php echo $account->getId();?>"  required>
				 		<input type="submit" name="delete" value="Supprimer le compte">
			 		</form>

				</div>
			</div>
		</div>

	<?php } ?>

	</div>

</div>

<?php

include('includes/footer.php');

 ?>
