Siembra = function () {
    this.init();
};

Siembra.prototype.init = function() {
    $('.confirm-delete').on('click', function(e) {
        e.preventDefault();
        $('#myModal').data('id', $(this).data('id')).modal('show');
    });

    $('.borrar').click(function() {
        var id = $('#myModal').data('id');
        $.ajax({
            type: 'GET',
            dataType: "JSON",
            url: Routing.generate('siembra_delete')+ "/" + id,
            success: function (data) {
                $('tr[data-id='+id+']').remove();
                $('#myModal').modal('hide');
            }
        });
    });
    
    $('[data-toggle="tooltip"]').tooltip();
};

$(document).ready(function(){
    new Siembra();
});