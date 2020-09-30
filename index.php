<?php 
	include 'conn.php';
	$limit = isset($_POST["limit-records"]) ? $_POST["limit-records"] : 5000;
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$start = ($page - 1) * $limit;

//replace post as your table name and sno as id(unique key) of your table

	$result = $conn->query("SELECT * FROM userinfo LIMIT $start, $limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC);

	$result1 = $conn->query("SELECT count(id) AS id FROM userinfo");
	$custCount = $result1->fetch_all(MYSQLI_ASSOC);
	$total = $custCount[0]['id'];
	$pages = ceil( $total / $limit );

	$Previous = $page - 1;
	$Next = $page + 1;

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>User </title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container well">
		<h1 class="text-center">All User</h1>
		<div class="row">
			<div class="col-md-10">
				<nav aria-label="Page navigation">
					<ul class="pagination">
				    <li>
				      <a href="index.php?page=<?= $Previous; ?>" aria-label="Previous">
				        <span aria-hidden="true">&laquo; Previous</span>
				      </a>
				    </li>
				    <?php for($i = 1; $i<= $pages; $i++) : ?>
				    	<li><a href="index.php?page=<?= $i; ?>"><?= $i; ?></a></li>
				    <?php endfor; ?>
				    <li>
				      <a href="index.php?page=<?= $Next; ?>" aria-label="Next">
				        <span aria-hidden="true">Next &raquo;</span>
				      </a>
				    </li>
				  </ul>
				</nav>
			</div>
			<div class="text-center" style="margin-top: 20px; " class="col-md-2">
				<form method="post" action="#">
						<select name="limit-records" id="limit-records">
							<option disabled="disabled" selected="selected">---Limit Records---</option>
							<?php foreach([1,2,100,500,1000,5000] as $limit): ?>
								<option <?php if( isset($_POST["limit-records"]) && $_POST["limit-records"] == $limit) echo "selected" ?> value="<?= $limit; ?>"><?= $limit; ?></option>
							<?php endforeach; ?>
						</select>
					</form>
				</div>
		</div>
		<div style="height: 600px; overflow-y: auto;">
			<table id="" class="table table-striped table-bordered">
	        	<thead>
	                <tr>
	                    <th>S.No</th>
	                    <th>Name</th>
	                    <th>Email ID</th>
	                    <th>Password</th>
	                    <th>Mobile No.</th>
	                    <th>District</th>
	                    <th>Wallet</th>
	                    <th>Registration Date</th>
	                    <th>User Status</th>
	              	</tr>
	          	</thead>
	        	<tbody>
	        		<?php foreach($customers as $customer) :  ?>
		        		<tr>
		        			<!-- replace these value as your column name -->
		        			 <form id="searchform" action="testupdate.php" method="get">
		        			<td name="<?= $customer['id']; ?>" id="<?= $customer['id']; ?>"><?= $customer['id']; ?></td>
		        			<td><?= $customer['name']; ?></td>
		        			<td><?= $customer['emailid']; ?></td>
		        			<td><?= $customer['password']; ?></td>
		        			<td><?= $customer['mobile']; ?>
		        			<td><?= $customer['district']; ?></td>
		        			<td><?= $customer['value']; ?></td>
		        			<td><?= $customer['register_date']; ?></td>
		        			<td style="background-color: #f0f0f0;" name="q" >
							    <a class="active" href="active.php?uid=<?php echo $row['id']; ?>">Active</a>
							    <a class="inactive" href="inactive.php?uid=<?php echo $row['id']; ?>">Inactive</a>
							    <a class="active" href="delete.php?uid=<?php echo $row['id']; ?>">Delete</a>
						   </td>
		        		</tr>
	        		<?php endforeach; ?>
	        	</tbody>
      		</table>      		
		</div>


<script type="text/javascript">
	$(document).ready(function(){
		$("#limit-records").change(function(){
			$('form').submit();
		})
	})
</script>
</body>
</html>
