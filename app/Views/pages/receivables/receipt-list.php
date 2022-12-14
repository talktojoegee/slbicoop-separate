<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Receipt List
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Receipt List
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Receipt List
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
        <h2>Payment List</h2>

      </div>
      <div class="body">
        <div class="table-responsive">
          <table class="table table-hover js-basic-example dataTable simpletable table-custom spacing5">
            <thead>
            <tr>
              <th>#</th>
              <th>Customer Name</th>
              <th>Contact Person</th>
              <th>Trans. Date</th>
              <th> Amount </th>
              <th> Date Approved</th>
              <th> Bank</th>
            </tr>
            </thead>

            <tbody>
            <?php $sn = 1; foreach ($entries as $entry): ?>
              <tr>

                <td><?=$sn; ?></td>
                <td><?=$entry->customer_name ?? '' ?></td>
                <td><?=$entry->contact_person ?? '' ?></td>
                <td><?=!is_null($entry->cr_transaction_date) ? date('d-M-Y', strtotime($entry->cr_transaction_date)) : '-'?></td>
                <td class="text-right"><?= number_format($entry->cr_amount ?? 0,2) ?></td>
                <td><?=!is_null($entry->cr_date_approved) ? date('d-M-Y', strtotime($entry->cr_date_approved)) : '-'?></td>
                <td><?=$entry->bank_name ?? '' ?> - <?=$entry->account_no ?? '' ?></td>
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


