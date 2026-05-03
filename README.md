# 🐾 Petshop 2026 - Sistema de Pedidos de Medallas

Sistema de e-commerce para personalización y pedido de medallas para mascotas.

## Stack

- PHP 8 (sin framework)
- MySQL / MariaDB
- PDO
- Bootstrap 5
- Arquitectura MVC

## Features

- Catálogo de medallas con imagen y precio
- Personalización por producto (texto línea 1, línea 2, grabado)
- Carrito de pedido por sesión
- Registro y login de clientes con contraseña hasheada
- Flujo completo: catálogo → personalizar → carrito → login → confirmar
- Cálculo automático de total al confirmar
- Panel de administración con dashboard y gestión de pedidos
- Vista de detalle de pedido estilo invoice con datos del cliente e items

## Cómo ejecutar

1. Clonar el repositorio
2. Importar `petshop2026.sql` en MySQL
3. Configurar credenciales en `config/config.php`
4. Servir desde XAMPP apuntando a la carpeta del proyecto
5. Acceder por `http://localhost/_activos/_petshop_renovado2026/`

## Estructura