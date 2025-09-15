@extends('layout.dashboardLayout')
@section('body-section')
    <h2>Dashboard</h2>
     <div class="box">
              <div class="row">
                <div class="col-sm-3 mb-3 mb-sm-0">
                  <div class="card">
                    <a href="/course/view" class="btn">
                      <div class="card-body">
                        <img src="{{ asset('images/courses.jpg') }}" alt="" class="img-fluid" />
                        <h5 class="card-title">Courses</h5>
                      </div>
                    </a>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="card">
                    <a href="#" class="btn">
                      <div class="card-body">
                        <img src="{{ asset('images/modules.png') }}" alt="" class="img-fluid" />
                        <h5 class="card-title">Modules</h5>
                      </div>
                    </a>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="card">
                    <a href="#" class="btn">
                      <div class="card-body">
                        <img src="{{ asset('images/user.jpg') }}" alt="" class="img-fluid" />
                        <h5 class="card-title">Users</h5>
                      </div>
                    </a>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="card">
                    <a href="#" class="btn">
                      <div class="card-body">
                        <img src="{{ asset('images/logout.jpg') }}" alt="" class="img-fluid" />
                        <h5 class="card-title">Logout</h5>
                      </div>
                    </a>
                  </div>
                </div>

                <div class="col-sm-3 my-3 mb-sm-0">
                  <div class="card">
                    <a href="#" class="btn">
                      <div class="card-body">
                        <img src="{{ asset('images/courses.jpg') }}" alt="" class="img-fluid" />
                        <h5 class="card-title">Other</h5>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </div>
@endsection

@section('script')
<script>

</script>
@endsection