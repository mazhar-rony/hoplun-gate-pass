@extends('admin.layouts.master')

@section('main_content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Dashboard</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">Table</a></li>
                    <li class="active">Data table</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row d-flex align-items-center justify-content-center mt-5">
            <div class="col-lg-12">
                <div class="card">
                    {{-- <form action="#" method="post" class="form-horizontal"> --}}
                        @csrf
                        <div class="card-header" style="height: 65px;">
                            <strong>Create Ticket</strong>
                            {{-- <a href="{{ route('items.index') }}" class="btn btn-primary float-right">Item List </a> --}}
                        </div>
                        <div class="card-body card-block">
                            <h6 class="mb-4">EMPLOYEE INFORMATION</h6>
                            <div class="row form-group">
                                {{-- <div class="col col-md-2"><label for="name" class=" form-control-label">Item Name</label></div>
                                <div class="col-12 col-md-2"><input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Enter Item Name..." class="form-control">
                                    @error('name')
                                        <span class="help-block text-danger">{{ $message }}</span>
                                    @enderror
                                </div> --}}
                                <div class="col-md-4"> Name: <strong>{{ $user->name }}</strong></div>
                                <div class="col-md-4"> Position: <strong>{{ $user->designation->name }}</strong></div>
                                <div class="col-md-4"> Factory: <strong>{{ $user->building->name }}</strong></div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-4"> Department: <strong>{{ $user->department->name }}</strong></div>
                                <div class="col-md-4"> Manager: <strong>{{ $user->manager->name }}</strong></div>
                                <div class="col-md-4"> Employee ID: <strong>{{ $user->id }}</strong></div>
                            </div>
                        </div>
                        <div class="card-body card-block">
                            <h6 class="mb-4">ITEM DETAILS</h6>

                            <div class="row form-group">
                                <div class="col col-md-2"><label for="item" class=" form-control-label">Select Product</label></div>
                                <div class="col-12 col-md-8">
                                    <select name="item" id="item" class="form-control-sm form-control">
                                        <option value="">Please select</option>
                                    </select>
                                </div>
                                <div class="col col-md-2"><button id="addItem" class="btn btn-primary">Add Item</button></div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong class="card-title">Added Items</strong>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped" id="cartTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Item Code</th>
                                                    <th scope="col">Item Name</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            {{-- <label for="product">Select Product:</label>
                                <select id="product">
                                    <option value="">Select Product</option>
                                </select>
                                <button id="addItem">Add Item</button> --}}

                                {{-- <h3>Cart</h3> --}}
                                {{-- <table border="1" id="cartTable">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3"><strong>Grand Total:</strong></td>
                                            <td id="grandTotal">$0.00</td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table> --}}
                        </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> Submit
                            </button>
                            <button type="reset" class="btn btn-danger btn-sm">
                                <i class="fa fa-ban"></i> Reset
                            </button>
                        </div>
                    {{-- </form> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function() {

        var rowNumber = 1;
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });

            // Fetch products and populate dropdown
            $.ajax({
                url: "{{ route('getItems') }}",
                type: "GET",
                success: function(response) {
                    $.each(response, function(index, item) {

                        $('#item').append('<option value="'+item.id+'">'+item.name+'</option>');
                    });
                }
            });

            // function updateGrandTotal() {
            //     let total = 0;
            //     $('#cartTable tbody tr').each(function() {
            //         let itemTotal = parseFloat($(this).find('td:nth-child(4)').text().replace('$', ''));
            //         total += itemTotal;
            //     });
            //     $('#grandTotal').text('$' + total.toFixed(2));
            // }

            $('#addItem').click(function() {
                var productId = $('#item').val();
                if (productId === "") {
                    alert("Please select a product");
                    return;
                }

                if ($('#row-' + productId).length) {
                    alert("Item already in cart. Increase quantity instead.");
                    return;
                }

                $.ajax({
                    url: "{{ route('addItem') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        product_id: productId
                    },
                    success: function(response) {

                        $('#cartTable tbody').append(
                            `<tr id="row-${response.id}">
                                <td>${rowNumber++}</td>
                                <td>${response.item_code}</td>
                                <td>${response.name}</td>
                                <td>
                                    <button class="decrease" data-id="${response.id}">-</button>
                                    <span id="qty-${response.id}">1</span>
                                    <button class="increase" data-id="${response.id}">+</button>
                                </td>
                                <td>
                                    <button class="remove" data-id="${response.id}">Remove</button>
                                </td>
                            </tr>`
                        );
                        // updateGrandTotal();
                    }
                });
            });

            $(document).on('click', '.increase', function() {
                var id = $(this).data('id');
                var qty = parseInt($('#qty-' + id).text()) + 1;
                var price = parseFloat($('#row-' + id).find('td:nth-child(2)').text().replace('$', ''));
                $('#qty-' + id).text(qty);
                $('#total-' + id).text('$' + (qty * price).toFixed(2));
                updateGrandTotal();
            });

            $(document).on('click', '.decrease', function() {
                var id = $(this).data('id');
                var qty = parseInt($('#qty-' + id).text());
                if (qty > 1) {
                    qty -= 1;
                    var price = parseFloat($('#row-' + id).find('td:nth-child(2)').text().replace('$', ''));
                    $('#qty-' + id).text(qty);
                    $('#total-' + id).text('$' + (qty * price).toFixed(2));
                    updateGrandTotal();
                }
            });

            $(document).on('click', '.remove', function() {
                var id = $(this).data('id');
                $('#row-' + id).remove();
                updateGrandTotal();
            });
        });
</script>
@endpush
