<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            @{{tituloprin}}
        </h3>
    </div>
    <div class="card-body">
        <div class="row" v-if="divbuscar">
            <div class="form-group col-md-2">
                <select class="form-control" v-model="cbotipo">
                    <option value="0">Seleccione</option>
                    <option value="Pregrado">Pregrado</option>
                    <option value="Posgrado">Postgrado</option>
                    <option value="Cacip">Cacip</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <div class="input-group">
                    <input type="text" class="form-control" v-model="txtbuscar" autocomplete="off" placeholder="Código, Dni o nombre del alumno">
                    <div class="input-group-append">
                        <button class="btn btn-primary" @click="getalumno()"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control" v-model="txtalumen" disabled="true">
                    <div class="input-group-append">
                        <button class="btn btn-primary" id="btnemp" @click="empezar()">Empezar</i></button>
                    </div>
                </div>
            </div>
            <div class="table-responsive" v-if="tabalumnos">
                <table class="table table-striped table-bordered table-hover">
                    <thead class="table-success">
                <tr>
                    <th>Dni</th>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Seleccionar</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="alum in alumno">
                    <td>@{{alum.Dni}}</td>
                    <td>@{{alum.Alumno}}</td>
                    <td>@{{alum.NombreCompleto}}</td>
                    <td><button class="btn btn-info" @click="seleccionar(alum)">Seleccionar</button></td>
                </tr>
            </tbody>
                </table>
                        
            </div>
        </div>
        <div v-if="divdatos">
            <div class="row">
                <div class="col-12">
                    <h3>Datos generales</h3>
                </div>
                <div class="form-group col-md-4 col-sm-6">
                    <label>Programa de estudios</label><br>
                    @{{programaes}}
                </div>
                <div class="form-group col-md-4 col-sm-6">
                    <label>Nivel de cetificado</label><br>
                    @{{tipo}}
                </div>
                <div class="form-group col-md-4 col-sm-6">
                    <label>Apellidos y Nombres</label><br>
                    @{{nomcompleto}}
                </div>
                <div class="form-group col-md-4 col-sm-6">
                    <label>DNI</label><br>
                    @{{dni}}
                </div>
                <div class="form-group col-md-4 col-sm-6">
                    <label>Código</label><br>
                    @{{codigo}}
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h3>Datos de contacto</h3>
                </div>
                <div class="form-group col-md-6">
                    <label>Email</label>
                    <input type="text" class="form-control" autocomplete="off" v-model="txtemail">
                </div>
                <div class="form-group col-md-6">
                    <label>Telefono</label>
                    <input type="text" class="form-control" autocomplete="off" v-model="txttel">
                </div>
                <div class="form-group col-md-12">
                    <label>Dirección</label>
                    <input type="text" class="form-control" autocomplete="off" v-model="txtdir">
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h3>Datos del certificado</h3>
                </div>
                <div class="form-group col-md-3">
                    <label>N° de recibo</label>
                    <input type="text" class="form-control" autocomplete="off" v-model="txtnumreb">
                </div>
                <div class="form-group col-md-3">
                    <label>Fecha de pago</label>
                    <input type="date" class="form-control" autocomplete="off" v-model="txtfecpag">
                </div>
                <div class="form-group col-md-3">
                    <label>Cantidad de semestres</label>
                    <input type="text" class="form-control" v-model="txtcant" autocomplete="off" @keyup="pagar()" onkeypress="return soloNumeros(event);">
                        Costo por semestre s/. @{{monto}}
                </div>
                <div class="form-group col-md-3">
                    <label>Monto</label>
                    <input type="text" class="form-control" v-model="txtmonto" disabled="true">
                </div>
            </div>
            
                    <button class="btn btn-info" @click="enviar()">Enviar solicitud</button>
                
          
        </div>
    </div>
</div>