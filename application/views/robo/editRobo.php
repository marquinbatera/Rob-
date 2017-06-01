<?php //$this->load->view('partials/settings');?>
<div class="content-body">
      <div class="container-fluid">
            <div class="content-box">
              <link rel="stylesheet" href="<?php echo base_url();?>assets/css/intlTelInput.css">

              <div class="row margin-top-10 margin-bottom-20">
                    <div class="col-md-12">
                          <h3 class="title">Cadastro de Robô</h3>
                    </div>
                </div>
              <?php if($tipo == 0){ ?>
              <form method="post" action="<?php echo base_url('robo/cadastro')?>" enctype="multipart/form-data">

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
                                  <label for="Nome">Nome <span style="color:red">*</span></label>
                                  <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome" required autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label for="Nome">Nomeclatura <span style="color:red">*</span></label>
                                  <input type="text" class="form-control" name="nomeclatura" id="nomeclatura" placeholder="Nome" required autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label for="Ativo">Ativo <span style="color:red">*</span></label>
                                  <input type="text" class="form-control" name="ativo" id="ativo" placeholder="Ativo" required autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label for="Descrição">Descrição <span style="color:red">*</span></label>
                                  <textarea class="form-control" name="descricao" id="descricao" placeholder="Descrição" required autofocus>
                                  </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                  <label for="Valor">Valor <span style="color:red">*</span></label>
                                  <input type="text" class="form-control" name="valor" id="valor" placeholder="Valor" required autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                  <label for="Upload">Upload <span style="color:red">*</span></label>
                                  <input type="file" class="form-control" name="upload" id="upload" placeholder="Upload" required autofocus>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row margin-top-20">
                		<div class="col-md-12">
                      	 <div class="form-group">
                      		<button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> Save</button>
                              <a href="<?php echo base_url('robo/lista') ?>" class="btn btn-default">Cancel</a>
                          </div>
                      </div>
                </div>
              </form>
              <?php }elseif ($tipo == 1) {?>
              <form method="post" action="<?php echo base_url('robo/editar/').$robo[0]['id']; ?>" enctype="multipart/form-data">

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
                                  <label for="Nome">Nome <span style="color:red">*</span></label>
                                  <input type="text" class="form-control" value="<?php echo $robo[0]['nome']; ?>" name="nome" id="nome" placeholder="Nome" required autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label for="Nome">Nomeclatura <span style="color:red">*</span></label>
                                  <input type="text" class="form-control" value="<?php echo $robo[0]['nomeclatura']; ?>" name="nomeclatura" id="nomeclatura" placeholder="Nome" required autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label for="Ativo">Ativo <span style="color:red">*</span></label>
                                  <input type="text" class="form-control" value="<?php echo $robo[0]['ativo']; ?>" name="ativo" id="ativo" placeholder="Ativo" required autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label for="Descrição">Descrição <span style="color:red">*</span></label>
                                  <textarea class="form-control" name="descricao" id="descricao" required autofocus>
                                  <?php echo $robo[0]['descricao']; ?>
                                  </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                  <label for="Valor">Valor <span style="color:red">*</span></label>
                                  <input type="text" class="form-control" value="<?php echo $robo[0]['valor']; ?>" name="valor" id="valor" placeholder="Valor" required autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                  <label for="Upload">Upload</label>
                                  <input type="file" class="form-control" name="upload" id="upload" placeholder="Upload">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row margin-top-20">
                    <div class="col-md-12">
                         <div class="form-group">
                          <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> Save</button>
                              <a href="<?php echo base_url('robo/lista') ?>" class="btn btn-default">Cancel</a>
                          </div>
                      </div>
                </div>
              </form>
              <?php } ?>
            </div>
      </div>
</div>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/inttelinput/intlTelInput.min.js"></script>
<script src="<?php echo base_url();?>assets/js/locationPicker/locationpicker.jquery.min.js"></script>
<script>

  $(function(){
    $("#valor").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
  });

// BREADCRUMB //
$("#breadcrumb").append('<i class="icon icon-config"></i><strong><a href="<?php echo base_url('robo/lista');?>">Robo</a></strong><i class="glyphicon glyphicon-menu-right"></i> Cadastro');

</script>

<?php $this->load->view('partials/footerSettings');?>