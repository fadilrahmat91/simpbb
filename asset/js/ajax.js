Ajax = {
	show_load : true,
	set_load : function(){	
		if( this.show_load == true ){
			var loading = '<span class="label label-lg label-pink" >Loading...</div>';
			
			$("div#loading-content").html(loading).show();
			$("div#ajax-content-result").hide();
			$("div#loading-page").show();
		}
	},
	hide_load : function(){
		$("div#loading-content").hide();
	},
	run : function( $url, $type, $data,$callback,datatype='json'){
		console.log($data);
		Ajax.set_load();
		$("div.error-all").remove();
		$.ajax({
			url: $url,
			dataType: datatype,
			type: $type,
			data: $data,
			cache:false,
			success: function($str){
				if( $str.status == 'login-required-admin'){
					return;
				}
				$callback( $str )
			},
			error: this.error,
			complete:this.complete
		});
	},
	error : function( $param ){
		Ajax.hide_load();
		
	},
	complete : function(){
		Ajax.hide_load();
	},
	show_alert : function( $type , $str){
		$("div#alert-content").removeClass();
		if( $type =='error' ){
			$("div#alert-content").addClass('alert alert-danger alert-dismissible');
			$("strong#info-alert").text("Pesan Error!");
		}else if( $type == "info" ){
			$("div#alert-content").addClass('alert alert-info alert-dismissible');
			$("strong#info-alert").text("Info");
		}else{
			alert( "info tidak terdeteksi" );
			return;
		}
		
		$("p#alert-body").html( $str );
		$("div#ajax-content-result").show();
	}
}
