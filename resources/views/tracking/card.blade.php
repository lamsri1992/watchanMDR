<div class="card-body">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-xl-4 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-muted mb-0">รายการติดตาม</h5>
                                    <span class="font-weight-bold mb-0 badge badge-info btn-block">ทั้งหมด {{ $track_all }} รายการ</span>
                                    <span class="font-weight-bold mb-0 badge badge-success btn-block">เสร็จสิ้น {{ $track_complete }} รายการ</span>
                                    <span class="font-weight-bold mb-0 badge badge-warning btn-block">คงค้าง {{ $track_all-$track_complete }} รายการ</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                                        <i class="fas fa-folder-open"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-muted mb-0">รายการเวชระเบียน</h5>
                                    <span class="font-weight-bold mb-0 badge badge-info btn-block">ทั้งหมด {{ $list_all }} รายการ</span>
                                    <span class="font-weight-bold mb-0 badge badge-success btn-block">เสร็จสิ้น {{ $list_complete }} รายการ</span>
                                    <span class="font-weight-bold mb-0 badge badge-warning btn-block">คงค้าง {{ $list_all-$list_complete }} รายการ</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                        <i class="fas fa-clipboard"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-muted mb-0">เวชระเบียนรอดำเนินการ</h5>
                                    <table class="table table-sm table-borderless">
                                        @foreach ($doctor as $doc)
                                        <span class="badge badge-info btn-block">นพ.ประจินต์ เหล่าเที่ยง {{ $doc->pj }} รายการ</span>
                                        <span class="badge badge-success btn-block">นพ.ชาติชาย เชวงชุติรัตน์ {{ $doc->cc }} รายการ</span>
                                        <span class="badge badge-warning btn-block">พญ.นัฐยา กิติกูล {{ $doc->nt }} รายการ</span>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                        <i class="fas fa-user-md"></i>
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