<?php

function connect() {

    $connection = mysqli_connect('localhost', 'root', '', 'fs_net');
    mysqli_set_charset($connection, 'utf8');

    if (mysqli_connect_errno($connection)) {
        die("Faild to connect to sql: " . mysqli_connect_error());
    }

    return $connection;
}

function insert($sql) {
    $connection = connect();
    mysqli_query($connection, $sql);
    $insert_id = mysqli_insert_id($connection);
    mysqli_close($connection);
    
    return $insert_id;
}

function update($sql) {
    $connection = connect();
    mysqli_query($connection, $sql);
    $affected_rows = mysqli_affected_rows($connection); //How many rows was Updated
    mysqli_close($connection);
    
    return $affected_rows;
}

function delete($sql) {
    $connection = connect();
    mysqli_query($connection, $sql);
    $affected_rows = mysqli_affected_rows($connection);
    mysqli_close($connection);
    
    return $affected_rows;
}

function get_object($sql){
    $connection = connect();
    $result = mysqli_query($connection, $sql);
    $obj = mysqli_fetch_object($result);
    mysqli_close($connection);
    
    return $obj;
}


function get_array($sql){
    $connection = connect();
    $arr = array();
    $result = mysqli_query($connection, $sql);
    
    while($obj = mysqli_fetch_object($result)){
        $arr[] = $obj;
    }
    
    mysqli_close($connection);
    
    return $arr;
}