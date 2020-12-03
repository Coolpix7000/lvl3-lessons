<?php
function connect_database() {
    $server_name = "mysql";
    $username = "root";
    $password = "p4ssw0rd1";
    $db_name = "movies_db";

    // Create connection & check for errors
    $connection = new mysqli($server_name, $username, $password, $db_name);

    if($connection->connect_error) {
        die("Connection failed: ".$connection->connect_error);
    }
        
    return $connection;
}

function disconnect_database($connection) {
    $connection->close();
    return true;
}

function get_users($connection, $search = '') {
    $sql_to_run = "SELECT * FROM customers WHERE customer_name LIKE '$search%'";
    $result = $connection->query($sql_to_run);
    
    $users_array = array();
    
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
             $users_array[] = (object) array(
                 'id' => $row["id"],
                 'customer_name' => $row["customer_name"],
                 'address' => $row["address"]
             );
        }
        return $users_array;

    } else {
       return(false);
    }
}

function get_movies($connection, $search = '') {
    $sql_to_run = "SELECT movies.*, genre, format, file_type FROM movies 
                   LEFT JOIN genres ON (genres.genre_id = movies.genre_id)
                   LEFT JOIN video_formats ON (video_formats.type_id = movies.type_id)
                   WHERE title LIKE '%$search%'";
    $result = $connection->query($sql_to_run);
    
    $movies_array = array();
    
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
             $movies_array[] = (object) array(
                 'id' => $row["id"],
                 'title' => $row["title"],
                 'genre' => $row["genre"],
                 'format' => $row["format"],
                 'file_type' => $row["file_type"]
             );
        }
        return $movies_array;

    } else {
       return(false);
    }
}

function insert_user($connection, $name, $address) {
    $sql_to_run = "INSERT INTO customers (customer_name, address)
                  VALUES('$name', '$address')";
    
    if($connection->query($sql_to_run) === true) {
        return("User created sucessfully");
    } else {
        return("Error: ".$sql_to_run."<br>".$connection->error);
    }
}

// INCOMPLETE
function insert_movie($connection, $search = '') {
    $sql_to_run = "INSERT INTO movies";
    $result = $connection->query($sql_to_run);
    
    $movies_array = array();
    
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
             $movies_array[] = (object) array(
                 'id' => $row["id"],
                 'title' => $row["title"],
                 'genre' => $row["genre"],
                 'format' => $row["format"],
                 'file_type' => $row["file_type"]
             );
        }
        return $movies_array;

    } else {
       return(false);
    }
}

function delete_SOMETHING($connection) {

    $sql_to_run = "DELETE FROM users WHERE username = 'Kelly'";
    $result = $connection->query($sql_to_run);

    if($connection->query($sql_to_run) === true) {
        echo("Record deleted sucessfullly");
    } else {
        echo("error: ".$sql_to_run."<br>".$connection->error);
    }
}











?>