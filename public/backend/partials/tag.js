

$(document).ready(function (event) {


    var table = $('#tags').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: true,
        // pageLength: 05,
        order: [0, 'asc'],
        "ajax": {
            'url': baseUrl + '/getalltag',
            'type': 'POST',
             'data' : {
                 '_token' : $("meta[name='csrf-token']").attr('content')
             },
        },
        columns: [

            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
            { data: 'action1', name: 'action1', orderable: false, searchable: false }
        ],

        "columnDefs": [
            {
                "render": function (data, type, row, meta) {
                    return `<a href="#" class="btn btn-primary btn-sm edittag" id="${row.id}"><i class='fas fa-pencil-alt'></i></a>`
                },
                "targets": 4
            },
            {
                "render": function (data, type, row, meta) {
                    return `<a href="#" class="btn btn-danger btn-sm deletetag" id="${row.id}"><i class='far fa-trash-alt'></i></a>`
                },
                "targets": 5
            },
        ]

    });


    //submit tag namae to database through modal form
    $('#addtag').submit(function (event) {
        event.preventDefault();
        var form = $('#addtag')[0];
        var formData = new FormData(form);

        $.ajax({
            url: baseUrl+'/addtag',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                $('#addtagmodal').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'tag has been added',
                })
                table.ajax.reload();
            },
            error: function (reject) {
                if (reject.status = 422) {
                    refreshediterror();
                    var errors = $.parseJSON(reject.responseText);
                    $.each(errors.errors, function (key, value) {
                        $('#' + key).addClass('is-invalid');
                        $('#' + key + '_help').text(value[0]);
                    })
                }
            }
        });
    });

    //get tag for edit record
    $(document).on('click', '.edittag', function (e) {
        e.preventDefault();
        var id = $(this).attr('id');
       // alert(id);
        $.ajax({
            url: baseUrl + '/gettag/' + id,
            type: 'GET',
            processData: false,
            contentType: false,
            success: function (data) {
                //console.log(data);
                $('#tag_id').val(data.id);
                $('#edit_tag').val(data.name);
                $('#edittagmodal').modal('show');
            },
            error: function (data, textStatus, xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Not Found',
                    text: 'Sorry we are unable to find this record!!!',
                })
            }
        })
    });

    //update tag
    $('#edittag').submit(function (e) {
        e.preventDefault();
        var form = $('#edittag')[0];
        var formData = new FormData(form);
        $.ajax({
            url: baseUrl + '/updatetag',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                $('#edittagmodal').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Updated',
                    text: 'Tag has been updated',
                })
                table.ajax.reload();
            },
            error: function (reject) {

                if (reject.status = 422) {
                    refreshediterror();
                    var errors = $.parseJSON(reject.responseText);
                    $.each(errors.errors, function (key, value) {
                        $('#' + key).addClass('is-invalid');
                        $('#' + key + '_help').text(value[0]);
                    })
                }
            }
        })
    });
    //delete tag
    $(document).on('click', '.deletetag', function (e) {
        e.preventDefault();
        var id = $(this).attr('id');
        //alert(id);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: baseUrl + '/deltag/' + id,
                    type: 'GET',
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Delete',
                            text: 'Tag has been deleted',
                        })
                        table.ajax.reload();
                    },
                    error: function (data, textStatus, xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Not Found',
                            text: 'Sorry we are unable to find this record!!!',
                        })
                    }
                });
            }
        })
    })

    $('#edittagmodal').on('hidden.bs.modal', function () {
        refreshediterror();
    })

    function refreshediterror() {
        $('#tag_category').removeClass('is-invalid');
        $('#tag_category_help').text('');
    }

    function onsuccessremoveerror() {
        $('#tag_name').removeClass('is-invalid');
        $('#tag_name').val('');
        $('#tag_name_help').text('');
    }

    $('#addtagmodal').on('hidden.bs.modal', function () {
        onsuccessremoveerror();
    })


});