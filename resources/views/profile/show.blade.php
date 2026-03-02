@extends('layouts.master')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="user-profile-header-banner">
        <img src="{{ asset('assets/img/pages/profile-banner.png') }}" alt="Banner image" class="rounded-top" width="100%" height="250" style="object-fit: cover;">
      </div>
      <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
        <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
          <img src="{{ asset('assets/img/avatars/1.png') }}" alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" style="width: 120px; border: 5px solid white; margin-top: -60px; position: relative; z-index: 1;">
        </div>
        <div class="flex-grow-1 mt-3 mt-sm-5">
          <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
            <div class="user-profile-info">
              <h4>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h4>
              <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                <li class="list-inline-item fw-medium"><i class="ti tabler-color-swatch"></i> Developer</li>
                <li class="list-inline-item fw-medium"><i class="ti tabler-map-pin"></i> {{ auth()->user()->address ?? 'Pakistan' }}</li>
                <li class="list-inline-item fw-medium"><i class="ti tabler-calendar"></i> Joined {{ auth()->user()->created_at->format('F Y') }}</li>
              </ul>
            </div>
            <a href="{{ route('profile.edit') }}" class="btn btn-primary">
              <i class="ti tabler-edit me-1"></i>Edit Profile
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <ul class="nav nav-pills flex-column flex-sm-row mb-4" role="tablist">
      <li class="nav-item">
        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-profile">
          <i class="ti-xs ti tabler-user-check me-1"></i> Profile
        </button>
      </li>
      <li class="nav-item">
        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-teams">
          <i class="ti-xs ti tabler-users me-1"></i> Teams
        </button>
      </li>
      <li class="nav-item">
        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-projects">
          <i class="ti-xs ti tabler-layout-grid me-1"></i> Projects
        </button>
      </li>
    </ul>
  </div>
</div>

<div class="tab-content p-0 bg-transparent shadow-none">
  
  <div class="tab-pane fade show active" id="navs-profile" role="tabpanel">
    <div class="row">
      <div class="col-xl-4 col-lg-5 col-md-5">
        <div class="card mb-4">
          <div class="card-body">
            <small class="card-text text-uppercase m-0">About</small>
            <ul class="list-unstyled mb-4 mt-3">
              <li class="d-flex align-items-center mb-3"><i class="ti tabler-user text-heading"></i><span class="fw-medium mx-2 text-heading">Full Name:</span> <span>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</span></li>
              <li class="d-flex align-items-center mb-3"><i class="ti tabler-check text-heading"></i><span class="fw-medium mx-2 text-heading">Status:</span> <span>Active</span></li>
              <li class="d-flex align-items-center mb-3"><i class="ti tabler-flag text-heading"></i><span class="fw-medium mx-2 text-heading">Country:</span> <span>Pakistan</span></li>
            </ul>
            <small class="card-text text-uppercase">Contacts</small>
            <ul class="list-unstyled mb-4 mt-3">
              <li class="d-flex align-items-center mb-3"><i class="ti tabler-phone-call text-heading"></i><span class="fw-medium mx-2 text-heading">Contact:</span> <span>{{ auth()->user()->phone ?? 'N/A' }}</span></li>
              <li class="d-flex align-items-center mb-3"><i class="ti tabler-mail text-heading"></i><span class="fw-medium mx-2 text-heading">Email:</span> <span>{{ auth()->user()->email }}</span></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="tab-pane fade" id="navs-teams" role="tabpanel">
    <div class="card">
      <div class="card-body text-center py-5">
        <i class="ti tabler-users text-muted mb-3" style="font-size: 3rem;"></i>
        <h5 class="card-title">My Teams</h5>
        <p class="card-text text-muted">Aap abhi tak kisi team ka hissa nahi hain.</p>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTeamModal">
          <i class="ti tabler-plus me-1"></i> Create Team
        </button>
      </div>
    </div>
  </div>

  <div class="tab-pane fade" id="navs-projects" role="tabpanel">
    <div class="card">
      <div class="card-body text-center py-5">
        <i class="ti tabler-layout-grid text-muted mb-3" style="font-size: 3rem;"></i>
        <h5 class="card-title">My Projects</h5>
        <p class="card-text text-muted">Aap ka abhi koi active project nahi hai.</p>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createProjectModal">
          <i class="ti tabler-plus me-1"></i> Add New Project
        </button>
      </div>
    </div>
  </div>

</div>


<div class="modal fade" id="createTeamModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Create a New Team</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('teams.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col mb-3">
              <label for="teamName" class="form-label">Team Name <span class="text-danger">*</span></label>
              <input type="text" id="teamName" name="name" class="form-control" placeholder="Enter team name" required>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label for="teamDescription" class="form-label">Description</label>
              <textarea id="teamDescription" name="description" class="form-control" placeholder="What is this team for?"></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Team</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="createProjectModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Add New Project</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('projects.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col mb-3">
              <label for="projectName" class="form-label">Project Title <span class="text-danger">*</span></label>
              <input type="text" id="projectName" name="title" class="form-control" placeholder="Enter project title" required>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label for="projectDeadline" class="form-label">Deadline</label>
              <input type="date" id="projectDeadline" name="deadline" class="form-control">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Project</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection