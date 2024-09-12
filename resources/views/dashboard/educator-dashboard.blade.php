<x-app-layout>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Educator</h3>
                        <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have
                            <span class="text-primary">3 unread alerts!</span>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <video id="video" style="visibility: hidden; width: 0%; height: 0%"></video>

                <div class="card tale-bg" id="weather_status" style="visibility: visible;">
                    <div class="card-people mt-auto">
                        <img src={{ asset('assets/images/dashboard/people.svg') }} alt="people">
                        <div class="weather-info">
                            <div class="d-flex">
                                <div>
                                    <h2 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>31<sup>C</sup></h2>
                                </div>
                                <div class="ml-2">
                                    <h4 class="location font-weight-normal">Kuala Lumpur</h4>
                                    <h6 class="font-weight-normal">Malaysia</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin transparent">
              <div class="row">
                <a href="{{ route('educator.module.index') }}" class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <p class="mb-4">Please Click</p>
                      <p class="fs-30 mb-2"> <img style="width:10%;" src="images/dashboard/qr-code.png" alt=""> View Module </p>
                      <p style="visibility: hidden;">10.00% (30 days)</p>
                    </div>
                  </div>
                </a>
                <a href="{{ route('progress.index') }}" class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <p class="mb-4">Please Click</p>
                      <p class="fs-30 mb-2">Student Progress</p>
                      <p style="visibility: hidden;">22.00% (30 days)</p>
                    </div>
                  </div>
                </a>
              </div>
                <div class="row">
                  <a href="{{ route('addQuestion') }}" class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-dark-blue">
                      <div class="card-body">
                        <p class="mb-4">Please Click</p>
                        <p class="fs-30 mb-2">Create Module</p>
                        <p style="visibility: hidden;">22.00% (30 days)</p>
                      </div>
                    </div>
                  </a>
                  <a href="{{ route('profile.edit') }}" class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-light-danger">
                      <div class="card-body">
                        <p class="mb-4">Please Click</p>
                        <p class="fs-30 mb-2">Account Settings</p>
                        <p style="visibility: hidden;">0.22% (30 days)</p>
                      </div>
                    </div>
                  </a>
                  </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright ©
                    2021.
                    Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin
                        template</a> from BootstrapDash. All rights reserved.</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted &
                    made
                    with <i class="ti-heart text-danger ml-1"></i></span>
            </div>
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Distributed by
                    <a href="https://www.themewagon.com/" target="_blank">Themewagon</a></span>
            </div>
            <!-- <video id="video" style="visibility: hidden; width: 0%; height: 0%"></video> -->
        </footer>
        <!-- partial -->
    </div>
</x-app-layout>
