<?php
    header('Content-Type: text/html; charset=utf-8');
    require_once("conexao.php");
    require_once("consultas_filmes.php");

    if (isset($_GET['excluir'])) {
        deletarFilme($conexao, (int)$_GET['excluir']);
        header("Location: filmes.php");
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['salvar_edicao'])) {
        $id = (int)$_POST['id'];
        $titulo = $_POST['titulo'];
        $ano = (int)$_POST['ano'];
        $diretor = $_POST['diretor'];
        $pais = $_POST['pais'];
        $diaria = (float)$_POST['diaria'];
        $status = $_POST['status'];
        $imagem_url = $_POST['imagem_url'];
        $imdb = $_POST['imdb'];

        editarFilme($conexao, $id, $titulo, $ano, $diretor, $pais, $diaria, $status, $imagem_url, $imdb);
        header("Location: filmes.php");
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['salvar_inclusao'])) {
        $titulo = $_POST['titulo'];
        $ano = (int)$_POST['ano'];
        $diretor = $_POST['diretor'];
        $pais = $_POST['pais'];
        $diaria = (float)$_POST['diaria'];
        $status = $_POST['status'];
        $imagem_url = $_POST['imagem_url'];
        $imdb = $_POST['imdb'];

        inserirFilme($conexao, $titulo, $ano, $diretor, $pais, $diaria, $status, $imagem_url, $imdb);
        header("Location: filmes.php");
        exit;
    }

    $filmeEdicao = null;
    if (isset($_GET['editar'])) {
        $filmeEdicao = buscarFilme($conexao, (int)$_GET['editar']);
    }

    $exibirInclusao = isset($_GET['novo']);

    $filmes = exibirFilmes($conexao);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filmes</title>
    <link rel="stylesheet" href="styles.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css">

    <style>
        .titulo {
            color: #631212;
            font-family: 'Franklin Gothic Medium';
            font-size: 40px;
        }

        .titulo_secundario {
            color: #833838;
            font-family: 'Franklin Gothic Medium';
            font-size: 20px;
        }
    </style>
</head>

