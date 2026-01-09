<!DOCTYPE html>
<?php
session_start();
include "login/ceksession.php";
?>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  
    <title>Arsip Surat Kota Samarinda </title>

    <link href="../assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../assets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <link href="../assets/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <link href="../assets/vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <link href="../assets/vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <link href="../assets/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <link href="../assets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="../assets/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <link href="../assets/vendors/starrr/dist/starrr.css" rel="stylesheet">
    <link rel="shortcut icon" href="../img/icon.ico">
    <link href="../assets/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php include("sidebarmenu.php"); ?>
        <?php include("header.php"); ?>  

        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Surat Masuk</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Surat Masuk ><small>Edit Surat Masuk</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form action="proses/proses_editsuratmasuk.php" method="post" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                      <?php
                      include '../koneksi/koneksi.php';
                      $id = mysqli_real_escape_string($db, $_GET['id_suratmasuk']);
                      $sql = "SELECT * FROM tb_suratmasuk WHERE id_suratmasuk='".$id."' AND (disposisi1='".$_SESSION['nama']."' OR disposisi2='".$_SESSION['nama']."' OR disposisi3='".$_SESSION['nama']."')";
                      $query = mysqli_query($db, $sql);
                      $data  = mysqli_fetch_array($query);
                      if (!$data) {
                        echo "<center><h2>Data tidak ditemukan atau Anda tidak berhak mengedit data ini.</h2></center>";
                        echo "<meta http-equiv='refresh' content='2;url=datasuratmasuk.php'>";
                        exit;
                      }
                      $tgl_masuk = date('m-d-Y H:i:s', strtotime($data['tanggalmasuk_suratmasuk']));
                      $tgl_surat = date('m-d-Y', strtotime($data['tanggalsurat_suratmasuk']));
                      $tgl_disp1 = date('m-d-Y H:i:s', strtotime($data['tanggal_disposisi1']));
                      $tgl_disp2 = date('m-d-Y H:i:s', strtotime($data['tanggal_disposisi2']));
                      $tgl_disp3 = date('m-d-Y H:i:s', strtotime($data['tanggal_disposisi3']));
                      ?>
                      <input type="hidden" name="id_suratmasuk" value="<?php echo $id;?>">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Masuk <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <div class='input-group date' id='myDatepicker4'>
                            <input value="<?php echo $tgl_masuk; ?>" type='text' id="tanggalmasuk_suratmasuk" name="tanggalmasuk_suratmasuk" class="form-control" required="required" readonly="readonly" />
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Kode Surat <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input value="<?php echo $data['kode_suratmasuk'];?>" type="text" onkeyup="validAngka(this)" id="kode_suratmasuk" name="kode_suratmasuk" maxlength="7" placeholder="Masukkan Kode Surat" class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nomor Urut <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input value="<?php echo $data['nomorurut_suratmasuk'];?>" type="text" onkeyup="validAngka(this)" id="nomorurut_suratmasuk" name="nomorurut_suratmasuk" maxlength="4" placeholder="Masukkan Nomor Urut Surat" class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nomor Surat <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input value="<?php echo $data['nomor_suratmasuk'];?>" type="text" id="nomor_suratmasuk" name="nomor_suratmasuk" maxlength="35" placeholder="Masukkan Nomor Surat" class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Surat <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <fieldset>
                            <div class="control-group">
                              <div class="controls">
                                <input value="<?php echo $tgl_surat; ?>" type="text" class="form-control has-feedback-left" id="single_cal3" name="tanggalsurat_suratmasuk" aria-describedby="inputSuccess2Status3" required="required" readonly="readonly">
                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                              </div>
                            </div>
                          </fieldset>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Pengirim <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input value="<?php echo $data['pengirim'];?>" type="text" id="pengirim" name="pengirim" placeholder="Masukkan Asal/Pengirim Surat" class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Kepada <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input value="<?php echo $data['kepada_suratmasuk'];?>" type="text" id="kepada_suratmasuk" name="kepada_suratmasuk" placeholder="Masukkan Tujuan Surat" class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Perihal <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <textarea id="perihal_suratmasuk" name="perihal_suratmasuk" class="form-control" rows="3" placeholder="Masukkan Perihal Surat" required="required"><?php echo $data['perihal_suratmasuk'];?></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">File <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input name="file_suratmasuk" accept="application/pdf" type="file" id="file_suratmasuk" class="form-control" autocomplete="off"/>
                          <a href="<?php echo '../admin/surat_masuk/'.$data['file_suratmasuk'];?>"><b>Lihat File Sebelumnya</b></a> (Maksimal 10 MB )
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Operator </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input value="<?php echo $_SESSION['nama'];?>" type="text" id="operator" name="operator" readonly="readonly" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="datasuratmasuk.php" class="btn btn-success"><span class="glyphicon glyphicon-arrow-left"></span> Batal</a>
                          <button type="submit" name="update" value="Update" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Simpan</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
      </div>
    </div>

    <script src="../assets/vendors/jquery/dist/jquery.min.js"></script>
    <script src="../assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../assets/vendors/fastclick/lib/fastclick.js"></script>
    <script src="../assets/vendors/nprogress/nprogress.js"></script>
    <script src="../assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <script src="../assets/vendors/iCheck/icheck.min.js"></script>
    <script src="../assets/vendors/moment/min/moment.min.js"></script>
    <script src="../assets/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="../assets/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="../assets/vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="../assets/vendors/google-code-prettify/src/prettify.js"></script>
    <script src="../assets/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <script src="../assets/vendors/switchery/dist/switchery.min.js"></script>
    <script src="../assets/vendors/select2/dist/js/select2.full.min.js"></script>
    <script src="../assets/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <script src="../assets/vendors/parsleyjs/dist/parsley.min.js"></script>
    <script src="../assets/vendors/autosize/dist/autosize.min.js"></script>
    <script src="../assets/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <script src="../assets/vendors/starrr/dist/starrr.js"></script>
    <script src="../assets/build/js/custom.min.js"></script>
    <script>
      $('#myDatepicker4').datetimepicker({ignoreReadonly:true,allowInputToggle:true});
    </script>
    <script language='javascript'>
    function validAngka(a){
      if(!/^[0-9.]+$/.test(a.value)){
        a.value = a.value.substring(0,a.value.length-1);
      }
    }
    </script>
  </body>
</html>

