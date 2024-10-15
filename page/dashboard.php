	<style type="text/css">
   .home{
    margin:5px;
    padding: 10px;
     background: #DDD;
      color: #111;
      border-left: blue solid 5px;
      font-weight:35px;
   } 
  </style>
	<?php if (@$_SESSION['logged'] == 1): ?>
		<div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>150</h3>

                <p>New Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        <div class="callout-infout callout-info home">
          <h4>Selamat datang <?= $_SESSION['name'] ?></h4>

          <p>Sistem penilaian kinerja karyawan <b>UD Star Purnama</b></p>
        </div>
        <div class="row">
        <div class="col-xl-3 col-md-6">
                                  <div class="card bg-primary text-white mb-4">
                                      <div class="card-body">
                                          <h5>Total Barang Masuk</h5>
                                         
  
                                      </div>
                                      <div class="card-footer d-flex align-items-center justify-content-between">
                                          <a class="small text-white stretched-link" href="masuk.php">View Details</a>
                                          <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                      </div>
                                  </div>
                              </div>
        </div>
    <?php else: ?>
		<div class="callout-infout callout-info home">
          <h4>Selamat datang di E-Kinerja Karyawan</h4>

         <p>Sistem penilaian kinerja karyawan 
          <b>UD Star Purnama</b></p>
        </div>
    <?php endif; ?>

        