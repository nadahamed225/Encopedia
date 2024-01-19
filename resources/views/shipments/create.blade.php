@extends('welcome')
@section('content')
    <div>
        <form  class=" w-50 m-auto mt-5 " method="POST" action="{{route('shipments.store')}}" enctype="multipart/form-data">
            @method('post')
            @csrf

            <div class="mb-3">
                <label for="code" class="form-label fs-4">Code</label>
                <input type="text" name="code" class="form-control" id="code">

                <label for="shipper" class="form-label fs-4">Shipper</label>
                <input type="text" name="shipper" class="form-control" id="shipper">

                <label for="weight" class="form-label fs-4">Weight</label>
                <input type="number" name="weight" onchange="getPrice()" class="form-control" id="weight">

                <label for="description" class="form-label fs-4">Description</label>
                <input type="text" name="description" class="form-control" id="description">

                <label for="price" class="form-label fs-4">Price</label>
                <input type="number" name="price" class="form-control" id="price" readonly>

                <select class="form-select" name="status">
                    <option selected>select status</option>
                    <option value="Pending">Pending</option>
                    <option value="Progress">Progress</option>
                    <option value="Done">Done</option>
                </select>

                <label for="updated_by" class="form-label fs-4">updated_by</label>
                <input type="text" name="updated_by" class="form-control" id="updated_by">

                <label for="image" class="form-label fs-4">Image</label>
                <input type="file" name="image" class="form-control" id="image" >

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
