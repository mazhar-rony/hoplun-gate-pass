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
                    <li><a href="#">Building</a></li>
                    <li class="active">Edit Building</li>
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
                    <form action="{{ route('buildings.update', $building->id) }}" method="post" class="form-horizontal">
                        @csrf
                        @method('PUT')

                        <div class="card-header" style="height: 65px;">
                            <strong>Edit Building</strong>
                            <a href="{{ route('buildings.index') }}" class="btn btn-primary float-right">Building List</a>
                        </div>

                        <div class="card-body card-block">
                            <!-- Building Name Field -->
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="name" class=" form-control-label">Building Name</label></div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="name" name="name" value="{{ old('name', $building->name) }}" placeholder="Enter Building Name..." class="form-control">
                                    @error('name')
                                        <span class="help-block text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Active Status Checkbox -->
                            <div class="row form-group">
                                <div class="col col-md-3"><label class=" form-control-label">Status</label></div>
                                <div class="col col-md-9">
                                    <div class="form-check">
                                        <label for="checkbox1" class="form-check-label">
                                            <input type="checkbox" id="checkbox1" name="is_active" value="1" class="form-check-input" @if ($building->is_active) checked @endif> Active
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Footer with Submit and Reset Buttons -->
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
