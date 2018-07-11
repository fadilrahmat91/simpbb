Pendataan = {
	jenis_transaksi : function(_nilai, _pilihan, _target){
		var d =  false;
		if( _nilai == 'L' ){
			d = _pilihan.L;
		}else if( _nilai == 'S'){
			d = _pilihan.S;
		}
		_target
			.empty()
			.append('<option selected="selected" value="0">Pilih Jenis Formulir</option>');
		if( d != false ){
			for (var i = 0; i < d.length; i++){
				var obj = d[i];
				 for (var key in obj){
					var attrName = key;
					var attrValue = obj[key];
					_target.append($('<option>',{
						value: attrName,
						text : attrName+" - "+attrValue
					}));
				}
			}
		}
	},
	handlingPage2 : function(url,params,target){
		Ajax.run(url, 'GET', params,function(response){
			if(response.status == 'ok' ){
				$(target).html(response.page2);
			}
		});
	}
}