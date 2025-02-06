@extends('admin.layouts.master')

@section('main_content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Edit Item</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">Table</a></li>
                    <li class="active">Edit Item</li>
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
                    <form action="{{ route('items.update', $item->id) }}" method="POST" class="form-horizontal">
                        @csrf
                        @method('PUT') <!-- Add this to specify it's an update request -->

                        <div class="card-header" style="height: 65px;">
                            <strong>Edit Item</strong>
                            <a href="{{ route('items.index') }}" class="btn btn-primary float-right">Item List </a>
                        </div>

                        <div class="card-body card-block">
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="name" class="form-control-label">Item Name</label></div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="name" name="name" value="{{ old('name', $item->name) }}" placeholder="Enter Item Name..." class="form-control">
                                    @error('name')
                                        <span class="help-block text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="category_id" class="form-control-label">Category</label></div>
                                <div class="col-12 col-md-9">
                                    <select name="category_id" id="category_id" class="form-control-sm form-control">
                                        <option value="0">Please select</option>
                                        @foreach ($ticketCategories as $category)
                                            <option value="{{ $category->id }}" {{ $item->ticket_category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="description" class="form-control-label">Description</label></div>
                                <div class="col-12 col-md-9">
                                    <textarea name="description" id="description" rows="4" placeholder="About the item..." class="form-control">{{ old('description', $item->description) }}</textarea>
                                    @error('description')
                                        <span class="help-block text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="uom" class="form-control-label">Unit of Measure</label></div>
                                <div class="col-12 col-md-9">
                                    <select name="uom" id="uom" class="form-control-sm form-control">
                                        <option value="0">Please select</option>
                                        @foreach ($unitOfMeasures as $unitOfMeasure)
                                            <option value="{{ $unitOfMeasure->value }}" {{ $item->uom == $unitOfMeasure->value ? 'selected' : '' }}>
                                                {{ $unitOfMeasure->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-9 offset-md-3">
                                    <div class="form-check">
                                        <div class="checkbox">
                                            <label for="checkbox1" class="form-check-label">
                                                <input type="checkbox" id="checkbox1" name="is_active" value="1" class="form-check-input" {{ $item->is_active ? 'checked' : '' }}> Active
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> Update
                            </button>
                            <button type="reset" class="btn btn-danger btn-sm">
                                <i class="fa fa-ban"></i> Reset
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
