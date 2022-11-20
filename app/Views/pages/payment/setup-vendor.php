<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Setup Vendor
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Setup Vendor
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Setup Vendor
<?= $this->endSection() ?>

<?= $this->section('extra-styles') ?>


<link rel="stylesheet" href="/assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css">
<link rel="stylesheet" href="/assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css">


<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row clearfix">
  <div class="col-lg-12">
    <div class="card">
      <div class="header">
        <h2>Setup Vendor</h2>
      </div>
      <div class="body">
          <div class="row">
            <?php $validation = \Config\Services::validation(); ?>
            <div class="col-md-12">
              <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                  <form enctype="multipart/form-data"  action="<?= site_url('/third-party/setup-vendor') ?>" id="thirdPartyPaymentEntryForm" autocomplete="off" method="POST" >
                    <?= csrf_field() ?>
                    <div class="row p-2 mb-2" style="background:#2D3541; margin-left: 0.3%; margin-right: 0.3%; margin-top: 1%">
                      <div class="col-md-12 col-lg-12">
                        <h6 class="text-uppercase text-white">Company Details</h6>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="">Company Name</label>
                          <input type="text"  name="companyName" id="companyName" placeholder="Company Name" class=" form-control">
                          <?php if($validation->getError('companyName')) {?>
                             <i class="text-danger"><?= $error = $validation->getError('companyName') ?></i>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="">Company Email</label>
                          <input type="email"  name="companyEmail" id="companyEmail" placeholder="Company Email" class=" form-control">
                          <?php if($validation->getError('companyEmail')) {?>
                            <i class="text-danger"><?= $error = $validation->getError('companyEmail') ?></i>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="">Phone No.</label>
                          <input type="text"  name="companyPhoneNo" id="phoneNo" placeholder="Phone Number" class=" form-control">
                          <?php if($validation->getError('companyPhoneNo')) {?>
                            <i class="text-danger"><?= $error = $validation->getError('companyPhoneNo') ?></i>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="">Website</label>
                          <input type="text"  name="website" id="" placeholder="Website" class=" form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="">Address</label>
                          <textarea   name="address" id="address" placeholder="Website" class=" form-control"></textarea>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for=""> GL Code</label>
                          <select  name="glCode" id="glCode" class="form-control ">
                            <option selected disabled>--Select --</option>
                            <?php foreach($coas as $coa) : ?>
                              <option value="<?= $coa['glcode'] ?>"><?= $coa['glcode'] ?? '' ?> - <?= $coa['account_name'] ?? '' ?></option>
                            <?php endforeach; ?>
                          </select>
                          <?php if($validation->getError('glCode')) {?>
                            <i class="text-danger"><?= $error = $validation->getError('glCode') ?></i>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for=""> Bank</label>
                          <select  name="bank" id="bank" class="form-control js-example-basic-single">
                            <option selected disabled>--Select --</option>
                            <?php foreach($banks as $bank) : ?>
                              <option value="<?= $bank->bank_id ?>"><?= $bank->bank_name ?? '' ?></option>
                            <?php endforeach; ?>
                          </select>
                          <?php if($validation->getError('bank')) {?>
                            <i class="text-danger"><?= $error = $validation->getError('bank') ?></i>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="">Bank Account No.</label>
                          <input type="number"  name="bankAccountNo" id="bankAccountNo" placeholder="Bank Account No." class=" form-control">
                          <?php if($validation->getError('bankAccountNo')) {?>
                            <i class="text-danger"><?= $error = $validation->getError('bankAccountNo') ?></i>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="">Sort Code</label>
                          <input class="form-control" placeholder="Sort Code" name="sortCode" id="sortCode">
                        </div>
                      </div>

                    </div>
                    <div class="row p-2 mb-2" style="background:#2D3541; margin-left: 0.3%; margin-right: 0.3%; margin-top: 1%">
                      <div class="col-md-12 col-lg-12">
                        <h6 class="text-uppercase text-white">Contact Person</h6>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="">First Name<sup class="text-danger">*</sup></label>
                          <input type="text" name="firstName"  placeholder="First Name" class="form-control">
                          <?php if($validation->getError('firstName')) {?>
                            <i class="text-danger"><?= $error = $validation->getError('firstName') ?></i>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="">Last Name <sup class="text-danger">*</sup></label>
                          <input type="text"  name="lastName" placeholder="Last Name" class="form-control">
                          <?php if($validation->getError('lastName')) {?>
                            <i class="text-danger"><?= $error = $validation->getError('lastName') ?></i>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="">Phone No.<sup class="text-danger">*</sup></label>
                          <input type="text"  name="phoneNo" placeholder="Phone No." class="form-control">
                          <?php if($validation->getError('phoneNo')) {?>
                            <i class="text-danger"><?= $error = $validation->getError('phoneNo') ?></i>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="">Email Address <sup class="text-danger">*</sup></label>
                          <input type="text"  name="emailAddress" placeholder="Email Address" class="form-control">
                          <?php if($validation->getError('emailAddress')) {?>
                            <i class="text-danger"><?= $error = $validation->getError('emailAddress') ?></i>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="">Position </label>
                          <input type="text" name="position" placeholder="Position" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="">Description </label>
                          <textarea style="resize: none;" name="description" placeholder="Description" class="form-control"></textarea>
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-md-12 d-flex justify-content-center col-sm-12 col-lg-12">
                        <div class="btn-group">
                          <a class="btn btn-danger btn-sm" href="">Cancel</a>
                          <button type="submit" name="submit" class="btn btn-primary btn-sm">Submit</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>



<?= $this->endSection() ?>
<?= $this->section('extra-scripts') ?>
<script src="/assets/bundles/vendorscripts.bundle.js"></script>
<script src="/assets/js/select2.min.js"></script>
<script src="/assets/vendor/sweetalert/sweetalert.min.js"></script><!-- SweetAlert Plugin Js -->
<script src="/assets/js/common.js"></script>
<script src="/assets/js/axios.min.js"></script>
<script src="/assets/js/toastify.min.js"></script>
<script src="/assets/js/parsley.min.js"></script>
<script>
  /*$(document).ready(function(){
    $('.js-example-basic-single').select2();
    $('#thirdPartyPaymentEntryForm').parsley().on('field:validated', function() {
      var ok = $('.parsley-error').length === 0;
      $('.bs-callout-info').toggleClass('hidden', !ok);
      $('.bs-callout-warning').toggleClass('hidden', ok);
    })
      .on('form:submit', function() {
        return true;
      });
  });*/
</script>
<?= $this->endSection() ?>


