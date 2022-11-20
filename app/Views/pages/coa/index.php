<?php
use App\Models\CoaModel;
$coa = new CoaModel();
?>
<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Chart of Accounts
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Chart of Accounts
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Chart of Accounts
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

<!--<link rel="stylesheet" type="text/css" href="/assets/css/datatable.min.css"> -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="row clearfix">

    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Chart of Accounts</h2>
            </div>
            <a href="<?= site_url('/add-new-chart-of-account') ?>" class="btn btn-sm btn-primary float-right mb-3">Add New Account</a>
            <div class="body">
                <div class="col-xs-12 col-sm-12">
                    <table id="complex-header" class="table table-bordered nowrap dataTable" role="grid" aria-describedby="complex-header_info" style="width: 100%; margin:0px auto;">
                        <thead>
                        <tr role="row">
                            <th class="sorting_asc text-left" tabindex="0" style="width: 50px;">S/No.</th>
                            <th class="sorting_asc text-left" tabindex="0" style="width: 50px;">ACCOUNT CODE</th>
                            <th class="sorting_asc text-left" tabindex="0" style="width: 150px;">ACCOUNT NAME</th>
                            <th class="sorting_asc text-left" tabindex="0" >PARENT</th>
                            <th class="sorting_asc text-left" tabindex="0" >TYPE</th>
                            <th class="sorting_asc text-left" tabindex="0" >EDIT</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $a = 1;
                        ?>
                        <tr role="row" class="odd">
                            <td class="sorting_1" colspan="6"><strong style="font-size:16px; text-transform:uppercase;">Assets</strong></td>
                        </tr>

                        <?php foreach ($assets_account_general as $report): ?>
                            <tr role="row" class="odd bg-secondary text-white">
                                <td class="text-left"><?= $a++ ?></td>
                                <td class="sorting_1 text-left"><?= $report['glcode'] ?? '' ?></td>
                                <td class="text-left"><?= $report['account_name'] ?? '' ?></td>
                                <td class="text-left"><?= $report['parent_account'] ?? '' ?></td>
                                <td class="text-left"><?= $report['type'] == 0 ? 'General' : 'Detail' ?></td>
                              <td>
                               -
                              </td>
                            </tr>

                            <?php $detailAccounts = $coa->where(['parent_account' => $report['glcode'], 'type'=> 1])->findAll();
                            foreach($detailAccounts as $detail):
                                ?>

                                <tr role="row" class="odd">
                                    <td class="text-left"><?= $a++ ?></td>
                                    <td class="sorting_1 text-left"><?= $detail['glcode'] ?? '' ?></td>
                                    <td class="text-left"><?= $detail['account_name'] ?? '' ?></td>
                                    <td class="text-left"><?= $detail['parent_account'] ?? '' ?></td>
                                    <td class="text-left"><?= $detail['type'] == 0 ? 'General' : 'Detail' ?></td>
                                  <td>
                                    <?php if(!in_array($detail['glcode'], $glCodes, true)): ?>
                                      <a href="<?= site_url('/edit-chart-of-account/'.$report['coa_id']) ?>" class="text-warning"> Edit</a> |
                                      <a href="javascript:void(0);" data-toggle="modal" data-target="#deleteModal_<?=$report['coa_id'] ?>" class="text-danger"> Delete</a>
                                      <div class="modal fade" id="deleteModal_<?=$report['coa_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLongTitle">Delete Account</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              <form action="<?= site_url('/delete-chart-of-account') ?>" method="post">
                                                <?= csrf_field() ?>
                                                <p>Are you sure you want to delete this account?</p>
                                                <input type="hidden" name="deleteAccount" value="<?= $report['coa_id'] ?>">
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                  <button type="submit" class="btn btn-primary">Delete</button>
                                                </div>
                                              </form>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    <?php endif; ?>
                                  </td>
                                </tr>
                            <?php endforeach; ?>



                        <?php endforeach; ?>
                        <tr role="row" class="odd">
                            <td class="sorting_1" colspan="6"><strong style="font-size:16px; text-transform:uppercase;">Liability</strong></td>
                        </tr>
                        <?php
                        $b = 1;
                        ?>

                        <?php foreach ($liability_account_general as $report): ?>
                            <tr role="row" class="odd bg-secondary text-white">
                                <td class="text-left"><?= $b++ ?></td>
                                <td class="sorting_1 text-left"><?= $report['glcode'] ?? '' ?></td>
                                <td class="text-left"><?= $report['account_name'] ?? '' ?></td>
                                <td class="text-left"><?= $report['parent_account'] ?? '' ?></td>
                                <td class="text-left"><?= $report['type'] == 0 ? 'General' : 'Detail' ?></td>
                              <td>
                                <a href="<?= site_url('/edit-chart-of-account/'.$report['coa_id']) ?>" class="text-warning">Edit</a>
                              </td>
                            </tr>

                            <?php $detailAccounts = $coa->where(['parent_account' => $report['glcode'], 'type'=> 1])->findAll();
                            foreach($detailAccounts as $detail):
                                ?>

                                <tr role="row" class="odd">
                                    <td class="text-left"><?= $b++ ?></td>
                                    <td class="sorting_1 text-left"><?= $detail['glcode'] ?? '' ?></td>
                                    <td class="text-left"><?= $detail['account_name'] ?? '' ?></td>
                                    <td class="text-left"><?= $detail['parent_account'] ?? '' ?></td>
                                    <td class="text-left"><?= $detail['type'] == 0 ? 'General' : 'Detail' ?></td>
                                  <td>
                                    <a href="<?= site_url('/edit-chart-of-account/'.$report['coa_id']) ?>" class="text-warning">Edit</a>
                                  </td>
                                </tr>
                            <?php endforeach; ?>



                        <?php endforeach; ?>








                        <tr role="row" class="odd">
                            <td class="sorting_1" colspan="6"><strong style="font-size:16px; text-transform:uppercase;">Equity</strong></td>
                        </tr>
                        <?php
                        $c = 1;
                        ?>

                        <?php foreach ($equity_account_general as $report): ?>
                            <tr role="row" class="odd bg-secondary text-white">
                                <td class="text-left"><?= $c++ ?></td>
                                <td class="sorting_1 text-left"><?= $report['glcode'] ?? '' ?></td>
                                <td class="text-left"><?= $report['account_name'] ?? '' ?></td>
                                <td class="text-left"><?= $report['parent_account'] ?? '' ?></td>
                                <td class="text-left"><?= $report['type'] == 0 ? 'General' : 'Detail' ?></td>
                              <td>
                                <a href="<?= site_url('/edit-chart-of-account/'.$report['coa_id']) ?>" class="text-warning">Edit</a>
                              </td>
                            </tr>

                            <?php $detailAccounts = $coa->where(['parent_account' => $report['glcode'], 'type'=> 1])->findAll();
                            foreach($detailAccounts as $detail):
                                ?>

                                <tr role="row" class="odd">
                                    <td class="text-left"><?= $c++ ?></td>
                                    <td class="sorting_1 text-left"><?= $detail['glcode'] ?? '' ?></td>
                                    <td class="text-left"><?= $detail['account_name'] ?? '' ?></td>
                                    <td class="text-left"><?= $detail['parent_account'] ?? '' ?></td>
                                    <td class="text-left"><?= $detail['type'] == 0 ? 'General' : 'Detail' ?></td>
                                  <td>
                                    <a href="<?= site_url('/edit-chart-of-account/'.$report['coa_id']) ?>" class="text-warning">Edit</a>
                                  </td>
                                </tr>
                            <?php endforeach; ?>



                        <?php endforeach; ?>




                        <tr role="row" class="odd">
                            <td class="sorting_1" colspan="6"><strong style="font-size:16px; text-transform:uppercase;">Revenue</strong></td>
                        </tr>
                        <?php
                        $d = 1;
                        ?>
                        <?php foreach ($revenue_account_general as $report): ?>
                            <tr role="row" class="odd bg-secondary text-white">
                                <td class="text-left"><?= $d++ ?></td>
                                <td class="sorting_1 text-left"><?= $report['glcode'] ?? '' ?></td>
                                <td class="text-left"><?= $report['account_name'] ?? '' ?></td>
                                <td class="text-left"><?= $report['parent_account'] ?? '' ?></td>
                                <td class="text-left"><?= $report['type'] == 0 ? 'General' : 'Detail' ?></td>
                              <td>
                                <a href="<?= site_url('/edit-chart-of-account/'.$report['coa_id']) ?>" class="text-warning">Edit</a>
                              </td>
                            </tr>

                            <?php $detailAccounts = $coa->where(['parent_account' => $report['glcode'], 'type'=> 1])->findAll();
                            foreach($detailAccounts as $detail):
                                ?>

                                <tr role="row" class="odd">
                                    <td class="text-left"><?= $d++ ?></td>
                                    <td class="sorting_1 text-left"><?= $detail['glcode'] ?? '' ?></td>
                                    <td class="text-left"><?= $detail['account_name'] ?? '' ?></td>
                                    <td class="text-left"><?= $detail['parent_account'] ?? '' ?></td>
                                    <td class="text-left"><?= $detail['type'] == 0 ? 'General' : 'Detail' ?></td>
                                  <td>
                                    <a href="<?= site_url('/edit-chart-of-account/'.$report['coa_id']) ?>" class="text-warning">Edit</a>
                                  </td>
                                </tr>
                            <?php endforeach; ?>



                        <?php endforeach; ?>

                        <tr role="row" class="odd">
                            <td class="sorting_1" colspan="6"><strong style="font-size:16px; text-transform:uppercase;">Expenses</strong></td>
                        </tr>
                        <?php
                        $e = 1;
                        ?>
                        <?php foreach ($expense_account_general as $report): ?>
                            <tr role="row" class="odd bg-secondary text-white">
                                <td class="text-left"><?= $e++ ?></td>
                                <td class="sorting_1 text-left"><?= $report['glcode'] ?? '' ?></td>
                                <td class="text-left"><?= $report['account_name'] ?? '' ?></td>
                                <td class="text-left"><?= $report['parent_account'] ?? '' ?></td>
                                <td class="text-left"><?= $report['type'] == 0 ? 'General' : 'Detail' ?></td>
                              <td>
                                <a href="<?= site_url('/edit-chart-of-account/'.$report['coa_id']) ?>" class="text-warning">Edit</a>
                              </td>
                            </tr>

                            <?php $detailAccounts = $coa->where(['parent_account' => $report['glcode'], 'type'=> 1])->findAll();
                            foreach($detailAccounts as $detail):
                                ?>

                                <tr role="row" class="odd">
                                    <td class="text-left"><?= $e++ ?></td>
                                    <td class="sorting_1 text-left"><?= $detail['glcode'] ?? '' ?></td>
                                    <td class="text-left"><?= $detail['account_name'] ?? '' ?></td>
                                    <td class="text-left"><?= $detail['parent_account'] ?? '' ?></td>
                                    <td class="text-left"><?= $detail['type'] == 0 ? 'General' : 'Detail' ?></td>
                                  <td>
                                    <a href="<?= site_url('/edit-chart-of-account/'.$report['coa_id']) ?>" class="text-warning">Edit</a>
                                  </td>
                                </tr>
                            <?php endforeach; ?>



                        <?php endforeach; ?>

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
        $(document).on('click', '.editLocation', function(e){
            e.preventDefault();
            var location = $(this).data('location');
            var id = $(this).data('locationid');
            $('#editLocation').val(location);
            $('#locationId').val(id);
        });
        addNewBankForm.onsubmit = async (e) => {
            e.preventDefault();

            axios.post('/add-new-bank',new FormData(addNewBankForm))
                .then(response=>{
                    Toastify({
                        text: "Success! Bank saved.",
                        duration: 3000,
                        newWindow: true,
                        close: true,
                        gravity: "top",
                        position: 'right',
                        backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                        stopOnFocus: true,
                        onClick: function(){}
                    }).showToast();
                    $("#bankTable").load(location.href + " #bankTable");
                    $('#bank_name').val('');
                    $('#sort_code').val('');
                })
                .catch(error=>{
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
        editLocationForm.onsubmit = async (e) => {
            e.preventDefault();

            axios.post('/edit-location',new FormData(editLocationForm))
                .then(response=>{
                    Toastify({
                        text: "Success! Changes saved.",
                        duration: 3000,
                        newWindow: true,
                        close: true,
                        gravity: "top",
                        position: 'right',
                        backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                        stopOnFocus: true,
                        onClick: function(){}
                    }).showToast();
                    $("#locationTable").load(location.href + " #locationTable");
                    $('#location_name').val('');
                    $('#editLocationModal').modal('hide');
                })
                .catch(error=>{
                    $.each(error.response.data.errors, function(key, value){
                        Toastify({
                            text: 'Ooops! Something went wrong.',
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
