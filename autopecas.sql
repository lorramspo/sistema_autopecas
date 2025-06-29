CREATE DATABASE IF NOT EXISTS autopecas;
USE autopecas;

CREATE TABLE produtos (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          nome_produto VARCHAR(255) NOT NULL,
                          preco DECIMAL(10,2) NOT NULL,
                          quantidade INT NOT NULL,
                          criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
