<?php

if ( ! defined( 'SQL_INJECTION_IN_PHP' ) ) {
	die( 'Direct access not permitted' );
}

if ( isset( $_GET['first_name'], $_GET['last_name'], $_GET['birth_date'] ) ) {

	$insert_query = 'INSERT INTO students(first_name, last_name, birth_date) VALUES (' .
	                "'{$_GET['first_name']}', '{$_GET['last_name']}', '{$_GET['birth_date']}')";

	$result = $pdo->exec( $insert_query );

	if ( $result ) {
		?>
		<div class="alert alert-success" role="alert">
			User inserted
		</div>
		<?php
	} else {
		?>
		<div class="alert alert-warning" role="alert">
			There was a problem while inserting the new user: <?= json_encode( $pdo->errorInfo() ) ?>
		</div>
		<?php
	}
	?>
	<a class="btn btn-primary active" href="?action=search">Back</a>
	<?php
} else {
	?>
	<h2>Add Student</h2>
	<hr/>
	<form method="get">
		<input type="hidden" name="action" value="insert"/>
		<div>
			<label>
				First name:
				<input type="text" name="first_name">
			</label>
		</div>
		<div>
			<label>
				Last name:
				<input type="text" name="last_name">
			</label>
		</div>
		<div>
			<label>
				Birth date:
				<input type="text" name="birth_date">
			</label>
		</div>
		<input type="submit" class="btn btn-primary" value="Submit">
		<a href="?action=search" class="btn btn-secondary">Back</a>
	</form>
	<?php
}
