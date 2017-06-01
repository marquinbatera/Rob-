<?php //$this->load->view('partials/settings');?>
<div class="content-box">
  <div class="content-body">
        <div class="container-fluid">
              <div class="container">
                <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
                <div class="row margin-top-10 margin-bottom-20" style="background-color: #fff;">
                      <div class="col-xs-6">
                        <img class="img-responsive" src="<?php echo base_url(); ?>assets/img/titulo3.png">
                        <!-- <h3 class="title">Robôs para download</h3> -->
                      </div>
                  </div>
                <div class="container-fluid mensagem">
                  <div class="row">
                  <?php foreach($robos as $robo): ?>
                    <div class="col-xs-3">
                      <div class="timeline-panel">
                        <a href="<?php echo base_url('robo/baixaRobo/').$robo['id']; ?>"><img src="<?php echo base_url(); ?><?php echo $robo['img']; ?>" style="width: 100%"></a>
                        <div class="timeline">
                          <div class="text-center">
                            <h3 class="title"><?php echo $robo['nome']; ?></h3>
                          </div>
                          <div class="timeline-body">
                            <p style="max-width: 100%;"><?php echo $robo['descricao']; ?></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                  </div>
                  
                </div>
            </div>
        </div>
  </div>
</div>
<?php //$this->load->view('partials/footerSettings');?>

  <!-- Data Tables -->
  
  <!-- <link href="<?php echo base_url();?>assets/js/dataTables1/media/css/dataTables.bootstrap.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/css/dataTables/dataTables.responsive.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/css/dataTables/dataTables.tableTools.min.css" rel="stylesheet"> -->

  <link href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<!-- Data Tables -->
  <!-- <script src="<?php echo base_url();?>assets/js/dataTables1/media/js/jquery.dataTables.js"></script>
  <script src="<?php echo base_url();?>assets/js/dataTables1/media/js/dataTables.bootstrap.js"></script>
  <script src="<?php echo base_url();?>assets/js/dataTables/dataTables.responsive.js"></script>
  <script src="<?php echo base_url();?>assets/js/dataTables/dataTables.tableTools.min.js"></script> -->
  <script src="<?php echo base_url();?>assets/js/jquery.easy-overlay.js"></script>
  <script>
  $(function(){
      $(document).on('click', '#baixar', function(){
        var id = $(this).attr('idRobo');
        $.ajax({
          type: 'POST',
          url: '<?php echo base_url('robo/baixaRobo'); ?>',
          data: {
            id : id
          },
          success: function(data){
            var conteudo = JSON.parse(data);
            var mensagem = '<div class="alert alert-'+conteudo.alert+' alert-dismissible classe_alerta" role="alert">'+conteudo.mensagem+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong></strong></div>';
            $('.mensagem').prepend(mensagem);
          }
        })
      });
  });

  function confirmModal(id)
  {
      $('#confirmExclusao').attr('onclick','excluirRobo('+id+')');
      $('#confirm').modal(); 
  }

  function excluirRobo(id)
  {
    $('#confirm').modal('hide');
    $('#load').overlay();
    $.ajax({
        url: '../robo/removeRobo',
        type: 'POST',
        data:{
          id:id
        },
        success: function(data){
          var conteudo = JSON.parse(data);
          var mensagem = '<div class="alert alert-'+conteudo.alert+' alert-dismissible classe_alerta" role="alert">'+conteudo.mensagem+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong></strong></div>';

          buscaRobo();
          window.setTimeout( function(){
            $('#load').overlayout();
            $('#formulario').prepend(mensagem);
            $('.classe_alerta').delay(5000).fadeOut(5000);
          }, 3000);
        }
    })
  }

  // função AJAX para trazer dados do DataTable By. Marcos Meira 14/01/2015
  function buscaRobo()
  {
    $.ajax({
        type:'POST',
        url:'../robo/buscaListaRobo',
        dataType: "json",
        success: function(data){
            $('#listRobo').dataTable().fnClearTable();
            if (data.aaData.length)
                $('#listRobo').dataTable().fnAddData(data.aaData);
            $('#listRobo').dataTable().fnDraw();
        }
    })
  }

  </script>
