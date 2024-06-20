<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Post;

class Posts extends ResourceController
{
    protected $postModel;
    public function __construct()
    {
        $this->postModel = new Post();
    }
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $posts = $this->postModel->findAll();
        $data = [
            'posts' => $posts
        ];
        return view('posts/index', $data);
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
        $post = $this->postModel->getPost(($id));
        if (empty($post)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Post not found');
        }
        return view('posts/post', ['post' => $post]);
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        return view('posts/create');
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $validation = $this->validate([
            'title' => [
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'Masukkan judul post'
                ]
            ],
            'body' => [
                'rules' => 'required',
                'errors' => ['required' => 'Masukkan detail post']
            ],
            'image' => [
                'rules' => 'uploaded[image]|max_size[image,1024]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Wajib upload gambar',
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'File bukan gambar',
                    'mime_in' => 'File bukan gambar'
                ]
            ]
        ]);
        if (!$validation) {
            return view('posts/create', [
                'validation' => $this->validator
            ]);
        } else {
            $uploadedImage = $this->request->getFile('image');
            $imageName = $uploadedImage->getRandomName();
            $uploadedImage->move('img', $imageName);

            $data = [

                'title' => $this->request->getPost('title'),
                'body'  => $this->request->getPost('body'),
                'image' => $imageName
            ];

            $this->postModel->save($data);
            //flash message
            session()->setFlashdata('message', 'Post Berhasil Disimpan');

            return redirect()->to('/posts');
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
        $post = $this->postModel->getPost(($id));
        if (empty($post)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Post not found');
        }
        return view('posts/edit', [
            'post' => $post
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
            'title' => [
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'Masukkan judul post'
                ]
            ],
            'body' => [
                'rules' => 'required',
                'errors' => ['required' => 'Masukkan detail post']
            ],
            'image' => [
                'rules' => 'max_size[image,1024]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'File bukan gambar',
                    'mime_in' => 'File bukan gambar'
                ]
            ]
        ]);
        if (!$validation) {
            $post = $this->postModel->getPost(($id));
            if (empty($post)) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Post not found');
            }

            return view('posts/edit', [
                'post' => $post,
                'validation' => $this->validator
            ]);
        } else {
            $uploadedImage = $this->request->getFile('image');
            if ($uploadedImage->getError() == 4) {
                $imageName = $this->request->getVar('oldImage');
            } else {
                $imageName = $uploadedImage->getRandomName();
                $uploadedImage->move('img', $imageName);
                unlink('img/' . $this->request->getVar('oldImage'));
            }

            $data = [
                'id' => $id,
                'title' => $this->request->getPost('title'),
                'body'  => $this->request->getPost('body'),
                'image' => $imageName
            ];

            $this->postModel->save($data);
            //flash message
            session()->setFlashdata('message', 'Post Berhasil Diupdate');

            return redirect()->to('/posts');
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
        $post = $this->postModel->getPost(($id));

        unlink('img/' . $post['image']);

        $this->postModel->delete($id);
        //flash message
        session()->setFlashdata('message', 'Post Berhasil Dihapus');

        return redirect()->to('/posts');
    }
}
