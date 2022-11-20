<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Departments 
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Departments 
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Departments 
<?= $this->endSection() ?>

<?= $this->section('extra-styles') ?>
<style>
    td.details-control {
        background: url('assets/images/details_open.png') no-repeat center center;
        cursor: pointer;
    }
    tr.shown td.details-control {
        background: url('assets/images/details_close.png') no-repeat center center;
    }
</style>


<link rel="stylesheet" href="assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css">
<link rel="stylesheet" href="assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css">
<link rel="stylesheet" href="assets/vendor/sweetalert/sweetalert.css"/>
<link rel="stylesheet" href="assets/css/toastify.min.css"/>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <div class="row clearfix">
        <div class="col-lg-3">
            <div class="card">
                <div class="header">
                    <h2> New Department</h2>

                </div>
                <div class="body">
                    <form id="addNewDepartmentForm">
                        <div class="form-group">
                            <label for="">Department Name</label>
                            <input type="text" placeholder="Enter Department Name" id="department_name" name="department_name" class="form-control">
                        </div>
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <div class="btn-group">
                                <a href="" class="btn btn-mini btn-danger"><i class="ti-close mr-2"></i>Cancel</a>
                                <button class="btn btn-mini btn-primary" type="submit"><i class="ti-check mr-2"></i> Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="card">
                <div class="header">
                    <h2>Departments</h2>

                </div>
                <div class="body">
                    <div class="table-responsive">
						<table class="table table-hover js-basic-example dataTable simpletable table-custom spacing5">
	
						<thead>
                            <tr>
                                <th>#</th>
                                <th>Department Name</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $i = 1; foreach($departments as $department) : ?>
                                <tr>
                                    <td><?= $i++ ?> </td>
                                    <td><?= $department['department_name'] ?></td>
                                    <td><?= date('d M, Y', strtotime($department['created_at'])) ?></td>
                                    <td>
                                      <a href="javascript:void(0);" class="editBank" data-target="#editBankModal_<?= $department['department_id'] ?>" data-bank="<?= $department['department_name']  ?>" data-bankid="<?= $department['department_id']  ?>" data-toggle="modal"> Edit</a>
                                      <div class="modal fade" id="editBankModal_<?= $department['department_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title">Edit Department</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              <form id="editLocationForm" method="post" action="<?= site_url('/update-department') ?>">
                                                <div class="form-group">
                                                  <label for="">Department Name</label>
                                                  <input type="text"  class="form-control" value="<?= $department['department_name'] ?>" name="department_name"  placeholder="Department Name">
                                                  <input type="hidden" name="departmentId" id="departmentId" value="<?= $department['department_id'] ?>">
                                                </div>
                                                <div class="form-group d-flex justify-content-center btn-group">
                                                  <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Close</button>
                                                  <button type="submit" class="btn btn-round btn-primary">Save changes</button>
                                                </div>
                                              </form>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>


<script src="assets/bundles/vendorscripts.bundle.js"></script>

<script src="assets/bundles/datatablescripts.bundle.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>
<script src="assets/vendor/sweetalert/sweetalert.min.js"></script><!-- SweetAlert Plugin Js -->
<script src="assets/js/common.js"></script>
<script src="assets/js/pages/tables/jquery-datatable.js"></script>
<script src="assets/js/axios.min.js"></script>
<script src="assets/js/toastify.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.simpletable').DataTable();

            $('.error-wrapper').hide();
            addNewDepartmentForm.onsubmit = async (e) => {
                e.preventDefault();

                axios.post('/add-new-department',new FormData(addNewDepartmentForm))
                .then(response=>{
                    Toastify({
                        text: "Success! New department saved.",
                        duration: 3000,
                        newWindow: true,
                        close: true,
                        gravity: "top",
                        position: 'right',
                        backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                        stopOnFocus: true,
                        onClick: function(){}
                    }).showToast();
                    $("#departmentTable").load(location.href + " #departmentTable");
                    $('#department_name').val('');
                })
                .catch(error=>{
                        //$('#validation-errors').html('');
                        $.each(error.response.data.errors, function(key, value){
                            Toastify({
                            text: 'Error',
                            duration: 3000,
                            newWindow: true,
                            close: true,
                            gravity: "top",
                            position: 'right',
                            backgroundColor: "linear-gradient(to right, #FF0000, #FE0000)",
                            stopOnFocus: true,
                            onClick: function(){}
                        }).showToast();
                        //$('#validation-errors').append("<li><i class='ti-hand-point-right text-danger mr-2'></i><small class='text-danger'>"+value+"</small></li>");
                    });
                });
            };
        });
    </script>
<?= $this->endSection() ?>
