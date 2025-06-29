
<?php
include_once("config.php");
include_once("templates/header.php");

$id = $_GET['id'] ?? null;

if ($id) {
    try {

        $stmt = $conn->prepare("SELECT * FROM produtos WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $produto = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nome_produto = $_POST['nome_produto'];
            $preco = str_replace(',', '.', $_POST['preco']);
            $quantidade = $_POST['quantidade'];


            $stmt = $conn->prepare("UPDATE produtos SET nome_produto = :nome_produto, preco = :preco, quantidade = :quantidade WHERE id = :id");
            $stmt->bindParam(':nome_produto', $nome_produto, PDO::PARAM_STR);
            $stmt->bindParam(':preco', $preco);
            $stmt->bindParam(':quantidade', $quantidade, PDO::PARAM_INT);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            header("Location: index.php");
            exit;
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
} else {
    echo "ID inválido.";
}
?>

<div class="bg-gray-100 min-h-screen py-10 px-4">
    <div class="max-w-2xl mx-auto bg-white shadow-xl rounded-xl border border-gray-200 overflow-hidden">
        <div class="bg-gray-900 px-6 py-4 flex items-center gap-3">
            <i class="fas fa-tools text-yellow-400 text-xl"></i>
            <h2 class="text-white text-xl font-bold">Editar Produto - Autopeças</h2>
        </div>

        <form method="post" class="p-6 space-y-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1 uppercase tracking-wide">Nome do Produto</label>
                <input
                        type="text"
                        name="nome_produto"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                        value="<?= htmlspecialchars($produto['nome_produto']) ?>" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1 uppercase tracking-wide">Preço (R$)</label>
                <input
                        type="text"
                        name="preco"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                        value="<?= number_format($produto['preco'], 2, ',', '.') ?>" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1 uppercase tracking-wide">Quantidade</label>
                <input
                        type="number"
                        name="quantidade"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                        value="<?= $produto['quantidade'] ?>" required>
            </div>

            <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                <button
                        type="submit"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded-lg font-semibold flex items-center gap-2 transition-all duration-200">
                    <i class="fas fa-save"></i> Atualizar
                </button>
                <a
                        href="index.php"
                        class="text-gray-600 hover:text-gray-900 font-medium transition-all duration-150">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>



<?php include_once("templates/footer.php"); ?>
