CREATE DATABASE tienda_master;

USE tienda_master;

CREATE TABLE usuarios(
id int(255) auto_increment not null,
nombre varchar(100) not null,
apellidos varchar(255) ,
email varchar(255) not null,
password varchar(255) not null,
rol varchar(255),
imagen varchar(255),
CONSTRAINT pk_usuarios PRIMARY KEY(id),
CONSTRAINT uq_email UNIQUE(email)
)ENGINE = InnoDb;

INSERT INTO usuarios VALUES(null,'Admin','Admin','admin@admin.com','admin','admin',null);

CREATE TABLE categorias(
id int(255) auto_increment not null,
nombre varchar(100) not null,
CONSTRAINT pk_categorias PRIMARY KEY(id)
)ENGINE = InnoDb;

INSERT INTO categorias VALUES(null,'Manga Corta');
INSERT INTO categorias VALUES(null,'Tirantes');
INSERT INTO categorias VALUES(null,'Manga Larga');
INSERT INTO categorias VALUES(null,'Sudaderas');

CREATE TABLE productos(
id int(255) auto_increment not null,
categoria_id int(255) not null,
nombre varchar(100) not null,
descripcion text not null,
precio float(100,2) not null,
stock int(255) not null,
oferta varchar(2),
fecha date not null,
imagen varchar(255),
CONSTRAINT pk_productos PRIMARY KEY(id),
CONSTRAINT fk_producto_categoria FOREIGN KEY (categoria_id) REFERENCES categorias(id)
)ENGINE = InnoDb;

CREATE TABLE pedidos(
id int(255) auto_increment not null,
usuario_id int(255) not null,
provincia varchar(100) not null,
localidad  varchar(100) not null,
direccion varchar(255) not null,
precio float(100,2) not null,
estado varchar(20) not null,
fecha date not null,
hora time,
CONSTRAINT pk_pedidos PRIMARY KEY(id),
CONSTRAINT fk_pedidos_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
)ENGINE = InnoDb;

CREATE TABLE lineasPedidos(
    id int(255) auto_increment not null,
    pedido_id int(255) not null,
    producto_id int(255) not null,
    unidades int(255) not null,
    CONSTRAINT pk_lineasPedidos PRIMARY KEY(id),
    CONSTRAINT fk_lineaPedido FOREIGN KEY (pedido_id) REFERENCES pedidos(id);
    CONSTRAINT fk_lineaProducto FOREIGN KEY (producto_id) REFERENCES productos(id);
)ENGINE = InnoDb;
