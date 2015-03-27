function clientsController($scope, $http)
{
	var gethostname=location.hostname;
	$http({method: 'POST', url: 'http://'+gethostname+'/stup_cms/common/json/clients.json'}).success(function(data) {
	$scope.clients = data;
	});
}

function sectorsController($scope, $http)
{
	var gethostname=location.hostname;
	$http({method: 'POST', url: 'http://'+gethostname+'/stup_cms/common/json/sectors.json'}).success(function(data) {
	$scope.sectors = data;
	});
}

function homepagebannerController($scope, $http)
{
	var gethostname=location.hostname;
	$http({method: 'POST', url: 'http://'+gethostname+'/stup_cms/common/json/homepageslider.json'}).success(function(data) {
	$scope.homebanners= data;
	});
} 

function regmembershipsController($scope, $http)
{
	var gethostname=location.hostname;
	$http({method: 'POST', url: 'http://'+gethostname+'/stup_cms/common/json/registrationsmemberships.json'}).success(function(data) {
	$scope.regmembers = data;
	});
}

function servicesController($scope, $http)
{
	var gethostname=location.hostname;
	$http({method: 'POST', url: 'http://'+gethostname+'/stup_cms/common/json/services.json'}).success(function(data) {
	$scope.services = data;
	});
}

function getprojectsController($scope, $http)
{
	var gethostname=location.hostname;
	$http({method: 'POST', url: 'http://'+gethostname+'/stup_cms/common/json/projects.json'}).success(function(data) {
	$scope.projectdata = data;
	});
}	
	
function projectsController($scope, $http)
{
	var gethostname=location.hostname;
	$http({method: 'POST', url: 'http://'+gethostname+'/stup_cms/common/json/projects.json'}).success(function(data) {
	$scope.projects = data;
		$scope.getClass = function ($index) {
			if($index==3 || $index==6)
			{
				return 'noBorder';
			}
			else if($index==0)
			{
				return 'greenText';
			}
			/*else if($index==4)
			{
				return 'greenText';
			}*/
		}; 
	});
	
}

angular.module('StupApp', ['filters']);

angular.module('filters', []).
    filter('truncate', function () {
        return function (text, length, end) {
            if (isNaN(length))
                length = 10;

            if (end === undefined)
                end = "...";

            if (text.length <= length || text.length - end.length <= length) {
                return text;
            }
            else {
                return String(text).substring(0, length-end.length) + end;
            }

        };
    });
	
	
	
	

	