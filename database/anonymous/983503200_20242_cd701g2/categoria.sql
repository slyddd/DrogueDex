create or replace table `983503200_20242_cd701g2`.categoria
(
    id             int auto_increment
        primary key,
    nombre         varchar(50)                                             not null,
    descripcion    text                                                    null,
    fecha_creacion timestamp                   default current_timestamp() null,
    estado         enum ('activo', 'inactivo') default 'activo'            null
);

