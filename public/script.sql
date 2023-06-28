create database Diagrama;
 use Diagrama;

create table Casa(
id int not null,
+Dir  varchar (50),
id_Persona,
id_Persona int not null,
 foreign key (id_Persona) references Persona(id) ON DELETE CASCADE  ON UPDATE CASCADE,
id_Tipo int not null,
foreign key (id_Tipo) references Tipo(id) ON DELETE CASCADE  ON UPDATE CASCADE,
primary key (id)
); 
create table Persona(
id int not null,
+attr,
primary key (id)
); 
create table Tipo(
id int not null,
+ID,
Tipo,
primary key (id)
); 
create table Class2(
id int not null,
+attr,
id_Persona int not null,
foreign key (id_Persona) references Persona(id) ON DELETE CASCADE  ON UPDATE CASCADE,
primary key (id)
); 
