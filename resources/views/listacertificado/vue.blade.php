<script type="text/javascript">
  let app = new Vue({
    el: '#app',
    data: {
      certificado: [],
      txtbus:'',
      cboesta:0,

      txtfecemi:'',
      txtnumcert:'',
      txtfecfir:'',
      txtfecentre:'',

      idcert:'',

      fecemi:'',
      fecfir:'',

      pagination: {'total': 0,'current_page': 0,'per_page': 0,'last_page': 0,'from': 0,'to': 0},
      offset: 9,
      thispage:'1',

      nivel:'',
    },
    created: function() {
      this.mostrarcertificado();
    },
computed:{
   isActived: function(){
       return this.pagination.current_page;
   },
   pagesNumber: function () {
       if(!this.pagination.to){
           return [];
       }

       var from=this.pagination.current_page - this.offset 
       var from2=this.pagination.current_page - this.offset 
       if(from<1){
           from=1;
       }

       var to= from2 + (this.offset*2); 
       if(to>=this.pagination.last_page){
           to=this.pagination.last_page;
       }

       var pagesArray = [];
       while(from<=to){
           pagesArray.push(from);
           from++;
       }
       return pagesArray;
   }
},
    methods: {
      mostrarcertificado:function(){
        this.getcertificado(this.thispage);
      },
      fecha:function () {
        var url='fecha/actual';
        axios.get(url).then(response=>{
          this.txtfecemi=response.data.fecha;
          this.txtfecfir=response.data.fecha;
          this.txtfecentre=response.data.fecha;
        });
    },
      fechaemi:function(cert){
          this.idcert=cert.id;
          this.fecha();
          $('#modfechaemi').modal('toggle');
      },
      fechafir:function(cert){
            this.idcert=cert.id;
            this.fecemi=cert.fecemisi;
            this.nivel=cert.Tipo;
            this.fecha();
            if(cert.Tipo=="pregrado" || cert.Tipo=="posgrado"){
              this.txtnumcert=cert.numcam;
              $("#txtnumcert").attr('disabled', true);
            }else{
              $("#txtnumcert").removeAttr("disabled");
            }
            $('#modfechafir').modal('toggle');
              
      },
      fechaent:function(cert){
          this.idcert=cert.id;
          this.fecfir=cert.fecfirma;
          this.fecha();
            $('#modfechaentre').modal('toggle');
      },
      getcertificado: function(page) {
        var url = 'listcert?bus='+this.txtbus+'&tipo=0&page='+page;
        if(this.cboesta!=0){
          var url = 'listcert?bus='+this.txtbus+'&esta='+this.cboesta+'&tipo=1&page='+page;
        }
        axios.get(url).then(response => {
          this.pagination= response.data.pagination;
          this.certificado = response.data.certificado.data;
                        if(this.certificado.length==0 && this.thispage!='1'){
                var a = parseInt(this.thispage) ;
                a--;
                this.thispage=a.toString();
                this.changePage(this.thispage);
              }
        })
      },
              changePage:function (page) {
          this.pagination.current_page=page;
          this.getcertificado(page);
          this.thispage=page;
        },
limpiar:function(){
  this.txtfecemi="";
  this.txtfecentre="";
  this.txtfecfir="";
  this.txtnumcert="";
},

      guardafecemi: function() {
        if (this.txtfecemi.trim()!="") {
          var data = new FormData();
          data.append('tipo',"fecemi");
          data.append('fecemi', this.txtfecemi);
          data.append('_method', 'PUT');
          var url="listcert/"+this.idcert;
          axios.post(url, data).then(response => {
            this.getcertificado();
            $('#modfechaemi').modal('toggle');
            this.limpiar();
          }).catch(error => {})
        } else {
          toastr.warning("Debe llenar todos los campos");
        }
      },
      validafecfir: function() {
        if (this.txtfecfir.trim()!="") {
          if(this.fecemi<=this.txtfecfir){
            if (this.nivel!="Cacip") {
              this.guardafecfir();
              $('#modfechafir').modal('toggle');
            }else {
              if (this.txtnumcert.trim()!="") {
                this.guardafecfir();
              $('#modfechafir').modal('toggle');
              }else{
                toastr.warning("Debe de ingresar el número del certificado");
              }
            }
          }else{
toastr.warning("La fecha de firma debe ser mayor o igual a la fecha de emisión");
          }
        } else {
          toastr.warning("Debe llenar la fecha de firma");
        }
      },
      guardafecfir:function(){
var data = new FormData();
          data.append('tipo',"fecfir");
          data.append('fecfir', this.txtfecfir);
          data.append('numcert', this.txtnumcert);
          data.append('nivel', this.nivel);
          data.append('_method', 'PUT');
          var url="listcert/"+this.idcert;
          axios.post(url, data).then(response => {
            this.getcertificado();
              
              this.limpiar();
          }).catch(error => {

          })
      },
            guardafecentre: function() {
        if (this.txtfecentre.trim()!="") {
          if(this.fecfir<=this.txtfecentre){
                      var data = new FormData();
          data.append('tipo',"fecentre");
          data.append('fecentre', this.txtfecentre);
          data.append('_method', 'PUT');
          var url="listcert/"+this.idcert;
          axios.post(url, data).then(response => {
            this.getcertificado();
              $('#modfechaentre').modal('toggle');
              this.limpiar();
          }).catch(error => {})
          }else{
toastr.warning("La fecha de firma debe ser mayor o igual a la fecha de emisión");
          }
        } else {
          toastr.warning("Debe llenar todos los campos");
        }
      },
    },
  });
</script>