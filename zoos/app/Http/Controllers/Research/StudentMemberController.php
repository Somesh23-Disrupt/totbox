<?php

namespace App\Http\Controllers\Research;

use App\Http\Controllers\CollegeBaseController;
use App\Models\ResearchMaster;
use App\Models\ResearchCirculation;
use App\Models\ResearchMember;
use Illuminate\Http\Request;
use URL;

class StudentMemberController extends CollegeBaseController
{
    protected $base_route = 'research.student';
    protected $view_path = 'research.student';
    protected $panel = 'Research Member Student';
    protected $filter_query = [];

    public function __construct()
    {

    }

    public function student(Request $request)
    {
        $data = [];
        $data['lm'] = ResearchMember::select('research_members.id','research_members.user_type', 'research_members.member_id',
            'research_members.status', 'students.first_name',  'students.middle_name',  'students.last_name','students.faculty','students.semester')
            ->where(['research_members.user_type'=> 1 ,'research_members.status' => 1])
            ->where(function ($query) use ($request) {
                $this->commonStudentFilterCondition($query, $request);

            })
            ->join('students','students.id','=','research_members.member_id')
            ->get();

        $circulation = ResearchCirculation::where('user_type','student')->first();
        $filteredMember  = $data['lm']->filter(function ($value, $key) use ($circulation){
            $taken = $value->libBookIssue()->where('status','=',1)->count();
            $eligible = $circulation->issue_limit_books - $taken ;
            $value->taken = $taken;
            $value->eligible = $eligible;
            return $value;
        });

        $data['student'] = $filteredMember;

        $data['faculties'] = $this->activeFaculties();
        $data['batch'] = $this->activeBatch();
        $data['academic_status'] = $this->activeStudentAcademicStatus();

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function studentView(Request $request, $id)
    {
        $data = [];
        $data['blank_ins'] = new ResearchMember();
        $data['student'] = ResearchMember::select('research_members.id','research_members.user_type', 'research_members.member_id',
            'research_members.status', 'students.first_name',  'students.middle_name', 'students.last_name',
            'students.last_name', 'students.gender','students.blood_group','students.university_reg','students.date_of_birth','students.nationality',
            'students.mother_tongue','students.email', 'students.faculty','students.semester','students.student_image')
            ->where(['research_members.user_type' =>  1, 'research_members.member_id' =>  $id ])
            ->join('students','students.id','=','research_members.member_id')
            ->first();

        if(!$data['student']) return back()->with($this->message_warning,'Target member is not valid at this time.');

        $data['circulation'] = $data['student']->libCirculation()->first();

        if($data['student'] != null){
            $data['books_taken'] = $data['student']->libBookIssue()->select('research_issues.id', 'research_issues.member_id',
                'research_issues.book_id',  'research_issues.issued_on', 'research_issues.due_date', 'b.research_masters_id',
                'b.book_code', 'bm.title','bm.categories','bm.image')
                ->where('research_issues.status',1)
                ->join('books as b','b.id','=','research_issues.book_id')
                ->join('research_masters as bm','bm.id','=','b.research_masters_id')
                ->orderBy('research_issues.issued_on', 'desc')
                ->get();

            $data['books_history'] = $data['student']->libBookIssue()->select('research_issues.id', 'research_issues.member_id',
                'research_issues.book_id',  'research_issues.issued_on', 'research_issues.due_date','research_issues.return_date', 'b.research_masters_id',
                'b.book_code', 'bm.title','bm.categories','bm.image')
                ->join('books as b','b.id','=','research_issues.book_id')
                ->join('research_masters as bm','bm.id','=','b.research_masters_id')
                ->orderBy('research_issues.issued_on', 'desc')
                ->get();

            $data['research_request'] = ResearchMaster::select('research_masters.id','research_masters.code', 'research_masters.title', 'research_masters.image',
                'research_masters.categories', 'research_masters.author', 'research_masters.publisher',
                'br.created_at as requested_date')
                ->where('br.member_id',$data['student']->id)
                ->orderBy('research_masters.title','asc')
                ->join('research_requests as br','br.research_masters_id','=','research_masters.id')
                ->get();

        }

        $data['url'] = URL::current();
        return view(parent::loadDataToView($this->view_path.'.detail.index'), compact('data'));
    }

}