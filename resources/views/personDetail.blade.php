@extends('master')
@section('title','Saved Properties')
@section('content')
<div class="card">
    <div class="card-header">
        <h4>Detail information</h4>
    </div>
    <div class="card-body">
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
                            <th>
                                Gender
                            </th>
                        </tr>
                    </thead>
                    <tbody id="NameTableBody">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>







    <script>
        const personDetail = {!! json_encode($persondetail) !!};

        $('#NameTableBody').append personDetail.name.map((name)=>{
            return "<tr>"+"<td>"+name.data+"</td>"+"<td>"+ name.gen +"</td></th>";
        }));
        console.log( a );

    </script>

@endsection