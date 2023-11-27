<?php
    require_once 'database/config.php';
    class Model {
        protected $db;

        function __contruct() {
            $this->dbVerify();
            $this->db = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB . ';charset=utf8', MYSQL_USER, MYSQL_PASS);
            $this->deploy();
        }

        function dbVerify(){
            $nombreDB = MYSQL_DB;
            $pdo = new PDO('mysql:host=' . MYSQL_HOST . ';charset=utf8', MYSQL_USER, MYSQL_PASS);
            $query = "CREATE DATABASE IF NOT EXISTS $nombreDB";
            $pdo->exec($query);
        }
        function deploy() {
            // Chequear si hay tablas
            $query = $this->db->query('SHOW TABLES');
            $tables = $query->fetchAll(); // Nos devuelve todas las tablas de la db
            if(count($tables)==0) {
                // Si no hay crearlas
                $sql =<<<END

            -- Estructura de tabla para la tabla `productos`
            --

            CREATE TABLE `productos` (
            `id_productos` int(11) NOT NULL,
            `Categoria` varchar(50) NOT NULL,
            `Producto` varchar(50) NOT NULL,
            `Precio` double NOT NULL,
            `id_usuarios` int(11) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

            --
            -- Volcado de datos para la tabla `productos`
            --

            INSERT INTO `productos` (`id_productos`, `Categoria`, `Producto`, `Precio`, `id_usuarios`) VALUES
            (1, 'Celular', 'Samsung A53', 280000, 1),
            (2, 'Celular', 'Samsung A54', 350000, 2),
            (4, 'Celular', 'Iphone 15', 1100000, 0),
            (5, 'Celular', 'Samsung S23', 800000, 0),
            (7, 'Funda', 'Funda Samsung', 5000, 0),
            (8, 'Funda', 'Funda Samsung', 5000, 0),
            (9, 'Parlante', 'Parlante JBL', 149999, 0),
            (10, 'Parlante', 'Parlante LG', 114999, 0),
            (11, 'Celular', 'Samsung S23', 950000, 0),
            (12, 'Celular', 'Samsung S13', 95000, 0);

            --
            -- Índices para tablas volcadas
            --

            --
            -- Indices de la tabla `productos`
            --
            ALTER TABLE `productos`
            ADD PRIMARY KEY (`id_productos`),
            ADD KEY `id_usuarios` (`id_usuarios`);

            --
            -- AUTO_INCREMENT de las tablas volcadas
            --

            --
            -- AUTO_INCREMENT de la tabla `productos`
            --
            ALTER TABLE `productos`
            MODIFY `id_productos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
            COMMIT;
            END;
                $this->db->query($sql);
            }
            
        }
    }
