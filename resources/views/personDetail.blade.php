@extends('master')
@section('title','Saved Properties')
@section('content')

    <script>
        let a = {!! json_encode($persondetail) !!};

        console.log( a );

    </script>

@endsection