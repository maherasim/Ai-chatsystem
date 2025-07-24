@if(Route::is(['all-calls']))
<!-- Add Call -->
<div class="modal fade" id="new-call">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Call</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('all-calls')}}">
                    <div class="search-wrap contact-search mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search">
                            <a href="javascript:void(0);" class="input-group-text"><i class="ti ti-search"></i></a>
                        </div>
                    </div>
                    <h6 class="mb-3 fw-medium fs-16">Contacts</h6>
                    <div class="contact-scroll contact-select mb-3">
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Edward Lietz</h6>
                                    <p>App Developer</p>
                                </div>
                            </div>
                            <div class="d-inline-flex">
                                <a href="" class="model-icon bg-light d-flex justify-content-center align-items-center rounded-circle me-2" data-bs-toggle="modal" data-bs-target="#voice_call"><span><i class="ti ti-phone"></i></span></a>
                                <a href="" class="model-icon bg-light d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="modal" data-bs-target="#video-call"><span><i class="ti ti-video"></i></span></a>
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Sarika Jain</h6>
                                    <p>UI/UX Designer</p>
                                </div>
                            </div>
                            <div class="d-inline-flex">
                                <a href="" class="model-icon bg-light d-flex justify-content-center align-items-center rounded-circle me-2" data-bs-toggle="modal" data-bs-target="#voice_call"><span><i class="ti ti-phone"></i></span></a>
                                <a href="" class="model-icon bg-light d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="modal" data-bs-target="#video-call"><span><i class="ti ti-video"></i></span></a>
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Clyde Smith</h6>
                                    <p>Web Developer</p>
                                </div>
                            </div>
                            <div class="d-inline-flex">
                                <a href="" class="model-icon bg-light d-flex justify-content-center align-items-center rounded-circle me-2" data-bs-toggle="modal" data-bs-target="#voice_call"><span><i class="ti ti-phone"></i></span></a>
                                <a href="" class="model-icon bg-light d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="modal" data-bs-target="#video-call"><span><i class="ti ti-video"></i></span></a>
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Carla Jenkins</h6>
                                    <p>Business Analyst</p>
                                </div>
                            </div>
                            <div class="d-inline-flex">
                                <a href="" class="model-icon bg-light d-flex justify-content-center align-items-center rounded-circle me-2" data-bs-toggle="modal" data-bs-target="#voice_call"><span><i class="ti ti-phone"></i></span></a>
                                <a href="" class="model-icon bg-light d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="modal" data-bs-target="#video-call"><span><i class="ti ti-video"></i></span></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add Call -->

<!-- Block User -->
<div class="modal fade" id="block-user">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Block User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('all-calls')}}">
                    <div class="block-wrap text-center mb-3">
                        <span class="user-icon mb-3 mx-auto bg-transparent-info">
                            <i class="ti ti-user-off text-info"></i>
                        </span>
                        <p class="text-grya-9">Blocked contacts will no longer be able to call you or send you messages.</p>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Block</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Block User -->

<!-- Voice Call -->
<div class="modal fade" id="voice_call">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header justify-content-center border-0">
                <span class="model-icon bg-primary d-flex justify-content-center align-items-center rounded-circle me-2">
                    <i class="ti ti-phone-call"></i>
                </span>
                <h4 class="modal-title">Audio Calling...</h4>
            </div>
            <div class="modal-body pb-0">
                <div class="card bg-light mb-0">
                    <div class="card-body d-flex justify-content-center">
                        <div>
                            <span class="avatar avatar-xxl">
                                <img src="{{ URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="user">
                            </span>
                            <h6 class="fs-14">Edward Lietz</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0">
                <a href="" class="voice-icon btn btn-success rounded-circle d-flex justify-content-center align-items-center me-2" data-bs-toggle="modal" data-bs-target="#voice_attend">
                    <i class="ti ti-phone fs-20"></i>
                </a>
                <a href="javascript:void(0);" data-bs-dismiss="modal" aria-label="close" class="voice-icon btn btn-danger rounded-circle d-flex justify-content-center align-items-center">
                    <i class="ti ti-phone-off fs-20"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- /Voice Call -->

<!--Group Voice Call -->
<div class="modal fade" id="group_voice">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header justify-content-center border-0">
                <span class="model-icon bg-primary d-flex justify-content-center align-items-center rounded-circle me-2">
                    <i class="ti ti-phone-call"></i>
                </span>
                <h4 class="modal-title">Audio Calling...</h4>
            </div>
            <div class="modal-body pb-0">
                <div class="card bg-light mb-0">
                    <div class="card-body d-flex justify-content-center">
                        <div>
                            <div class="d-flex justify-content-center avatar-group mb-2">
                                <a href="#" class=" ">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="user">
                                </a>
                                <a href="#" class="">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="user">
                                </a>
                                <a href="#" class="">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-05.jpg')}}" class="rounded-circle" alt="user">
                                </a>
                                <a href="#" class="">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="user">
                                </a>
                            </div>
                            <h6 class="fs-14">Edward Lietz, Aariyan Jose, Federico Wells, +1</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0">
                <a href="" class="voice-icon btn btn-success rounded-circle d-flex justify-content-center align-items-center me-2" data-bs-toggle="modal" data-bs-target="#voice_attend">
                    <i class="ti ti-phone fs-20"></i>
                </a>
                <a href="javascript:void(0);" data-bs-dismiss="modal" class="voice-icon btn btn-danger rounded-circle d-flex justify-content-center align-items-center">
                    <i class="ti ti-phone-off fs-20"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- /Group Voice Call -->

<!-- Voice Call attend -->
<div class="modal voice-call fade" id="voice_attend">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex border-0 pb-0">
                <div class="card bg-transparent-dark flex-fill border mb-3">
                    <div class="card-body d-flex justify-content-between p-3 flex-wrap row-gap-3">
                        <div class="d-flex align-items-center">
                            <span class="avatar avatar-lg online me-2">
                                <img src="{{ URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="user">
                            </span>
                            <div>
                                <h6>Edward Lietz</h6>
                                <span>+22-555-345-11</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="badge border border-primary  text-primary badge-sm me-2">
                                <i class="ti ti-point-filled"></i>
                                01:15:25
                            </span>
                            <a href="" class="user-add bg-primary rounded d-flex justify-content-center align-items-center text-white" data-bs-toggle="modal" data-bs-target="#voice_group">
                                <i class="ti ti-user-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body border-0 pt-0">
                <div class="card audio-crd bg-transparent-dark border">
                    <div class="modal-bgimg">
                        <span class="modal-bg1">
                            <img src="{{ URL::asset('/build/img/bg/bg-02.png')}}" class="img-fluid" alt="bg">
                        </span>
                        <span class="modal-bg2">
                            <img src="{{ URL::asset('/build/img/bg/bg-03.png')}}" class="img-fluid" alt="bg">
                        </span>
                    </div>
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-center align-items-center pt-5">
                            <span class="avatar avatar-xxxl bg-soft-primary rounded-circle p-2">
                                <img src="{{ URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="user">
                            </span>

                        </div>
                        <div class="d-flex align-items-end justify-content-end">
                            <span class="call-span border border-2 border-primary d-flex justify-content-center align-items-center rounded">
                                <span class="avatar avatar-xl bg-soft-primary rounded-circle p-2">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-17.jpg')}}" class="rounded-circle" alt="user">
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0 pt-0">
                <div class="call-controll-block d-flex align-items-center justify-content-center rounded-pill">
                    <a href="javascript:void(0);" class="call-controll mute-bt d-flex align-items-center justify-content-center">
                        <i class="ti ti-microphone"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-volume"></i>
                    </a>
                    <a href="javascript:void(0);" data-bs-dismiss="modal" class="call-controll call-decline d-flex align-items-center justify-content-center">
                        <i class="ti ti-phone"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-maximize"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-dots"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Voice Call attend -->

<!-- Voice Call group -->
<div class="modal fade" id="voice_group" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex border-0 pb-0">
                <div class="card bg-transparent-dark flex-fill border mb-3">
                    <div class="card-body d-flex justify-content-between p-3">
                        <div class="row justify-content-between flex-fill row-gap-3">
                            <div class="col-lg-5">
                                <div class="d-flex justify-content-between align-items-center flex-wrap row-gap-2">
                                    <h3>Weekly Report Call</h3>

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="d-flex justify-content-start align-items-center">
                                    <span class="badge border border-primary  text-primary badge-sm me-3">
                                        <i class="ti ti-point-filled"></i>
                                        01:15:25
                                    </span>
                                    <a href="javascript:void(0);" data-bs-toggle="modal" class="badge badge-danger badge-sm">Leave</a>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex">
                                        <span class="user-add bg-primary d-flex justify-content-center align-items-center rounded-circle me-2">
                                            6
                                        </span>
                                        <a href="javascript:void(0);" class="user-add bg-primary rounded d-flex justify-content-center align-items-center text-white">
                                            <i class="ti ti-user-plus"></i>
                                        </a>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="layout-tab d-flex justify-content-center ">
                                            <div class="nav nav-pills inner-tab " id="pills-tab2" role="tablist">
                                                <div class="nav-item me-0" role="presentation">
                                                    <a href="#" class="nav-link bg-white text-gray p-0 fs-16 me-2" id="pills-single1-tab" data-bs-toggle="pill"
                                                        data-bs-target="#pills-single1" role="tab" aria-controls="pills-single1"
                                                        aria-selected="false" tabindex="-1">
                                                        <i class="ti ti-square"></i>
                                                    </a>
                                                </div>
                                                <div class="nav-item" role="presentation">
                                                    <a href="#" class="nav-link active bg-white text-gray p-0 fs-16" id="pills-group1-tab" data-bs-toggle="pill"
                                                        data-bs-target="#pills-group1" role="tab" aria-controls="pills-group1"
                                                        aria-selected="false" tabindex="-1">
                                                        <i class="ti ti-layout-grid"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body border-0 pt-0">
                <div class="tab-content dashboard-tab">
                    <div class="tab-pane fade" id="pills-single1" role="tabpanel" aria-labelledby="pills-single1-tab">
                        <div class="card audio-crd bg-transparent-dark border">
                            <div class="modal-bgimg">
                                <span class="modal-bg1">
                                    <img src="{{ URL::asset('/build/img/bg/bg-02.png')}}" class="img-fluid" alt="bg">
                                </span>
                                <span class="modal-bg2">
                                    <img src="{{ URL::asset('/build/img/bg/bg-03.png')}}" class="img-fluid" alt="bg">
                                </span>
                            </div>
                            <div class="card-body p-3">
                                <div class="single-img d-flex justify-content-center align-items-center">
                                    <span class=" avatar avatar-xxxl bg-soft-primary rounded-circle p-2">
                                        <img src="{{ URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="user">
                                    </span>
                                </div>
                                <div class="d-flex align-items-end justify-content-end">
                                    <span class="call-span border border-2 border-primary d-flex justify-content-center align-items-center rounded">
                                        <span class="avatar avatar-xxl bg-soft-primary rounded-circle p-2">
                                            <img src="{{ URL::asset('/build/img/profiles/avatar-17.jpg')}}" class="rounded-circle" alt="user">
                                        </span>
                                    </span>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="tab-pane fade active show" id="pills-group1" role="tabpanel" aria-labelledby="pills-group1-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card audio-crd bg-transparent-dark border border-primary pt-4">
                                    <div class="modal-bgimg">
                                        <span class="modal-bg1">
                                            <img src="{{ URL::asset('/build/img/bg/bg-02.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                        <span class="modal-bg2">
                                            <img src="{{ URL::asset('/build/img/bg/bg-03.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                    </div>
                                    <div class="card-body ">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <span class="avatar avatar-xxxl bg-soft-primary rounded-circle p-2">
                                                <img src="{{ URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="user">
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-end">
                                            <span class="badge badge-info">Edwin</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card audio-crd bg-transparent-dark border pt-4">
                                    <div class="modal-bgimg">
                                        <span class="modal-bg1">
                                            <img src="{{ URL::asset('/build/img/bg/bg-02.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                        <span class="modal-bg2">
                                            <img src="{{ URL::asset('/build/img/bg/bg-03.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                    </div>
                                    <div class="card-body ">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <span class="avatar avatar-xxxl bg-soft-primary rounded-circle p-2">
                                                <img src="{{ URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="user">
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-end">
                                            <span class="badge badge-info">Edwin</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card audio-crd bg-transparent-dark border pt-4">
                                    <div class="modal-bgimg">
                                        <span class="modal-bg1">
                                            <img src="{{ URL::asset('/build/img/bg/bg-02.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                        <span class="modal-bg2">
                                            <img src="{{ URL::asset('/build/img/bg/bg-03.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                    </div>
                                    <div class="card-body ">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <span class="avatar avatar-xxxl bg-soft-primary rounded-circle p-2">
                                                <img src="{{ URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="user">
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-end">
                                            <span class="badge badge-info">Edwin</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card audio-crd bg-transparent-dark border pt-4">
                                    <div class="modal-bgimg">
                                        <span class="modal-bg1">
                                            <img src="{{ URL::asset('/build/img/bg/bg-02.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                        <span class="modal-bg2">
                                            <img src="{{ URL::asset('/build/img/bg/bg-03.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                    </div>
                                    <div class="card-body ">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <span class="avatar avatar-xxxl bg-soft-primary rounded-circle p-2">
                                                <img src="{{ URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="user">
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-end">
                                            <span class="badge badge-info">Edwin</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card audio-crd bg-transparent-dark border pt-4">
                                    <div class="modal-bgimg">
                                        <span class="modal-bg1">
                                            <img src="{{ URL::asset('/build/img/bg/bg-02.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                        <span class="modal-bg2">
                                            <img src="{{ URL::asset('/build/img/bg/bg-03.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <span class="avatar avatar-xxxl bg-soft-primary rounded-circle p-2">
                                                <img src="{{ URL::asset('/build/img/profiles/avatar-05.jpg')}}" class="rounded-circle" alt="user">
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-end">
                                            <span class="badge badge-info">Edwin</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0 pt-0">
                <div class="call-controll-block d-flex align-items-center justify-content-center rounded-pill">
                    <a href="javascript:void(0);" class="call-controll mute-bt d-flex align-items-center justify-content-center">
                        <i class="ti ti-microphone"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-volume"></i>
                    </a>
                    <a href="javascript:void(0);" data-bs-dismiss="modal" class="call-controll call-decline d-flex align-items-center justify-content-center">
                        <i class="ti ti-phone"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-maximize"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-dots"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Voice Call group -->

<!-- Video Call -->
<div class="modal fade" id="video-call">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header justify-content-center border-0">
                <span class="model-icon bg-primary d-flex justify-content-center align-items-center rounded-circle me-2">
                    <i class="ti ti-video"></i>
                </span>
                <h4 class="modal-title">Video Calling...</h4>
            </div>
            <div class="modal-body pb-0">
                <div class="card bg-light mb-0">
                    <div class="card-body d-flex justify-content-center">
                        <div>
                            <span class="avatar avatar-xxl">
                                <img src="{{ URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="user">
                            </span>
                            <h6 class="fs-14">Edward Lietz</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0">
                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#start-video-call" class="voice-icon btn btn-success rounded-circle d-flex justify-content-center align-items-center me-2">
                    <i class="ti ti-phone fs-20"></i>
                </a>
                <a href="" class="voice-icon btn btn-danger rounded-circle d-flex justify-content-center align-items-center" data-bs-dismiss="modal" aria-label="close">
                    <i class="ti ti-phone-off fs-20"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- /Video Call -->
<div class="modal fade" id="start-video-call">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex border-0 pb-0">
                <div class="card bg-transparent-dark flex-fill border">
                    <div class="card-body d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <span class="avatar avatar-lg online me-2">
                                <img src="{{ URL::asset('/build/img/profiles/avatar-05.jpg')}}" class="rounded-circle" alt="user">
                            </span>
                            <div>
                                <h6>Federico Wells</h6>
                                <span>+22-555-345-11</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="badge border border-primary  text-primary badge-sm me-2">
                                <i class="ti ti-point-filled"></i>
                                01:15:25
                            </span>
                            <a href="javascript:void(0);" class="user-add bg-primary rounded d-flex justify-content-center align-items-center text-white" data-bs-toggle="modal" data-bs-target="#video_group">
                                <i class="ti ti-user-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body border-0 pt-0">
                <div class="video-call-view br-8 overflow-hidden position-relative">
                    <img src="{{ URL::asset('/build/img/video/video-member-01.jpg')}}" alt="user-image">
                    <div class="mini-video-view active br-8 overflow-hidden position-absolute">
                        <img src="{{ URL::asset('/build/img/video/user-image.jpg')}}" alt="">
                        <div class="bg-soft-primary mx-auto default-profile rounded-circle align-items-center justify-content-center">
                            <span class="avatar  avatar-lg rounded-circle bg-primary ">RG</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0 pt-0">
                <div class="call-controll-block d-flex align-items-center justify-content-center rounded-pill">
                    <a href="javascript:void(0);" class="call-controll mute-bt d-flex align-items-center justify-content-center">
                        <i class="ti ti-microphone"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-volume"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll mute-video d-flex align-items-center justify-content-center">
                        <i class="ti ti-video"></i>
                    </a>
                    <a href="javascript:void(0);" data-bs-dismiss="modal" class="call-controll call-decline d-flex align-items-center justify-content-center">
                        <i class="ti ti-phone"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-mood-smile"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-maximize"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-dots"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Video Call group -->
<div class="modal fade" id="video_group" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header d-flex border-0 pb-0">
                <div class="card bg-transparent-dark flex-fill border mb-3">
                    <div class="card-body d-flex justify-content-between p-3">
                        <div class="row justify-content-between flex-fill row-gap-3">
                            <div class="col-lg-5 col-sm-12">
                                <div class="d-flex justify-content-between align-items-center row-gap-2">
                                    <h3>Weekly Report Call</h3>

                                </div>
                            </div>
                            <div class="col-lg-5 col-sm-12">
                                <div class="d-flex justify-content-start align-items-center">
                                    <span class="badge border border-primary  text-primary badge-sm me-3">
                                        <i class="ti ti-point-filled"></i>
                                        01:15:25
                                    </span>
                                    <a href="javascript:void(0);" data-bs-toggle="modal" class="badge badge-danger badge-sm">Leave</a>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-12">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex">
                                        <span class="user-add bg-primary d-flex justify-content-center align-items-center rounded-circle me-2">
                                            6
                                        </span>
                                        <a href="javascript:void(0);" class="user-add bg-primary rounded d-flex justify-content-center align-items-center text-white">
                                            <i class="ti ti-user-plus"></i>
                                        </a>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="layout-tab d-flex justify-content-center ">
                                            <div class="nav nav-pills inner-tab " id="pills-tab3" role="tablist">
                                                <div class="nav-item me-0" role="presentation">
                                                    <a href="#" class="nav-link bg-white text-gray p-0 fs-16 me-2" id="pills-single2-tab" data-bs-toggle="pill" data-bs-target="#pills-single2" role="tab" aria-controls="pills-single2" aria-selected="false" tabindex="-1">
                                                        <i class="ti ti-square"></i>
                                                    </a>
                                                </div>
                                                <div class="nav-item" role="presentation">
                                                    <a href="#" class="nav-link active bg-white text-gray p-0 fs-16" id="pills-group2-tab" data-bs-toggle="pill" data-bs-target="#pills-group2" role="tab" aria-controls="pills-group2" aria-selected="false" tabindex="-1">
                                                        <i class="ti ti-layout-grid"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body border-0 pt-0">
                <div class="tab-content dashboard-tab">
                    <div class="tab-pane fade" id="pills-single2" role="tabpanel" aria-labelledby="pills-single2-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="video-call-view br-8 overflow-hidden position-relative">
                                    <img src="{{ URL::asset('/build/img/video/video-member-01.jpg')}}" alt="user-image">
                                    <div class="mini-video-view active br-8 overflow-hidden position-absolute">
                                        <img src="{{ URL::asset('/build/img/video/user-image.jpg')}}" alt="">
                                        <div class="bg-soft-primary mx-auto default-profile rounded-circle align-items-center justify-content-center">
                                            <span class="avatar  avatar-lg rounded-circle bg-primary ">RG</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade active show" id="pills-group2" role="tabpanel" aria-labelledby="pills-group2-tab">
                        <div class="row row-gap-4">
                            <div class="col-md-6 d-flex">
                                <div class="video-call-view br-8 overflow-hidden flex-fill">
                                    <img src="{{ URL::asset('/build/img/video/video-member-02.jpg')}}" alt="user-image">
                                </div>
                            </div>
                            <div class="col-md-6 d-flex">
                                <div class="video-call-view br-8 overflow-hidden flex-fill">
                                    <img src="{{ URL::asset('/build/img/video/video-member-03.jpg')}}" alt="user-image">
                                </div>
                            </div>
                            <div class="col-md-4 d-flex">
                                <div class="video-call-view br-8 overflow-hidden flex-fill">
                                    <img src="{{ URL::asset('/build/img/video/video-member-05.jpg')}}" alt="user-image">
                                </div>
                            </div>
                            <div class="col-md-4 d-flex">
                                <div class="video-call-view br-8 overflow-hidden flex-fill">
                                    <img src="{{ URL::asset('/build/img/video/video-member-04.jpg')}}" alt="user-image">
                                </div>
                            </div>
                            <div class="col-md-4 d-flex">
                                <div class="video-call-view br-8 overflow-hidden default-mode d-flex align-items-center  flex-fill">
                                    <div class="bg-soft-primary mx-auto default-profile rounded-circle d-flex align-items-center justify-content-center">
                                        <span class="avatar  avatar-lg rounded-circle bg-primary ">RG</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer justify-content-center border-0">
                    <div class="call-controll-block d-flex align-items-center justify-content-center rounded-pill">
                        <a href="javascript:void(0);" class="call-controll mute-bt d-flex align-items-center justify-content-center">
                            <i class="ti ti-microphone"></i>
                        </a>
                        <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                            <i class="ti ti-volume"></i>
                        </a>
                        <a href="javascript:void(0);" class="call-controll mute-video d-flex align-items-center justify-content-center">
                            <i class="ti ti-video"></i>
                        </a>
                        <a href="javascript:void(0);" data-bs-dismiss="modal" class="call-controll call-decline d-flex align-items-center justify-content-center">
                            <i class="ti ti-phone"></i>
                        </a>
                        <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                            <i class="ti ti-mood-smile"></i>
                        </a>
                        <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                            <i class="ti ti-maximize"></i>
                        </a>
                        <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                            <i class="ti ti-dots"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Video Call group -->

