<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title>Learn FilePod</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
    <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />

  <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">


</head>
<body class="initialized">
  <div class="form_container">
    @if(session() -> has('success'))
      <div class="success_container">
        {{ session('success') }}
      </div>
    @endif

    @if(session() -> has('danger'))
      <div class="danger_container">
        {{ session('danger') }}
      </div>
    @endif

    <form method="POST" action="/" enctype="multipart/form-data">
      @csrf
      <div class="mb-6">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
        </div>

        @error('name')
          <span class="text-red-400 text-sm"> {{ message }} </span>
        @enderror
      </div>

      <div class="mb-6">
        <div class="form-group">
          <label>Image</label>
          <input type="file" name="image" id="image" class="form-control-file">
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
  <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
  <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

  <script>
    // Get a reference to the file input element
    const inputElement = document.querySelector('input[type="file"]');

    FilePond.registerPlugin(
      FilePondPluginFileValidateType,
      FilePondPluginFileValidateSize,
    );

    // Create a FilePond instance
    const pond = FilePond.create(inputElement, {
      acceptedFileTypes: ['application/pdf']
    });

    FilePond.setOptions({
      server: {
        process: '/tmp-upload',
        revert: '/tmp-delete',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
      }
    });
</script>
</body>
</html>