<?php
function isNumber($var) {
    if(is_numeric($var)) {
        return (int) $var;
    }
    return 0;
}

function getObjectsFromList($list) {
    $newList = array();
    foreach($list as $obj) {
        foreach($obj as $result) {
            array_push($newList, $result);
        }
    }
    return $newList;
}
?>
