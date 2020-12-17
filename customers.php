<?php
require_once "pdo.php";
#error header and pdo query for select
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $pdo->query("SELECT name, email FROM customers");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<?php require_once "bootstrap.php"; ?>
<html>
<head>
<link rel="stylesheet" href="bank.css">
</head><body>
<table><tr><th>***    DETAILS OF CUSTOMER    ***</th></tr></table>
<table border="1">
  <tr><td> Name</td>
  <td>Email</td>
  <td>Current Balance</td>
  <td>Address</td>
  </tr>

<?php
#if post data is post then if statement run to view customer details
if ( isset($_POST['name'])&& isset($_POST['email']) ) {
require_once "pdo.php";
$stmt = $pdo->prepare("SELECT * FROM customers WHERE name=:name and email=:email");
$stmt->execute(['name' => $_POST['name'],'email'=> $_POST['email']]); 
$user = $stmt->fetch();
  	if(($user['email']==$_POST['email'])){
    echo "<tr><td>";
    echo($user['name']);
    echo("</td><td>");
    echo($user['email']);
    echo("</td><td>");
    echo($user['current_balance']);
    echo("</td><td>");
    echo($user['address']);
   echo("</td></tr>");
     echo("<table>");
	 echo('<form method="post" action="transfer.php"><input type="hidden" ');
    echo('name="email" value="'.$user['email'].'">'."\n");
      echo('<input type="hidden" name="name" value="'.$user['name'].'">'."\n");
    echo('<input type="submit" value="transfer money" name="transfer">');
    echo("\n</form>\n");
    echo("</table>\n");
      }
     else { 
      echo("please enter correct details");
      }
}
#else run if, if fails or select button is not clicked 
else{
foreach ( $rows as $row ) {
 echo "<tr><td>";
    echo($row['name']);
    echo("</td><td>");
    echo($row['email']);
    echo("</td><td>");
    echo("***");
    echo("</td><td>");
    echo("**");
    echo("</td></tr>");
}}
?>
</table>
<p>Select Customer to view Details</p>
<!--form to post data of selected customer-->
<form method="post">
<p>Name:
<input type="text" name="name" size="40"></p>
<p>Email:
<input type="text" name="email"></p>
<input type="submit" value="Select"/>
</form>
</body>
</html>
