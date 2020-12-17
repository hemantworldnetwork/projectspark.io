<?php
require_once "pdo.php";
if (isset($_POST['name'])&& isset($_POST['email']) ) {
echo("Welcome"." ".$_POST['name']."\n\n");
}
$em=$_POST['email'];

$stmt = $pdo->query("SELECT name, email FROM customers WHERE email<>'$em'");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<?php require_once "bootstrap.php"; ?>
<html>
<head><link rel="stylesheet" href="bank.css"></head><body>

<table border="1">
  <tr><td> Name</td>
  <td>Email</td>
  </tr>

<?php
foreach ( $rows as $row ) {
    echo "<tr><td>";
    echo($row['name']);
    echo("</td><td>");
    echo($row['email']);
    echo("</td></tr>");
    }
?>
</table>
<p>Transfer money to:</p>
<form method="post" action="transfercomplete.php">
<p>Sender's Email:
<input type="text" name="send" size="40"></p>
<p>Reciever's Name:
<input type="text" name="naam" size="40"></p>
<p>Email:
<input type="text" name="mail"></p>
<p>Amount:<input type="text" name="amount"></p>
<input type="submit" value="transfer"/>
</form>

</body>
</html>
