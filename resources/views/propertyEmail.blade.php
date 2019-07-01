@extends('master')
@section('title','Mail Sender')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="card" >
                        <div class="card-body">
                            <h5 class="card-title">Template 1</h5>
                            <p class="card-text">{{substr($template_a, 0, 150) }}</p>
                            <a href=" /propertymail/{{$fullname}}/{{$fulladdress}}" class="card-link">Use this template</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Template 2</h5>
                            <p class="card-text">{{substr($template_b, 0, 150) }}</p>
                            <a href="/propertymail/{{$fullname}}/{{$fulladdress}}/1" class="card-link">Use this template</a>
                        </div>
                    </div>

                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4>Email template</h4>
        </div>
        <div class="card-body">
            <textarea class="form-control" style="min-width: 100%" name="emailContent"  id="mailContent"  rows="20">{{$data}}</textarea>
        </div>
        <div class="card-footer">

            <div class="input-group mb-3">
                <input type="email" class="form-control" placeholder="Enter Email address" aria-label="Email address" aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button  class="btn btn-secondary" id="SendMail" style="float: right; margin-right: 10px">Send email</button>
                </div>
            </div>
            <button onclick="printTextArea()" class="btn btn-secondary" id="SendMail" style="float: right" >Print Text</button>
        </div>
    </div>

@endsection

@section('script')
    <script>

        function printTextArea() {
            childWindow = window.open('','childWindow','location=yes, menubar=yes, toolbar=yes');
            childWindow.document.open();
            childWindow.document.write('<html><head></head><body>');
            childWindow.document.write(document.getElementById('mailContent').value.replace(/\n/gi,'<br>'));
            childWindow.document.write('</body></html>');
            childWindow.print();
            childWindow.document.close();
            childWindow.close();
        }

        $('#SendMail').click(function () {

            const content = $('#mailContent').text();
            console.log(content);
            fetch("/propertymail", {
                method: "post", // *GET, POST, PUT, DELETE, etc.
                mode: "cors", // no-cors, cors, *same-origin
                cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
                credentials: "same-origin", // include, *same-origin, omit
                body: JSON.stringify({content:content}),
                headers: {
                    "Content-Type": "application/json",
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    // "Content-Type": "application/x-www-form-urlencoded",
                },
                redirect: "follow", // manual, *follow, error
                referrer: "no-referrer", // no-referrer, *client
            })
                .then(function(response) {
                    if (response.status >= 200 && response.status < 300) {
                        return response.json()
                    }
                    throw new Error(response.statusText)
                })
        })
    </script>
@endsection
