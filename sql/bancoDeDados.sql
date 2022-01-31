CREATE DATABASE lojaonline DEFAULT CHARACTER SET utf8;
USE `lojaonline`;
CREATE TABLE IF NOT EXISTS `lojaonline`.`usuarios` (
    `idUsuario` INT NOT NULL AUTO_INCREMENT,
    `login` VARCHAR(45) NOT NULL,
    `senha` CHAR(32) NOT NULL COMMENT 'Criptografada em MD5',
    `permissao` INT(1) NOT NULL COMMENT '1- Administrador / 2- Cliente',
    PRIMARY KEY (`idUsuario`)
) ENGINE = InnoDB;
-- Faça o INSERT de 02 usuários, um com permissão de administrador primeiro (1) e outro com permissão de cliente depois (2)
USE lojaonline;
INSERT INTO `usuarios` (`idUsuario`, `login`, `senha`, `permissao`)
VALUES (
        NULL,
        "admin",
       "827ccb0eea8a706c4c34a16891f84e7b",
        1
    ), (
        NULL,
        "usuario",
        "827ccb0eea8a706c4c34a16891f84e7b",
        2
    );
CREATE TABLE IF NOT EXISTS `lojaonline`.`clientes` (
    `idCliente` INT NOT NULL AUTO_INCREMENT,
    `cpf` BIGINT(11) NOT NULL,
    `nome` VARCHAR(45) NOT NULL,
    `sobrenome` VARCHAR(45) NOT NULL,
    `email` VARCHAR(45) NOT NULL,
    `endereco` VARCHAR(60) NOT NULL,
    `telefone` VARCHAR(45) NOT NULL,
    `usuarios_idUsuario` INT NOT NULL,
    PRIMARY KEY (`idCliente`),
    INDEX `fk_clientes_usuarios_idx` (`usuarios_idUsuario` ASC),
    CONSTRAINT `fk_clientes_usuarios` FOREIGN KEY (`usuarios_idUsuario`) REFERENCES `lojaonline`.`usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB;
-- Faça o INSERT de 01 cliente, use o id do usuário com permissão do cliente como chave estrangeria (provavelmente será o id 2)
USE lojaonline;
INSERT INTO `clientes` (
        `idCliente`,
        `cpf`,
        `nome`,
        `sobrenome`,
        `email`,
        `endereco`,
        `telefone`,
        `usuarios_idUsuario`
    )
VALUES (
        NULL,
       06842705959,
        "Usuario",
        "Teste",
        "caio_dutra@estudante.sc.senai.br",
        "Rua Benjaminha Casa",
        "47 991370216",
        2
    );
 CREATE TABLE IF NOT EXISTS `lojaonline`.`categorias` (
        `idCategoria` INT NOT NULL AUTO_INCREMENT,
        `nome` VARCHAR(45) NOT NULL,
        PRIMARY KEY (`idCategoria`)
    ) ENGINE = InnoDB;
-- Faça o INSERT de  03 categorias de produtos, de acordo com a sua loja
USE lojaonline;
INSERT INTO `categorias` (`idCategoria`, `nome`)
VALUES (NULL, "Teclado"), (NULL, "Mouse"), (NULL, "Headset");
CREATE TABLE IF NOT EXISTS `lojaonline`.`produtos` (
    `idProduto` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(150) NOT NULL,
    `preco` DECIMAL(6, 2) NOT NULL,
    `categorias_idCategoria` INT NOT NULL,
    `imagem` VARCHAR(255) NULL,
    PRIMARY KEY (`idProduto`),
    INDEX `fk_produtos_categorias1_idx` (`categorias_idCategoria` ASC),
    CONSTRAINT `fk_produtos_categorias1` FOREIGN KEY (`categorias_idCategoria`) REFERENCES `lojaonline`.`categorias` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB;
-- Faça o INSERT de 06 produtos, sendo 02 para cada uma das categorias cadastradas
USE lojaonline;
INSERT INTO `produtos` (
        `idProduto`,
        `nome`,
        `preco`,
        `categorias_idCategoria`,
        `imagem`
    )
VALUES (
        NULL,
        "Teclado Mecânico Gamer Logitech G PRO RGB LIGHTSYNC, USB, Design TKL, Cabo Destacável, Switch GX Blue Clicky",
        699.90,
        1,
        "TecladoMecânicoGamerLogitechGPRO.jpg"
    ) ,(
        NULL,
        "Teclado Mecânico Gamer Redragon Kumara K552W, LED, Switch Redragon MK2 Brown, ABNT2, Branco",
        269.90,
        1,
        "TecladoMecânicoGamerRedragonKumara.jpg"
        
    ), (
        NULL,
        "Mouse Gamer Sem Fio Logitech G PRO Wireless Lightspeed, RGB, Lightsync, Ambidestro, 6 Botóes, Sensor HERO 16K",
        799.90,
        2,
        "MouseGamerSemFioLogitechGPROWireless.jpg"
    ) ,(
        NULL,
        "Mouse Sem Fio Gamer Razer Viper Ultimate, Chroma, com Dock, Optical Switch, 8 Botões, 20000DPI, Quartz Pink",
        1109.90,
        2,
        "MouseRazerViperRosa.jpg"
    ), (
        NULL,
        "Headset Sem Fio Gamer Epos Sennheiser GSP 670, Wireless e Bluetooth, Som Surround 7.1",
        2349.90,
        3,
        "HeadsetGamerEposSennheiserGSP670.jpg"
    ), (
        NULL,
        "Headset Gamer Sem Fio Logitech G Pro X Wireless, 7.1 Som Surround",
        1099.90,
        3,
        "HeadsetGamerGPROWireless.jpg"
    );
CREATE TABLE IF NOT EXISTS `lojaonline`.`pedidos` (
    `idPedido` INT NOT NULL AUTO_INCREMENT,
    `data` DATE NOT NULL,
    `usuarios_idUsuario` INT NOT NULL,
    `status` INT NOT NULL,
    PRIMARY KEY (`idPedido`),
    INDEX `fk_pedidos_usuarios1_idx` (`usuarios_idUsuario` ASC),
    CONSTRAINT `fk_pedidos_usuarios1` FOREIGN KEY (`usuarios_idUsuario`) REFERENCES `lojaonline`.`usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB;
CREATE TABLE IF NOT EXISTS `lojaonline`.`pedidos_has_produtos` (
    `pedidos_idPedido` INT NOT NULL,
    `produtos_idProduto` INT NOT NULL,
    `quantidade` INT NOT NULL,
    PRIMARY KEY (`pedidos_idPedido`, `produtos_idProduto`),
    INDEX `fk_pedidos_has_produtos_produtos1_idx` (`produtos_idProduto` ASC),
    INDEX `fk_pedidos_has_produtos_pedidos1_idx` (`pedidos_idPedido` ASC),
    CONSTRAINT `fk_pedidos_has_produtos_pedidos1` FOREIGN KEY (`pedidos_idPedido`) REFERENCES `lojaonline`.`pedidos` (`idPedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT `fk_pedidos_has_produtos_produtos1` FOREIGN KEY (`produtos_idProduto`) REFERENCES `lojaonline`.`produtos` (`idProduto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB;