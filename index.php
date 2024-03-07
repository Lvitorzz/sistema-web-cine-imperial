<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema Imperial</title>  
    <link rel="stylesheet" href="./css/padrao.css">
    <link rel="stylesheet" href="./pages/home/homepage.css">

</head>
<body>
    <header class="header">
        <div class="headnav">
            <nav>
                <div class="logo-nav">
                    <a href="home.php"><img src="./imgs/Designer.png" class="logo" alt="logo"></a> 
                </div>
                
                <div class="txt-nav">
                    <h1>Cine Imperial</h1> 
                </div>
                <div class="btn-nav">
                <?php
                    session_start();
                    if (isset($_SESSION['usuario'])) {
                        echo '<div id="menu-usuario">';
                        echo '<p id="nome-usuario">Bem-vindo, ' . $_SESSION['usuario']['nome'] . '!</p>';
                        echo '<button onclick="toggleMenu()"></button>';
                        echo '<div id="opcoes-menu">';
                        echo '<a href="../../pages/usuario/gerenciarUsuario.php">Gerenciar Perfil</a>';
                        echo '<a href="#">Minhas Compras</a>';
                        if ($_SESSION['usuario']['email'] === 'admin@admin.com') {
                            echo '<a href="../../pages_admin/admin/admin.html">Gerenciar Cinema</a>';
                        }

                        echo '<a href="./controllers/logoutController.php">Sair</a>';
                        echo '</div>';
                        echo '</div>';
                    } else {
                        echo '<a href="./pages/login/login.html"><button>Entre na sua conta</button></a>';
                    }
                ?>
                </div>
            </nav>
        </div>

        <div class="select">
            <nav >
                <ul>
                    <li><a href="index.html">Filmes</a></li>
                    <li><a href="./pages/servicos/servicos.html">Serviços</a></li>
                    <li><a href="./pages/noticias/noticias.html">Notícias</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="banner">
        <img src="./imgs/main/Frame 6.png">
    </div>
    <div class="select2">
        <nav >
            <ul class="select">
                <li><button id="cartaz">Em Cartaz</button></li>
                <li><button id="breve">Em Breve</button></li>
            </ul>
        </nav>
    </div>

    <div id="filmeContainer">
        
    </div>


    <footer>
        <div class="imagem-full-width">
            <img src="./imgs/Baixe.png" alt="Imagem de largura total">
        </div>
        <div class="container-footer">
            <div class="coluna-footer">
                <h2>Menu</h2>
                <p><a href="#">Filmes</a></p>
                <p><a href="#">Serviços</a></p>
                <p><a href="#">Noticias</a></p>
                <p><a href="#">Shop</a></p>
            </div>

            <div class="coluna-footer">
                <h2>Institucional</h2>
                <p><a href="#">Quem somos</a></p>
                <p><a href="#">Nosso app</a></p>
            </div>

            <div class="coluna-footer">
                <h2>Políticas</h2>
                <p><a href="#">Privacidade e Segurança</a></p>
                <p><a href="#">Meia-entrada</a></p>
                <p><a href="#">Trocas e Cancelamentos</a></p>
            </div>

            <div class="coluna-footer">
                <h2>Redes sociais</h2>
                <p><i class="fab fa-facebook"></i><a href="#">Facebook</a></p>
                <p><i class="fab fa-instagram"></i> <a href="#">Cine Golden</a></p>
                <p><i class="fab fa-instagram"></i><a href="#">Cine Itaguari</a></p>
                <p><i class="fab fa-instagram"></i><a href="#">Vila Geek</a></p>
                <p><i class="fab fa-instagram"></i><a href="#">Cine Cariri</a></p>
            </div>
        </div>
        <div style="width: 100%; justify-content: center; display: flex;">
            <hr style="width: 80%;">
        </div>
        <div class="direitos-reservados">
            <p>&copy; 2023 CineImperial. Todos os direitos reservados.</p>
        </div>
    </footer>

    <script src="./pages/home/homepage.js"></script>
</body>
</html>
