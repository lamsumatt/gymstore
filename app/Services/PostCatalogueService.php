<?php

namespace App\Services;

use App\Services\Interfaces\PostCatalogueServiceInterface;
use App\Services\BaseService;
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
    protected $language;

    public function __construct(PostCatalogueRepository $postCatalogueRepository)
    {
        $this->language = $this->currentLanguage();
        $this->postCatalogueRepository = $postCatalogueRepository;
        $this->nestedset = new Nestedsetbie([
            'table' => 'post_catalogues',
            'foreign_key' => 'post_catalogue_id',
            'language_id' => $this->language,
        ]);
    }

    public function paginate( $request)
    {
        $condition['keyword'] = addslashes($request->input('keyword'));
        $condition['publish'] = $request->integer('publish');
        $condition['where'] = [
            ['tb2.language_id', '=', $this->language],
        ];
        $perpage = $request->integer('perpage');
        $postCatalogue = $this->postCatalogueRepository->
        pagination($this->paginateSelect(), 
                            $condition, 
                            [
                                ['post_catalogue_language as tb2', 'tb2.post_catalogue_id', '=' ,'post_catalogues.id',]
                            ],
                            ['path' => 'post.catalogue.index'], 
                            $perpage, 
                            [], 
                            [
                                'post_catalogue.lft ', 'ASC'
                            ]
                             );
        return $postCatalogue;
    }


    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->only($this->payload());
            $payload['user_id'] = Auth::id();    
            $postCatalogue = $this->postCatalogueRepository->create($payload);
            // dd($PostCatalogue);
            if( $postCatalogue -> id >0){
                $payloadLanguage = $request->only($this->payloadlanguage());
                $payloadLanguage['language_id'] = $this->currentLanguage();
                $payloadLanguage['language_id'] = $this->currentLanguage();
                $payloadLanguage['post_catalogue_id'] = $postCatalogue -> id;
                $language = $this->postCatalogueRepository
                ->createLanguagePivot($postCatalogue, $payloadLanguage);
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
            $postCatalogue = $this->postCatalogueRepository->findById($id);
            $payload = $request->only($this->payload()); 
            $flag = $this->postCatalogueRepository->update($id, $payload);
            if($flag == TRUE){
                $payloadLanguage = $request->only($this->payloadlanguage());
                $payloadLanguage['language_id'] = $this->currentLanguage();
                $payloadLanguage['language_id'] = $id;
                $postCatalogue->language()->detach([$payloadLanguage['language_id'], $id]);
                $response = $this->postCatalogueRepository
                ->createLanguagePivot($postCatalogue, $payloadLanguage);
                $this->nestedset->Get('level ASC, order ASC');
                $this->nestedset->Recursive(0, $this->nestedset->Set());
                $this->nestedset->Action(); 
            }
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
            $this->nestedset->Get('level ASC, order ASC');
            $this->nestedset->Recursive(0, $this->nestedset->Set());
            $this->nestedset->Action(); 
            
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('User update failed: ' . $e->getMessage());
            return false;
        }
    }

    
    private function paginateSelect(){
        return ['post_catalogues.id', 
                'tb2.name', 
                'post_catalogues.publish',
                'tb2.canonical', 
                'post_catalogues.image', 
                'post_catalogues.level',
                'post_catalogues.order',
            ];
    }
    
    private function payload(){
        return ['parent_id', 'follow', 'publish', 'image'];
    }

    private function payloadlanguage(){
        return ['name', 'description', 'content', 'meta_title', 'meta_keyword', 'meta_description', 'canonical'];
    }
}