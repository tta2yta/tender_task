var app=angular.module('myApp',[]);
app.controller('cntrl', function($scope,$http){
	ReadIt();
	$scope.obj={'idisable':false};
	btn_txt="Insert";
	url="";
	$scope.btnName=btn_txt;
   function ReadIt() {
        $http.get("api/read.php")
		.success(function(data){
			$scope.btnName=btn_txt;
			$scope.data=data.data_item;
			//console.log(data.message);
			

		}).error(function(data)
		{
			//console.log(data.message);
		})
    }


//  function ReadIt() {
// $http.get("api/read.php")
//     .then(function (data) {
//         console.log('get',response)
//     })
//     .catch(function (data) {
//         // Handle error here
//         console.log(data.message);
//     });


// }



	$scope.insertdata=function(){
		// alert($scope.btnName);
		if($scope.btnName=="Insert"){
			btn_txt="Insert"
			$url="api/create.php";
		}
		else if($scope.btnName=="Update"){
			btn_txt="Update"
			$url="api/edit.php";
		}
		$http.post($url,{'id':$scope.id, 'doc':$scope.doc, 'name':$scope.name, 'code':$scope.code, 'year':$scope.year,'btnName':$scope.btnName})
		.success(function(data){
			// $scope.msg="Data Inserted";
			$scope.msg=data.message;
			$("#msg").html(data.message).fadeIn('fast').delay(1000).fadeOut('fast');
			$scope.displayTend();

		})

	}

	$scope.displayTend=function(){
		$http.get("api/read.php")
		.success(function(data){
			$scope.btnName=btn_txt;
			$scope.data=data.data_item;
		})
	}
	$scope.deleteTend=function(ten_id){
		$http.post("api/delete1.php",{'id':ten_id})
		.success(function(data){
				$scope.msg=data.message;
				 $("#msg").html(data.message).fadeIn('fast').delay(1000).fadeOut('fast');
				$scope.displayTend();


		})

	}

	$scope.editTend=function(ten_id, ten_doc, ten_name, ten_code, ten_year)
	{
		btn_txt="Update";
		$scope.id=ten_id;
			
		$scope.doc=ten_doc;
	
		$scope.name=ten_name;
		$scope.code=ten_code;
		$scope.year=ten_year;
		$scope.btnName=btn_txt;
		$scope.obj.idisable=true;
		$scope.displayTend();

	}

	$scope.clear=function()
	{
		$scope.msg="";
		document.getElementById('id').value="";
 $scope.obj.idisable=false;
 $scope.btnName="Insert";
   //document.getElementById('doc').value="";
      document.getElementById('name').value="";
   document.getElementById('code').value="";
   document.getElementById('year').value="";
   document.getElementById('sub').value="Insert";
	}

});