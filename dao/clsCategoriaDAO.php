<?php


class CategoriaDAO {
    
    public static function inserir( $categoria ){
        $sql = "INSERT INTO categorias ( nome ) VALUES ( '".$categoria->getNome()."' ); ";
        Conexao::executar($sql);
        
    }
    
    public static function editar( $categoria ){
        $sql =    "UPDATE categorias SET nome = '".$categoria->getNome()."' "
                . " WHERE id = ".$categoria->getId();
        Conexao::executar($sql);
        
    }
    
    public static function excluir( $idCategoria ){
        $sql =    "DELETE FROM categorias "
                . " WHERE id = ".$idCategoria;
        Conexao::executar($sql);
        
    }
    
    public static function getCategorias(){
        $sql = "SELECT * FROM categorias ORDER BY nome";
        $result = Conexao::consultar($sql);
        $lista = new ArrayObject();
        if ( $result != NULL ){
            while ( list($_id, $_nome) = mysqli_fetch_row($result)){
                $categoria = new Categoria();
                $categoria->setId($_id);
                $categoria->setNome($_nome);
                $lista->append($categoria);
            }
        }
        return $lista;
    }
    
    public static function getCategoriaById( $id ){
        $sql = "SELECT id, nome FROM categorias "
                . " WHERE id = ".$id
                . " ORDER BY nome";
        $result = Conexao::consultar($sql);
        if ( $result != NULL ){
            list($_id, $_nome) = mysqli_fetch_row($result);
                $categoria = new Categoria();
                $categoria->setId($_id);
                $categoria->setNome($_nome);
            
        }
        return $categoria;
    }
    
}
