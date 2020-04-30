<?php

if ( ! defined( 'SQL_INJECTION_IN_PHP' ) ) {
	die( 'Direct access not permitted' );
}

if ( isset( $_GET['first_name'], $_GET['last_name'], $_GET['birth_date'] ) ) {

	$insert_query = "UPDATE students SET first_name='{$_GET['first_name']}', last_name='{$_GET['last_name']}', birth_date='{$_GET['birth_date']}' WHERE id={$_GET['id']}";

	$result = $pdo->exec( $insert_query );

	if ( $result ) {
		?>
		<div class="alert alert-success" role="alert">
			User updated
		</div>
		<?php
	} else {
		?>
		<div class="alert alert-warning" role="alert">
			There was a problem while updating the new user: <?= json_encode( $pdo->errorInfo() ) ?>
		</div>
		<?php
	}
	?>
	<a class="btn btn-primary active" href="?action=search">Back</a>
	<?php
} else {

	$query = "SELECT id, first_name, last_name, birth_date from students where id={$_GET['id']}";
	$row   = $pdo->query( $query )->fetch();

	?>
	<h2>Editing student <?= $_GET['id'] ?></h2>
	<hr/>
	<form method="get">
		<input type="hidden" name="action" value="update"/>
		<input type="hidden" name="id" value="<?= $_GET['id'] ?>"
		<label>
			First name:
			<input type="text" name="first_name" value="<?= $row['first_name'] ?>"/>
		</label>
		<br/>
		<label>
			Last name:
			<input type="text" name="last_name" value="<?= $row['last_name'] ?>"/>
		</label>
		<br/>
		<label>
			Birth date:
			<input type="text" name="birth_date" value="<?= $row['birth_date'] ?>"/>
		</label>
		<hr/>
		<input type="submit" class="btn btn-primary" value="Submit">
		<a href="?action=search" class="btn btn-secondary">Back</a>
	</form>
	<?php
}