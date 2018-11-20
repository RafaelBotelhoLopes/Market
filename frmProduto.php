<?php
    include_once 'model/clsCategoria.php';
    include_once 'model/clsProduto.php';
    include_once 'dao/clsCategoriaDAO.php';
    include_once 'dao/clsProdutoDAO.php';
    include_once 'dao/clsConexao.php';

    $nome = "";
    $preco = "";
    $quantidade = "";
    $idCategoria = 0;
    $foto = "sem_foto.png";
    $action = "inserir";
    
    if( isset($_REQUEST['editar']) ){
        $id = $_REQUEST['idProduto'];
        $produto = ProdutoDAO::getProdutosById($id);
        $nome = $produto->getNome();
        $preco = $produto->getPreco();
        $quantidade = $produto->getQuantidade();
        $foto = $produto->getFoto();
        $idCategoria = $produto->getCategoria()->getId(); 
        $action = "editar&idProduto=".$produto->getId();
    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cadastrar Produto</title>
    </head>
    <body>
        <?php
            require_once './menu.php';
        ?>
        
        <h1 align="center">Cadastrar Produto</h1>
        <br><br><br>
        
        <form action="controller/salvarProduto.php?<?php echo $action; ?>" method="POST" enctype="multipart/form-data">
            
            <label>Nome: </label>
            <input type="text" name="txtNome" value="<?php echo $nome;?>" required maxlength="100"/> <br><br>
            <label>Preço: </label>
            <input type="text" name="txtPreco" value="<?php echo $preco;?>" maxlength="30"/> <br><br>
            <label>Quantidade: </label>
            <input type="text" name="txtQuantidade" value="<?php echo $quantidade;?>" maxlength="30"/> <br><br>
            
            <label>Categoria: </label>
            <select name="categoria">
                <option value="0">Selecione...</option>
                
                <?php
                    $lista = CategoriaDAO::getCategorias();
                    
                    foreach ($lista as $cat){
                        $selecionar = "";
                        if( $idCategoria == $cat->getId() ){
                            $selecionar = "selected";
                        }
                        echo '<option '.$selecionar.' value="'.$cat->getId().'" >'.$cat->getNome().'</option>';
                    }
                ?>
                
            </select> <br><br>
            
            <label>Foto: </label>
            
            <?php
                if( isset($_REQUEST['editar']) ){
                    echo '<img src="fotos_produtos/'.$foto.'" width="200px" />';
                }
            ?>
            
            <input type="file" name="foto" /> <br><br>
            
            <input type="submit" value="Salvar" />
            <input type="reset" value="Limpar" /> 
            
        </form> 
        
    </body>
</html>
