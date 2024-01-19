@extends('welcome')
@section('content')
    <div class="container">
        <div class="card" style="width: 18rem;">
            <img src="{{asset('images/shipments/'.$shipment->image)}}" class="card-img-top" >
            <div class="card-body">
                <h5 class="card-title">{{$shipment->code}} Info</h5>
                <p class="card-text">{{$shipment->shipper}}</p>
                <p class="card-text">{{$shipment->weight}}</p>
                <p class="card-text">{{$shipment->description}}</p>
                <p class="card-text">{{$shipment->price}}</p>
                <select class="form-select" name="status" onchange="setStatus()" id="status" >
                    <option hidden {{ $shipment->status == 'Done' ? 'selected' : '' }}>{{ $shipment->status }}</option>
                    <option value="Pending" {{ $shipment->status == 'Done' ? 'disabled' : '' }}>Pending</option>
                    <option value="Progress" {{ $shipment->status == 'Done' ? 'disabled' : '' }}>Progress</option>
                    <option value="Done" {{ $shipment->status == 'Done' ? 'disabled' : '' }} >Done</option>
                </select>
                <p class="card-text"></p>
                <p class="card-text">{{$shipment->updated_by}}</p>
                <p class="card-text">{{$shipment->created_at}}</p>
                <p class="card-text">{{$shipment->updated_at}}</p>
                <a href="{{route("shipments.index")}}" class="btn btn-primary">Back To All Shipments</a>
            </div>
        </div>
    </div>
@endsection
<script>
    function setStatus() {
        const status = document.getElementById('status').value;
        const id= {{$shipment->id}};
        if (status == 'Done') {
            fetch(`/shimpents/setStatus/${id}`)
                .then(response => response.json())
                .then(data => {
                    location.reload();
                })
                .catch(error => console.error('Error:', error));
        }
    }
</script>
