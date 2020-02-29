<?php

namespace App\Sections\Leads\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sections\Leads\Repositories\LeadRepository;
use App\Sections\Leads\Resources\Lead;
use App\Sections\Leads\Requests\StoreLead;

class LeadController extends Controller
{
    /**
     * lead repository instance.
     *
     * @return string
     */
    protected $leads;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(LeadRepository $leads)
    {
        $this->leads = $leads;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('sections.leads.index', [
            'h1' => _p('pages.leads.h1', 'leads'),
            'leads' => $this->scope($request)->response()->getData()
        ]);
    }

    public function scope(Request $request)
    {
        return Lead::collection(
            $this->leads->scope($request)->smartPaginate()
        );
    }

    public function store(StoreLead $request)
    {
        $this->leads->create($request->all());
    }

    public function update(Request $request, $id)
    {
        $this->leads->update($request->all(), $id);
    }
}
