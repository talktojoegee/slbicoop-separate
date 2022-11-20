<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Cash Payment Schedule
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Cash Payment Schedule
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Cash Payment Schedule
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
<link rel="stylesheet" href="assets/vendor/sweetalert/sweetalert.css"/>
<link rel="stylesheet" href="assets/css/toastify.min.css"/>

<!--<link rel="stylesheet" type="text/css" href="/assets/css/datatable.min.css"> -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Cash Payment Schedule</h2>
            </div>
            <div class="body">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12">
                      <div class="btn-group mb-3 float-left">
                        <button class="btn btn-secondary btn-sm">Go Back</button>
                        <button type="button" class="btn btn-success btn-sm" onclick="generatePDF()">Print</button>
                      </div>
                      <div id="printableArea">
                        <div class="table-responsive">
                          <table class="table table-bordered">
                            <tbody>

                            <tr>
                              <td class="text-nowrap" width="150">Bank Name</td>
                              <td><strong><?= $entry->bank_name ?? '' ?> </strong></td>
                              <td class="text-nowrap">Amount</td>
                              <td><strong>  <?= number_format($entry->entry_payment_amount,2) ?? '' ?></strong></td>

                            </tr>
                            <tr>
                              <td class="text-nowrap">Account No.</td>
                              <td><strong>  <?= $entry->account_no ?? '' ?></strong></td>
                              <td class="text-nowrap">Reference No.</td>
                              <td><strong>  <?= $entry->entry_payment_cheque_no ?? '' ?></strong></td>
                            </tr>
                            <tr>
                              <td class="text-nowrap">Branch</td>
                              <td><strong>  <?= $entry->branch ?? '' ?></strong></td>
                              <td class="text-nowrap">Payment Date</td>
                              <td><strong><?= date('d M, Y', strtotime($entry->entry_payment_payable_date)) ?></strong></td>
                            </tr>
                            <tr>
                              <td class="text-nowrap">Verified By:</td>
                              <td><strong>  <?= $verifiedBy->first_name ?? '' ?> <?= $verifiedBy->last_name ?? '' ?></strong></td>
                              <td class="text-nowrap">Approved By: </td>
                              <td><strong><?= $entry->entry_payment_approved_by ?></strong></td>
                            </tr>

                            </tbody>
                          </table>
                        </div>
                        <div class="col-lg-12 col-md-12">
                          <div class="header">
                            <h2>Schedule Detail</h2>
                          </div>
                          <?= csrf_field() ?>
                          <div class="table-responsive">
                            <table class="table table-bordered">
                              <tbody>
                              <tr>
                                <td><b>S/No</b></td>
                                <td><b>Name</b></td>
                                <td><b>Bank Detail</b></td>
                                <td><b>Amount</b></td>
                                <td><b>Account No.</b></td>
                                <td><b>Attachment</b></td>
                              </tr>
                              <?php $sn = 1; foreach ($entryDetails as $detail): ?>
                                <tr>
                                  <td><?=$sn; ?></td>
                                  <td><?=$detail->entry_payment_d_payee_name ?? '' ?></td>
                                  <td><?=$detail->entry_payment_d_bank_name ?? '' ?> <br> <small><?=$detail->entry_payment_d_account_no ?? '' ?></small> </td>
                                  <td class="text-right"><?= number_format($detail->entry_payment_d_amount ?? 0,2) ?></td>
                                  <td><?=$detail->entry_payment_d_account_no ?? '' ?></td>
                                  <td>
                                    <?php if(!is_null($detail->entry_attachment)) : ?>
                                      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#entryDetailModal_<?= $detail->entry_payment_d_detail_id ?>" >Download Attachment</button>
                                      <div class="modal fade" id="entryDetailModal_<?= $detail->entry_payment_d_detail_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel"><?= $detail->entry_payment_d_payee_name ?? '' ?>'s Attachment</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">

                                              <embed src="<?= site_url('assets/uploads/withdrawals/'.$detail->entry_attachment) ?>" frameborder="0" width="100%" height="400px">
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    <?php else: ?>
                                      No attachment
                                    <?php endif; ?>
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
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>
<script src="assets/bundles/vendorscripts.bundle.js"></script>

<script src="assets/vendor/sweetalert/sweetalert.min.js"></script><!-- SweetAlert Plugin Js -->
<script src="assets/js/common.js"></script>
<script src="assets/js/axios.min.js"></script>
<script src="assets/js/toastify.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.0/html2pdf.bundle.min.js"></script>
<script>
  function generatePDF(){
    const element = document.getElementById('printableArea');
    let fileName = generateId(11);
    html2pdf(element,{
      margin:       10,
      filename:     `${fileName}.pdf`,
      image:        { type: 'jpeg', quality: 0.98 },
      html2canvas:  { scale: 2, logging: true, dpi: 192, letterRendering: true },
      jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
    });
  }
  function dec2hex (dec) {
    return dec.toString(16).padStart(2, "0")
  }
  function generateId (len) {
    var arr = new Uint8Array((len || 40) / 2)
    window.crypto.getRandomValues(arr)
    return Array.from(arr, dec2hex).join('')
  }
</script>
<?= $this->endSection() ?>
