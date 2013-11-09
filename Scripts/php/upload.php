<?php 
    
    
    $tempname = $_FILES['File']['tmp_name'];  
    $name = $_FILES['File']['name'];  
    $type = $_FILES['File']['type'];  
    
    
    if($type != "image/gif" && $type != "image/jpeg" && $type !="image/png") { 
        $content .= "Nur gif, png und jpeg Dateien dürfen hochgeladen werden.<br>"; 
        $err=1;  
    
    }  
    
    
    $original_name = $name; 
    
    
    $imgtype =getimagesize($tempname); 
    
    
    switch($imgtype[2]){ 
    
    case "1": 
        $endung = "gif"; 
        $uniqid = uniqid(); 
        $name = $uniqid.".gif"; 
        break; 
    
    case "2": 
         
        $endung = "jpg"; 
        $uniqid = uniqid(); 
        $name = $uniqid.".jpg"; 
        break; 
    
    case "3": 
        $endung = "png"; 
        $uniqid = uniqid(); 
        $name = $uniqid.".png"; 
        break; 
    
    }  
    
    
    if(empty($err)) {  
    
    $dir = "../../Media/Upload/";  // Das Verzeichnis in welches die Bilder gespeichert werden sollen
    echo $dir;
    $ziel = $dir.$name; 
    
    
    move_uploaded_file  ( $tempname  , $ziel ); 
    
    $content .= "Upload erfolgreich"; 
    
    } 
    
    echo $content; 
?>