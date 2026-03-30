<?php $fieldClass = 'focus:outline-none text-sm px-2.5 py-1 rounded-lg bg-zinc-900 text-zinc-300 border border-zinc-700'; ?>

<div class="flex flex-col gap-2">
    <div class="flex flex-col gap-1">
        <label for="name">Nome</label>
        <input name="name" type="text" class="<?= $fieldClass ?>" value="<?= htmlspecialchars($data['name'] ?? '') ?>">
        
        <?php if (isset($erros['name'])): ?>
            <span class="text-red-500 text-sm"><?= $erros['name'] ?></span>
        <?php endif; ?>
    </div>
    
    <div class="flex flex-col gap-1">
        <label for="type">Tipo</label>
        <select name="type" class="<?= $fieldClass ?>">
            <option value="CARTEIRA" <?= ($data['type'] ?? '') === 'CARTEIRA' ? 'selected' : '' ?>>Carteira</option>
            <option value="CREDITO" <?= ($data['type'] ?? '') === 'CREDITO' ? 'selected' : '' ?>>Crédito</option>
            <option value="RESERVA" <?= ($data['type'] ?? '') === 'RESERVA' ? 'selected' : '' ?>>Reserva</option>
        </select>
        
        <?php if (isset($erros['type'])): ?>
            <span class="text-red-500 text-sm"><?= $erros['type'] ?></span>
        <?php endif; ?>
    </div>
</div>
<button type="submit" class="w-full cursor-pointer bg-zinc-50 rounded-lg flex justify-center font-bold px-2 py-1 items-center text-zinc-900">Adicionar</button>
