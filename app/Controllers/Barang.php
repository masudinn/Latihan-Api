<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait as ResponseTrait;
use App\ModelS\ModelBarang;

class Barang extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        $dataModel = new ModelBarang();
        $data = $dataModel->findAll();
        return $this->respond($data, 200);
    }


    public function productId($id = null)
    {
        $dataModel = new ModelBarang();
        $data = $dataModel->getWhere(['id_produk' => $id])->getResult();

        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data Tidak Ditemukan' . $id);
        }
    }

    public function createProduct()
    {
        $dataModel = new ModelBarang();
        $data = [
            'nama_produk' => $this->request->getPost('nama_produk'),
            'deskripsi_produk' => $this->request->getPost('deskripsi_produk')
        ];
        $data = json_decode(file_get_contents("php://input"));
        $dataModel->insert($data);
        $response = [
            'status' => 201,
            'error' => null,
            'message' => [
                'succes' => 'Data Saved'
            ]
        ];
        $this->respondCreated($data, 201);
    }
}
