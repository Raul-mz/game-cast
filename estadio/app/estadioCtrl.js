app.controller('estadioCtrl', function ($scope, $modal, $filter, Data) {
    $scope.dato = {};
    Data.get('estadio').then(function(data){
        $scope.estadio = data.data;
    });
    $scope.changeMStatus = function(dato){
        dato.status = (dato.status=="Active" ? "Inactive" : "Active");
        Data.put("estadio/"+dato.id,{status:dato.status});
    };
    $scope.deleteM = function(dato){
        if(confirm("Esta seguro de eliminar el Estadio")){
            Data.delete("estadio/"+dato.id).then(function(result){
                $scope.estadio = _.without($scope.estadio, _.findWhere($scope.estadio, {id:dato.id}));
            });
        }
    };
    $scope.open = function (p,size) {
        var modalInstance = $modal.open({
          templateUrl: 'partials/estadioEdit.html',
          controller: 'estadioEditCtrl',
          size: size,
          resolve: {
            item: function () {
              return p;
            }
          }
        });
        modalInstance.result.then(function(selectedObject) {
            if(selectedObject.save == "insert"){
                $scope.estadio.push(selectedObject);
                $scope.estadio = $filter('orderBy')($scope.estadio, 'id', 'reverse');
            }else if(selectedObject.save == "update"){
                p.nombre = selectedObject.nombre;
                p.lugar = selectedObject.lugar;
                
                            }
        });
    };
    
 $scope.columns = [
                    {text:"ID",predicate:"id",sortable:true,dataType:"number"},
                    {text:"Nombre",predicate:"nombre",sortable:true},
                    {text:"Lugar",predicate:"lugar",sortable:true},
                    {text:"Status",predicate:"status",sortable:true},
                    {text:"Acción",predicate:"",sortable:false}
                ];

});


app.controller('estadioEditCtrl', function ($scope, $modalInstance, item, Data) {

  $scope.dato = angular.copy(item);
        
        $scope.cancel = function () {
            $modalInstance.dismiss('Close');
        };
        $scope.title = (item.id > 0) ? 'Estadio' : 'Estadio';
        $scope.buttonText = (item.id > 0) ? 'Actualizar' : 'Agregar';

        var original = item;
        $scope.isClean = function() {
            return angular.equals(original, $scope.dato);
        }
        $scope.saveestadio = function (dato) {
            dato.uid = $scope.uid;
            if(dato.id > 0){
                Data.put('estadio/'+dato.id, dato).then(function (result) {
                    if(result.status != 'error'){
                        var x = angular.copy(dato);
                        x.save = 'update';
                        $modalInstance.close(x);
                    }else{
                        console.log(result);
                    }
                });
            }else{
                dato.status = 'Active';
                Data.post('estadio', dato).then(function (result) {
                    if(result.status != 'error'){
                        var x = angular.copy(dato);
                        x.save = 'insert';
                        x.id = result.data;
                        $modalInstance.close(x);
                    }else{
                        console.log(result);
                    }
                });
            }
        };
});
