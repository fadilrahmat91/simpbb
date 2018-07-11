
<section class="content-header">
    <h1>Roles
    <small>Pengaturan</small>
    </h1>
</section>
<section>
<div class="content">
  <div class="row">
    <div class="col-sm-12">
      <div class="box box-primary">
        <div class="box-header with-border"> 
          <i class="ion ion-clipboard"></i>
          <h3 class="box-title">Update </h3>
        </div>
        <div class="panel-body">
          <div class="form">
            <form name="f_name_form" class="form-horizontal" action="<?= Yii::app()->createAbsoluteUrl('/administrator/userRole/saverole/id/'.$id)?>">
              <div class="form-group" >
                <div class="col-sm-12" id="list-role-group">
                  
                    <?php  $this->renderPartial('_list_role',['access'=>$access]);?>
                  
                </div>
              </div>
              <button class="btn btn-primary">Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
<script>

  $("document").ready(function(){
    $("form[name=f_name_form]").submit(function(){
      
      var form_s = $(this);
      $.ajax({
        url: form_s.attr('action'),
        type: 'POST',
        data: form_s.serialize(),
        success: function(data) {
           var data = JSON.parse(data);
           if(data.status == 'ok'){
             alert(data.msg);
             window.location.href = "<?= Yii::app()->createAbsoluteUrl('admin/role/admin'); ?>";
           }
        },
        error: function(e) {
           
        }
      });
      
      return false;
    });
    $('body').on('click','input[name=super_user]',function(){
      if( $(this).is(':checked')){
        $("div.table-div-content").hide();
      }else{
        $("div.table-div-content").show();
      }
    });
  });
  $("select[name=f_module]").change(function(){
    var val = $(this).val();
    $.ajax({
      url: $(this).data('url'),
      type: 'GET',
      data: {module:val},
      success: function(data) {
          var data = JSON.parse(data);
          if( data.result == 'ok' ){
          $("div#list-role-group").html(data.html);
          }else{
          $("div#list-role-group").html("");
        }
      },
      error: function(e) {
         
      }
    });
  });
</script>
    
