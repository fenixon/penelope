use penelope;

create table usuarios (
  id int not null auto_increment,
  admin tinyint(1) not null,
  nombres varchar(100) not null,
  apellidos varchar(100) not null,
  fecha_nac date not null,
  email varchar(255) not null,
  fecha_baja date not null,
  primary key (id),
  unique (email)
);

create table locaciones (
  id int not null auto_increment,
  creador int not null,
  latitud decimal(8, 4) not null,
  longitud decimal(8, 4) not null,
  nombre varchar(255) not null,
  publico tinyint(1) not null,
  primary key (id),
  foreign key (creador) references usuarios(id)
);

create table eventos (
  id int not null auto_increment,
  creador int not null,
  locacion int not null,
  asistencia int not null,
  puntaje int not null,
  titulo varchar(50) not null,
  comienzo date,
  fin date,
  descripcion varchar(140) not null,
  primary key (id),
  foreign key (creador) references usuarios(id),
  foreign key (locacion) references locaciones(id)
);
