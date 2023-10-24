<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="success_popup">
        </div>
    </head>
    <body class="antialiased">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="{{ url('/') }}">Impero</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">

              </ul>
              <form class="form-inline my-2 my-lg-0">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('business.create') }}">Add Business </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('branch.create') }}">Add Branch </a>
                    </li>
                  </ul>
              </form>
            </div>
          </nav>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <h5> Branch List</h5>
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <table class="table data-table">
                        <thead>
                            <tr>
                            <th scope="col">Branch Name</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

        <script type="text/javascript">
            setTimeout(function() {
                $('.alert-success').hide(); // or use .fadeOut() for a smooth fade-out effect
            }, 5000);
          $(function () {
             $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('branch.data') }}",
                method: "GET",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'image', name:'image',searchable:false,orderable:false},
                    {data: 'action', name: 'action',searchable:false,orderable:false},
                ],order: [],
            });
          });
          $(document).on("click",".delete_branch",function(){
                var dataUrl = $(this).attr("data-url");
                var confirmation = window.confirm("Are you sure you want to delete this branch?");
                if (confirmation) {
                    $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    url: dataUrl,
                    type: "DELETE",
                    dataType: 'json',
                    success: function(data) {
                        if(data.success){
                            $(document).find(".success_popup").after(`<div class="alert alert-success">${data.message}</div>`);
                            $('.data-table').DataTable().ajax.reload();
                        }else{
                            $(document).find(".success_popup").append(`<div class="alert alert-danger">${data.message}</div>`);
                        }
                    },
                    error: function(xhr) {
                        alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText +' ' + xhr.responseText);
                    },
                });
                }else{
                    return false;
                }
          })
        </script>
    </body>
</html>
