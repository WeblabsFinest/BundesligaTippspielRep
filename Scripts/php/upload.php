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
    $uniqid = rand(0,9000);
    
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
    
    $dir = "../../Media/Upload/Temp/";  // Das Verzeichnis in welches die Bilder gespeichert werden sollen
    echo $dir;
    $ziel = $dir.$name; 
    
    
    move_uploaded_file  ( $tempname  , $ziel ); 
    
    $content .= "Upload erfolgreich"; 
    
    } 
    
    echo $content; 
    
    //Zuschneiden des Bildes
    $src = $ziel;
    $targ_w = 150;
    $targ_h = 176;
    $jpeg_quality = 90;
    echo "funktioniers?".$src;

    $img_r = imagecreatefromjpeg($src);
    $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

    imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
        $targ_w,$targ_h,$_POST['w'],$_POST['h']);

    //Speichern des neuen Bildes
    imagejpeg($dst_r, "../../Media/Upload/new".$name, $jpeg_quality);
    
?>