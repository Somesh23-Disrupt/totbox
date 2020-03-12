<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Kathmandu-32 (Subidhanagar, Tinkune), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\Research;

use App\Http\Controllers\CollegeBaseController;
use App\Models\ResearchMaster;
use App\Models\ResearchCirculation;
use App\Models\ResearchMember;
use Illuminate\Http\Request;
use URL;

class StaffMemberController extends CollegeBaseController
{
    protected $base_route = 'research.staff';
    protected $view_path = 'research.staff';
    protected $panel = 'Research Member Staff';
    protected $filter_query = [];

    public function __construct()
    {

    }

    public function staff(Request $request)
    {
        $data = [];
        $data['lm'] = ResearchMember::select('research_members.id','research_members.user_type',
            'research_members.member_id', 'research_members.status', 'staff.reg_no','staff.first_name',  'staff.middle_name',  'staff.last_name','staff.designation')
            ->where(['research_members.user_type'=> 2 ,'research_members.status' => 1])
            ->where(function ($query) use ($request) {
                $this->commonStaffFilterCondition($query, $request);
            })
            ->join('staff','staff.id','=','research_members.member_id')
            ->get();

        $circulation = ResearchCirculation::where('user_type','staff')->first();
        $filteredMember  = $data['lm']->filter(function ($value, $key) use ($circulation){
            $taken = $value->libBookIssue()->where('status','=',1)->count();
            $eligible = $circulation->issue_limit_books - $taken ;
            $value->taken = $taken;
            $value->eligible = $eligible;
            return $value;
        });

        $data['staff'] = $filteredMember;

        $data['designation'] = $this->staffDesignationList();
        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function staffView(Request $request, $id)
    {
        $data = [];
        $data['blank_ins'] = new ResearchMember();
        $data['staff'] = ResearchMember::select('research_members.id','research_members.user_type',
            'research_members.member_id', 'research_members.status', 'staff.id as staffId','staff.first_name',  'staff.middle_name', 'staff.last_name',
            'staff.last_name', 'staff.gender','staff.blood_group','staff.home_phone', 'staff.mobile_1','staff.nationality','staff.email', 'staff.staff_image')
            ->where(['research_members.user_type' =>  2, 'research_members.member_id' =>  $id ])
            ->join('staff','staff.id','=','research_members.member_id')
            ->first();

        if(!$data['staff']) return back()->with($this->message_warning,'Target member is not valid at this time.');

        $data['circulation'] = $data['staff']->libCirculation()->first();

        if($data['staff'] != null){
            $data['books_taken'] = $data['staff']->libBookIssue()->select('research_issues.id', 'research_issues.member_id',
                'research_issues.book_id',  'research_issues.issued_on', 'research_issues.due_date', 'b.research_masters_id',
                'b.book_code', 'bm.title','bm.categories','bm.image')
                ->where('research_issues.status',1)
                ->join('books as b','b.id','=','research_issues.book_id')
                ->join('research_masters as bm','bm.id','=','b.research_masters_id')
                ->orderBy('research_issues.issued_on', 'desc')
                ->get();

            $data['books_history'] = $data['staff']->libBookIssue()->select('research_issues.id', 'research_issues.member_id',
                'research_issues.book_id',  'research_issues.issued_on', 'research_issues.due_date','research_issues.return_date', 'b.research_masters_id',
                'b.book_code', 'bm.title','bm.categories','bm.image')
                ->join('books as b','b.id','=','research_issues.book_id')
                ->join('research_masters as bm','bm.id','=','b.research_masters_id')
                ->orderBy('research_issues.issued_on', 'desc')
                ->get();

            $data['research_request'] = ResearchMaster::select('research_masters.id','research_masters.code', 'research_masters.title', 'research_masters.image',
                'research_masters.categories', 'research_masters.author', 'research_masters.publisher',
                'br.created_at as requested_date')
                ->where('br.member_id',$data['staff']->id)
                ->orderBy('research_masters.title','asc')
                ->join('research_requests as br','br.research_masters_id','=','research_masters.id')
                ->get();
        }

        $data['url'] = URL::current();
        return view(parent::loadDataToView($this->view_path.'.detail.index'), compact('data'));
    }

}