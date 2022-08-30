window.onload =function(){
    document.getElementById('downloadbtn').addEventListener("click",()=>{
        const invoice=this.document.getElementById('invoice');
        console.log(invoice);
        console.log(window);
        var opt={
            margin:0.4,
            filename:'siensafricainvoice.pdf',
            image:{type:'png',quality: 0.98},
            html2canvas:{scale:2},
            jsPDF:{unit: 'in',format:'letter',orientation:'portrait'}
        }
        html2pdf(invoice,opt);
    })
}