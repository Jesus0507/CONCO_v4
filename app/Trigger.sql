-- Crear tabla de registro
CREATE TABLE IF NOT EXISTS log_bitacora_conco (
  id INT NOT NULL AUTO_INCREMENT,
  tabla_afectada VARCHAR(100) NOT NULL,
  columna_afectada VARCHAR(100),
  tipo_cambio VARCHAR(100) NOT NULL,
  detalle_cambio TEXT,
  fecha_hora TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);

-- Crear trigger para capturar cambios en todas las tablas de la base de datos
DELIMITER $$
CREATE TRIGGER log_bitacora_conco
AFTER INSERT, UPDATE, DELETE ON conco.*
FOR EACH ROW
BEGIN
  DECLARE tabla_afectada VARCHAR(100);
  DECLARE columna_afectada VARCHAR(100);
  DECLARE tipo_cambio VARCHAR(100);
  DECLARE detalle_cambio TEXT;

  -- Obtener nombre de la tabla afectada
  SET tabla_afectada = SUBSTRING_INDEX(TRIGGER_EVENT_TABLE, '.', -1);

  -- Obtener nombre de la columna afectada (si aplica)
  IF TRIGGER_EVENT_TYPE = 'UPDATE' THEN
    SET columna_afectada = SUBSTRING_INDEX(TRIGGER_COLUMN_NAME, '.', -1);
  END IF;

  -- Obtener tipo de cambio realizado
  IF TRIGGER_EVENT_TYPE = 'INSERT' THEN
    SET tipo_cambio = 'INSERT';
  ELSEIF TRIGGER_EVENT_TYPE = 'UPDATE' THEN
    SET tipo_cambio = 'UPDATE';
  ELSEIF TRIGGER_EVENT_TYPE = 'DELETE' THEN
    SET tipo_cambio = 'DELETE';
  END IF;

  -- Obtener detalles del cambio (valores antiguos y nuevos)
  SET detalle_cambio = CONCAT('Valores antiguos: ', JSON_OBJECTAGG(column_name, OLD.column_name), '\nValores nuevos: ', JSON_OBJECTAGG(column_name, NEW.column_name))
  FROM information_schema.columns
  WHERE table_schema = 'conco' AND table_name = tabla_afectada;

  -- Insertar registro en tabla de registro
  INSERT INTO log_bitacora_conco (tabla_afectada, columna_afectada, tipo_cambio, detalle_cambio)
  VALUES (tabla_afectada, columna_afectada, tipo_cambio, detalle_cambio);
END$$
DELIMITER ;
