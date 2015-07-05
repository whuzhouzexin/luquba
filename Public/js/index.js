+(function($){
    
    
    var userdoms=$('.deleteuser');
   
    userdoms.each(function(index,dom){
          
    	$(dom).click(

    		function(){
    			var id=$(this).attr('uid');
    			var _this=$(this);
    			var ur=$(this).attr('ur');
    			var url=ur+"?id="+id;
    			$.get(url, function(result){
    				console.log(result);
    			    if(result==205){
    			    	_this.parent('tr').empty();

    			    }else{
    			    	alert("删除失败");
    			    }

    			});
    			
    		}
    	);

   });


//查找用户
var serach=$('#search');
serach.click(
   
	function(){
		var ur=$(this).attr("ur");
		var inputs=$(this).siblings().find('input');
		var id=$(inputs[0]).get(0).value;
		var nickname=$(inputs[1]).get(0).value;
		var tel=$(inputs[2]).get(0).value;
		var uip=$(inputs[3]).get(0).value;
		var deleteurl=$(this).attr("delete");
		// alert(deleteurl);
		$.post(ur,{"id":id,"nickname":nickname,"tel":tel,"uip":uip},function(data){

			if(data==206){

				alert("请输入查询条件");
			}
			if(data==207){

				alert("用户不存在");

			}else {

					var str='';
					var table=$("tbody");
					$.each(data,function(k,v){	
						var id=v.uid;
						var nickname=v.username;
						var tel=v.tel;
						var lastip=v.lastip;
				        str+="<tr>"+"<td>"+id+"</td>"+"<td>"+nickname+"</td>"+"<td>"+tel+"</td>"+"<td>"+lastip+"</td>"+"<td class='livedelete' style='cursor:pointer' id= "+id+" >删除</td>"+"</tr>";
				        	     	
					});
					table.get(0).innerHTML=str;
					var dom1ive=$('.livedelete');
					
					 dom1ive.each(function(index,node){

					 	$(node).click(function(){
                            var this_=$(this);
                            var liveid=$(this).attr("id");
                            var url=deleteurl+"?id="+id;
                            // alert(url);
					 		$.get(url, function(result){
					 			console.log(result);
					 		    if(result==205){
					 		    	this_.parent('tr').empty();

					 		    }else{
					 		    	alert("删除失败");
					 		    }

					 		});


					 	});

					});

			};
			

			



		});

	}
);


//删除管理员
var admin=$('.deleteadmin');
$.each(admin,function(index,node){

	$(node).click(

		function(){
            var thisdom=$(this);
			var ur=$(this).attr("ur");
			var id=$(this).attr("id");
			var url=ur+"?id="+id;

			$.get(url,function(data){

				if(data==208||data==300){

					alert("非法操作");
				}
				if(data==209){

					 thisdom.parent("tr").empty();


				}

			});


		}

	);

});


//管理员模块完毕


//删除寄语
var message=$(".deleteMessage");
// console.log(message);
$.each(message,function(index,node){

	$(node).click(

		function(){
			var this_=$(this);
			var ur=this_.attr("ur");
			var id=this_.attr("id");
			var url=ur+"?id="+id;
			
			$.get(url,function(data){
              
				if(data==208) {

					alert("非法操作");
				}else{

					this_.parent("tr").empty();
				}

			});

		}
    );



});


//

}
)(jQuery);
