<?php

    include 'conn.php';
    $id = $_GET['edit'];
    $qry = 'SELECT * FROM task WHERE task_id = "'.$id.'"';
    $result = $conn -> query($qry);
    $row = $result->fetch_assoc();
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


  </head>
  <body>

    <div class="container">
                    
        <form action="" class="form bg-primary p-4 mt-5 border border-danger rounded" method="POST">
            <h1 class="text-white offset-4">
                UPDATE YOUR RECORD
            </h1>
            <div class="row p-5 mt-4">
                <div class="col-md-7">
                    <input type="text" name="item" class="form-control" required placeholder="<?php echo $row['task_title']?>"> <br>

                    <input type="radio" name="status" value="1" <?php if($row['task_status']==="1") {echo "checked";}?>>Completed

                    <input type="radio" name="status" value="0" class="ml-5" <?php if ($row['task_status'] === "0") {echo "checked";}?>>Not Done Yet
                </div>

                <div class="col-md-4 ">
                    <input class="offset-1 btn btn-danger" type="submit" name="submit" value="UPDATE ITEM" >
                </div>
            </div>
        </form>

    </div>


    <div class="container mt-5 bg-primary border border-danger rounded p-4">

        <div class="row">
            <div class="offset-4 col-md-4">
                <h4 class="text-center text-white">
                    Changed your mind? <br>
                </h4>
            </div>
        </div>

        <div class="row">
            <div class="offset-4 col-md-4">
                <br>
                <a class="btn btn-success offset-5 btn-lg" name="done" href="index.php">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>
        </div>

    </div>


<?php
    if (isset($_POST['submit'] ))
    {
        $qry = 'UPDATE task SET task_title = "'.$_POST['item'].'", task_status = "'.$_POST['status'].'"  WHERE task_id = "'.$id.'"';
        if ($conn->query($qry) === TRUE)
        {
            echo "<script>
            alert('Data was inserted UPDATED'); 
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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

</body>
</html>
