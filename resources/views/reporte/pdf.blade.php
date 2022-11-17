<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Document</title>

    <link rel="stylesheet" href="{{ public_path('css/pdf.css') }}" />


</head>

<body>

    <header class="cabecera">
        <div class="div_pdfsuperior">
            <div class="div_pdflogo">
                <img class="pdf_logo" src="{{ public_path('img/unasam.png') }}" alt="logo">
            </div>
            <div class="pdf_titulo">
                <h4>UNIVERSIDAD NACIONAL "SANTIAGO ANTUNEZ DE MAYOLO"</h4>
                <h3 class="titulo_acta">LISTA DE CERTIFICADOS</h3>
            </div>
        </div>
        <div class="cuadro">
            <h6 class="titulito">FECHA: {{$fec}}</h6>
            <h6 class="titulito">DESDE: {{$fecdes}}</h6>
            <h6 class="titulito">HASTA: {{$fechas}}</h6>

            <!--h6 class="titulito">HASTA: {{$cadena}}</h6-->
        </div>  
    </header>
<div class="container">
        <table class=" table table-striped tableuda">
            <thead>
                    <tr>
                        <th class="tablex">CODIGO</th>
                        <th class="tablex">APELLIDOS Y NOMBRES</th>
                        <th class="tablex">SEMESTRES</th>
                        <th class="tablex">MONTO</th>
                        <th class="tablex">TIPO</th>
                        <th class="tablex">ESTADO</th>
                    </tr>
                </thead>
                <tbody>
                     @foreach($certificado as $cert)
                    <tr>
                        <td class="tablex">{{$cert->Codigo}}</td>
                        <td class="tablex">{{$cert->Nombre}}</td>
                        <td class="tablex">{{$cert->cantsem}}</td>
                        <td class="tablex">{{$cert->monto}}</td>
                        <td class="tablex">{{$cert->Tipo}}</td>
                        <td class="tablex">{{$cert->esta}}</td>
                    </tr>
                    @endforeach
                </tbody>
        </table>
    </div>

</body>

</html>