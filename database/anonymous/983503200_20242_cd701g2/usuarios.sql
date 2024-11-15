create or replace table `983503200_20242_cd701g2`.usuarios
(
    id             int auto_increment
        primary key,
    nombre         varchar(50)                                             not null,
    apellido       varchar(50)                                             not null,
    correo         varchar(100)                                            not null,
    contraseña     varchar(100)                                            not null,
    fecha_registro timestamp                   default current_timestamp() null,
    fecha_creacion timestamp                   default current_timestamp() null,
    estado         enum ('activo', 'inactivo') default 'activo'            null,
    id_rol         int                                                     null,
    constraint correo
        unique (correo),
    constraint fk_usuarios_rol
        foreign key (id_rol) references `983503200_20242_cd701g2`.rol (id)
);

