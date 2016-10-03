app.controller('inningCtrl', function ($scope, $modal, $filter, Data) {
    $scope.inning = {};
    Data.get('inning').then(function(data){
        $scope.inning = data.data;
    });
    $scope.changeInningStatus = function(inning){
        inning.status = (inning.status=="Activo" ? "Inactivo" : "Activo");
        Data.put("inning/"+inning.id,{status:inning.status});
    };
    $scope.deleteInning = function(inning){
        if(confirm("¿Esta seguro de eliminar el dato seleccionado?")){
            Data.delete("inning/"+inning.id).then(function(result){
                $scope.innings = _.without($scope.innings, _.findWhere($scope.innings, {id:inning.id}));
            });
        }
    };
    $scope.open = function (p,size) {
        var modalInstance = $modal.open({
          templateUrl: 'partials/inningEdit.html',
          controller: 'inningEditCtrl',
          size: size,
          resolve: {
            item: function () {
              return p;
            }
          }
        });
        modalInstance.result.then(function(selectedObject) {
            if(selectedObject.save == "insert"){
                $scope.innings.push(selectedObject);
                $scope.innings = $filter('orderBy')($scope.innings, 'id', 'reverse');
            }else if(selectedObject.save == "update"){
               p.nombre = selectedObject.nombre;
                p.posicion = selectedObject.posicion;
                p.id_equipo = selectedObject.id_equipo;
            }
        });
    };
    
 $scope.columns = [
                    {text:"ID",predicate:"id",sortable:true,dataType:"number"},
                    {text:"id_accion",predicate:"id_accion",sortable:true},
                    {text:"Equipo",predicate:"id_equipo",sortable:true},
                    {text:"Inning",predicate:"inning",sortable:true},
                    {text:"Bateador",predicate:"id_jugador",sortable:true},
                    {text:"Pitcher",predicate:"pitchet",sortable:true},
                    {text:"Jugada",predicate:"id_jugada",sortable:true},        
                    {text:"Status",predicate:"status",sortable:true},
                    {text:"Action",predicate:"",sortable:false}
                ];

});


app.controller('inningEditCtrl', function ($scope, $modalInstance, item, Data) {

  $scope.inning = angular.copy(item);
        
        $scope.cancel = function () {
            $modalInstance.dismiss('Close');
        };
        $scope.title = (item.id > 0) ? 'Editar' : 'Agregar';
        $scope.buttonText = (item.id > 0) ? 'Actualizar' : 'Agregar';

        var original = item;
        $scope.isClean = function() {
            return angular.equals(original, $scope.inning);
        }
        $scope.saveInning = function (inning) {
            inning.uid = $scope.uid;
            if(inning.id > 0){
                Data.put('inning/'+inning.id, inning).then(function (result) {
                    if(result.status != 'error'){
                        var x = angular.copy(inning);
                        x.save = 'update';
                        $modalInstance.close(x);
                    }else{
                        console.log(result);
                    }
                });
            }else{
                inning.status = 'Activo';
                Data.post('inning', inning).then(function (result) {
                    if(result.status != 'error'){
                        var x = angular.copy(inning);
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
