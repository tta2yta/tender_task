var app=angular.module('myApp',[]);
app.controller('cntrl', function($scope,$http){
	ReadIt();
	$scope.obj={'idisable':false};
	$scope.btnName="Insert";
   function ReadIt() {
        $http.get("api/select.php")
		.success(function(data){
			$scope.data=data;

		})
    }


	$scope.insertdata=function(){
		$http.post("api/insert_edit.php",{'id':$scope.id, 'doc':$scope.doc, 'name':$scope.name, 'code':$scope.code, 'year':$scope.year,'btnName':$scope.btnName})
		.success(function(data){
			// $scope.msg="Data Inserted";
			$scope.msg=data.message;
			$("#msg").html(data.message).fadeIn('fast').delay(1000).fadeOut('fast');
			$scope.displayTend();

		})

	}

	$scope.displayTend=function(){
		$http.get("api/select.php")
		.success(function(data){
			$scope.data=data
		})
	}
	$scope.deleteTend=function(ten_id){
		$http.post("api/delete.php",{'id':ten_id})
		.success(function(data){
				$scope.msg=data.message;
				 $("#msg").html(data.message).fadeIn('fast').delay(1000).fadeOut('fast');
				$scope.displayTend();


		})

	}

	$scope.editTend=function(ten_id, ten_doc, ten_name, ten_code, ten_year)
	{
		$scope.id=ten_id;
			
		$scope.doc=ten_doc;
	
		$scope.name=ten_name;
		$scope.code=ten_code;
		$scope.year=ten_year;
		$scope.btnName="Update";
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