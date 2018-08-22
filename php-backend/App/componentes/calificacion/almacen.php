<?php
$app->post('/calificacion/almacen/listar',function ()use($app){
    $helper = new helper();
    $conexion = new conexPGSeguridad();
    $token = $app->request()->post('token',null);
    if ($token != null){
        $validacionToken = $helper->authCheck($token);
        if ($validacionToken == true){
            $sql = "select ac.* from minutas.almacen_calificacion ac";
            $r = $conexion->consultaComplejaAso($sql);
            $data = [
                'code'=>'LTE-001',
                'data'=> $r
            ];
        }else
        {
            $data =[
              'code'=>'LTE-013'
            ];
        }
    }else
    {
        $data = [
            'code'=>'LTE-013'
        ];
    }
    echo $helper->checkCode($data);
});
$app->post('/calificacion/almacen/actualizarCantidadAlmacen',function ()use($app){
    $helper = new helper();
    $conexion = new conexPGSeguridad();
    $token = $app->request()->post('token',null);
    if ($token != null){
        $validacionToken = $helper->authCheck($token);
        if ($validacionToken == true){
            $json = $app->request->post('json',null);
            $parametros = json_decode($json);
            $id_almacen_calificacion = (isset($parametros->id_almacen_calificacion)) ? $parametros->id_almacen_calificacion : null;
            $total_cantidad_almacen_calificacion = (isset($parametros->total_cantidad_almacen_calificacion)) ? $parametros->total_cantidad_almacen_calificacion: null;
            $sql = "UPDATE minutas.almacen_calificacion
                    SET total_cantidad_almacen_calificacion='$total_cantidad_almacen_calificacion'
                    WHERE id_almacen_calificacion='$id_almacen_calificacion';";
            $conexion->consultaSimple($sql);
            $data = [
                'code'=>'LTE-001'
            ];
        }else
        {
            $data =[
                'code'=>'LTE-013'
            ];
        }
    }else
    {
        $data = [
            'code'=>'LTE-013'
        ];
    }
    echo $helper->checkCode($data);
});
$app->post('/calificacion/almacen/listarUsuariosAlmacen',function ()use($app){
    $helper = new helper();
    $conexion = new conexPGSeguridad();
    $token = $app->request()->post('token',null);
    if ($token != null){
        $validacionToken = $helper->authCheck($token);
        if ($validacionToken == true){
            $sql = "select * from seguridad.usuario usu where usu.id_rol_fk_usuario in (3,5)";
            $r = $conexion->consultaComplejaAso($sql);
            $data = [
                'code'=>'LTE-001',
                'data'=>$r
            ];
        }else
        {
            $data =[
                'code'=>'LTE-013'
            ];
        }
    }else
    {
        $data = [
            'code'=>'LTE-013'
        ];
    }
    echo $helper->checkCode($data);
});