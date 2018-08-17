function status(table,column,id){
	$.post("../ajax/status.php",{"table":table,"column":column,"id":id},function(respond){
		
	});
}

function delete_col(table,row,id){ $(".alert-success").show();

	 if (confirm("Are you sure to delete this row ?") == false) {
                    return;
       }

	$.post("../ajax/delete.php",{"table":table,"id":id},function(respond){

		
		if(respond){
			$("#page-wrapper").prepend('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+respond+'</div>');
			location.reload();
		}else{
			
			$("#"+row).remove();
				$("#page-wrapper").prepend('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Deleted Succefully</div>');
		
		}$(".alert").fadeOut(5000);
	});
}

function removeimg(table,row,id,field){
	 if (confirm("Are you sure to delete this Image ?") == false) {
                    return;
       }
	$.post("../ajax/function.php",{"choice":"deleteimg","table":table,"field":field,"id":id},function(respond){ 
		$("#"+row).remove();
	});
}

