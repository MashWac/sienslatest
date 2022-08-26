
function toggle(){
    var name=document.getElementById('regionselected').value;
    if(name== 'outsidenairobi'){
        document.getElementById("fieldoutside").style.display='inline';
        document.getElementById("fieldnairobi").style.display='none';
    }
    else if(name=='none'){
        document.getElementById("fieldnairobi").style.display='none';
        document.getElementById("fieldoutside").style.display='none';
    }else{
        document.getElementById("fieldoutside").style.display='none';
        document.getElementById("fieldnairobi").style.display='inline';

    }
   
} 