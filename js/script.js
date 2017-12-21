function toBasket(act,id){
	var str = act+"="+id;
	$.ajax({
		type: "POST",
		url: "",
		data: str 
	}).done(function( msg ) {
		$("#mess").html(msg);
		$("#btn-"+id).html('В корзине');
	});
}

function basket(act,id){
	var str = act+"="+id;
	$.ajax({
		type: "POST",
		url: "",
		data: str 
	}).done(function( msg ) {
		$("#mess").html(msg);
		var count = parseInt($("#prod_count_"+id)[0].innerHTML);
		if(act=='add') count++;
		else if(act=='min'&&count>1) count--;
		else $("#prod_item_"+id).html('');
		$("#prod_count_"+id).html(count);
	});
}

function crud(act,id){
	if(act == 'edit'){
		var form1='<form id="edit-'+id+'" action="?crud" enctype="multipart/form-data" method="POST"><div class="input">';
		var form2='</form>';
		var file = '<input accept="image/*,image/jpeg" type="file" name="image">'+
					'<input type="hidden" name="id" value="'+id+'"><input type="hidden" name="oper" value="update">';
		$("#prod_item_"+id).addClass('active');
		$("#prod_item_"+id).html($("#prod_item_"+id+" .img").html()+form1+'Name<input name="name" value="'
			+$("#prod_item_"+id+" .name").html()+'">New image'+file+'Price<input name="price" value="'
			+$("#prod_item_"+id+" .price").html()+
			'"><p onclick="crud(\'save\',\''+id+'\')" name>Save</p></div><textarea name="text">'
			+$("#prod_item_"+id+" .text").html()
			+'</textarea>'+form2);
	}

	else if(act == 'delite'||act == 'create'){
		
		var str = "id="+id+"&oper="+act;
		$.ajax({
			type: "POST",
			url: "?crud",
			data: str
		}).done(function( msg ) {
			$("#mss").html(msg);
			if(act == 'delite'){
				$("#prod_item_"+id).html('');
			}
		});
	}
	else if(act == 'save'){
		var str = $('#edit-'+id).serializeArray();
		$.ajax({
			type: "POST",
			url: "?crud",
			data: str
		}).done(function( msg ) {
			$("#mss").html(msg);
		});
	}
}

