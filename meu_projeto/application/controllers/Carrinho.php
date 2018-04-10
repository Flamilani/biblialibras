<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Carrinho extends CI_Controller {
            
        public function listar(){
            
            $this->load->helper("funcoes");
            $this->load->view("v_carrinho");
            
        }

    public function ver_produto()
    {
        $this->load->model("m_produtos", "produtos");
        $this->load->helper("funcoes");
        
        $variaveis['produtos'] = $this->produtos->retorna_produtos();
        $this->load->view('v_produtos', $variaveis);
    }

    public function v_produto($id) {
        $this->load->model("m_produtos", "produtos");
        $this->load->helper("funcoes");
        
        $variaveis['produto'] = $this->produtos->retorna_produtos($id);
        $this->load->view('v_produto', $variaveis);
    }
        public function atualizar(){
            
            //recebo todo o conteúdo postado do formulário e no loop abaixo recupero o que preciso
            $conteudo_postado = $this->input->post();
            
            foreach($conteudo_postado as $conteudo) {
                
                $dados[] = array(
                
                    "rowid" => $conteudo['rowid'],
                    "qty" => $conteudo['qty']
                
                );
                    
            }
            //com os dados já preparados, basta dar um update no carrinho
            $this->cart->update($dados);
            
            redirect(base_url('carrinho/listar'));
            
        }
        public function inserir(){
            
            $this->cart->product_name_rules = '[:print:]'; 
            
            $id_produto = $this->input->post("id_produto");
            $descricao = $this->input->post("descricao");
            $quantidade = $this->input->post("quantidade");
            $preco = $this->input->post("preco");
            
            //se o usuário não informar a quantidade do produto, então, coloco 1
            if (empty($quantidade)) {
                $quantidade = 1;
            }
            
            //A biblioteca do carrinho de compras já está carregada lá pelo autoload, então não preciso chamá-la aqui novamente.
            
            
            $data = array(
               'id'      => $id_produto,
               'qty'     => $quantidade,
               'price'   => $preco,
               'name'    => $descricao
            );            
            
            
            if ($this->cart->insert($data)) {
                redirect(base_url('carrinho/listar'));
            } else {
                echo "Não foi possível inserir. <pre>";
                print_r($data);
                echo "</pre>";              
            }
            
        }
        //função que limpa o conteúdo do carrinho de compras.
        public function limpar(){
            
            $this->cart->destroy();
            redirect(base_url('carrinho/listar'));
            
        }
        
    }
