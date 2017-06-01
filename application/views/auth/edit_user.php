<?php //$this->load->view('partials/settings');?>
<div class="content-body">
      <div class="container-fluid">
            <div class="content-box">
              <link rel="stylesheet" href="<?php echo base_url();?>assets/css/intlTelInput.css">
              <div class="row margin-top-10 margin-bottom-20">
                    <div class="col-md-12">
                          <h3 class="title">cadastro de Usuário</h3>
                    </div>
                </div>
              <form method="post" action="<?php echo base_url('auth/edit_user/').$data['user']->id;?>" enctype="multipart/form-data">

              <div class="content-box">
                <?php if(!empty($data['message'])){ ?>
                <div class="alert alert-<?php echo $data['alert'];?> alert-dismissible classe_alerta" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong><?php echo $data['message']; ?></strong>
                </div>
                <?php } ?>
                <div class="row">
                    <div class="col-md-9 col-lg-10">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                  <label for="Username">Username <span style="color:red">*</span></label>
                                  <!-- <input type="text" class="form-control" name="conta" id="conta" placeholder="Conta" required autofocus> -->
                                  <?php echo form_input($data['username']);?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label for="Nome">Nome Completo <span style="color:red">*</span></label>
                                  <!-- <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome" required autofocus> -->
                                  <?php echo form_input($data['first_name']);?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label for="Email">Email <span style="color:red">*</span></label>
                                  <!-- <input class="form-control" id="email" name="email" placeholder="Email" required autofocus> -->
                                  <?php echo form_input($data['email']);?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                  <label for="Senha">Senha</label>
                                  <!-- <input class="form-control" id="password" name="password" placeholder="Senha" required autofocus> -->
                                  <?php echo form_input($data['password']);?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                  <label for="password_confirme">Confirme a Senha</label>
                                  <!-- <input class="form-control" id="password" name="password" placeholder="Senha" required autofocus> -->
                                  <?php echo form_input($data['password_confirm']);?>
                                </div>
                            </div>
                        </div>
                        <?php if($this->ion_auth->is_admin()){ ?>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                  <label for="Email">Tipo de conta <span style="color:red">*</span></label>
                                    <select class="form-control" id="groups" name="groups" required autofocus>
                                    <?php foreach ($data['groups'] as $group):?>
                                      <option value="<?php echo $group['id'];?>" <?php echo ($group['id'] == $data['currentGroups'][0]->id) ? 'selected' : '';?>><?php echo $group['name'];?></option>
                                  <?php endforeach?>
                                  </select>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="row margin-top-20">
                    <div class="col-md-12">
                         <div class="form-group">
                          <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> Save</button>
                              <a href="<?php echo base_url('cliente/listUsers') ?>" class="btn btn-default">Cancel</a>
                          </div>
                      </div>
                </div>
              </form>
            </div>
      </div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/inttelinput/intlTelInput.min.js"></script>
<script src="<?php echo base_url();?>assets/js/locationPicker/locationpicker.jquery.min.js"></script>
<script>

// BREADCRUMB //
$("#breadcrumb").append('<i class="icon icon-config"></i><strong><a href="<?php echo base_url('cliente/listUsers');?>">Clientes</a></strong><i class="glyphicon glyphicon-menu-right"></i> Cadastro');

</script>

<?php $this->load->view('partials/footerSettings');?>