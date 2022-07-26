<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>
<body>
    <table>
        <thead>
        <tr>
            <th style=" text-align:center;">Fecha de Contrato</th>
            <th style="width:30px; text-align:center;">Empresa</th>
            <th style="width:30px; text-align:center;">Obra</th>
            <th style="width:30px; text-align:center;">Inicio de Obra</th>
            <th style="width:30px; text-align:center;">Fin de Obra</th>            
            <th style="width:30px; text-align:center;">Monto</th>            
            <th style="width:30px; text-align:center;">Descuento</th>            
            <th style="width:30px; text-align:center;">Monto Total</th>
            <th style="width:30px; text-align:center;">Pagos</th>
            <th style="width:30px; text-align:center;">Status</th>
            <th style="width:30px; text-align:center;">Volumen Declarado</th>
            <th style="width:30px; text-align:center;">Volumen Entregado</th>
        </tr>
        </thead>
        <tbody>
            @foreach($obras as $obra)
            <tr>
                <td></td>
                <th>{{$obra->razonsocial}}</th>
                <td>{{$obra->obra}}</td>
                <td>{{$obra->fechainicio}}</td>
                <td>{{$obra->fechafin}}</td>
                <td>${{number_format($obra->monto,2)}}</td>                
                <td>{{$obra->descuento}}%</td>                
                <td>${{number_format($obra->montototal,2)}}</td>                
                <td>${{number_format($obra->pagos,2)}}</td>
                <td></td>
                <td>{{$obra->superficie}} {{$obra->superunidades}}</td>                
                <td>{{$obra->entregado*1}} {{$obra->superunidades}}</td>
            </tr>
            @endforeach
           
        </tbody>
        
    </table>
</body>
</html>
