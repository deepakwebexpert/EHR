<!-- Colorpicker Css -->
<link href="<?= base_url() ?>public/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet" />
<!-- Dropzone Css -->
<link href="<?= base_url() ?>public/plugins/dropzone/dropzone.css" rel="stylesheet">
<!-- Multi Select Css -->
<link href="<?= base_url() ?>public/plugins/multi-select/css/multi-select.css" rel="stylesheet">
<!-- Bootstrap Spinner Css -->
<link href="<?= base_url() ?>public/plugins/jquery-spinner/css/bootstrap-spinner.css" rel="stylesheet">
<!-- Bootstrap Tagsinput Css -->
<link href="<?= base_url() ?>public/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
<!-- Bootstrap Select Css -->
<link href="<?= base_url() ?>public/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<!-- noUISlider Css -->
<link href="<?= base_url() ?>public/plugins/nouislider/nouislider.min.css" rel="stylesheet" />


<div class="container-fluid">

    <!-- File Upload | Drag & Drop OR With Click & Choose -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Upload Documents

                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);">Action</a></li>
                                <li><a href="javascript:void(0);">Another action</a></li>
                                <li><a href="javascript:void(0);">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <!-- <form action="/" id="" class="dropzone" method="post" enctype="multipart/form-data"> -->
                    <?php echo form_open_multipart(base_url('admin/users/upload_docs/' . $id), 'class="dropzone"');  ?>

                    <div class="dz-message">
                        <div class="drag-icon-cph">
                            <i class="material-icons">touch_app</i>
                        </div>
                        <h3>Drop files here or click to upload.</h3>
                        <!-- <em>(This is just a demo dropzone. Selected files are <strong>not</strong> actually uploaded.)</em> -->
                    </div>
                    <div class="fallback">
                        <input name="docs[]" accept="application/pdf" type="file" multiple />
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                            <input type="submit" name="submit" value="Upload" id="change_doc" class="btn btn-primary m-t-15 waves-effect">
                        </div>
                    </div>
                    <?php echo form_close(); ?>

                </div>
            </div>
        </div>
    </div>
    <!-- #END# File Upload | Drag & Drop OR With Click & Choose -->


</div>


<!-- Bootstrap Colorpicker Js -->
<script src="<?= base_url() ?>public/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<!-- Dropzone Plugin Js -->
<!-- <script src="<?= base_url() ?>public/plugins/dropzone/dropzone.js"></script> -->
<!-- Input Mask Plugin Js -->
<script src="<?= base_url() ?>public/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>
<!-- Multi Select Plugin Js -->
<script src="<?= base_url() ?>public/plugins/multi-select/js/jquery.multi-select.js"></script>
<!-- Jquery Spinner Plugin Js -->
<script src="<?= base_url() ?>public/plugins/jquery-spinner/js/jquery.spinner.js"></script>
<!-- Bootstrap Tags Input Plugin Js -->
<script src="<?= base_url() ?>public/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
<!-- noUISlider Plugin Js -->
<script src="<?= base_url() ?>public/plugins/nouislider/nouislider.js"></script>
<!-- Custom Js -->
<script src="<?= base_url() ?>public/js/pages/forms/advanced-form-elements.js"></script>