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
                    <form action="{{ route('ticket-categories.update', $ticketCategory->id) }}" method="post" class="form-horizontal">
                        @csrf
                        @method('PUT')
                        <div class="card-header" style="height: 65px">
                            <strong>Edit Ticket Category</strong>
                            <a href="{{ route('ticket-categories.index') }}" class="btn btn-primary float-right">Category List</a>
                        </div>
                        <div class="card-body card-block">
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="name" class=" form-control-label">Category Name</label></div>
                                <div class="col-12 col-md-9"><input type="name" id="name" name="name" value="{{ old('name', $ticketCategory->name) }}" placeholder="Enter Category Name..." class="form-control">
                                    {{-- <span class="help-block">Please enter category name</span> --}}
                                    @error('name')
                                        <span class="help-block text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row form-group">
                                {{-- <div class="col col-md-3"><label class=" form-control-label">Checkboxes</label></div> --}}
                                <div class="col col-md-9 offset-md-3">
                                    <div class="form-check">
                                        <div class="checkbox">
                                            <label for="checkbox1" class="form-check-label ">
                                                <input type="checkbox" id="checkbox1" name="is_active" value="1" class="form-check-input" @if ($ticketCategory->is_active) checked @endif>Active
                                            </label>
                                        </div>
                                    </div>
                                </div>
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
