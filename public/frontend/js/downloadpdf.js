window.onload =function(){
    document.getElementById('downloadbtn').addEventListener("click",()=>{
        const invoice=this.document.getElementById('invoice');
        console.log(invoice);
        console.log(window);
        var opt={
            filename:'siensafricainvoice.pdf'
        };
        html2pdf().from(invoice).set(opt).save();
    })
}