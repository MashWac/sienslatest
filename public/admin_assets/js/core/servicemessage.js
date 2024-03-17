$('.show_confirm_two').click(function(event) {
    var form =  $(this).closest("form");
    event.preventDefault();
    swal({
        title: `Are you sure you want to service this record?`,
        text: "Have you confirmed contact with the client",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((isConfirm) => {
      if (isConfirm) {
        form.submit();
      }
    });
});