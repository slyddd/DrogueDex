create or replace table `983503200_20242_cd701g2`.productos
(
    id             int auto_increment
        primary key,
    nombre         varchar(100)                                            not null,
    descripcion    text                                                    null,
    precio         decimal(10, 2)                                          not null,
    stock          int                                                     not null,
    id_categoria   int                                                     null,
    id_proveedor   int                                                     null,
    fecha_registro timestamp                   default current_timestamp() null,
    fecha_creacion timestamp                   default current_timestamp() null,
    estado         enum ('activo', 'inactivo') default 'activo'            null,
    constraint productos_ibfk_1
        foreign key (id_categoria) references `983503200_20242_cd701g2`.categoria (id),
    constraint productos_ibfk_2
        foreign key (id_proveedor) references `983503200_20242_cd701g2`.proveedor (id)
);

create or replace index id_categoria
    on `983503200_20242_cd701g2`.productos (id_categoria);

create or replace index id_proveedor
    on `983503200_20242_cd701g2`.productos (id_proveedor);

