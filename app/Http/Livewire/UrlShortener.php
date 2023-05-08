<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Url;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class UrlShortener extends Component
{
    use WithPagination;

    public $confirmingUrlAdd, $urlAdd;
    public $confirmingUrlUpdate, $urlUpdate;
    public $confirmingUrlDelete, $urlDelete;
    public $confirmingUrlView, $urlView;

    public $original_url, $update_url, $shorten_url, $url_id;


    protected $rules = [
        'original_url' => 'required|url',
    ];

    public function render()
    {

        return view('livewire.url-shortener',[
           //'urls' => Url::paginate(10),
        'urls' => DB::table('urls')->orderBy('id', 'desc')->Paginate(10),
        ]);
    }

    public function mount()
    {
        $this->confirmingUrlAdd = false;
        $this->urlAdd = false;

        $this->confirmingUrlView = false;
        $this->urlView = false;

        $this->confirmingUrlUpdate = false;
        $this->urlUpdate = false;

        $this->confirmingUrlDelete = false;
        $this->urlDelete = false;
    }

    /**
     * Creating modal event for storing newly created URLs.
     */
    public function AddingUrl()
    {
        $this->confirmingUrlAdd = true;
    }

    public function confirmUrlAdd()
    {
        $this->confirmingUrlAdd = true;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        // Retrieve the validated input data...
        $this->validate();
        $url = $this->original_url;
    

        Url::create([
            'original_url' => $this->original_url,
        ]);
        $this->reset(['original_url']);
        $this->confirmingUrlAdd = false;
        session()->flash('message', 'URL created successfully'.$url);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $Urls = DB::table('url')->get();
        $url = $Urls->paginate(10);
    }

    /**
     * Creating modal event for Viewing URLs.
     */
    public function ViewingUrl()
    {
        $this->confirmingUrlView = true;
    }

    public function confirmUrlView($id)
    {
        $this->confirmingUrlView = $id;
        $url = DB::table('urls')->where('id', '=', $id)->get();

        $this->url_id = $url[0]->id;
        $this->original_url = $url[0]->original_url;
        $this->shorten_url = $url[0]->shorten_url;
    }


    /**
     * Creating modal event for Updating URLs.
     */
    public function UpdatingUrl()
    {
        $this->confirmingUrlUpdate = true;
    }

    public function confirmUrlUpdate($id)
    {
        $this->confirmingUrlUpdate = $id;
        $url = DB::table('urls')->where('id', '=', $id)->get();

        $this->original_url = $url[0]->original_url;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Url $url)
    {
        // Retrieve the validated input data...
        $this->validate([
            'original_url' => 'required|url',
        ]);

         $id = $url->id;
        DB::table('urls')
            ->where('id', $id)
            ->update(['original_url' => $this->original_url]);
        
        $this->confirmingUrlUpdate = false;
        session()->flash('message', 'URL Updated successfully'.$id);
    }



    /**
     * Creating modal event for deleting created URLs.
     */
    public function DeletingUrl()
    {
        $this->confirmingUrlDelete = true;
    }

    public function confirmUrlDelete($id)
    {
        $this->confirmingUrlDelete = $id;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Url $url)
    {
           //
        $id = $url->id;
        DB::table('urls')->where('id', '=', $id)->delete();
        $this->confirmingUrlDelete = false;
        session()->flash('message', 'URL Delete successfully');
    }

}