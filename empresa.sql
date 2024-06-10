-- Tabla de usuarios (técnicos)
CREATE TABLE Usuarios (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(30) NOT NULL,
    apellido_1 VARCHAR(50) NOT NULL,
    apellido_2 VARCHAR(50) NOT NULL
);

-- Tabla de clientes
CREATE TABLE Cliente (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

-- Tabla de fotocopiadoras
CREATE TABLE Fotocopiadora (
    id SERIAL PRIMARY KEY,
    modelo VARCHAR(100) NOT NULL,
    numero_serie VARCHAR(100) NOT NULL UNIQUE,
    cliente_id INT REFERENCES Cliente(id)
);

-- Tabla de estados
CREATE TABLE Estados (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE
);

-- Tabla de tareas de reparación
CREATE TABLE Tareas (
    id SERIAL PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    descripcion TEXT NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_vencimiento DATE,
    estado_id INT REFERENCES Estados(id),
    fotocopiadora_id INT REFERENCES Fotocopiadora(id),
    tecnico_id INT REFERENCES Usuarios(id)
);

INSERT INTO Usuarios (nombre, apellido_1, apellido_2) VALUES
('Juan', 'Pérez', 'González'),
('María', 'García', 'Rodríguez'),
('Carlos', 'Rodríguez', 'López'),
('Ana', 'Martínez', 'Hernández'),
('Luis', 'Hernández', 'Martín');

INSERT INTO Cliente (nombre) VALUES
('Empresa ABC'),
('Instituto XYZ'),
('Hospital Central'),
('Biblioteca Municipal'),
('Universidad Nacional');

INSERT INTO Fotocopiadora (modelo, numero_serie, cliente_id) VALUES
('HP LaserJet 1010', 'SN1234567890', 1),
('Canon iR 1024', 'SN0987654321', 2),
('Epson EcoTank L3150', 'SN1122334455', 3),
('Brother DCP-L2550DW', 'SN6677889900', 4),
('Samsung Xpress M2070', 'SN4433221100', 5);

INSERT INTO Estados (nombre) VALUES
('pendiente'),
('en progreso'),
('completada');

INSERT INTO Tareas (titulo, descripcion, fecha_vencimiento, estado_id, fotocopiadora_id, tecnico_id) VALUES
('Revisar cabezal de impresión', 'La impresora no imprime correctamente, revisar el cabezal.', '2024-06-30', 1, 1, 1),
('Cambio de tóner', 'La fotocopiadora requiere un cambio de tóner.', '2024-07-15', 2, 2, 2),
('Reparar bandeja de papel', 'La bandeja de papel está atascada y necesita reparación.', '2024-07-20', 1, 3, 3),
('Actualizar firmware', 'Actualizar el firmware de la fotocopiadora.', '2024-08-01', 2, 4, 4),
('Reemplazo de rodillo', 'El rodillo de la fotocopiadora está desgastado y necesita reemplazo.', '2024-08-10', 1, 5, 5);
