<?php
// this file is interacting with the models files

//Headers deales with auth and tokens
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Post.php';

    // Instantiate DB object & connect
    $database = new Database();
    $db = $database->connect(); //conn is a func from db.php

    // Instantiate blog post object 
    $post = new Post($db);//and call read method

    //Blog post query
    $result = $post->read();
    //Get row count
    $num = $result->rowCount();

    //c heck if any posts
    if ($num > 0) {
       //Post array
       $post_arr = array();
       $post_arr['data'] = array();

       //now lets loop throuh result
       while($row = $result->fetch(PDO::FETCH_ASSOC)){
           extract($row);

           $post_item = array(
               'id' => $id,
               'title' => $title,
               'body' => html_entity_decode($body),
               'author' => $author,
               'category_id' => $category_id,
               'category_name' => $category_name
           );

           //push to the "data"
           array_push($post_arr['data'], $post_item);
       }
       // Turn to JSON & OUTPUT
       echo json_encode($post_arr);
    }else{
        //No posts
        echo json_encode(
            array('message' => 'No Posts Found')
        );
    }
?>