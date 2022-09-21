CREATE DATABASE votacao_dev;

USE votacao_dev;

CREATE TABLE `votacao_dev`.`candidato` (
  `can_codigo` INT NOT NULL AUTO_INCREMENT,
  `can_nome` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`can_codigo`),
  UNIQUE INDEX `can_nome_UNIQUE` (`can_nome` ASC)
);

CREATE TABLE `votacao_dev`.`voto` (
  `vot_codigo` INT NOT NULL AUTO_INCREMENT,
  `vot_nome` VARCHAR(100) NOT NULL,
  `vot_cpf` VARCHAR(11) NOT NULL,
  `vot_idade` INT NOT NULL,
  `vot_data_registro` DATETIME DEFAULT current_timestamp(),
  `can_codigo` INT NOT NULL,
  PRIMARY KEY (`vot_codigo`),
  INDEX `FK_VOTO_CANDIDATO_idx` (`can_codigo` ASC),
  CONSTRAINT `FK_VOTO_CANDIDATO`
  FOREIGN KEY (`can_codigo`)
  REFERENCES `votacao_dev`.`candidato` (`can_codigo`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION
);

INSERT INTO candidato (can_nome) values ('Bill Gates');
INSERT INTO candidato (can_nome) values ('Mark Zuckerberg');