<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClienteCollection;
use Illuminate\Http\Request;
use App\Services\CustomerService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Redirect;

class bankingController extends Controller
{
    public $CustomerService;

    public function __construct(CustomerService $CustomerService)
    {
        $this->CustomerService = $CustomerService;
    }

    public function index(Request $request)
    {
        $users = json_decode($this->CustomerService->listar( $request->all()));
        $res = collect($users);

        $page = request()->get('page');
        $perPage = 5;
        $paginator = new LengthAwarePaginator(
            $res->forPage($page, $perPage), $res->count(), $perPage, $page
        );
        $paginator->setPath("cliente");
        $cliente = ClienteCollection::make($paginator);
        return view('admin.users.index', compact('cliente'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $user =  json_decode($this->CustomerService->registrar(json_encode($request->all())));
        return redirect::to('cliente');

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user =  json_decode($this->CustomerService->obtenerId($id));
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request['id'] = $id;
        $user =  json_decode($this->CustomerService->actualizar(json_encode($request->all()) ,$id));
        return Redirect::to('cliente');
    }

    public function destroy($id)
    {

        $user =  json_decode($this->CustomerService->borrar($id));
        return redirect::to('cliente');

    }
}