<!--Group Video Call -->
<div class="modal fade" id="group_video">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header justify-content-center border-0">
                <span class="model-icon bg-primary d-flex justify-content-center align-items-center rounded-circle me-2">
                    <i class="ti ti-video"></i>
                </span>
                <h4 class="modal-title">Video Calling...</h4>
            </div>
            <div class="modal-body pb-0">
                <div class="card bg-light mb-0">
                    <div class="card-body d-flex justify-content-center">
                        <div>
                            <div class="d-flex justify-content-center avatar-group mb-2">
                                <a href="#" class=" ">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="user">
                                </a>
                                <a href="#" class="">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="user">
                                </a>
                                <a href="#" class="">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-05.jpg')}}" class="rounded-circle" alt="user">
                                </a>
                                <a href="#" class="">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="user">
                                </a>
                            </div>
                            <h6 class="fs-14">Edward Lietz, Aariyan Jose, Federico Wells, +1</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0">
                <a href="" class="voice-icon btn btn-success rounded-circle d-flex justify-content-center align-items-center me-2">
                    <i class="ti ti-phone fs-20"></i>
                </a>
                <a href="" class="voice-icon btn btn-danger rounded-circle d-flex justify-content-center align-items-center">
                    <i class="ti ti-phone-off fs-20"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- /Group Video Call -->
<!-- Mute User -->
<div class="modal fade" id="mute-user">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Muted User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('group-chat')}}">
                    <div class="link-item mb-3">
                        <input type="text" class="form-control border-0" placeholder="Search For Muted Users ">
                        <span class="input-group-text"><i class="ti ti-search"></i></span>
                    </div>
                    <h6 class="mb-3 fs-16">Muted User</h6>
                    <div class="mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-lg me-2">
                                            <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="">
                                        </span>
                                        <div>
                                            <h6>Aaryian Jose</h6>
                                            <span class="fs-14">App Developer</span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary">Unmute</a>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-lg me-2">
                                            <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="">
                                        </span>
                                        <div>
                                            <h6>Sarika Jain</h6>
                                            <span class="fs-14">UI/UX Designer</span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary">Unmute</a>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-lg me-2">
                                            <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="">
                                        </span>
                                        <div>
                                            <h6>Clyde Smith</h6>
                                            <span class="fs-14">Web Developer</span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary">Unmute</a>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-lg me-2">
                                            <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="">
                                        </span>
                                        <div>
                                            <h6>Carla Jenkins</h6>
                                            <span class="fs-14">Business Analyst</span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary">Unmute</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Mute User -->

<!-- Delete  Account -->
<div class="modal fade" id="delete-account">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Account</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('group-chat')}}">
                    <div class="block-wrap mb-3">
                        <h6 class="fs-16">Are you sure you want to delete your account? </h6>
                        <p class="text-grya-9">
                            This action is irreversible and all your data will be permanently deleted.
                        </p>
                    </div>
                    <div class="mb-3">
                        <ul>
                            <li class="d-flex align-items-center fs-16 mb-2">
                                <i class="ti ti-arrow-badge-right me-2 fs-20 text-primary"></i>
                                Delete your account info and profile photo
                            </li>
                            <li class="d-flex align-items-center fs-16 mb-2">
                                <i class="ti ti-arrow-badge-right me-2 fs-20 text-primary"></i>
                                Delete you from all dreamschat groups
                            </li>
                            <li class="d-flex fs-16 mb-2">
                                <i class="ti ti-arrow-badge-right me-2 fs-20 text-primary"></i>
                                Delete your message history on this phone and your icloud backup
                            </li>
                        </ul>
                    </div>
                    <div class="d-flex mb-3">
                        <div>
                            <input type="checkbox" class="me-2">
                        </div>
                        <div>
                            <p class="text-grya-9">
                                I understand that deleting my account is irreversible and all my data will be permanently deleted.
                            </p>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Delete Account -->

<!-- Logout -->
<div class="modal fade" id="acc-logout">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Logout</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('group-chat')}}">
                    <div class="block-wrap text-center mb-3">
                        <span class="user-icon mb-3 mx-auto bg-transparent-danger">
                            <i class="ti ti-logout text-danger"></i>
                        </span>
                        <p class="text-grya-9">Are you sure you want to logout? </p>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Logout</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Logout -->
@endif

@if(Route::is(['chat']))

<!-- Mute -->
<div class="modal fade" id="mute-notification">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Mute Notifications
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('chat')}}">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="mute" id="mute1">
                        <label class="form-check-label" for="mute1">30 Minutes</label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="mute" id="mute2">
                        <label class="form-check-label" for="mute2">1 Hour</label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="mute" id="mute3">
                        <label class="form-check-label" for="mute3">1 Day</label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="mute" id="mute4">
                        <label class="form-check-label" for="mute4">1 Week</label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="mute" id="mute5">
                        <label class="form-check-label" for="mute5">1 Month</label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="mute" id="mute6">
                        <label class="form-check-label" for="mute6">1 Year</label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="mute" id="mute7">
                        <label class="form-check-label" for="mute7">Always</label>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Mute</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Mute -->
<!-- Add Call -->
<div class="modal fade" id="new-call">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Call</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('all-calls')}}">
                    <div class="search-wrap contact-search mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search">
                            <a href="javascript:void(0);" class="input-group-text"><i class="ti ti-search"></i></a>
                        </div>
                    </div>
                    <h6 class="mb-3 fw-medium fs-16">Contacts</h6>
                    <div class="contact-scroll contact-select mb-3">
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Edward Lietz</h6>
                                    <p>App Developer</p>
                                </div>
                            </div>
                            <div class="d-inline-flex">
                                <a href="" class="model-icon bg-light d-flex justify-content-center align-items-center rounded-circle me-2" data-bs-toggle="modal" data-bs-target="#voice_call"><span><i class="ti ti-phone"></i></span></a>
                                <a href="" class="model-icon bg-light d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="modal" data-bs-target="#video-call"><span><i class="ti ti-video"></i></span></a>
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Sarika Jain</h6>
                                    <p>UI/UX Designer</p>
                                </div>
                            </div>
                            <div class="d-inline-flex">
                                <a href="" class="model-icon bg-light d-flex justify-content-center align-items-center rounded-circle me-2" data-bs-toggle="modal" data-bs-target="#voice_call"><span><i class="ti ti-phone"></i></span></a>
                                <a href="" class="model-icon bg-light d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="modal" data-bs-target="#video-call"><span><i class="ti ti-video"></i></span></a>
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Clyde Smith</h6>
                                    <p>Web Developer</p>
                                </div>
                            </div>
                            <div class="d-inline-flex">
                                <a href="" class="model-icon bg-light d-flex justify-content-center align-items-center rounded-circle me-2" data-bs-toggle="modal" data-bs-target="#voice_call"><span><i class="ti ti-phone"></i></span></a>
                                <a href="" class="model-icon bg-light d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="modal" data-bs-target="#video-call"><span><i class="ti ti-video"></i></span></a>
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Carla Jenkins</h6>
                                    <p>Business Analyst</p>
                                </div>
                            </div>
                            <div class="d-inline-flex">
                                <a href="" class="model-icon bg-light d-flex justify-content-center align-items-center rounded-circle me-2" data-bs-toggle="modal" data-bs-target="#voice_call"><span><i class="ti ti-phone"></i></span></a>
                                <a href="" class="model-icon bg-light d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="modal" data-bs-target="#video-call"><span><i class="ti ti-video"></i></span></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add Call -->
<!-- Delete -->
<div class="modal fade" id="message-delete">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Delete Chat
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('chat')}}">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" checked name="delete-chat" id="delete-for-me">
                        <label class="form-check-label" for="delete-for-me">Delete For Me</label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="delete-chat" id="delete-for-everyone">
                        <label class="form-check-label" for="delete-for-everyone">Delete For Everyone</label>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Delete -->
<!-- Block User -->
<div class="modal fade" id="block-user">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Block User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('chat')}}">
                    <div class="block-wrap text-center mb-3">
                        <span class="user-icon mb-3 mx-auto bg-transparent-info">
                            <i class="ti ti-user-off text-info"></i>
                        </span>
                        <p class="text-grya-9">Blocked contacts will no longer be able to call you or send you messages.</p>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Block</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Block User -->

<!-- Report User -->
<div class="modal fade" id="report-user">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Report User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('chat')}}">
                    <div class="block-wrap mb-3">
                        <p class="text-grya-9 mb-3">If you block this contact and clear the chat, messages will only be removed from this device and your devices on the newer versions of DreamsChat</p>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="mute" id="report">
                            <label class="form-check-label" for="report">Report User</label>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Report</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Report User -->

<!-- Delete Chat -->
<div class="modal fade" id="delete-chat">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Chat</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('chat')}}">
                    <div class="block-wrap text-center mb-3">
                        <span class="user-icon mb-3 mx-auto bg-transparent-danger">
                            <i class="ti ti-trash text-danger"></i>
                        </span>
                        <p class="text-grya-9">Clearing or deleting entire chats will only remove messages from this device and your devices on the newer versions of DreamsChat.</p>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Delete Chat -->

<!-- New Chat -->
<div class="modal fade" id="new-chat">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Chat</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('chat')}}">
                    <div class="search-wrap contact-search mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search">
                            <a href="javascript:void(0);" class="input-group-text"><i class="ti ti-search"></i></a>
                        </div>
                    </div>
                    <h6 class="mb-3 fw-medium fs-16">Contacts</h6>
                    <div class="contact-scroll contact-select mb-3">
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Aaryian Jose</h6>
                                    <p>App Developer</p>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contact">
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Sarika Jain</h6>
                                    <p>UI/UX Designer</p>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contact">
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Clyde Smith</h6>
                                    <p>Web Developer</p>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contact">
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Carla Jenkins</h6>
                                    <p>Business Analyst</p>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contact">
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Start Chat</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /New Chat -->

<!-- Add Contact -->
<div class="modal fade" id="add-contact">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Contact</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('chat')}}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">First Name</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-user"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Last Name</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-user"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-mail"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-phone"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Date of Birth</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-calendar-event"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Website Address</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-globe"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="card border">
                                <div class="card-header border-bottom">
                                    <h6>Social Information</h6>
                                </div>
                                <div class="card-body pb-1">
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <label class="form-label text-default fw-normal mb-3">Facebook</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-icon position-relative mb-3">
                                                <input type="text" class="form-control">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-brand-facebook"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label text-default fw-normal mb-3">Twitter</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-icon position-relative mb-3">
                                                <input type="text" class="form-control">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-brand-twitter"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-labe text-default fw-normall mb-3">Instagram</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-icon position-relative mb-3">
                                                <input type="text" class="form-control">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-brand-instagram"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label text-default fw-normal mb-3">Linked in</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-icon position-relative mb-3">
                                                <input type="text" class="form-control">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-brand-linkedin"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label text-default fw-normal mb-3">YouTube</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-icon position-relative mb-3">
                                                <input type="text" class="form-control">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-brand-youtube"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Add Contact</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add Contact -->

<!-- Contact Detail -->
<div class="modal fade" id="contact-details">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Contact Detail</h4>
                <div class="d-flex align-items-center">
                    <div class="dropdown me-2">
                        <a class="d-block" href="#" data-bs-toggle="dropdown">
                            <i class="ti ti-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end p-3">
                            <li><a class="dropdown-item" href="#"><i class="ti ti-share-3 me-2"></i>Share</a></li>
                            <li><a class="dropdown-item" href="#"><i class="ti ti-edit me-2"></i>Edit</a></li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#block-user"><i class="ti ti-ban me-2"></i>Block</a></li>
                            <li><a class="dropdown-item" href="#"><i class="ti ti-trash me-2"></i>Delete</a></li>
                        </ul>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <div class="card bg-light shadow-none">
                    <div class="card-body pb-1">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center mb-3">
                                <span class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="img">
                                </span>
                                <div class="ms-2">
                                    <h6>Aaryian Jose</h6>
                                    <p>App Developer</p>
                                </div>
                            </div>
                            <div class="contact-actions d-flex align-items-center mb-3">
                                <a href="{{url('chat')}}" class="me-2"><i class="ti ti-message"></i></a>
                                <a href="javascript:void(0);" class="me-2" data-bs-toggle="modal" data-bs-target="#voice_call"><i class="ti ti-phone"></i></a>
                                <a href="javascript:void(0);" class="me-2"><i class="ti ti-video"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card border mb-3">
                    <div class="card-header border-bottom">
                        <h6>Personal Information</h6>
                    </div>
                    <div class="card-body pb-1">
                        <div class="mb-2">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-clock-hour-4 me-1"></i>Local Time</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">10:00 AM</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-calendar-event me-1"></i>Date of Birth</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">22 July 2024</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-phone me-1"></i>Phone Number</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">+20-482-038-29</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-mail me-1"></i>Email</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">aariyan@example.com</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-globe me-1"></i>Website Address</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">www.examplewebsite.com</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card border mb-0">
                    <div class="card-header border-bottom">
                        <h6>Social Information</h6>
                    </div>
                    <div class="card-body pb-1">
                        <div class="mb-2">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-brand-facebook me-1"></i>Facebook</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">www.facebook.com</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-brand-twitter me-1"></i>Twitter</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">www.twitter.com</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-brand-instagram me-1"></i>Instagram</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">www.instagram.com</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-brand-linkedin me-1"></i>Linkedin</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">www.linkedin.com</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-brand-youtube me-1"></i>YouTube</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">www.youtube.com</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Contact Detail -->

<!-- Voice Call -->
<div class="modal fade" id="voice_call">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header justify-content-center border-0">
                <span class="model-icon bg-primary d-flex justify-content-center align-items-center rounded-circle me-2">
                    <i class="ti ti-phone-call"></i>
                </span>
                <h4 class="modal-title">Audio Calling...</h4>
            </div>
            <div class="modal-body pb-0">
                <div class="card bg-light mb-0">
                    <div class="card-body d-flex justify-content-center">
                        <div>
                            <span class="avatar avatar-xxl">
                                <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="user">
                            </span>
                            <h6 class="fs-14">Edward Lietz</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0">
                <a href="" class="voice-icon btn btn-success rounded-circle d-flex justify-content-center align-items-center me-2" data-bs-toggle="modal" data-bs-target="#voice_attend">
                    <i class="ti ti-phone fs-20"></i>
                </a>
                <a href="" class="voice-icon btn btn-danger rounded-circle d-flex justify-content-center align-items-center">
                    <i class="ti ti-phone-off fs-20"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- /Voice Call -->

<!-- Voice Call attend -->
<div class="modal fade" id="voice_attend" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex border-0 pb-0">
                <div class="card bg-transparent-dark flex-fill border mb-3">
                    <div class="card-body d-flex justify-content-between p-3 flex-wrap row-gap-3">
                        <div class="d-flex align-items-center">
                            <span class="avatar avatar-lg online me-2">
                                <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="user">
                            </span>
                            <div>
                                <h6>Edward Lietz</h6>
                                <span>+22-555-345-11</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="badge border border-primary  text-primary badge-sm me-2">
                                <i class="ti ti-point-filled"></i>
                                01:15:25
                            </span>
                            <a href="" class="user-add bg-primary rounded d-flex justify-content-center align-items-center text-white" data-bs-toggle="modal" data-bs-target="#voice_group">
                                <i class="ti ti-user-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body border-0 pt-0">
                <div class="card audio-crd bg-transparent-dark border">
                    <div class="modal-bgimg">
                        <span class="modal-bg1">
                            <img src="{{URL::asset('/build/img/bg/bg-02.png')}}" class="img-fluid" alt="bg">
                        </span>
                        <span class="modal-bg2">
                            <img src="{{URL::asset('/build/img/bg/bg-03.png')}}" class="img-fluid" alt="bg">
                        </span>
                    </div>
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-center align-items-center pt-5">
                            <span class="avatar avatar-xxxl bg-soft-primary rounded-circle p-2">
                                <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="user">
                            </span>

                        </div>
                        <div class="d-flex align-items-end justify-content-end">
                            <span class="call-span border border-2 border-primary d-flex justify-content-center align-items-center rounded">
                                <span class="avatar avatar-xl bg-soft-primary rounded-circle p-2">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-17.jpg')}}" class="rounded-circle" alt="user">
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0 pt-0">
                <div class="call-controll-block d-flex align-items-center justify-content-center rounded-pill">
                    <a href="javascript:void(0);" class="call-controll mute-bt d-flex align-items-center justify-content-center">
                        <i class="ti ti-microphone"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-volume"></i>
                    </a>
                    <a href="javascript:void(0);" data-bs-dismiss="modal" class="call-controll call-decline d-flex align-items-center justify-content-center">
                        <i class="ti ti-phone"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-maximize"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-dots"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Voice Call attend -->

<!-- Voice Call group -->
<div class="modal fade" id="voice_group" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex border-0 pb-0">
                <div class="card bg-transparent-dark flex-fill border mb-3">
                    <div class="card-body d-flex justify-content-between p-3">
                        <div class="row justify-content-between flex-fill row-gap-3">
                            <div class="col-lg-5">
                                <div class="d-flex justify-content-between align-items-center flex-wrap row-gap-2">
                                    <h3>Weekly Report Call</h3>

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="d-flex justify-content-start align-items-center">
                                    <span class="badge border border-primary  text-primary badge-sm me-3">
                                        <i class="ti ti-point-filled"></i>
                                        01:15:25
                                    </span>
                                    <a href="javascript:void(0);" data-bs-toggle="modal" class="badge badge-danger badge-sm">Leave</a>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex">
                                        <span class="user-add bg-primary d-flex justify-content-center align-items-center rounded-circle me-2">
                                            6
                                        </span>
                                        <a href="" class="user-add bg-primary rounded d-flex justify-content-center align-items-center text-white">
                                            <i class="ti ti-user-plus"></i>
                                        </a>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="layout-tab d-flex justify-content-center ">
                                            <div class="nav nav-pills inner-tab " id="pills-tab2" role="tablist">
                                                <div class="nav-item me-0" role="presentation">
                                                    <a href="#" class="nav-link bg-white text-gray p-0 fs-16 me-2" id="pills-single1-tab" data-bs-toggle="pill"
                                                        data-bs-target="#pills-single1" role="tab" aria-controls="pills-single1"
                                                        aria-selected="false" tabindex="-1">
                                                        <i class="ti ti-square"></i>
                                                    </a>
                                                </div>
                                                <div class="nav-item" role="presentation">
                                                    <a href="#" class="nav-link active bg-white text-gray p-0 fs-16" id="pills-group1-tab" data-bs-toggle="pill"
                                                        data-bs-target="#pills-group1" role="tab" aria-controls="pills-group1"
                                                        aria-selected="false" tabindex="-1">
                                                        <i class="ti ti-layout-grid"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body border-0 pt-0">
                <div class="tab-content dashboard-tab">
                    <div class="tab-pane fade" id="pills-single1" role="tabpanel" aria-labelledby="pills-single1-tab">
                        <div class="card audio-crd bg-transparent-dark border">
                            <div class="modal-bgimg">
                                <span class="modal-bg1">
                                    <img src="{{URL::asset('/build/img/bg/bg-02.png')}}" class="img-fluid" alt="bg">
                                </span>
                                <span class="modal-bg2">
                                    <img src="{{URL::asset('/build/img/bg/bg-03.png')}}" class="img-fluid" alt="bg">
                                </span>
                            </div>
                            <div class="card-body p-3">
                                <div class="single-img d-flex justify-content-center align-items-center">
                                    <span class=" avatar avatar-xxxl bg-soft-primary rounded-circle p-2">
                                        <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="user">
                                    </span>
                                </div>
                                <div class="d-flex align-items-end justify-content-end">
                                    <span class="call-span border border-2 border-primary d-flex justify-content-center align-items-center rounded">
                                        <span class="avatar avatar-xxl bg-soft-primary rounded-circle p-2">
                                            <img src="{{URL::asset('/build/img/profiles/avatar-17.jpg')}}" class="rounded-circle" alt="user">
                                        </span>
                                    </span>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="tab-pane fade active show" id="pills-group1" role="tabpanel" aria-labelledby="pills-group1-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card audio-crd bg-transparent-dark border border-primary pt-4">
                                    <div class="modal-bgimg">
                                        <span class="modal-bg1">
                                            <img src="{{URL::asset('/build/img/bg/bg-02.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                        <span class="modal-bg2">
                                            <img src="{{URL::asset('/build/img/bg/bg-03.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                    </div>
                                    <div class="card-body ">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <span class="avatar avatar-xxxl bg-soft-primary rounded-circle p-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="user">
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-end">
                                            <span class="badge badge-info">Edwin</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card audio-crd bg-transparent-dark border pt-4">
                                    <div class="modal-bgimg">
                                        <span class="modal-bg1">
                                            <img src="{{URL::asset('/build/img/bg/bg-02.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                        <span class="modal-bg2">
                                            <img src="{{URL::asset('/build/img/bg/bg-03.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                    </div>
                                    <div class="card-body ">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <span class="avatar avatar-xxxl bg-soft-primary rounded-circle p-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="user">
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-end">
                                            <span class="badge badge-info">Edwin</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card audio-crd bg-transparent-dark border pt-4">
                                    <div class="modal-bgimg">
                                        <span class="modal-bg1">
                                            <img src="{{URL::asset('/build/img/bg/bg-02.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                        <span class="modal-bg2">
                                            <img src="{{URL::asset('/build/img/bg/bg-03.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                    </div>
                                    <div class="card-body ">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <span class="avatar avatar-xxxl bg-soft-primary rounded-circle p-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="user">
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-end">
                                            <span class="badge badge-info">Edwin</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card audio-crd bg-transparent-dark border pt-4">
                                    <div class="modal-bgimg">
                                        <span class="modal-bg1">
                                            <img src="{{URL::asset('/build/img/bg/bg-02.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                        <span class="modal-bg2">
                                            <img src="{{URL::asset('/build/img/bg/bg-03.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                    </div>
                                    <div class="card-body ">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <span class="avatar avatar-xxxl bg-soft-primary rounded-circle p-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="user">
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-end">
                                            <span class="badge badge-info">Edwin</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card audio-crd bg-transparent-dark border pt-4">
                                    <div class="modal-bgimg">
                                        <span class="modal-bg1">
                                            <img src="{{URL::asset('/build/img/bg/bg-02.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                        <span class="modal-bg2">
                                            <img src="{{URL::asset('/build/img/bg/bg-03.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <span class="avatar avatar-xxxl bg-soft-primary rounded-circle p-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-05.jpg')}}" class="rounded-circle" alt="user">
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-end">
                                            <span class="badge badge-info">Edwin</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0 pt-0">
                <div class="call-controll-block d-flex align-items-center justify-content-center rounded-pill">
                    <a href="javascript:void(0);" class="call-controll mute-bt d-flex align-items-center justify-content-center">
                        <i class="ti ti-microphone"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-volume"></i>
                    </a>
                    <a href="javascript:void(0);" data-bs-dismiss="modal" class="call-controll call-decline d-flex align-items-center justify-content-center">
                        <i class="ti ti-phone"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-maximize"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-dots"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Voice Call group -->

