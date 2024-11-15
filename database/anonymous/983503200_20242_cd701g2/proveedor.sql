create or replace table `983503200_20242_cd701g2`.proveedor
(
    id             int auto_increment
        primary key,
    nombre         varchar(100)                                            not null,
    telefono       varchar(15)                                             null,
    correo         varchar(100)                                            null,
    direccion      varchar(200)                                            null,
    fecha_creacion timestamp                   default current_timestamp() null,
    estado         enum ('activo', 'inactivo') default 'activo'            null,
    constraint correo
        unique (correo)
);

