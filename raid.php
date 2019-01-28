<?php
$dbhost = "hostname/ip";
$dbuser = "rdmuser";
$dbpass = "password";
$dbname = "rdmdb";

$page = $_SERVER['PHP_SELF'];
$sec = "60";

// Establish connection to database
try{
    $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}
// Query Database and Build Raid Billboard
try 
{
    $sql = "SELECT time_format(from_unixtime(raid_battle_timestamp), '%h:%i:%s %p'), 
           time_format(from_unixtime(raid_end_timestamp),'%h:%i:%s %p'), 
           raid_level, pokedex.name, quick_movedex.name, charge_movedex.name, gym.name, gym.lat, gym.lon from gym 
           join pokedex on gym.raid_pokemon_id = pokedex.pokemon_id 
           join quick_movedex on gym.raid_pokemon_move_1 = quick_movedex.move_id 
           join charge_movedex on gym.raid_pokemon_move_2 = charge_movedex.move_id 
           where where ST_CONTAINS(ST_GEOMFROMTEXT('POLYGON((
           LAT -LONG, 
           LAT -LONG))') 
           point(gym.lat, gym.lon)) && 
           raid_pokemon_id is not null && 
           gym.name is not null &&
           raid_end_timestamp>unix_timestamp(now())
           order by raid_end_timestamp";   
        $result = $pdo->query($sql);
        if($result->rowCount() > 0){
            echo "<table border='1';>";
                echo "<tr>";
                    echo "<th>Raid Starts</th>";
                    echo "<th>Raid Ends</th>";
                    echo "<th>Raid Level</th>";
                    echo "<th>Raid Boss</th>";
                    echo "<th>Quick Move</th>";
                    echo "<th>Charge Move</th>";
                    echo "<th>Gym</th>";
                echo "</tr>";
            while($row = $result->fetch()){
                echo "<tr>";
                    echo "<td>" . $row[0] . "</td>";
                    echo "<td>" . $row[1] . "</td>";
                    echo "<td>" . $row[2] . "</td>";
                    echo "<td>" . $row[3] . "</td>";
                    echo "<td>" . $row[4] . "</td>";
                    echo "<td>" . $row[5] . "</td>";
                    echo '<td> <a href="http://www.google.com/maps?q='.$row['lat'].','.$row['lon'].'"" target="_blank" style="color: #137e80">' . $row[6] . '</a></td>';
                echo "</tr>";
            }
            echo "</table>";
// Free result set
        unset($result);
    } else{
        echo "No records matching your query were found.";
    }
} catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}
// Close connection
unset($pdo);
?>

<html>
    <head>
    <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
    </head>
</html>
