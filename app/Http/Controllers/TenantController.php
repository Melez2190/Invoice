<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTenantRequest;
use App\Http\Requests\UpdateTenantRequest;
use App\Models\User;
use App\Notifications\TenantInviteNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\DataTables;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tenants = User::where('role_id', 2)->get();

        if($request->ajax()){
            return DataTables::of($tenants)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $html = '<a href="javascript:void(0)" data-toogle="tooltip" data-id="'.$row->id.'"data-original-title="Edit" class="btn-edit bg-blue-500  text-white shadow-5xl mb-10 p-1 uppercase font-bold">Edit</a> ';
                $html .= '<a href="javascript:void(0)" data-toogle="tooltip" data-id="'.$row->id.'"data-original-title="Delete" class="btn-delete bg-red-500  text-white shadow-5xl mb-10 p-1 uppercase font-bold">Delete</a> ';
                return $html;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('admin.tenants.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tenants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTenantRequest $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'domain' => $request->domain,
            'role_id' => '2',
            'password' => 'secret'
        ];
        $user = User::create($data);

        $url = URL::signedRoute('invitation', $user);
        $user->notify(new TenantInviteNotification($url));

        return redirect()->route('tenants.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $tenant
     * @return \Illuminate\Http\Response
     */
    public function edit(User $tenant)
    {
        return view('tenants.edit', compact('tenant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $tenant
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTenantRequest $request, User $tenant)
    {
        $tenant->update($request->validated());

        return redirect()->route('tenants.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $tenant)
    {
        $tenant->delete();

        return redirect()->route('tenants.index');
    }

    
    public function invitation(User $user)
    {
        if (!request()->hasValidSignature() || $user->password != 'secret') {
            abort(401);
        }

        auth()->login($user);

        return redirect()->route('home');
    }
}
