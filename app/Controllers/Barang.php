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


    public function show($id = null)
    {
        $dataModel = new ModelBarang();
        $data = $dataModel->getWhere(['id_produk' => $id])->getResult();

        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data Tidak Ditemukan' . $id);
        }
    }

    public function create()
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

    public function update($id = null)
    {
        $model = new ModelBarang();
        $json = $this->request->getJSON();
        if ($json) {
            $data = [
                'nama_produk' => $json->nama_produk,
                'deskripsi_produk' => $json->deskripsi_produk
            ];
        } else {
            $input = $this->request->getRawInput();
            $data = [
                'nama_produk' => $input['nama_produk'],
                'deskripsi_produk' => $input['deskripsi_produk']
            ];
        }

        $model->update($id, $data);
        $response = [
            'status' => 200,
            'error' => null,
            'message' => [
                'success' => 'Data Updated'
            ]
        ];
        return $this->respond($response);
    }

    public function delete($id = null)
    {
        $dataModel = new ModelBarang();
        $data = $dataModel->find($id);
        if ($data) {
            $dataModel->delete($id);
            $response = [
                'status' => 200,
                'error' => null,
                'message' => [
                    'success' => 'Data Deleted'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('Data Tidak Ditemukan' . $id);
        }
    }
}
