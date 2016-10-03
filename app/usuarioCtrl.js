app.controller('usuarioCtrl', function ($scope, $modal, $filter, Data) {
    $scope.usuario = {};
    Data.get('usuario').then(function(data){
        $scope.usuarios = data.data;
        console.log(data.message);
    });
    $scope.changeUsuarioStatus = function(usuario){
        usuario.status = (usuario.status=="Activo" ? "Inactivo" : "Activo");
        Data.put("usuario/"+usuario.id,{status:usuario.status});
    };
    $scope.deleteUsuario = function(usuario){
        if(confirm("¿Esta seguro de eliminar el dato seleccionado?")){
            Data.delete("usuario/"+usuario.id).then(function(result){
                $scope.usuarios = _.without($scope.usuarios, _.findWhere($scope.usuarios, {id:usuario.id}));
            });
        }
    };
    $scope.open = function (p,size) {
        var modalInstance = $modal.open({
          templateUrl: 'partials/usuarioEdit.html',
          controller: 'usuarioEditCtrl',
          size: size,
          resolve: {
            item: function () {
              return p;
            }
          }
        });
        modalInstance.result.then(function(selectedObject) {
            if(selectedObject.save == "insert"){
                $scope.usuarios.push(selectedObject);
                $scope.usuarios = $filter('orderBy')($scope.usuarios, 'id', 'reverse');
            }else if(selectedObject.save == "update"){
                p.nombre = selectedObject.nombre;
                p.correo = selectedObject.correo;
                p.usuario = selectedObject.usuario;
                p.clave = selectedObject.clave;

            }
        });
    };
    
 $scope.columns = [
                    {text:"ID",predicate:"id",sortable:true,dataType:"number"},
                    {text:"Nombre",predicate:"nombre",sortable:true},
                    {text:"Correo",predicate:"correo",sortable:true},
                    {text:"Status",predicate:"status",sortable:true},
                    {text:"Acción",predicate:"",sortable:false}
                ];

});


app.controller('usuarioEditCtrl', function ($scope, $modalInstance, item, Data) {

  $scope.usuario = angular.copy(item);
        
        $scope.cancel = function () {
            $modalInstance.dismiss('Close');
        };
        $scope.title = (item.id > 0) ? 'Editar' : 'Agregar';
        $scope.buttonText = (item.id > 0) ? 'Actualizar' : 'Agregar';

        var original = item;
        $scope.isClean = function() {
            return angular.equals(original, $scope.usuario);
        }
        $scope.saveUsuario = function (usuario) {
            usuario.uid = $scope.uid;
            if(usuario.id > 0){
                Data.put('usuario/'+usuario.id, usuario).then(function (result) {
                    if(result.status != 'error'){
                        var x = angular.copy(usuario);
                        x.save = 'update';
                        $modalInstance.close(x);
       
                    }else{
                        console.log(result);
                    }
                });
            }else{
                usuario.status = 'Activo';
                Data.post('usuario', usuario).then(function (result) {
                    if(result.status != 'error'){
                        var x = angular.copy(usuario);
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
