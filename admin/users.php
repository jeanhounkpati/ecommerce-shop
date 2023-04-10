
<?php include("includes/header.php") ?>
<div class="content">

<div class="col-md-12">

<h2 class="text-center">Users</h2>

<div class="d-flex justify-content-center align-items-center">
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Email</th>
      <th scope="col">Date</th>
      <th scope="col">Status</th>

    </tr>
  </thead>
  <tbody>
  		<?php
			include '../database.php';
			global $PDO;
			$req=$PDO->prepare('SELECT * FROM users');
			$req->execute([ ]);
			$users=$req->fetchAll(PDO::FETCH_OBJ);
		?>
		<?php foreach($users as $user):?>
			<tr>
				<th scope="row">USER<?= $user->id; ?></a></th>
				<td><?= $user->email; ?></td>
				<td><?= $user->created_at; ?></td>
				<td>status</td>

      </tr>				
		<?php endforeach ?>
  </tbody>
</table>
</div>
</div>
</div>
		
<?php include("includes/footer.php") ?>






		

