CREATE DATABASE IF NOT EXISTS locadora CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE locadora;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    sobrenome VARCHAR(100) NOT NULL,
    data_nascimento DATE NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS filmes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    ano INT NOT NULL,
    diretor VARCHAR(255) NOT NULL,
    pais VARCHAR(100) NOT NULL,
    diaria DECIMAL(10, 2) NOT NULL,
    status VARCHAR(20) NOT NULL,
    imagem_url VARCHAR(255) NOT NULL,
    imdb VARCHAR(255) NOT NULL
);

INSERT INTO filmes (titulo, ano, diretor, pais, diaria, status, imagem_url, imdb) VALUES
('O Enigma de Outro Mundo', 1982, 'John Carpenter', 'Estados Unidos', 8.50, 'Disponível', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQIiuQpaG3_xbfAcSeopJAWVBRI4y4_rZQfeNNMgg2FYw&s=10', 'https://www.imdb.com/title/tt0084787/'),
('Mangue Negro', 2008, 'Rodrigo Aragão', 'Brasil', 6.00, 'Disponível', 'https://m.media-amazon.com/images/M/MV5BZTcwMzY0MmEtYjMwNS00MGIwLTk5N2QtNTJjNjE5YWEyZjU3XkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 'https://www.imdb.com/title/tt1329396/'),
('[REC]', 2007, 'Jaume Balagueró', 'Espanha', 7.50, 'Disponível', 'https://upload.wikimedia.org/wikipedia/pt/4/4b/Rec_poster.jpg?utm_source=pt.wikipedia.org&utm_campaign=index&utm_content=original', 'https://www.imdb.com/title/tt1038988/'),
('Les yeux sans visage', 1960, 'Georges Franju', 'França', 9.00, 'Indisponível', 'https://m.media-amazon.com/images/M/MV5BNTMyZGVlNDMtMjU1Ni00NTgwLWE3Y2YtMDBkOGJjY2JiZGRiXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 'https://www.imdb.com/title/tt0053459/'),
('O Exorcista', 1973, 'William Friedkin', 'EUA', 25.00, 'Disponível', 'https://images.unsplash.com/photo-1511485977113-f34c92461ad9?w=500', 'https://www.imdb.com/title/tt0070047/'),
('Hereditário', 2018, 'Ari Aster', 'EUA', 30.00, 'Disponível', 'https://images.unsplash.com/photo-1542204165-65bf26472b9b?w=500', 'https://www.imdb.com/title/tt7784604/'),
('O Iluminado', 1980, 'Stanley Kubrick', 'Reino Unido/EUA', 22.00, 'Indisponível', 'https://images.unsplash.com/photo-1542204165-65bf26472b9b?w=500', 'https://www.imdb.com/title/tt0081505/'),
('It: A Coisa', 2017, 'Andrés Muschietti', 'EUA', 28.00, 'Disponível', 'https://images.unsplash.com/photo-1542204165-65bf26472b9b?w=500', 'https://www.imdb.com/title/tt1396484/'),
('A Bruxa', 2015, 'Robert Eggers', 'EUA/Canadá', 27.00, 'Disponível', 'https://images.unsplash.com/photo-1542204165-65bf26472b9b?w=500', 'https://www.imdb.com/title/tt4263482/'),
('Psicose', 1960, 'Alfred Hitchcock', 'EUA', 20.00, 'Indisponível', 'https://images.unsplash.com/photo-1542204165-65bf26472b9b?w=500', 'https://www.imdb.com/title/tt0054215/'),
('Invocação do Mal', 2013, 'James Wan', 'EUA', 26.00, 'Disponível', 'https://images.unsplash.com/photo-1542204165-65bf26472b9b?w=500', 'https://www.imdb.com/title/tt1457767/'),
('Halloween', 1978, 'John Carpenter', 'EUA', 18.00, 'Disponível', 'https://images.unsplash.com/photo-1542204165-65bf26472b9b?w=500', 'https://www.imdb.com/title/tt0077651/'),
('O Grito', 2002, 'Takashi Shimizu', 'Japão/EUA', 24.00, 'Disponível', 'https://images.unsplash.com/photo-1542204165-65bf26472b9b?w=500', 'https://www.imdb.com/title/tt0364385/'),
('Jogos Mortais', 2004, 'James Wan', 'EUA', 23.00, 'Indisponível', 'https://images.unsplash.com/photo-1542204165-65bf26472b9b?w=500', 'https://www.imdb.com/title/tt0387564/');
