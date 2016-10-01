app.controller('estadioCtrl', function ($scope, $modal, $filter, Data) {
    $scope.estadio = {};
    Data.get('estadio').then(function(data){
        $scope.estadios = data.data;
    });
    $scope.changeEstadioStatus = function(estadio){
        estadio.status = (estadio.status=="Activo" ? "Inactivo" : "Activo");
        Data.put("estadio/"+estadio.id,{status:estadio.status});
    };
    $scope.deleteestadio = function(estadio){
        if(confirm("¿Esta seguro de eliminar el dato seleccionado?")){
            Data.delete("estadio/"+estadio.id).then(function(result){
                $scope.estadios = _.without($scope.estadios, _.findWhere($scope.estadios, {id:estadio.id}));
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
                $scope.estadios.push(selectedObject);
                $scope.estadios = $filter('orderBy')($scope.estadios, 'id', 'reverse');
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

  $scope.estadio = angular.copy(item);
        
        $scope.cancel = function () {
            $modalInstance.dismiss('Close');
        };
        $scope.title = (item.id > 0) ? 'Editar' : 'Agregar';
        $scope.buttonText = (item.id > 0) ? 'Actualizar' : 'Agregar';

        var original = item;
        $scope.isClean = function() {
            return angular.equals(original, $scope.estadio);
        }
        $scope.saveEstadio = function (estadio) {
            estadio.uid = $scope.uid;
            if(estadio.id > 0){
                Data.put('estadio/'+estadio.id, estadio).then(function (result) {
                    if(result.status != 'error'){
                        var x = angular.copy(estadio);
                        x.save = 'update';
                        $modalInstance.close(x);
                    }else{
                        console.log(result);
                    }
                });
            }else{
                estadio.status = 'Activo';
                Data.post('estadio', estadio).then(function (result) {
                    if(result.status != 'error'){
                        var x = angular.copy(estadio);
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
