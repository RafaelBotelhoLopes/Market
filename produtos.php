<?php
    include_once 'model/clsCategoria.php';
    include_once 'model/clsProduto.php';
    include_once 'dao/clsProdutoDAO.php';
    include_once 'dao/clsConexao.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Market M171 - Produtos</title>
    </head>
    <body>
        <?php
            require_once './menu.php';
        ?>
        
        <h1 align="center">Produtos</h1>
        
        <br><br><br>
        
        <a href="frmProduto.php">
            <button>Cadastrar novo produto</button></a>
        
            <br><br>
            
            <?php
                $lista = ProdutoDAO::getProdutos();
            
                    if( $lista ->count()==0){
                        echo '<h2><b>Nenhum produto cadastrado</b></h2>';
                    } else {
                
            ?>
            
            <table border="1">
            <tr>
                <th>Código</th>
                <th>Foto</th>
                <th>Nome do Produto</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Categoria</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
            
            <?php
                foreach ($lista as $cat){
                        echo ' <tr> ';
                        echo ' <td>'.$cat->getId().'</td>';
                        echo ' <td><img src="fotos_produtos/'.$cat->getFoto().'" width="50px"/></td>';
                        echo ' <td>'.$cat->getNome().'</td>';
                        echo ' <td>'.$cat->getPreco().'</td>';
                        echo ' <td>'.$cat->getQuantidade().'</td>';
                        echo ' <td>'.$cat->getCategoria()->getNome().'</td>';
                       
                        echo '<td>
                                <a href="frmProduto.php?editar&idProduto='.$cat->getId().'">
                                <button>Editar</button></a>
                            </td>';
                        echo '<td>
                                <a href="controller/salvarProduto.php?excluir&idProduto='.$cat->getId().'">
                                <button>Excluir</button></a>
                            </td>';
                                
                        echo '</tr>';
                    }
            ?>
            
            </table>
            
            <?php
                    }
            ?>
            
    </body>
</html>
