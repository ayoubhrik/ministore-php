<?php


function loadDB($sql){
    
    $con = mysqli_connect('localhost', 'root', '','miniProjet') or die ('Erreur SQL !<br/>'.mysqli_error());
    $req = mysqli_query($con,$sql);
    mysqli_close(mysqli_connect('localhost', 'root', '','miniProjet'));
    return $req;
}



?>