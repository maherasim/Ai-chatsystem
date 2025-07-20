<?php $page = 'ui-text-editor'; ?>
@extends('layout.mainlayout_admin')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper cardhead">
    <div class="content ">

        <!-- Page Header -->
        <div class="page-header">
            @component('admin.components.breadcrumb_admin')
            @slot('title')
          Text Editor
            @endslot
        @endcomponent
        </div>
        <!-- /Page Header -->

        <div class="row">

            <!-- Editor -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Editor</h5>
                    </div>
                    <div class="card-body">
                        <div id="summernote"></div>
                    </div>
                </div>
            </div>
            <!-- /Editor -->

        </div>
    </div>
</div>
<!-- Page Wrapper -->

@component('admin.components.themesettings')
@endcomponent
@endsection
