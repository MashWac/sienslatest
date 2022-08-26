
document.addEventListener("DOMContentLoaded", function() {


  var TotalValue = 0;

  $("tr #loop").each(function(index,value){
    currentRow = parseFloat($(this).text());
    TotalValue += currentRow
  });
  document.getElementById('totalpurchase').innerText = TotalValue;
  document.getElementById("totalpay").value = TotalValue; 

});
$(".formquan").on("change", function () {
    
    var ticketprice = $(this).closest("td").find("input[name='ticket_price']").val();
    var ticketquantity = $(this).val();
    var ticksubtotal=ticketprice*ticketquantity;
    var sub=$(this).closest("tr").find("#totalsub").html(ticksubtotal);


    var TotalValue = 0;

    $("tr #loop").each(function(index,value){
      currentRow = parseFloat($(this).text());
      TotalValue += currentRow
    });
    document.getElementById('totalpurchase').innerText = TotalValue;
    document.getElementById("totalpay").value = TotalValue; 
    

});

