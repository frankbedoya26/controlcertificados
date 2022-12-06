<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            Lista de certificados
        </h3>
    </div>
    <div class="card-body">
                                             <div class="row">
                                            <div class="form-group col-md-6 col-sm-6 col-6">
                                                <label>Buscar</label>
                                                <input type="text" class="form-control" @keyup="mostrarcertificado()" placeholder="Buscar..." v-model="txtbus">
                                            </div>
                                            <div class="form-group col-md-6 col-sm-6 col-6">
                                                <label>Estado</label>
                                                <select class="form-control" v-model="cboesta" @change="mostrarcertificado()">
                                                    <option value="0">Seleccione</option>
                                                    <option value="Pendiente">Pendiente</option>
                                                    <option value="En firmas">En firmas</option>
                                                    <option value="Por entregar">Por entregar</option>
                                                    <option value="Entregado">Entregado</option>
                                                </select>
                                            </div>
                                        </div>
        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
            <thead class="table-success">
                <tr>
                    <th>Dni</th>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Tipo</th>
                    <th>Fecha de ingreso</th>
                    <th>Gestión</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="cert in certificado">
                    <td>@{{cert.Dni}}</td>
                    <td>@{{cert.Codigo}}</td>
                    <td>@{{cert.Nombre}}</td>
                    <td>@{{cert.esta}}</td>
                    <td>@{{cert.Tipo}}</td>
                    <td>@{{cert.fecingreso}}</td>
                    <td>
                        <button title="Llenar fecha de emisión" class="btn btn-info btn-sm" @click="fechaemi(cert)" v-if="cert.esta=='Pendiente'"><i class="fas fa-pencil-alt" aria-hidden="true"></i></button>
                        <button title="Llenar fecha de firmas" class="btn btn-info btn-sm" @click="fechafir(cert)" v-if="cert.esta=='En firmas'"><i class="fas fa-pencil-alt" aria-hidden="true"></i></button>
                        <button title="Llenar fecha de entrega" class="btn btn-info btn-sm" @click="fechaent(cert)" v-if="cert.esta=='Por entregar'"><i class="fas fa-pencil-alt" aria-hidden="true"></i></button>

                        <span class="badge badge-success"  v-if="cert.esta=='Entregado'">Proceso finalizado</span>
                    </td>
                </tr>
            </tbody>
        </table>
        </div>
    </div>
    <div class="card-footer">
        <div style="padding: 15px;">
        <div><h6>Registros por Página: @{{ pagination.per_page }}</h6></div>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item" v-if="pagination.current_page>1">
                        <a class="page-link" href="#" @click.prevent="changePage(1)">
                            <span><b>Inicio</b></span>
                        </a>
                    </li>
                    <li class="page-item" v-if="pagination.current_page>1">
                        <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page-1)">
                            <span>Atras</span>
                        </a>
                    </li>
                    <li class="page-item" v-for="page in pagesNumber" v-bind:class="[page=== isActived ? 'active' : '']">
                        <a class="page-link" href="#" @click.prevent="changePage(page)">
                            <span>@{{ page }}</span>
                        </a>
                    </li>
                    <li class="page-item" v-if="pagination.current_page< pagination.last_page">
                        <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page+1)">
                            <span>Siguiente</span>
                        </a>
                    </li>
                    <li class="page-item" v-if="pagination.current_page< pagination.last_page">
                        <a class="page-link" href="#" @click.prevent="changePage(pagination.last_page)">
                            <span><b>Ultima</b></span>
                        </a>
                    </li>
                </ul>
            </nav>
            <div><h6>Registros Totales: @{{ pagination.total }}</h6></div>
      </div>
    </div>
</div>

    <div class="modal fade" id="modfechaemi" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="staticBackdropLabel">Registrar fecha de emisión</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group" v-if="divapp">
                        <label>Número de certificado</label>
                        <select class="form-control" v-model="cbocert" @change="getfechacer()">
                            <option value="0">Seleccione</option>
                            <option v-for="nc in numcert" v-bind:value="nc.id">@{{nc.num}}</option>
                        </select>
                    </div>
                    <div class="form-group" v-if="divacacip">
                        <label>Número de certificado</label>
                        <input type="text" v-model="txtnumcert" class="form-control" autocomplete="off" id="txtnumcert">
                    </div>
                    <div class="form-group" v-if="divacacip">
                        <label>Fecha de emisión</label>
                        <input type="date" v-model="txtfecemi" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button class="btn btn-info" @click="guardafecemi()">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modfechafir" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="staticBackdropLabel">Registrar fecha de firma</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Fecha de firma</label>
                        <input type="date" v-model="txtfecfir" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button class="btn btn-info" @click="validafecfir()">Guardar</button>
                </div>
            </div>
        </div>
    </div>

        <div class="modal fade" id="modfechaentre" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="staticBackdropLabel">Registrar fecha de entrega</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Fecha de entrega</label>
                        <input type="date" v-model="txtfecentre" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button class="btn btn-info" @click="guardafecentre()">Guardar</button>
                </div>
            </div>
        </div>
    </div>

        