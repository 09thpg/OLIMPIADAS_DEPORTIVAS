-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS olimpiadas_mvc CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE olimpiadas_mvc;

-- Tabla de usuarios con avatar
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(150) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL,
    avatar VARCHAR(20) DEFAULT 'avatar1',
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
