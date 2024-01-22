--agregar columna en nueva
ALTER TABLE `cursos` ADD `codigo` VARCHAR(255) DEFAULT NULL AFTER `id`;
---agrear columna de docente en el aula
ALTER TABLE `aulas` ADD `docente_id` bigint(20) unsigned NOT NULL AFTER `curso_id`;
ALTER TABLE `aulas` ADD FOREIGN KEY(`docente_id`) REFERENCES `usuarios`(`id`);
ALTER TABLE `aulas` CHANGE `nombre` `codigo` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;
CREATE TABLE `asistencias` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `reserva` tinyint(1) NOT NULL DEFAULT 1,
  `aula_id` bigint(20) unsigned NOT NULL,
  `alumno_id` bigint(20) unsigned NOT NULL,
  `fecha_registro` datetime DEFAULT NULL,
	`ingreso` boolean NOT NULL DEFAULT FALSE,
  `estado` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_id` int(11) DEFAULT NULL,
  `updated_id` int(11) DEFAULT NULL,
  `deleted_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `asistencias_aula_id_foreign` (`aula_id`),
  KEY `asistencias_alumno_id_foreign` (`alumno_id`),
  CONSTRAINT `asistencias_alumno_id_foreign` FOREIGN KEY (`alumno_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `asistencias_aula_id_foreign` FOREIGN KEY (`aula_id`) REFERENCES `aulas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);
