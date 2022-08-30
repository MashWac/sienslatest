window.onload =function(){
    document.getElementById('downloadbtn').addEventListener("click",()=>{
        const invoice=this.document.getElementById('invoice');
        console.log(invoice);
        console.log(window);
        var opt={
            margin:0.4,
            filename:'siensafricainvoice.pdf',
            image:{type:'jpeg',quality: 0.98},
            
        };
        html2pdf().from(invoice).set(opt).save();
    })
}