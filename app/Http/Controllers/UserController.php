<?php

namespace App\Http\Controllers;

use App\Events\UserSaved;
use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {
    }

    /**
     * Display a listing of the resource.
     * Local Ref: http://127.0.0.1:8000/users
     */
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('users.index', [
            'users' => $this->userService->all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return RedirectResponse
     */
    public function store(UserRequest $request): RedirectResponse
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

        $validated['type'] = 'user';

        try {
           // $user = User::updateOrCreate(['id' => $validated['id'] ?? null], $validated);
            $user = $this->userService->create($validated);

            // Store data into 'details'
            UserSaved::dispatch($user);

            if ($user->wasRecentlyCreated) {
                $notifications['success'][] = "User created successfully!";
            } else {
                $notifications['success'][] = "user updated successfully!";
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
    public function show(string $id): Factory|View|\Illuminate\Foundation\Application|Application
    {
        $userDetails = $this->userService->find($id);

        return view('users.show', ['userDetails' => $userDetails]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $id
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(string $id): Factory|View|\Illuminate\Foundation\Application|Application
    {
        $userDetails = $this->userService->find($id);

        return view('users.edit', ['userDetails' => $userDetails]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
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
            $user = $this->userService->update($request->all(), $request->query('id'));

            // Store data into 'details'
            UserSaved::dispatch($user);

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
        return redirect()->route('users.show', ['id' => $request->query('id')])
            ->with('error', $notifications['error'] ?? [])
            ->with('success', $notifications['success'] ?? []);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        try {
            if (! empty($request->query('id'))) {
                $this->userService->delete($request->query('id'));

                // Store data into 'details'
                UserSaved::dispatch($this->userService->find($request->query('id')));

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

    /**
     * A list of soft deleted users
     *
     * @param Request $request
     * @return Application|ResponseFactory|Factory|View|\Illuminate\Foundation\Application|Response
     */
    public function trashedView(Request $request): Factory|View|\Illuminate\Foundation\Application|Response|Application|ResponseFactory
    {
        if (auth()->user()->type == User::TYPE[1]) {
            return view('users.trashed', ['users' => $this->userService->getTrashedAll()]);
        }

        return response('', 404);
    }

    /**
     * Restore specific user
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function TrashedRestore(Request $request): RedirectResponse
    {
        try {
            if (auth()->user()->type == User::TYPE[1]
                && ! empty($request->query('id'))) {
                $this->userService->trashedRestore($request->query('id'));

                $notifications['success'][] = "User restored successfully.";
            } else {
                $notifications['error'][] = "Invalid user!";
            }
        } catch (\Exception $ex) {
            Log::channel('slack')->alert('``` ' . $ex->getMessage() . ' ```', [
                'Location: ``` ' . __METHOD__ . ' ```',
            ]);
        }

        return redirect()->route('users.trashed')
            ->with('error', $notifications['error'] ?? [])
            ->with('success', $notifications['success'] ?? []);
    }

    /**
     * Forced to delete process
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function trashedDelete(Request $request): RedirectResponse
    {
        try {
            if (auth()->user()->type == User::TYPE[1]
                && ! empty($request->query('id'))) {
                $this->userService->forceDelete($request->query('id'));

                $notifications['success'][] = "User deleted successfully.";
            } else {
                $notifications['error'][] = "Invalid user!";
            }
        } catch (\Exception $ex) {
            Log::channel('slack')->alert('``` ' . $ex->getMessage() . ' ```', [
                'Location: ``` ' . __METHOD__ . ' ```',
            ]);
        }

        return redirect()->route('users.trashed')
            ->with('error', $notifications['error'] ?? [])
            ->with('success', $notifications['success'] ?? []);
    }
}
