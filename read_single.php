<?php 

    //Headers deales with auth and tokens
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Post.php';

    // Instantiate DB object & connect
    $database = new Database();
    $db = $database->connect(); //conn is a func from db.php

    // Instantiate blog post object 
    $post = new Post($db);

    //Get id
    $post->id = isset($_GET['id']) ? $_GET['id'] : die();

    //lets call readSingle mthd
    $post->read_single();

    //Create array
    $post_arr = array(
        'id' => $post->id,
        'title' => $post->title,
        'body' => $post->body,
        'author'=> $post->author,
        'category_id'=> $post->category_id,
        'category_name'=> $post->category_name
    );

    //convert to json data
    print(json_encode($post_arr));
?>