<!DOCTYPE html>
<!-- 
Version: 3.9.0
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title><?php echo $titulo ?> | Painel</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/plugins/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/plugins/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/plugins/uniform/css/uniform.default.css') ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') ?>" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/select2/select2.css') ?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css') ?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') ?>"/>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo base_url('assets/global/css/components.css') ?>" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/css/plugins.css') ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/admin/layout/css/layout.css') ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/admin/layout/css/themes/darkblue.css') ?>" id="style_color" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/admin/layout/css/custom.css') ?>" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="<?php echo base_url('assets/admin/layout/img/favicon.ico') ?>"/>
</head>
<style type="text/css">
	.count {-webkit-box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.15);box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.15);position: relative;top: -8px;left: 0;font-size: 11px;background-color: #dc3545;border-radius: 50px;height: 16px;line-height: 16px;color: #fff;min-width: 16px;text-align: center;padding: 0 5px;display: inline-block;vertical-align: top;margin-left: -6px;margin-right: -5px;}
	.thumbnail a>img, .thumbnail>img {
    margin-right: auto;
    margin-left: auto;
    width: 144px !important;
}
.alignCenter{
	margin: 1px 0px 2px 111px;
	}     
</style>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed page-quick-sidebar-over-content ">
<!-- BEGIN HEADER -->
<?php $this->load->view('common/header'); ?>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
<?php $this->load->view('common/menu'); ?>
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			<?php echo $titulo ?> <small></small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<?php echo anchor(base_url('inicio'), 'In&iacute;cio') ?>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<?php echo anchor(base_url(''. $this->pagina), $titulo) ?>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<?php echo ucfirst($this->uri->segment(3)) ?>
					</li>
				</ul>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN VALIDATION STATES-->
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i><?php echo ucfirst($this->uri->segment(3)) ?>
							</div>
						</div>
						 
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="<?php echo base_url($this->pagina.'/'.$acaoControl) ?>" id="form_sample_3" class="form-horizontal form-bordered" method="post"  role="form">
								 
								 
							<?php if (isset($conteudos[0]->id)) { ?>
								<input name="id" type="hidden" value="<?php echo $conteudos[0]->id; ?>">
							<?php } ?>
								 <div class="form-body">
								<?php if (@$_SESSION['status'] == 'error') { ?>
									<div class="alert alert-danger  ">
									<button class="close" data-close="alert"></button>
									   <?php echo @$_SESSION['msg'] ; ?>
									</div>
								<?php } ?>

									<?php if (@$_SESSION['status'] == 'success') { ?>
									<div class="alert alert-success ">
										<button class="close" data-close="alert"></button>
										<?php echo @$_SESSION['msg'] ; ?>
									</div>
									<?php } ?>
									<?php 
									 unset($_SESSION['status']);	 unset($_SESSION['msg']);
									$_SESSION['status'] ='';   $_SESSION['msg'] =''; ?>

									  
									<div class="form-group">
										 <label class="control-label col-md-3">Pessoa  </label>
										<div class="col-md-5">
											 <select name="pessoa_id" class="form-control"   >
											 	<?php $selected='';
											 	foreach ($pessoas as $key => $p) { ?>
											 		<?php if ($acaoControl=='alterar') {
											 			 if($p->id == $conteudos[0]->pessoa_id){
											 			 	 $selected=' selected';
											 			 }else{
											 				 $selected='';
											 		   }
											 		} ?>
											 	<option value="<?=$p->id?>" <?=$selected?> > <?=$p->pessoa_cat ?></option>
											 <?php } ?>
											 </select>
										</div>
									</div>
									 
									<div class="form-group">
										<label class="control-label col-md-3">Número da Conta<span class="required">* </span> </label>
										<div class="col-md-5">
											<input value="<?php if (isset($conteudos[0]->numero_conta)) echo $conteudos[0]->numero_conta; ?>" type="text" name="conta"  onkeypress='valida_numero(event)'  class="form-control"  required />
										</div>
									</div>
								 
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn green">Salvar</button>
											<button type="button" class="btn default" onClick="window.location='<?php echo base_url(''. $this->pagina .'/listar/'. $this->session->flashdata('pagina')) ?>';">Voltar</button>
										</div>
									</div>
								</div>
							</div>
							</form>
							<!-- END FORM-->
						</div>
						<!-- END VALIDATION STATES-->
					</div>
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<?php $this->load->view('common/footer'); ?>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo base_url('assets/global/plugins/respond.min.js') ?>"></script>
<script src="<?php echo base_url('assets/global/plugins/excanvas.min.js') ?>"></script> 
<![endif]-->
<script src="<?php echo base_url('assets/global/plugins/jquery.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jquery-migrate.min.js') ?>" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url('assets/global/plugins/jquery-ui/jquery-ui.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jquery.blockui.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jquery.cokie.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/uniform/jquery.uniform.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') ?>" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/jquery-validation/js/additional-methods.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/select2/select2.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/ckeditor/ckeditor.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-markdown/lib/markdown.js') ?>"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL STYLES -->
<script src="<?php echo base_url('assets/global/scripts/metronic.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/layout/scripts/layout.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/layout/scripts/quick-sidebar.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/layout/scripts/demo.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/pages/scripts/form-validation.js') ?>"></script>
<!-- END PAGE LEVEL STYLES -->
<script>
jQuery(document).ready(function() {   
   // initiate layout and plugins
 Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
//FormValidation.init();
});

$(function() {
	$("#pop").on("click", function(e) {
	   e.preventDefault();
	   $('#the-modal').modal('toggle');
	});
 
});
function valida_numero(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