<!-- Video Call -->
<div class="modal fade" id="video-call">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header justify-content-center border-0">
                <span class="model-icon bg-primary d-flex justify-content-center align-items-center rounded-circle me-2">
                    <i class="ti ti-video"></i>
                </span>
                <h4 class="modal-title">Video Calling...</h4>
            </div>
            <div class="modal-body pb-0">
                <div class="card bg-light mb-0">
                    <div class="card-body d-flex justify-content-center">
                        <div>
                            <span class="avatar avatar-xxl">
                                <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="user">
                            </span>
                            <h6 class="fs-14">Edward Lietz</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0">
                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#start-video-call" class="voice-icon btn btn-success rounded-circle d-flex justify-content-center align-items-center me-2">
                    <i class="ti ti-phone fs-20"></i>
                </a>
                <a href="" class="voice-icon btn btn-danger rounded-circle d-flex justify-content-center align-items-center">
                    <i class="ti ti-phone-off fs-20"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- /Video Call -->
<div class="modal video-call-popup fade" id="start-video-call" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex border-0 pb-0">
                <div class="card bg-transparent-dark flex-fill border">
                    <div class="card-body d-flex justify-content-between flex-wrap gap-2">
                        <div class="d-flex align-items-center">
                            <span class="avatar avatar-lg online me-2">
                                <img src="{{URL::asset('/build/img/profiles/avatar-05.jpg')}}" class="rounded-circle" alt="user">
                            </span>
                            <div>
                                <h6>Federico Wells</h6>
                                <span>+22-555-345-11</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="badge border border-primary  text-primary badge-sm me-2">
                                <i class="ti ti-point-filled"></i>
                                01:15:25
                            </span>
                            <a href="javascript:void(0);" class="user-add bg-primary rounded d-flex justify-content-center align-items-center text-white" data-bs-toggle="modal" data-bs-target="#video_group">
                                <i class="ti ti-user-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body border-0 pt-0">
                <div class="video-call-view br-8 overflow-hidden position-relative">
                    <img src="{{URL::asset('/build/img/video/video-member-01.jpg')}}" alt="user-image">
                    <div class="mini-video-view active br-8 overflow-hidden position-absolute">
                        <img src="{{URL::asset('/build/img/video/user-image.jpg')}}" alt="">
                        <div class="bg-soft-primary mx-auto default-profile rounded-circle align-items-center justify-content-center">
                            <span class="avatar  avatar-lg rounded-circle bg-primary ">RG</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0 pt-0">
                <div class="call-controll-block d-flex align-items-center justify-content-center rounded-pill">
                    <a href="javascript:void(0);" class="call-controll mute-bt d-flex align-items-center justify-content-center">
                        <i class="ti ti-microphone"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-volume"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll mute-video d-flex align-items-center justify-content-center">
                        <i class="ti ti-video"></i>
                    </a>
                    <a href="javascript:void(0);" data-bs-dismiss="modal" class="call-controll call-decline d-flex align-items-center justify-content-center">
                        <i class="ti ti-phone"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-mood-smile"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-maximize"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-dots"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Video Call group -->
<div class="modal fade" id="video_group" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header d-flex border-0 pb-0">
                <div class="card bg-transparent-dark flex-fill border mb-3">
                    <div class="card-body d-flex justify-content-between p-3">
                        <div class="row justify-content-between flex-fill row-gap-3">
                            <div class="col-lg-5 col-sm-12">
                                <div class="d-flex justify-content-between align-items-center row-gap-2">
                                    <h3>Weekly Report Call</h3>

                                </div>
                            </div>
                            <div class="col-lg-5 col-sm-12">
                                <div class="d-flex justify-content-start align-items-center">
                                    <span class="badge border border-primary  text-primary badge-sm me-3">
                                        <i class="ti ti-point-filled"></i>
                                        01:15:25
                                    </span>
                                    <a href="javascript:void(0);" data-bs-toggle="modal" class="badge badge-danger badge-sm">Leave</a>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-12">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex">
                                        <span class="user-add bg-primary d-flex justify-content-center align-items-center rounded-circle me-2">
                                            6
                                        </span>
                                        <a href="" class="user-add bg-primary rounded d-flex justify-content-center align-items-center text-white">
                                            <i class="ti ti-user-plus"></i>
                                        </a>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="layout-tab d-flex justify-content-center ">
                                            <div class="nav nav-pills inner-tab " id="pills-tab3" role="tablist">
                                                <div class="nav-item me-0" role="presentation">
                                                    <a href="#" class="nav-link bg-white text-gray p-0 fs-16 me-2" id="pills-single2-tab" data-bs-toggle="pill" data-bs-target="#pills-single2" role="tab" aria-controls="pills-single2" aria-selected="false" tabindex="-1">
                                                        <i class="ti ti-square"></i>
                                                    </a>
                                                </div>
                                                <div class="nav-item" role="presentation">
                                                    <a href="#" class="nav-link active bg-white text-gray p-0 fs-16" id="pills-group2-tab" data-bs-toggle="pill" data-bs-target="#pills-group2" role="tab" aria-controls="pills-group2" aria-selected="false" tabindex="-1">
                                                        <i class="ti ti-layout-grid"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body border-0 pt-0">
                <div class="tab-content dashboard-tab">
                    <div class="tab-pane fade" id="pills-single2" role="tabpanel" aria-labelledby="pills-single2-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="video-call-view br-8 overflow-hidden position-relative">
                                    <img src="{{URL::asset('/build/img/video/video-member-01.jpg')}}" alt="user-image">
                                    <div class="mini-video-view active br-8 overflow-hidden position-absolute">
                                        <img src="{{URL::asset('/build/img/video/user-image.jpg')}}" alt="">
                                        <div class="bg-soft-primary mx-auto default-profile rounded-circle align-items-center justify-content-center">
                                            <span class="avatar  avatar-lg rounded-circle bg-primary ">RG</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade active show" id="pills-group2" role="tabpanel" aria-labelledby="pills-group2-tab">
                        <div class="row row-gap-4">
                            <div class="col-md-6 d-flex">
                                <div class="video-call-view br-8 overflow-hidden flex-fill">
                                    <img src="{{URL::asset('/build/img/video/video-member-02.jpg')}}" alt="user-image">
                                </div>
                            </div>
                            <div class="col-md-6 d-flex">
                                <div class="video-call-view br-8 overflow-hidden flex-fill">
                                    <img src="{{URL::asset('/build/img/video/video-member-03.jpg')}}" alt="user-image">
                                </div>
                            </div>
                            <div class="col-md-4 d-flex">
                                <div class="video-call-view br-8 overflow-hidden flex-fill">
                                    <img src="{{URL::asset('/build/img/video/video-member-05.jpg')}}" alt="user-image">
                                </div>
                            </div>
                            <div class="col-md-4 d-flex">
                                <div class="video-call-view br-8 overflow-hidden flex-fill">
                                    <img src="{{URL::asset('/build/img/video/video-member-04.jpg')}}" alt="user-image">
                                </div>
                            </div>
                            <div class="col-md-4 d-flex">
                                <div class="video-call-view br-8 overflow-hidden default-mode d-flex align-items-center  flex-fill">
                                    <div class="bg-soft-primary mx-auto default-profile rounded-circle d-flex align-items-center justify-content-center">
                                        <span class="avatar  avatar-lg rounded-circle bg-primary ">RG</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer justify-content-center border-0">
                    <div class="call-controll-block d-flex align-items-center justify-content-center rounded-pill">
                        <a href="javascript:void(0);" class="call-controll mute-bt d-flex align-items-center justify-content-center">
                            <i class="ti ti-microphone"></i>
                        </a>
                        <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                            <i class="ti ti-volume"></i>
                        </a>
                        <a href="javascript:void(0);" class="call-controll mute-video d-flex align-items-center justify-content-center">
                            <i class="ti ti-video"></i>
                        </a>
                        <a href="javascript:void(0);" data-bs-dismiss="modal" class="call-controll call-decline d-flex align-items-center justify-content-center">
                            <i class="ti ti-phone"></i>
                        </a>
                        <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                            <i class="ti ti-mood-smile"></i>
                        </a>
                        <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                            <i class="ti ti-maximize"></i>
                        </a>
                        <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                            <i class="ti ti-dots"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Video Call group -->

<!-- Invite -->
<div class="modal fade" id="invite">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Invite Others</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="#">
                    <div class="row">
                        <div class="col-lg-12">
                            <label class="form-label">Email Address or Phone Number</label>
                            <div class="input-icon mb-3 position-relative">
                                <input type="text" value="" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label">Invitation Message</label>
                            <textarea class="form-control mb-3"></textarea>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#new-chat">Send Invitation</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Invite -->
<!-- Mute User -->
<div class="modal fade" id="mute-user">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Muted User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('index')}}">
                    <div class="link-item mb-3">
                        <input type="text" class="form-control border-0" placeholder="Search For Muted Users ">
                        <span class="input-group-text"><i class="ti ti-search"></i></span>
                    </div>
                    <h6 class="mb-3 fs-16">Muted User</h6>
                    <div class="mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-lg me-2">
                                            <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="">
                                        </span>
                                        <div>
                                            <h6>Aaryian Jose</h6>
                                            <span class="fs-14">App Developer</span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary">Unmute</a>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-lg me-2">
                                            <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="">
                                        </span>
                                        <div>
                                            <h6>Sarika Jain</h6>
                                            <span class="fs-14">UI/UX Designer</span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary">Unmute</a>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-lg me-2">
                                            <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="">
                                        </span>
                                        <div>
                                            <h6>Clyde Smith</h6>
                                            <span class="fs-14">Web Developer</span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary">Unmute</a>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-lg me-2">
                                            <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="">
                                        </span>
                                        <div>
                                            <h6>Carla Jenkins</h6>
                                            <span class="fs-14">Business Analyst</span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary">Unmute</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Mute User -->

<!-- Delete  Account -->
<div class="modal fade" id="delete-account">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Account</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('index')}}">
                    <div class="block-wrap mb-3">
                        <h6 class="fs-16">Are you sure you want to delete your account? </h6>
                        <p class="text-grya-9">
                            This action is irreversible and all your data will be permanently deleted.
                        </p>
                    </div>
                    <div class="mb-3">
                        <ul>
                            <li class="d-flex align-items-center fs-16 mb-2">
                                <i class="ti ti-arrow-badge-right me-2 fs-20 text-primary"></i>
                                Delete your account info and profile photo
                            </li>
                            <li class="d-flex align-items-center fs-16 mb-2">
                                <i class="ti ti-arrow-badge-right me-2 fs-20 text-primary"></i>
                                Delete you from all dreamschat groups
                            </li>
                            <li class="d-flex fs-16 mb-2">
                                <i class="ti ti-arrow-badge-right me-2 fs-20 text-primary"></i>
                                Delete your message history on this phone and your icloud backup
                            </li>
                        </ul>
                    </div>
                    <div class="d-flex mb-3">
                        <div>
                            <input type="checkbox" class="me-2">
                        </div>
                        <div>
                            <p class="text-grya-9">
                                I understand that deleting my account is irreversible and all my data will be permanently deleted.
                            </p>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Delete Account -->

<!-- Logout -->
<div class="modal fade" id="acc-logout">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Logout</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('index')}}">
                    <div class="block-wrap text-center mb-3">
                        <span class="user-icon mb-3 mx-auto bg-transparent-danger">
                            <i class="ti ti-logout text-danger"></i>
                        </span>
                        <p class="text-grya-9">Are you sure you want to logout? </p>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Logout</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Logout -->

@endif

@if(Route::is(['group-chat']))
<!-- Invite -->
<div class="modal fade" id="invite">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Invite Others</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="#">
                    <div class="row">
                        <div class="col-lg-12">
                            <label class="form-label">Email Address or Phone Number</label>
                            <div class="input-icon mb-3 position-relative">
                                <input type="text" value="" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label">Invitation Message</label>
                            <textarea class="form-control mb-3"></textarea>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#new-chat">Send Invitation</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Invite -->

<!-- Mute -->
<div class="modal fade" id="mute-notification">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Mute Notifications
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('chat')}}">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="mute" id="mute1">
                        <label class="form-check-label" for="mute1">30 Minutes</label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="mute" id="mute2">
                        <label class="form-check-label" for="mute2">1 Hour</label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="mute" id="mute3">
                        <label class="form-check-label" for="mute3">1 Day</label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="mute" id="mute4">
                        <label class="form-check-label" for="mute4">1 Week</label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="mute" id="mute5">
                        <label class="form-check-label" for="mute5">1 Month</label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="mute" id="mute6">
                        <label class="form-check-label" for="mute6">1 Year</label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="mute" id="mute7">
                        <label class="form-check-label" for="mute7">Always</label>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Mute</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Mute -->

<!-- Disapperaing Message -->
<div class="modal fade" id="msg-disapper">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Disappearing Messages</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('group-chat')}}">
                    <div class="block-wrap mb-3">
                        <p class="text-gray-9">
                            For more privacy and storage, all new messages will disappear from this chat for everyone after the selected duration, except when kept. Anyone in the chat can change this setting.
                        </p>
                    </div>
                    <div class="mb-3">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="mute" id="disappear1">
                            <label class="form-check-label" for="disappear1">24 Hours</label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="mute" id="disappear2">
                            <label class="form-check-label" for="disappear2">7 Days</label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="mute" id="disappear3">
                            <label class="form-check-label" for="disappear3">90 Days</label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="mute" id="disappear4">
                            <label class="form-check-label" for="disappear4">Off</label>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Disapperaing Message -->

<!-- Group Settings -->
<div class="chat-offcanvas offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="group-settings">
    <div class="offcanvas-header">
        <h4 class="offcanvas-title">Group Settings</h4>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="ti ti-x"></i></button>
    </div>
    <div class="offcanvas-body">
        <div class="chat-contact-info">
            <div class="profile-content">
                <div class="content-wrapper other-info">
                    <div class="card">
                        <div class="card-body list-group profile-item">
                            <a href="javascript:void(0);" class="list-group-item" data-bs-toggle="modal" data-bs-target="#edit-group">
                                <div class="profile-info">
                                    <h6 class="fs-16">Edit Group Settings</h6>
                                    <p>All Participants</p>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="link-icon"><i class="ti ti-chevron-right"></i></span>
                                </div>
                            </a>

                            <div class="accordion accordion-flush chat-accordion list-group-item" id="send-settings">
                                <div class="accordion-item w-100">
                                    <h2 class="accordion-header">
                                        <a href="#" class="accordion-button py-0 collapsed" data-bs-toggle="collapse" data-bs-target="#send-privacy" aria-expanded="false" aria-controls="send-privacy">
                                            Send Messages
                                        </a>
                                    </h2>
                                    <p class="fs-16 p-0 mb-0">All Participants</p>
                                    <div id="send-privacy" class="accordion-collapse collapse" data-bs-parent="#send-settings">
                                        <div class="accordion-body p-0 pt-3">
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="radio" name="mute" id="participant" checked>
                                                <label class="form-check-label" for="participant">All Participants</label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="radio" name="mute" id="admin">
                                                <label class="form-check-label" for="admin">Only Admins</label>
                                            </div>
                                            <a href="#" class="btn btn-primary w-100">Save Changes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a href="javascript:void(0);" class="list-group-item" data-bs-toggle="modal" data-bs-target="#approve-participants">
                                <div class="profile-info">
                                    <h6 class="fs-16">Approve New Participants</h6>
                                    <p>Off</p>
                                </div>
                                <div>
                                    <span class="link-icon"><i class="ti ti-chevron-right"></i></span>
                                </div>
                            </a>
                            <a href="javascript:void(0);" class="list-group-item" data-bs-toggle="modal" data-bs-target="#edit-admin">
                                <div class="profile-info">
                                    <h6 class="fs-16">Edit Group Admins</h6>
                                </div>
                                <div>
                                    <span class="link-icon"><i class="ti ti-chevron-right"></i></span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Group Settings -->

<!-- Edit Group Settings -->
<div class="modal fade" id="approve-participants">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Group Settings</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('group-chat')}}">
                    <div class="block-wrap mb-3">
                        <p class="text-gray-9">
                            When turned on, admins must approve anyone who wants to join this group.
                        </p>
                    </div>
                    <div class="mb-3">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="mute" id="approve1" checked>
                            <label class="form-check-label" for="approve1">Off</label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="mute" id="approve2">
                            <label class="form-check-label" for="approve2">On</label>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Edit Group Settings -->

<!-- Block User -->
<div class="modal fade" id="block-user">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Block User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('chat')}}">
                    <div class="block-wrap text-center mb-3">
                        <span class="user-icon mb-3 mx-auto bg-transparent-info">
                            <i class="ti ti-user-off text-info"></i>
                        </span>
                        <p class="text-grya-9">Blocked contacts will no longer be able to call you or send you messages.</p>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Block</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Block User -->

<!-- Report User -->
<div class="modal fade" id="report-user">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Report User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('chat')}}">
                    <div class="block-wrap mb-3">
                        <p class="text-grya-9 mb-3">If you block this contact and clear the chat, messages will only be removed from this device and your devices on the newer versions of DreamsChat</p>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="mute" id="report">
                            <label class="form-check-label" for="report">Report User</label>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Report</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Report User -->

<!-- Delete Chat -->
<div class="modal fade" id="delete-chat">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Chat</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('chat')}}">
                    <div class="block-wrap text-center mb-3">
                        <span class="user-icon mb-3 mx-auto bg-transparent-danger">
                            <i class="ti ti-trash text-danger"></i>
                        </span>
                        <p class="text-grya-9">Clearing or deleting entire chats will only remove messages from this device and your devices on the newer versions of DreamsChat.</p>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Delete Chat -->

<!-- Voice Call -->
<div class="modal fade" id="voice_call">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header justify-content-center border-0">
                <span class="model-icon bg-primary d-flex justify-content-center align-items-center rounded-circle me-2">
                    <i class="ti ti-phone-call"></i>
                </span>
                <h4 class="modal-title">Audio Calling...</h4>
            </div>
            <div class="modal-body pb-0">
                <div class="card bg-light mb-0">
                    <div class="card-body d-flex justify-content-center">
                        <div>
                            <span class="avatar avatar-xxl">
                                <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="user">
                            </span>
                            <h6 class="fs-14">Edward Lietz</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0">
                <a href="" class="voice-icon btn btn-success rounded-circle d-flex justify-content-center align-items-center me-2" data-bs-toggle="modal" data-bs-target="#voice_attend"><span>
                        <i class="ti ti-phone fs-20"></i>
                    </span></a>
                <a href="javascript:void(0);" data-bs-dismiss="modal" class="voice-icon btn btn-danger rounded-circle d-flex justify-content-center align-items-center"><span>
                        <i class="ti ti-phone-off fs-20"></i>
                    </span></a>
            </div>
        </div>
    </div>
</div>
<!-- /Voice Call -->


<!-- Voice Call attend -->
<div class="modal voice-call fade" id="voice_attend">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex border-0 pb-0">
                <div class="card bg-transparent-dark flex-fill border mb-3">
                    <div class="card-body d-flex justify-content-between p-3">
                        <div class="d-flex align-items-center">
                            <span class="avatar avatar-lg online me-2">
                                <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="user">
                            </span>
                            <div>
                                <h6>Edward Lietz</h6>
                                <span>+22-555-345-11</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="badge border border-primary  text-primary badge-sm me-2">
                                <i class="ti ti-point-filled"></i>
                                01:15:25
                            </span>
                            <a href="" class="user-add bg-primary rounded d-flex justify-content-center align-items-center text-white" data-bs-toggle="modal" data-bs-target="#voice_group">
                                <i class="ti ti-user-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body border-0 pt-0">
                <div class="card audio-crd bg-transparent-dark border">
                    <div class="modal-bgimg">
                        <span class="modal-bg1">
                            <img src="{{URL::asset('/build/img/bg/bg-02.png')}}" class="img-fluid" alt="bg">
                        </span>
                        <span class="modal-bg2">
                            <img src="{{URL::asset('/build/img/bg/bg-03.png')}}" class="img-fluid" alt="bg">
                        </span>
                    </div>
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-center align-items-center pt-5">
                            <span class="avatar avatar-xxxl bg-soft-primary rounded-circle p-2">
                                <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="user">
                            </span>

                        </div>
                        <div class="d-flex align-items-end justify-content-end">
                            <span class="call-span border border-2 border-primary d-flex justify-content-center align-items-center rounded">
                                <span class="avatar avatar-xl bg-soft-primary rounded-circle p-2">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-17.jpg')}}" class="rounded-circle" alt="user">
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0 pt-0">
                <div class="call-controll-block d-flex align-items-center justify-content-center rounded-pill">
                    <a href="javascript:void(0);" class="call-controll mute-bt d-flex align-items-center justify-content-center">
                        <i class="ti ti-microphone"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-volume"></i>
                    </a>
                    <a href="javascript:void(0);" data-bs-dismiss="modal" class="call-controll call-decline d-flex align-items-center justify-content-center">
                        <i class="ti ti-phone"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-maximize"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-dots"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Voice Call attend -->

