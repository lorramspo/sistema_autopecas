<?php
include_once("config.php");
include_once("templates/header.php");

try {
    $stmt = $conn->query("SELECT * FROM produtos ORDER BY id DESC");
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $total_geral = 0;
} catch (PDOException $e) {
    echo "Erro ao buscar produtos: " . $e->getMessage();
}
?>
<div class="flex justify-between items-center mb-6">
    <a href="add.php" class="bg-blue-700 hover:bg-blue-800 text-white px-5 py-2 rounded-lg text-sm font-semibold shadow transition-all duration-200">
        <i class="fas fa-plus mr-2"></i>Adicionar Produto
    </a>
</div>

<div class="overflow-x-auto bg-white shadow-lg rounded-xl border border-gray-200">
    <table class="min-w-full text-sm text-gray-800">
        <thead class="bg-blue-900 text-white uppercase text-xs tracking-wider">
        <tr>
            <th class="p-4 text-left">Produto</th>
            <th class="p-4 text-left">Preço</th>
            <th class="p-4 text-left">Quantidade</th>
            <th class="p-4 text-left">Subtotal</th>
            <th class="p-4 text-center w-40">Ações</th>
        </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
        <?php while ($item = $result->fetch_assoc()):
            $subtotal = $item['preco'] * $item['quantidade'];
            $total_geral += $subtotal;
            ?>
            <tr class="hover:bg-gray-50 transition-all">
                <td class="p-4"><?= htmlspecialchars($item['nome_produto']) ?></td>
                <td class="p-4">R$ <?= number_format($item['preco'], 2, ',', '.') ?></td>
                <td class="p-4"><?= $item['quantidade'] ?></td>
                <td class="p-4 font-medium text-green-700">R$ <?= number_format($subtotal, 2, ',', '.') ?></td>
                <td class="p-4 text-center">
                    <div class="flex justify-center gap-4">
                        <a href="edit.php?id=<?= $item['id'] ?>" class="text-blue-600 hover:text-blue-800 flex items-center gap-1">
                            <i class="fas fa-edit"></i> <span class="hidden sm:inline">Editar</span>
                        </a>
                        <a href="delete.php?id=<?= $item['id'] ?>" onclick="return confirm('Deseja excluir este produto?')" class="text-red-600 hover:text-red-800 flex items-center gap-1">
                            <i class="fas fa-trash-alt"></i> <span class="hidden sm:inline">Excluir</span>
                        </a>
                    </div>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
        <tfoot class="bg-gray-100 text-gray-800 font-semibold border-t border-gray-300">
        <tr>
            <td colspan="3" class="p-4 text-right">Total Geral:</td>
            <td colspan="2" class="p-4 text-green-800">R$ <?= number_format($total_geral, 2, ',', '.') ?></td>
        </tr>
        </tfoot>
    </table>
</div>



<?php include_once("templates/footer.php"); ?>
