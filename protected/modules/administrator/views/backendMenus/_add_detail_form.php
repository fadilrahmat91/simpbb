<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default panel-border-color panel-border-color-primary">
      <div class="panel-body">
        <?php $form=$this->beginWidget('CActiveForm', array(
          'id'=>'menu-detail-action',
          'htmlOptions'=>array(
          'class'=>'form-horizontal','role'=>'form'
          ),
        )); ?>
          <div class="form-group">
            <?= $form->label($model,'action_aksi',array('class'=>'col-sm-3 control-label')); ?>
            <div class="col-sm-6">  
              <?= $form->dropDownList($model,'action_aksi',BackendMenus::getAllowAction(),array('class'=>'form-control'))?>
            </div>
          </div>
          <div class="form-group">
            <?= $form->label($model,'action_name',array('class'=>'col-sm-3 control-label')); ?>
            <div class="col-sm-6">
              <?= $form->textField($model,'action_name',array('class'=>'form-control')); ?>
            </div>
          </div>
          <input type="hidden" name="id_action" value="0">
          <div class="form-group">            
            <div class="col-sm-10 col-sm-offset-3 "> 
              <?= CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn-btn-data btn btn-primary')); ?>
            </div>
          </div>
        <?php $this->endWidget(); ?>
      </div>
    </div>
  </div>
</div>

<script>
$("document").ready(function(){
	$("form#menu-detail-action").submit(function(){
		var _form = $(this);
		Ajax.run(_form.attr('action'),'POST',_form.serialize(),function(data){
			 //var data = JSON.parse(response);
			alert(data.msg);
			if( data.status == 'ok'){
			  _form[0].reset();
			  $("table#table-html > tbody").html(data.html);
			  $("input.btn-btn-data").val("Create");
			  $("input[name=id_details]").val('0');
			  $("div.add-new-data-form").hide();
			}
		});
		return false;
	});
	
	
	
  $('body').on('click','a.update-items',function(){
    var data = $(this).data('values');
    //data = JSON.parse(data);
    var form = $("form#application-register-detail-form");
    if(parseInt(data.id_detail) > 0 ){
      $("div.add-new-data-form").show();
      form[0].reset();
      $("input#ApplicationRegisterDetail_action").val(data.action);
      $("select#ApplicationRegisterDetail_action_type").val(data.action_type).change();
      $("input.btn-btn-data").val("Update");
      $("input[name=id_details]").val(data.id_detail);
    }
  });
  $('body').on('click','a.removes-items',function(){
    $("div.add-new-data-form").hide();
    if( confirm("Are you sure to delete this?") == true){
      var _this = $(this);
      $.ajax({
        url: _this.data('url'),
        type: 'POST',
        data: {},
        success: function(data) {
          var data = JSON.parse(data);
          alert(data.msg);
          if( data.result == 'ok'){
          $("table#table-html > tbody").html(data.html);
          }
        },
        error: function(e) {
           
        }
      });
    }
  });
  
});

</script>