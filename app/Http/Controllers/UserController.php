<?php
namespace App\Http\Controllers;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\UserStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
class UserController extends Controller {
    /**
     * Display a listing of users.
     * Only managers can see the full list.
     */
    public function index(Request $request): Response {
        $this->authorize('create', User::class); // reuse create ability as "is manager" gate
        $users = User::with('shifts')->orderBy('name')->get();
        return Inertia::render('Users/Index', ['users' => $users]);
    }
    /**
     * Show a single user's profile.
     * Managers can view anyone; employees can only view themselves.
     */
    public function show(Request $request, User $user): Response {
        $this->authorize('view', $user);
        return Inertia::render('Users/Show', ['profile' => $user->load('shifts')]);
    }
    /**
     * Show the form for creating a new user (managers only).
     */
    public function create(Request $request): Response {
        $this->authorize('create', User::class);
        return Inertia::render('Users/Create');
    }
    /**
     * Store a newly created user (managers only).
     * Authorization is handled inside UserStoreRequest::authorize().
     */
    public function store(UserStoreRequest $request): RedirectResponse {
        User::create($request->validated());
        Inertia::flash('toast', ['type' => 'success', 'message' => __('User created.')]);
        return to_route('users.index');
    }
    /**
     * Show the form for editing a user.
     * Managers can edit anyone; employees can only edit themselves.
     */
    public function edit(Request $request, User $user): Response {
        $this->authorize('update', $user);
        return Inertia::render('Users/Edit', ['profile' => $user]);
    }
    /**
     * Update a user.
     * Managers may update all fields including status.
     * Employees may only update their own profile fields (status changes are stripped).
     */
    public function update(UserUpdateRequest $request, User $user): RedirectResponse {
        $this->authorize('update', $user);
        $validated = $request->validated();
        if ($request->user()->status !== UserStatus::Manager) {// Prevent employees from escalating their own status
            unset($validated['status']);
        }
        $user->fill($validated);
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
        $user->save();
        Inertia::flash('toast', ['type' => 'success', 'message' => __('User updated.')]);
        return to_route('users.show', $user);
    }
    /**
     * Remove a user (managers only, cannot delete themselves).
     */
    public function destroy(Request $request, User $user): RedirectResponse {
        $this->authorize('delete', $user);
        $user->delete();
        Inertia::flash('toast', ['type' => 'success', 'message' => __('User deleted.')]);
        return to_route('users.index');
    }
}