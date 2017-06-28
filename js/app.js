var app = angular.module('myApp', ["xeditable"]);

app.run(function(editableOptions) {
    editableOptions.theme = 'bs3';
});

app.controller('guestbookCtrl', function($scope, $http) {
    var baseurl = "http://localhost/rubber/angular/rest/";
    populate();

    // GET
    function populate() {
        $http.get(baseurl + "get.php")
        .then(function (response) {
            $scope.commentContent = 'some comment';
            $scope.guestbook = response.data.records;
        });
    }

    // PUT
    $scope.putGuestbook = function ($index, field) {
        console.log($scope.guestbook[$index]);  
        $http({
            method: 'POST',
            data: {
                'id' : $scope.guestbook[$index].id,
                'firstname' : $scope.guestbook[$index].firstname,
                'lastname' : $scope.guestbook[$index].lastname,
                'comment' : $scope.guestbook[$index].comment
            },
            url: baseurl + 'put.php',
            headers : {'Content-Type': 'application/json'} 
        });
	};
    
    // POST
    $scope.postGuestbook = function ($index, field) {     
        $http({
            method: 'POST',
            data: {
                'id' : null,
                'firstname' : field.firstname,
                'lastname' : field.lastname,
                'comment' : field.comment
            },
            url: baseurl 
        }).then(function(response) {
            
            //$scope.guestbook.push({'firstname' : field.firstname, 'lastname' : field.lastname, 'comment' : field.comment}); 
            populate();
        });         
	};
    
    // DELETE
    $scope.deleteGuestbook = function ($index, field) {
        console.log($scope.guestbook[$index].id);
        $http({
            method: 'POST',
            data: {
                'id' : $scope.guestbook[$index].id
            },
            url: baseurl + 'delete.php',
            headers : {'Content-Type': 'application/json'} 
        }).then(function(response) {
            $scope.guestbook.pop(); 
        });
	};
    
});