<!-- Voice Call group -->
<div class="modal voice-call fade" id="voice_group">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex border-0 pb-0">
                <div class="card bg-transparent-dark flex-fill border mb-3">
                    <div class="card-body d-flex justify-content-between p-3">
                        <div class="row justify-content-between flex-fill row-gap-3">
                            <div class="col-lg-5">
                                <div class="d-flex justify-content-between align-items-center flex-wrap row-gap-2">
                                    <h3>Weekly Report Call</h3>

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="d-flex justify-content-start align-items-center">
                                    <span class="badge border border-primary  text-primary badge-sm me-3">
                                        <i class="ti ti-point-filled"></i>
                                        01:15:25
                                    </span>
                                    <a href="javascript:void(0);" data-bs-toggle="modal" class="badge badge-danger badge-sm">Leave</a>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex">
                                        <span class="user-add bg-primary d-flex justify-content-center align-items-center rounded-circle me-2">
                                            6
                                        </span>
                                        <a href="" class="user-add bg-primary rounded d-flex justify-content-center align-items-center text-white">
                                            <i class="ti ti-user-plus"></i>
                                        </a>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="layout-tab d-flex justify-content-center ">
                                            <div class="nav nav-pills inner-tab " id="pills-tab2" role="tablist">
                                                <div class="nav-item me-0" role="presentation">
                                                    <a href="#" class="nav-link bg-white text-gray p-0 fs-16 me-2" id="pills-single-tab" data-bs-toggle="pill"
                                                        data-bs-target="#pills-single" role="tab" aria-controls="pills-single"
                                                        aria-selected="false" tabindex="-1">
                                                        <i class="ti ti-square"></i>
                                                    </a>
                                                </div>
                                                <div class="nav-item" role="presentation">
                                                    <a href="#" class="nav-link active bg-white text-gray p-0 fs-16" id="pills-group-tab" data-bs-toggle="pill"
                                                        data-bs-target="#pills-group" role="tab" aria-controls="pills-group"
                                                        aria-selected="false" tabindex="-1">
                                                        <i class="ti ti-layout-grid"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body border-0 pt-0">
                <div class="tab-content dashboard-tab">
                    <div class="tab-pane fade" id="pills-single" role="tabpanel" aria-labelledby="pills-single-tab">
                        <div class="card audio-crd bg-transparent-dark border">
                            <div class="modal-bgimg">
                                <span class="modal-bg1">
                                    <img src="{{URL::asset('/build/img/bg/bg-02.png')}}" class="img-fluid" alt="bg">
                                </span>
                                <span class="modal-bg2">
                                    <img src="{{URL::asset('/build/img/bg/bg-03.png')}}" class="img-fluid" alt="bg">
                                </span>
                            </div>
                            <div class="card-body p-3">
                                <div class="single-img d-flex justify-content-center align-items-center">
                                    <span class=" avatar avatar-xxxl bg-soft-primary rounded-circle p-2">
                                        <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="user">
                                    </span>
                                </div>
                                <div class="d-flex align-items-end justify-content-end">
                                    <span class="call-span border border-2 border-primary d-flex justify-content-center align-items-center rounded">
                                        <span class="avatar avatar-xxl bg-soft-primary rounded-circle p-2">
                                            <img src="{{URL::asset('/build/img/profiles/avatar-17.jpg')}}" class="rounded-circle" alt="user">
                                        </span>
                                    </span>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="tab-pane fade active show" id="pills-group" role="tabpanel" aria-labelledby="pills-group-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card audio-crd bg-transparent-dark border border-primary pt-4">
                                    <div class="modal-bgimg">
                                        <span class="modal-bg1">
                                            <img src="{{URL::asset('/build/img/bg/bg-02.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                        <span class="modal-bg2">
                                            <img src="{{URL::asset('/build/img/bg/bg-03.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                    </div>
                                    <div class="card-body ">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <span class="avatar avatar-xxxl bg-soft-primary rounded-circle p-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="user">
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-end">
                                            <span class="badge badge-info">Edwin</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card audio-crd bg-transparent-dark border pt-4">
                                    <div class="modal-bgimg">
                                        <span class="modal-bg1">
                                            <img src="{{URL::asset('/build/img/bg/bg-02.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                        <span class="modal-bg2">
                                            <img src="{{URL::asset('/build/img/bg/bg-03.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                    </div>
                                    <div class="card-body ">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <span class="avatar avatar-xxxl bg-soft-primary rounded-circle p-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="user">
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-end">
                                            <span class="badge badge-info">Edwin</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card audio-crd bg-transparent-dark border pt-4">
                                    <div class="modal-bgimg">
                                        <span class="modal-bg1">
                                            <img src="{{URL::asset('/build/img/bg/bg-02.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                        <span class="modal-bg2">
                                            <img src="{{URL::asset('/build/img/bg/bg-03.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                    </div>
                                    <div class="card-body ">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <span class="avatar avatar-xxxl bg-soft-primary rounded-circle p-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="user">
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-end">
                                            <span class="badge badge-info">Edwin</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card audio-crd bg-transparent-dark border pt-4">
                                    <div class="modal-bgimg">
                                        <span class="modal-bg1">
                                            <img src="{{URL::asset('/build/img/bg/bg-02.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                        <span class="modal-bg2">
                                            <img src="{{URL::asset('/build/img/bg/bg-03.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                    </div>
                                    <div class="card-body ">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <span class="avatar avatar-xxxl bg-soft-primary rounded-circle p-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="user">
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-end">
                                            <span class="badge badge-info">Edwin</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card audio-crd bg-transparent-dark border pt-4">
                                    <div class="modal-bgimg">
                                        <span class="modal-bg1">
                                            <img src="{{URL::asset('/build/img/bg/bg-02.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                        <span class="modal-bg2">
                                            <img src="{{URL::asset('/build/img/bg/bg-03.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <span class="avatar avatar-xxxl bg-soft-primary rounded-circle p-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-05.jpg')}}" class="rounded-circle" alt="user">
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-end">
                                            <span class="badge badge-info">Edwin</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0 pt-0">
                <div class="call-controll-block d-flex align-items-center justify-content-center rounded-pill">
                    <a href="javascript:void(0);" class="call-controll mute-bt d-flex align-items-center justify-content-center">
                        <i class="ti ti-microphone"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-volume"></i>
                    </a>
                    <a href="javascript:void(0);" data-bs-dismiss="modal" class="call-controll call-decline d-flex align-items-center justify-content-center">
                        <i class="ti ti-phone"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-maximize"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-dots"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Voice Call group -->

<!-- Video Call -->
<div class="modal fade" id="video-call">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header justify-content-center border-0">
                <span class="model-icon bg-primary d-flex justify-content-center align-items-center rounded-circle me-2">
                    <i class="ti ti-video"></i>
                </span>
                <h4 class="modal-title">Video Calling...</h4>
            </div>
            <div class="modal-body pb-0">
                <div class="card bg-light mb-0">
                    <div class="card-body d-flex justify-content-center">
                        <div>
                            <span class="avatar avatar-xxl">
                                <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="user">
                            </span>
                            <h6 class="fs-14">Edward Lietz</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0">
                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#start-video-call" class="voice-icon btn btn-success rounded-circle d-flex justify-content-center align-items-center me-2"><span>
                        <i class="ti ti-phone fs-20"></i>
                    </span></a>
                <a href="" class="voice-icon btn btn-danger rounded-circle d-flex justify-content-center align-items-center"><span>
                        <i class="ti ti-phone-off fs-20"></i>
                    </span></a>
            </div>
        </div>
    </div>
</div>
<!-- /Video Call -->
<div class="modal fade" id="start-video-call">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex border-0 pb-0">
                <div class="card bg-transparent-dark flex-fill border">
                    <div class="card-body d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <span class="avatar avatar-lg online me-2">
                                <img src="{{URL::asset('/build/img/profiles/avatar-05.jpg')}}" class="rounded-circle" alt="user">
                            </span>
                            <div>
                                <h6>Federico Wells</h6>
                                <span>+22-555-345-11</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="badge border border-primary  text-primary badge-sm me-2">
                                <i class="ti ti-point-filled"></i>
                                01:15:25
                            </span>
                            <a href="javascript:void(0);" class="user-add bg-primary rounded d-flex justify-content-center align-items-center text-white" data-bs-toggle="modal" data-bs-target="#video_group">
                                <i class="ti ti-user-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body border-0 pt-0">
                <div class="video-call-view br-8 overflow-hidden position-relative">
                    <img src="{{URL::asset('/build/img/video/video-member-01.jpg')}}" alt="user-image">
                    <div class="mini-video-view active br-8 overflow-hidden position-absolute">
                        <img src="{{URL::asset('/build/img/video/user-image.jpg')}}" alt="">
                        <div class="bg-soft-primary mx-auto default-profile rounded-circle align-items-center justify-content-center">
                            <span class="avatar  avatar-lg rounded-circle bg-primary ">RG</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0 pt-0">
                <div class="call-controll-block d-flex align-items-center justify-content-center rounded-pill">
                    <a href="javascript:void(0);" class="call-controll mute-bt d-flex align-items-center justify-content-center">
                        <i class="ti ti-microphone"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-volume"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll mute-video d-flex align-items-center justify-content-center">
                        <i class="ti ti-video"></i>
                    </a>
                    <a href="javascript:void(0);" data-bs-dismiss="modal" class="call-controll call-decline d-flex align-items-center justify-content-center">
                        <i class="ti ti-phone"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-mood-smile"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-maximize"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-dots"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Group Video Call -->
<div class="modal fade" id="group_video">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header justify-content-center border-0">
                <span class="model-icon bg-primary d-flex justify-content-center align-items-center rounded-circle me-2">
                    <i class="ti ti-video"></i>
                </span>
                <h4 class="modal-title">Video Calling...</h4>
            </div>
            <div class="modal-body pb-0">
                <div class="card bg-light mb-0">
                    <div class="card-body d-flex justify-content-center">
                        <div>
                            <div class="d-flex justify-content-center avatar-group mb-2">
                                <a href="#" class=" ">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="user">
                                </a>
                                <a href="#" class="">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="user">
                                </a>
                                <a href="#" class="">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-05.jpg')}}" class="rounded-circle" alt="user">
                                </a>
                                <a href="#" class="">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="user">
                                </a>
                            </div>
                            <h6 class="fs-14">Edward Lietz, Aariyan Jose, Federico Wells, +1</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0">
                <a href="" class="voice-icon btn btn-success rounded-circle d-flex justify-content-center align-items-center me-2" data-bs-toggle="modal" data-bs-target="#video_group"><span>
                        <i class="ti ti-phone fs-20"></i>
                    </span></a>
                <a href="" class="voice-icon btn btn-danger rounded-circle d-flex justify-content-center align-items-center"><span>
                        <i class="ti ti-phone-off fs-20"></i>
                    </span></a>
            </div>
        </div>
    </div>
</div>
<!-- /Group Video Call -->

<!-- Video Call group -->
<div class="modal fade" id="video_group" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header d-flex border-0 pb-0">
                <div class="card bg-transparent-dark flex-fill border mb-3">
                    <div class="card-body d-flex justify-content-between p-3">
                        <div class="row justify-content-between flex-fill row-gap-3">
                            <div class="col-lg-5 col-sm-12">
                                <div class="d-flex justify-content-between align-items-center row-gap-2">
                                    <h3>Weekly Report Call</h3>

                                </div>
                            </div>
                            <div class="col-lg-5 col-sm-12">
                                <div class="d-flex justify-content-start align-items-center">
                                    <span class="badge border border-primary  text-primary badge-sm me-3">
                                        <i class="ti ti-point-filled"></i>
                                        01:15:25
                                    </span>
                                    <a href="javascript:void(0);" data-bs-toggle="modal" class="badge badge-danger badge-sm">Leave</a>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-12">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex">
                                        <span class="user-add bg-primary d-flex justify-content-center align-items-center rounded-circle me-2">
                                            6
                                        </span>
                                        <a href="javascript:void(0);" class="user-add bg-primary rounded d-flex justify-content-center align-items-center text-white">
                                            <i class="ti ti-user-plus"></i>
                                        </a>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="layout-tab d-flex justify-content-center ">
                                            <div class="nav nav-pills inner-tab " id="pills-tab3" role="tablist">
                                                <div class="nav-item me-0" role="presentation">
                                                    <a href="#" class="nav-link bg-white text-gray p-0 fs-16 me-2" id="pills-single2-tab" data-bs-toggle="pill" data-bs-target="#pills-single2" role="tab" aria-controls="pills-single2" aria-selected="false" tabindex="-1">
                                                        <i class="ti ti-square"></i>
                                                    </a>
                                                </div>
                                                <div class="nav-item" role="presentation">
                                                    <a href="#" class="nav-link active bg-white text-gray p-0 fs-16" id="pills-group2-tab" data-bs-toggle="pill" data-bs-target="#pills-group2" role="tab" aria-controls="pills-group2" aria-selected="false" tabindex="-1">
                                                        <i class="ti ti-layout-grid"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body border-0 pt-0">
                <div class="tab-content dashboard-tab">
                    <div class="tab-pane fade" id="pills-single2" role="tabpanel" aria-labelledby="pills-single2-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="video-call-view br-8 overflow-hidden position-relative">
                                    <img src="{{URL::asset('/build/img/video/video-member-01.jpg')}}" alt="user-image">
                                    <div class="mini-video-view active br-8 overflow-hidden position-absolute">
                                        <img src="{{URL::asset('/build/img/video/user-image.jpg')}}" alt="">
                                        <div class="bg-soft-primary mx-auto default-profile rounded-circle align-items-center justify-content-center">
                                            <span class="avatar  avatar-lg rounded-circle bg-primary ">RG</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade active show" id="pills-group2" role="tabpanel" aria-labelledby="pills-group2-tab">
                        <div class="row row-gap-4">
                            <div class="col-md-6 d-flex">
                                <div class="video-call-view br-8 overflow-hidden flex-fill">
                                    <img src="{{URL::asset('/build/img/video/video-member-02.jpg')}}" alt="user-image">
                                </div>
                            </div>
                            <div class="col-md-6 d-flex">
                                <div class="video-call-view br-8 overflow-hidden flex-fill">
                                    <img src="{{URL::asset('/build/img/video/video-member-03.jpg')}}" alt="user-image">
                                </div>
                            </div>
                            <div class="col-md-4 d-flex">
                                <div class="video-call-view br-8 overflow-hidden flex-fill">
                                    <img src="{{URL::asset('/build/img/video/video-member-05.jpg')}}" alt="user-image">
                                </div>
                            </div>
                            <div class="col-md-4 d-flex">
                                <div class="video-call-view br-8 overflow-hidden flex-fill">
                                    <img src="{{URL::asset('/build/img/video/video-member-04.jpg')}}" alt="user-image">
                                </div>
                            </div>
                            <div class="col-md-4 d-flex">
                                <div class="video-call-view br-8 overflow-hidden default-mode d-flex align-items-center  flex-fill">
                                    <div class="bg-soft-primary mx-auto default-profile rounded-circle d-flex align-items-center justify-content-center">
                                        <span class="avatar  avatar-lg rounded-circle bg-primary ">RG</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer justify-content-center border-0">
                    <div class="call-controll-block d-flex align-items-center justify-content-center rounded-pill">
                        <a href="javascript:void(0);" class="call-controll mute-bt d-flex align-items-center justify-content-center">
                            <i class="ti ti-microphone"></i>
                        </a>
                        <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                            <i class="ti ti-volume"></i>
                        </a>
                        <a href="javascript:void(0);" class="call-controll mute-video d-flex align-items-center justify-content-center">
                            <i class="ti ti-video"></i>
                        </a>
                        <a href="javascript:void(0);" data-bs-dismiss="modal" class="call-controll call-decline d-flex align-items-center justify-content-center">
                            <i class="ti ti-phone"></i>
                        </a>
                        <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                            <i class="ti ti-mood-smile"></i>
                        </a>
                        <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                            <i class="ti ti-maximize"></i>
                        </a>
                        <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                            <i class="ti ti-dots"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Video Call group -->

<!-- Add Call -->
<div class="modal fade" id="new-call">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Call</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('all-calls')}}">
                    <div class="search-wrap contact-search mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search">
                            <a href="javascript:void(0);" class="input-group-text"><i class="ti ti-search"></i></a>
                        </div>
                    </div>
                    <h6 class="mb-3 fw-medium fs-16">Contacts</h6>
                    <div class="contact-scroll contact-select mb-3">
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Edward Lietz</h6>
                                    <p>App Developer</p>
                                </div>
                            </div>
                            <div class="d-inline-flex">
                                <a href="" class="model-icon bg-light d-flex justify-content-center align-items-center rounded-circle me-2" data-bs-toggle="modal" data-bs-target="#voice_call"><span><i class="ti ti-phone"></i></span></a>
                                <a href="" class="model-icon bg-light d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="modal" data-bs-target="#video-call"><span><i class="ti ti-video"></i></span></a>
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Sarika Jain</h6>
                                    <p>UI/UX Designer</p>
                                </div>
                            </div>
                            <div class="d-inline-flex">
                                <a href="" class="model-icon bg-light d-flex justify-content-center align-items-center rounded-circle me-2" data-bs-toggle="modal" data-bs-target="#voice_call"><span><i class="ti ti-phone"></i></span></a>
                                <a href="" class="model-icon bg-light d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="modal" data-bs-target="#video-call"><span><i class="ti ti-video"></i></span></a>
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Clyde Smith</h6>
                                    <p>Web Developer</p>
                                </div>
                            </div>
                            <div class="d-inline-flex">
                                <a href="" class="model-icon bg-light d-flex justify-content-center align-items-center rounded-circle me-2" data-bs-toggle="modal" data-bs-target="#voice_call"><span><i class="ti ti-phone"></i></span></a>
                                <a href="" class="model-icon bg-light d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="modal" data-bs-target="#video-call"><span><i class="ti ti-video"></i></span></a>
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Carla Jenkins</h6>
                                    <p>Business Analyst</p>
                                </div>
                            </div>
                            <div class="d-inline-flex">
                                <a href="" class="model-icon bg-light d-flex justify-content-center align-items-center rounded-circle me-2" data-bs-toggle="modal" data-bs-target="#voice_call"><span><i class="ti ti-phone"></i></span></a>
                                <a href="" class="model-icon bg-light d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="modal" data-bs-target="#video-call"><span><i class="ti ti-video"></i></span></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add Call -->

<!-- Edit Group Settings -->
<div class="modal fade" id="edit-group">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Group Settings</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('group-chat')}}">
                    <div class="block-wrap mb-3">
                        <p class="text-gray-9">
                            Choose who can change this group's subject, icon, and description. They can also edit the disappearing message timer and keep or unkeep messages.
                        </p>
                    </div>
                    <div class="mb-3">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="mute" id="edit1" checked>
                            <label class="form-check-label" for="edit1">All Participants</label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="mute" id="edit2">
                            <label class="form-check-label" for="edit2">Only Admins</label>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Edit Group Settings -->

<!-- Edit Group Admins -->
<div class="modal fade" id="edit-admin">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Group Admins</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('group-chat')}}">
                    <div class="search-wrap contact-search mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search">
                            <a href="javascript:void(0);" class="input-group-text"><i class="ti ti-search"></i></a>
                        </div>
                    </div>
                    <h6 class="mb-3 fw-medium fs-16">Contacts</h6>
                    <div class="contact-scroll contact-select mb-3">
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Aaryian Jose</h6>
                                    <p>App Developer</p>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contact">
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Sarika Jain</h6>
                                    <p>UI/UX Designer</p>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contact">
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Clyde Smith</h6>
                                    <p>Web Developer</p>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contact">
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Carla Jenkins</h6>
                                    <p>Business Analyst</p>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contact">
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Edit Group Admins -->

<!-- New Chat -->
<div class="modal fade" id="new-chat">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Chat</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('group-chat')}}">
                    <div class="search-wrap contact-search mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search">
                            <a href="javascript:void(0);" class="input-group-text"><i class="ti ti-search"></i></a>
                        </div>
                    </div>
                    <h6 class="mb-3 fw-medium fs-16">Contacts</h6>
                    <div class="contact-scroll contact-select mb-3">
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Aaryian Jose</h6>
                                    <p>App Developer</p>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contact">
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Sarika Jain</h6>
                                    <p>UI/UX Designer</p>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contact">
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Clyde Smith</h6>
                                    <p>Web Developer</p>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contact">
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Carla Jenkins</h6>
                                    <p>Business Analyst</p>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contact">
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Start Chat</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /New Chat -->

<!-- Add Contact -->
<div class="modal fade" id="add-contact">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Contact</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="#">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">First Name</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-user"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Last Name</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-user"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-mail"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-phone"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Date of Birth</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-calendar-event"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Website Address</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-globe"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="card border">
                                <div class="card-header border-bottom">
                                    <h6>Social Information</h6>
                                </div>
                                <div class="card-body pb-1">
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <label class="form-label text-default fw-normal mb-3">Facebook</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-icon position-relative mb-3">
                                                <input type="text" class="form-control">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-brand-facebook"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label text-default fw-normal mb-3">Twitter</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-icon position-relative mb-3">
                                                <input type="text" class="form-control">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-brand-twitter"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-labe text-default fw-normall mb-3">Instagram</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-icon position-relative mb-3">
                                                <input type="text" class="form-control">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-brand-instagram"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label text-default fw-normal mb-3">Linked in</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-icon position-relative mb-3">
                                                <input type="text" class="form-control">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-brand-linkedin"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label text-default fw-normal mb-3">YouTube</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-icon position-relative mb-3">
                                                <input type="text" class="form-control">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-brand-youtube"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Add Contact</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add Contact -->

<!-- New Group -->
<div class="modal fade" id="new-group">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Group</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('index')}}">
                    <div class="d-flex justify-content-center align-items-center">
                        <label for="avatar-upload" class="set-pro avatar avatar-xxl rounded-circle mb-3 p-1">
                            <span class="avatar avatar-xl bg-transparent-dark rounded-circle"></span>
                            <span class="add avatar avatar-sm d-flex justify-content-center align-items-center">
                                <i class="ti ti-plus rounded-circle d-flex justify-content-center align-items-center"></i>
                            </span>
                        </label>
                        <input type="file" id="avatar-upload" style="display: none;" accept="image/*">
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label class="form-label">Group Name</label>
                            <div class="input-icon mb-3 position-relative">
                                <input type="text" value="" class="form-control" placeholder="First Name">
                                <span class="icon-addon">
                                    <i class="ti ti-users-group"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label">About</label>
                            <div class="input-icon mb-3 position-relative">
                                <input type="text" value="" class="form-control" placeholder="Last Name">
                                <span class="icon-addon">
                                    <i class="ti ti-info-octagon"></i>
                                </span>
                            </div>
                        </div>
                        <label class="form-label">Group Type</label>
                        <div class="d-flex">

                            <div class="form-check me-3">
                                <input class="form-check-input" type="radio" name="mute" id="group1">
                                <label class="form-check-label" for="group1">Public</label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="mute" id="group2">
                                <label class="form-check-label" for="group2">Private</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#add-group">Next</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /New Group -->

