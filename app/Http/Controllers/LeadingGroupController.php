<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeadingGroupRequest;
use App\Repositories\ActionRepository;
use Illuminate\Http\Request;
use App\Repositories\LeadingGroupRepository;
use App\Repositories\MarkRepository;
use DataTables;
use Illuminate\Support\Facades\Auth;

class LeadingGroupController extends Controller
{
    protected $leadingGroupRepository, $markRepository, $actionRepository;

    public function __construct(LeadingGroupRepository $leadingGroupRepository,
        MarkRepository $markRepository, ActionRepository $actionRepository
    )
    {
        $this->leadingGroupRepository = $leadingGroupRepository;
        $this->markRepository = $markRepository;
        $this->actionRepository = $actionRepository;
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $leading_groups = $this->leadingGroupRepository->getAll();
            return DataTables::of($leading_groups)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return $row->active ? 'Oui' : 'Non';
                })
                ->addColumn('action', function ($row) {
                    $btn = "";
                    if (!is_null($row)) {
                        $btn .= '<a href="'. route('home') .'/espace-membres/leading-group/validate/' . encrypt($row->id) . '/' . ($row->active ? encrypt(false) : encrypt(true)) . '" class="btn btn-info btn-block" onclick="return confirm(\'Êtes-vous sûr(e) de vouloir faire cette opération ?\')">' . ($row->active ? 'Suspendre' : 'Activer') . '</a>';
                        $btn .= '<a href="'. route('home') .'/espace-membres/leading-group/edit/'. encrypt($row->id) .'" class="btn btn-success btn-block">Editer</a>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('back-end.leading-group.index');
    }

    public function create(Request $request)
    {
        return view('back-end.leading-group.create');
    }

    public function store(LeadingGroupRequest $request)
    {
        $this->leadingGroupRepository->store($request->all());

        $this->markRepository->store([
            'action_id' => $this->actionRepository->getByField('code', '#003')->id,
            'user_id' => Auth::id(),
            'description' => Auth::user()->pseudo . ' a créé le groupe leader ' . $request->name . ' !'
        ]);
        
        return redirect()->route('leading-group.list')->with([
            'success' => 'Le groupe leader '. $request->name .' a été créé avec succès !'
        ]);
    }

    public function edit(Request $request)
    {
        $leading_group = $this->leadingGroupRepository->getById(decrypt($request->id));
        
        return view('back-end.leading-group.edit', compact('leading_group'));
    }

    public function update(LeadingGroupRequest $request)
    {
        $this->leadingGroupRepository->update(decrypt($request->id), $request->except(['id']));

        $this->markRepository->store([
            'action_id' => $this->actionRepository->getByField('code', '#004')->id,
            'user_id' => Auth::id(),
            'description' => Auth::user()->pseudo . ' a édité le groupe leader ' . $request->name . ' !'
        ]);

        return redirect()->route('leading-group.list')->with([
            'success' => 'Le groupe leader ' . $request->name . ' a été mis à jour avec succès !'
        ]);
    }

    public function updateActivity(Request $request)
    {
        $id = decrypt($request->id);
        $active = decrypt($request->active);
        $leading_group = $this->leadingGroupRepository->getById($id);
        
        $this->leadingGroupRepository->update($id, ['active' => $active]);

        $this->markRepository->store([
            'action_id' => $this->actionRepository->getByField('code', ($active ? '#005' : '#006'))->id,
            'user_id' => Auth::id(),
            'description' => Auth::user()->pseudo . ' a '. ($active ? 'activé' : 'suspendu') .' le groupe leader ' . $leading_group->name . ' !'
        ]);

        return redirect()->route('leading-group.list')->with([
            'success' => 'Le groupe leader ' . $leading_group->name . ' a été '. ($active ? 'activé' : 'suspendu') .' avec succès !'
        ]);
    }
}
