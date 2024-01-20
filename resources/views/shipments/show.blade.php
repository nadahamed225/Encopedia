@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card mx-auto" style="width: 20rem;">
            <img class="w-50 h-50 m-auto mt-2" src="{{asset('images/shipments/'.$shipment->image)}}" class="card-img-top" >
            <div class="card-body">
                <h5 class="card-title"><b>Code:</b> {{$shipment->code}}</h5>
                <p class="card-text"><b>Shipper:</b> {{$shipment->shipper}}</p>
                <p class="card-text"><b>Weight:</b> {{$shipment->weight}}</p>
                <p class="card-text"><b>Description:</b> {{$shipment->description}}</p>
                <p class="card-text"><b>Price:</b> {{$shipment->price}}</p>
                <select class="form-select" name="status" onchange="setStatus()" id="status" >
                    <option hidden {{ $shipment->status == 'Done' ? 'selected' : '' }}>{{ $shipment->status }}</option>
                    <option value="Pending" {{ $shipment->status == 'Done' ? 'disabled' : '' }}>Pending</option>
                    <option value="Progress" {{ $shipment->status == 'Done' ? 'disabled' : '' }}>Progress</option>
                    <option value="Done" {{ $shipment->status == 'Done' ? 'disabled' : '' }} >Done</option>
                </select>
                <p class="card-text"></p>
                <p class="card-text"><b>Updated By:</b> {{$shipment->updated_by}}</p>
                <p class="card-text"><b>Created At:</b> {{$shipment->created_at}}</p>
                <p class="card-text"><b>Updated At:</b> {{$shipment->updated_at}}</p>
            </div>
        </div>
    </div>
@endsection
<script>
    function setStatus() {
        const status = document.getElementById('status').value;
        const id= {{$shipment->id}};
        fetch(`/shimpents/setStatus/${id}/${status}`)
            .then(response => response.json())
            .then(data => {
                location.reload();
            })
            .catch(error => console.error('Error:', error));
    }
</script>