<!--Group Voice Call -->
<div class="modal fade" id="group_voice">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header justify-content-center border-0">
                <span class="model-icon bg-primary d-flex justify-content-center align-items-center rounded-circle me-2">
                    <i class="ti ti-phone-call"></i>
                </span>
                <h4 class="modal-title">Audio Calling...</h4>
            </div>
            <div class="modal-body pb-0">
                <div class="card bg-light mb-0">
                    <div class="card-body d-flex justify-content-center">
                        <div>
                            <div class="d-flex justify-content-center avatar-group mb-2">
                                <a href="#" class=" ">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="user">
                                </a>
                                <a href="#" class="">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="user">
                                </a>
                                <a href="#" class="">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-05.jpg')}}" class="rounded-circle" alt="user">
                                </a>
                                <a href="#" class="">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="user">
                                </a>
                            </div>
                            <h6 class="fs-14">Edward Lietz, Aariyan Jose, Federico Wells, +1</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0">
                <a href="" class="voice-icon btn btn-success rounded-circle d-flex justify-content-center align-items-center me-2" data-bs-toggle="modal" data-bs-target="#voice_attend"><span>
                        <i class="ti ti-phone fs-20"></i>
                    </span></a>
                <a href="javascript:void(0);" data-bs-dismiss="modal" class="voice-icon btn btn-danger rounded-circle d-flex justify-content-center align-items-center"><span>
                        <i class="ti ti-phone-off fs-20"></i>
                    </span></a>
            </div>
        </div>
    </div>
</div>
<!-- /Group Voice Call -->

<!-- Add Group -->
<div class="modal fade" id="add-group">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Members</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('index')}}">
                    <div class="search-wrap contact-search mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search">
                            <a href="javascript:void(0);" class="input-group-text"><i class="ti ti-search"></i></a>
                        </div>
                    </div>
                    <h6 class="mb-3 fw-medium fs-16">Contacts</h6>
                    <div class="contact-scroll contact-select mb-3">
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Aaryian Jose</h6>
                                    <p>App Developer</p>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contact">
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Sarika Jain</h6>
                                    <p>UI/UX Designer</p>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contact">
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Clyde Smith</h6>
                                    <p>Web Developer</p>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contact">
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Carla Jenkins</h6>
                                    <p>Business Analyst</p>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contact">
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#new-group">Previous</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Start Group</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add group -->

<!-- Contact Detail -->
<div class="modal fade" id="contact-details">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Contact Detail</h4>
                <div class="d-flex align-items-center">
                    <div class="dropdown me-2">
                        <a class="d-block" href="#" data-bs-toggle="dropdown">
                            <i class="ti ti-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end p-3">
                            <li><a class="dropdown-item" href="#"><i class="ti ti-share-3 me-2"></i>Share</a></li>
                            <li><a class="dropdown-item" href="#"><i class="ti ti-edit me-2"></i>Edit</a></li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#block-user"><i class="ti ti-ban me-2"></i>Block</a></li>
                            <li><a class="dropdown-item" href="#"><i class="ti ti-trash me-2"></i>Delete</a></li>
                        </ul>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <div class="card bg-light shadow-none">
                    <div class="card-body pb-1">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center mb-3">
                                <span class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="img">
                                </span>
                                <div class="ms-2">
                                    <h6>Aaryian Jose</h6>
                                    <p>App Developer</p>
                                </div>
                            </div>
                            <div class="contact-actions d-flex align-items-center mb-3">
                                <a href="{{url('chat')}}" class="me-2"><i class="ti ti-message"></i></a>
                                <a href="javascript:void(0);" class="me-2" data-bs-toggle="modal" data-bs-target="#voice_call"><i class="ti ti-phone"></i></a>
                                <a href="javascript:void(0);" class="me-2"><i class="ti ti-video"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card border mb-3">
                    <div class="card-header border-bottom">
                        <h6>Personal Information</h6>
                    </div>
                    <div class="card-body pb-1">
                        <div class="mb-2">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-clock-hour-4 me-1"></i>Local Time</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">10:00 AM</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-calendar-event me-1"></i>Date of Birth</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">22 July 2024</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-phone me-1"></i>Phone Number</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">+20-482-038-29</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-mail me-1"></i>Email</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">aariyan@example.com</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-globe me-1"></i>Website Address</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">www.examplewebsite.com</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card border mb-0">
                    <div class="card-header border-bottom">
                        <h6>Social Information</h6>
                    </div>
                    <div class="card-body pb-1">
                        <div class="mb-2">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-brand-facebook me-1"></i>Facebook</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">www.facebook.com</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-brand-twitter me-1"></i>Twitter</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">www.twitter.com</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-brand-instagram me-1"></i>Instagram</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">www.instagram.com</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-brand-linkedin me-1"></i>Linkedin</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">www.linkedin.com</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-brand-youtube me-1"></i>YouTube</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">www.youtube.com</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Contact Detail -->

<!-- Logout -->
<div class="modal fade" id="group-logout">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Logout</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('group-chat')}}">
                    <div class="block-wrap text-center mb-3">
                        <span class="user-icon mb-3 mx-auto bg-transparent-danger">
                            <i class="ti ti-logout-2 text-danger"></i>
                        </span>
                        <div class="d-flex justify-content-center align-items-center">
                            <i class="ti ti-info-square-rounded me-1 fs-16"></i>
                            <p class="text-gray-9">

                                Only group admins will be notified that you left the group.
                            </p>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Exit Group</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Logout -->

<!-- Report Group -->
<div class="modal fade" id="report-group">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Report Wilbur Martinez</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('group-chat')}}">
                    <div class="block-wrap text-center mb-3">
                        <span class="user-icon mb-3 mx-auto bg-transparent-danger">
                            <i class="ti ti-thumb-down text-danger"></i>
                        </span>
                        <div class="d-flex justify-content-center align-items-center mb-3   ">
                            <p class="text-gray-9">
                                If you block this contact and clear the chat, messages will only be removed from this device and your devices on the newer versions of DreamsChat
                            </p>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contact">
                            </div>
                            <p class="text-gray-9">Block Contact and Clear Chat</p>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Report</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Report Group -->

<!-- Mute User -->
<div class="modal fade" id="mute-user">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Blocked User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('group-chat')}}">
                    <div class="link-item mb-3">
                        <input type="text" class="form-control border-0" placeholder="Search For Muted Users ">
                        <span class="input-group-text"><i class="ti ti-search"></i></span>
                    </div>
                    <h6 class="mb-3 fs-16">RMuted User</h6>
                    <div class="mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-lg me-2">
                                            <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="">
                                        </span>
                                        <div>
                                            <h6>Aaryian Jose</h6>
                                            <span class="fs-14">App Developer</span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary">Unmute</a>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-lg me-2">
                                            <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="">
                                        </span>
                                        <div>
                                            <h6>Sarika Jain</h6>
                                            <span class="fs-14">UI/UX Designer</span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary">Unmute</a>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-lg me-2">
                                            <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="">
                                        </span>
                                        <div>
                                            <h6>Clyde Smith</h6>
                                            <span class="fs-14">Web Developer</span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary">Unmute</a>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-lg me-2">
                                            <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="">
                                        </span>
                                        <div>
                                            <h6>Carla Jenkins</h6>
                                            <span class="fs-14">Business Analyst</span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary">Unmute</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Mute User -->

<!-- Delete  Account -->
<div class="modal fade" id="delete-account">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Account</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('group-chat')}}">
                    <div class="block-wrap mb-3">
                        <h6 class="fs-16">Are you sure you want to delete your account? </h6>
                        <p class="text-grya-9">
                            This action is irreversible and all your data will be permanently deleted.
                        </p>
                    </div>
                    <div class="mb-3">
                        <ul>
                            <li class="d-flex align-items-center fs-16 mb-2">
                                <i class="ti ti-arrow-badge-right me-2 fs-20 text-primary"></i>
                                Delete your account info and profile photo
                            </li>
                            <li class="d-flex align-items-center fs-16 mb-2">
                                <i class="ti ti-arrow-badge-right me-2 fs-20 text-primary"></i>
                                Delete you from all dreamschat groups
                            </li>
                            <li class="d-flex fs-16 mb-2">
                                <i class="ti ti-arrow-badge-right me-2 fs-20 text-primary"></i>
                                Delete your message history on this phone and your icloud backup
                            </li>
                        </ul>
                    </div>
                    <div class="d-flex mb-3">
                        <div>
                            <input type="checkbox" class="me-2">
                        </div>
                        <div>
                            <p class="text-grya-9">
                                I understand that deleting my account is irreversible and all my data will be permanently deleted.
                            </p>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Delete Account -->

<!-- Logout -->
<div class="modal fade" id="acc-logout">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Logout</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('group-chat')}}">
                    <div class="block-wrap text-center mb-3">
                        <span class="user-icon mb-3 mx-auto bg-transparent-danger">
                            <i class="ti ti-logout text-danger"></i>
                        </span>
                        <p class="text-grya-9">Are you sure you want to logout? </p>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Logout</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Logout -->

@endif

@if(Route::is(['index']))

<!-- Add Contact -->
<div class="modal fade" id="add-contact">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Contact</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('index')}}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">First Name</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-user"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Last Name</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-user"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-mail"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-phone"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Date of Birth</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control datetimepicker">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-calendar-event"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Website Address</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-globe"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="card border">
                                <div class="card-header border-bottom">
                                    <h6>Social Information</h6>
                                </div>
                                <div class="card-body pb-1">
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <label class="form-label text-default fw-normal mb-3">Facebook</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-icon position-relative mb-3">
                                                <input type="text" class="form-control">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-brand-facebook"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label text-default fw-normal mb-3">Twitter</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-icon position-relative mb-3">
                                                <input type="text" class="form-control">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-brand-twitter"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-labe text-default fw-normall mb-3">Instagram</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-icon position-relative mb-3">
                                                <input type="text" class="form-control">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-brand-instagram"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label text-default fw-normal mb-3">Linked in</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-icon position-relative mb-3">
                                                <input type="text" class="form-control">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-brand-linkedin"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label text-default fw-normal mb-3">YouTube</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-icon position-relative mb-3">
                                                <input type="text" class="form-control">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-brand-youtube"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Add Contact</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add Contact -->

<!-- Add Call -->
<div class="modal fade" id="new-call">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Call</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('all-calls')}}">
                    <div class="search-wrap contact-search mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search">
                            <a href="javascript:void(0);" class="input-group-text"><i class="ti ti-search"></i></a>
                        </div>
                    </div>
                    <h6 class="mb-3 fw-medium fs-16">Contacts</h6>
                    <div class="contact-scroll contact-select mb-3">
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Edward Lietz</h6>
                                    <p>App Developer</p>
                                </div>
                            </div>
                            <div class="d-inline-flex">
                                <a href="" class="model-icon bg-light d-flex justify-content-center align-items-center rounded-circle me-2" data-bs-toggle="modal" data-bs-target="#voice_call"><span><i class="ti ti-phone"></i></span></a>
                                <a href="" class="model-icon bg-light d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="modal" data-bs-target="#video-call"><span><i class="ti ti-video"></i></span></a>
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Sarika Jain</h6>
                                    <p>UI/UX Designer</p>
                                </div>
                            </div>
                            <div class="d-inline-flex">
                                <a href="" class="model-icon bg-light d-flex justify-content-center align-items-center rounded-circle me-2" data-bs-toggle="modal" data-bs-target="#voice_call"><span><i class="ti ti-phone"></i></span></a>
                                <a href="" class="model-icon bg-light d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="modal" data-bs-target="#video-call"><span><i class="ti ti-video"></i></span></a>
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Clyde Smith</h6>
                                    <p>Web Developer</p>
                                </div>
                            </div>
                            <div class="d-inline-flex">
                                <a href="" class="model-icon bg-light d-flex justify-content-center align-items-center rounded-circle me-2" data-bs-toggle="modal" data-bs-target="#voice_call"><span><i class="ti ti-phone"></i></span></a>
                                <a href="" class="model-icon bg-light d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="modal" data-bs-target="#video-call"><span><i class="ti ti-video"></i></span></a>
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Carla Jenkins</h6>
                                    <p>Business Analyst</p>
                                </div>
                            </div>
                            <div class="d-inline-flex">
                                <a href="" class="model-icon bg-light d-flex justify-content-center align-items-center rounded-circle me-2" data-bs-toggle="modal" data-bs-target="#voice_call"><span><i class="ti ti-phone"></i></span></a>
                                <a href="" class="model-icon bg-light d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="modal" data-bs-target="#video-call"><span><i class="ti ti-video"></i></span></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add Call -->

<!-- Edit Contact -->
<div class="modal fade" id="edit-contact">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Contact</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('index')}}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">First Name</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control" value="Aaryian">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-user"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Last Name</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control" value="Jose">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-user"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-mail"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control" value="+20-482-038-29">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-phone"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Date of Birth</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control datetimepicker" value="03-09-1999">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-calendar-event"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Website Address</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control" value="www.examplewebsite.com">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-globe"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="card border">
                                <div class="card-header border-bottom">
                                    <h6>Social Information</h6>
                                </div>
                                <div class="card-body pb-1">
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <label class="form-label text-default fw-normal mb-3">Facebook</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-icon position-relative mb-3">
                                                <input type="text" class="form-control" value="www.facebook.com">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-brand-facebook"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label text-default fw-normal mb-3">Twitter</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-icon position-relative mb-3">
                                                <input type="text" class="form-control" value="www.twitter.com">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-brand-twitter"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-labe text-default fw-normall mb-3">Instagram</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-icon position-relative mb-3">
                                                <input type="text" class="form-control" value="www.instagram.com">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-brand-instagram"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label text-default fw-normal mb-3">Linked in</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-icon position-relative mb-3">
                                                <input type="text" class="form-control" value="www.linkedin.com">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-brand-linkedin"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label text-default fw-normal mb-3">YouTube</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-icon position-relative mb-3">
                                                <input type="text" class="form-control" value="www.youtube.com">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-brand-youtube"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Add Contact</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Edit Contact -->

<!-- Contact Detail -->
<div class="modal fade" id="contact-details">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Contact Detail</h4>
                <div class="d-flex align-items-center">
                    <div class="dropdown me-2">
                        <a class="d-block" href="#" data-bs-toggle="dropdown">
                            <i class="ti ti-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end p-3">
                            <li><a class="dropdown-item" href="#"><i class="ti ti-share-3 me-2"></i>Share</a></li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit-contact"><i class="ti ti-edit me-2"></i>Edit</a></li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#block-user"><i class="ti ti-ban me-2"></i>Block</a></li>
                            <li><a class="dropdown-item" href="#"><i class="ti ti-trash me-2"></i>Delete</a></li>
                        </ul>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <div class="card bg-light shadow-none">
                    <div class="card-body pb-1">
                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                            <div class="d-flex align-items-center mb-3">
                                <span class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="img">
                                </span>
                                <div class="ms-2">
                                    <h6>Aaryian Jose</h6>
                                    <p>App Developer</p>
                                </div>
                            </div>
                            <div class="contact-actions d-flex align-items-center mb-3">
                                <a href="{{url('chat')}}" class="me-2"><i class="ti ti-message"></i></a>
                                <a href="javascript:void(0);" class="me-2" data-bs-toggle="modal" data-bs-target="#voice_call"><i class="ti ti-phone"></i></a>
                                <a href="javascript:void(0);" class="me-2" data-bs-toggle="modal" data-bs-target="#video-call"><i class="ti ti-video"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card border mb-3">
                    <div class="card-header border-bottom">
                        <h6>Personal Information</h6>
                    </div>
                    <div class="card-body pb-1">
                        <div class="mb-2">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-clock-hour-4 me-1"></i>Local Time</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">10:00 AM</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-calendar-event me-1"></i>Date of Birth</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">22 July 2024</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-phone me-1"></i>Phone Number</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">+20-482-038-29</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-mail me-1"></i>Email</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">aariyan@example.com</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-globe me-1"></i>Website Address</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">www.examplewebsite.com</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card border mb-0">
                    <div class="card-header border-bottom">
                        <h6>Social Information</h6>
                    </div>
                    <div class="card-body pb-1">
                        <div class="mb-2">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-brand-facebook me-1"></i>Facebook</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">www.facebook.com</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-brand-twitter me-1"></i>Twitter</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">www.twitter.com</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-brand-instagram me-1"></i>Instagram</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">www.instagram.com</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-brand-linkedin me-1"></i>Linkedin</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">www.linkedin.com</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-brand-youtube me-1"></i>YouTube</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">www.youtube.com</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Contact Detail -->

<!-- Invite -->
<div class="modal fade" id="invite">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Invite Others</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="#">
                    <div class="row">
                        <div class="col-lg-12">
                            <label class="form-label">Email Address or Phone Number</label>
                            <div class="input-icon mb-3 position-relative">
                                <input type="text" value="" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label">Invitation Message</label>
                            <textarea class="form-control mb-3"></textarea>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#new-chat">Send Invitation</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Invite -->


<!-- New Chat -->
<div class="modal fade" id="new-chat">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Chat</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('index')}}">
                    <div class="search-wrap contact-search mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search">
                            <a href="javascript:void(0);" class="input-group-text"><i class="ti ti-search"></i></a>
                        </div>
                    </div>
                    <h6 class="mb-3 fw-medium fs-16">Contacts</h6>
                    <div class="contact-scroll contact-select mb-3">
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Aaryian Jose</h6>
                                    <p>App Developer</p>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contact">
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Sarika Jain</h6>
                                    <p>UI/UX Designer</p>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contact">
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Clyde Smith</h6>
                                    <p>Web Developer</p>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contact">
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Carla Jenkins</h6>
                                    <p>Business Analyst</p>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contact">
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Start Chat</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /New Chat -->

<!-- Delete Chat -->
<div class="modal fade" id="delete-chat">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Chat</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('chat')}}">
                    <div class="block-wrap text-center mb-3">
                        <span class="user-icon mb-3 mx-auto bg-transparent-danger">
                            <i class="ti ti-trash text-danger"></i>
                        </span>
                        <p class="text-grya-9">Clearing or deleting entire chats will only remove messages from this device and your devices on the newer versions of DreamsChat.</p>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Delete Chat -->

<!-- Voice Call -->
<div class="modal fade" id="voice_call">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header justify-content-center border-0">
                <span class="model-icon bg-primary d-flex justify-content-center align-items-center rounded-circle me-2">
                    <i class="ti ti-phone-call"></i>
                </span>
                <h4 class="modal-title">Audio Calling...</h4>
            </div>
            <div class="modal-body pb-0">
                <div class="card bg-light mb-0">
                    <div class="card-body d-flex justify-content-center">
                        <div>
                            <span class="avatar avatar-xxl">
                                <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="user">
                            </span>
                            <h6 class="fs-14">Edward Lietz</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0">
                <a href="javascript:void(0);" class="voice-icon btn btn-success rounded-circle d-flex justify-content-center align-items-center me-2" data-bs-toggle="modal" data-bs-target="#voice_attend">
                    <i class="ti ti-phone fs-20"></i>
                </a>
                <a href="javascript:void(0);" class="voice-icon btn btn-danger rounded-circle d-flex justify-content-center align-items-center">
                    <i class="ti ti-phone-off fs-20"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- /Voice Call -->

<!-- Voice Call attend -->
<div class="modal fade" id="voice_attend" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex border-0 pb-0">
                <div class="card bg-transparent-dark flex-fill border mb-3">
                    <div class="card-body d-flex justify-content-between p-3 flex-wrap row-gap-3">
                        <div class="d-flex align-items-center">
                            <span class="avatar avatar-lg online me-2">
                                <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="user">
                            </span>
                            <div>
                                <h6>Edward Lietz</h6>
                                <span>+22-555-345-11</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="badge border border-primary  text-primary badge-sm me-2">
                                <i class="ti ti-point-filled"></i>
                                01:15:25
                            </span>
                            <a href="javascript:void(0);" class="user-add bg-primary rounded d-flex justify-content-center align-items-center text-white" data-bs-toggle="modal" data-bs-target="#voice_group">
                                <i class="ti ti-user-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body border-0 pt-0">
                <div class="card audio-crd bg-transparent-dark border">
                    <div class="modal-bgimg">
                        <span class="modal-bg1">
                            <img src="{{URL::asset('/build/img/bg/bg-02.png')}}" class="img-fluid" alt="bg">
                        </span>
                        <span class="modal-bg2">
                            <img src="{{URL::asset('/build/img/bg/bg-03.png')}}" class="img-fluid" alt="bg">
                        </span>
                    </div>
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-center align-items-center pt-5">
                            <span class="avatar avatar-xxxl bg-soft-primary rounded-circle p-2">
                                <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="user">
                            </span>

                        </div>
                        <div class="d-flex align-items-end justify-content-end">
                            <span class="call-span border border-2 border-primary d-flex justify-content-center align-items-center rounded">
                                <span class="avatar avatar-xl bg-soft-primary rounded-circle p-2">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-17.jpg')}}" class="rounded-circle" alt="user">
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0 pt-0">
                <div class="call-controll-block d-flex align-items-center justify-content-center rounded-pill">
                    <a href="javascript:void(0);" class="call-controll mute-bt d-flex align-items-center justify-content-center">
                        <i class="ti ti-microphone"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-volume"></i>
                    </a>
                    <a href="javascript:void(0);" data-bs-dismiss="modal" class="call-controll call-decline d-flex align-items-center justify-content-center">
                        <i class="ti ti-phone"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-maximize"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-dots"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Voice Call attend -->

