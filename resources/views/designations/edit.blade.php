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
                    <form action="{{ route('designations.update', $designation->id) }}" method="post" class="form-horizontal">
                        @csrf
                        @method('PUT')
                        <div class="card-header" style="height: 65px;">
                            <strong>Edit Designation</strong>
                            <a href="{{ route('designations.index') }}" class="btn btn-primary float-right">Designation List</a>
                        </div>
                        <div class="card-body card-block">
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="name" class=" form-control-label">Designation Name</label></div>
                                <div class="col-12 col-md-9"><input type="name" id="name" name="name" value="{{ old('name', $designation->name) }}" placeholder="Enter Designation Name..." class="form-control">
                                    @error('name')
                                        <span class="help-block text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-9 offset-md-3">
                                    <div class="form-check">
                                        <div class="checkbox">
                                            <label for="checkbox1" class="form-check-label ">
                                                <input type="checkbox" id="checkbox1" name="is_active" value="1" class="form-check-input" @if ($designation->is_active) checked @endif>Active
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
