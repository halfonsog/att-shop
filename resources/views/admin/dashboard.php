<?php
view_include('layouts/header2', [
    'title' => 'Amin Dashboard'
]);
?>

<main class="content-wrapper">

<div class="admin_dashboard-page">
    <h1>Panel del Administrador</h1>
    <br/>
    <h3>Proveedores en espera de aprovacion:</h3>
    <?php if (!empty($stats) && !empty($stats->pending_suppliers) ): ?>
        <table>
        <?php foreach($stats->pending_suppliers as $s): ?>
            <tr> 
            <?php foreach($s as $f): ?>
                <td><?=$f ?></td>
            <?php endforeach; ?>               
            </tr>
        <?php endforeach; ?>               
        </table>
    <?php else: ?>
        <p>No hay datos disponibles</p>
    <?php endif; ?>
</div>
</main>
<?php view_include('layouts/footer2'); ?>
