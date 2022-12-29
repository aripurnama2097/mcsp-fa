<?php


$query = "SELECT autoid, labelpart,  CASE WHEN scanresult = 0 THEN 'MATCH' ELSE 'NOT MATCH' END AS scanresult, scandate, pic 
		FROM picking  ORDER BY scandate DESC";
$sql = $conn->Execute($query);

$result = [];
for ($i=0; !$sql->EOF; $i++) { 
    $result[] = $sql->GetRowAssoc();
    $sql->MoveNext();
}

echo json_encode([
    "success"       => true
    ,"connection"   => $conn->isConnected()
    ,"query"        => $query
    ,"rows"         => $result
]);

$sql->Close();
$conn->Close();
$conn=NULL;


// RESPONSE MC_compare_label
 
?>