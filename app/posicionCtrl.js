app.controller('posicionCtrl', function ($scope, $modal, $filter, Data) {
    $scope.posicion = {};
    Data.get('posicion').then(function(data){
        $scope.posicions = data.data;
        console.log(data.message);
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
                p.loguito = selectedObject.loguito;
                p.jj = selectedObject.jj;
                p.jg = selectedObject.jg;
                p.jp = selectedObject.jp;
                p.div = selectedObject.divi;
                p.ave = selectedObject.ave;
            }
        });
    };
    
 $scope.columns = [
                    {text:"ID",predicate:"id",sortable:true,dataType:"number"},
                    {text:"loguito",predicate:"loguito",sortable:true},
                    {text:"JJ",predicate:"jj",sortable:true},
                    {text:"JG",predicate:"jg",sortable:true},
                    {text:"JP",predicate:"jp",sortable:true},
                    {text:"DIV",predicate:"divi",sortable:true},
                    {text:"AVE",predicate:"ave",sortable:true},
                    {text:"Status",predicate:"status",sortable:true},
                    {text:"Acción",predicate:"",sortable:false}
                ];

});


app.controller('posicionEditCtrl', function ($scope, $modalInstance, item, Data) {

  $scope.posicion = angular.copy(item);
        
        $scope.cancel = function () {
            $modalInstance.dismiss('Close');
        };
        $scope.title = (item.id > 0) ? 'Editar' : 'Agregar';
        $scope.buttonText = (item.id > 0) ? 'Actualizar' : 'Agregar';

        var original = item;
        $scope.isClean = function() {
            return angular.equals(original, $scope.posicion);
        }
        $scope.savePosicion = function (posicion) {
            posicion.uid = $scope.uid;
            if(posicion.id > 0){
                Data.put('posicion/'+posicion.id, posicion).then(function (result) {
                    if(result.status != 'error'){
                        var x = angular.copy(posicion);
                        x.save = 'update';
                        $modalInstance.close(x);
                    }else{
                        console.log(result);
                    }
                });
            }else{
                posicion.status = 'Activo';
                Data.post('posicion', posicion).then(function (result) {
                    if(result.status != 'error'){
                        var x = angular.copy(posicion);
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
