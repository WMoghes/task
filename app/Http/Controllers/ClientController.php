<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class ClientController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['client', 'auth']);
    }

    public function getClients(Request $request)
    {
        if ($request->ajax()) {
            $allClients = User::allClients()->orderBy('id', 'desc')->paginate(6);
            if (! isset($request->page)) {
                return view('admin.pages.admin_clients', compact('allClients'));
            }
            return view('admin.pages.clients_includes.clients_table', compact('allClients'));
        }
    }

    public function displayClient($id, $type)
    {
        $data = User::findOrFail($id);
        if ($type === 'show') {
            return view('admin.pages.clients_includes.models_includes.clients_model_show', compact('data'));
        } elseif ($type === 'edit') {
            return view('admin.pages.clients_includes.models_includes.clients_model_edit', compact('data'));
        }

    }

    public function updateClient(Request $request, $id)
    {
        $this->validate($request, [
            'username' => 'required|max:255|unique:users,username,' . $id,
            'email' => 'required|email|max:255|unique:users,email,' . $id,
        ]);

        User::findOrFail($id)->update($request->all());
    }

    public function searchClient($email)
    {
        if ($email === 'none') {
            $allClients = User::allClients()->orderBy('id', 'desc')->paginate(6);
            return view('admin.pages.clients_includes.clients_table', compact('allClients'));
        } elseif ($email) {
            $allClientsFromSearch = User::allClients()->where('email', 'like', '%' . $email . '%')
                                        ->orderBy('id', 'desc')->paginate(6);

            if (count($allClientsFromSearch)) {
                return view('admin.pages.clients_includes.clients_table_search_result', compact('allClientsFromSearch'))
                    ->withStatus(count($allClientsFromSearch) . ' found it.');
            } else {
                return view('admin.pages.clients_includes.clients_table_search_result', compact('allClientsFromSearch'))
                    ->withStatus('No results found it');
            }
        }
    }

    public function removeClient($id)
    {
        User::findOrFail($id)->delete();
    }
}
