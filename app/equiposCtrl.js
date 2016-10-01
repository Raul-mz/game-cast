app.controller('equiposCtrl', function ($scope, $modal, $filter, Data) {
    $scope.jugada = {};
    Data.get('equipos').then(function(data){
        $scope.jugadas = data.data;
    });
    $scope.changeEquipoStatus = function(jugada){
        jugada.status = (jugada.status=="Active" ? "Inactive" : "Active");
        Data.put("equipos/"+jugada.id,{status:jugada.status});
    };
    $scope.deleteEquipo = function(jugada){
        if(confirm("Are you sure to remove the jugada")){
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
                p.logo = selectedObject.logo;
            }
        });
    };
    
 $scope.columns = [
                    {text:"ID",predicate:"id",sortable:true,dataType:"number"},
                    {text:"Nombre",predicate:"nombre",sortable:true},
                    {text:"Logo",predicate:"logo",sortable:true,dataType:"image/png"},
                    {text:"Status",predicate:"status",sortable:true},
                    {text:"Acción",predicate:"",sortable:false}
                ];

});


app.controller('equipoEditCtrl', function ($scope, $modalInstance, item, Data) {

  $scope.equipo = angular.copy(item);
        
        $scope.cancel = function () {
            $modalInstance.dismiss('Close');
        };
        $scope.title = (item.id > 0) ? 'Equipo' : 'Equipo';
        $scope.buttonText = (item.id > 0) ? 'Actualizar Equipo' : 'Agregar Nuevo Equipo';

        var original = item;
        $scope.isClean = function() {
            return angular.equals(original, $scope.equipo);
        }
        $scope.saveEquipo = function (equipo) {
            equipo.uid = $scope.uid;
            if(equipo.id > 0){
                Data.put('equipos/'+equipo.id, equipo).then(function (result) {
                    if(result.status != 'error'){
                        var x = angular.copy(equipo);
                        x.save = 'update';
                        $modalInstance.close(x);
                    }else{
                        console.log(result);
                    }
                });
            }else{
                equipo.status = 'Active';
                Data.post('equipos', equipo).then(function (result) {
                    if(result.status != 'error'){
                        var x = angular.copy(equipo);
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
