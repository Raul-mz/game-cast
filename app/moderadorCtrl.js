app.controller('moderadorCtrl', function ($scope, $modal, $filter, Data) {
    $scope.moderador = {};
    Data.get('moderador').then(function(data){
        $scope.moderadors = data.data;
    });
    $scope.changeModeradorStatus = function(moderador){
        moderador.status = (moderador.status=="Activo" ? "Inactivo" : "Activo");
        Data.put("moderador/"+moderador.id,{status:moderador.status});
    };
    $scope.deleteModerador = function(moderador){
        if(confirm("¿Esta seguro de eliminar el dato seleccionado?")){
            Data.delete("moderador/"+moderador.id).then(function(result){
                $scope.moderadors = _.without($scope.moderadors, _.findWhere($scope.moderadors, {id:moderador.id}));
            });
        }
    };
    $scope.open = function (p,size) {
        var modalInstance = $modal.open({
          templateUrl: 'partials/moderadorEdit.html',
          controller: 'moderadorEditCtrl',
          size: size,
          resolve: {
            item: function () {
              return p;
            }
          }
        });
        modalInstance.result.then(function(selectedObject) {
            if(selectedObject.save == "insert"){
                $scope.moderadors.push(selectedObject);
                $scope.moderadors = $filter('orderBy')($scope.moderadors, 'id', 'reverse');
            }else if(selectedObject.save == "update"){
                p.nombre = selectedObject.nombre;
                p.apellido = selectedObject.apellido;
            }
        });
    };
    
 $scope.columns = [
                    {text:"ID",predicate:"id",sortable:true,dataType:"number"},
                    {text:"nombre",predicate:"nombre",sortable:true},
                    {text:"apellido",predicate:"apellido",sortable:true},
                    {text:"Status",predicate:"status",sortable:true},
                    {text:"Acción",predicate:"",sortable:false}
                ];

});


app.controller('moderadorEditCtrl', function ($scope, $modalInstance, item, Data) {

  $scope.moderador = angular.copy(item);
        
        $scope.cancel = function () {
            $modalInstance.dismiss('Close');
        };
        $scope.title = (item.id > 0) ? 'Editar' : 'Agregar';
        $scope.buttonText = (item.id > 0) ? 'Actualizar' : 'Agregar';

        var original = item;
        $scope.isClean = function() {
            return angular.equals(original, $scope.moderador);
        }
        $scope.saveModerador = function (moderador) {
            moderador.uid = $scope.uid;
            if(moderador.id > 0){
                Data.put('moderador/'+moderador.id, moderador).then(function (result) {
                    if(result.status != 'error'){
                        var x = angular.copy(moderador);
                        x.save = 'update';
                        $modalInstance.close(x);
                    }else{
                        console.log(result);
                    }
                });
            }else{
                moderador.status = 'Activo';
                Data.post('moderador', moderador).then(function (result) {
                    if(result.status != 'error'){
                        var x = angular.copy(moderador);
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
