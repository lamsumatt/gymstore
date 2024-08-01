<?php

namespace App\Services;

use App\Services\Interfaces\PostCatalogueServiceInterface;
use App\Services\BaseService;
use App\Repositories\BaseRepository;
use App\Repositories\PostCatalogueRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Classes\Nestedsetbie;
use Exception;


class PostCatalogueService extends BaseService implements PostCatalogueServiceInterface
{
    protected $postCatalogueRepository;
    protected $nestedset;

    public function __construct(PostCatalogueRepository $postCatalogueRepository)
    {
        $this->postCatalogueRepository = $postCatalogueRepository;
        $this->nestedset = new Nestedsetbie([
            'table' => 'post_catalogues',
            'foreign_key' => 'post_catalogue_id',
            'language_id' => $this->currentLanguage(),
        ]);
    }

    public function paginate( $request)
    {
        $condition['keyword'] = addslashes($request->input('keyword'));
        $condition['publish'] = $request->integer('publish');
        $perpage = $request->integer('perpage');
        $PostCatalogues = $this->postCatalogueRepository->pagination($this->paginateSelect(), $condition, 
                                                            [], ['path' => 'PostCatalogue/index'], $perpage, []);
        return $PostCatalogues;
    }


    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->only($this->payload());
            $payload['user_id'] = Auth::id();    
            $PostCatalogue = $this->postCatalogueRepository->create($payload);
            if( $PostCatalogue -> id >0){
                $payloadLanguage = $request->only($this->payloadlanguage());
                $payloadLanguage['language_id'] = $this->currentLanguage();
                $payloadLanguage['language_id'] = $this->currentLanguage();
                $payloadLanguage['post_catalogue_id'] = $PostCatalogue -> id;
                $language = $this->postCatalogueRepository
                ->createLanguagePivot($PostCatalogue, $payloadLanguage);
            }
            $this->nestedset->Get('level ASC, order ASC');
            $this->nestedset->Recursive(0, $this->nestedset->Set());
            $this->nestedset->Action(); 
            





            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('User creation failed: ' . $e->getMessage());
            return false;
        }
    }

    public function update($id, $request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token', 'send');           
            $this->postCatalogueRepository->update($id, $payload);

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('User update failed: ' . $e->getMessage());
            return false;
        }
    }

    public function destroy($id){
        DB::beginTransaction();
        try {
            $PostCatalogue = $this->postCatalogueRepository->delete($id);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('User update failed: ' . $e->getMessage());
            return false;
        }
    }

    
    private function paginateSelect(){
        return ['id', 'name', 'publish','canonical', 'image'];
    }
    
    private function payload(){
        return ['parent_id', 'follow', 'publish', 'image'];
    }

    private function payloadlanguage(){
        return ['name', 'description', 'content', 'meta_title', 'meta_keyword', 'meta_description', 'canonical'];
    }
}