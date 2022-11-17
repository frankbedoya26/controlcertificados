<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            Gestión de alumnos
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalumno">Registrar
            </button>
        </div>

    </div>
    <div class="card-body">
                                             <div class="row">
                                            <div class="form-group col-md-12 col-sm-12 col-12">
                                                <label>Buscar</label>
                                                <input type="text" class="form-control" @keyup="getalumno()" placeholder="Buscar..." v-model="txtbus">
                                            </div>
                                        </div>
        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
            <thead class="table-success">
                <tr>
                    <th>DNI</th>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Carrera</th>
                    <th>Tipo</th>
                    <th>Gestión</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="alum in alumnos">
                    <td>@{{alum.dni}}</td>
                    <td>@{{alum.codigo}}</td>
                    <td>@{{alum.ape}} @{{alum.nom}}</td>
                    <td>@{{alum.carrera}}</td>
                    <td>@{{alum.tipo}}</td>
                    <td>
                        <button class="btn btn-primary btn-sm" title="Editar" @click="seleccionar(alum)"><i class="fas fa-pencil-alt"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        </div>
    </div>
</div>


<div class="modal fade bd-example-modal-lg" id="modalumno" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="staticBackdropLabel">Registro de alumnos</h5>
                <button type="button" @click="" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-3">
                        <label>DNI</label>
                        <input type="text" class="form-control" v-model="txtdni" autocomplete="off" maxlength="8" onkeypress="return soloNumeros(event);">
                    </div>
                    <div class="form-group col-md-5">
                        <label>Apellido</label>
                        <input type="text" class="form-control" v-model="txtape" autocomplete="off">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Nombre</label>
                        <input type="text" class="form-control" v-model="txtnom" autocomplete="off">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label>Código</label>
                        <input type="text" class="form-control" v-model="txtcod" autocomplete="off">
                    </div>
                    <div class="form-group col-md-5">
                        <label>Carrera</label>
                        <input type="text" class="form-control" v-model="txtcarr" autocomplete="off">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Telefono</label>
                        <input type="text" class="form-control" v-model="txttel" autocomplete="off">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-8">
                        <label>Dirección</label>
                        <input type="text" class="form-control" v-model="txtdir" autocomplete="off">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Correo</label>
                        <input type="text" class="form-control" v-model="txtcorr" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" @click="limpiar()">Cerrar</button>
                <button class="btn btn-info" @click="guardar()">Guardar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="modalumnoe" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="staticBackdropLabel">Editar alumnos</h5>
                <button type="button" @click="" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-3">
                        <label>DNI</label>
                        <input type="text" class="form-control" v-model="txtdnie" disabled="true" autocomplete="off">
                    </div>
                    <div class="form-group col-md-5">
                        <label>Apellido</label>
                        <input type="text" class="form-control" v-model="txtapee" autocomplete="off">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Nombre</label>
                        <input type="text" class="form-control" v-model="txtnome" autocomplete="off">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label>Código</label>
                        <input type="text" class="form-control" v-model="txtcode" disabled="true" autocomplete="off">
                    </div>
                    <div class="form-group col-md-5">
                        <label>Carrera</label>
                        <input type="text" class="form-control" v-model="txtcarre" autocomplete="off">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Telefono</label>
                        <input type="text" class="form-control" v-model="txttele" autocomplete="off">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-8">
                        <label>Dirección</label>
                        <input type="text" class="form-control" v-model="txtdire" autocomplete="off">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Correo</label>
                        <input type="text" class="form-control" v-model="txtcorre" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button class="btn btn-info" @click="editar()">Guardar</button>
            </div>
        </div>
    </div>
</div>


