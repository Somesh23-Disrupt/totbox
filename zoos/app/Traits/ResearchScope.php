<?php
namespace App\Traits;

use App\Models\ResearchCategory;
use App\Models\ResearchMaster;
use App\Models\ResearchStatus;
use App\Models\ResearchCirculation;

trait ResearchScope{

    public function activeBookCategories()
    {
        $category = ResearchCategory::Active()->orderBy('title')->pluck('title','id')->toArray();
        return array_prepend($category,'Select Category','0');
    }

    public function activeBookStatus()
    {
        $status = ResearchStatus::select('id', 'title')->orderBy('title')->pluck('title','id')->toArray();
        return array_prepend($status,'Select Status','0');
    }

    public function activeBookMasters()
    {
        $book = ResearchMaster::select('id', 'title')->orderBy('title')->pluck('title','id')->toArray();
        return array_prepend($book,'Select Book','0');
    }

    /*Library Views*/
    public function getBookCategoryById($id)
    {
        $BookCategory = ResearchCategory::find($id);
        if ($BookCategory) {
            return $BookCategory->title;
        }else{
            return "Unknown";
        }
    }

    /*Book Status Views*/
    public function getBookStatusById($id)
    {
        $BookStatus = ResearchStatus::find($id);
        if ($BookStatus) {
            return $BookStatus->title;
        }else{
            return "Unknown";
        }
    }

    /*Book Status Views*/
    public function getBookStatusClassById($id)
    {
        $BookStatus = ResearchStatus::find($id);
        if ($BookStatus) {
            return $BookStatus->display_class;
        }else{
            return "Unknown";
        }
    }

    /*Library User Type Views*/
    public function getLibUserTypeId($id)
    {
        $userType = ResearchCirculation::find($id);
        if ($userType) {
            return $userType->user_type;
        }else{
            return "Unknown";
        }
    }
}