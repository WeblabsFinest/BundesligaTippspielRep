<script type="text/javascript" src="../../Ressource/jquery.imgareaselect-0.9.10/scripts/jquery.imgareaselect.js"></script>
<link rel="stylesheet" href="../../Ressource/jquery.imgareaselect-0.9.10/css/imgareaselect-default.css"/>
<div id="regProfileImage">
    <div class="clear">
        <div class="left"><img id="profileImagePlaceholder" src="../../Media/Images/profilbild-platzhalter.jpg" hspace="10" /></div>
        <input type="hidden" id="profileImagePath" name="picturePath" value="" />
        <div>
            Wähle ein Bild von deiner Festplatte aus und lege es als dein Profilbild fest.
        </div>
    </div>
    <input type="file" name="fileElem[]" id="fileElem"
        accept="image/*" onchange="handleFiles(this.files)">
</div>
<div class="dialog" id="cropImage">
    <div id="auswahl"></div>
    
    <input type="button" onclick="sendFiles();" value="Hochladen">
</div>
<script type="text/javascript" src="../../Scripts/js/upload.js"></script>