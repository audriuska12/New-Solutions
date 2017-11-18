mvcApp = angular.module('myApp', ['ngMaterial']);



(function () {

//----------------------------------------------------------
    mvcApp.config(function(){ 
       console.log('config started');
     });

//----------------------------------------------------------
    mvcApp.controller('ngCtrl_main', function ($scope) {
	    console.log('controller started');
        $scope.submit = function() {
            var name = $scope.name;
            var pass = $scope.passw;
            if(pass.length < 6 || pass=="") alert('Slaptazodis yra per trumpas');
        }
    });

//----------------------------------------------------------
    mvcApp.run([function () { 
      console.log('run started!');
    }]);

})();