<?php $fieldClass = 'focus:outline-none text-sm px-2.5 py-1 rounded-lg bg-zinc-900 text-zinc-300 border border-zinc-700'; ?>

<div class="flex flex-col gap-2">
    <div class="flex flex-col gap-1">
        <label for="description">Descrição</label>
        <input name="description" type="text" class="<?= $fieldClass ?>" value="<?= htmlspecialchars($data['description'] ?? '') ?>">
        
        <?php if (isset($erros['description'])): ?>
            <span class="text-red-500 text-sm"><?= $erros['description'] ?></span>
        <?php endif; ?>
    </div>

    <div class="flex flex-col gap-1">
        <label for="amount-display">Valor (R$)</label>
        <input
            id="amount-display"
            type="text"
            inputmode="numeric"
            placeholder="0,00"
            class="dinheiro <?= $fieldClass ?>"
            value="<?php
                if (!empty($data['amount'])) {
                    echo number_format($data['amount'] / 100, 2, ',', '.');
                }
            ?>"
        >
        <input type="hidden" id="valor-centavos" name="amount" value="<?= htmlspecialchars($data['amount'] ?? '') ?>">

        <?php if (isset($erros['amount'])): ?>
            <span class="text-red-500 text-sm"><?= $erros['amount'] ?></span>
        <?php endif; ?>
    </div>

    <div class="flex flex-col gap-1">
        <label for="date">Data</label>
        <input name="date" id="date" type="date" class="<?= $fieldClass ?>" value="<?= htmlspecialchars($data['date'] ?? date('Y-m-d')) ?>">
        
        <?php if (isset($erros['date'])): ?>
            <span class="text-red-500 text-sm"><?= $erros['date'] ?></span>
        <?php endif; ?>
    </div>
</div>
<button type="submit" class="w-full cursor-pointer bg-zinc-50 rounded-lg flex justify-center font-bold px-2 py-1 items-center text-zinc-900">Salvar</button>
