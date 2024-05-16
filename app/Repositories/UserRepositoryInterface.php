<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function all();
    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function find($id);

    public function getTrashedAll();

    public function trashedRestore($id);

    public function forceDelete($id);
}
