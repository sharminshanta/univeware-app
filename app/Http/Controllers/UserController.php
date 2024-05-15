<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * Local Ref: http://127.0.0.1:8000/users
     */
    public function index()
    {
        return view('users.index', [
            'users' => User::whereNot('id', auth()->user()->getAuthIdentifier())->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
        /**
         * The incoming request is valid here
         * Retrieve the validated input data
         *
         * @var $validated = [
            "firstname" => 'devid'
            "lastname" => "gilmour"
            "username" => "devid_gilmour"
            ...
         */
        $validated = $request->validated();

        // File Upload
        if ($request->file()) {
            /**
             * Get file name
             * @var $fileName = 'logo.png'
             */
            $fileName = $request->file('photo')->getClientOriginalName();

            /**
             * Store file to 'storage/app/public/uploads' directory
             * @var $filePath = 'uploads/weighted_random_US.png'
             */
            $filePath = $request->file('photo')
                ->storeAs('uploads', $fileName, 'public');

            $validated['photo'] = $filePath;
        }

        try {
            $user = User::updateOrCreate(['id' => $validated['id'] ?? null], $validated);

            if ($user->wasRecentlyCreated) {
                $notifications['success'][] = "User created successfully!";
            } else {
                $notifications['success'][] = "Company updated successfully!";
            }
        } catch (\Exception $ex) {
            Log::channel('slack')
                ->alert('``` ' . $ex->getMessage() . ' ```', [
                'Location: ``` ' . __METHOD__ . ' ```',
            ]);
        }

        // Return to grid
        return redirect()->route('users.grid')
            ->with('error', $notifications['error'] ?? [])
            ->with('success', $notifications['success'] ?? []);
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function show(string $id)
    {
        $userDetails = User::findOrFail($id);
        return view('users.show', ['userDetails' => $userDetails]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $id
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(string $id)
    {
        $userDetails = User::findOrFail($id);
        return view('users.edit', ['userDetails' => $userDetails]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        // File Upload
        if ($request->file()) {
            /**
             * Get file name
             * @var $fileName = 'logo.png'
             */
            $fileName = $request->file('photo')->getClientOriginalName();

            /**
             * Store file to 'storage/app/public/uploads' directory
             * @var $filePath = 'uploads/weighted_random_US.png'
             */
            $filePath = $request->file('photo')
                ->storeAs('uploads', $fileName, 'public');

            $request['photo'] = $filePath;
        }

        try {
            $user = User::updateOrCreate(['id' => $request->query('id') ?? null], $request->all());

            if ($user->wasRecentlyCreated) {
                $notifications['success'][] = "User created successfully!";
            } else {
                $notifications['success'][] = "User updated successfully!";
            }
        } catch (\Exception $ex) {
            Log::channel('slack')
                ->alert('``` ' . $ex->getMessage() . ' ```', [
                    'Location: ``` ' . __METHOD__ . ' ```',
                ]);
        }

        // Return to grid
        return redirect()->route('users.grid')
            ->with('error', $notifications['error'] ?? [])
            ->with('success', $notifications['success'] ?? []);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        try {
            if (! empty($request->query('id'))) {
                User::where(['id' => $request->query('id')])->delete();

                $notifications['success'][] = "User deleted successfully!";
            } else {
                $notifications['error'][] = "Invalid user!";
            }
        } catch (\Exception $ex) {
            Log::channel('slack')->alert('``` ' . $ex->getMessage() . ' ```', [
                'Location: ``` ' . __METHOD__ . ' ```',
            ]);
        }

        return redirect()->route('users.grid')
            ->with('error', $notifications['error'] ?? [])
            ->with('success', $notifications['success'] ?? []);
    }
}
