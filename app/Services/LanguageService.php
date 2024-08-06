<?php

namespace App\Services;

use App\Services\Interfaces\LanguageServiceInterface;
use App\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Exception;


class LanguageService implements LanguageServiceInterface
{
    protected $LanguageRepository;

    public function __construct(LanguageRepository $LanguageRepository)
    {
        $this->LanguageRepository = $LanguageRepository;
    }

    public function paginate( $request)
    {
        $condition['keyword'] = addslashes($request->input('keyword'));
        $condition['publish'] = $request->integer('publish');
        $perpage = $request->integer('perpage');
        $Languages = $this->LanguageRepository->pagination($this->paginateSelect(), $condition, 
                                                            [], ['path' => 'language/index'], $perpage, []);
        return $Languages;
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
              
            $this->LanguageRepository->create($payload);
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
            $this->LanguageRepository->update($id, $payload);

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
            $Language = $this->LanguageRepository->delete($id);
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
    //         $languages =  $this->LanguageRepository->update($post['modelId'], $payload);
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
    //         $flag =  $this->LanguageRepository->updateByWhereIn('id', $post['id'], $payload);
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