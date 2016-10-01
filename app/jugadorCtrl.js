app.controller('jugadorCtrl', function ($scope, $modal, $filter, Data) {
    $scope.jugador = {};
    Data.get('jugador').then(function(data){
        $scope.jugadors = data.data;
   });
 
    $scope.changeJugadorStatus = function(jugador){
        jugador.status = (jugador.status=="Activo" ? "Inactivo" : "Activo");
        Data.put("jugador/"+jugador.id,{status:jugador.status});
    };
    $scope.deleteJugador = function(jugador){
        if(confirm("¿Esta seguro de eliminar el dato seleccionado?")){
            Data.delete("jugador/"+jugador.id).then(function(result){
                $scope.jugadors = _.without($scope.jugadors, _.findWhere($scope.jugadors, {id:jugador.id}));
            });
        }
    };
    $scope.open = function (p,size) {
        var modalInstance = $modal.open({
          templateUrl: 'partials/jugadorEdit.html',
          controller: 'jugadorEditCtrl',
          size: size,
          resolve: {
            item: function () {
              return p;
            }
          }
        });
        modalInstance.result.then(function(selectedObject) {
            if(selectedObject.save == "insert"){
                $scope.jugadors.push(selectedObject);
                $scope.jugadors = $filter('orderBy')($scope.jugadors, 'id', 'reverse');
            }else if(selectedObject.save == "update"){
                p.nombre = selectedObject.nombre;
                p.posicion = selectedObject.posicion;
                p.id_equipo = selectedObject.id_equipo;
            }
        });
    };
    
 $scope.columns = [
                    {text:"ID",predicate:"id",sortable:true,dataType:"number"},
                    {text:"Nombre",predicate:"nombre",sortable:true},
                    {text:"Posición",predicate:"posicion",sortable:true},
                    {text:"Equipo",predicate:"id_equipo",sortable:true},
                    {text:"Status",predicate:"status",sortable:true},
                    {text:"Acción",predicate:"",sortable:false}
                ];

});


app.controller('jugadorEditCtrl', function ($scope, $modalInstance, item, Data) {

  $scope.jugador = angular.copy(item);
        
        $scope.cancel = function () {
            $modalInstance.dismiss('Close');
        };
        $scope.title = (item.id > 0) ? 'Editar' : 'Agregar';
        $scope.buttonText = (item.id > 0) ? 'Actualizar' : 'Agregar';

        var original = item;
        $scope.isClean = function() {
            return angular.equals(original, $scope.jugador);
        }
        $scope.saveJugador = function (jugador) {
            jugador.uid = $scope.uid;
            if(jugador.id > 0){
                Data.put('jugador/'+jugador.id, jugador).then(function (result) {
                    if(result.status != 'error'){
                        var x = angular.copy(jugador);
                        x.save = 'update';
                        $modalInstance.close(x);
                    }else{
                        console.log(result);
                    }
                });
            }else{
                jugador.status = 'Activo';
                Data.post('jugador', jugador).then(function (result) {
                    if(result.status != 'error'){
                        var x = angular.copy(jugador);
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
function controllerForm($scope, $http) {
      $scope.JSONEquipos = [ ];
      obtenerEquipos($http,$scope);
      // EVENTO QUE GENERA BOTON LIMPIAR
      $scope.limpiar = function() {
        limpiarForm($scope);
      };
      // EVENTO QUE GENERA LA DIRECTIVA ng-change
  
 } 
  function obtenerEquipos($http,$scope){
        console.log('Error:s dddddddddddddddddddaaaa');
      
       $http.post('../beisbol/model/index.php',{ metodo : 'obtenerEquipos' })
       .success(function(data) {
            var array = data == null ? [] : (data.equipos instanceof Array ? data.equipos : [data.equipos]);
            $scope.JSONEquipos  = array;
              $scope.selEquipos   = $scope.JSONEquipos;
         console.log('Error:s aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
        })
        .error(function(data) {
            console.log('Error:s ' + data);
        });    
  }
