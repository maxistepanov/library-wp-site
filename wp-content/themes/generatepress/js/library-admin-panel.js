	jQuery('#exampleModal').on('show.bs.modal', function (event) {
  var button = jQuery(event.relatedTarget) ;// Button that triggered the modal
  var recipient = button.data('whatever') ;// Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = jQuery(this);

  modal.find('.modal-title').text('132132');
  modal.find('.modal-body input').val(recipient);
  console.log("asd");
})
 