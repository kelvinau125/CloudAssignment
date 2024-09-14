<x-app-layout>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Students</h3>
                        <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have
                            <span class="text-primary">3000 unread alerts!</span>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card" id="weather_status">
                <div class="card tale-bg">
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
            <div class="col-md-6 grid-margin stretch-card" id="camera_qr" style="display:none">
                <div id="qr-reader" style="width: 100%;"></div>
                <div id="qr-reader-results"></div>
            </div>
            <div class="col-md-6 grid-margin transparent">
                <div class="row">
                    <a href="{{ route('module.index') }}" class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-tale">
                          <div class="card-body">
                            <p class="mb-4">To Join Quizz</p>
                            <p class="fs-30 mb-2"> <img style="width:10%;" src="images/dashboard/qr-code.png" alt=""> Module</p>
                            <!-- <p style="visibility: hidden;">10.00% (30 days)</p> -->
                          </div>
                        </div>
                      </a>
                      <a href="{{ route('review.index') }}" class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-dark-blue">
                          <div class="card-body">
                            <p class="mb-4">Give Review on the Module </p>
                            <p class="fs-30 mb-2">Review</p>
                            <!-- <p style="visibility: hidden;">22.00% (30 days)</p> -->
                          </div>
                        </div>
                      </a>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-light-danger">
                            <div class="card-body">
                                <a href="{{ route('profile.edit') }}">
                                    <p class="mb-4">Please Click</p>
                                    <p class="fs-30 mb-2">Account Settings</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-tale" onclick="startCamera();return false;">
                            <div class="card-body">
                                <p class="mb-4">Scan</p>
                                <p class="fs-30 mb-2"><img style="width:10%;" src="images/dashboard/qr-code.png" alt=""> QR Code</p>
                            </div>
                        </div>
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
            <!-- <video id="preview"></video> -->
        </footer>
        <!-- partial -->
    </div>


    <script type="text/javascript">
    function startCamera() {
        const qrCodeSuccessCallback = (decodedText, decodedResult) => {
            window.location.href = decodedText;
        };

        const qrCodeErrorCallback = (errorMessage) => {
            // Handle scan failure or errors
            console.log(`QR Code Scan Error: ${errorMessage}`);
        };

        // Start the QR code scanner
        let html5QrCode = new Html5Qrcode("qr-reader");
        document.querySelector("#weather_status").style.display = "none";
        document.querySelector("#camera_qr").style.display = "initial";
        // Camera configuration
        html5QrCode.start(
            { facingMode: "environment" }, // Use rear camera
            {
                fps: 10,
                qrbox: { width: 250, height: 250 }
            },
            qrCodeSuccessCallback,
            qrCodeErrorCallback
        ).catch(err => {
            console.error(`Unable to start the camera: ${err}`);
        });
    }
</script>
</x-app-layout>