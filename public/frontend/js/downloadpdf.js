window.onload =function(){
    document.getElementById('downloadbtn').addEventListener("click",()=>{
        const invoice=this.document.getElementById('invoice');
        console.log(invoice);
        console.log(window);
        var opt={
            margin:0.8,
            filename:'siensafricainvoice.pdf',
            image:{type:'jpeg',quality: 0.98},
            html2canvas:{scale:1},
            jsPDF:{unit: 'in',format:'letter',orientation:'portrait'}
        }
        html2pdf(invoice).set(opt).save();
    })
}