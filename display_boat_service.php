<!-- Include header so I don't have to retype it every time -->
<?php include 'header.html'; ?>

<?php
    $pageName = "Display Boat's Service Slips";
     echo "<h1>$pageName</h1></center></td></tr></table></div>";
?>

<!-- Connect to the database -->
<?php
    try {
        $dsn = "mysql:host=courses;dbname=z1732715";
        $username = "z1732715";
        $password = "1996Apr23";
        $pdo = new PDO($dsn, $username, $password);
    }
    catch(PDOexception $e) {
        echo "Connection to database failed: " . $e->getMessage();
    }
?>
<!-- End Connect to the database -->

<!-- Get all Boat names, owner first and last names, the marina name and the slipname of that boat -->
<?php
    
    # My query or sql statement 
    $sql = "
       SELECT BoatName, SlipID FROM MarinaSlip LIMIT 10; 
    ";

    # The resutlt of passing that query to the db
    $result = $pdo->query($sql);

    # $row = $result->fetch(PDO::FETCH_BOTH);

    # The result of all the rows of that query
    $allrows = $result->fetchAll();

    # Output table first
    echo '<div width="100%">
        <form action="/~z1732715/display_boat_service.php" method="post">
            <table width="100%" border="50px" cellpadding="25%">
                <tr>
                    <td>
                        <h2>Please select the owner name you want to see service slips for</h2>
                        <select>
';
 
foreach( $allrows as $row ):
    echo '<option value="' . $row[SlipID] . '" name="' . $row[BoatName] . '">' . $row[BoatName] . '</option>';
endforeach;

echo '
                        </select>
                        <input type="submit">
                        <input type="reset">
                    </td>
                <tr>
            </table>
        </form>
      </div>

';

$newSql = "
    SELECT sr.Description FROM ServiceRequest sr, Owner o, MarinaSlip ms WHERE ms.SlipID = sr.SlipID AND ms.OwnerNum = o.OwnerNum GROUP BY sr.Description LIMIT 10;
";

$otherResult = $pdo->query($newSql);
$allRequestedRows = $otherResult->fetchAll();

# Output table first
echo '<div width="100%">
        <table width="100%" border="50px" cellpadding="25%">
            <tr>
                <td>
                    <div width="100%">
                        <h2>The owner you requested has the following boats:</h2>
                    </div>
                </td>
            </tr>
';
 
    foreach( $allRequestedRows as $boat ):
        foreach( $boat as $boatName):
            echo '<tr><td>' . $boatName . '</td></tr>';
        endforeach;
    endforeach;

    echo '
            </table>
          </div>

    ';



?>


<!-- Inlude the footer so I don't have to retype it every time -->
<?php include 'footer.html'; ?>
