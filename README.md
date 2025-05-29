# 🛒 MP-P1 E-Commerce Platform 🛍️

[![Estado](https://img.shields.io/badge/Estado-En%20Desarrollo-yellow)](https://github.com/username/mp-p1)
[![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat&logo=php&logoColor=white)](https://www.php.net/)
[![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=flat&logo=html5&logoColor=white)](https://developer.mozilla.org/es/docs/Web/HTML)
[![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=flat&logo=css3&logoColor=white)](https://developer.mozilla.org/es/docs/Web/CSS)
[![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=flat&logo=javascript&logoColor=black)](https://developer.mozilla.org/es/docs/Web/JavaScript)
[![Licencia](https://img.shields.io/badge/Licencia-MIT-blue.svg)](LICENSE)

## 📋 Descripción del Proyecto

**MP-P1** es una plataforma de comercio electrónico completa desarrollada con PHP que permite a las empresas gestionar su inventario y vender productos en línea. El sistema incluye funcionalidades esenciales como autenticación de usuarios, gestión de productos, carrito de compras, procesamiento de pedidos y un panel de administración completo.

Esta aplicación está diseñada para ofrecer una experiencia de compra fluida a los clientes mientras proporciona a los administradores herramientas potentes para gestionar todos los aspectos de su tienda en línea.

## 🚀 Objetivos del Proyecto

- **Solución E-Commerce Completa**: Proporcionar una plataforma de comercio electrónico totalmente funcional que permita a las empresas establecer rápidamente su presencia en línea sin necesidad de un desarrollo a medida costoso.

- **Experiencia de Usuario Optimizada**: Crear una interfaz intuitiva y responsive que facilite a los clientes encontrar productos, realizar compras y gestionar sus cuentas con el mínimo esfuerzo.

- **Gestión Eficiente**: Ofrecer a los administradores herramientas robustas para gestionar productos, inventario, pedidos y usuarios a través de un panel de control centralizado.

- **Seguridad Prioritaria**: Implementar medidas de seguridad avanzadas para proteger la información sensible de los usuarios y las transacciones de pago.

- **Arquitectura Escalable**: Desarrollar una estructura modular que facilite la expansión con nuevas características y la adaptación a diferentes volúmenes de negocio.

## 📁 Estructura del Proyecto

```
mp-p1/
│
├── assets/                  # Recursos estáticos
│   ├── css/                 # Hojas de estilo
│   ├── fonts/               # Fuentes personalizadas
│   ├── img/                 # Imágenes y logotipos
│   └── js/                  # Scripts de JavaScript
│
├── pages/                   # Páginas de la aplicación
│   ├── account.php          # Gestión de cuenta de usuario
│   ├── Admin.php            # Panel de administración
│   ├── cart.php             # Carrito de compras
│   ├── Client.php           # Gestión de clientes
│   ├── Login.php            # Autenticación de usuarios
│   ├── products.php         # Gestión de productos
│   ├── sales.php            # Registro de ventas
│   ├── store.php            # Tienda en línea
│   ├── us.php               # Página "Acerca de nosotros"
│   └── users.php            # Gestión de usuarios
│
├── security/                # Funciones de seguridad
│   ├── CRUD/                # Operaciones de base de datos
│   │   ├── CRUD.php         # Operaciones CRUD básicas
│   │   ├── Products.php     # Gestión de productos en BD
│   │   ├── Rest.php         # Implementación de API REST
│   │   └── Tables.php       # Gestión de tablas en BD
│   │
│   ├── Connection.php       # Conexión a base de datos
│   ├── Purchases.php        # Procesamiento de compras
│   ├── Security.php         # Funciones de seguridad
│   └── Session.php          # Gestión de sesiones
│
└── index.php                # Punto de entrada principal
```

## 💻 Tecnologías Utilizadas

- **Backend**:
  - PHP 7.4+
  - MySQL/MariaDB

- **Frontend**:
  - HTML5
  - CSS3
  - JavaScript
  - Google Fonts
  
- **Seguridad**:
  - Control de sesiones
  - Validación de datos
  - Prevención de SQL Injection

- **Entorno de Desarrollo**:
  - XAMPP (Apache, MySQL, PHP)
  - Visual Studio Code
  - Git para control de versiones

## ⚙️ Instalación

1. Clona este repositorio o descarga los archivos:
   ```bash
   git clone https://github.com/usuario/mp-p1.git
   ```

2. Asegúrate de tener XAMPP instalado en tu sistema. Puedes descargarlo desde [https://www.apachefriends.org/](https://www.apachefriends.org/)

3. Coloca el proyecto en el directorio `htdocs` de XAMPP:
   ```bash
   # Para Windows
   xcopy /E /I mp-p1 C:\xampp\htdocs\mp-p1
   
   # Para Linux/Mac
   cp -R mp-p1 /opt/lampp/htdocs/
   ```

4. Inicia los servicios de Apache y MySQL desde el panel de control de XAMPP

5. Crea una base de datos en MySQL llamada `mp_p1_db` (o el nombre que prefieras)

6. Importa el archivo de base de datos (si está incluido en el proyecto):
   ```bash
   mysql -u root -p mp_p1_db < ruta/al/archivo.sql
   ```

7. Configura los parámetros de conexión en el archivo `security/Connection.php`

## 🔍 Uso

Para utilizar la plataforma:

1. Abre tu navegador y navega a:
   ```
   http://localhost/mp-p1/
   ```

2. Inicia sesión con las credenciales:
   - **Administrador**: admin@example.com / contraseña: admin123
   - **Cliente**: cliente@example.com / contraseña: cliente123

3. Explora las diferentes secciones:
   - Catálogo de productos
   - Carrito de compras
   - Panel de administración (si tienes acceso)
   - Gestión de cuenta

## 🤝 Cómo Contribuir

Si deseas contribuir a este proyecto, sigue estos pasos:

1. Haz un Fork del repositorio
   
2. Crea una rama para tu funcionalidad:
   ```bash
   git checkout -b feature/nueva-funcionalidad
   ```

3. Realiza tus cambios siguiendo el estilo de código del proyecto

4. Asegúrate de probar tus cambios exhaustivamente

5. Haz commit de tus cambios:
   ```bash
   git commit -m "Añade: nueva funcionalidad para XYZ"
   ```

6. Sube los cambios a tu repositorio:
   ```bash
   git push origin feature/nueva-funcionalidad
   ```

7. Crea un Pull Request detallando los cambios realizados

8. Espera la revisión y aprobación

## 📝 Historial de Cambios

- **v1.2.0** (20/05/2025):
  - Implementación del carrito de compras con persistencia
  - Mejora del sistema de búsqueda de productos
  - Optimización del rendimiento de la base de datos
  - Corrección de errores en el proceso de checkout

- **v1.1.0** (10/04/2025):
  - Adición de panel de administración completo
  - Implementación de gestión de usuarios
  - Mejoras en la interfaz de usuario
  - Corrección de problemas de seguridad

- **v1.0.0** (01/03/2025):
  - Lanzamiento inicial
  - Catálogo de productos
  - Sistema de autenticación básico
  - Interfaz de tienda online

## 📄 Licencia

Este proyecto está bajo la Licencia MIT - consulta el archivo [LICENSE](LICENSE) para más detalles.

## 👨‍💻 Créditos

Desarrollado por **DXM** 

---

⭐️ **Nota**: Este proyecto ha sido desarrollado con fines educativos y como demostración de habilidades en desarrollo web con PHP. No es un sitio comercial real. ⭐️

