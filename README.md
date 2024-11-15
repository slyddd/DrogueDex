# DrogueDex

> Una plataforma web para la gestión de la información de medicamentos, enfocada en brindar una interfaz amigable y
> accesible para los empleados de droguerías en Fusagasugá.

## Tabla de Contenidos

- [DropueDex](#droguedex)
    - [Tabla de Contenidos](#tabla-de-contenidos)
    - [Introducción](#introducción)
    - [Requerimientos](#requerimientos)
    - [Instalación](#instalación)
    - [Licencia](#licencia)

## Introducción

DrogueDex es una plataforma web que busca facilitar la gestión de la información de medicamentos en droguerías de
Fusagasugá. La plataforma permite a los empleados de las droguerías llevar un registro de los medicamentos que se
encuentran en la droguería, así como de los proveedores de los mismos.

**TODO: Completar introducción con capturas de la aplicacion**

## Requerimientos

Para poder instalar y utilizar DrogueDex, es necesario contar con los siguientes requerimientos:

- PHP 5.6 o superior
- MySQL 5.7 o superior
- Apache 2.4 o superior
- Git
- Un navegador web moderno
- Un sistema operativo compatible con los requerimientos anteriores

## Instalación

Para instalar DrogueDex, es necesario seguir los siguientes pasos:

1. Clonar el repositorio de GitHub en la carpeta de su servidor web:

```bash
git clone https://github.com/slyddd/DrogueDex.git
```

2. Crear una base de datos en MySQL para DrogueDex:

```sql
CREATE
DATABASE <nombre de la base de datos>;
```

3. Usar los archivos de la carpeta `database/anonymous/983503200_20242_cd701g2/` para crear las tablas necesarias en la
   base de datos:

```bash
mysql -u <usuario> -p <nombre de la base de datos> < database/anonymous/983503200_20242_cd701g2/<nombre del archivo>.sql
```

8. Crear los usuarios y roles necesarios en la base de datos para la aplicación.

9. Monta el proyecto en tu servidor web.

10. Listo, ya puedes empezar a utilizar DrogueDex.

## Licencia

DrogueDex se encuentra bajo la licencia [MIT](LICENSE).