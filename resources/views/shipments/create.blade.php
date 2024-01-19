@extends('layouts.app')

@section('content')
    <div>
        <form class=" w-50 m-auto mt-5 " method="POST" action="{{route('shipments.store')}}"
              enctype="multipart/form-data">
            @method('post')
            @csrf

            <div class="row">
                <div class="col-6">
                    <label for="code" class="form-label fs-4">Code</label>
                    <input type="text" name="code" class="form-control" id="code">
                </div>
                <div class="col-6">
                    <label for="shipper" class="form-label fs-4">Shipper</label>
                    <input type="text" name="shipper" class="form-control" id="shipper">
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="weight" class="form-label fs-4">Weight</label>
                    <input type="number" name="weight" onchange="getPrice()" class="form-control" id="weight">
                </div>
                <div class="col-6">
                    <label for="price" class="form-label fs-4">Price</label>
                    <input type="number" name="price" class="form-control" id="price" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="status" class="form-label fs-4">Status</label>
                    <select class="form-select" name="status">
                        <option selected>select status</option>
                        <option value="Pending">Pending</option>
                        <option value="Progress">Progress</option>
                        <option value="Done">Done</option>
                    </select>
                </div>
                <div class="col-6">
                    <label for="updated_by" class="form-label fs-4">Updated By</label>
                    <input type="text" name="updated_by" class="form-control" id="updated_by">
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="image" class="form-label fs-4">Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>
            </div>
            <div class="row">
                <label for="description" class="form-label fs-4">Description</label>
                <textarea type="text" name="description" class="form-control" id="description"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

@endsection
<script>
    function getPrice() {
        const weight = document.getElementById('weight');
        let price = document.getElementById('price');
        fetch(`/shimpents/getprice/${weight.value}`)
            .then(response => response.json())
            .then(data => {
                price.value = data;
            })
            .catch(error => console.error('Error:', error));
    }
</script>
