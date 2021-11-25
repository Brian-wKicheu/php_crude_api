<?php
//Headers deales with auth and tokens
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,Access-Control-Allow-Methods, Authorization, x-Requested-with');

    include_once '../../config/Database.php';
    include_once '../../models/Post.php';

    // Instantiate DB object & connect
    $database = new Database();
    $db = $database->connect(); //conn is a func from db.php

    // Instantiate blog post object 
    $post = new Post($db);

    //Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    //Set id to update
    $post->id = $data->id;


    //Delete post using method from models delete()

    if ($post->delete()) {
        echo json_encode(
            array('message' => 'Post  Deleted')
        );
    }else{
        echo json_encode(
            array('message' => 'Post Not Deleted')
        );
    }

    ?>