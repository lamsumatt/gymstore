<?php

namespace App\Services;

use App\Services\Interfaces\PostCatalogueServiceInterface;
use App\Repositories\Interfaces\PostCatalogueRepositoryInterface as PostCatalogueRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Exception;


class PostCatalogueService implements PostCatalogueServiceInterface
{
    protected $postCatalogueRepository;

    public function __construct(PostCatalogueRepository $postCatalogueRepository)
    {
        $this->postCatalogueRepository = $postCatalogueRepository;
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

    private function paginateSelect(){
        return ['id', 'name', 'publish','canonical', 'image'];
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token', 'send');
            $payload['user_id'] = Auth::id();    
            $this->postCatalogueRepository->create($payload);
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

    // change user catalogue status
    // public function updateStatus($post = []){
    //     DB::beginTransaction();
    //     try {
    //         $payload[$post['field']] = (($post['value'] == 1) ? 2 : 1);
    //         $PostCatalogues =  $this->postCatalogueRepository->update($post['modelId'], $payload);
    //         $this->changeUserStatus($post, $payload[$post['field']]);

    //         DB::commit();
    //         return true;
    //     } catch (Exception $e) {
    //         DB::rollBack();
    //         Log::error('User update failed: ' . $e->getMessage());
    //         return false;
    //     }
    // }

    // public function updateStatusAll($post){
    //     DB::beginTransaction();
    //     try {
    //         $payload[$post['field']] =$post['value'] ;
    //         $flag =  $this->postCatalogueRepository->updateByWhereIn('id', $post['id'], $payload);
    //         $this->changeUserStatus($post, $post['value']);


    //         DB::commit();
    //         return true;
    //     } catch (Exception $e) {
    //         DB::rollBack();
    //         Log::error('User update failed: ' . $e->getMessage());
    //         return false;
    //     }
    // }

    // private function changeUserStatus($post, $value){
    //     DB::beginTransaction();
    //     try {
    //         $array = [];
    //         if(isset($post['modelId']) ){
    //             $array[] = $post['modelId'];
    //         }else{
    //             $array = $post['id'];
    //         }
    //         $payload[$post['field']] = $value;
    //         $this -> userRepository->updateByWhereIn('catalogue_id', $array, $payload);

    //         DB::commit();
    //         return true;
    //     } catch (Exception $e) {
    //         DB::rollBack();
    //         Log::error('User update failed: ' . $e->getMessage());
    //         return false;
    //     }
    // }

    // end change
}