var selDiv="";
var storedFiles=[];
$(document).ready(function(){
    $("#img").on("change", handleFileSelect);
    selDiv=$("#selectedBanner");
});
function handleFileSelect(e){
    var files=e.target.files;
    var filesArr=Array.prototype.slice.call(files);
    filesArr.forEach(function(f){
        if(!f.type.match("image.*")){
            return;
        }
        storedFiles.push(f);
        
        var reader=new FileReader();
        reader.onload=function(e){
            var html='<img src="' +
            e.target.result + 
            "\"data-file'" + 
            f.name + 
            "'class=avatar rounded lg' alt='Product Image' height='400px' width='350px'>";
            selDiv.html(html);
        };
        reader.readAsDataURL(f);

    });

}