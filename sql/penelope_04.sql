create table manejadores_sesion (
  id          int not null auto_increment,
  id_usuario  int not null,
  manejador   int not null, -- 0: facebook, 1: google, 2: twitter
  nombre      varchar(100) not null,
  descripcion varchar(100) not null,
  primary key (id),
  foreign key (id_usuario) references usuarios(id)
);
