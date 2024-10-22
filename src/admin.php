<!DOCTYPE html>

<?php
if (empty($_SESSION['login'])){
	header('Location: nowhere.php');
}

if ($admin!=true){
	header('Location: nowhere.php');
}

?>

<h3 class="centered">Users table</h3>
	<div class="jumbotron row centered shadow rounded">
		<table>
			<tr>
				<th><p><strong>userid</strong></p></th>
				<th><p><strong>login</strong></p></th>
				<th><p><strong>password</strong></p></th>
				<th><p><strong>mail</strong></p></th>
				<th><p><strong>chmod</strong></p></th>
				<th><p><strong>Delete</strong></p></th>
			</tr>

		<?php
		$db = User::displayUsers();
		while ($data = $db->fetch()){
		?>
			<tr>
				<td><p><?php echo $data['userid'];?></p></td>
				<td><p><?php echo $data['login'];?></p></td>
				<td><p><?php echo $data['password'];?></p></td>
				<td><p><?php echo $data['mail'];?></p></td>
				<td><p><?php echo $data['chmod'];?></p></td>
				<td><p><a class="boutondel" href=<?php echo '"confirmdelete.php?userid='.$data['userid'].'"' ?>>X</a></p></td>
			</tr>
		<?php }?>

		</table>
	</div>