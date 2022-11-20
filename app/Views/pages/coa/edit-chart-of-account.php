<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Edit Account
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Edit Account
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Edit Account
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

  <div class="col-lg-8 offset-lg-2">
    <div class="card">
      <div class="header">
        <h2> Edit Account</h2>
      </div>
      <a href="<?= site_url('/chart-of-accounts') ?>" class="btn btn-sm btn-primary float-right mb-3"> Chart of Accounts</a>
      <div class="body">
        <form id="addNewCoaForm" autocomplete="off" action="<?= site_url('/update-chart-of-account') ?>" method="POST" >
          <?= csrf_field() ?>
          <div class="form-group">
            <label for="">GL Code</label>
            <input type="number" placeholder="Enter Unique GL Code" id="gl_code" name="gl_code" class="form-control" value="<?= $account['glcode'] ?>">
            <div  class="alert alert-danger mt-2 p-2" id="gl_code_error">
            </div>
          </div>
          <div class="form-group">
            <label for="">Account Name</label>
            <input type="text" placeholder="Enter Account Name" id="account_name" name="account_name" value="<?= $account['account_name'] ?>" class="form-control">
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="">Account Type</label>
                <select name="account_type" id="account_type" class="form-control">
                  <option disabled selected>Select account type</option>
                  <option value="1" <?= $account['account_type'] == 1 ? 'selected' : '' ?> >Asset</option>
                  <option value="2" <?= $account['account_type'] == 2 ? 'selected' : '' ?> >Liability</option>
                  <option value="3" <?= $account['account_type'] == 3 ? 'selected' : '' ?> >Equity</option>
                  <option value="4" <?= $account['account_type'] == 4 ? 'selected' : '' ?> >Revenue</option>
                  <option value="5" <?= $account['account_type'] == 5 ? 'selected' : '' ?> >Expenses</option>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="">Type</label>
                <select name="type" id="type" class="form-control">
                  <option disabled selected>Select type</option>
                  <option value="0" <?= $account['type'] == 0 ? 'selected' : '' ?> >General</option>
                  <option value="1" <?= $account['type'] == 1 ? 'selected' : '' ?>>Detail</option>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="">Bank</label>
                <select name="bank" id="bank" class="form-control">
                  <option disabled selected>--Select--</option>
                  <option value="1" <?= $account['bank'] == 1 ? 'selected' : '' ?>>Yes</option>
                  <option value="0" <?= $account['bank'] == 0 ? 'selected' : '' ?>>No</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div  class="alert alert-danger mt-2 p-2" id="account_type_error">
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="">Parent Account</label>
                <div id="parentAccountWrapper"></div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="">Note</label>
            <input type="hidden" name="accountId" value="<?= $account['coa_id'] ?>">
            <textarea name="note" id="note" style="resize:none;" placeholder="Leave note..." class="form-control"><?= $account['note'] ?> </textarea>
          </div>
          <div class="form-group d-flex justify-content-center">
            <div class="btn-group ">
              <a href="" class="btn btn-mini btn-danger"><i class="ti-close mr-2"></i>Cancel</a>
              <button class="btn btn-mini btn-primary" type="submit" id="addNewAccountBtn"><i class="ti-check mr-2"></i> Save changes</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>
<script src="assets/bundles/vendorscripts.bundle.js"></script>

<script src="/assets/bundles/datatablescripts.bundle.js"></script>
<script src="/assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="/assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="/assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="/assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="/assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>
<script src="/assets/vendor/sweetalert/sweetalert.min.js"></script>
<script src="/assets/js/common.js"></script>
<script src="/assets/js/pages/tables/jquery-datatable.js"></script>
<script src="/assets/js/axios.min.js"></script>
<script src="/assets/js/toastify.min.js"></script>
<script>
  $(document).ready(function(){
    $('#gl_code_error').hide();
    $('#account_type_error').hide();
    $('#addNewAccountBtn').prop("disabled", true);
    $("#gl_code").blur(function () {
      var gl_code = $(this).val();
      gl_code = String(gl_code);
      var length  = gl_code.length;
      if(length%2 == 0){
        $('#gl_code_error').show();
        $('#gl_code_error').html("Length of account number should be odd");
        $('#addNewAccountBtn').prop("disabled", true);
      }
      else{
        $('#gl_code_error').hide();
        $('#addNewAccountBtn').prop("disabled", false);
      }

    });
    //Account type
    $(document).on('change', '#account_type', function(e){
      e.preventDefault();
      var account_type = $(this).val();

      switch (account_type) {
        case "1":
          if($('#gl_code').val().toString().charAt(0) != 1){
            $('#account_type_error').show();
            $("#account_type_error").html("Invalid GL code for this account type. Hint: First number should start with <strong>1</strong>");
            $('#addNewAccountBtn').prop("disabled", true);
          }else{
            $('#account_type_error').hide();
            $('#addNewAccountBtn').prop("disabled", false);
          }
          break;
        case "2":
          if($('#gl_code').val().toString().charAt(0) != 2){
            $('#account_type_error').show();
            $("#account_type_error").html("Invalid GL code for this account type. Hint: First number should start with <strong>2</strong>");
            $('#addNewAccountBtn').prop("disabled", true);
          }else{
            $('#account_type_error').hide();
            $('#addNewAccountBtn').prop("disabled", false);
          }
          break;
        case "3":
          if($('#gl_code').val().toString().charAt(0) != 3){
            $('#account_type_error').show();
            $("#account_type_error").html("Invalid GL code for this account type. Hint: First number should start with <strong>3</strong>");
            $('#addNewAccountBtn').prop("disabled", true);
          }else{
            $('#account_type_error').hide();
            $('#addNewAccountBtn').prop("disabled", false);
          }
          break;
        case "4":
          if($('#gl_code').val().toString().charAt(0) != 4){
            $('#account_type_error').show();
            $("#account_type_error").html("Invalid GL code for this account type. Hint: First number should start with <strong>4</strong>");
            $('#addNewAccountBtn').prop("disabled", true);
          }else{
            $('#account_type_error').hide();
            $('#addNewAccountBtn').prop("disabled", false);
          }
          break;
        case "5":
          if($('#gl_code').val().toString().charAt(0) != 5){
            $('#account_type_error').show();
            $("#account_type_error").html("Invalid GL code for this account type. Hint: First number should start with <strong>5</strong>");
            $('#addNewAccountBtn').prop("disabled", true);
          }else{
            $('#account_type_error').hide();
            $('#addNewAccountBtn').prop("disabled", false);
          }
          break;


      }
    });
    //type
    $(document).on('change', '#account_type', function(e){
      e.preventDefault();
      getParentAccount();
    });
  });

  function getParentAccount(){
    axios.get('/get-parent-account')
      .then(response=>{
        $('#parentAccountWrapper').html(response.data);
      });
  }
</script>
<?= $this->endSection() ?>
