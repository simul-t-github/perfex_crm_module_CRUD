
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Test extends ClientsController
{

    public function index()
    {
        $data = [
            'title' => 'Product List',
            'body' => 'index',
            'products' => $this->db->get(db_prefix() . 'test_product')->result(),
        ];

        $this->load->view('layout/master', $data);
    }

    public function product_add($id = 0)
    {
        $data = [
            'title' => 'Product Add',
            'body' => 'product-add',
        ];

        if ($id != 0) {
            $product = $this->db->get_where(db_prefix() . 'test_product', ['id' => $id])->row();
            $data['product'] = $product;
        }

        $this->load->view('layout/master', $data);
    }

    public function product_insert()
    {
        $input = $this->input->post();
        $id = $input['id'];
        $old_image = $input['old_image'];
        $image = $_FILES['image']['name'];
        $img_name = '';
        $path = 'modules/test/upload/';
        $config =  [
            'upload_path' => $path,
            'allowed_types' => 'jpg|png|jpeg|svg|gif',
            'encrypt_name' => true,
        ];
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $this->load->library('upload', $config);
        if ($image != '') {
            if ($this->upload->do_upload('image')) {
                $img_name = $this->upload->data('file_name');
                if ($id != 0) {
                    if (file_exists($path . $old_image)) {
                        unlink($path . $old_image);
                    }
                }
            }
        }else {
            $img_name = $old_image;
        }
        $insert = [
            'product_name' =>  $input['product_name'],
            'details' => $input['details'],
            'image' => $img_name,
        ];

        if ($id == 0) {
            $this->db->insert(db_prefix() . 'test_product', $insert);
        } else {
            $this->db->where('id', $id)->update(db_prefix() . 'test_product', $insert);
        }

        redirect(base_url('test'));
    }

    public function delete_product($id)
    {
        $path = 'modules/test/upload/';
        $product = $this->db->get_where(db_prefix() . 'test_product', ['id' => $id])->row();
        if (file_exists($path . $product->image)) {
            unlink($path . $product->image);
        }
        $this->db->where('id', $id)->delete(db_prefix() . 'test_product');
        redirect(base_url('test'));
    }
}

/* End of file Controllername.php */
