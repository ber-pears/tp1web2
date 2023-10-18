<?php 
require_once './database/database.php';
class Model{
    protected $db;

    function __contruct() {
        $this->dbVerify();
        $this->db = new PDO('mysql:host='.MYSQL_HOST.';dbname='.MYSQL_DB.';charset=utf8', MYSQL_USER, MYSQL_PASS);
        $this->deploy();    
    }
    function dbVerify() {
        $nombreDB = MYSQL_DB;
        $pdo = new PDO('mysql:host='.MYSQL_HOST.';charset=utf8', MYSQL_USER, MYSQL_PASS);
        $query = "CREATE DATABASE IF NOT EXISTS $nombreDB";
        $pdo->exec($query);
    }
    private function deploy(){
        // Chequear si hay tablas
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll(); // Nos devuelve todas las tablas de la db
        if(count($tables)==0) { 
            $clave = '$2y$10$EEQG/sE6fwNfz6EyS1i4LO9f8W/brI3z.mPJI7LHKId4Llt4Ptwuy';
        $sql = <<<END
        --
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_productos` int(11) NOT NULL,
  `Producto` varchar(50) NOT NULL,
  `Precio` double NOT NULL,
  `id_usuarios` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_productos`, `Producto`, `Precio`, `id_usuarios`) VALUES
(1, 'Samsung A53', 280000, 1),
(2, 'Samsung A54', 350000, 2),
(3, 'Iphone 14 Pro Max', 950000, 0),
(4, 'Iphone 15', 1100000, 0),
(5, 'Samsung S23', 800000, 0),
(6, 'Funda Ip', 7000, 0),
(7, 'Funda Samsung', 5000, 0),
(8, 'Funda Samsung', 5000, 0),
(9, 'Parlante JBL', 149999, 0),
(10, 'Parlante LG', 114999, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `transaction_id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contraseña` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`transaction_id`, `usuario`, `email`, `contraseña`) VALUES
(1, 'Franco', 'Bustamante', 'hsjadhas@hotmail.com'),
(2, 'webadmin', 'webadmin@gmail.com', 'admin');

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
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`transaction_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_productos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `productos` (`id_usuarios`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
COMMIT;
END;
$this->db->query($sql);
}
}
}