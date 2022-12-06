CREATE  FUNCTION f_generadigitos(@cantd int,@num int) RETURNS varchar(20) as
BEGIN
declare @mensaje varchar(20);
declare @hasta int;
declare @ctd int;
set @ctd=1;
set @mensaje='';
set @hasta=@cantd-len(@num);
while @ctd<=@hasta
	begin
		set @mensaje=concat('0',@mensaje);
		set @ctd=@ctd+1;
	end
set @mensaje=concat(@mensaje,@num);
return @mensaje;
END

create view v_alumnoprograma as
select a.id,Alumno,NombreCompleto,Curricula,Dni,Direccion,Telefono,correo_institucional Email,Descripcion
from Alumno a,Escuela e where a.Escuela=e.Escuela;


create table certificados.alumcacip(id int not null primary key identity(1,1),dni char(8) not null,codigo varchar(20) not null,
ape varchar(80) not null,nom varchar(80) not null,correo varchar(100) not null,telefo varchar(20) null,carrera varchar(100) not null,
direccon text null,tipo varchar(40) not null,created_at varchar(40),updated_at varchar(40));

create view v_alumcacip as
select id,dni Dni,codigo Alumno,concat(ape,' ',nom) NombreCompleto,correo Email,telefo Telefono,carrera Descripcion,direccon Direccion,tipo nivel 
from certificados.alumcacip;


create table certificados.certificadoall(id int not null primary key identity(1,1),
fecingreso date not null,
fk_certifiid int null,
fk_idalumcac int null,
fk_idalumpp int null,
tip varchar(60)not null,
numreb varchar(40) not null,
numcercacip varchar(40) null,
aniocacip varchar(10) null,
fecpago date not null,
monto decimal(9,2) not null,
fecemisi date null,
fecfirma date null,
fecentrega date null,
costosem decimal(9,2) not null,
cantsem int not null,
esta varchar(25) not null,
created_at varchar(40) null,
updated_at varchar(40) null,
foreign key(fk_certifiid) references certificados.certificados(id),
foreign key(fk_idalumcac) references certificados.alumcacip(id),
foreign key(fk_idalumpp) references dbo.Alumno(id));



create view v_certificadoall as
select c.id,c.fk_idalumpp,concat(c.aniocacip,'-',dbo.f_generadigitos(4,c.numcercacip)) nccip,
concat(cer.anio,'-',dbo.f_generadigitos(4,cer.numero)) numcam,isnull(a.Dni,alumc.Dni) Dni,
isnull(a.Alumno,alumc.codigo) Codigo,
isnull(a.NombreCompleto,concat(alumc.ape,' ',alumc.nom)) Nombre,esta,
c.tip Tipo,fecingreso,fecemisi,fecfirma,fecentrega 
,c.cantsem,c.monto
from certificados.certificadoall c left join certificados.alumcacip alumc  on c.fk_idalumcac=alumc.id  
left join certificados.certificados cer on
c.fk_certifiid=cer.id left join Alumno a on c.fk_idalumpp=a.id;


create view v_verinumcert as
select id,concat(anio,'-',dbo.f_generadigitos(4,numero)) num,alumno_id,FORMAT(created_at, 'yyyy-MM-dd') created,deleted_at from certificados.certificados;

