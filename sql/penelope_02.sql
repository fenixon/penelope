alter table usuarios add column nick varchar(100) not null unique;
alter table usuarios add column contrasenia varchar(100) not null;

