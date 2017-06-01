<?php //$this->load->view('partials/settings');?>
<div class="content-body">
      <div class="container-fluid">
            <div class="content-box">

              <link rel="stylesheet" href="<?php echo base_url();?>assets/css/intlTelInput.css">
              <div class="row margin-top-10 margin-bottom-20">
                    <div class="col-md-12">
                          <h3 class="title">Ativação de clientes</h3>
                    </div>
                </div>
              <form method="post" action="<?php echo base_url('cliente/ativacao/cadastro')?>" enctype="multipart/form-data">

              <div class="content-box">
                <?php if(!empty($_SESSION['mensagem'])){ ?>
                <div class="alert alert-<?php echo $this->session->flashdata('alert');?> alert-dismissible classe_alerta" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong><?php echo $this->session->flashdata('mensagem'); ?></strong>
                </div>
                <?php } ?>
                <div class="row">
                    <div class="col-md-9 col-lg-10">
                    	  <div class="row">
                        	  <div class="col-md-6">
                                <div class="form-group">
                                  <label for="Conta">Cliente <span style="color:red">*</span></label>
                                  <select class="js-example-basic-multiple form-control" id="cliente" name="cliente">
                                    <?php foreach($clientes as $cliente): ?>
                                    <option value="<?php echo $cliente['id']; ?>"><?php echo $cliente['nome'].' - '.$cliente['conta']; ?></option>
                                    <?php endforeach; ?>
                                  </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label for="Nome">Robo <span style="color:red">*</span></label>
                                  <select class="js-example-basic-multiple form-control" multiple="multiple" id="robos[]" name="robos[]">
                                    <?php foreach($robos as $robo): ?>
                                    <option value="<?php echo $robo['id']; ?>"><?php echo $robo['nome']; ?></option>
                                    <?php endforeach; ?>
                                  </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4">
                                <div class="form-group">
                                  <label for="Validade">Status <span style="color:red">*</span></label>
                                  <select class="js-example-basic-multiple form-control" id="status" name="status" required autofocus>
                                    <option value="1">Ativo</option>
                                    <option value="0">Inativo</option>
                                  </select>
                                  <!-- <input type="cel" class="form-control" name="update" id="update" placeholder="Update" required autofocus> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row margin-top-20">
                		<div class="col-md-12">
                      	 <div class="form-group">
                      		<button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> Save</button>
                              <a href="<?php echo base_url('cliente/lista') ?>" class="btn btn-default">Cancel</a>
                          </div>
                      </div>
                </div>
              </form>
            </div>
      </div>
</div>

<link rel="stylesheet" href="<?php echo base_url();?>assets/js/select2/dist/css/select2.css" rel="stylesheet" />

<script type="text/javascript" src="<?php echo base_url();?>assets/js/inttelinput/intlTelInput.min.js"></script>
<script src="<?php echo base_url();?>assets/js/locationPicker/locationpicker.jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/select2/dist/js/select2.min.js"></script>

<script>
  $(function(){
    // $(".js-example-basic-multiple").select2();
    $(".js-example-basic-multiple").select2({
      tags: true
    });
  });

// BREADCRUMB //
$("#breadcrumb").append('<i class="icon icon-config"></i><strong><a href="<?php echo base_url('cliente/ativacao/lista');?>">Clientes</a></strong><i class="glyphicon glyphicon-menu-right"></i> Ativação');

</script>

<?php $this->load->view('partials/footerSettings');?>