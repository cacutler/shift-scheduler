<?php
namespace App\Http\Controllers;
use App\Http\Requests\ShiftStoreRequest;
use App\Http\Requests\ShiftUpdateRequest;
use App\Models\Shift;
use App\UserStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
class ShiftController extends Controller {
    /**
     * Display a listing of shifts.
     * Managers see all shifts with their assigned user.
     * Employees see only their own shifts and open (unassigned) shifts.
     */
    public function index(Request $request): Response {
        $user = $request->user();
        $shifts = Shift::with('user')->when(
            $user->status !== UserStatus::Manager,
            fn ($query) => $query->where(function ($q) use ($user) {
                $q->whereNull('user_id')->orWhere('user_id', $user->id);
            })
        )->orderBy('start_date')->orderBy('start_time')->get();
        return Inertia::render('Shifts/Index', ['shifts' => $shifts]);
    }
    /**
     * Show a single shift.
     */
    public function show(Request $request, Shift $shift): Response {
        $this->authorize('view', $shift);
        return Inertia::render('Shifts/Show', ['shift' => $shift->load('user')]);
    }
    /**
     * Show the form for creating a new shift (managers only).
     */
    public function create(Request $request): Response {
        $this->authorize('create', Shift::class);
        return Inertia::render('Shifts/Create');
    }
    /**
     * Store a newly created shift (managers only).
     * Authorization is handled inside ShiftStoreRequest::authorize().
     */
    public function store(ShiftStoreRequest $request): RedirectResponse
    {
        Shift::create($request->validated());
        Inertia::flash('toast', ['type' => 'success', 'message' => __('Shift created.')]);
        return to_route('shifts.index');
    }
    /**
     * Show the form for editing a shift.
     * Managers can edit any shift.
     * Employees can only see the claim form for an open shift.
     */
    public function edit(Request $request, Shift $shift): Response {
        $this->authorize('update', $shift);
        return Inertia::render('Shifts/Edit', ['shift' => $shift->load('user')]);
    }
    /**
     * Update a shift.
     * Managers can update all fields freely.
     * Employees may only self-assign an open shift (set user_id to themselves);
     * any other field changes by an employee are rejected.
     */
    public function update(ShiftUpdateRequest $request, Shift $shift): RedirectResponse {
        $this->authorize('update', $shift);
        $user = $request->user();
        $validated = $request->validated();
        if ($user->status !== UserStatus::Manager) {// Employees may only claim the shift for themselves — nothing else
            $shift->user_id = $user->id;
            $shift->save();
            Inertia::flash('toast', ['type' => 'success', 'message' => __('Shift claimed.')]);
        } else {
            $shift->fill($validated)->save();
            Inertia::flash('toast', ['type' => 'success', 'message' => __('Shift updated.')]);
        }
        return to_route('shifts.index');
    }
    /**
     * Remove a shift (managers only).
     */
    public function destroy(Request $request, Shift $shift): RedirectResponse {
        $this->authorize('delete', $shift);
        $shift->delete();
        Inertia::flash('toast', ['type' => 'success', 'message' => __('Shift deleted.')]);
        return to_route('shifts.index');
    }
}