<?php
//Headers deales with auth and tokens
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
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

    //assign what we have in data to post
    $post->title = $data->title;
    $post->body = $data->body;
    $post->author = $data->author;
    $post->category_id = $data->category_id;

    //Create post using method from models create()

    if ($post->create()) {
        echo json_encode(
            array('message' => 'Post  Created')
        );
    }else{
        echo json_encode(
            array('message' => 'Post Not Created')
        );
    }

    ?>