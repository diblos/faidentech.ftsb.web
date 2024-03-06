<?php
function joinStrings($separator = '|', ...$args) {
    $args = array_filter($args, 'strlen'); // equivalent to compact(args) in TypeScript
    $args = array_map('trim', $args); // trim all strings in the array
    $args = array_map('strtolower', $args); // convert all strings to lower case
    return implode($separator, $args); // join the strings with the separator
}

function find($array, $key, $value) {
    foreach ($array as $item) {
        if (isset($item->$key) && $item->$key === $value) {
            return $item;
        }
    }
    return null;
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}  
?>