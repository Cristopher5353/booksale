$(document).ready(function() {
    new Sortable(bookImages, {
        animation: 150,
        ghostClass: 'blue-background-class',
        store: {
            set: function(sortable) {
                const sorts = sortable.toArray();
                
                $.ajax({
                    url: '/admin/changePositionBookImages',
                    headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
                    data: {
                        sorts:sorts,
                    },
                    type: 'POST',
                    datatype: 'JSON',
                })
            }
        }
    });
})