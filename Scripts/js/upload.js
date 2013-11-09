var x,y,w,h;

function handleFiles(files) {
 
    var i = 0;
    var auswahl_div = document.getElementById('auswahl');
 
    var imageType = /image.*/;
 
    var fileList = files;
 
    for(i = 0; i < fileList.length; i++)
    {
        var img = document.createElement("img");    
        img.height = 300;
        img.file = fileList[i];
        img.name = 'pic_'+ i;
        img.id = "cropPic";
        img.classList.add("obj");
 
 
        var reader = new FileReader();
        reader.onload = (function(aImg) { return function(e) { aImg.src = e.target.result; }; })(img);
        reader.readAsDataURL(fileList[i]);
 
        auswahl_div.appendChild(img);    
    }
        
    $(document).ready(function(){
        $('#cropImage').modal({
            overlayClose: true, 
            escClose: true,
            close: true,
            autoPosition: true, 
            overlayCss: {
              backgroundColor:'black'
            }
        });
    });
    
    $(document).ready(function(){
        $('#cropPic').imgAreaSelect({
            aspectRatio: '17:20',
            maxHeight: 176,
            maxWidth: 150,
            onSelectEnd: function (img, selection) {
                x = selection.x2;
                y = selection.y2;
                w = selection.width;
                h = selection.height;
            }
        }); 
    });
}

function sendFiles(){
  var i = 0;
  var imgs = document.querySelectorAll(".obj");
  
  for(i = 0; i < imgs.length; i++)
   {
 
 
    new FileUpload(imgs[i], imgs[i].file);
 
  }
 
}

function FileUpload(img, file) {
 
  
 
  var xhr = new XMLHttpRequest();
  this.xhr = xhr;
  
 
  var prozent;
 
  this.xhr.upload.addEventListener("progress", function(e) {
        if (e.lengthComputable) {
         
   prozent = Math.round((e.loaded * 100) / e.total);
          
        }
      }, false);
  
  xhr.upload.addEventListener("load", function(e){
        prozent  = 100;
 
      }, false);
  
 
 
    var fd = new FormData;
    fd.append("File", file);
    fd.append("x", x);
    fd.append("y", y);
    fd.append("w", w);
    fd.append("h", h);
 
    xhr.open("POST", "../../Scripts/php/upload.php", true);
    xhr.overrideMimeType('text/plain; charset=x-user-defined-binary');
 
    var message = xhr.send(fd);
    console.log(message);
   
 
}