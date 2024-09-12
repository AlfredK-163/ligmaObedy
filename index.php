<?php
require_once 'utils.php';

// Include the template file
/*ob_start(); // Start output buffering
include 'htmlTemplate.php'; // Include the template
$output = ob_get_clean(); // Get the output buffer contents and clean it

// Now echo the cleaned output
echo $output .= '</body></html>'; 
*/

$query = "SELECT * FROM ligma_obedy.rating WHERE consumer_id = $id";
$id = 1;
//$query = "SELECT name FROM ligma_obedy.rating WHERE id = $id";


//$C = connect();
$C = null;
if($C) {
    echo 'Connected <br>';
    $result = pg_query($C, $query);

    if(!$result) {
        echo 'Error occurred while executing the query :( <br>';
        pg_last_error($C) . ' <br>';
        exit;
    }

    $obedCount = 0;
    while($row = pg_fetch_assoc($result)) {
        $obedCount++;
        echo 'Obed ' .$obedCount.' rating: ' . $row['comment'] . '<br>';
    }
    echo 'Total obed found: '. $obedCount. '<br>';
    
    pg_free_result($result);
    pg_close($C);
} else {
    echo 'Could not connect to the database.. :(( <br>';
}

echo 'Finished';

?>