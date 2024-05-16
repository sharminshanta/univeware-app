<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Fetch all users
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(): \Illuminate\Database\Eloquent\Collection
    {
        return User::whereNot('id', auth()->user()->getAuthIdentifier())->get();
    }

    /**
     * Insert a new user
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data): mixed
    {
        return User::create($data);
    }

    /**
     * Update User
     *
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function update(array $data, $id): mixed
    {
        $user = User::findOrFail($id);

        $user->update($data);

        return $user;
    }

    /**
     * Delete the specific users
     *
     * @param $id
     * @return void
     */
    public function delete($id): void
    {
        $user = User::findOrFail($id);

        $user->delete();
    }

    /**
     * Specific User Information
     * @param $id
     * @return mixed
     */
    public function find($id): mixed
    {
        return User::findOrFail($id);
    }

    /**
     * Fetch all trashed users
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTrashedAll(): \Illuminate\Database\Eloquent\Collection
    {
        return User::onlyTrashed()->get();
    }

    /**
     * Restore the deleted users
     *
     * @param $id
     * @return void
     */
    public function trashedRestore($id): void
    {
        User::withTrashed()->find($id)->restore();
    }

    /**
     * Force Delete the specific users
     *
     * @param $id
     * @return void
     */
    public function forceDelete($id): void
    {
        User::withTrashed()->find($id)->forceDelete();
    }
}
