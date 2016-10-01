app.controller('posicionCtrl', function ($scope, $modal, $filter, Data) {
    $scope.posicion = {};
    Data.get('posicion').then(function(data){
        $scope.posicions = data.data;
        console.log(data.message)
    });
    $scope.changePosicionStatus = function(posicion){
        posicion.status = (posicion.status=="Activo" ? "Inactivo" : "Activo");
        Data.put("posicion/"+posicion.id,{status:posicion.status});
    };
    $scope.deletePosicion = function(posicion){
        if(confirm("¿Esta seguro de eliminar el dato seleccionado?")){
            Data.delete("posicion/"+posicion.id).then(function(result){
                $scope.posicions = _.without($scope.posicions, _.findWhere($scope.posicions, {id:posicion.id}));
            });
        }
    };
    $scope.open = function (p,size) {
        var modalInstance = $modal.open({
          templateUrl: 'partials/posicionEdit.html',
          controller: 'posicionEditCtrl',
          size: size,
          resolve: {
            item: function () {
              return p;
            }
          }
        });
        modalInstance.result.then(function(selectedObject) {
            if(selectedObject.save == "insert"){
                $scope.posicions.push(selectedObject);
                $scope.posicions = $filter('orderBy')($scope.posicions, 'id', 'reverse');
            }else if(selectedObject.save == "update"){
                p.nombre = selectedObject.nombre;
                p.imagen = selectedObject.imagen;
                p.jj = selectedObject.jj;
                p.jg = selectedObject.jg;
                p.jp = selectedObject.jp;
                p.div = selectedObject.div;
                p.ave = selectedObject.ave;
            }
        });
    };
    
 $scope.columns = [
                    {text:"ID",predicate:"id",sortable:true,dataType:"number"},
                    {text:"Equipo",predicate:"loguito",sortable:true},
                    {text:"JJ",predicate:"jj",sortable:true},
                    {text:"JG",predicate:"jg",sortable:true},
                    {text:"JP",predicate:"jp",sortable:true},
                    {text:"DIV",predicate:"div",sortable:true},
                    {text:"AVE",predicate:"ave",sortable:true},
                    {text:"Status",predicate:"status",sortable:true},
                    {text:"Acción",predicate:"",sortable:false}
                ];

});


app.controller('poscionEditCtrl', function ($scope, $modalInstance, item, Data) {

  $scope.poscion = angular.copy(item);
        
        $scope.cancel = function () {
            $modalInstance.dismiss('Close');
        };
        $scope.title = (item.id > 0) ? 'Editar' : 'Agregar';
        $scope.buttonText = (item.id > 0) ? 'Actualizar' : 'Agregar';

        var original = item;
        $scope.isClean = function() {
            return angular.equals(original, $scope.poscion);
        }
        $scope.Saveposcion = function (poscion) {
            poscion.uid = $scope.uid;
            if(poscion.id > 0){
                Data.put('poscion/'+poscion.id, poscion).then(function (result) {
                    if(result.status != 'error'){
                        var x = angular.copy(poscion);
                        x.save = 'update';
                        $modalInstance.close(x);
                    }else{
                        console.log(result);
                    }
                });
            }else{
                poscion.status = 'Activo';
                Data.post('poscion', poscion).then(function (result) {
                    if(result.status != 'error'){
                        var x = angular.copy(poscion);
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
