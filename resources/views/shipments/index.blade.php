@extends('welcome')

@section('content')
    <a href="{{route("shipments.create")}}" class="btn btn-info">Add Shipment</a>
    <table class="table table-striped w-50 m-auto table-bordered text-center mt-5">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Code</th>
            <th scope="col">Shipper</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($shipments as $shipment)
            <tr>
            <th scope="row">{{$shipment["id"]}}</th>
            <td>{{$shipment["code"]}}</td>
            <td>{{$shipment["shipper"]}}</td>
            <td><a href="{{route("shipments.show",$shipment->id)}}" class="btn btn-info">Show</a></td>
           </tr>
        @endforeach
        </tbody>
    </table>
@endsection