<!-- Voice Call group -->
<div class="modal fade" id="voice_group" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex border-0 pb-0">
                <div class="card bg-transparent-dark flex-fill border mb-3">
                    <div class="card-body d-flex justify-content-between p-3">
                        <div class="row justify-content-between flex-fill row-gap-3">
                            <div class="col-lg-5">
                                <div class="d-flex justify-content-between align-items-center flex-wrap row-gap-2">
                                    <h3>Weekly Report Call</h3>

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="d-flex justify-content-start align-items-center">
                                    <span class="badge border border-primary  text-primary badge-sm me-3">
                                        <i class="ti ti-point-filled"></i>
                                        01:15:25
                                    </span>
                                    <a href="javascript:void(0);" data-bs-toggle="modal" class="badge badge-danger badge-sm">Leave</a>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex">
                                        <span class="user-add bg-primary d-flex justify-content-center align-items-center rounded-circle me-2">
                                            6
                                        </span>
                                        <a href="javascript:void(0);" class="user-add bg-primary rounded d-flex justify-content-center align-items-center text-white">
                                            <i class="ti ti-user-plus"></i>
                                        </a>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="layout-tab d-flex justify-content-center ">
                                            <div class="nav nav-pills inner-tab " id="pills-tab2" role="tablist">
                                                <div class="nav-item me-0" role="presentation">
                                                    <a href="#" class="nav-link bg-white text-gray p-0 fs-16 me-2" id="pills-single1-tab" data-bs-toggle="pill"
                                                        data-bs-target="#pills-single1" role="tab" aria-controls="pills-single1"
                                                        aria-selected="false" tabindex="-1">
                                                        <i class="ti ti-square"></i>
                                                    </a>
                                                </div>
                                                <div class="nav-item" role="presentation">
                                                    <a href="#" class="nav-link active bg-white text-gray p-0 fs-16" id="pills-group1-tab" data-bs-toggle="pill"
                                                        data-bs-target="#pills-group1" role="tab" aria-controls="pills-group1"
                                                        aria-selected="false" tabindex="-1">
                                                        <i class="ti ti-layout-grid"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body border-0 pt-0">
                <div class="tab-content dashboard-tab">
                    <div class="tab-pane fade" id="pills-single1" role="tabpanel" aria-labelledby="pills-single1-tab">
                        <div class="card audio-crd bg-transparent-dark border">
                            <div class="modal-bgimg">
                                <span class="modal-bg1">
                                    <img src="{{URL::asset('/build/img/bg/bg-02.png')}}" class="img-fluid" alt="bg">
                                </span>
                                <span class="modal-bg2">
                                    <img src="{{URL::asset('/build/img/bg/bg-03.png')}}" class="img-fluid" alt="bg">
                                </span>
                            </div>
                            <div class="card-body p-3">
                                <div class="single-img d-flex justify-content-center align-items-center">
                                    <span class=" avatar avatar-xxxl bg-soft-primary rounded-circle p-2">
                                        <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="user">
                                    </span>
                                </div>
                                <div class="d-flex align-items-end justify-content-end">
                                    <span class="call-span border border-2 border-primary d-flex justify-content-center align-items-center rounded">
                                        <span class="avatar avatar-xxl bg-soft-primary rounded-circle p-2">
                                            <img src="{{URL::asset('/build/img/profiles/avatar-17.jpg')}}" class="rounded-circle" alt="user">
                                        </span>
                                    </span>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="tab-pane fade active show" id="pills-group1" role="tabpanel" aria-labelledby="pills-group1-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card audio-crd bg-transparent-dark border border-primary pt-4">
                                    <div class="modal-bgimg">
                                        <span class="modal-bg1">
                                            <img src="{{URL::asset('/build/img/bg/bg-02.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                        <span class="modal-bg2">
                                            <img src="{{URL::asset('/build/img/bg/bg-03.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                    </div>
                                    <div class="card-body ">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <span class="avatar avatar-xxxl bg-soft-primary rounded-circle p-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="user">
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-end">
                                            <span class="badge badge-info">Edwin</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card audio-crd bg-transparent-dark border pt-4">
                                    <div class="modal-bgimg">
                                        <span class="modal-bg1">
                                            <img src="{{URL::asset('/build/img/bg/bg-02.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                        <span class="modal-bg2">
                                            <img src="{{URL::asset('/build/img/bg/bg-03.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                    </div>
                                    <div class="card-body ">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <span class="avatar avatar-xxxl bg-soft-primary rounded-circle p-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="user">
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-end">
                                            <span class="badge badge-info">Edwin</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card audio-crd bg-transparent-dark border pt-4">
                                    <div class="modal-bgimg">
                                        <span class="modal-bg1">
                                            <img src="{{URL::asset('/build/img/bg/bg-02.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                        <span class="modal-bg2">
                                            <img src="{{URL::asset('/build/img/bg/bg-03.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                    </div>
                                    <div class="card-body ">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <span class="avatar avatar-xxxl bg-soft-primary rounded-circle p-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="user">
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-end">
                                            <span class="badge badge-info">Edwin</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card audio-crd bg-transparent-dark border pt-4">
                                    <div class="modal-bgimg">
                                        <span class="modal-bg1">
                                            <img src="{{URL::asset('/build/img/bg/bg-02.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                        <span class="modal-bg2">
                                            <img src="{{URL::asset('/build/img/bg/bg-03.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                    </div>
                                    <div class="card-body ">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <span class="avatar avatar-xxxl bg-soft-primary rounded-circle p-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="user">
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-end">
                                            <span class="badge badge-info">Edwin</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card audio-crd bg-transparent-dark border pt-4">
                                    <div class="modal-bgimg">
                                        <span class="modal-bg1">
                                            <img src="{{URL::asset('/build/img/bg/bg-02.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                        <span class="modal-bg2">
                                            <img src="{{URL::asset('/build/img/bg/bg-03.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <span class="avatar avatar-xxxl bg-soft-primary rounded-circle p-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-05.jpg')}}" class="rounded-circle" alt="user">
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-end">
                                            <span class="badge badge-info">Edwin</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0 pt-0">
                <div class="call-controll-block d-flex align-items-center justify-content-center rounded-pill">
                    <a href="javascript:void(0);" class="call-controll mute-bt d-flex align-items-center justify-content-center">
                        <i class="ti ti-microphone"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-volume"></i>
                    </a>
                    <a href="javascript:void(0);" data-bs-dismiss="modal" class="call-controll call-decline d-flex align-items-center justify-content-center">
                        <i class="ti ti-phone"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-maximize"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-dots"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Voice Call group -->

<!-- Video Call -->
<div class="modal fade" id="video-call">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header justify-content-center border-0">
                <span class="model-icon bg-primary d-flex justify-content-center align-items-center rounded-circle me-2">
                    <i class="ti ti-video"></i>
                </span>
                <h4 class="modal-title">Video Calling...</h4>
            </div>
            <div class="modal-body pb-0">
                <div class="card bg-light mb-0">
                    <div class="card-body d-flex justify-content-center">
                        <div>
                            <span class="avatar avatar-xxl">
                                <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="user">
                            </span>
                            <h6 class="fs-14">Edward Lietz</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0">
                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#start-video-call" class="voice-icon btn btn-success rounded-circle d-flex justify-content-center align-items-center me-2">
                    <i class="ti ti-phone fs-20"></i>
                </a>
                <a href="javascript:void(0);" class="voice-icon btn btn-danger rounded-circle d-flex justify-content-center align-items-center">
                    <i class="ti ti-phone-off fs-20"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- /Video Call -->

<div class="modal video-call-popup fade" id="start-video-call" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex border-0 pb-0">
                <div class="card bg-transparent-dark flex-fill border">
                    <div class="card-body d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <span class="avatar avatar-lg online me-2">
                                <img src="{{URL::asset('/build/img/profiles/avatar-05.jpg')}}" class="rounded-circle" alt="user">
                            </span>
                            <div>
                                <h6>Federico Wells</h6>
                                <span>+22-555-345-11</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="badge border border-primary  text-primary badge-sm me-2">
                                <i class="ti ti-point-filled"></i>
                                01:15:25
                            </span>
                            <a href="javascript:void(0);" class="user-add bg-primary rounded d-flex justify-content-center align-items-center text-white" data-bs-toggle="modal" data-bs-target="#video_group">
                                <i class="ti ti-user-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body border-0 pt-0">
                <div class="video-call-view br-8 overflow-hidden position-relative">
                    <img src="{{URL::asset('/build/img/video/video-member-01.jpg')}}" alt="user-image">
                    <div class="mini-video-view active br-8 overflow-hidden position-absolute">
                        <img src="{{URL::asset('/build/img/video/user-image.jpg')}}" alt="">
                        <div class="bg-soft-primary mx-auto default-profile rounded-circle align-items-center justify-content-center">
                            <span class="avatar  avatar-lg rounded-circle bg-primary ">RG</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0 pt-0">
                <div class="call-controll-block d-flex align-items-center justify-content-center rounded-pill">
                    <a href="javascript:void(0);" class="call-controll mute-bt d-flex align-items-center justify-content-center">
                        <i class="ti ti-microphone"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-volume"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll mute-video d-flex align-items-center justify-content-center">
                        <i class="ti ti-video"></i>
                    </a>
                    <a href="javascript:void(0);" data-bs-dismiss="modal" class="call-controll call-decline d-flex align-items-center justify-content-center">
                        <i class="ti ti-phone"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-mood-smile"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-maximize"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-dots"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Video Call group -->
<div class="modal fade" id="video_group" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header d-flex border-0 pb-0">
                <div class="card bg-transparent-dark flex-fill border mb-3">
                    <div class="card-body d-flex justify-content-between p-3">
                        <div class="row justify-content-between flex-fill row-gap-3">
                            <div class="col-lg-5 col-sm-12">
                                <div class="d-flex justify-content-between align-items-center row-gap-2">
                                    <h3>Weekly Report Call</h3>

                                </div>
                            </div>
                            <div class="col-lg-5 col-sm-12">
                                <div class="d-flex justify-content-start align-items-center">
                                    <span class="badge border border-primary  text-primary badge-sm me-3">
                                        <i class="ti ti-point-filled"></i>
                                        01:15:25
                                    </span>
                                    <a href="javascript:void(0);" data-bs-toggle="modal" class="badge badge-danger badge-sm">Leave</a>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-12">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex">
                                        <span class="user-add bg-primary d-flex justify-content-center align-items-center rounded-circle me-2">
                                            6
                                        </span>
                                        <a href="javascript:void(0);" class="user-add bg-primary rounded d-flex justify-content-center align-items-center text-white">
                                            <i class="ti ti-user-plus"></i>
                                        </a>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="layout-tab d-flex justify-content-center ">
                                            <div class="nav nav-pills inner-tab " id="pills-tab3" role="tablist">
                                                <div class="nav-item me-0" role="presentation">
                                                    <a href="#" class="nav-link bg-white text-gray p-0 fs-16 me-2" id="pills-single2-tab" data-bs-toggle="pill" data-bs-target="#pills-single2" role="tab" aria-controls="pills-single2" aria-selected="false" tabindex="-1">
                                                        <i class="ti ti-square"></i>
                                                    </a>
                                                </div>
                                                <div class="nav-item" role="presentation">
                                                    <a href="#" class="nav-link active bg-white text-gray p-0 fs-16" id="pills-group2-tab" data-bs-toggle="pill" data-bs-target="#pills-group2" role="tab" aria-controls="pills-group2" aria-selected="false" tabindex="-1">
                                                        <i class="ti ti-layout-grid"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body border-0 pt-0">
                <div class="tab-content dashboard-tab">
                    <div class="tab-pane fade" id="pills-single2" role="tabpanel" aria-labelledby="pills-single2-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="video-call-view br-8 overflow-hidden position-relative">
                                    <img src="{{URL::asset('/build/img/video/video-member-01.jpg')}}" alt="user-image">
                                    <div class="mini-video-view active br-8 overflow-hidden position-absolute">
                                        <img src="{{URL::asset('/build/img/video/user-image.jpg')}}" alt="">
                                        <div class="bg-soft-primary mx-auto default-profile rounded-circle align-items-center justify-content-center">
                                            <span class="avatar  avatar-lg rounded-circle bg-primary ">RG</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade active show" id="pills-group2" role="tabpanel" aria-labelledby="pills-group2-tab">
                        <div class="row row-gap-4">
                            <div class="col-md-6 d-flex">
                                <div class="video-call-view br-8 overflow-hidden flex-fill">
                                    <img src="{{URL::asset('/build/img/video/video-member-02.jpg')}}" alt="user-image">
                                </div>
                            </div>
                            <div class="col-md-6 d-flex">
                                <div class="video-call-view br-8 overflow-hidden flex-fill">
                                    <img src="{{URL::asset('/build/img/video/video-member-03.jpg')}}" alt="user-image">
                                </div>
                            </div>
                            <div class="col-md-4 d-flex">
                                <div class="video-call-view br-8 overflow-hidden flex-fill">
                                    <img src="{{URL::asset('/build/img/video/video-member-05.jpg')}}" alt="user-image">
                                </div>
                            </div>
                            <div class="col-md-4 d-flex">
                                <div class="video-call-view br-8 overflow-hidden flex-fill">
                                    <img src="{{URL::asset('/build/img/video/video-member-04.jpg')}}" alt="user-image">
                                </div>
                            </div>
                            <div class="col-md-4 d-flex">
                                <div class="video-call-view br-8 overflow-hidden default-mode d-flex align-items-center  flex-fill">
                                    <div class="bg-soft-primary mx-auto default-profile rounded-circle d-flex align-items-center justify-content-center">
                                        <span class="avatar  avatar-lg rounded-circle bg-primary ">RG</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer justify-content-center border-0">
                    <div class="call-controll-block d-flex align-items-center justify-content-center rounded-pill">
                        <a href="javascript:void(0);" class="call-controll mute-bt d-flex align-items-center justify-content-center">
                            <i class="ti ti-microphone"></i>
                        </a>
                        <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                            <i class="ti ti-volume"></i>
                        </a>
                        <a href="javascript:void(0);" class="call-controll mute-video d-flex align-items-center justify-content-center">
                            <i class="ti ti-video"></i>
                        </a>
                        <a href="javascript:void(0);" data-bs-dismiss="modal" class="call-controll call-decline d-flex align-items-center justify-content-center">
                            <i class="ti ti-phone"></i>
                        </a>
                        <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                            <i class="ti ti-mood-smile"></i>
                        </a>
                        <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                            <i class="ti ti-maximize"></i>
                        </a>
                        <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                            <i class="ti ti-dots"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Video Call group -->

<!-- Block User -->
<div class="modal fade" id="block-user">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Block User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('index')}}">
                    <div class="block-wrap text-center mb-3">
                        <span class="user-icon mb-3 mx-auto bg-transparent-info">
                            <i class="ti ti-user-off text-info"></i>
                        </span>
                        <p class="text-grya-9">Blocked contacts will no longer be able to call you or send you messages.</p>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Block</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Block User -->

<!-- New Group -->
<div class="modal fade" id="new-group">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Group</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('index')}}">
                    <div class="d-flex justify-content-center align-items-center">
                        <label for="avatar-upload" class="set-pro avatar avatar-xxl rounded-circle mb-3 p-1">
                            <span class="avatar avatar-xl bg-transparent-dark rounded-circle"></span>
                            <span class="add avatar avatar-sm d-flex justify-content-center align-items-center">
                                <i class="ti ti-plus rounded-circle d-flex justify-content-center align-items-center"></i>
                            </span>
                        </label>
                        <input type="file" id="avatar-upload" style="display: none;" accept="image/*">
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label class="form-label">Group Name</label>
                            <div class="input-icon mb-3 position-relative">
                                <input type="text" value="" class="form-control" placeholder="First Name">
                                <span class="icon-addon">
                                    <i class="ti ti-users-group"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label">About</label>
                            <div class="input-icon mb-3 position-relative">
                                <input type="text" value="" class="form-control" placeholder="Last Name">
                                <span class="icon-addon">
                                    <i class="ti ti-info-octagon"></i>
                                </span>
                            </div>
                        </div>
                        <label class="form-label">Group Type</label>
                        <div class="d-flex">

                            <div class="form-check me-3">
                                <input class="form-check-input" type="radio" name="mute" id="mute1">
                                <label class="form-check-label" for="mute1">Public</label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="mute" id="mute2">
                                <label class="form-check-label" for="mute2">Private</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#add-group">Next</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /New Group -->

<!-- Add Group -->
<div class="modal fade" id="add-group">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Members</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('index')}}">
                    <div class="search-wrap contact-search mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search">
                            <a href="javascript:void(0);" class="input-group-text"><i class="ti ti-search"></i></a>
                        </div>
                    </div>
                    <h6 class="mb-3 fw-medium fs-16">Contacts</h6>
                    <div class="contact-scroll contact-select mb-3">
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Aaryian Jose</h6>
                                    <p>App Developer</p>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contact">
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Sarika Jain</h6>
                                    <p>UI/UX Designer</p>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contact">
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Clyde Smith</h6>
                                    <p>Web Developer</p>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contact">
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Carla Jenkins</h6>
                                    <p>Business Analyst</p>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contact">
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#new-group">Previous</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Start Group</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add group -->

<!-- Mute User -->
<div class="modal fade" id="mute-user">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Blocked User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('index')}}">
                    <div class="link-item mb-3">
                        <input type="text" class="form-control border-0" placeholder="Search For Muted Users ">
                        <span class="input-group-text"><i class="ti ti-search"></i></span>
                    </div>
                    <h6 class="mb-3 fs-16">RMuted User</h6>
                    <div class="mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-lg me-2">
                                            <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="">
                                        </span>
                                        <div>
                                            <h6>Aaryian Jose</h6>
                                            <span class="fs-14">App Developer</span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary">Unmute</a>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-lg me-2">
                                            <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="">
                                        </span>
                                        <div>
                                            <h6>Sarika Jain</h6>
                                            <span class="fs-14">UI/UX Designer</span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary">Unmute</a>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-lg me-2">
                                            <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="">
                                        </span>
                                        <div>
                                            <h6>Clyde Smith</h6>
                                            <span class="fs-14">Web Developer</span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary">Unmute</a>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-lg me-2">
                                            <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="">
                                        </span>
                                        <div>
                                            <h6>Carla Jenkins</h6>
                                            <span class="fs-14">Business Analyst</span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary">Unmute</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Mute User -->

<!-- Delete  Account -->
<div class="modal fade" id="delete-account">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Account</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('index')}}">
                    <div class="block-wrap mb-3">
                        <h6 class="fs-16">Are you sure you want to delete your account? </h6>
                        <p class="text-grya-9">
                            This action is irreversible and all your data will be permanently deleted.
                        </p>
                    </div>
                    <div class="mb-3">
                        <ul>
                            <li class="d-flex align-items-center fs-16 mb-2">
                                <i class="ti ti-arrow-badge-right me-2 fs-20 text-primary"></i>
                                Delete your account info and profile photo
                            </li>
                            <li class="d-flex align-items-center fs-16 mb-2">
                                <i class="ti ti-arrow-badge-right me-2 fs-20 text-primary"></i>
                                Delete you from all dreamschat groups
                            </li>
                            <li class="d-flex fs-16 mb-2">
                                <i class="ti ti-arrow-badge-right me-2 fs-20 text-primary"></i>
                                Delete your message history on this phone and your icloud backup
                            </li>
                        </ul>
                    </div>
                    <div class="d-flex mb-3">
                        <div>
                            <input type="checkbox" class="me-2">
                        </div>
                        <div>
                            <p class="text-grya-9">
                                I understand that deleting my account is irreversible and all my data will be permanently deleted.
                            </p>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Delete Account -->

<!-- Logout -->
<div class="modal fade" id="acc-logout">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Logout</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('index')}}">
                    <div class="block-wrap text-center mb-3">
                        <span class="user-icon mb-3 mx-auto bg-transparent-danger">
                            <i class="ti ti-logout text-danger"></i>
                        </span>
                        <p class="text-grya-9">Are you sure you want to logout? </p>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Logout</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Logout -->

@endif

@if(Route::is(['my-status']))
<!-- view-status -->
<div class="modal fade" id="view-status">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Status Viewed</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('my-status')}}">
                    <div class="contact-scroll contact-select">
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Edward Lietz</h6>
                                    <p>App Developer</p>
                                </div>
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Sarika Jain</h6>
                                    <p>UI/UX Designer</p>
                                </div>
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Clyde Smith</h6>
                                    <p>Web Developer</p>
                                </div>
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Carla Jenkins</h6>
                                    <p>Business Analyst</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /view-status -->

<!-- Add Status -->
<div class="modal fade" id="new-status">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Status</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="file-drop mb-4">
                    <form action="#" class="dropzone dz-clickable drag-and-drop-block  d-flex align-items-center justify-content-center mb-3">
                        <div class="text-center">
                            <img src="{{URL::asset('/build/img/icons/drag-file.svg')}}" class="mb-2" alt="upload">
                            <p class="text-gray-9 mb-2 fw-semibold">Drag & drop your files here or choose file</p>
                            <span class="text-gray-9 d-block">Maximum size: 50MB</span>
                        </div>
                    </form>
                </div>
                <div class="row g-3">
                    <div class="col-6">
                        <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                    </div>
                    <div class="col-6">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#upload-file-image" class="btn btn-primary w-100">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Add Status -->
<!-- Status -->
<div class="modal fade" id="upload-file-image">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Status</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body chat">

                <div class="row">
                    <div class="col-md-12">
                        <div class="drag-and-drop-block status-view p-3 mb-3">
                            <img src="{{URL::asset('/build/img/status/status-01.jpg')}}" class="status-preview" alt="upload">
                        </div>

                    </div>

                </div>
                <div class="chat-footer">
                    <div class="footer-form">
                        <div class="chat-footer-wrap">
                            <div class="form-item">
                                <a href="#" class="action-circle"><i class="ti ti-microphone"></i></a>
                            </div>
                            <div class="form-wrap">
                                <input type="text" class="form-control" placeholder="Type Your Message">
                            </div>
                            <div class="form-item emoj-action-foot">
                                <a href="#" class="action-circle"><i class="ti ti-mood-smile"></i></a>
                                <div class="emoj-group-list-foot down-emoji-circle">
                                    <ul>
                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-02.svg')}}" alt="Icon"></a></li>
                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-05.svg')}}" alt="Icon"></a></li>
                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-06.svg')}}" alt="Icon"></a></li>
                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-07.svg')}}" alt="Icon"></a></li>
                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-08.svg')}}" alt="Icon"></a></li>
                                        <li class="add-emoj"><a href="javascript:void(0);"><i class="ti ti-plus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="form-item">
                                <a href="#" data-bs-toggle="dropdown">
                                    <i class="ti ti-dots-vertical"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end p-3">
                                    <a href="#" class="dropdown-item "><span><i class="ti ti-file-text"></i></span>Document</a>
                                    <a href="#" class="dropdown-item"><span><i class="ti ti-camera-selfie"></i></span>Camera</a>
                                    <a href="#" class="dropdown-item"><span><i class="ti ti-photo-up"></i></span>Gallery</a>
                                    <a href="#" class="dropdown-item"><span><i class="ti ti-music"></i></span>Audio</a>
                                    <a href="#" class="dropdown-item"><span><i class="ti ti-map-pin-share"></i></span>Location</a>
                                    <a href="#" class="dropdown-item"><span><i class="ti ti-user-check"></i></span>Contact</a>
                                </div>
                            </div>
                            <div class="form-btn">
                                <a class="btn btn-primary" href="{{url('user-status')}}">
                                    <i class="ti ti-send"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Status -->
