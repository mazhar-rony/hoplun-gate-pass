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
                            <li class="active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">

            <div class="col-lg-3 col-md-6">
                <a href="{{ route('tickets.create') }}" class="social-box facebook">
                    <i>Create Ticket</i>
                </a>
            </div>
        </div>
@endsection
