<h1>Gestionar Categorias</h1>
<a href="<?=base_url?>categoria/crear" class="button button-small">
    Crear Categoria
</a>
<!--
    Una especie de foreach, que hace una variable por cada iteracion, o agarra los valores
    distintos, del siguente en cada iteración, parecido a stl de c++
-->
<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
    </tr>
<?php while($cat = $categorias->fetch_object()): ?>
    <tr>
        <td>
                <?= $cat->id ;?>
        </td>
        <td>
                    <?= $cat->nombre ;?>
        </td>
    </tr>
    

<?php endwhile;?>
</table>