<?php //$this->load->view('partials/settings');?>
<div class="content-body">
      <div class="container-fluid">
            <div class="content-box">

              <link rel="stylesheet" href="<?php echo base_url();?>assets/css/intlTelInput.css">
              <div class="row margin-top-10 margin-bottom-20">
                    <div class="col-md-12">
                          <h3 class="title">cadastro de clientes</h3>
                    </div>
                </div>
              <?php if(!isset($update)){ ?>
              <form method="post" action="<?php echo base_url('cliente/cadastro')?>" enctype="multipart/form-data">

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
                                  <label for="Conta">Conta <span style="color:red">*</span></label>
                                  <input type="text" class="form-control" name="conta" id="conta" placeholder="Conta" required autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label for="Nome">Nome <span style="color:red">*</span></label>
                                  <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome" required autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label for="Email">Email <span style="color:red">*</span></label>
                                  <input class="form-control" id="email" name="email" placeholder="Email" required autofocus>
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
              <?php }else{ ?>
              <form method="post" action="<?php echo base_url('cliente/editar/').$cliente[0]['id']; ?>" enctype="multipart/form-data">
              <input type="hidden" value="<?php echo $cliente[0]['id']; ?>" name="id_cliente" id="id_cliente">
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
                                  <label for="Conta">Conta <span style="color:red">*</span></label>
                                  <input type="text" class="form-control" value="<?php echo $cliente[0]['conta']; ?>" name="conta" id="conta" placeholder="Conta" required autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label for="Nome">Nome <span style="color:red">*</span></label>
                                  <input type="text" class="form-control" value="<?php echo $cliente[0]['nome']; ?>" name="nome" id="nome" placeholder="Nome" required autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label for="Email">Email <span style="color:red">*</span></label>
                                  <input class="form-control" value="<?php echo $cliente[0]['email']; ?>" id="email" name="email" placeholder="Email" required autofocus>
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
              <?php }?>
            </div>
      </div>
</div>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/inttelinput/intlTelInput.min.js"></script>
<script src="<?php echo base_url();?>assets/js/locationPicker/locationpicker.jquery.min.js"></script>
<script>

// BREADCRUMB //
$("#breadcrumb").append('<i class="icon icon-config"></i><strong><a href="<?php echo base_url('cliente/lista');?>">Clientes</a></strong><i class="glyphicon glyphicon-menu-right"></i> Cadastro');

</script>

<?php $this->load->view('partials/footerSettings');?>