<!-- Mute User -->
<div class="modal fade" id="mute-user">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Blocked User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('index')}}">
                    <div class="link-item mb-3">
                        <input type="text" class="form-control border-0" placeholder="Search For Muted Users ">
                        <span class="input-group-text"><i class="ti ti-search"></i></span>
                    </div>
                    <h6 class="mb-3 fs-16">RMuted User</h6>
                    <div class="mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-lg me-2">
                                            <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="">
                                        </span>
                                        <div>
                                            <h6>Aaryian Jose</h6>
                                            <span class="fs-14">App Developer</span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary">Unmute</a>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-lg me-2">
                                            <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="">
                                        </span>
                                        <div>
                                            <h6>Sarika Jain</h6>
                                            <span class="fs-14">UI/UX Designer</span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary">Unmute</a>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-lg me-2">
                                            <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="">
                                        </span>
                                        <div>
                                            <h6>Clyde Smith</h6>
                                            <span class="fs-14">Web Developer</span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary">Unmute</a>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-lg me-2">
                                            <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="">
                                        </span>
                                        <div>
                                            <h6>Carla Jenkins</h6>
                                            <span class="fs-14">Business Analyst</span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary">Unmute</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Mute User -->

<!-- Delete  Account -->
<div class="modal fade" id="delete-account">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Account</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('index')}}">
                    <div class="block-wrap mb-3">
                        <h6 class="fs-16">Are you sure you want to delete your account? </h6>
                        <p class="text-grya-9">
                            This action is irreversible and all your data will be permanently deleted.
                        </p>
                    </div>
                    <div class="mb-3">
                        <ul>
                            <li class="d-flex align-items-center fs-16 mb-2">
                                <i class="ti ti-arrow-badge-right me-2 fs-20 text-primary"></i>
                                Delete your account info and profile photo
                            </li>
                            <li class="d-flex align-items-center fs-16 mb-2">
                                <i class="ti ti-arrow-badge-right me-2 fs-20 text-primary"></i>
                                Delete you from all dreamschat groups
                            </li>
                            <li class="d-flex fs-16 mb-2">
                                <i class="ti ti-arrow-badge-right me-2 fs-20 text-primary"></i>
                                Delete your message history on this phone and your icloud backup
                            </li>
                        </ul>
                    </div>
                    <div class="d-flex mb-3">
                        <div>
                            <input type="checkbox" class="me-2">
                        </div>
                        <div>
                            <p class="text-grya-9">
                                I understand that deleting my account is irreversible and all my data will be permanently deleted.
                            </p>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Delete Account -->

<!-- Logout -->
<div class="modal fade" id="acc-logout">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Logout</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('index')}}">
                    <div class="block-wrap text-center mb-3">
                        <span class="user-icon mb-3 mx-auto bg-transparent-danger">
                            <i class="ti ti-logout text-danger"></i>
                        </span>
                        <p class="text-grya-9">Are you sure you want to logout? </p>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Logout</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Logout -->


@endif
@if(Route::is(['status']))
<!-- Add Status -->
<div class="modal fade" id="new-status">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Status</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="file-drop mb-4">
                    <form action="#" class="dropzone dz-clickable drag-and-drop-block  d-flex align-items-center justify-content-center mb-3">
                        <div class="text-center">
                            <img src="{{URL::asset('/build/img/icons/drag-file.svg')}}" class="mb-2" alt="upload">
                            <p class="text-gray-9 mb-2 fw-semibold">Drag & drop your files here or choose file</p>
                            <span class="text-gray-9 d-block">Maximum size: 50MB</span>
                        </div>
                    </form>
                </div>
                <div class="row g-3">
                    <div class="col-6">
                        <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                    </div>
                    <div class="col-6">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#upload-file-image" class="btn btn-primary w-100">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Add Status -->


<!-- Status -->
<div class="modal fade" id="upload-file-image">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Status</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body chat">

                <div class="row">
                    <div class="col-md-12">
                        <div class="drag-and-drop-block status-view p-3 mb-3">
                            <img src="{{URL::asset('/build/img/status/status-01.jpg')}}" class="status-preview" alt="upload">
                        </div>

                    </div>

                </div>
                <div class="chat-footer">
                    <div class="footer-form">
                        <div class="chat-footer-wrap">
                            <div class="form-item">
                                <a href="#" class="action-circle"><i class="ti ti-microphone"></i></a>
                            </div>
                            <div class="form-wrap">
                                <input type="text" class="form-control" placeholder="Type Your Message">
                            </div>
                            <div class="form-item emoj-action-foot">
                                <a href="#" class="action-circle"><i class="ti ti-mood-smile"></i></a>
                                <div class="emoj-group-list-foot down-emoji-circle">
                                    <ul>
                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-02.svg')}}" alt="Icon"></a></li>
                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-05.svg')}}" alt="Icon"></a></li>
                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-06.svg')}}" alt="Icon"></a></li>
                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-07.svg')}}" alt="Icon"></a></li>
                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-08.svg')}}" alt="Icon"></a></li>
                                        <li class="add-emoj"><a href="javascript:void(0);"><i class="ti ti-plus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="form-item">
                                <a href="#" data-bs-toggle="dropdown">
                                    <i class="ti ti-dots-vertical"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end p-3">
                                    <a href="#" class="dropdown-item "><span><i class="ti ti-file-text"></i></span>Document</a>
                                    <a href="#" class="dropdown-item"><span><i class="ti ti-camera-selfie"></i></span>Camera</a>
                                    <a href="#" class="dropdown-item"><span><i class="ti ti-photo-up"></i></span>Gallery</a>
                                    <a href="#" class="dropdown-item"><span><i class="ti ti-music"></i></span>Audio</a>
                                    <a href="#" class="dropdown-item"><span><i class="ti ti-map-pin-share"></i></span>Location</a>
                                    <a href="#" class="dropdown-item"><span><i class="ti ti-user-check"></i></span>Contact</a>
                                </div>
                            </div>
                            <div class="form-btn">
                                <a class="btn btn-primary" href="{{url('user-status')}}">
                                    <i class="ti ti-send"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Status -->
<!-- Add Contact -->
<div class="modal fade" id="add-contact">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Contact</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('index')}}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">First Name</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-user"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Last Name</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-user"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-mail"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-phone"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Date of Birth</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control datetimepicker">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-calendar-event"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Website Address</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-globe"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="card border">
                                <div class="card-header border-bottom">
                                    <h6>Social Information</h6>
                                </div>
                                <div class="card-body pb-1">
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <label class="form-label text-default fw-normal mb-3">Facebook</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-icon position-relative mb-3">
                                                <input type="text" class="form-control">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-brand-facebook"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label text-default fw-normal mb-3">Twitter</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-icon position-relative mb-3">
                                                <input type="text" class="form-control">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-brand-twitter"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-labe text-default fw-normall mb-3">Instagram</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-icon position-relative mb-3">
                                                <input type="text" class="form-control">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-brand-instagram"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label text-default fw-normal mb-3">Linked in</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-icon position-relative mb-3">
                                                <input type="text" class="form-control">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-brand-linkedin"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label text-default fw-normal mb-3">YouTube</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-icon position-relative mb-3">
                                                <input type="text" class="form-control">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-brand-youtube"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Add Contact</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add Contact -->

<!-- Add Call -->
<div class="modal fade" id="new-call">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Call</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('all-calls')}}">
                    <div class="search-wrap contact-search mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search">
                            <a href="javascript:void(0);" class="input-group-text"><i class="ti ti-search"></i></a>
                        </div>
                    </div>
                    <h6 class="mb-3 fw-medium fs-16">Contacts</h6>
                    <div class="contact-scroll contact-select mb-3">
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Edward Lietz</h6>
                                    <p>App Developer</p>
                                </div>
                            </div>
                            <div class="d-inline-flex">
                                <a href="" class="model-icon bg-light d-flex justify-content-center align-items-center rounded-circle me-2" data-bs-toggle="modal" data-bs-target="#voice_call"><span><i class="ti ti-phone"></i></span></a>
                                <a href="" class="model-icon bg-light d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="modal" data-bs-target="#video-call"><span><i class="ti ti-video"></i></span></a>
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Sarika Jain</h6>
                                    <p>UI/UX Designer</p>
                                </div>
                            </div>
                            <div class="d-inline-flex">
                                <a href="" class="model-icon bg-light d-flex justify-content-center align-items-center rounded-circle me-2" data-bs-toggle="modal" data-bs-target="#voice_call"><span><i class="ti ti-phone"></i></span></a>
                                <a href="" class="model-icon bg-light d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="modal" data-bs-target="#video-call"><span><i class="ti ti-video"></i></span></a>
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Clyde Smith</h6>
                                    <p>Web Developer</p>
                                </div>
                            </div>
                            <div class="d-inline-flex">
                                <a href="" class="model-icon bg-light d-flex justify-content-center align-items-center rounded-circle me-2" data-bs-toggle="modal" data-bs-target="#voice_call"><span><i class="ti ti-phone"></i></span></a>
                                <a href="" class="model-icon bg-light d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="modal" data-bs-target="#video-call"><span><i class="ti ti-video"></i></span></a>
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Carla Jenkins</h6>
                                    <p>Business Analyst</p>
                                </div>
                            </div>
                            <div class="d-inline-flex">
                                <a href="" class="model-icon bg-light d-flex justify-content-center align-items-center rounded-circle me-2" data-bs-toggle="modal" data-bs-target="#voice_call"><span><i class="ti ti-phone"></i></span></a>
                                <a href="" class="model-icon bg-light d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="modal" data-bs-target="#video-call"><span><i class="ti ti-video"></i></span></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add Call -->

<!-- Edit Contact -->
<div class="modal fade" id="edit-contact">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Contact</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('index')}}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">First Name</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control" value="Aaryian">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-user"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Last Name</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control" value="Jose">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-user"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-mail"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control" value="+20-482-038-29">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-phone"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Date of Birth</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control datetimepicker" value="03-09-1999">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-calendar-event"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Website Address</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control" value="www.examplewebsite.com">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-globe"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="card border">
                                <div class="card-header border-bottom">
                                    <h6>Social Information</h6>
                                </div>
                                <div class="card-body pb-1">
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <label class="form-label text-default fw-normal mb-3">Facebook</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-icon position-relative mb-3">
                                                <input type="text" class="form-control" value="www.facebook.com">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-brand-facebook"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label text-default fw-normal mb-3">Twitter</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-icon position-relative mb-3">
                                                <input type="text" class="form-control" value="www.twitter.com">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-brand-twitter"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-labe text-default fw-normall mb-3">Instagram</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-icon position-relative mb-3">
                                                <input type="text" class="form-control" value="www.instagram.com">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-brand-instagram"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label text-default fw-normal mb-3">Linked in</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-icon position-relative mb-3">
                                                <input type="text" class="form-control" value="www.linkedin.com">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-brand-linkedin"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label text-default fw-normal mb-3">YouTube</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-icon position-relative mb-3">
                                                <input type="text" class="form-control" value="www.youtube.com">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-brand-youtube"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Add Contact</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Edit Contact -->

<!-- Contact Detail -->
<div class="modal fade" id="contact-details">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Contact Detail</h4>
                <div class="d-flex align-items-center">
                    <div class="dropdown me-2">
                        <a class="d-block" href="#" data-bs-toggle="dropdown">
                            <i class="ti ti-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end p-3">
                            <li><a class="dropdown-item" href="#"><i class="ti ti-share-3 me-2"></i>Share</a></li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit-contact"><i class="ti ti-edit me-2"></i>Edit</a></li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#block-user"><i class="ti ti-ban me-2"></i>Block</a></li>
                            <li><a class="dropdown-item" href="#"><i class="ti ti-trash me-2"></i>Delete</a></li>
                        </ul>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <div class="card bg-light shadow-none">
                    <div class="card-body pb-1">
                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                            <div class="d-flex align-items-center mb-3">
                                <span class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="img">
                                </span>
                                <div class="ms-2">
                                    <h6>Aaryian Jose</h6>
                                    <p>App Developer</p>
                                </div>
                            </div>
                            <div class="contact-actions d-flex align-items-center mb-3">
                                <a href="{{url('chat')}}" class="me-2"><i class="ti ti-message"></i></a>
                                <a href="javascript:void(0);" class="me-2" data-bs-toggle="modal" data-bs-target="#voice_call"><i class="ti ti-phone"></i></a>
                                <a href="javascript:void(0);" class="me-2" data-bs-toggle="modal" data-bs-target="#video-call"><i class="ti ti-video"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card border mb-3">
                    <div class="card-header border-bottom">
                        <h6>Personal Information</h6>
                    </div>
                    <div class="card-body pb-1">
                        <div class="mb-2">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-clock-hour-4 me-1"></i>Local Time</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">10:00 AM</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-calendar-event me-1"></i>Date of Birth</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">22 July 2024</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-phone me-1"></i>Phone Number</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">+20-482-038-29</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-mail me-1"></i>Email</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">aariyan@example.com</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-globe me-1"></i>Website Address</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">www.examplewebsite.com</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card border mb-0">
                    <div class="card-header border-bottom">
                        <h6>Social Information</h6>
                    </div>
                    <div class="card-body pb-1">
                        <div class="mb-2">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-brand-facebook me-1"></i>Facebook</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">www.facebook.com</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-brand-twitter me-1"></i>Twitter</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">www.twitter.com</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-brand-instagram me-1"></i>Instagram</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">www.instagram.com</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-brand-linkedin me-1"></i>Linkedin</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">www.linkedin.com</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-brand-youtube me-1"></i>YouTube</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">www.youtube.com</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Contact Detail -->

<!-- Invite -->
<div class="modal fade" id="invite">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Invite Others</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="#">
                    <div class="row">
                        <div class="col-lg-12">
                            <label class="form-label">Email Address or Phone Number</label>
                            <div class="input-icon mb-3 position-relative">
                                <input type="text" value="" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label">Invitation Message</label>
                            <textarea class="form-control mb-3"></textarea>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#new-chat">Send Invitation</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Invite -->

<!-- New Chat -->
<div class="modal fade" id="new-chat">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Chat</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('index')}}">
                    <div class="search-wrap contact-search mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search">
                            <a href="javascript:void(0);" class="input-group-text"><i class="ti ti-search"></i></a>
                        </div>
                    </div>
                    <h6 class="mb-3 fw-medium fs-16">Contacts</h6>
                    <div class="contact-scroll contact-select mb-3">
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Aaryian Jose</h6>
                                    <p>App Developer</p>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contact">
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Sarika Jain</h6>
                                    <p>UI/UX Designer</p>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contact">
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Clyde Smith</h6>
                                    <p>Web Developer</p>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contact">
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Carla Jenkins</h6>
                                    <p>Business Analyst</p>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contact">
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Start Chat</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /New Chat -->

<!-- Delete Chat -->
<div class="modal fade" id="delete-chat">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Chat</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('chat')}}">
                    <div class="block-wrap text-center mb-3">
                        <span class="user-icon mb-3 mx-auto bg-transparent-danger">
                            <i class="ti ti-trash text-danger"></i>
                        </span>
                        <p class="text-grya-9">Clearing or deleting entire chats will only remove messages from this device and your devices on the newer versions of DreamsChat.</p>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Delete Chat -->

<!-- Voice Call -->
<div class="modal fade" id="voice_call">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header justify-content-center border-0">
                <span class="model-icon bg-primary d-flex justify-content-center align-items-center rounded-circle me-2">
                    <i class="ti ti-phone-call"></i>
                </span>
                <h4 class="modal-title">Audio Calling...</h4>
            </div>
            <div class="modal-body pb-0">
                <div class="card bg-light mb-0">
                    <div class="card-body d-flex justify-content-center">
                        <div>
                            <span class="avatar avatar-xxl">
                                <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="user">
                            </span>
                            <h6 class="fs-14">Edward Lietz</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0">
                <a href="javascript:void(0);" class="voice-icon btn btn-success rounded-circle d-flex justify-content-center align-items-center me-2" data-bs-toggle="modal" data-bs-target="#voice_attend">
                    <i class="ti ti-phone fs-20"></i>
                </a>
                <a href="javascript:void(0);" class="voice-icon btn btn-danger rounded-circle d-flex justify-content-center align-items-center" data-bs-dismiss="modal" aria-label="close">
                    <i class="ti ti-phone-off fs-20"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- /Voice Call -->

<!-- Voice Call attend -->
<div class="modal fade" id="voice_attend" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex border-0 pb-0">
                <div class="card bg-transparent-dark flex-fill border mb-3">
                    <div class="card-body d-flex justify-content-between p-3 flex-wrap row-gap-3">
                        <div class="d-flex align-items-center">
                            <span class="avatar avatar-lg online me-2">
                                <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="user">
                            </span>
                            <div>
                                <h6>Edward Lietz</h6>
                                <span>+22-555-345-11</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="badge border border-primary  text-primary badge-sm me-2">
                                <i class="ti ti-point-filled"></i>
                                01:15:25
                            </span>
                            <a href="javascript:void(0);" class="user-add bg-primary rounded d-flex justify-content-center align-items-center text-white" data-bs-toggle="modal" data-bs-target="#voice_group">
                                <i class="ti ti-user-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body border-0 pt-0">
                <div class="card audio-crd bg-transparent-dark border">
                    <div class="modal-bgimg">
                        <span class="modal-bg1">
                            <img src="{{URL::asset('/build/img/bg/bg-02.png')}}" class="img-fluid" alt="bg">
                        </span>
                        <span class="modal-bg2">
                            <img src="{{URL::asset('/build/img/bg/bg-03.png')}}" class="img-fluid" alt="bg">
                        </span>
                    </div>
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-center align-items-center pt-5">
                            <span class="avatar avatar-xxxl bg-soft-primary rounded-circle p-2">
                                <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="user">
                            </span>

                        </div>
                        <div class="d-flex align-items-end justify-content-end">
                            <span class="call-span border border-2 border-primary d-flex justify-content-center align-items-center rounded">
                                <span class="avatar avatar-xl bg-soft-primary rounded-circle p-2">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-17.jpg')}}" class="rounded-circle" alt="user">
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0 pt-0">
                <div class="call-controll-block d-flex align-items-center justify-content-center rounded-pill">
                    <a href="javascript:void(0);" class="call-controll mute-bt d-flex align-items-center justify-content-center">
                        <i class="ti ti-microphone"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-volume"></i>
                    </a>
                    <a href="javascript:void(0);" data-bs-dismiss="modal" class="call-controll call-decline d-flex align-items-center justify-content-center">
                        <i class="ti ti-phone"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-maximize"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-dots"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Voice Call attend -->

<!-- Voice Call group -->
<div class="modal fade" id="voice_group" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex border-0 pb-0">
                <div class="card bg-transparent-dark flex-fill border mb-3">
                    <div class="card-body d-flex justify-content-between p-3">
                        <div class="row justify-content-between flex-fill row-gap-3">
                            <div class="col-lg-5">
                                <div class="d-flex justify-content-between align-items-center flex-wrap row-gap-2">
                                    <h3>Weekly Report Call</h3>

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="d-flex justify-content-start align-items-center">
                                    <span class="badge border border-primary  text-primary badge-sm me-3">
                                        <i class="ti ti-point-filled"></i>
                                        01:15:25
                                    </span>
                                    <a href="javascript:void(0);" data-bs-toggle="modal" class="badge badge-danger badge-sm">Leave</a>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex">
                                        <span class="user-add bg-primary d-flex justify-content-center align-items-center rounded-circle me-2">
                                            6
                                        </span>
                                        <a href="javascript:void(0);" class="user-add bg-primary rounded d-flex justify-content-center align-items-center text-white">
                                            <i class="ti ti-user-plus"></i>
                                        </a>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="layout-tab d-flex justify-content-center ">
                                            <div class="nav nav-pills inner-tab " id="pills-tab2" role="tablist">
                                                <div class="nav-item me-0" role="presentation">
                                                    <a href="#" class="nav-link bg-white text-gray p-0 fs-16 me-2" id="pills-single1-tab" data-bs-toggle="pill"
                                                        data-bs-target="#pills-single1" role="tab" aria-controls="pills-single1"
                                                        aria-selected="false" tabindex="-1">
                                                        <i class="ti ti-square"></i>
                                                    </a>
                                                </div>
                                                <div class="nav-item" role="presentation">
                                                    <a href="#" class="nav-link active bg-white text-gray p-0 fs-16" id="pills-group1-tab" data-bs-toggle="pill"
                                                        data-bs-target="#pills-group1" role="tab" aria-controls="pills-group1"
                                                        aria-selected="false" tabindex="-1">
                                                        <i class="ti ti-layout-grid"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body border-0 pt-0">
                <div class="tab-content dashboard-tab">
                    <div class="tab-pane fade" id="pills-single1" role="tabpanel" aria-labelledby="pills-single1-tab">
                        <div class="card audio-crd bg-transparent-dark border">
                            <div class="modal-bgimg">
                                <span class="modal-bg1">
                                    <img src="{{URL::asset('/build/img/bg/bg-02.png')}}" class="img-fluid" alt="bg">
                                </span>
                                <span class="modal-bg2">
                                    <img src="{{URL::asset('/build/img/bg/bg-03.png')}}" class="img-fluid" alt="bg">
                                </span>
                            </div>
                            <div class="card-body p-3">
                                <div class="single-img d-flex justify-content-center align-items-center">
                                    <span class=" avatar avatar-xxxl bg-soft-primary rounded-circle p-2">
                                        <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="user">
                                    </span>
                                </div>
                                <div class="d-flex align-items-end justify-content-end">
                                    <span class="call-span border border-2 border-primary d-flex justify-content-center align-items-center rounded">
                                        <span class="avatar avatar-xxl bg-soft-primary rounded-circle p-2">
                                            <img src="{{URL::asset('/build/img/profiles/avatar-17.jpg')}}" class="rounded-circle" alt="user">
                                        </span>
                                    </span>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="tab-pane fade active show" id="pills-group1" role="tabpanel" aria-labelledby="pills-group1-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card audio-crd bg-transparent-dark border border-primary pt-4">
                                    <div class="modal-bgimg">
                                        <span class="modal-bg1">
                                            <img src="{{URL::asset('/build/img/bg/bg-02.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                        <span class="modal-bg2">
                                            <img src="{{URL::asset('/build/img/bg/bg-03.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                    </div>
                                    <div class="card-body ">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <span class="avatar avatar-xxxl bg-soft-primary rounded-circle p-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="user">
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-end">
                                            <span class="badge badge-info">Edwin</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card audio-crd bg-transparent-dark border pt-4">
                                    <div class="modal-bgimg">
                                        <span class="modal-bg1">
                                            <img src="{{URL::asset('/build/img/bg/bg-02.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                        <span class="modal-bg2">
                                            <img src="{{URL::asset('/build/img/bg/bg-03.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                    </div>
                                    <div class="card-body ">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <span class="avatar avatar-xxxl bg-soft-primary rounded-circle p-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="user">
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-end">
                                            <span class="badge badge-info">Edwin</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card audio-crd bg-transparent-dark border pt-4">
                                    <div class="modal-bgimg">
                                        <span class="modal-bg1">
                                            <img src="{{URL::asset('/build/img/bg/bg-02.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                        <span class="modal-bg2">
                                            <img src="{{URL::asset('/build/img/bg/bg-03.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                    </div>
                                    <div class="card-body ">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <span class="avatar avatar-xxxl bg-soft-primary rounded-circle p-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="user">
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-end">
                                            <span class="badge badge-info">Edwin</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card audio-crd bg-transparent-dark border pt-4">
                                    <div class="modal-bgimg">
                                        <span class="modal-bg1">
                                            <img src="{{URL::asset('/build/img/bg/bg-02.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                        <span class="modal-bg2">
                                            <img src="{{URL::asset('/build/img/bg/bg-03.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                    </div>
                                    <div class="card-body ">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <span class="avatar avatar-xxxl bg-soft-primary rounded-circle p-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="user">
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-end">
                                            <span class="badge badge-info">Edwin</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card audio-crd bg-transparent-dark border pt-4">
                                    <div class="modal-bgimg">
                                        <span class="modal-bg1">
                                            <img src="{{URL::asset('/build/img/bg/bg-02.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                        <span class="modal-bg2">
                                            <img src="{{URL::asset('/build/img/bg/bg-03.png')}}" class="img-fluid" alt="bg">
                                        </span>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <span class="avatar avatar-xxxl bg-soft-primary rounded-circle p-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-05.jpg')}}" class="rounded-circle" alt="user">
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-end">
                                            <span class="badge badge-info">Edwin</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0 pt-0">
                <div class="call-controll-block d-flex align-items-center justify-content-center rounded-pill">
                    <a href="javascript:void(0);" class="call-controll mute-bt d-flex align-items-center justify-content-center">
                        <i class="ti ti-microphone"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-volume"></i>
                    </a>
                    <a href="javascript:void(0);" data-bs-dismiss="modal" class="call-controll call-decline d-flex align-items-center justify-content-center">
                        <i class="ti ti-phone"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-maximize"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-dots"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Voice Call group -->

