<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>TO-DO List</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- icon --}}
    <script src="https://unpkg.com/feather-icons"></script>
  </head>
 
  <body>
    @if (isset($name))
    @include('components.error-message', ['name' => $name])
@endif
    @yield('content')

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
 
   {{-- Ajax --}}
  <script>
  feather.replace();
</script>
 
 <script>
document.addEventListener("DOMContentLoaded", function() {
    let editButtons = document.querySelectorAll(".btn-edit-task");

    editButtons.forEach(button => {
        button.addEventListener("click", function() {
            let taskId = this.getAttribute("data-id");
            let taskName = this.getAttribute("data-name");
            let taskDate = this.getAttribute("data-date");
            let taskTime = this.getAttribute("data-time");
            let taskDescription = this.getAttribute("data-description");

            // Isi modal dengan data task
            document.getElementById("task-id").value = taskId;
            document.getElementById("name").value = taskName;
            document.getElementById("date").value = taskDate;
            document.getElementById("time").value = taskTime;
            document.getElementById("description").value = taskDescription;

            // Set form action ke route update dengan ID task
            let form = document.getElementById("form-edit");
            form.action = `/task/${taskId}`;
        });
    });
});
</script>


  </body>
</html>