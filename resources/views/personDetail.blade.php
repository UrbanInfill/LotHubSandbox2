@extends('master')
@section('title','Saved Properties')
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Detail information</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            Names list
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>
                                        Full Name
                                    </th>
                                </tr>
                                </thead>
                                <tbody id="NameTableBody">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    DOB list
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>
                                                Date
                                            </th>
                                            <th>
                                                Age
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody id="dobTableBody">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    Phone Number list
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>
                                                Type
                                            </th>
                                            <th>
                                                Number
                                            </th>
                                            <th>
                                                Provider
                                            </th>
                                            <th>
                                                Business
                                            </th>

                                        </tr>
                                        </thead>
                                        <tbody id="PhoneTableBody">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>









@endsection

@section('script')
    <script>
        const personDetail = {!! json_encode($persondetail) !!};
        const nameList = personDetail.name.map((names)=>{
            return "<tr>"+"<td>"+names.data+"</td>"+"</th>";
        });
        const dobList = personDetail.dob.map((item)=>{
            return "<tr>"+"<td>"+item.date.data+"</td>"+"<td>"+item.age+"</td>"+"</th>";
        });
        const phoneList = personDetail.phone.map((item)=>{
            return "<tr>"+"<td>"+item.type+"</td>"+"<td>"+item.number+"</td>"+"<td>"+item.providerName+"</td>"+"<td>"+item.business+"</td>"+"</th>";
        });

        $('#NameTableBody').append(nameList);
        $('#dobTableBody').append(dobList);
        $('#PhoneTableBody').append(phoneList);
        console.log( personDetail );

    </script>
@endsection