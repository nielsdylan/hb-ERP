--agregar columna en nueva
ALTER TABLE `cursos` ADD `codigo` VARCHAR(255) DEFAULT NULL AFTER `id`;
---agrear columna de docente en el aula
ALTER TABLE `aulas` ADD `docente_id` bigint(20) unsigned NOT NULL AFTER `curso_id`;
ALTER TABLE `aulas` ADD FOREIGN KEY(`docente_id`) REFERENCES `usuarios`(`id`);
