<?php
$dbhost = "hostname/ip";
$dbuser = "rdmuser";
$dbpass = "password";
$dbname = "rdmdb";

try{
    $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}

try 
{
    $sql = "SELECT time_format(from_unixtime(raid_battle_timestamp), '%h:%i:%s %p'), time_format(from_unixtime(raid_end_timestamp),'%h:%i:%s %p'), raid_level, pokedex.name, gym.name from gym inner join pokedex on gym.raid_pokemon_id = pokedex.pokemon_id where raid_pokemon_id is not null && gym.name is not null order by raid_end_timestamp";   
        $result = $pdo->query($sql);
        if($result->rowCount() > 0){
            echo "<table border='1';>";
                echo "<tr>";
                    echo "<th>Raid Starts</th>";
                    echo "<th>Raid Ends</th>";
                    echo "<th>Raid Level</th>";
                    echo "<th>Raid Boss</th>";
                    echo "<th>Gym</th>";
                echo "</tr>";
            while($row = $result->fetch()){
                echo "<tr>";
                    echo "<td>" . $row[0] . "</td>";
                    echo "<td>" . $row[1] . "</td>";
                    echo "<td>" . $row['raid_level'] . "</td>";
                    echo "<td>" . $row[3] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
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
