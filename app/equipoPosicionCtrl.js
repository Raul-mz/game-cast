app.controller('equipoPosicionCtrl', function ($scope, $modal, $filter, Data) {
    $scope.equipo = {};
    Data.get('equipo').then(function(data){
        $scope.equipos = data.data;
        console.log(data.message);
    });
    $scope.changeEquipoPosicionStatus = function(equipo){
        equipo.status = (equipo.status=="Activo" ? "Inactivo" : "Activo");
        Data.put("equipo/"+equipo.id,{status:equipo.status});
    };
    $scope.deleteEquipoPosicion = function(equipo){
        if(confirm("¿Esta seguro de eliminar el dato seleccionado?")){
            Data.delete("equipo/"+equipo.id).then(function(result){
                $scope.equipos = _.without($scope.equipos, _.findWhere($scope.equipos, {id:equipo.id}));
            });
        }
    };
    $scope.open = function (p,size) {
        var modalInstance = $modal.open({
          templateUrl: 'partials/equipoPosicionEdit.html',
          controller: 'equipoPosicionEditCtrl',
          size: size,
          resolve: {
            item: function () {
              return p;
            }
          }
        });
        modalInstance.result.then(function(selectedObject) {
            if(selectedObject.save == "insert"){
                $scope.equipos.push(selectedObject);
                $scope.equipos = $filter('orderBy')($scope.equipos, 'id', 'reverse');
            }else if(selectedObject.save == "update"){
                p.jj = selectedObject.jj;
                p.jg = selectedObject.jg;
                p.jp = selectedObject.jp;
                p.dive = selectedObject.dive;
                p.ave = selectedObject.ave;
            }
        });
    };
    
 $scope.columns = [
                    {text:"ID",predicate:"id",sortable:true,dataType:"number"},
                    {text:"Nombre",predicate:"nombre",sortable:true},
                    {text:"Imagen",predicate:"imagen",sortable:true},
                    {text:"JJ",predicate:"jj",sortable:true},
                    {text:"JG",predicate:"jg",sortable:true},
                    {text:"JP",predicate:"jp",sortable:true},
                    {text:"DIV",predicate:"dive",sortable:true},
                    {text:"AVE",predicate:"ave",sortable:true},
                    {text:"Status",predicate:"status",sortable:true},
                    {text:"Acción",predicate:"",sortable:false}
                ];

});


app.controller('equipoPosicionEditCtrl', function ($scope, $modalInstance, item, Data) {

  $scope.equipo = angular.copy(item);
        
        $scope.cancel = function () {
            $modalInstance.dismiss('Close');
        };
        $scope.title = (item.id > 0) ? 'Editar' : 'Agregar';
        $scope.buttonText = (item.id > 0) ? 'Actualizar' : 'Agregar';

        var original = item;
        $scope.isClean = function() {
            return angular.equals(original, $scope.equipo);
        }
        $scope.saveEquipoPosicion = function (equipo) {
            equipo.uid = $scope.uid;
            if(equipo.id > 0){
                Data.put('equipo/'+equipo.id, equipo).then(function (result) {
                    if(result.status != 'error'){
                        var x = angular.copy(equipo);
                        x.save = 'update';
                        $modalInstance.close(x);
                    }else{
                        console.log(result);
                        console.log(data.message);
                    }
                });
            }else{
                equipo.status = 'Activo';
                Data.post('equipo', equipo).then(function (result) {
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
