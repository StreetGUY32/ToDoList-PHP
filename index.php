<?php
include 'conn.php';
?>


<!doctype html>
<html lang="en">
  <head>
	<title>TODO LIST | PHP</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap4.min.css">

	<style>
		.done
		{
			color: green;
			font-weight:bold;
		}
	</style>

  </head>
  <body>


	<div class="container">
			
		<form action="" class="form bg-primary p-4 mt-5 border border-danger rounded" method="POST">
			<h1 class="text-white offset-4">
				TODO-LIST PHP
			</h1>
			<div class="row p-5 mt-4">
				<div class="offset-2 col-md-4">
					<input type="text" name="item" placeholder="Add your item!" class="form-control" required>
				</div>
				<div class="offset-2 col-md-4">
					<input class="btn btn-danger" type="submit" name="submit" value="ADD ITEM" >
				</div>
			</div>
		</form>

			<?php
				if (isset($_POST['submit']))
				{
					$qry = 'INSERT INTO task (task_title,task_status) VALUES ("'.$_POST['item'].'",0)';

					if ($conn->query($qry) === TRUE)
					{
						echo "<script>
						alert('Data was inserted Successfully, YOU ARE BEING REDIRECTING!!');
						window.location.href='index.php';  
						</script>";
					}
					else	
					{
						echo "Error: " . $qry . "<br>" . $conn->error;
					}
				}
			?>
	</div>

	<div class="container mt-5">
		<?php
			if(isset($_GET['status']))
			{
				$qry = 'UPDATE task SET task_status = 1 WHERE task_id = "'.$_GET["status"].'"';
				if ($conn->query($qry) === TRUE)
				{
					echo "<script>
								window.location.href='index.php';  
						 </script>";
				}
				else	
				{ echo "Error: " . $qry . "<br>" . $conn->error;}
			}

			elseif (isset($_GET['delete']))
			{
				$qry = 'DELETE FROM task WHERE task_id = "'.$_GET["delete"].'"';
				if ($conn->query($qry) === TRUE)
				{
					echo "<script>
								alert('Task deleted Successfully!!');
								window.location.href='index.php';  
						 </script>";
				}
				else	
				{
					echo "Error: " . $qry . "<br>" . $conn->error;
				}
			}
		
		?>

			<table class="table table-bordered table-striped" id="table_id">
				<thead>
					<tr>
						<th class="text-center">Serial NO</th>
						<th class="text-center">TASK ID</th>
						<th class="text-center">TASK TITLE</th>
						<th class="text-center">TASK STATUS</th>
						<th class="text-center">ACTIONS</th>
					</tr>
				</thead>
				<tbody>

					<?php 
						$qry = "SELECT * FROM task ORDER BY task_id DESC ";
						$result=$conn->query($qry);
							$sno = 1;
						while ($row=$result->fetch_array())
						{
					?>
					<tr>
						<td ><?php echo $sno ++ ?></td>
						<td><?php echo $row['task_id'] ?> </td>
						<td><?php echo $row['task_title'] ?> </td>
						<td id="notDone">
							<?php 
							if ($row['task_status'] == 1)
								{ ?>
								<span class="badge bg-success p-2 text-white offset-5">
									<i class="bi bi-check2-circle"></i>
								</span>
						<?php		
								} 
							elseif($row['task_status'] == 0)
								{ ?>
									<span class=" badge bg-danger offset-5 text-white p-2">
										<i class="bi bi-x-square lg"></i>
									</span>
							<?php	
							}
							?> 
						</td>
						<td>
							<?php
								if ($row['task_status'] != 1)
								{?>
							<a class="btn btn-success offset-1 btn-sm" name="done" href="index.php?status=<?php echo $row['task_id'];?>">
								<i class="bi bi-check-circle-fill"></i>
							</a>
							<?php } ?>
							<a class="btn btn-primary offset-1 btn-sm" name="edit" href="edit.php?edit=<?php echo $row['task_id'];?>">
								<i class="bi bi-pencil-fill"></i>
							</a>
							<a class="btn btn-danger offset-1 btn-sm" done="delete" href="index.php?delete=<?php echo $row['task_id'];?>">
							<i class="bi bi-trash2-fill"></i>
							</a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>

		</div>


		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap4.min.js"></script>
		
		<!-- Data table-->
		<script>
			$(document).ready(function () 
			{
				$('#table_id').DataTable();
			});
		</script>


  </body>
</html>
