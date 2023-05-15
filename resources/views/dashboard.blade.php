<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('پنل کاربری') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-light rounded">
            <div class="table-responsive">
                <div class="m-5" style="text-align: center">
                    <button id="sendNewbtn" type="button" data-toggle="modal" data-target="#sendNewTicket"
                        class="btn btn-warning rounded-pill"> درخواست جدید </button>
                </div>
                <div class="modal fade" id="sendNewTicket" tabindex="-1" role="dialog"
                    aria-labelledby="sendNewTicketLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="d-flex">
                                <button type="button" class="close ml-3 mt-2" style="text-align: left"
                                    data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-header float-right" dir="rtl">
                                <h5 class="modal-title text-info" style="" id="sendNewTicketLabel">درخواست جدید
                                </h5>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ url('image/upload/store') }}"
                                    enctype="multipart/form-data" class="dropzone" style="border-radius: 20px"
                                    id="dropzone" dir="rtl">
                                    @csrf
                                    <div id="demo" class="m-2" style="text-align: center"></div>
                                    <div class="form-group row" style="text-align: center">
                                        <label for="inputtitle" class="col-sm-2 col-form-label">موضوع</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="title" id="title">
                                        </div>
                                    </div>
                                    <div class="form-group row" style="text-align: center">
                                        <label for="inputdescryption" class="col-sm-2 col-form-label">توضیحات</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" rows="6" name="descryption" id="descryption"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row" style="text-align: center">
                                        <label for="inputpriority" class="col-sm-2 col-form-label">اولویت</label>
                                        <div class="col-sm-4">
                                            <select id="inputpriority" name="priority" class="form-control"
                                                style="text-align: center">
                                                <option selected value="0">عادی</option>
                                                <option value="1" class="text-danger">فوری</option>
                                                <option value="2" class="text-primary">آنی</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row" style="text-align: center">
                                        <label for="inputdescryption" class="col-sm-2 col-form-label">پیوست</label>
                                        <span class=""><small class="text-danger">فرمت های قابل قبول : عکس ، ویدیو
                                                و pdf</small></span>
                                        <div class="col-sm-10">
                                        </div>
                                    </div>
                                    <div class="form-group row" style="text-align: center">
                                        <div class="col-sm-12 " style="position: absolute;">
                                            <button class="btn btn-success mr-3 rounded-pill"
                                                style="position: absolute;right:0;bottom: -100px;width: 100px;"
                                                type="submit"><b>ارسال</b></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table" style="text-align: center;" dir="rtl" id="myTable">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">تاریخ ثبت</th>
                            <th scope="col">درخواست کننده</th>
                            <th scope="col">موضوع درخواست</th>
                            <th scope="col">فوریت</th>
                            <th scope="col">سرپرست</th>
                            <th scope="col">مدیرعامل</th>
                            <th scope="col">عملیات</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @foreach ($requests as $index => $request)
                            <tr>
                                <th scope="row">{{ \Morilog\Jalali\CalendarUtils::convertNumbers($index + 1) }}</th>
                                @php
                                    $date = \Morilog\Jalali\CalendarUtils::strftime('Y-m-d/H:i:s', strtotime($request->created_at));
                                @endphp
                                <td>{{ \Morilog\Jalali\CalendarUtils::convertNumbers($date) }}</td>
                                <td>{{ $request->user->name }}</td>
                                <td>{{ $request->title }}</td>
                                @if ($request->priority == 0)
                                    <td><span class="bg-light text-dark rounded-pill p-2">معمولی<span></td>
                                @elseif($request->priority == 1)
                                    <td><span class="bg-danger text-light rounded-pill p-2">فوری<span></td>
                                @else
                                    <td><span class="bg-primary text-dark rounded-pill p-2">آنی<span></td>
                                @endif
                                @if ($request->supervisor_verify == 0)
                                    <td id="supervisornotverifytd{{ $request->id }}"><span
                                            id="supervisornotverify{{ $request->id }}">&#10060;</span></td>
                                @else
                                    <td><span id="supervisorverify{{ $request->id }}">&#9989;</span></td>
                                @endif
                                @if ($request->admin_verify == 0)
                                    <td><span id="adminnotverify{{ $request->id }}">&#10060;</span></td>
                                @else
                                    <td><span id="adminverify{{ $request->id }}">&#9989;</span></td>
                                @endif
                                <td><button id="showbtn" type="button" data-toggle="modal"
                                        data-target="#showTicket{{ $index }}"
                                        class="btn btn-warning rounded-pill"> مشاهده </button></td>
                            </tr>
                            <div class="modal fade" id="showTicket{{ $index }}" tabindex="-1"
                                role="dialog" aria-labelledby="showTicketLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="d-flex">
                                            <button type="button" class="close ml-3 mt-2" style="text-align: left"
                                                data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-header float-right" dir="rtl">
                                            <h5 class="modal-title text-info" style="" id="showTicketLabel">
                                                مشاهده درخواست
                                            </h5>
                                        </div>
                                        <div class="modal-body">
                                            <div style="border-radius: 20px" dir="rtl">
                                                <div class="form-group row" style="text-align: center">
                                                    <label for="inputtitle"
                                                        class="col-sm-2 col-form-label">موضوع</label>
                                                    <div class="col-sm-10">
                                                        {{ $request->title }}
                                                    </div>
                                                </div>
                                                <hr class="bg-gray m-2" style="">
                                                <div class="form-group row" style="text-align: center">
                                                    <label for="inputdescryption"
                                                        class="col-sm-2 col-form-label">توضیحات</label>
                                                    <div class="col-sm-10">
                                                        {{ $request->descryption }}
                                                    </div>
                                                </div>
                                                <hr class="bg-gray">
                                                <div class="form-group row" style="text-align: center">
                                                    <label for="inputpriority"
                                                        class="col-sm-2 col-form-label">اولویت</label>
                                                    <div class="col-sm-10">
                                                        @if ($request->priority == 0)
                                                            <span
                                                                class="bg-light text-dark rounded-pill p-2">معمولی<span>
                                                                @elseif($request->priority == 1)
                                                                    <span
                                                                        class="bg-danger text-light rounded-pill p-2">فوری<span>
                                                                        @else
                                                                            <span
                                                                                class="bg-primary text-dark rounded-pill p-2">آنی<span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <hr class="bg-gray">
                                                <div class="form-group row" style="text-align: center">
                                                    <label for="inputdescryption"
                                                        class="col-sm-2 col-form-label">پیوست</label>
                                                    <div class="col-sm-10 d-flex">
                                                        @if ($request->appends->first())
                                                            @foreach ($request->appends as $j => $append)
                                                                @if (strstr(mime_content_type($append->path), 'image'))
                                                                    <a href="{{ $append->path }}" target="_blank">
                                                                        <img src="{{ URL::asset($append->path) }}"
                                                                            alt="تصویر {{ $j }}"
                                                                            class="img-thumbnail m-2"
                                                                            style="width: 50px; height: 50px;">
                                                                    </a>
                                                                @else
                                                                    <a href="{{ $append->path }}" class="mr-3"
                                                                        target="_blank">پیوست {{ $j + 1 }}</a>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <span>_</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                @can('verify-request')
                                                    @if (Auth::user()->hasRole('Admin') && $request->admin_verify != 0)
                                                        <div class="form-group" style="margin: auto">
                                                            <button class="btn btn-primary rounded-pill pr-3 pl-3">تایید
                                                                شده</button>
                                                        </div>
                                                    @elseif(Auth::user()->hasRole('Supervisor') && $request->supervisor_verify != 0)
                                                        <div class="form-group" style="margin: auto">
                                                            <button class="btn btn-primary rounded-pill pr-3 pl-3">تایید
                                                                شده</button>
                                                        </div>
                                                    @else
                                                        <div class="form-group" style="margin: auto"
                                                            id="verifydiv{{ $request->id }}">
                                                            <button class="btn btn-info rounded-pill pr-3 pl-3"
                                                                onclick="verify_request({{ $request->id }})">تایید</button>
                                                        </div>
                                                    @endif
                                                @endcan
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    <div class="modal fade" id="showTicket" tabindex="-1" role="dialog" aria-labelledby="showTicketLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="d-flex">
                    <button type="button" class="close ml-3 mt-2" style="text-align: left" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-header float-right" dir="rtl">
                    <h5 class="modal-title text-info" style="" id="showTicketLabel">مشاهده درخواست
                    </h5>
                </div>
                <div class="modal-body">
                    <div style="border-radius: 20px" dir="rtl">
                        <div class="form-group row" style="text-align: center">
                            <label for="inputtitle" class="col-sm-2 col-form-label">موضوع</label>
                            <div class="col-sm-10" id="requesttitle">
                            </div>
                        </div>
                        <hr class="bg-gray m-2" style="">
                        <div class="form-group row" style="text-align: center">
                            <label for="inputdescryption" class="col-sm-2 col-form-label">توضیحات</label>
                            <div class="col-sm-10" id="requestdescryption">
                            </div>
                        </div>
                        <hr class="bg-gray">
                        <div class="form-group row" style="text-align: center">
                            <label for="inputpriority" class="col-sm-2 col-form-label">اولویت</label>
                            <div class="col-sm-10" id="requestpriority">
                            </div>
                        </div>
                        <hr class="bg-gray">
                        <div class="form-group row" style="text-align: center">
                            <label for="inputdescryption" class="col-sm-2 col-form-label">پیوست</label>
                            <div class="col-sm-10" id="requestappends">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        Dropzone.options.dropzone = { // The camelized version of the ID of the form element
            // The configuration we've talked about above
            autoProcessQueue: false,
            // acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf,.mp3,.",
            acceptedFiles: "image/*,video/*,application/pdf",
            uploadMultiple: true,
            parallelUploads: 100,
            maxFiles: 100,
            addRemoveLinks: true,
            timeout: 90000,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
                return time + file.name;
            },
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
                    if (myDropzone.getQueuedFiles().length === 0) {
                        var blob = new Blob();
                        blob.upload = { 'chunked': myDropzone.defaultOptions.chunking };
                        myDropzone.uploadFile(blob);
                    } else {
                        myDropzone.processQueue();
                    }
                });
                
                // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
                // of the sending event because uploadMultiple is set to true.
                this.on("sendingmultiple", function() {});
                this.on("successmultiple", function(files, response) {
                    // Gets triggered when the files have successfully been sent.
                    // Redirect user or notify of success.
                    // alert(response.responseFiles[0]);
                    let table = document.getElementById("tableBody");
                    // Create row element
                    let row = document.createElement("tr")
                    // Create cells
                    const columns = [];
                    for (let i = 0; i < 8; i++) {
                        columns[i] = document.createElement("td");
                    }
                    // Insert data to cells
                    lable = '';
                    switch (response.request['priority']) {
                        case "0":
                            lable = '<span class="bg-light text-dark rounded-pill p-2">معمولی<span>';
                            break;
                        case "1":
                            lable = '<span class="bg-danger text-light rounded-pill p-2">فوری<span>';
                            break;
                        case "2":
                            lable = '<span class="bg-primary text-dark rounded-pill p-2">آنی<span>';
                            break;
                        default:
                            break;
                    }
                    console.log(response);
                    columns[0].innerText = "#";
                    columns[1].innerText = response.createdtime;
                    columns[2].innerText = response.name;
                    columns[3].innerText = response.request['title'];
                    columns[4].innerHTML = lable;
                    columns[5].innerHTML = "&#10060;";
                    columns[6].innerHTML = "&#10060;";
                    columns[7].innerHTML =
                        "<td><button id='showbtn' type='button' data-toggle='modal' data-target='#showTicket' class='btn btn-warning rounded-pill'> مشاهده </button></td>";
                    // Append cells to row
                    for (let i = 0; i < 8; i++) {
                        row.appendChild(columns[i]);
                    }
                    // Append row to table body
                    table.appendChild(row);
                    let divappends = document.getElementById("requestappends");
                    divappends.classList.add("d-flex");
                    divappends.classList.add("m-2");
                    divappends.innerHTML = '';
                    document.getElementById('requesttitle').innerHTML = response.request['title'];
                    document.getElementById('requestdescryption').innerHTML = response.request[
                        'descryption'];
                    document.getElementById('requestpriority').innerHTML = lable;
                    files.forEach(file => {
                        console.log(file);
                        if (file['type'].substring(0, 5) == 'image') {
                            dataUrl = file['dataURL'];
                            var img = document.createElement("img");
                            img.src = dataUrl;
                            img.style.width = "50px";
                            img.style.height = "50px";
                            img.style.borderRadius = "5px";
                            divappends.appendChild(img);
                        } else {
                            if(files[0]['size'] != 0){
                                var span = document.createElement("span");
                                span.innerHTML = "<span class ='m-3'><b>" + file['name'] +
                                "</b></span>";
                                divappends.appendChild(span);
                            }
                        }
                    });
                    [].forEach.call(document.querySelectorAll('.dz-remove'), function(el) {
                        el.style.visibility = 'hidden';
                    });
                    document.getElementById('demo').innerHTML =
                            "<span class='bg-success rounded-pill p-2 pr-3 pl-3'>درخواست شما با موفقیت ثبت شد.</span>";
                });
                this.on("errormultiple", function(files, response) {
                    // Gets triggered when there was an error sending the files.
                    // Maybe show form again, and notify user of error
                    if (response.message) {
                        document.getElementById('demo').innerHTML =
                            "<span class='bg-danger rounded-pill p-1'>" + response.message + "</span>";
                    } else {
                        document.getElementById('demo').innerHTML =
                            "<span class='bg-danger rounded-pill p-2 pr-3 pl-3'>خطا</span>";
                    }
                    [].forEach.call(document.querySelectorAll('.dz-preview'), function(el) {
                        el.style.visibility = 'hidden';
                    });
                    console.log(response);
                });
            }

        }

        function verify_request(id) {
            $.ajax({
                type: 'POST',
                url: '{{ url('verifyrequest') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    requestid: id
                },
                success: function(data) {
                    $role = "{{ Auth::user()->hasRole('Supervisor') }}";
                    if ($role == 1) { //true           
                        document.getElementById('supervisornotverify' + id).innerHTML = '&#9989';
                        document.getElementById('verifydiv' + id).innerHTML =
                            '<button class="btn btn-primary rounded-pill pr-3 pl-3">تایید شد</button>';
                    } else {
                        if (data.permission) {
                            alert(data.permission);
                        } else {
                            document.getElementById('adminnotverify' + id).innerHTML = '&#9989';
                            document.getElementById('verifydiv' + id).innerHTML =
                            '<button class="btn btn-primary rounded-pill pr-3 pl-3">تایید شد</button>';
                        }
                    }
                },
                error: function(e) {
                    console.log(e);
                }
            });
        }
    </script>
</x-app-layout>
