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
    $ziel = $dir.$name; 
    
    
    move_uploaded_file  ( $tempname  , $ziel ); 
    }else{
        echo "error";
    }
    
    
    //Zuschneiden des Bildes
    $src = $ziel;
    $targ_w = 150;
    $targ_h = 176;
    $jpeg_quality = 90;

    $img_r = imagecreatefromjpeg($src);
    list($width, $height, $type, $attr) = getimagesize($src);
    $ratio = 1;
    if($width > 400){
        $ratio = $width/400;
        
    }
    
    
    $w = round($ratio * $_POST['w']);
    $h = round($ratio * $_POST['h']);
    $x = round($ratio * $_POST['x']);
    $y = round($ratio * $_POST['y']);
    
    $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

    imagecopyresampled($dst_r,$img_r,0,0,$x,$y,
        $targ_w,$targ_h,$w,$h);

    $new = "../../Media/Upload/".$name;

    //Speichern des neuen Bildes
    imagejpeg($dst_r, $new, $jpeg_quality);
    echo $name;
    
?>