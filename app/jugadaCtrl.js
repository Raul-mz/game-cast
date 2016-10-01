app.controller('jugadaCtrl', function ($scope, $modal, $filter, Data) {
    $scope.jugada = {};
    Data.get('jugada').then(function(data){
        $scope.jugadas = data.data;
    });
    $scope.changeJugadaStatus = function(jugada){
        jugada.status = (jugada.status=="Activo" ? "Inactivo" : "Activo");
        Data.put("jugada/"+jugada.id,{status:jugada.status});
    };
    $scope.deleteJugada = function(jugada){
        if(confirm("¿Esta seguro de eliminar el dato seleccionado?")){
            Data.delete("jugada/"+jugada.id).then(function(result){
                $scope.jugadas = _.without($scope.jugadas, _.findWhere($scope.jugadas, {id:jugada.id}));
            });
        }
    };
    $scope.open = function (p,size) {
        var modalInstance = $modal.open({
          templateUrl: 'partials/jugadaEdit.html',
          controller: 'jugadaEditCtrl',
          size: size,
          resolve: {
            item: function () {
              return p;
            }
          }
        });
        modalInstance.result.then(function(selectedObject) {
            if(selectedObject.save == "insert"){
                $scope.jugadas.push(selectedObject);
                $scope.jugadas = $filter('orderBy')($scope.jugadas, 'id', 'reverse');
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


app.controller('jugadaEditCtrl', function ($scope, $modalInstance, item, Data) {

  $scope.jugada = angular.copy(item);
        
        $scope.cancel = function () {
            $modalInstance.dismiss('Close');
        };
        $scope.title = (item.id > 0) ? 'Editar' : 'Agregar';
        $scope.buttonText = (item.id > 0) ? 'Actualizar' : 'Agregar';

        var original = item;
        $scope.isClean = function() {
            return angular.equals(original, $scope.jugada);
        }
        $scope.saveJugada = function (jugada) {
            jugada.uid = $scope.uid;
            if(jugada.id > 0){
                Data.put('jugada/'+jugada.id, jugada).then(function (result) {
                    if(result.status != 'error'){
                        var x = angular.copy(jugada);
                        x.save = 'update';
                        $modalInstance.close(x);
                    }else{
                        console.log(result);
                    }
                });
            }else{
                jugada.status = 'Activo';
                Data.post('jugada', jugada).then(function (result) {
                    if(result.status != 'error'){
                        var x = angular.copy(jugada);
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
