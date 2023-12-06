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