-- sql 29-12-2023
CREATE TABLE `asignaturas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_id` int(11) DEFAULT NULL,
  `updated_id` int(11) DEFAULT NULL,
  `deleted_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
);
ALTER TABLE `aulas` ADD `abierto` int(11) DEFAULT 0 AFTER `estado`;


-- cambiar de nombre a la columna descripcion por nombre
ALTER TABLE `cursos` CHANGE `descripcion` `nombre` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL AFTER `codigo`;
-- agregar el campo descripcion a la tabla curso
ALTER TABLE `cursos` ADD `descripcion` VARCHAR(255) DEFAULT NULL AFTER `nombre`;
-- agregamos el campo foraneo de asignatura
ALTER TABLE `cursos` ADD `asignatura_id` bigint(20) unsigned AFTER `estado`;
-- crear la llave foranea
ALTER TABLE `cursos` ADD constraint fk_cursos_asignaturas FOREIGN KEY (`asignatura_id`) REFERENCES `asignaturas`(`id`);
-- creamos el campo de asignatura en el aula
ALTER TABLE `aulas` ADD `asignatura_id` bigint(20) unsigned AFTER `docente_id`;
-- crear la llave foranea en la tablade aulas
ALTER TABLE `aulas` ADD constraint fk_aulas_asignaturas FOREIGN KEY (`asignatura_id`) REFERENCES `asignaturas`(`id`);
-----------------------------------------------------------------------------------------------------------------------
--- sql 8-01-2024 para examenes / cuestionario ejecutarlo
CREATE TABLE `cuestionarios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_id` int(11) DEFAULT NULL,
  `updated_id` int(11) DEFAULT NULL,
  `deleted_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
);
-- tipo de preguntas
CREATE TABLE `tipo_preguntas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_id` int(11) DEFAULT NULL,
  `updated_id` int(11) DEFAULT NULL,
  `deleted_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
);
-- tabla donde se enlasan las preguntas con el cuestionario
CREATE TABLE `cuestionario_preguntas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pregunta` text DEFAULT NULL,
  `puntaje` int(11) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `cuestionario_id` bigint(20) unsigned NOT NULL,
  `tipo_pregunta_id` bigint(20) unsigned NOT NULL,
  `estado` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_id` int(11) DEFAULT NULL,
  `updated_id` int(11) DEFAULT NULL,
  `deleted_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
);
-- tabla donde se generan las respuestas
CREATE TABLE `cuestionario_respuestas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` text DEFAULT NULL,
  `verdadero` int(11) DEFAULT 0,
  `fecha_registro` datetime DEFAULT NULL,
  `pregunta_id` bigint(20) unsigned NOT NULL,
  `cuestionario_id` bigint(20) unsigned NOT NULL,
  `estado` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_id` int(11) DEFAULT NULL,
  `updated_id` int(11) DEFAULT NULL,
  `deleted_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
);
-- relaciones de las tablas para el cuestionario
ALTER TABLE `cuestionario_preguntas` ADD constraint fk_cuestionario_preguntas_tipo_preguntas FOREIGN KEY (`tipo_pregunta_id`) REFERENCES `tipo_preguntas`(`id`);
ALTER TABLE `cuestionario_preguntas` ADD constraint fk_cuestionario_preguntas_cuestionarios FOREIGN KEY (`cuestionario_id`) REFERENCES `cuestionarios`(`id`);
ALTER TABLE `cuestionario_respuestas` ADD constraint fk_cuestionario_respuestas_cuestionario_preguntas FOREIGN KEY (`pregunta_id`) REFERENCES `cuestionario_preguntas`(`id`);
ALTER TABLE `cuestionario_respuestas` ADD constraint fk_cuestionario_respuestas_cuestionarios FOREIGN KEY (`cuestionario_id`) REFERENCES `cuestionarios`(`id`);
-- 19 / 01 / 2024 agregar este campo para determinar si es o no un encuesta
ALTER TABLE `cuestionarios` ADD `encuesta` INT(11) DEFAULT 0 AFTER `fecha_registro`;

-- 20 / 01 / 2024 tablas de respuesta
CREATE TABLE `formularios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `encuesta` int(11) DEFAULT 0,
  `estado` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_id` int(11) DEFAULT NULL,
  `updated_id` int(11) DEFAULT NULL,
  `deleted_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
);
CREATE TABLE `formulario_preguntas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pregunta` text DEFAULT NULL,
  `puntaje` int(11) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `formulario_id` bigint(20) unsigned NOT NULL,
  `tipo_pregunta_id` bigint(20) unsigned NOT NULL,
  `estado` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_id` int(11) DEFAULT NULL,
  `updated_id` int(11) DEFAULT NULL,
  `deleted_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
);
CREATE TABLE `formulario_respuestas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` text DEFAULT NULL,
  `verdadero` int(11) DEFAULT 0,
  `fecha_registro` datetime DEFAULT NULL,
  `formulario_pregunta_id` bigint(20) unsigned NOT NULL,
  `formulario_id` bigint(20) unsigned NOT NULL,
  `estado` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_id` int(11) DEFAULT NULL,
  `updated_id` int(11) DEFAULT NULL,
  `deleted_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
);
-- relaciones de las tablas para el formulario
ALTER TABLE `formulario_preguntas` ADD constraint fk_formulario_preguntas_tipo_preguntas FOREIGN KEY (`tipo_pregunta_id`) REFERENCES `tipo_preguntas`(`id`);
ALTER TABLE `formulario_preguntas` ADD constraint fk_formulario_preguntas_formularios FOREIGN KEY (`formulario_id`) REFERENCES `formularios`(`id`);
ALTER TABLE `formulario_respuestas` ADD constraint fk_formulario_respuestas_formulario_preguntas FOREIGN KEY (`formulario_pregunta_id`) REFERENCES `formulario_preguntas`(`id`);
ALTER TABLE `formulario_respuestas` ADD constraint fk_formulario_respuestas_formularios FOREIGN KEY (`formulario_id`) REFERENCES `formularios`(`id`);

-- agregar el campo descripcion a la tabla formulario
ALTER TABLE `formularios` ADD `apellido_paterno` VARCHAR(255) DEFAULT NULL AFTER `fecha_registro`;
ALTER TABLE `formularios` ADD `apellido_materno` VARCHAR(255) DEFAULT NULL AFTER `apellido_paterno`;
ALTER TABLE `formularios` ADD `nombres` VARCHAR(255) DEFAULT NULL AFTER `apellido_materno`;
ALTER TABLE `formularios` ADD `numero_documento` VARCHAR(255) DEFAULT NULL AFTER `fecha_registro`;
ALTER TABLE `formularios` ADD `cuestionario_id` bigint(20) unsigned AFTER `estado`;
-- cambiar de nombre a la columna nombre de la tabla formulario por nombre
ALTER TABLE `formularios` CHANGE `nombre` `titulo` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ;
-- se agregara un campo mas para ver que es lo que marco el usuario
ALTER TABLE `formulario_respuestas` ADD `seleccion` int(11) DEFAULT 0 AFTER `verdadero`;
-- cambiar el campo de nombre  a titulo en la tabla cuestionario
ALTER TABLE `cuestionarios` CHANGE `nombre` `titulo` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL ;
