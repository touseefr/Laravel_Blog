

$(document).ready(function (event) {


    var table = $('#categories').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: true,
        // pageLength: 05,
        order: [0, 'asc'],
        "ajax": {
            'url': baseUrl + '/getallcat',
            'type': 'GET',
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
                    return `<a href="#" class="btn btn-primary btn-sm editCategory" id="${row.id}"><i class='fas fa-pencil-alt'></i></a>`
                },
                "targets": 4
            },
            {
                "render": function (data, type, row, meta) {
                    return `<a href="#" class="btn btn-danger btn-sm deleteCategory" id="${row.id}"><i class='far fa-trash-alt'></i></a>`
                },
                "targets": 5
            },
        ]

    });



    //submit category namae to database through modal form
    $('#addcategory').submit(function (event) {
        event.preventDefault();
        var form = $('#addcategory')[0];
        var formData = new FormData(form);

        $.ajax({
            url: baseUrl + '/addcat',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                $('#addcatmodal').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Category has been added',
                })
                table.ajax.reload();
            },
            error: function (reject) {
                if (reject.status = 422) {
                    var errors = $.parseJSON(reject.responseText);
                    $.each(errors.errors, function (key, value) {
                        $('#' + key).addClass('is-invalid');
                        $('#' + key + '_help').text(value[0]);
                    })
                }
            }


        });
    });

    //get category for edit record
    $(document).on('click', '.editCategory', function (e) {
        e.preventDefault();
        var id = $(this).attr('id');
        // alert(id);
        $.ajax({
            url: baseUrl + '/getcat/' + id,
            type: 'GET',
            processData: false,
            contentType: false,
            success: function (data) {
                //console.log(data);
                $('#category_id').val(data.id);
                $('#edit_category').val(data.name);
                $('#editcatmodal').modal('show');
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

    //update category
    $('#editcategory').submit(function (e) {
        e.preventDefault();
        var form = $('#editcategory')[0];
        var formData = new FormData(form);
        $.ajax({
            url: baseUrl+'/updatecat',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                $('#editcatmodal').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Updated',
                    text: 'Category has been updated',
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
    //delete category
    $(document).on('click','.deleteCategory', function(e){
        e.preventDefault();
        var id=$(this).attr('id');
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
                    url: baseUrl+'/delcat/'+id,
                    type: 'GET',
                    processData: false,
                    contentType: false,
                    success: function(data)
                    {
                        Swal.fire({
                            icon: 'success',
                            title: 'Delete',
                            text: 'Category has been deleted',
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

    $('#editcatmodal').on('hidden.bs.modal', function () {
        refreshediterror();
    })

  function refreshediterror()
  {
      $('#edit_category').removeClass('is-invalid');
      $('#edit_category_help').text('');
  }

    function onsuccessremoveerror() {
        $('#category_name').removeClass('is-invalid');
        $('#category_name').val('');
        $('#category_name_help').text('');
    }

    $('#addcatmodal').on('hidden.bs.modal', function () {
        onsuccessremoveerror();
    })


});