<?php
require_once 'utils.php';

// Include the template file
/*ob_start(); // Start output buffering
include 'htmlTemplate.php'; // Include the template
$output = ob_get_clean(); // Get the output buffer contents and clean it

// Now echo the cleaned output
echo $output .= '</body></html>'; 
*/

$C = connect();
//$C = null;
if($C) {
    echo 'Connected <br>';
    $id = 1;
    //$query = "SELECT name FROM ligma_obedy.consumer WHERE id = $id";
    $query = "SELECT * FROM ligma_obedy.rating WHERE consumer_id = $id AND rating = 0";
    $result = pg_query($C, $query);
    //echo "Executing query: $query <br>";

    if(!$result) {
        echo 'Error occurred while executing the query :( <br>';
        pg_last_error($C) . ' <br>';
        exit;
    }

    $row = pg_fetch_assoc($result);
    if($row) {
        echo 'Jidlo kde jsem dal 0 bodu: <br>' . $row['comment'] . '<br>';
    } else {
        echo "No consumer found with id = 1";
    }
    pg_free_result($result);
    pg_close($C);
} else {
    echo 'Could not connect to the database.. :(( <br>';
}

echo 'Finished';

?>