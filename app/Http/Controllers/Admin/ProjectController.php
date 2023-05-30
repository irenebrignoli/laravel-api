<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *

     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));

    }

    /**
     * Show the form for creating a new resource.
     *

     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types','technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request

     */
    public function store(StoreProjectRequest $request)
    {
        $form_data = $request->validated();

        $form_data['slug'] = Project::generateSlug($form_data['title']);

        $checkProject = Project::where('slug', $form_data['slug'])->first();
        if ($checkProject) {
            return back()->withInput()->withErrors(['slug' => 'Unable to create slug for this project, please change the title']);
        }
        
        if($request->hasFile('image')){
            $path = Storage::put('cover_images', $request->image);
            $form_data['image'] = $path;
        }
        
        $newProject = Project::create($form_data);

        if ($request->has('technologies')) {
            $newProject->technologies()->attach($request->technologies);
        }

        return redirect()->route('admin.projects.show', ['project' => $newProject->slug])->with('status', 'Project created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project

     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project

     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
 
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $form_data = $request->validated();

        $form_data['slug'] = Project::generateSlug( $request->title);

        $checkProject = Project::where('slug', $form_data['slug'])->where('id', '<>', $project->id)->first();

        if ($checkProject) {
            return back()->withInput()->withErrors(['slug' => 'Unable to create slug']);
        }

        if($request->hasFile('image')){

            if($project->image){
                Storage::delete($project->image);
            }

            $path = Storage::put('cover_images', $request->image);
            $form_data['image'] = $path;
        }
        
        $project->technologies()->sync($request->technologies);

        $project -> update($form_data);

        return redirect()->route('admin.projects.show', ['project' => $project->slug])->with('status', 'Project updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if($project->image){
            Storage::delete($project->image);
        }

        $project->delete();
        return redirect()->route('admin.projects.index');
    }

    public function deleteImage($slug) {

        $project = Project::where('slug', $slug)->firstOrFail();

        if ($project->image) {
            Storage::delete($project->image);
            $project->image = null;
            $project->save();
        }

        return redirect()->route('admin.projects.edit', $project->slug);
    }
}
