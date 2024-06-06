<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use function PHPSTORM_META\type;

class ProjectController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();

        $data = [
            'projects' => $projects
        ];

        return view('admin.projects.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();

        $data= [
            'types'=>$types
        ];

        return view('admin.projects.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $formData= $request->all();

        $this->validation($formData);

        /* INSERIRE DOPO LA VALIDAZIONE, SENNO SPAMMA MILLE FOTO ANCHE SE IL PROGETTO NON SI è CREATO */
        if ($request->hasFile('image')){
            /* CARICA L'IMMAGINE NELLA CARTELLA DEL PROGETTO */
            $img_path = Storage::disk('public')->put('project_images', $formData['image']);
             /* SALVA NEL DB IL PATH DELL'IMMAGINE CARICATA */
            $formData['image'] = $img_path;
        }

        $newProject= new Project();
        $newProject->slug = Str::slug($formData['name'], '-');
        $newProject-> fill($formData);
        $newProject-> save();

        return redirect()->route('admin.projects.show', ['project' => $newProject->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);
     
        $data = [
            'project' => $project,
        ];

        return view('admin.projects.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $projects = Project::find($id);

        $data = [
            'project' => $projects
        ];

        return view('admin.projects.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $projectModified = Project::findOrFail($id);

        $formData= $request->all();
        
        if($request->hasFile('image')) {
            // CONTROLLA SE C'è' LA VECCHIA IMMAGINA E NEL CASO LA CANCELLA
            if($projectModified->image) {
                Storage::delete($projectModified->image);
            }
            $img_path = Storage::disk('public')->put('project_images', $formData['image']);
            $formData['image'] = $img_path;
        }

        $this->validation($formData);
        $formData['slug'] = Str::slug($formData['name'], '-');
        $projectModified-> fill($formData);
        $projectModified-> save();

        return redirect()->route('admin.projects.show', ['project' => $projectModified->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        // CONTROLLA SE C'è' LA VECCHIA IMMAGINA E NEL CASO LA CANCELLA
        if($project->image) {
            Storage::delete($project->image);
        };

        $project->delete();

        return redirect()->route('admin.projects.index');
    }

    private function validation($data)
    {
        $validator = Validator::make(
            $data,
            [
                'name' => 'required|min:5|max:50',
                'summary' => 'nullable|min:50|max:5000',
                'client_name' => 'required|min:5|max:50',
                'image' =>'required',
                'type_id'=>'required'
            ],
            [
                'name.required' => 'Il titolo è obbligatorio',
                'name.min' => 'Il titolo deve essere composto da almeno cinque caratteri',
                'name.max' => 'Il titolo non può avere più di cinquanta caratteri',
                'summary.required' => 'La descrizione è obbligatoria',
                'summary.min' => 'La descrizione deve essere composta da almeno cinquanta caratteri',
                'summary.max' => 'La descrizione non può avere più di cinquemila caratteri',
                'client_name.required' => 'Il nome del cliente è obbligatorio',
                'client_name.min' => 'Il nome del cliente deve essere composto da almeno cinque caratteri',
                'client_name.max' => 'Il nome del cliente non può avere più di cinquanta caratteri',
                'image.required'=>'L\'immagine è obbligatoria',
                'type_id.required'=>'Il tipo è obbligatorio'
            ]
        )->validate();
        
        return $validator;
    }
}
