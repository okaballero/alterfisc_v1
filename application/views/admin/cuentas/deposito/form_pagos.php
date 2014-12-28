<link rel="stylesheet" href="<?=base_url('assets/css/fileuploader.css');?>" />
<script src="<?=base_url('assets/js/fileuploader.js');?>"></script>

<ol class="breadcrumb hidden-xs">
    <li><a href="<?=base_url($this->session->userdata('base_perfil'))?>">Inicio</a></li>
   	<li><a href="<?=base_url('cuentas/depositos')?>">Lista de depósitos</a></li>
   	<li>Detalle de depósito</li>
    <li>Agregar Pagos</li>
</ol>


<div class="block-area" id="responsiveTable">
    <h3 class="block-title">Agregar pago en empresa <?=$empresa->nombre_empresa?></h3>
    <?php if($this->session->flashdata('success')):?>
    <div class="text-center col-sm-12 col-xs-12">
        <div class="alert alert-success text-success text-center col-xs-6 col-sm-6"> <?php echo $this->session->flashdata('success');?></div>
    </div>
    <?php endif;?>
    <div class="clearfix"></div>
    
    <?=form_open('', array('class' => 'form-horizontal', 'name'=>'form_pago'))?> 

    <div class="form-group">
        <label class="control-label col-sm-4 col-xs-4"> Folio</label>
        <div class="col-sm-5 col-xs-5">
           <input type="text" class="form-control" name="folio_pago" value="<?=set_value('folio_pago')?>" >
        </div>
		<div class="col-sm-12 col-xs-12">&nbsp;</div>
		<div class="col-sm-4 col-xs-4"><?=form_error('folio_pago')?></div>
    </div>

    <?=form_error('folio_pago')?>

    <div class="form-group">
        <label class="control-label col-sm-4 col-xs-4"> Monto</label>
        <div class="col-sm-5 col-xs-5">
            <input type="text" name="monto" class="form-control" value="<?=set_value('monto')?>"  >
        </div>
		<div class="col-sm-12 col-xs-12">&nbsp;</div>
		<div class="col-sm-4 col-xs-4"><?=form_error('monto')?></div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-4 col-xs-4"> Empresa retorno</label>
        <div class="col-sm-5 col-xs-5">
            <select class="form-control" name="empresa_retorno" id="empresa_retorno"  >
                <option value=""> Seleccione un cliente</option>
                <?php foreach($empresas as $empresa):?>
                    <option value="<?=$empresa->id_empresa?>"><?=$empresa->nombre_empresa;?></option>
                <?php endforeach;?>
            </select>
        </div>
		<div class="col-sm-12 col-xs-12">&nbsp;</div>
		<div class="col-sm-4 col-xs-4"><?=form_error('empresa_retorno')?></div>
    </div>

    <?=form_error('empresa_retorno')?>

    <div class="form-group">
        <label class="control-label col-sm-4 col-xs-4"> Banco</label>
        <div class="col-sm-5 col-xs-5">
          <input type="hidden" id="banco_hidden" value="<?=set_value('id_banco')?>">
            <select class="form-control" name="id_banco" id="id_banco" > 
                <option value = "">Seleccione un banco</option>
            </select>
        </div>
    </div>
    <?=form_error('id_banco')?>

    <div class="form-group">
        <label class="control-label col-sm-4 col-xs-4"> Fecha pago</label>
        <div class="col-sm-3 col-xs-3">
            <div class="input-icon datetime-pick date-only">
                <input data-format="dd/MM/yyyy" type="text" id="fecha_pago" name="fecha_pago" class="form-control input-sm" placeholder="dd/mm/aaaa" value="<?=set_value('fecha_pago')?>" />
                <span class="add-on">
                    <i class="sa-plus"></i>
                </span>
            </div>
        </div>
		<div class="col-sm-12 col-xs-12">&nbsp;</div>
		<div class="col-sm-4 col-xs-4"><?=form_error('fecha_pago')?></div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-4 col-xs-4"> Adjuntar comprobante</label>
      <div class="col-sm-8 col-xs-8">
          <div class="col-sm-12 col-xs-12">
              <input type="hidden" name="ruta_comprobante" id="ruta_comprobante" value="<?=set_value('ruta_comprobante')?>" >
              <div id="upload_comprobante" >Clic para cargar</div>
              El formato de la imagen debe ser PDF, PNG o JPG con un tamaño maximo de 4 MB.
          </div>
          <div class="col-sm-12 col-xs-12">&nbsp;</div>
          <div class="col-sm-6 col-xs-6"><?=form_error('ruta_comprobante')?></div>
      </div>
	  <div class="col-sm-12 col-xs-12">&nbsp;</div>
		<div class="col-sm-4 col-xs-4"><?=form_error('ruta_comprobante')?></div>
  </div>

   <script type="text/javascript">
   var uploader = new qq.FileUploader({
    element: document.getElementById('upload_comprobante'),
    action: '<?php print base_url("archivos/subir_archivo");?>',
    multiple: false,
    params: { carpeta : 'comprobantes_pago', extension : 'pdf|jpg|png' },
    // events         
    // you can return false to abort submit
    onSubmit: function(id, fileName){
    $("#upload_comprobante .qq-uploader .qq-upload-list").html('');
    },
    onProgress: function(id, fileName, loaded, total){

      },
    onComplete: function  (id, fileName, responseJSON){
    if(responseJSON.error == null) {
    $("#ruta_comprobante").val(responseJSON.directory);
    $("#upload_comprobante .qq-uploader .qq-upload-list").html('<li><div class="alert alert-success">Archivo cargado exitosamente.<a href="<?php print base_url();?>'+responseJSON.directory+
    '" target="_blank"> Ver archivo cargado </div></a></li>');
    } else {
    $("#ruta_comprobante").val('');
    $("#upload_comprobante .qq-uploader .qq-upload-list").html('<li><div class="alert alert-danger">'+responseJSON.error+'</div></li>');
    }
    },
    onCancel: function(id, fileName){

    },
      debug: false
    });
    </script>

    <div class="clearfix text-center">
        <button class="btn"><i class="fa fa-save "></i> Guardar </button>
        <a href="<?=base_url('cuentas/depositos/detalle_cuenta/'.$id_empresa.'/'.$id_banco)?>" class="btn" style="margin-left:15px"><i class="fa fa-undo"></i>Regresar</a>
    </div>
    <?=form_close()?>
</div>


<SCRIPT TYPE="text/javascript">
$('#empresa_retorno').change(function(){
    var empresa = $('#empresa_retorno').val();
    var id_banco = $('#banco_hidden').val();
    $.ajax({
            type: "POST",
            datatype: 'html',
            url: '<?php echo base_url("cuentas/depositos/bancos_empresa")?>',
            data: "id_empresa=" + empresa + "&id_banco=" + id_banco , 
            success: function(data)
            {
                 $("#id_banco").html(data);
            }
          });//fin accion ajax
});
</SCRIPT>
