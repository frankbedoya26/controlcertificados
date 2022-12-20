<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <title>Document</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ public_path('css/pdf.css') }}" />


</head>

<body>
    <header>
        <br>
        <p><strong>Formato de control de emisión de certificado</strong></p>
    </header>
        <div class="tamano_general">
        <h5 style="text-align: center"><strong>Lista de certificado</strong></h5>
        <table class="table table-striped table-bordered">
            <thead>
                <tr class="text-center">

                    <th scope="col" style="width:2.7cm;">CODIGO</th>
                        <th scope="col" style="width:8cm;">APELLIDOS Y NOMBRES</th>
                        <th scope="col" style="width:0.8cm;">N° SEM</th>
                        <th scope="col" style="width:1.4cm;">MONTO</th>
                        <th scope="col" style="width:1.4cm;">TIPO</th>
                        <th scope="col" style="width:1.4cm;">ESTADO</th>
                        <th scope="col">Firma</th>
                        <th scope="col">DNI</th>
                </tr>
            </thead>
           <tbody>
            @foreach($certificado as $cert)
                    <tr>
                        <td>{{$cert->Codigo}}</td>
                        <td>{{$cert->Nombre}}</td>
                        <td>{{$cert->cantsem}}</td>
                        <td class="text-center">{{$cert->monto}}</td>
                        <td>{{$cert->Tipo}}</td>
                        <td>{{$cert->esta}}</td>
                        <td></td><td></td>
                    </tr>
                    @endforeach
                   
            </tbody>
        </table>
        </div>
    <footer>
        <!-- <p><strong>Leyenda</strong></p> -->
    </footer>
</body>

</html>