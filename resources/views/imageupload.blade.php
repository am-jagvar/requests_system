<!DOCTYPE html>
<html>

<head>
    <title>Laravel Multiple Images Upload Using Dropzone</title>
    <meta name="_token" content="{{ csrf_token() }}" />
    <script src="{{URL::asset('js/dropzone.js')}}"></script>
    <link rel="stylesheet" href="{{URL::asset('css/dropzone.min.css')}}">
</head>

<body>
    <div class="container">
        <form method="post" action="{{ url('image/upload/store') }}" enctype="multipart/form-data" class="dropzone"
            style="border-radius: 20px" id="dropzone">
            @csrf
            <input type="text" name="fname" id="fname">
            <input type="text" name="lname" id="lname">
            <button type="submit">submit</button>
        </form>

        <script type="text/javascript">
            Dropzone.options.dropzone = { // The camelized version of the ID of the form element

                // The configuration we've talked about above
                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 100,
                maxFiles: 100,
                addRemoveLinks: true,
                timeout: 90000,
                removedfile: function(file) {
                    name = file.upload.filename;
                    $.ajax({
                        type: 'POST',
                        url: '{{ url('image/delete') }}',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            filename: name
                        },
                        success: function(data) {
                            console.log("فایل با موفقیت حذف شد !");
                        },
                        error: function(e) {
                            console.log(e);
                        }
                    });
                    var fileRef;
                    return (fileRef = file.previewElement) != null ?
                        fileRef.parentNode.removeChild(file.previewElement) : void 0;
                },
                // The setting up of the dropzone
                init: function() {
                    var myDropzone = this;

                    // First change the button to actually tell Dropzone to process the queue.
                    this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
                        // Make sure that the form isn't actually being sent.
                        e.preventDefault();
                        e.stopPropagation();
                        myDropzone.processQueue();
                    });

                    // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
                    // of the sending event because uploadMultiple is set to true.
                    this.on("sendingmultiple", function() {
                    });
                    this.on("successmultiple", function(files, response) {
                        // Gets triggered when the files have successfully been sent.
                        // Redirect user or notify of success.
                    });
                    this.on("errormultiple", function(files, response) {
                        // Gets triggered when there was an error sending the files.
                        // Maybe show form again, and notify user of error
                        console.log(response);
                    });
                }

            }

        </script>
</body>

</html>
