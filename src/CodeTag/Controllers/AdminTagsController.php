<?php

namespace CodePress\CodeTag\Controllers;


use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use CodePress\CodeTag\Repository\TagRepository;
use CodePress\CodeTag\Models\Tag;

class AdminTagsController extends Controller
{

    /**
     * @var ResponseFactory
     */
    private $response;

    /**
     * @var TagRepository
     */
    private $repository;

    /**
     * AdminTagsController constructor.
     * @param ResponseFactory $response
     * @param Tag $repository
     */
    public function __construct(ResponseFactory $response, TagRepository $repository)
    {
        //$this->authorize('tags_access');
        $this->response = $response;
        $this->repository = $repository;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = $this->repository->all();
        return $this->response->view('codetag::index', compact('tags'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = $this->repository->all()->pluck('name','id')->toArray();
        return $this->response->view('codetag::create', compact('tags'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->repository->create($request->all());
        return redirect()->route('admin.tags.index');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $tag = $this->repository->find($id);
        return $this->response->view('codetag::edit', compact('tag'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['active'] = isset($data['active']);
        $this->repository->find($id)->update($data);
        return redirect()->route('admin.tags.index');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        $this->repository->delete($id);
        return redirect()->route('admin.tags.index');
    }

}