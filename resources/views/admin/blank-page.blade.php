<?php $page = 'blank-page'; ?>
@extends('layout.mainlayout_admin')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper profile-set-wrapper">
			
    <div class="content container-fluid profile-set-content">
        <div class="page-header">
            <div class="page-title">
                <h4>Blank Page</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                Contents here
            </div>			
        </div>
    </div>			
</div>
<!-- /Page Wrapper -->

@component('admin.components.themesettings')
@endcomponent
@endsection