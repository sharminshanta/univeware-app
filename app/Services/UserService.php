<?php

namespace App\Services;

use App\Repositories\UserRepositoryInterface;

class UserService
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ) {
    }

    public function create(array $data)
    {
        return $this->userRepository->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->userRepository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->userRepository->delete($id);
    }

    public function all()
    {
        return $this->userRepository->all();
    }

    public function find($id)
    {
        return $this->userRepository->find($id);
    }

    public function getTrashedAll()
    {
        return $this->userRepository->getTrashedAll();
    }

    public function trashedRestore($id)
    {
        return $this->userRepository->trashedRestore($id);
    }

    public function forceDelete($id)
    {
        return $this->userRepository->forceDelete($id);
    }
}
