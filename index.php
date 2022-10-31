<?php 
    // initialize errors variable
	$errors = "";

	// connect to database
	$db = mysqli_connect("localhost", "root", "", "tasks");

	// insert a quote if submit button is clicked
	// if submitting does not work because of 'no default value of the id'
	// run:  SELECT @@SQL_MODE, @@GLOBAL.SQL_MODE;
	//find SQL Mode and remove the STRICT_ALL_TABLES and/or STRICT_TRANS_TABLES and then
	//  run: 'ALTER TABLE card_games MODIFY id int NOT NULL AUTO_INCREMENT;'
	//  after the command 'the id should  set as auto-increment.'
	// do it before you submit for the first time, IF you face issues about it.
	// other you can just move on.
	if (isset($_POST['submit'])) {
		if (empty($_POST['task'])) {
			$errors = "You must fill in the task";
		}else{
			$task = $_POST['task'];
			$sql = "INSERT INTO tasks (task) VALUES ('$task')";
			mysqli_query($db, $sql);
			header('location: index.php');
		}
	}	
	// delete task
	//when the id auto-increment is set and you delete a task
	// for example a task for 1,2,3 and you delete 2
	// the the remaning tasks 1 and 3 will be organized in the order 1 and 2
	// practical right?
	if (isset($_GET['del_task'])) {
		$id = $_GET['del_task'];

		mysqli_query($db, "DELETE FROM tasks WHERE id=".$id);
		header('location: index.php');
	}
		
?>
<!DOCTYPE html>
<html>
<head>
	<title>ToDo List Application PHP and MySQL</title>
    <link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
	<div class="container mt-5">
	<div class="heading">
		<h2 style="font-style: 'Hervetica';">ToDo List Application</h2>
		<p style="font-style: 'Hervetica';">With PHP,MySQL Workbench,Bootstrap v5.0, CSS and MySQL database</p>

	</div>
	
    <form method="post" action="index.php" class="input_form">

    <?php if (isset($errors)) { ?>
	<p><?php echo $errors; ?></p>
    <?php } ?>

  <div class="mb-3">
	<input type="text" name="task" class="task_input form-control" placeholder="Fill in a task">    
  </div> 
  
  <button type="submit" name="submit" class="btn btn-primary" id="add_btn">Add Task</button>
</form>

	<table class="mt-3">
	<thead>
		<tr>
			<th>Id</th>
			<th>Tasks</th>
			<th style="width: 60px;">Delete</th>
		</tr>
	</thead>

	<tbody class="mx-auto">
		<?php 
		// select all tasks if page is visited or refreshed
		$tasks = mysqli_query($db, "SELECT * FROM tasks");

		$i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
			<tr >
				<td> <?php echo $i; ?> </td>
				<td class="task"> <?php echo $row['task']; ?> </td>
				<td class="delete"> 
					<a href="index.php?del_task=<?php echo $row['id'] ?>">x</a> 
				</td>
			</tr>
		<?php $i++; } ?>	
	</tbody>
</table>
</div>

</body>
</html>