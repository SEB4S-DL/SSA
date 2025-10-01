# 📌 SSA - Sistema de Seguimiento de Aprendices

[![PHP](https://img.shields.io/badge/PHP-%3E%3D8.0-blue?logo=php)](https://www.php.net/)  
[![MySQL](https://img.shields.io/badge/MySQL-Database-orange?logo=mysql)](https://www.mysql.com/)  
[![License](https://img.shields.io/badge/License-MIT-green)](LICENSE)  
[![Status](https://img.shields.io/badge/Status-Finalizado-success)]()

---

## 📖 Descripción
**SSA (Sistema de Seguimiento de Aprendices)** es un proyecto final de graduación que ayudará a comprender y observar mejor las fichas del área de desarrollo de software, facilitando un manejo claro de los resultados de aprendizaje y de las observaciones de los instructores por cada aprendiz en dichas fichas.  

Además, permitirá mostrar qué aprendices están **aprobados para las pruebas TIT** en cada ficha.

---

## 📑 Índice
- [Manual de Usuario](#-manual-de-usuario---ssa)
- [Requisitos del sistema](#-requisitos-del-sistema)
- [Primeros pasos](#-primeros-pasos)
- [Guía de uso](#-guía-de-uso)
- [Manual Técnico](#-manual-técnico---ssa)
- [Alcance](#-alcance)
- [Procesos y diagramas](#-procesos-y-diagramas)
- [Descripción de la plataforma](#-descripción-de-la-plataforma)
- [Instalación y mantenimiento](#-instalación-y-mantenimiento)

---

# 📘 Manual de Usuario - SSA

## Introducción
En este documento se dará explicación acerca del software **SSA**...

## Algunas de las acciones que se pueden realizar en SSA son:
- Crear usuarios (instructores y coordinadores).
- Crear fichas.
- Crear programas de formación.
- Importar competencias.
- Importar juicios evaluativos.

## Público objetivo
Este software va dirigido a los instructores y coordinador...

---

# ⚙️ Requisitos del sistema

### Hardware mínimo
- Procesador: Intel i3 de 7a generación o Superior.
- RAM: 4GB.
- 50 MB de almacenamiento disponible.

### Hardware recomendado
- Procesador: Intel i5 de 10a generación o Superior.
- RAM: 8GB.
- 100MB de almacenamiento disponible.

### Software
- Conexión a internet.
- Navegador web actualizado.

---

# 🚀 Primeros pasos
- Ingresar a la página principal...
- Si tiene sesión iniciada llevará a la página principal...
- Para iniciar sesión debe diligenciar los campos...

![Imagen de login](/assets/img/imagenes%20del%20manual%20de%20usuarios/Login.png)

- Tener en cuenta el botón para visualizar la contraseña...
- Luego de diligenciar los campos correspondientes...
- Después de tener sesión iniciada ya puede empezar a usar el sistema.

---

# 🧭 Guía de uso
Al iniciar sesión verá que hay una barra lateral izquierda en la pantalla...

![Sidebar](/assets/img/imagenes%20del%20manual%20de%20usuarios/Sidebar.png)

### Volver a la página principal
El icono del SENA en la barra de navegación es un enlace...

### Secciones de la barra de navegación
- **Inicio:** Donde se gestionan las fichas.
- **Cuentas:** Donde se gestionan las cuentas.
- **Programas:** Donde se gestionan los programas de formación.

### Cambio de idioma
La barra tiene un botón que permite cambiar el idioma...

![Cambio de idioma](/assets/img/imagenes%20del%20manual%20de%20usuarios/CambiarIdioma.png)  
![Popup idiomas](/assets/img/imagenes%20del%20manual%20de%20usuarios/PopUpIdiomas.png)

### Barra de navegación en dispositivos móviles
En los dispositivos móviles la barra de navegación aparecerá...

![Sidebar responsive](/assets/img/imagenes%20del%20manual%20de%20usuarios/SbResponsive.png)  
![Sidebar abierta](/assets/img/imagenes%20del%20manual%20de%20usuarios/SidebarNew.png)

### Cerrar sesión
El icono de cerrar sesión en la barra de navegación es un enlace...

### Cambiar tema
Al dar clic en el botón de cambiar tema aparecerá una ventana emergente...

![Cambiar tema](/assets/img/imagenes%20del%20manual%20de%20usuarios/CambiarTema.png)

- Icono modo claro: ![Claro](/assets/img/imagenes%20del%20manual%20de%20usuarios/Claro.png)  
- Icono modo oscuro: ![Oscuro](/assets/img/imagenes%20del%20manual%20de%20usuarios/Oscuro.png)  
- Icono modo automático: ![Automático](/assets/img/imagenes%20del%20manual%20de%20usuarios/Auto.png)  

### Encabezado
En cada página del software que no sea la de autenticación estará el encabezado...

![Encabezado](/assets/img/imagenes%20del%20manual%20de%20usuarios/Encabezado.png)

---

# 🛠 Manual Técnico - SSA

## Introducción
Este documento es la guía técnica del software **SSA**, creado principalmente para hacer un seguimiento de juicios evaluativos y verificar el avance de los aprendices de los programas **Análisis y Desarrollo de Software** y **Técnico en Programación** del CDITI.  
Cabe aclarar que es independiente de plataformas como Sofía Plus.

### Acciones principales:
- Crear usuarios (instructores y coordinadores).
- Crear fichas.
- Crear programas de formación.
- Importar competencias y resultados de aprendizaje.
- Importar juicios evaluativos.

## Público objetivo
Este software va dirigido a los instructores y coordinador(es) del CDITI que pertenezcan al área de desarrollo de software.

---

# 📋 Requisitos del sistema

### Hardware mínimo
- Procesador: Intel i3 de 7a generación o Superior.
- RAM: 2GB.
- 50 MB de almacenamiento disponible (para archivos CSV).

### Hardware recomendado
- Procesador: Intel i5 de 10a generación o Superior.
- RAM: 8GB.
- 100MB de almacenamiento disponible.

### Software
- Conexión a internet.
- Navegador web actualizado (Chrome, Firefox, Edge, Safari, etc.)

---

# 📌 Alcance
Este manual describe los detalles técnicos de la aplicación **SSA** que permitirán al personal técnico suministrar el soporte de primer nivel.

---

# 🖇 Procesos y diagramas

### Descripción de procesos
El sistema **SSA** soporta el caso de uso “Administrador” de acuerdo al siguiente gráfico:  

![Diagrama de procesos](/assets/img/imagenesDelManualTecnico/DiagramaDeProcesos.png)

### Diagrama de clases
![Diagrama de clases](/assets/img/imagenesDelManualTecnico/DiagramaDeClases.png)

### Modelo relacional
El modelo relacional del sistema es el siguiente:  

![Modelo relacional](/assets/img/imagenesDelManualTecnico/ModeloRelacional.png)

---

# 🌐 Descripción de la plataforma
El sistema es una aplicación web desarrollada con **PHP, HTML, CSS y JavaScript**, utilizando **MySQL** como base de datos y desplegada en **Apache**.

---

# ⚡ Instalación y mantenimiento

### Requisitos:
- Servidor web con soporte para PHP y MySQL (XAMPP, WAMP, LAMP).
- Acceso a base de datos MySQL.
- Conocimientos básicos de administración.

### Procedimiento de instalación:

# 1. Clonar el repositorio
git clone https://github.com/SEB4S-DL/SSA.git
cd SSA

# 2. Instalar dependencias con Composer
composer install

# 3. Configurar base de datos
# - Crear una BD en MySQL
# - Importar el archivo SQL del proyecto
# - Ajustar credenciales en config.php o .env

# 🌐 Acceso al sistema
http://localhost/SSA


---

# 🛠 Mantenimiento
- Realizar **backups periódicos**.  
- Actualizar el sistema regularmente.  
- Monitorear el rendimiento del servidor.  
- Dar soporte a los usuarios.  

---

# 📂 Documentación del código fuente

## Estructura del proyecto

| Directorio / Archivo | Descripción |
|-----------------------|-------------|
| **ASSETS**           | Contiene imágenes, CSS y JS. |
| **AUTH**             | Control de login y logout. |
| **DB**               | Conexión a la base de datos. |
| **FUNCTIONS**        | Lógica del back-end. |
| **INCLUDES**         | Elementos reutilizables. |
| **LANG**             | Archivos de traducción. |
| **PAGES**            | Vistas del sistema. |
| **Config.php**       | URL o ruta raíz del proyecto. |
| **Index.php**        | Arrancador de la aplicación. |

---

⚠️ **Nota importante**  
Para generar la carpeta **vendor** es necesario ejecutar:

```bash
composer install
```


# 📜 Licencia y Autores

Este proyecto está bajo la licencia MIT.
Puedes usarlo, modificarlo y distribuirlo libremente.

- 👤 Contributor 1: Sebastián D. L.
- 👤 Contributor 2: Emmanuel O. L.
- 👤 Contributor 3: Alejandra T. B.
