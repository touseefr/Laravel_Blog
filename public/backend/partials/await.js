

$(document).ready(function (event) {


    var table = $('#await').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: true,
        // pageLength: 05,
        order: [0, 'desc'],
        "ajax": {
            'url': baseUrl + '/getawait',
            'type': 'POST',
            'data': {
                '_token': $("meta[name='csrf-token']").attr('content')
            },
        },
        columns: [

            { data: 'image', name: 'image' },
            { data: 'user_id', name: 'user_id' },
            { data: 'category_id', name: 'category_id' },
            // { data: 'id', name: 'id' },
            { data: 'title', name: 'title' },
            { data: 'active', name: 'active' },
            { data: 'short_description', name: 'description' },
            { data: 'descriprtion', name: 'descriprtion' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
            { data: 'action1', name: 'action1', orderable: false, searchable: false }

        ],

        "columnDefs": [
            {
                "render": function (data, type, row, meta) {
                    return `<img src="${baseUrl}/images/blogimages/${row.image}" class="img-thumbnail rounded" />`
                },
                "targets": 0
            },
            {
                "render": function (data, type, row, meta) {
                    return `<a href="${baseUrl}/editblog/${row.id}" class="btn btn-primary btn-sm edittag" ><i class='fas fa-pencil-alt'></i></a>`
                },
                "targets": 7
            },
            {
                "render": function (data, type, row, meta) {
                    return `<a href="#" class="btn btn-danger btn-sm deleteblog" id="${row.id}"><i class='far fa-trash-alt'></i></a>`
                },
                "targets": 8
            },
            {
                "render": function (data, type, row, meta) {
                    return `<input type="checkbox" class="approve" id="${row.id}" name="approve"/>`
                },
                "targets": 9
            },
        ]

    });

    //approve
    $(document).on('change', '.approve', function (e) {
        e.preventDefault();
        var id = $(this).attr('id');
     //   alert(id);
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to published/approved!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, approve it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: baseUrl + '/approveblog/' + id,
                    type: 'GET',
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Delete',
                            text: 'Blog has been Approved',
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


    //delete tag
    $(document).on('click', '.deleteblog', function (e) {
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
                    url: baseUrl + '/delblog/' + id,
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

    // $('#edittagmodal').on('hidden.bs.modal', function () {
    //     refreshediterror();
    // })

    // function refreshediterror() {
    //     $('#tag_category').removeClass('is-invalid');
    //     $('#tag_category_help').text('');
    // }

    // function onsuccessremoveerror() {
    //     $('#tag_name').removeClass('is-invalid');
    //     $('#tag_name').val('');
    //     $('#tag_name_help').text('');
    // }

    // $('#addtagmodal').on('hidden.bs.modal', function () {
    //     onsuccessremoveerror();
    // })


});