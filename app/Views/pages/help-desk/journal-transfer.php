<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Journal Transfer Application 
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Journal Transfer Application
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Journal Transfer Application 
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
				<h2>Journal Transfer Application </h2>
			
			</div>
			<div class="body">
				<div class="table-responsive">
					<table class="table table-hover js-basic-example dataTable simpletable table-custom spacing5">
						<thead>
						<tr>
							<th>#</th>
							<th> Staff ID</th>
							<th> Staff Name</th>
							<th> Date</th>						
							<th> Status</th>
						</tr>
						</thead>
						<tbody>
                        <?php $i =1; foreach($journals as $close): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $close->cooperator_staff_id ?? '' ?></td>
                                <td><?= $close->cooperator_first_name ?? '' ?> <?= $close->cooperator_last_name ?? '' ?></td>
                                <td><?= date('d M, Y', strtotime($close->jtm_date)) ?></td>
                                <td>
                                    <?php if($close->jtm_status == 0) :  ?>
                                        Unverified
                                    <?php elseif($close->jtm_status == 1): ?>
                                        Verified
                                    <?php elseif($close->jtm_status == 2): ?>
                                        Approved
                                    <?php elseif($close->jtm_status == 3): ?>
                                        Discarded
                                    <?php elseif($close->jtm_status == 4): ?>
                                        Sheduled
                                    <?php elseif($close->jtm_status == 5): ?>
                                        Disbursed
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
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
