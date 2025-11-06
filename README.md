# 🔧 Dikoin IoT Nexus API

API desarrollada en **Laravel** para la gestión y almacenamiento de datos de prácticas experimentales realizadas en equipos de laboratorio de **DIKOIN** (p. ej. *TD 01.2 Engine Bench*, *IT 03.2 Heat Transfer*).

Esta API permite registrar:
- Productos y máquinas instaladas.
- Sesiones de práctica (runs) iniciadas por los usuarios.
- Datos y métricas obtenidas durante cada práctica.
- (En futuras versiones) control de licencias y sincronización de software.

---

## 🧩 Tecnologías utilizadas

- **Laravel 12.x**
- **MariaDB / MySQL**
- **PHP 8.3+**
- **Composer**
- **UUID (para identificar sesiones de práctica)**
- **Eloquent ORM**

---

## 🗂️ Estructura de modelos principales

| Modelo       | Descripción |
|---------------|-------------|
| `Customer`    | Representa a la institución o cliente que posee uno o varios equipos. |
| `Product`     | Equipo de laboratorio (p. ej. TD 01.2, IT 03.2, etc). |
| `Machine`     | Unidad física concreta instalada en el cliente, con su número de serie y licencia. |
| `Run`         | Sesión de práctica (inicio → cierre). Se crea cuando el software se inicia. |
| `Result`      | Datos o métricas registradas durante una práctica. |

---

## 📊 Estructura de la base de datos (resumen)

- **customers**
  - id, name, email, company_vat

- **products**
  - id, customer_id, code, name

- **machines**
  - id, customer_id, product_id, license_id, serial_number

- **runs**
  - id (UUID), machine_id, app_version, created_at

- **results**
  - id, run_id, metrics (JSON), created_at

---

## 🧑‍💻 Autor
**Alejandra Rodríguez**  
Desarrollo e integración de sistemas IoT para equipos de laboratorio — **DIKOIN**