<body>
    <header class="cabecalho">
        <nav>
            <svg width="120" height="80" viewBox="0 0 120 80" xmlns="http://www.w3.org/2000/svg">
                <rect x="10" y="28" width="100" height="50" rx="4" fill="#1c1c1c" stroke="#e50914" stroke-width="2" />

                <g transform="rotate(-8 10 25)">
                    <rect x="10" y="10" width="100" height="16" rx="2" fill="#111" stroke="#e50914"
                        stroke-width="1.5" />
                    <polygon points="18,10 28,10 20,26 10,26" fill="#fff" />
                    <polygon points="40,10 50,10 42,26 32,26" fill="#fff" />
                    <polygon points="62,10 72,10 64,26 54,26" fill="#fff" />
                    <polygon points="84,10 94,10 86,26 76,26" fill="#fff" />
                </g>
            </svg>
            <div class="menu_cabecalho">
                <ul>
                    <li class="opcoes"><a href="index.html">Home</a></li>
                    <li class="opcoes"><a href="filmes.php">Filmes</a></li>
                    <li class="opcoes"><a href="contato.html">Contato</a></li>
                </ul>
                <button type="button" id="botao_tema" class="botao_tema" onclick="alternarTema()">
                    Modo Noturno
                </button>
            </div>
        </nav>
    </header>

    <div class="container">
        <h1 class="titulo">Filmes: Introdução</h1>

        <p class="bloco_destaque">
            Terror é um gênero de filmes que busca atrair o telespectador através de meios diferentes do que geralmente
            se espera de uma obra do entretenimento.
            A maioria dos filmes tenta impressionar o público com abordagens divertidas e engraçadas, outros tentam ir
            para um lado mais dramático, focando numa boa narrativa,
            mas o gênero de terror quer obter os sentimentos negativos do ser humano, eles buscam trazer medo e
            desconforto através de diversos temas, como fantasmas, alienígenas, ocultismo, morte, tortura, dentre
            outros.
        </p>
    </div>

    <section class="container">
        <h2 class="titulo">História dos filmes de terror</h2>
        <dl>
            <dt class="titulo_secundario">Origem</dt>
            <dd>O primeiro filme de terror registrado é o "Le Manoir du Diable" do francês Georges Méliès, é um filme
                mudo de 1896 que retrata um encontro
                com o Diabo, apresentando diversos truques de câmera para deixar a experiência mais imersiva. Os
                destaques do filme ficam para o uso de pausas e retomadas repentinas nas gravações
                para expressar avanços no tempo
            </dd>
            <dt class="titulo_secundario">Avanços tecnológicos no cinema</dt>
            <dd>Conforme o tempo passou, a tecnologia evoluiu muito e com isso os filmes de terror ganharam uma alta
                gama de possibilidades e elementos diferentes, alguns que temos são:
                <ul>
                    <li>Sons e música;</li>
                    <li>Efeitos gráficos (CGI, maquiagem);</li>
                    <li>Jogo de câmera;</li>
                    <li>Iluminação</li>
                </ul>
                A combinação desses elementos gera a experiência única do filme de terror
            </dd>
            <dt class="titulo_secundario">Fora das grandes terras dos filmes</dt>
            <dd>Com a popularização do gênero, muitos países obtiveram uma visibilidade maior com os filmes. Além da
                Europa e dos Estados Unidos, países asiáticos como o Japão acabaram ganhando uma certa fama
                principalmente por conduzir o roteiro e a imersão do filme de maneira bem diferente do que o público
                está acostumado, utilizando de artefatos de sua cultura, alguns filmes japoneses que ficaram popular são
                "Ring: O Chamado", "O Grito", etc.
            </dd>
        </dl>
    </section>

    <section class="container">
        <h2 class="titulo">Filmes Populares</h2>
        <div class="acoes_tabela">
            <input type="text" id="pesquisaFilmes" onkeyup="filtrarFilmes()" placeholder="Pesquisar filmes...">
            <button type="button" id="botao_surpreenda" class="botao_surpreenda"
                onclick="sortearFilme()">Surpreenda-me!</button>
            <a href="filmes.php?novo=1#bloco_cadastro" class="botao_incluir">+ Incluir Filme</a>
        </div>

        <div id="cardSorteio" class="card_sorteio" style="display: none;">
            <div class="card_sorteio_conteudo">
                <img id="sorteioPoster" src="" alt="Pôster sorteado" width="65">
                <div class="sorteio_info">
                    <h4>Filme Recomendado para Você:</h4>
                    <p><strong id="sorteioTitulo"></strong> (<span id="sorteioAno"></span>) &bull; Direção: <span
                            id="sorteioDiretor"></span></p>
                    <p>País: <span id="sorteioPais"></span> | Diária: R$ <span id="sorteioPreco"></span> | Disponível:
                        <strong id="sorteioStatus"></strong>
                    </p>
                </div>
                <button type="button" class="botao_fechar_sorteio" onclick="fecharSorteio()">&times;</button>
            </div>
        </div>
        <table class="pure-table pure-table-bordered pure-table-striped tabela">
            <tr class="linha">
                <th>Pôster</th>
                <th>Filme</th>
                <th>País</th>
                <th>Ano</th>
                <th>Diretor</th>
                <th>Link IMDB</th>
                <th>Disponível para locação?</th>
                <th>Preço Diária (R$)</th>
                <th>Ações</th>
            </tr>
            <?php
            foreach ($filmes as $filme) {
            ?>
                <tr class="linha">
                    <td><img src="<?= htmlspecialchars($filme['imagem_url']) ?>" width="80"></td>
                    <td><?= htmlspecialchars($filme['titulo']) ?></td>
                    <td><?= htmlspecialchars($filme['pais']) ?></td>
                    <td><?= $filme['ano'] ?></td>
                    <td><?= htmlspecialchars($filme['diretor']) ?></td>
                    <td><a href="<?= htmlspecialchars($filme['imdb']) ?>" target="_blank">Link</a></td>
                    <td><?= htmlspecialchars($filme['status']) ?></td>
                    <td><?= number_format($filme['diaria'], 2, ',', '.') ?></td>
                    <td class="coluna_acoes">
                        <a href="filmes.php?editar=<?= $filme['id'] ?>#bloco_edicao" class="botao_acao botao_editar">Editar</a>
                        <a href="filmes.php?excluir=<?= $filme['id'] ?>" class="botao_acao botao_excluir" onclick="return confirm('Tem certeza que deseja excluir o filme <?= htmlspecialchars(addslashes($filme['titulo'])) ?>?');">Excluir</a>
                    </td>
                </tr>
            <?php 
            } 
            ?>
        </table><br>

        <?php if (!empty($filmeEdicao)): ?>
        <div id="bloco_edicao" class="bloco_edicao">
            <h3 class="titulo_secundario" style="margin-bottom: 15px;">Editar Filme: <em><?= htmlspecialchars($filmeEdicao['titulo']) ?></em></h3>
            <form method="POST" action="filmes.php" class="pure-form pure-form-aligned">
                <input type="hidden" name="id" value="<?= $filmeEdicao['id'] ?>">

                <div class="pure-control-group">
                    <label for="titulo_edit">Título:</label>
                    <input type="text" id="titulo_edit" name="titulo" value="<?= htmlspecialchars($filmeEdicao['titulo']) ?>" required>
                </div>
                <div class="pure-control-group">
                    <label for="ano_edit">Ano:</label>
                    <input type="number" id="ano_edit" name="ano" value="<?= $filmeEdicao['ano'] ?>" required>
                </div>
                <div class="pure-control-group">
                    <label for="diretor_edit">Diretor:</label>
                    <input type="text" id="diretor_edit" name="diretor" value="<?= htmlspecialchars($filmeEdicao['diretor']) ?>" required>
                </div>
                <div class="pure-control-group">
                    <label for="pais_edit">País:</label>
                    <input type="text" id="pais_edit" name="pais" value="<?= htmlspecialchars($filmeEdicao['pais']) ?>" required>
                </div>
                <div class="pure-control-group">
                    <label for="diaria_edit">Preço Diária (R$):</label>
                    <input type="number" step="0.01" id="diaria_edit" name="diaria" value="<?= $filmeEdicao['diaria'] ?>" required>
                </div>
                <div class="pure-control-group">
                    <label for="status_edit">Status:</label>
                    <select id="status_edit" name="status">
                        <option value="Disponível" <?= $filmeEdicao['status'] === 'Disponível' ? 'selected' : '' ?>>Disponível</option>
                        <option value="Indisponível" <?= $filmeEdicao['status'] === 'Indisponível' ? 'selected' : '' ?>>Indisponível</option>
                    </select>
                </div>
                <div class="pure-control-group">
                    <label for="imagem_url_edit">URL da Imagem:</label>
                    <input type="text" id="imagem_url_edit" name="imagem_url" value="<?= htmlspecialchars($filmeEdicao['imagem_url']) ?>" required style="width: 60%;">
                </div>
                <div class="pure-control-group">
                    <label for="imdb_edit">Link IMDb:</label>
                    <input type="text" id="imdb_edit" name="imdb" value="<?= htmlspecialchars($filmeEdicao['imdb']) ?>" required style="width: 60%;">
                </div>

                <div class="pure-controls" style="margin-top: 15px;">
                    <button type="submit" name="salvar_edicao" class="pure-button pure-button-primary">Salvar Alterações</button>
                    <a href="filmes.php" class="pure-button">Cancelar</a>
                </div>
            </form>
        </div>
        <?php endif; ?>

        <?php if ($exibirInclusao): ?>
        <div id="bloco_cadastro" class="bloco_edicao">
            <h3 class="titulo_secundario" style="margin-bottom: 15px;">Cadastrar Novo Filme</h3>
            <form method="POST" action="filmes.php" class="pure-form pure-form-aligned">
                <div class="pure-control-group">
                    <label for="titulo_novo">Título:</label>
                    <input type="text" id="titulo_novo" name="titulo">
                </div>
                <div class="pure-control-group">
                    <label for="ano_novo">Ano:</label>
                    <input type="number" id="ano_novo" name="ano">
                </div>
                <div class="pure-control-group">
                    <label for="diretor_novo">Diretor:</label>
                    <input type="text" id="diretor_novo" name="diretor">
                </div>
                <div class="pure-control-group">
                    <label for="pais_novo">País:</label>
                    <input type="text" id="pais_novo" name="pais">
                </div>
                <div class="pure-control-group">
                    <label for="diaria_novo">Preço Diária (R$):</label>
                    <input type="number" step="0.01" id="diaria_novo" name="diaria">
                </div>
                <div class="pure-control-group">
                    <label for="status_novo">Status:</label>
                    <select id="status_novo" name="status">
                        <option value="Disponível">Disponível</option>
                        <option value="Indisponível">Indisponível</option>
                    </select>
                </div>
                <div class="pure-control-group">
                    <label for="imagem_url_novo">URL da Imagem:</label>
                    <input type="text" id="imagem_url_novo" name="imagem_url" required placeholder="https://..." style="width: 60%;">
                </div>
                <div class="pure-control-group">
                    <label for="imdb_novo">Link IMDb:</label>
                    <input type="text" id="imdb_novo" name="imdb" required placeholder="https://www.imdb.com/title/..." style="width: 60%;">
                </div>

                <div class="pure-controls" style="margin-top: 15px;">
                    <button type="submit" name="salvar_inclusao" class="pure-button pure-button-primary">Cadastrar Filme</button>
                    <a href="filmes.php" class="pure-button">Cancelar</a>
                </div>
            </form>
        </div>
        <?php endif; ?>
    </section>

    <section class="container">
        <h2 class="titulo">Simulador de Orçamento de Locação</h2>
        <div class="simulador_orcamento">
            <div class="grupo_campo">
                <label for="filme_locacao">Escolha o Filme:</label>
                <select id="filme_locacao" class="campo_select">
                    <option value="">-- Selecione um filme --</option>
                    <option value="8.50">O Enigma de Outro Mundo - R$ 8,50/dia</option>
                    <option value="6.00">Mangue Negro - R$ 6,00/dia</option>
                    <option value="7.50">[REC] - R$ 7,50/dia</option>
                    <option value="" disabled>Les yeux sans visage - Indisponível</option>
                </select>
            </div>

            <div class="grupo_campo">
                <label for="qtd_dias">Quantidade de Dias:</label>
                <input type="number" id="qtd_dias" class="campo_input" min="1" max="30" value="1">
            </div>

            <button type="button" id="botao_calcular" class="botao_calcular" onclick="calcularOrcamento()">
                Calcular Orçamento
            </button>
        </div>

        <div id="resultado_orcamento" class="resultado_orcamento" style="display: none;">
            <h4>Resumo da Simulação:</h4>
            <p>Subtotal: R$ <span id="orcamento_subtotal">0,00</span></p>
            <p>Desconto: <span id="orcamento_desconto">0% (-R$ 0,00)</span></p>
            <p class="total_destaque">Total a Pagar: R$ <strong id="orcamento_total">0,00</strong></p>
        </div>
    </section>

    <form class="pure-form pure-form-stacked container formulario" id="Formulario" name="Formulario">
        <legend>Cadastre-se:</legend>
        <fieldset>
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome">

            <label for="sobrenome">Sobrenome:</label>
            <input type="text" id="sobrenome" name="sobrenome">

            <label for="dataAniv">Data de Nascimento:</label>
            <input type="date" id="dataAniv" name="dataAniv">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email">

            <button type="submit" class="pure-button pure-button-primary">Submit</button>
        </fieldset>
    </form>

    <h3 class="titulo_secundario" style="text-align: center; margin-top: 30px;">
        Confira o trailer de Mangue Negro a seguir:
    </h3>
    <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/2VitYcfwogo"
        title="Trailer Mangue Negro"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
    </iframe>


    <footer class="rodape">
        <p>&copy; <span id="ano"></span> Locadora de Filmes. Todos os direitos reservados.</p>
    </footer>

    <script>
        const form = document.getElementById("Formulario");

        // Funcionalidade 1: validação de cadastro
        function validaCadastro() {
            const nome = document.getElementById("nome").value.trim();
            const sobrenome = document.getElementById("sobrenome").value.trim();
            const dataAniv = document.getElementById("dataAniv").value.trim();
            const email = document.getElementById("email").value.trim();

            if (!nome) {
                alert("Erro: O campo 'Nome' é obrigatório e não foi preenchido");
                document.getElementById("nome").focus();
                return false;
            }

            if (!sobrenome) {
                alert("Erro: O campo 'Sobrenome' é obrigatório e não foi preenchido");
                document.getElementById("sobrenome").focus();
                return false;
            }

            if (!dataAniv) {
                alert("Erro: O campo 'Data de Nascimento' é obrigatório e não foi preenchido");
                document.getElementById("dataAniv").focus();
                return false;
            }

            if (!email) {
                alert("Erro: O campo 'Email' é obrigatório e não foi preenchido");
                document.getElementById("email").focus();
                return false;
            }

            return true;
        }

        // Funcionalidade 2: validação de idade
        function validaIdade() {
            const valorData = document.getElementById("dataAniv").value;
            if (!valorData) return false;

            const dataAniv = new Date(valorData);
            const dataAtual = new Date();

            let idade = dataAtual.getFullYear() - dataAniv.getFullYear();
            const mes = dataAtual.getMonth() - dataAniv.getMonth();

            if (mes < 0 || (mes === 0 && dataAtual.getDate() < dataAniv.getDate())) {
                idade--;
            }

            if (idade < 18) {
                alert("Erro: Você deve ter pelo menos 18 anos para se cadastrar");
                document.getElementById("dataAniv").focus();
                return false;
            }

            return true;
        }

        function normalizarTexto(texto) {
            return texto.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
        }

        // Funcionalidade 3: filtrar filmes (ignora acentos e ç)
        function filtrarFilmes() {
            const pesquisa = normalizarTexto(document.getElementById("pesquisaFilmes").value);
            const linhas = document.querySelectorAll(".linha");

            for (let i = 1; i < linhas.length; i++) {
                const textoLinha = normalizarTexto(linhas[i].textContent);
                linhas[i].style.display = textoLinha.includes(pesquisa) ? "" : "none";
            }
        }

        // Funcionalidade 4: sorteador de filmes ("Surpreenda-me")
        function sortearFilme() {
            const linhas = document.querySelectorAll(".tabela .linha");
            const linhasFilmes = Array.from(linhas).slice(1);

            const indiceAleatorio = Math.floor(Math.random() * linhasFilmes.length);
            const colunas = linhasFilmes[indiceAleatorio].querySelectorAll("td");

            document.getElementById("sorteioPoster").src = colunas[0].querySelector("img").src;
            document.getElementById("sorteioTitulo").textContent = colunas[1].textContent.trim();
            document.getElementById("sorteioAno").textContent = colunas[3].textContent.trim();
            document.getElementById("sorteioDiretor").textContent = colunas[4].textContent.trim();
            document.getElementById("sorteioPais").textContent = colunas[2].textContent.trim();
            document.getElementById("sorteioPreco").textContent = colunas[7].textContent.trim();
            document.getElementById("sorteioStatus").textContent = colunas[6].textContent.trim();

            document.getElementById("cardSorteio").style.display = "block";
        }

        function fecharSorteio() {
            document.getElementById("cardSorteio").style.display = "none";
        }

        // Funcionalidade 5: simulador de Orçamento de Locação
        function calcularOrcamento() {
            const selectFilme = document.getElementById("filme_locacao");
            const inputDias = document.getElementById("qtd_dias");
            const precoDiaria = parseFloat(selectFilme.value);
            const dias = parseInt(inputDias.value);

            if (!selectFilme.value) {
                alert("Erro: Selecione um filme para simular o orçamento.");
                selectFilme.focus();
                return;
            }

            if (isNaN(dias) || dias <= 0) {
                alert("Erro: Informe uma quantidade válida de dias (mínimo 1).");
                inputDias.focus();
                return;
            }

            const subtotal = precoDiaria * dias;
            let percentualDesconto = 0;

            if (dias >= 7) {
                percentualDesconto = 20;
            } else if (dias >= 3) {
                percentualDesconto = 10;
            }

            const valorDesconto = (subtotal * percentualDesconto) / 100;
            const valorTotal = subtotal - valorDesconto;

            document.getElementById("orcamento_subtotal").textContent = subtotal.toFixed(2).replace(".", ",");
            document.getElementById("orcamento_desconto").textContent = percentualDesconto + "% (-R$ " + valorDesconto.toFixed(2).replace(".", ",") + ")";
            document.getElementById("orcamento_total").textContent = valorTotal.toFixed(2).replace(".", ",");

            document.getElementById("resultado_orcamento").style.display = "block";
        }

        form.addEventListener("submit", function (event) {
            event.preventDefault();

            if (validaCadastro() && validaIdade()) {
                alert("Sucesso: Todos os campos obrigatórios foram informados");
            }
        });

        // Funcionalidade 6: ano dinâmico
        document.getElementById("ano").textContent = new Date().getFullYear();

        // Funcionalidade 7: modo Noturno
        function alternarTema() {
            const botao = document.getElementById("botao_tema");
            const estaNoturno = document.body.classList.toggle("modo_noturno");

            if (estaNoturno) {
                botao.textContent = "Modo Claro";
                localStorage.setItem("tema_preferido", "noturno");
            } else {
                botao.textContent = "Modo Noturno";
                localStorage.setItem("tema_preferido", "claro");
            }
        }

        if (localStorage.getItem("tema_preferido") === "noturno") {
            document.body.classList.add("modo_noturno");
            const botaoTema = document.getElementById("botao_tema");
            if (botaoTema) {
                botaoTema.textContent = "Modo Claro";
            }
        }
    </script>
</body>

</html>