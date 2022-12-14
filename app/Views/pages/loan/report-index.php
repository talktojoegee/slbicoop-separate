<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Loan Report
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Loan Report
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Loan Report
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
                <h2>Loan Report</h2>
            </div>


            <div class="col-md-12">
            
				<div class="row clearfix">
					<div class="col-lg-4 col-md-6 col-sm-12">
						
						<div class="card">
							<a href="<?= site_url('/loan/report') ?>">
                                <div class="body">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-in-bg bg-indigo text-white rounded-circle"><i class="fa fa-check"></i></div>
                                        <div class="ml-4">
                                            <span>Approved Loan Report</span>								
                                        </div>
                                    </div>
                        
                                </div>
							</a>
				        </div>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-12">
						
						<div class="card">
							<a href="<?= site_url('/loan/index/disapproved-report') ?>">
                                <div class="body">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-in-bg bg-indigo text-white rounded-circle"><i class="fa fa-ban"></i></div>
                                        <div class="ml-4">
                                            <span>Disapproved Loan Report</span>								
                                        </div>
                                    </div>
                        
                                </div>
							</a>
				        </div>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-12">
						
						<div class="card">
							<a href="<?= site_url('/loan/index/disbursed-report') ?>">
                                <div class="body">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-in-bg bg-indigo text-white rounded-circle"><i class="fa fa-money"></i></div>
                                        <div class="ml-4">
                                            <span>Disbursed Loan Report</span>								
                                        </div>
                                    </div>
                        
                                </div>
							</a>
				        </div>
					</div>
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

<?= $this->endSection() ?>
