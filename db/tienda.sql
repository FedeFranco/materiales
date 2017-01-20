drop table if exists clientes cascade;
create table clientes(
    id bigserial constraint pk_clientes primary key,
    nombre_cliente varchar(100) not null,
    edad numeric(2)
);

drop table if exists productos cascade;
create table productos(
    id bigserial constraint pk_productos primary key,
    nombre_producto varchar(100) not null

);

drop table if exists compras cascade;
create table compras(
    id bigserial constraint pk_compras primary key,
    productos_id bigint not null constraint fk_compras_productos
                references productos (id),
    clientes_id bigint not null constraint fk_compras_clientes
                references clientes (id),

    precio numeric(5,2) not null
);
