<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\Database\RawSql;
use App\Models\TransaksiModel;

class Transaksi extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */

    protected $transaksiModel;
    protected $db;
    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
        $this->db  = \Config\Database::connect();
    }
    public function index()
    {
        $sql = 'SELECT * FROM transaksi JOIN barang ON transaksi.id_barang=barang.id_barang JOIN pembeli ON transaksi.id_pembeli=pembeli.id_pembeli;';
        $transactions = $this->db->query($sql)->getResult('array');

        return view('transaksi/index', ['transactions' => $transactions]);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        $sql = 'SELECT * FROM transaksi JOIN barang ON transaksi.id_barang=barang.id_barang JOIN pembeli ON transaksi.id_pembeli=pembeli.id_pembeli WHERE transaksi.id_transaksi =' . $id . ';';
        $transaction = $this->db->query($sql);

        return view('transaksi/transaksi', ['transaction' => $transaction]);
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        $sqlProducts = 'SELECT * FROM barang WHERE stok > 0;';
        $products = $this->db->query($sqlProducts)->getResult('array');
        $sqlCustomers = 'SELECT * FROM pembeli;';
        $customers = $this->db->query($sqlCustomers)->getResult('array');
        return view('transaksi/create', [
            'products' => $products,
            'customers' => $customers
        ]);
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $validation = $this->validate([
            'barang' => [
                'rules' => 'required',
                'errors' => ['required' => 'Pilih barang']
            ],
            'pembeli' => [
                'rules' => 'required',
                'errors' => ['required' => 'Pilih pembeli']
            ],
            'tanggal' => [
                'rules' => 'required',
                'errors' => ['required' => 'Masukkan tanggal']
            ],
        ]);

        if (!$validation) {
            $sqlProducts = 'SELECT * FROM barang WHERE stok > 0;';
            $products = $this->db->query($sqlProducts)->getResult('array');
            $sqlCustomers = 'SELECT * FROM pembeli;';
            $customers = $this->db->query($sqlCustomers)->getResult('array');
            return view('transaksi/create', [
                'validation' => $this->validator,
                'products' => $products,
                'customers' => $customers

            ]);
        } else {

            $data = [

                'id_barang' => $this->request->getPost('barang'),
                'id_pembeli'  => $this->request->getPost('pembeli'),
                'tanggal'  => $this->request->getPost('tanggal'),
                'keterangan'  => $this->request->getPost('keterangan'),
            ];

            $this->transaksiModel->save($data);
            $sqlMinusStok = 'UPDATE barang SET stok = stok - 1 WHERE id_barang =' . $this->request->getPost('barang') . ';';
            $this->db->query($sqlMinusStok);
            //flash message
            session()->setFlashdata('message', 'Transaksi Berhasil Disimpan');

            return redirect()->to('/transaksi');
        }
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        $sql = 'SELECT * FROM transaksi JOIN barang ON transaksi.id_barang=barang.id_barang JOIN pembeli ON transaksi.id_pembeli=pembeli.id_pembeli WHERE transaksi.id_transaksi =' . $id . ';';
        $transaction = $this->db->query($sql)->getResult('array');
        $sqlProducts = 'SELECT * FROM barang WHERE stok > 0;';
        $products = $this->db->query($sqlProducts)->getResult('array');
        $sqlCustomers = 'SELECT * FROM pembeli;';
        $customers = $this->db->query($sqlCustomers)->getResult('array');

        return view('transaksi/edit', [
            'transaction' => $transaction,
            'products' => $products,
            'customers' => $customers
        ]);
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        $validation = $this->validate([
            'barang' => [
                'rules' => 'required',
                'errors' => ['required' => 'Pilih barang']
            ],
            'pembeli' => [
                'rules' => 'required',
                'errors' => ['required' => 'Pilih pembeli']
            ],
            'tanggal' => [
                'rules' => 'required',
                'errors' => ['required' => 'Masukkan tanggal']
            ],
        ]);

        if (!$validation) {
            $sqlProducts = 'SELECT * FROM barang WHERE stok > 0;';
            $products = $this->db->query($sqlProducts)->getResult('array');
            $sqlCustomers = 'SELECT * FROM pembeli;';
            $customers = $this->db->query($sqlCustomers)->getResult('array');
            $sql = 'SELECT * FROM transaksi JOIN barang ON transaksi.id_barang=barang.id_barang JOIN pembeli ON transaksi.id_pembeli=pembeli.id_pembeli WHERE transaksi.id_transaksi =' . $id . ';';
            $transaction = $this->db->query($sql)->getResult('array');
            return view('transaksi/edit', [
                'validation' => $this->validator,
                'products' => $products,
                'customers' => $customers,
                'transaction' => $transaction,
            ]);
        } else {

            $data = [
                'id_transaksi' => $id,
                'id_barang' => $this->request->getPost('barang'),
                'id_pembeli'  => $this->request->getPost('pembeli'),
                'tanggal'  => $this->request->getPost('tanggal'),
                'keterangan'  => $this->request->getPost('keterangan'),
            ];

            $this->transaksiModel->save($data);
            $sqlMinusStok = 'UPDATE barang SET stok = stok - 1 WHERE id_barang =' . $this->request->getPost('barang') . ';';
            $this->db->query($sqlMinusStok);
            //flash message
            session()->setFlashdata('message', 'Transaksi Berhasil Disimpan');

            return redirect()->to('/transaksi');
        }
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        $post = $this->transaksiModel->find(($id));

        $this->transaksiModel->delete($id);
        //flash message
        session()->setFlashdata('message', 'Transaksi Berhasil Dihapus');

        return redirect()->to('/transaksi');
    }
}
