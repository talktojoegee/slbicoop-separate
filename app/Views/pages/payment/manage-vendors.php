<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Manage Vendors
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Manage Vendors
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Manage Vendors
<?= $this->endSection() ?>

<?= $this->section('extra-styles') ?>


<link rel="stylesheet" href="assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css">
<link rel="stylesheet" href="assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css">


<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row clearfix">
  <div class="col-lg-12">
    <div class="card">
      <div class="header">
        <h2>Manage Vendors</h2>

      </div>
      <div class="body">
        <div class="table-responsive">
          <table class="table table-hover js-basic-example dataTable simpletable table-custom spacing5">
            <thead>
            <tr>
              <th>#</th>
              <th>Company Name</th>
              <th> Email</th>
              <th> Phone No. </th>
              <th> Contact Person </th>
              <th> GL</th>
              <th>Action</th>
            </tr>
            </thead>

            <tbody>
            <?php $sn = 1; foreach ($vendors as $vendor): ?>
              <tr>

                <td><?=$sn; ?></td>
                <td><?=$vendor->v_company_name ?? '' ?></td>
                <td><?=$vendor->v_company_email ?? '' ?></td>
                <td><?=$vendor->v_phone_no ?? '' ?></td>
                <td><?=$vendor->v_contact_first_name ?? '' ?> <?=$vendor->v_contact_last_name ?? '' ?></td>
                <td><?=$vendor->glcode ?? '' ?> - <?=$vendor->account_name ?? '' ?></td>
                <td>
                  <button class="btn btn-primary" data-toggle="modal" data-target="#vendorDetails_<?=$sn; ?>">View</button>
                  <div class="modal fade" id="vendorDetails_<?=$sn; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle">Vendor Details</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form enctype="multipart/form-data"  action="<?= site_url('/third-party/setup-vendor') ?>" id="thirdPartyPaymentEntryForm" autocomplete="off" method="POST" data-parsley-validate="">
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
                                  <input type="text" required name="companyName" value="<?=$vendor->v_company_name ?? '' ?>" placeholder="Company Name" class=" form-control">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="">Company Email</label>
                                  <input type="email" required name="companyEmail" value="<?=$vendor->v_company_email ?? '' ?>" placeholder="Company Email" class=" form-control">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="">Phone No.</label>
                                  <input type="text" required name="companyPhoneNo" value="<?=$vendor->v_phone_no ?? '' ?>" placeholder="Phone Number" class=" form-control">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="">Website</label>
                                  <input type="text"  name="website" value="<?=$vendor->v_website ?? '' ?>" placeholder="Website" class=" form-control">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for=""> GL Code</label>
                                  <select required name="glCode" id="glCode" class="form-control ">
                                    <option selected disabled>--Select --</option>
                                    <?php foreach($coas as $coa) : ?>
                                      <option value="<?= $coa['glcode'] ?>" <?=$vendor->v_gl_code == $coa['glcode'] ? 'selected' : '' ?> ><?= $coa['glcode'] ?? '' ?> - <?= $coa['account_name'] ?? '' ?></option>
                                    <?php endforeach; ?>
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="">Address</label>
                                  <textarea   name="address" value="<?=$vendor->v_address ?? '' ?>" placeholder="Website" class=" form-control"></textarea>
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
                                  <input type="text" name="firstName" value="<?=$vendor->v_contact_first_name ?? '' ?>" required placeholder="First Name" class="form-control">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="">Last Name <sup class="text-danger">*</sup></label>
                                  <input type="text" required value="<?=$vendor->v_contact_last_name ?? '' ?>" name="lastName" placeholder="Last Name" class="form-control">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="">Phone No.<sup class="text-danger">*</sup></label>
                                  <input type="text" required name="phoneNo" value="<?=$vendor->v_contact_phone_no ?? '' ?>" placeholder="Phone No." class="form-control">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="">Email Address <sup class="text-danger">*</sup></label>
                                  <input type="text" required name="emailAddress" value="<?=$vendor->v_contact_email ?? '' ?>" placeholder="Email Address" class="form-control">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="">Position </label>
                                  <input type="text" name="position" value="<?=$vendor->v_contact_position ?? '' ?>" placeholder="Position" class="form-control">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="">Description </label>
                                  <textarea style="resize: none;" name="description" placeholder="Description" class="form-control"><?=$vendor->v_contact_description ?? '' ?></textarea>
                                </div>
                              </div>
                            </div>
                            <hr>
                            <div class="row">
                              <div class="col-md-12 d-flex justify-content-center col-sm-12 col-lg-12">
                                <div class="btn-group">
                                  <a class="btn btn-danger btn-sm" href="">Cancel</a>
                                  <button type="submit" name="submit" class="btn btn-primary btn-sm">Save changes</button>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>

                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <?php $sn++; endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>



<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>
<script src="assets/bundles/vendorscripts.bundle.js"></script>
<script src="assets/vendor/jquery-validation/jquery.validate.js"></script><!-- Jquery Validation Plugin Css -->
<script src="assets/vendor/jquery-steps/jquery.steps.js"></script><!-- JQuery Steps Plugin Js -->
<script src="assets/js/common.js"></script>
<script src="assets/js/pages/forms/form-wizard.js"></script>
<script src="assets/vendor/dropify/js/dropify.js"></script>
<script src="assets/js/common.js"></script>

<script src="assets/bundles/datatablescripts.bundle.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>
<script>
  $(document).ready(function(){
    $('.simpletable').DataTable();
  });
</script>
<?= $this->endSection() ?>


