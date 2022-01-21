<script>
  window.addEventListener('swal:modal', event => {
    new swal(event.detail);
  });
  window.addEventListener('swal:confirm', event => {
    new swal({
      title: event.detail.message,
      text: event.detail.text,
      icon: event.detail.type,
      buttons: true,
      dangerMode: true,
    })
      .then((willDelete) => {
        if (willDelete) {
          window.livewire.emit('remove');
        }
      });
  });
  window.addEventListener('swal:confirm2', event => {
    var aaa = event.detail.event;
    new swal(event.detail)
      .then((data) => {
        console.log(aaa, data)
        // if (data) {
        window.livewire.emit(aaa, data);
        // }
      });
  });
</script>
