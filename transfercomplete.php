<?php
require_once "pdo.php";
if ( isset($_POST['send']) && isset($_POST['mail']) 
     && isset($_POST['amount'])) {
    $sql = "INSERT INTO transfers (sender,reciever, amount) 
              VALUES (:send, :mail, :amount)";
    #echo("<pre>\n".$sql."\n</pre>\n");
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':send' => $_POST['send'],
        ':mail' => $_POST['mail'],
        ':amount' => $_POST['amount']));
}
if ( isset($_POST['amount']) && isset($_POST['mail']) ) {
    $sql = "UPDATE customers SET current_balance= (current_balance+ :amt)  WHERE email = :mail";
   #echo "<pre>\n$sql\n</pre>\n";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['amt' => $_POST['amount'],'mail'=> $_POST['mail']]);
}
if ( isset($_POST['amount']) && isset($_POST['send']) ) {
    $sql = "UPDATE customers SET current_balance= (current_balance- :amt)  WHERE email = :mail";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['amt' => $_POST['amount'],'mail'=> $_POST['send']]);
    
}

?>
<?php require_once "bootstrap.php"; ?>
<html>
<head><link rel="stylesheet" href="bank1.css"></head><body>
<table><tr><th>***    UPDATED DETAILS OF CUSTOMER    ***</th></tr></table>
<table border="1">
  <tr><td> Name</td>
  <td>Email</td>
  <td>Current Balance</td>
  <td>Address</td>
  </tr>
<?php
if ( isset($_POST['send'])&& ($_POST['send']!=NULL)) {
require_once "pdo.php";
$stmt = $pdo->prepare("SELECT * FROM customers WHERE email=:email");
$stmt->execute(['email'=> $_POST['send']]); 
$user = $stmt->fetch();
  	if(($user['email']==$_POST['send'])){
  
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
    echo("Transaction Successful"."<br>");
    echo('<form method="post" action="transfer.php">');
    echo('<input type="submit" value="Transfer money again" name="transfer">');
    echo("\n</form>\n");
    echo("</table>\n");
    echo("<table>");
    echo('<form method="post" action="customers.php">');
    echo('<input type="submit" value="View all customers details" name="customers">');
    echo("\n</form>\n");
    echo("</table>\n");
    
     }
     }
else{ echo("Transaction unsuccessful!.. try again");
}
?>
</table>
</body>
</html>