<!-- Video Call -->
<div class="modal fade" id="video-call">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header justify-content-center border-0">
                <span class="model-icon bg-primary d-flex justify-content-center align-items-center rounded-circle me-2">
                    <i class="ti ti-video"></i>
                </span>
                <h4 class="modal-title">Video Calling...</h4>
            </div>
            <div class="modal-body pb-0">
                <div class="card bg-light mb-0">
                    <div class="card-body d-flex justify-content-center">
                        <div>
                            <span class="avatar avatar-xxl">
                                <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="user">
                            </span>
                            <h6 class="fs-14">Edward Lietz</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0">
                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#start-video-call" class="voice-icon btn btn-success rounded-circle d-flex justify-content-center align-items-center me-2">
                    <i class="ti ti-phone fs-20"></i>
                </a>
                <a href="javascript:void(0);" class="voice-icon btn btn-danger rounded-circle d-flex justify-content-center align-items-center" data-bs-dismiss="modal" aria-label="close">
                    <i class="ti ti-phone-off fs-20"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- /Video Call -->

<div class="modal video-call-popup fade" id="start-video-call" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex border-0 pb-0">
                <div class="card bg-transparent-dark flex-fill border">
                    <div class="card-body d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <span class="avatar avatar-lg online me-2">
                                <img src="{{URL::asset('/build/img/profiles/avatar-05.jpg')}}" class="rounded-circle" alt="user">
                            </span>
                            <div>
                                <h6>Federico Wells</h6>
                                <span>+22-555-345-11</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="badge border border-primary  text-primary badge-sm me-2">
                                <i class="ti ti-point-filled"></i>
                                01:15:25
                            </span>
                            <a href="javascript:void(0);" class="user-add bg-primary rounded d-flex justify-content-center align-items-center text-white" data-bs-toggle="modal" data-bs-target="#video_group">
                                <i class="ti ti-user-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body border-0 pt-0">
                <div class="video-call-view br-8 overflow-hidden position-relative">
                    <img src="{{URL::asset('/build/img/video/video-member-01.jpg')}}" alt="user-image">
                    <div class="mini-video-view active br-8 overflow-hidden position-absolute">
                        <img src="{{URL::asset('/build/img/video/user-image.jpg')}}" alt="">
                        <div class="bg-soft-primary mx-auto default-profile rounded-circle align-items-center justify-content-center">
                            <span class="avatar  avatar-lg rounded-circle bg-primary ">RG</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0 pt-0">
                <div class="call-controll-block d-flex align-items-center justify-content-center rounded-pill">
                    <a href="javascript:void(0);" class="call-controll mute-bt d-flex align-items-center justify-content-center">
                        <i class="ti ti-microphone"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-volume"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll mute-video d-flex align-items-center justify-content-center">
                        <i class="ti ti-video"></i>
                    </a>
                    <a href="javascript:void(0);" data-bs-dismiss="modal" class="call-controll call-decline d-flex align-items-center justify-content-center">
                        <i class="ti ti-phone"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-mood-smile"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-maximize"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-dots"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Video Call group -->
<div class="modal fade" id="video_group" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header d-flex border-0 pb-0">
                <div class="card bg-transparent-dark flex-fill border mb-3">
                    <div class="card-body d-flex justify-content-between p-3">
                        <div class="row justify-content-between flex-fill row-gap-3">
                            <div class="col-lg-5 col-sm-12">
                                <div class="d-flex justify-content-between align-items-center row-gap-2">
                                    <h3>Weekly Report Call</h3>

                                </div>
                            </div>
                            <div class="col-lg-5 col-sm-12">
                                <div class="d-flex justify-content-start align-items-center">
                                    <span class="badge border border-primary  text-primary badge-sm me-3">
                                        <i class="ti ti-point-filled"></i>
                                        01:15:25
                                    </span>
                                    <a href="javascript:void(0);" data-bs-toggle="modal" class="badge badge-danger badge-sm">Leave</a>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-12">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex">
                                        <span class="user-add bg-primary d-flex justify-content-center align-items-center rounded-circle me-2">
                                            6
                                        </span>
                                        <a href="javascript:void(0);" class="user-add bg-primary rounded d-flex justify-content-center align-items-center text-white">
                                            <i class="ti ti-user-plus"></i>
                                        </a>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="layout-tab d-flex justify-content-center ">
                                            <div class="nav nav-pills inner-tab " id="pills-tab3" role="tablist">
                                                <div class="nav-item me-0" role="presentation">
                                                    <a href="#" class="nav-link bg-white text-gray p-0 fs-16 me-2" id="pills-single2-tab" data-bs-toggle="pill" data-bs-target="#pills-single2" role="tab" aria-controls="pills-single2" aria-selected="false" tabindex="-1">
                                                        <i class="ti ti-square"></i>
                                                    </a>
                                                </div>
                                                <div class="nav-item" role="presentation">
                                                    <a href="#" class="nav-link active bg-white text-gray p-0 fs-16" id="pills-group2-tab" data-bs-toggle="pill" data-bs-target="#pills-group2" role="tab" aria-controls="pills-group2" aria-selected="false" tabindex="-1">
                                                        <i class="ti ti-layout-grid"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body border-0 pt-0">
                <div class="tab-content dashboard-tab">
                    <div class="tab-pane fade" id="pills-single2" role="tabpanel" aria-labelledby="pills-single2-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="video-call-view br-8 overflow-hidden position-relative">
                                    <img src="{{URL::asset('/build/img/video/video-member-01.jpg')}}" alt="user-image">
                                    <div class="mini-video-view active br-8 overflow-hidden position-absolute">
                                        <img src="{{URL::asset('/build/img/video/user-image.jpg')}}" alt="">
                                        <div class="bg-soft-primary mx-auto default-profile rounded-circle align-items-center justify-content-center">
                                            <span class="avatar  avatar-lg rounded-circle bg-primary ">RG</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade active show" id="pills-group2" role="tabpanel" aria-labelledby="pills-group2-tab">
                        <div class="row row-gap-4">
                            <div class="col-md-6 d-flex">
                                <div class="video-call-view br-8 overflow-hidden flex-fill">
                                    <img src="{{URL::asset('/build/img/video/video-member-02.jpg')}}" alt="user-image">
                                </div>
                            </div>
                            <div class="col-md-6 d-flex">
                                <div class="video-call-view br-8 overflow-hidden flex-fill">
                                    <img src="{{URL::asset('/build/img/video/video-member-03.jpg')}}" alt="user-image">
                                </div>
                            </div>
                            <div class="col-md-4 d-flex">
                                <div class="video-call-view br-8 overflow-hidden flex-fill">
                                    <img src="{{URL::asset('/build/img/video/video-member-05.jpg')}}" alt="user-image">
                                </div>
                            </div>
                            <div class="col-md-4 d-flex">
                                <div class="video-call-view br-8 overflow-hidden flex-fill">
                                    <img src="{{URL::asset('/build/img/video/video-member-04.jpg')}}" alt="user-image">
                                </div>
                            </div>
                            <div class="col-md-4 d-flex">
                                <div class="video-call-view br-8 overflow-hidden default-mode d-flex align-items-center  flex-fill">
                                    <div class="bg-soft-primary mx-auto default-profile rounded-circle d-flex align-items-center justify-content-center">
                                        <span class="avatar  avatar-lg rounded-circle bg-primary ">RG</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer justify-content-center border-0">
                    <div class="call-controll-block d-flex align-items-center justify-content-center rounded-pill">
                        <a href="javascript:void(0);" class="call-controll mute-bt d-flex align-items-center justify-content-center">
                            <i class="ti ti-microphone"></i>
                        </a>
                        <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                            <i class="ti ti-volume"></i>
                        </a>
                        <a href="javascript:void(0);" class="call-controll mute-video d-flex align-items-center justify-content-center">
                            <i class="ti ti-video"></i>
                        </a>
                        <a href="javascript:void(0);" data-bs-dismiss="modal" class="call-controll call-decline d-flex align-items-center justify-content-center">
                            <i class="ti ti-phone"></i>
                        </a>
                        <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                            <i class="ti ti-mood-smile"></i>
                        </a>
                        <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                            <i class="ti ti-maximize"></i>
                        </a>
                        <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                            <i class="ti ti-dots"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Video Call group -->

<!-- Block User -->
<div class="modal fade" id="block-user">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Block User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('index')}}">
                    <div class="block-wrap text-center mb-3">
                        <span class="user-icon mb-3 mx-auto bg-transparent-info">
                            <i class="ti ti-user-off text-info"></i>
                        </span>
                        <p class="text-grya-9">Blocked contacts will no longer be able to call you or send you messages.</p>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Block</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Block User -->

<!-- New Group -->
<div class="modal fade" id="new-group">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Group</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('index')}}">
                    <div class="d-flex justify-content-center align-items-center">
                        <label for="avatar-upload" class="set-pro avatar avatar-xxl rounded-circle mb-3 p-1">
                            <span class="avatar avatar-xl bg-transparent-dark rounded-circle"></span>
                            <span class="add avatar avatar-sm d-flex justify-content-center align-items-center">
                                <i class="ti ti-plus rounded-circle d-flex justify-content-center align-items-center"></i>
                            </span>
                        </label>
                        <input type="file" id="avatar-upload" style="display: none;" accept="image/*">
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label class="form-label">Group Name</label>
                            <div class="input-icon mb-3 position-relative">
                                <input type="text" value="" class="form-control" placeholder="First Name">
                                <span class="icon-addon">
                                    <i class="ti ti-users-group"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label">About</label>
                            <div class="input-icon mb-3 position-relative">
                                <input type="text" value="" class="form-control" placeholder="Last Name">
                                <span class="icon-addon">
                                    <i class="ti ti-info-octagon"></i>
                                </span>
                            </div>
                        </div>
                        <label class="form-label">Group Type</label>
                        <div class="d-flex">

                            <div class="form-check me-3">
                                <input class="form-check-input" type="radio" name="mute" id="mute1">
                                <label class="form-check-label" for="mute1">Public</label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="mute" id="mute2">
                                <label class="form-check-label" for="mute2">Private</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#add-group">Next</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /New Group -->

<!-- Add Group -->
<div class="modal fade" id="add-group">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Members</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('index')}}">
                    <div class="search-wrap contact-search mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search">
                            <a href="javascript:void(0);" class="input-group-text"><i class="ti ti-search"></i></a>
                        </div>
                    </div>
                    <h6 class="mb-3 fw-medium fs-16">Contacts</h6>
                    <div class="contact-scroll contact-select mb-3">
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Aaryian Jose</h6>
                                    <p>App Developer</p>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contact">
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Sarika Jain</h6>
                                    <p>UI/UX Designer</p>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contact">
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Clyde Smith</h6>
                                    <p>Web Developer</p>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contact">
                            </div>
                        </div>
                        <div class="contact-user d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="ms-2">
                                    <h6>Carla Jenkins</h6>
                                    <p>Business Analyst</p>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contact">
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#new-group">Previous</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Start Group</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add group -->

<!-- Mute User -->
<div class="modal fade" id="mute-user">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Muted User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('index')}}">
                    <div class="link-item mb-3">
                        <input type="text" class="form-control border-0" placeholder="Search For Muted Users ">
                        <span class="input-group-text"><i class="ti ti-search"></i></span>
                    </div>
                    <h6 class="mb-3 fs-16">Muted User</h6>
                    <div class="mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-lg me-2">
                                            <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="">
                                        </span>
                                        <div>
                                            <h6>Aaryian Jose</h6>
                                            <span class="fs-14">App Developer</span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary">Unmute</a>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-lg me-2">
                                            <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="">
                                        </span>
                                        <div>
                                            <h6>Sarika Jain</h6>
                                            <span class="fs-14">UI/UX Designer</span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary">Unmute</a>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-lg me-2">
                                            <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="">
                                        </span>
                                        <div>
                                            <h6>Clyde Smith</h6>
                                            <span class="fs-14">Web Developer</span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary">Unmute</a>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-lg me-2">
                                            <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="">
                                        </span>
                                        <div>
                                            <h6>Carla Jenkins</h6>
                                            <span class="fs-14">Business Analyst</span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary">Unmute</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Mute User -->

<!-- Delete  Account -->
<div class="modal fade" id="delete-account">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Account</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('index')}}">
                    <div class="block-wrap mb-3">
                        <h6 class="fs-16">Are you sure you want to delete your account? </h6>
                        <p class="text-grya-9">
                            This action is irreversible and all your data will be permanently deleted.
                        </p>
                    </div>
                    <div class="mb-3">
                        <ul>
                            <li class="d-flex align-items-center fs-16 mb-2">
                                <i class="ti ti-arrow-badge-right me-2 fs-20 text-primary"></i>
                                Delete your account info and profile photo
                            </li>
                            <li class="d-flex align-items-center fs-16 mb-2">
                                <i class="ti ti-arrow-badge-right me-2 fs-20 text-primary"></i>
                                Delete you from all dreamschat groups
                            </li>
                            <li class="d-flex fs-16 mb-2">
                                <i class="ti ti-arrow-badge-right me-2 fs-20 text-primary"></i>
                                Delete your message history on this phone and your icloud backup
                            </li>
                        </ul>
                    </div>
                    <div class="d-flex mb-3">
                        <div>
                            <input type="checkbox" class="me-2">
                        </div>
                        <div>
                            <p class="text-grya-9">
                                I understand that deleting my account is irreversible and all my data will be permanently deleted.
                            </p>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Delete Account -->

<!-- Logout -->
<div class="modal fade" id="acc-logout">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Logout</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('index')}}">
                    <div class="block-wrap text-center mb-3">
                        <span class="user-icon mb-3 mx-auto bg-transparent-danger">
                            <i class="ti ti-logout text-danger"></i>
                        </span>
                        <p class="text-grya-9">Are you sure you want to logout? </p>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Logout</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Logout -->

@endif
@if(Route::is(['user-status']))
<!-- Add Status -->
<div class="modal fade" id="new-status">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Status</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="file-drop mb-4">
                    <form action="#" class="dropzone dz-clickable drag-and-drop-block  d-flex align-items-center justify-content-center mb-3">
                        <div class="text-center">
                            <img src="{{URL::asset('/build/img/icons/drag-file.svg')}}" class="mb-2" alt="upload">
                            <p class="text-gray-9 mb-2 fw-semibold">Drag & drop your files here or choose file</p>
                            <span class="text-gray-9 d-block">Maximum size: 50MB</span>
                        </div>
                    </form>

                </div>
                <div class="row g-3">
                    <div class="col-6">
                        <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                    </div>
                    <div class="col-6">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#upload-file-image" class="btn btn-primary w-100">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Add Status -->
<!-- Status -->
<div class="modal fade" id="upload-file-image">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Status</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body chat">

                <div class="row">
                    <div class="col-md-12">
                        <div class="drag-and-drop-block status-view p-3 mb-3">
                            <img src="{{URL::asset('/build/img/status/status-01.jpg')}}" class="status-preview" alt="upload">
                        </div>

                    </div>

                </div>
                <div class="chat-footer">
                    <div class="footer-form">
                        <div class="chat-footer-wrap">
                            <div class="form-item">
                                <a href="#" class="action-circle"><i class="ti ti-microphone"></i></a>
                            </div>
                            <div class="form-wrap">
                                <input type="text" class="form-control" placeholder="Type Your Message">
                            </div>
                            <div class="form-item emoj-action-foot">
                                <a href="#" class="action-circle"><i class="ti ti-mood-smile"></i></a>
                                <div class="emoj-group-list-foot down-emoji-circle">
                                    <ul>
                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-02.svg')}}" alt="Icon"></a></li>
                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-05.svg')}}" alt="Icon"></a></li>
                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-06.svg')}}" alt="Icon"></a></li>
                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-07.svg')}}" alt="Icon"></a></li>
                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-08.svg')}}" alt="Icon"></a></li>
                                        <li class="add-emoj"><a href="javascript:void(0);"><i class="ti ti-plus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="form-item">
                                <a href="#" data-bs-toggle="dropdown">
                                    <i class="ti ti-dots-vertical"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end p-3">
                                    <a href="#" class="dropdown-item"><i class="ti ti-file-text me-2"></i>Document</a>
                                    <a href="#" class="dropdown-item"><i class="ti ti-camera-selfie me-2"></i>Camera</a>
                                    <a href="#" class="dropdown-item"><i class="ti ti-photo-up me-2"></i>Gallery</a>
                                    <a href="#" class="dropdown-item"><i class="ti ti-music me-2"></i>Audio</a>
                                    <a href="#" class="dropdown-item"><i class="ti ti-map-pin-share me-2"></i>Location</a>
                                    <a href="#" class="dropdown-item"><i class="ti ti-user-check me-2"></i>Contact</a>
                                </div>
                            </div>
                            <div class="form-btn">
                                <a class="btn btn-primary" href="{{url('user-status')}}">
                                    <i class="ti ti-send"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Status -->
<!-- Mute User -->
<div class="modal fade" id="mute-user">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Blocked User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('index')}}">
                    <div class="link-item mb-3">
                        <input type="text" class="form-control border-0" placeholder="Search For Muted Users ">
                        <span class="input-group-text"><i class="ti ti-search"></i></span>
                    </div>
                    <h6 class="mb-3 fs-16">RMuted User</h6>
                    <div class="mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-lg me-2">
                                            <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="">
                                        </span>
                                        <div>
                                            <h6>Aaryian Jose</h6>
                                            <span class="fs-14">App Developer</span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary">Unmute</a>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-lg me-2">
                                            <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="">
                                        </span>
                                        <div>
                                            <h6>Sarika Jain</h6>
                                            <span class="fs-14">UI/UX Designer</span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary">Unmute</a>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-lg me-2">
                                            <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="">
                                        </span>
                                        <div>
                                            <h6>Clyde Smith</h6>
                                            <span class="fs-14">Web Developer</span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary">Unmute</a>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-lg me-2">
                                            <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="">
                                        </span>
                                        <div>
                                            <h6>Carla Jenkins</h6>
                                            <span class="fs-14">Business Analyst</span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary">Unmute</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Mute User -->

<!-- Delete  Account -->
<div class="modal fade" id="delete-account">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Account</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('index')}}">
                    <div class="block-wrap mb-3">
                        <h6 class="fs-16">Are you sure you want to delete your account? </h6>
                        <p class="text-grya-9">
                            This action is irreversible and all your data will be permanently deleted.
                        </p>
                    </div>
                    <div class="mb-3">
                        <ul>
                            <li class="d-flex align-items-center fs-16 mb-2">
                                <i class="ti ti-arrow-badge-right me-2 fs-20 text-primary"></i>
                                Delete your account info and profile photo
                            </li>
                            <li class="d-flex align-items-center fs-16 mb-2">
                                <i class="ti ti-arrow-badge-right me-2 fs-20 text-primary"></i>
                                Delete you from all dreamschat groups
                            </li>
                            <li class="d-flex fs-16 mb-2">
                                <i class="ti ti-arrow-badge-right me-2 fs-20 text-primary"></i>
                                Delete your message history on this phone and your icloud backup
                            </li>
                        </ul>
                    </div>
                    <div class="d-flex mb-3">
                        <div>
                            <input type="checkbox" class="me-2">
                        </div>
                        <div>
                            <p class="text-grya-9">
                                I understand that deleting my account is irreversible and all my data will be permanently deleted.
                            </p>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Delete Account -->

<!-- Logout -->
<div class="modal fade" id="acc-logout">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Logout</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('index')}}">
                    <div class="block-wrap text-center mb-3">
                        <span class="user-icon mb-3 mx-auto bg-transparent-danger">
                            <i class="ti ti-logout text-danger"></i>
                        </span>
                        <p class="text-grya-9">Are you sure you want to logout? </p>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Logout</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Logout -->

@endif