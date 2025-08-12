<?php $page = 'index'; ?>
@extends('layout.mainlayout')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.39.0/tabler-icons.min.css" rel="stylesheet">
<style>
  .kanban-filter .nav-link { padding: 6px 14px; border-radius: 8px; }
  .kanban-filter .nav-link.active { background: #eef4ff; color: #2662d9; }
  .todo-card { border: 1px solid #edf0f2; border-radius: 14px; }
  .todo-card .card-header { background: #fff; border-bottom: 0; }
  .todo-card .avatar-group img { width: 24px; height: 24px; border: 2px solid #fff; }
  .legend-dot { width: 10px; height: 10px; border-radius: 50%; display: inline-block; margin-right: 6px; }
  .legend-low { background: #2ecc71; }
  .legend-middle { background: #f1c40f; }
  .legend-high { background: #e74c3c; }
  .mini-card { border: 1px solid #edf0f2; border-radius: 12px; padding: 14px; background: #fff; }
  .section-title { font-size: 13px; letter-spacing: .06em; color: #6b7280; text-transform: uppercase; margin-bottom: 10px; }
</style>
<div class="content main_content">
  @include('Chats.chatsidebar')
  <div class="sidebar-group" style="width: 100%">
    <div class="tab-content">
      <div class="tab-pane fade active show" id="chat-menu">
        <div class="row g-3 p-3">
          <!-- Left rail -->
          <div class="col-12 col-lg-3">
            <div class="mini-card mb-3">
              <div class="section-title">Today Meeting</div>
              <div class="d-flex align-items-center gap-2">
                <span class="avatar avatar-md rounded-circle bg-light border"></span>
                <div>
                  <div class="fw-semibold">Meeting Title</div>
                  <div class="text-muted small">In 1 Hours</div>
                </div>
              </div>
            </div>
            <div class="mini-card mb-3">
              <div class="section-title">Today ToDo List</div>
              <div class="d-flex align-items-center gap-2">
                <span class="avatar avatar-md rounded-circle bg-light border"></span>
                <div>
                  <div class="fw-semibold">ToDo Title</div>
                  <div class="text-muted small">Expired in 2 Hours</div>
                </div>
              </div>
            </div>
            <div class="mini-card mb-3">
              <div class="section-title">Today Ending Tasks</div>
              <div class="d-flex align-items-center gap-2">
                <span class="avatar avatar-md rounded-circle bg-light border"></span>
                <div>
                  <div class="fw-semibold">Task Title</div>
                  <div class="text-muted small">Expired in 2 Hours</div>
                </div>
              </div>
            </div>
            <div class="mini-card">
              <div class="section-title">Current Active Chats</div>
              <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                  <span class="avatar avatar-md rounded-circle bg-primary text-white">MW</span>
                  <div>
                    <div class="fw-semibold">Mark Williams</div>
                    <div class="text-muted small">is typing…</div>
                  </div>
                </div>
                <div class="text-muted small">02:40 PM</div>
              </div>
            </div>
          </div>
          <!-- Center content -->
          <div class="col-12 col-lg-6">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <ul class="nav nav-pills kanban-filter">
                <li class="nav-item"><a class="nav-link active" href="#">All</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Private</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Shared</a></li>
              </ul>
              <div class="text-muted small">Priority Colors: <span class="legend-dot legend-low"></span>Low <span class="legend-dot legend-middle ms-2"></span>Middle <span class="legend-dot legend-high ms-2"></span>High</div>
            </div>
            <div class="row g-3">
              @for ($i = 0; $i < 6; $i++)
              <div class="col-12 col-md-6">
                <div class="card todo-card h-100">
                  <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-2">
                      <span class="avatar avatar-sm rounded-circle"><img src="{{ URL::asset('/build/img/profiles/avatar-01.jpg') }}" class="rounded-circle" alt=""></span>
                      <div class="small text-muted">Admin name</div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                      <span class="badge bg-light text-dark border">Private</span>
                      <div class="avatar-group">
                        <img class="rounded-circle" src="{{ URL::asset('/build/img/profiles/avatar-12.jpg') }}" alt="">
                        <img class="rounded-circle" src="{{ URL::asset('/build/img/profiles/avatar-14.jpg') }}" alt="">
                        <img class="rounded-circle" src="{{ URL::asset('/build/img/profiles/avatar-15.jpg') }}" alt="">
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="fw-semibold mb-1">Title of ToDo</div>
                    <div class="text-muted small mb-3">Here we will add the description of the ToDo. Only you is Superadmin ToDo.</div>
                    <div class="d-flex align-items-center flex-wrap gap-2">
                      <span class="badge bg-light text-dark border">Start: 22.10.2024</span>
                      <span class="badge bg-light text-dark border">Deliver: Today</span>
                      <span class="badge bg-success-subtle text-success border">Low</span>
                    </div>
                  </div>
                  <div class="card-footer bg-white border-0 pt-0 pb-3">
                    <button class="btn btn-sm btn-outline-primary">Need Count</button>
                  </div>
                </div>
              </div>
              @endfor
            </div>
          </div>
          <!-- Right rail -->
          <div class="col-12 col-lg-3">
            <div class="mini-card mb-3">
              <div class="section-title">Create New ToDo</div>
              <form action="#" method="post" onsubmit="return false;">
                <div class="mb-2">
                  <input type="text" class="form-control" placeholder="Type the Title">
                </div>
                <div class="mb-2">
                  <textarea class="form-control" rows="2" placeholder="Type the Title"></textarea>
                </div>
                <div class="row g-2 mb-2">
                  <div class="col"><input type="date" class="form-control" placeholder="Start Date"></div>
                  <div class="col"><input type="date" class="form-control" placeholder="Expired Date"></div>
                </div>
                <div class="mb-2">
                  <div class="d-flex gap-2 align-items-center flex-wrap">
                    <span class="legend-dot legend-low"></span>Low
                    <span class="legend-dot legend-middle ms-3"></span>Middle
                    <span class="legend-dot legend-high ms-3"></span>High
                  </div>
                </div>
                <div class="mb-2">
                  <div class="btn-group w-100">
                    <button type="button" class="btn btn-outline-secondary active">Private ToDo</button>
                    <button type="button" class="btn btn-outline-secondary">Shared ToDo</button>
                  </div>
                </div>
                <div class="mb-3">
                  <select class="form-select">
                    <option selected>Select the Member for shared ToDo</option>
                    <option>John Doe</option>
                    <option>Jane Doe</option>
                  </select>
                </div>
                <div class="mb-3 d-flex gap-2 flex-wrap">
                  <button class="btn btn-sm btn-outline-secondary">6 Hour</button>
                  <button class="btn btn-sm btn-outline-secondary">12 Hour</button>
                  <button class="btn btn-sm btn-outline-secondary">24 Hour</button>
                </div>
                <div class="d-grid">
                  <button class="btn btn-primary">Create</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection