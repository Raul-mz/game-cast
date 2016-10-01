app.controller('accionCtrl', function ($scope, $modal, $filter, Data) {
    $scope.accion = {};
    Data.get('accion').then(function(data){
        $scope.accions = data.data;
    });
    $scope.changeAccionStatus = function(accion){
        accion.status = (accion.status=="Activo" ? "Inactivo" : "Activo");
        Data.put("accion/"+accion.id,{status:accion.status});
    };
    $scope.deleteAccion = function(accion){
        if(confirm("¿Esta seguro de eliminar el dato seleccionado?")){
            Data.delete("accion/"+accion.id).then(function(result){
                $scope.accions = _.without($scope.accions, _.findWhere($scope.accions, {id:accion.id}));
            });
        }
    };
    $scope.open = function (p,size) {
        var modalInstance = $modal.open({
          templateUrl: 'partials/accionEdit.html',
          controller: 'accionEditCtrl',
          size: size,
          resolve: {
            item: function () {
              return p;
            }
          }
        });
        modalInstance.result.then(function(selectedObject) {
            if(selectedObject.save == "insert"){
                $scope.accions.push(selectedObject);
                $scope.accions = $filter('orderBy')($scope.accions, 'id', 'reverse');
            }else if(selectedObject.save == "update"){
                p.nombre = selectedObject.nombre;
                
            }
        });
    };
    
 $scope.columns = [
                    {text:"ID",predicate:"id",sortable:true,dataType:"number"},
                    {text:"nombre",predicate:"nombre",sortable:true},
                    {text:"Status",predicate:"status",sortable:true},
                    {text:"Action",predicate:"",sortable:false}
                ];

});


app.controller('accionEditCtrl', function ($scope, $modalInstance, item, Data) {

  $scope.accion = angular.copy(item);
        
        $scope.cancel = function () {
            $modalInstance.dismiss('Close');
        };
        $scope.title = (item.id > 0) ? 'Editar' : 'Agregar';
        $scope.buttonText = (item.id > 0) ? 'Actualizar' : 'Agregar';

        var original = item;
        $scope.isClean = function() {
            return angular.equals(original, $scope.accion);
        }
        $scope.saveAccion = function (accion) {
            accion.uid = $scope.uid;
            if(accion.id > 0){
                Data.put('accion/'+accion.id, accion).then(function (result) {
                    if(result.status != 'error'){
                        var x = angular.copy(accion);
                        x.save = 'update';
                        $modalInstance.close(x);
                    }else{
                        console.log(result);
                    }
                });
            }else{
                accion.status = 'Activo';
                Data.post('accion', accion).then(function (result) {
                    if(result.status != 'error'){
                        var x = angular.copy(accion);
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
